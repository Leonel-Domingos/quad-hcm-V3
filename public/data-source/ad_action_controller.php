<?php
/*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @versão     2.0
 *  @revisão    2018.10.20
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome     	dk_action_controller.php
 *  @descrição  Controlador específico para implementar as ações associadas ao módulo de avaliação de desempenho.
 *
 */

# cabeçaho do controlador
require_once 'quad_head_controller.php';

require_once INCLUDES_PATH."/lib/ad_lib.php";


## inicializações
$msg = '';
$action = '';
$empresa_ = '';
$id_pa_ = '';
$dt_ini_pa_ = '';
$id_proc_av_ = '';
$dt_ini_proc_ = '';
$rhid_avaliado_ = '';
$dt_adm_avaliado_ = '';
$rhid_old_avaliador_ = '';
$rhid_new_avaliador_ = '';
$rhid_avaliador_ = '';
$estado_ = '';

$request_data_ = '';
$where_ = '';

## chamado a partir de um worker ?
$workerData = json_decode(file_get_contents("php://input"));

if ($workerData) {
    foreach ($workerData as $key => $val) {
        ## ação
        if ($key === 'request_id') {
            $action = strtoupper($val);
        }

        ## empresa
        if ($key === 'empresa') {
            $empresa_ = $val;
        }

        ## plano avaliação
        if ($key === 'plano') {
            $id_pa_ = $val;
        }

        ## data plano avaliação
        if ($key === 'dt_plano') {
            $dt_ini_pa_ = $val;
        }

        ## processo avaliação
        if ($key === 'processo') {
            $id_proc_av_ = $val;
        }

        ## processo avaliação
        if ($key === 'dt_processo') {
            $dt_ini_proc_ = $val;
        }

        ## rhid do avaliado
        if ($key === 'rhid_avaliado') {
            $rhid_avaliado_ = $val;
        }

        ## data admissão do avaliado
        if ($key === 'dt_adm_avaliado') {
            $dt_adm_avaliado_ = $val;
        }

        ## rhid do avaliador
        if ($key === 'rhid_avaliador') {
            $rhid_avaliador_ = $val;
        }

        ## estado
        if ($key === 'estado') {
            $estado_ = $val;
        }
        
        ## avaliador atual (troca)
        if ($key === 'rhid_old_avaliador') {
            $rhid_old_avaliador_ = $val;
        }

        ## novo avaliador (troca)
        if ($key === 'rhid_new_avaliador') {
            $rhid_new_avaliador_ = $val;
        }
        
        ## lista colaboradores
        if ($key === 'colabs') {
            $colabs_ = json_decode($val);
        }

        ## condição where
        if ($key === 'where') {
            $where_ = $val;
        }

        ## request_data
        if ($key === 'request_data') {
            $request_data_ = $val;
        }
    }
} else {
    ## ação a executar pelo controlador sem ser chamado pelo worker
    ##
    $action = strtoupper(@$_REQUEST['request_id']);
}

# gravar respostas a fichas de avaliação
if ($action == 'GRAVAR_RESPOSTA') {
    # tp:
    #   COMP - competência
    #   OBJ - objectivo
    #   FICHA - ficha
    #
    $tp = @$_REQUEST['tp'];

    # id da ficha
    $id_ficha = @$_REQUEST['id_ficha'];
    $param = explode("@", $id_ficha);
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

    # id da ficha base para homologação
    $id_ficha_homol = @$_REQUEST['id_ficha_homol'];

    # id da competência/objectivo
    $id = @$_REQUEST['id'];

    # escala aplicada
    $escala = urldecode(@$_POST['escala']);
    $param = explode('@', $escala);
    $id_ep = $param[0];
    $dt_ep = $param[1];

    # valor - resposta
    $valor = urldecode(@$_REQUEST['valor']);
    $p = explode('@', $valor);
    $nv_ep = $p[0];
    $dt_nv_ep = $p[1];

    # observações à ficha
    $obs = urldecode(@$_REQUEST['obs']);

    # novo avaliador
    $rhid_aval = @$_REQUEST['rhid_aval'];

    # concordancia
    $conc = @$_REQUEST['conc'];

    # estado da ficha
    $estado = @$_REQUEST['estado'];

    $novo_estado = '';
    $dsp_novo_estado = '';

    #echo "key :$key<br/>";
    #echo "tp:$tp  id:$id  id_ep:$id_ep  dt_ep:$dt_ep  valor:$nv_ep  dt_nv_ep:$dt_nv_ep  id_ficha:$id_ficha";
    if (
        $tp == 'COMP' &&
        $id != '' &&
        $id_ep != '' &&
        $dt_ep != '' &&
        $nv_ep != '' &&
        $dt_nv_ep != '' &&
        $id_ficha != ''
    ) {
        try {
            $sql =
                "UPDATE RH_FICHA_AVAL_COMPORTAMENTOS " .
                "SET ID_NV_AF = :ID_NV_AF_ " .
                "   ,ID_EP_NV_AF = :ID_EP_NV_AF_ " .
                "   ,DT_INI_NV_AF = :DT_INI_NV_AF_ " .
                "   ,DT_INI_EP_NV_AF = :DT_INI_EP_NV_AF_ " .
                "WHERE SEQ_ = :ID_ ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':ID_NV_AF_', $nv_ep, PDO::PARAM_STR);
            $stmt->bindParam(':ID_EP_NV_AF_', $id_ep, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_NV_AF_', $dt_ep, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_EP_NV_AF_', $dt_nv_ep, PDO::PARAM_STR);
            $stmt->bindParam(':ID_', $id, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "COMP#1: " . $ex->getMessage();
        }

        if ($msg == '' && $estado == 'A') {
            try {
                $sql =
                    "UPDATE RH_AVALIADOR_FASES a " .
                    "SET ESTADO = 'B' " .
                    "WHERE a.EMPRESA = :EMPRESA_ " .
                    "  AND a.ID_PA = :ID_PA_ " .
                    "  AND a.DT_INI_PA = :DT_INI_PA_ " .
                    "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                    "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                    "  AND a.ID_FASE = :ID_FASE_ " .
                    "  AND a.DT_INI_FASE = :DT_INI_FASE_ " .
                    "  AND a.DT_INI_FPA = :DT_INI_FPA_ " .
                    "  AND a.RHID_AVALIADO = :RHID_ " .
                    "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                    "  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                    "  AND a.DT_INI_AF = :DT_INI_AF_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':ID_PROCESSO_AV_',
                    $id_proc_av_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(
                    ':DT_INI_PROCESSO_',
                    $dt_ini_proc_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':DT_INI_FASE_',
                    $dt_ini_fase_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':RHID_AVALIADOR_',
                    $rhid_avaliador_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->execute();

                $novo_estado = 'B';
                $dsp_novo_estado = dsp_dominio(
                    'GE_ESTADO_FA',
                    $novo_estado,
                    $msg
                );
            } catch (Exception $ex) {
                $msg = "COMP#2: " . $ex->getMessage();
            }
        }
    } elseif ($tp == 'OBS_COMP' && $id != '' && $id_ficha != '') {
        try {
            $sql =
                "UPDATE RH_FICHA_AVAL_COMPORTAMENTOS " .
                "SET COMENTARIO = :COMENTARIO_ " .
                "WHERE SEQ_ = :ID_ ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':COMENTARIO_', $valor, PDO::PARAM_STR);
            $stmt->bindParam(':ID_', $id, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "OBS_COMP#1: " . $ex->getMessage();
        }

        if ($msg == '' && $estado == 'A') {
            try {
                $sql =
                    "UPDATE RH_AVALIADOR_FASES a " .
                    "SET ESTADO = 'B' " .
                    "WHERE a.EMPRESA = :EMPRESA_ " .
                    "  AND a.ID_PA = :ID_PA_ " .
                    "  AND a.DT_INI_PA = :DT_INI_PA_ " .
                    "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                    "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                    "  AND a.ID_FASE = :ID_FASE_ " .
                    "  AND a.DT_INI_FASE = :DT_INI_FASE_ " .
                    "  AND a.DT_INI_FPA = :DT_INI_FPA_ " .
                    "  AND a.RHID_AVALIADO = :RHID_ " .
                    "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                    "  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                    "  AND a.DT_INI_AF = :DT_INI_AF_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':ID_PROCESSO_AV_',
                    $id_proc_av_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(
                    ':DT_INI_PROCESSO_',
                    $dt_ini_proc_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':DT_INI_FASE_',
                    $dt_ini_fase_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':RHID_AVALIADOR_',
                    $rhid_avaliador_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->execute();

                $novo_estado = 'B';
                $dsp_novo_estado = dsp_dominio(
                    'GE_ESTADO_FA',
                    $novo_estado,
                    $msg
                );
            } catch (Exception $ex) {
                $msg = "OBS_COMP#2: " . $ex->getMessage();
            }
        }
    } elseif ($tp == 'OBJ' && $id != '' && $id_ficha != '') {
        try {
            $sql = "UPDATE RH_ID_AVALIACAO_OBJECTIVOS ";

            if ($id_ep != '' && $dt_ep != '' && $dv_nv_ep != '') {
                $sql .=
                    "SET ID_NV_ESCALA_AF = :ID_NV_AF_ " .
                    "   ,ID_EP_AF = :ID_EP_NV_AF_ " .
                    "   ,DT_INI_NV_ESCALA_AF = :DT_INI_NV_AF_ " .
                    "   ,DT_INI_EP_AF = :DT_INI_EP_NV_AF_ ";
            } else {
                $sql .= "SET VLR_ATRIBUIDO = :VLR_ATRIBUIDO_ ";
            }
            $sql .=
                "   ,CHANGED_BY = '" .
                @$_SESSION['utilizador'] .
                    "' " .
                    "   ,DT_UPDATED = SYSDATE() " .
                    "WHERE SEQ_ = :ID_ ";

            $stmt = $db->prepare($sql);

            if ($id_ep != '' && $dt_ep != '' && $dv_nv_ep != '') {
                $stmt->bindParam(':ID_NV_AF_', $nv_ep, PDO::PARAM_STR);
                $stmt->bindParam(':ID_EP_NV_AF_', $id_ep, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_NV_AF_', $dt_ep, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':DT_INI_EP_NV_AF_',
                    $dt_nv_ep,
                    PDO::PARAM_STR
                );
            } else {
                $stmt->bindParam(':VLR_ATRIBUIDO_', $valor, PDO::PARAM_STR);
            }
            $stmt->bindParam(':ID_', $id, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "OBJ#1: " . $ex->getMessage();
        }

        if ($msg == '' && $estado == 'A') {
            try {
                $sql =
                    "UPDATE RH_AVALIADOR_FASES a " .
                    "SET ESTADO = 'B' " .
                    "WHERE a.EMPRESA = :EMPRESA_ " .
                    "  AND a.ID_PA = :ID_PA_ " .
                    "  AND a.DT_INI_PA = :DT_INI_PA_ " .
                    "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                    "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                    "  AND a.ID_FASE = :ID_FASE_ " .
                    "  AND a.DT_INI_FASE = :DT_INI_FASE_ " .
                    "  AND a.DT_INI_FPA = :DT_INI_FPA_ " .
                    "  AND a.RHID_AVALIADO = :RHID_ " .
                    "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                    "  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                    "  AND a.DT_INI_AF = :DT_INI_AF_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':ID_PROCESSO_AV_',
                    $id_proc_av_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(
                    ':DT_INI_PROCESSO_',
                    $dt_ini_proc_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':DT_INI_FASE_',
                    $dt_ini_fase_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':RHID_AVALIADOR_',
                    $rhid_avaliador_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->execute();

                $novo_estado = 'B';
                $dsp_novo_estado = dsp_dominio(
                    'GE_ESTADO_FA',
                    $novo_estado,
                    $msg
                );
            } catch (Exception $ex) {
                $msg = "OBJ#2: " . $ex->getMessage();
            }
        }
    } elseif ($tp == 'OBS_OBJ' && $id != '' && $id_ficha != '') {
        try {
            $sql =
                "UPDATE RH_ID_AVALIACAO_OBJECTIVOS " .
                "SET COMENT_AVALIADO = :COMENT_AVALIADO_ " .
                "WHERE ID = :ID_ ";

            $stmt->bindParam(':COMENT_AVALIADO_', $valor, PDO::PARAM_STR);
            $stmt->bindParam(':ID_', $id, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "OBS_OBJ#1: " . $ex->getMessage();
        }

        if ($msg == '' && $estado == 'A') {
            try {
                $sql =
                    "UPDATE RH_AVALIADOR_FASES a " .
                    "SET ESTADO = 'B' " .
                    "WHERE a.EMPRESA = :EMPRESA_ " .
                    "  AND a.ID_PA = :ID_PA_ " .
                    "  AND a.DT_INI_PA = :DT_INI_PA_ " .
                    "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                    "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                    "  AND a.ID_FASE = :ID_FASE_ " .
                    "  AND a.DT_INI_FASE = :DT_INI_FASE_ " .
                    "  AND a.DT_INI_FPA = :DT_INI_FPA_ " .
                    "  AND a.RHID_AVALIADO = :RHID_ " .
                    "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                    "  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                    "  AND a.DT_INI_AF = :DT_INI_AF_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':ID_PROCESSO_AV_',
                    $id_proc_av_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(
                    ':DT_INI_PROCESSO_',
                    $dt_ini_proc_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':DT_INI_FASE_',
                    $dt_ini_fase_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':RHID_AVALIADOR_',
                    $rhid_avaliador_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->execute();

                $novo_estado = 'B';
                $dsp_novo_estado = dsp_dominio(
                    'GE_ESTADO_FA',
                    $novo_estado,
                    $msg
                );
            } catch (Exception $ex) {
                $msg = "OBS_OBJ#2: " . $ex->getMessage();
            }
        }
    } elseif ($tp == 'FICHA' && $id_ficha != '' && $valor != '') {
        if ($valor == 'F') {
            # rejeição da avaliação superior pela homologação

            # a ficha do avaliador é colocada novamente no estado de preenchimento com os comentários do homologador,
            try {
                $sql =
                    #"   ,OBS_1 = :OBS_1_ ".
                    "UPDATE RH_AVALIADOR_FASES a " .
                    "SET ESTADO = 'B' " .
                    "WHERE a.EMPRESA = :EMPRESA_ " .
                    "  AND a.ID_PA = :ID_PA_ " .
                    "  AND a.DT_INI_PA = :DT_INI_PA_ " .
                    "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                    "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                    "  AND a.ID_FASE = :ID_FASE_ " .
                    "  AND a.DT_INI_FASE = :DT_INI_FASE_ " .
                    "  AND a.DT_INI_FPA = :DT_INI_FPA_ " .
                    "  AND a.RHID_AVALIADO = :RHID_ " .
                    "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                    "  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                    "  AND a.DT_INI_AF = :DT_INI_AF_ ";

                $stmt = $db->prepare($sql);
                #$stmt->bindParam(':OBS_1_', $obs, PDO::PARAM_STR);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':ID_PROCESSO_AV_',
                    $id_proc_av_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(
                    ':DT_INI_PROCESSO_',
                    $dt_ini_proc_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':DT_INI_FASE_',
                    $dt_ini_fase_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':RHID_AVALIADOR_',
                    $rhid_avaliador_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "FICHA#1: " . $ex->getMessage();
            }

            if ($msg == '') {
                try {
                    $sql =
                        #"   ,OBS_1 = :OBS_1_ ".
                        "UPDATE RH_AVALIADOR_FASES a " .
                        "SET ESTADO = 'B' " .
                        "WHERE a.EMPRESA = :EMPRESA_ " .
                        "  AND a.ID_PA = :ID_PA_ " .
                        "  AND a.DT_INI_PA = :DT_INI_PA_ " .
                        "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                        "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                        "  AND a.ID_FASE = :ID_FASE_ " .
                        "  AND a.DT_INI_FASE = :DT_INI_FASE_ " .
                        "  AND a.DT_INI_FPA = :DT_INI_FPA_ " .
                        "  AND a.RHID_AVALIADO = :RHID_ " .
                        "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                        "  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                        "  AND a.DT_INI_AF = :DT_INI_AF_ ";

                    $stmt = $db->prepare($sql);
                    #$stmt->bindParam(':OBS_1_', $obs, PDO::PARAM_STR);
                    $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
                    $stmt->bindParam(
                        ':DT_INI_PA_',
                        $dt_ini_pa_,
                        PDO::PARAM_STR
                    );
                    $stmt->bindParam(
                        ':ID_PROCESSO_AV_',
                        $id_proc_av_,
                        PDO::PARAM_STR
                    );
                    $stmt->bindParam(
                        ':DT_INI_PROCESSO_',
                        $dt_ini_proc_,
                        PDO::PARAM_STR
                    );
                    $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                    $stmt->bindParam(
                        ':DT_INI_FASE_',
                        $dt_ini_fase_,
                        PDO::PARAM_STR
                    );
                    $stmt->bindParam(
                        ':DT_INI_FPA_',
                        $dt_ini_fpa_,
                        PDO::PARAM_STR
                    );
                    $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                    $stmt->bindParam(
                        ':RHID_AVALIADOR_',
                        $rhid_avaliador_,
                        PDO::PARAM_STR
                    );
                    $stmt->bindParam(
                        ':DT_INI_AF_',
                        $dt_ini_af_,
                        PDO::PARAM_STR
                    );
                    $stmt->execute();
                } catch (Exception $ex) {
                    $msg = "FICHA#2: " . $ex->getMessage();
                }
            }
        } else {
            try {
                $sql =
                    #"   ,OBS_1 = :OBS_1_ ".
                    "UPDATE RH_AVALIADOR_FASES a " .
                    "SET ESTADO = 'B' " .
                    "WHERE a.EMPRESA = :EMPRESA_ " .
                    "  AND a.ID_PA = :ID_PA_ " .
                    "  AND a.DT_INI_PA = :DT_INI_PA_ " .
                    "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                    "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                    "  AND a.ID_FASE = :ID_FASE_ " .
                    "  AND a.DT_INI_FASE = :DT_INI_FASE_ " .
                    "  AND a.DT_INI_FPA = :DT_INI_FPA_ " .
                    "  AND a.RHID_AVALIADO = :RHID_ " .
                    "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                    "  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                    "  AND a.DT_INI_AF = :DT_INI_AF_ ";

                $stmt = $db->prepare($sql);
                #$stmt->bindParam(':OBS_1_', $obs, PDO::PARAM_STR);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':ID_PROCESSO_AV_',
                    $id_proc_av_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(
                    ':DT_INI_PROCESSO_',
                    $dt_ini_proc_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':DT_INI_FASE_',
                    $dt_ini_fase_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                $stmt->bindParam(
                    ':RHID_AVALIADOR_',
                    $rhid_avaliador_,
                    PDO::PARAM_STR
                );
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "FICHA#3: " . $ex->getMessage();
            }
        }
    } else {
        $msg = $msg_insuficient_info;
    }

    ## output da mensagem
    if ($msg != '') {
        $dadosOut = array(
            "erro" => $msg
        );
    } else {
        if ($dsp_novo_estado != '') {
            $dadosOut = array(
                "erro" => "",
                "novo_estado" => $novo_estado,
                "dsp_novo_estado" => $dsp_novo_estado
            );
        } else {
            $dadosOut = array(
                "erro" => ""
            );
        }
    }
    echo json_encode($dadosOut);
}
# submeter ficha avaliação
elseif ($action == 'SUBMETER_FICHA') {
    # id da ficha
    $id_ficha = @$_REQUEST['id_ficha'];
    $param = explode("@", $id_ficha);
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

    /*
     * Estados da ficha de avaliação:
     * 
     * A    Criada
     * B    Em preenchimento
     * B0   Para Homologação
     * B1   Não Homologada
     * C    Submetida / Homologada
     * D    Encerrada
     * Z    Não aplicável
     */
    # estado anterior da ficha
    $estado_ant = @$_REQUEST['estado_ant'];
    
    # homogacao da ficha: se for nula, quer dizer que estamos na versão avaliador
    $homologuei = @$_REQUEST['homologuei']; // S - Sim, N - Não
    
    # observações
    $observacoes = urldecode(@$_REQUEST['obs']); 
    
    # indica se o processo de avaliação tem homologação de fichas
    $proc_homolog_ficha = @$_REQUEST['proc_homolog_ficha']; // S - Sim, N - Não

    $msg = '';
    $novo_estado = '';
    $dsp_novo_estado = '';
    $cnt = 0;
    
    //          
    // sem homologação de ficha ($proc_homolog_ficha = 'N'): 
    //      A ou B => C
    // 
    // com homologação de ficha ($proc_homolog_ficha = 'S'): 
    //      versão "Avaliador": A ou B ou B1 => B0
    //      versão "Homologador":
    //          Se Estado = B0 e Homologado = SIM => C
    //          Se Estado = B0 e Homologado = NAO => B1
    //          
    // 
    if ($proc_homolog_ficha == 'S') {

        # versão "Avaliador"
        if ($homologuei == '') {
            if ($estado_ant == 'A' || $estado_ant == 'B' || $estado_ant = 'B1') {
                $novo_estado = 'B0';
            } 
        } 
        # versão "Homologador":
        else {
            if ($estado_ant == 'B0' && ($homologuei == 'S' || $homologuei == 'N')) {
                if ($homologuei == 'S') {
                    $novo_estado = 'C';
                }
                else {
                    $novo_estado = 'B1';
                }
            }
        }
    } 
    else {
        $novo_estado = 'C';
    }
    
    if ($novo_estado == '') {
        $msg = $hint_invalid_state_contact_support;
    } elseif ($observacoes == '') {
        # mensagem a indicar que deve preencher as observacoes
        $msg = $msg_obs_required;
    }

#$msg = "STOP proc_homolog_ficha:$proc_homolog_ficha  homologuei:$homologuei estado_ant:$estado_ant NOVO_ESTADO:$novo_estado obs_homolog:[$obs_homolog] ficha:$id_ficha";

    # verificar se a ficha se encontra todas preenchida
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != '' &&
        $rhid_ != '' &&
        $dt_adm_ != '' &&
        $rhid_avaliador_ != '' &&
        $id_fase_ != '' &&
        $dt_ini_fase_ != '' &&
        $dt_ini_fpa_ != '' &&
        $dt_ini_af_ != '' &&
        $msg == ''
    ) {
        try {
            $sql =
                "SELECT COUNT(*) CNT " .
                "FROM RH_FICHA_AVAL_COMPORTAMENTOS a " .
                "WHERE a.EMPRESA = :EMPRESA_ " .
                "  AND a.ID_PA = :ID_PA_ " .
                "  AND a.DT_INI_PA = :DT_INI_PA_ " .
                "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                "  AND a.ID_FASE = :ID_FASE_ " .
                "  AND a.DT_INI_FASE = :DT_INI_FASE_ " .
                "  AND a.DT_INI_FPA = :DT_INI_FPA_ " .
                "  AND a.RHID_AVALIADO = :RHID_ " .
                "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                "  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                "  AND a.DT_INI_AF = :DT_INI_AF_ " .
                "  AND (a.ID_NV_AF IS NULL " .
                "   OR  a.ID_EP_NV_AF IS NULL " .
                "   OR  a.DT_INI_NV_AF IS NULL " .
                "   OR  a.DT_INI_EP_NV_AF IS NULL) ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_av_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_',$dt_ini_proc_,PDO::PARAM_STR);
            $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_AVALIADOR_',$rhid_avaliador_,PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['CNT'] > 0) {
                $cnt += $row['CNT'];
            }

            $sql =
                "SELECT COUNT(*) CNT " .
                "FROM RH_ID_AVALIACAO_OBJECTIVOS a " .
                "WHERE a.EMPRESA = :EMPRESA_ " .
                "  AND a.ID_PA = :ID_PA_ " .
                "  AND a.DT_INI_PA = :DT_INI_PA_ " .
                "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                "  AND a.ID_FASE = :ID_FASE_ " .
                "  AND a.DT_INI_FASE = :DT_INI_FASE_ " .
                "  AND a.DT_INI_FPA = :DT_INI_FPA_ " .
                "  AND a.RHID_AVALIADO = :RHID_ " .
                "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                "  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                "  AND a.DT_INI_AF = :DT_INI_AF_ " .
                "  AND ((a.ID_NV_ESCALA_AF IS NULL " .
                "   OR   a.ID_EP_AF IS NULL " .
                "   OR   a.DT_INI_NV_ESCALA_AF IS NULL " .
                "   OR   a.DT_INI_EP_AF IS NULL) " .
                "  AND a.VLR_ATRIBUIDO IS NULL) ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_av_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['CNT'] > 0) {
                $cnt += $row['CNT'];
            }

            if ($cnt > 0) {
                $msg = $msg_answers_to_give;
            }
        } catch (Exception $ex) {
            $msg = "SUBMETER_FICHA#1: " . $ex->getMessage();
        }
    }

    # calcular os resultados da ficha submetida
    # esta operação só é efetuada para fichas que são submetidas ($novo_estado = 'C')
    if ($msg == '' && $novo_estado == 'C') {
        calculo_ficha_avaliacao(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $rhid_,
            $dt_adm_,
            $rhid_avaliador_,
            $id_fase_,
            $dt_ini_fase_,
            $dt_ini_fpa_,
            $dt_ini_af_,
            '',
            $msg
        );
    }

    # atualiza estado da ficha de avaliação
    if ($msg == '') {
        try {
            # modelo com homologação de fichas de avaliação
            if ($proc_homolog_ficha == 'S') {
            
                # homologação de fichas de avaliação
                if ($homologuei != '') {
                    $sql =
                        "UPDATE RH_AVALIADOR_FASES a " .
                        "SET ESTADO = :NOVO_ESTADO_ " .
                        "   ,OBS_HOMOLOGADOR = :OBS_ " .    
                        "   ,RHID_HOMOLOGADOR = :RHID_HOMOLOG_ " .    
                        "   ,DT_HR_HOMOLOGADOR = SYSDATE() " .
                        "WHERE a.EMPRESA = :EMPRESA_ " .
                        "  AND a.ID_PA = :ID_PA_ " .
                        "  AND a.DT_INI_PA = :DT_INI_PA_ " .
                        "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                        "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                        "  AND a.ID_FASE = :ID_FASE_ " .
                        "  AND a.DT_INI_FASE = :DT_INI_FASE_ " .
                        "  AND a.DT_INI_FPA = :DT_INI_FPA_ " .
                        "  AND a.RHID_AVALIADO = :RHID_ " .
                        "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                        "  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                        "  AND a.DT_INI_AF = :DT_INI_AF_ ";
                }
                # preenchimento da ficha de avaliação
                else {
                    $sql =
                        "UPDATE RH_AVALIADOR_FASES a " .
                        "SET ESTADO = :NOVO_ESTADO_ " .
                        "   ,DT_HR_AVALIADOR = SYSDATE() " .
                        "WHERE a.EMPRESA = :EMPRESA_ " .
                        "  AND a.ID_PA = :ID_PA_ " .
                        "  AND a.DT_INI_PA = :DT_INI_PA_ " .
                        "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                        "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                        "  AND a.ID_FASE = :ID_FASE_ " .
                        "  AND a.DT_INI_FASE = :DT_INI_FASE_ " .
                        "  AND a.DT_INI_FPA = :DT_INI_FPA_ " .
                        "  AND a.RHID_AVALIADO = :RHID_ " .
                        "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                        "  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                        "  AND a.DT_INI_AF = :DT_INI_AF_ ";
                }

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_av_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->bindParam(':NOVO_ESTADO_', $novo_estado, PDO::PARAM_STR);
                if ($homologuei != '') {
                    if ($observacoes != '') {
                        $stmt->bindParam(':OBS_', $observacoes, PDO::PARAM_STR);
                    }
                    else {
                        $nulo = null;
                        $stmt->bindParam(':OBS_', $nulo, PDO::PARAM_NULL);
                    }
                    $stmt->bindParam(':RHID_HOMOLOG_', @$_SESSION['rhid'], PDO::PARAM_STR);
                }
            } 
            # modelo sem homologação de fichas de avaliaçãp
            else {
                    $sql =
                        "UPDATE RH_AVALIADOR_FASES a " .
                        "SET ESTADO = :NOVO_ESTADO_ " .
                        "WHERE a.EMPRESA = :EMPRESA_ " .
                        "  AND a.ID_PA = :ID_PA_ " .
                        "  AND a.DT_INI_PA = :DT_INI_PA_ " .
                        "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                        "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                        "  AND a.ID_FASE = :ID_FASE_ " .
                        "  AND a.DT_INI_FASE = :DT_INI_FASE_ " .
                        "  AND a.DT_INI_FPA = :DT_INI_FPA_ " .
                        "  AND a.RHID_AVALIADO = :RHID_ " .
                        "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                        "  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                        "  AND a.DT_INI_AF = :DT_INI_AF_ ";
                    
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_av_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->bindParam(':NOVO_ESTADO_', $novo_estado, PDO::PARAM_STR);
            }
            
            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "SUBMETER_FICHA#2: " . $ex->getMessage();
        }
    }
         
    # no caso do avaliador, caso existam observações, deverá grava-las
    if ($msg == '' && $homologuei == '' && $observacoes != '') {
        try {
            $sql =
                "UPDATE RH_AVALIADORES a " .
                "SET COMENTARIO = :OBS_ " .
                "WHERE a.EMPRESA = :EMPRESA_ " .
                "  AND a.ID_PA = :ID_PA_ " .
                "  AND a.DT_INI_PA = :DT_INI_PA_ " .
                "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                "  AND a.RHID_AVALIADO = :RHID_ " .
                "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                "  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_av_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
            $stmt->bindParam(':OBS_', $observacoes, PDO::PARAM_STR);

            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "SUBMETER_FICHA#3: " . $ex->getMessage();
        }
    }

    # gera pdi para ficha submetida
    if ($msg == '' && $novo_estado == 'C') {
        get_pdi_automatico(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $rhid_,
            $dt_adm_,
            $msg
        );
    }

    ## output da mensagem
    if ($msg != '') {
        $dadosOut = array(
            "erro" => $msg
        );
    } else {
        $dsp_novo_estado = dsp_dominio('GE_ESTADO_FA', $novo_estado, $msg);
        $dadosOut = array(
            "erro" => $msg,
            "novo_estado" => $novo_estado,
            "dsp_novo_estado" => $dsp_novo_estado
        );
    }
    echo json_encode($dadosOut);
}
# reabrir ficha avaliação
elseif ($action == 'REABRIR_FICHA') {
    # id da ficha
    $id_ficha = $request_data_;
    $param = explode("@", $id_ficha);
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

    $msg = '';
    $novo_estado = '';
    $dsp_novo_estado = '';

    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != '' &&
        $rhid_ != '' &&
        $dt_adm_ != '' &&
        $rhid_avaliador_ != '' &&
        $id_fase_ != '' &&
        $dt_ini_fase_ != '' &&
        $dt_ini_fpa_ != '' &&
        $dt_ini_af_ != ''
    ) {
        try {
            $sql =
                "UPDATE RH_AVALIADOR_FASES a " .
                "SET ESTADO = 'B' " .
                "WHERE a.EMPRESA = :EMPRESA_ " .
                "  AND a.ID_PA = :ID_PA_ " .
                "  AND a.DT_INI_PA = :DT_INI_PA_ " .
                "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                "  AND a.ID_FASE = :ID_FASE_ " .
                "  AND a.DT_INI_FASE = :DT_INI_FASE_ " .
                "  AND a.DT_INI_FPA = :DT_INI_FPA_ " .
                "  AND a.RHID_AVALIADO = :RHID_ " .
                "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                "  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                "  AND a.DT_INI_AF = :DT_INI_AF_ ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_av_, PDO::PARAM_STR);
            $stmt->bindParam(
                ':DT_INI_PROCESSO_',
                $dt_ini_proc_,
                PDO::PARAM_STR
            );
            $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
            $stmt->bindParam(
                ':RHID_AVALIADOR_',
                $rhid_avaliador_,
                PDO::PARAM_STR
            );
            $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
            $stmt->execute();

            $novo_estado = 'B';
            $dsp_novo_estado = dsp_dominio('GE_ESTADO_FA', $novo_estado, $msg);
        } catch (Exception $ex) {
            $msg = "REBRIR_FICHA#1: " . $ex->getMessage();
        }
    }

    ## output da mensagem
    if ($msg != '') {
        $dadosOut = array(
            "erro" => $msg
        );
    } else {
        if ($dsp_novo_estado != '') {
            $dadosOut = array(
                "erro" => "",
                "novo_estado" => $novo_estado,
                "dsp_novo_estado" => $dsp_novo_estado
            );
        } else {
            $dadosOut = array(
                "erro" => ""
            );
        }
    }
    echo json_encode($dadosOut);
}
# gravar concordãncia
elseif ($action == 'GRAVAR_CONCORDANCIA') {
    # id da ficha
    $id_ficha = @$_REQUEST['id_ficha'];
    $param = explode("@", $id_ficha);
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

    $tipo = @$_REQUEST['tipo'];
    $ok = @$_REQUEST['ok'];
    $obs = urldecode(@$_REQUEST['obs']);

    $msg = '';
    #echo "#empresa_ && $id_pa_ && $dt_ini_pa_ && $id_proc_av_ && $dt_ini_proc_ && $rhid_ && $dt_adm_ && $rhid_avaliador_ && $id_fase_ && $dt_ini_fase_ && $dt_ini_fpa_  && $dt_ini_af_  && $tipo";
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != '' &&
        $rhid_ != '' &&
        $dt_adm_ != '' &&
        $rhid_avaliador_ != '' &&
        $id_fase_ != '' &&
        $dt_ini_fase_ != '' &&
        $dt_ini_fpa_ != '' &&
        $dt_ini_af_ != '' &&
        $tipo != ''
    ) {
        $novo_estado = '';
        $dsp_novo_estado = '';
        if ($tipo == 'AVALIADO') {
            try {
                $sql =  "UPDATE RH_AVALIADOS " .
                        "SET COMENTARIO = :COMENTARIO_ ";
                
                if ($ok != '') {
                    $sql .= "   ,CONCORDANCIA = :CONCORDANCIA_ ";
                }
                
                $sql .= "WHERE EMPRESA = :EMPRESA_ " .
                        "  AND ID_PA = :ID_PA_ " .
                        "  AND DT_INI_PA = :DT_INI_PA_ " .
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                        "  AND RHID = :RHID_ " .
                        "  AND DT_ADMISSAO = :DT_ADMISSAO_ ";
                

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':COMENTARIO_', $obs, PDO::PARAM_STR);
                if ($ok != '') {
                    $stmt->bindParam(':CONCORDANCIA_', $ok, PDO::PARAM_STR);
                }
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_av_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "CONCORDANCIA#1: " . $ex->getMessage();
            }
            
            if ($msg == '') {
                try {
                    $novo_estado = 'D';
                    $dsp_novo_estado = dsp_dominio('GE_ESTADO_FA', $novo_estado, $msg);
                    
                    $sql =  "UPDATE RH_AVALIADOR_FASES " .
                            "SET ESTADO = :ESTADO_ ".
                            "WHERE EMPRESA = :EMPRESA_ " .
                            "  AND ID_PA = :ID_PA_ " .
                            "  AND DT_INI_PA = :DT_INI_PA_ " .
                            "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                            "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                            "  AND RHID_AVALIADO = :RHID_ " .
                            "  AND RHID_AVALIADO != RHID_AVALIADOR " .
                            "  AND ESTADO != 'Z' ";

                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_av_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                    $stmt->bindParam(':ESTADO_', $novo_estado, PDO::PARAM_STR);
                    $stmt->execute();
                    
                } catch (Exception $ex) {
                    $msg = "CONCORDANCIA#2: " . $ex->getMessage();
                }
            }
            
        } 
        elseif ($tipo == 'AVALIADOR') {
            try {
                $sql =  "UPDATE RH_AVALIADORES " .
                        "SET COMENTARIO = :COMENTARIO_ ";
                
                if ($ok != '') {
                    $sql .= "   ,CONCORDANCIA = :CONCORDANCIA_ ";
                }
                
                $sql .= "WHERE EMPRESA = :EMPRESA_ " .
                        "  AND ID_PA = :ID_PA_ " .
                        "  AND DT_INI_PA = :DT_INI_PA_ " .
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                        "  AND RHID_AVALIADO = :RHID_AVALIADO_ " .
                        "  AND DT_ADMISSAO = :DT_ADMISSAO_ ".
                        "  AND RHID_AVALIADOR = :RHID_AVALIADOR_ ";
                        
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':COMENTARIO_', $obs, PDO::PARAM_STR);
                if ($ok != '') {
                    $stmt->bindParam(':CONCORDANCIA_', $ok, PDO::PARAM_STR);
                }
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_',$id_proc_av_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "CONCORDANCIA#2: " . $ex->getMessage();
            }
        }
    }

    ## output da mensagem
    if ($msg != '') {
        $dadosOut = array(
            "erro" => $msg
        );
    } else {
        $dadosOut = array(
            "erro" => "",
            "msg" => $ui_successful_operation,
            "novo_estado" => $novo_estado,
            "dsp_novo_estado" => $dsp_novo_estado
        );
    }
    echo json_encode($dadosOut);
}
# delegação da avaliação
elseif ($action == 'DELEGACAO') {
    $id = @$_REQUEST['id'];
    $rhid_avaliador = @$_REQUEST['rhid_aval'];
    $pub_ficha = @$_REQUEST['pub_ficha'];

    $obs = '';
    $rhid_old_avaliador = '';
    $rhid_new_avaliador = $rhid_avaliador;
    $ctrl = 0;
    $reg = array();

    try {
        $sql = "SELECT * FROM MASTER_AVALIACAO " . "WHERE ID_FICHA = :ID_  ";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':ID_', $id, PDO::PARAM_STR);
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "DELEGACAO#1: " . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $rhid_old_avaliador = $row['RHID_AVALIADOR'];

                if ($row['RHID_AVALIADOR'] == @$_SESSION['rhid']) {
                    $obs =
                        "Ficha delegada pelo avaliador " .
                        $row['RHID_AVALIADOR'] .
                        " - " .
                        $row['NOME_AVALIADOR'] .
                        " para o avaliador rhid " .
                        $rhid_avaliador .
                        " - " .
                        dsp_nome_colab($rhid_avaliador, 'C', $msg) .
                        " em " .
                        date("Y-m-d H:i") .
                        ".";
                } else {
                    $obs =
                        "Ficha delegada " .
                        " para o avaliador rhid " .
                        $rhid_avaliador .
                        " - " .
                        dsp_nome_colab($rhid_avaliador, 'C', $msg) .
                        " em " .
                        date("Y-m-d H:i") .
                        ".";
                }
            }
        } catch (Exception $ex) {
            $msg = "DELEGACAO#2: " . $ex->getMessage();
        }
    }

    if ($msg == '') {
        try {
            # verifica se o novo avaliador já se encontra definido neste processo para este avaliado...
            $sql =
                "SELECT * FROM RH_AVALIADORES " .
                "WHERE (EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO,RHID_AVALIADO,DT_ADMISSAO) IN " .
                "      (SELECT DISTINCT EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO,RHID_AVALIADO,DT_ADMISSAO " .
                "	 FROM RH_AVALIADOR_FASES a " .
                "       WHERE a.EMPRESA = :EMPRESA_ " .
                "         AND a.ID_PA = :ID_PA_ " .
                "         AND a.DT_INI_PA = :DT_INI_PA_ " .
                "         AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                "         AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                "         AND a.ID_FASE = :ID_FASE_ " .
                "         AND a.DT_INI_FASE = :DT_INI_FASE_ " .
                "         AND a.DT_INI_FPA = :DT_INI_FPA_ " .
                "         AND a.RHID_AVALIADO = :RHID_ " .
                "         AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                "         AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                "         AND a.DT_INI_AF = :DT_INI_AF_) ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':PUB_FICHA_', $pub_ficha, PDO::PARAM_STR);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_av_, PDO::PARAM_STR);
            $stmt->bindParam(
                ':DT_INI_PROCESSO_',
                $dt_ini_proc_,
                PDO::PARAM_STR
            );
            $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
            $stmt->bindParam(
                ':RHID_AVALIADOR_',
                $rhid_avaliador_,
                PDO::PARAM_STR
            );
            $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $reg = $row;
                if ($row['RHID_AVALIADOR'] == $rhid_avaliador) {
                    $ctrl = 1;
                    break;
                }
            }
        } catch (Exception $ex) {
            $msg = "DELEGACAO#3: " . $ex->getMessage();
        }
    }

    ## não existe
    if ($ctrl == 0 && count($reg) > 0 && $msg == '') {
        try {
            $sql1 =
                "INSERT INTO RH_AVALIADORES " .
                "(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO," .
                " RHID_AVALIADO,DT_ADMISSAO, RHID_AVALIADOR, DT_INI_AVALIADOR, NR_ORDEM, FICHA) " .
                "VALUES(:EMPRESA_,:ID_PA_,:DT_INI_PA_,:ID_PROCESSO_AV_,:DT_INI_PROCESSO_," .
                ":RHID_AVALIADO_,:DT_ADMISSAO_,:RHID_AVALIADOR_,QUADDATE(),1,'S')";

            $stmt1 = $db->prepare($sql1);
            $stmt1->bindParam(':EMPRESA_', $row['EMPRESA'], PDO::PARAM_STR);
            $stmt1->bindParam(':ID_PA_', $row['ID_PA'], PDO::PARAM_STR);
            $stmt1->bindParam(':DT_INI_PA_', $row['DT_INI_PA'], PDO::PARAM_STR);
            $stmt1->bindParam(
                ':ID_PROCESSO_AV_',
                $row['ID_PROCESSO_AV'],
                PDO::PARAM_STR
            );
            $stmt1->bindParam(
                ':DT_INI_PROCESSO_',
                $row['DT_INI_PROCESSO'],
                PDO::PARAM_STR
            );
            $stmt1->bindParam(
                ':RHID_AVALIADO_',
                $row['RHID_AVALIADO'],
                PDO::PARAM_STR
            );
            $stmt1->bindParam(
                ':DT_ADMISSAO_',
                $row['DT_ADMISSAO'],
                PDO::PARAM_STR
            );
            $stmt1->bindParam(
                ':RHID_AVALIADOR_',
                $row['RHID_AVALIADOR'],
                PDO::PARAM_STR
            );
            $stmt1->execute();
        } catch (Exception $ex) {
            $msg = "DELEGACAO#4: " . $ex->getMessage();
        }
    }

    if ($msg == '') {
        try {
            $sql =
                "UPDATE RH_AVALIADOR_FASES a " .
                "SET RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                "WHERE a.EMPRESA = :EMPRESA_ " .
                "  AND a.ID_PA = :ID_PA_ " .
                "  AND a.DT_INI_PA = :DT_INI_PA_ " .
                "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ " .
                "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ " .
                "  AND a.ID_FASE = :ID_FASE_ " .
                "  AND a.DT_INI_FASE = :DT_INI_FASE_ " .
                "  AND a.DT_INI_FPA = :DT_INI_FPA_ " .
                "  AND a.RHID_AVALIADO = :RHID_ " .
                "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ " .
                "  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ " .
                "  AND a.DT_INI_AF = :DT_INI_AF_ ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(
                ':RHID_AVALIADOR_',
                $rhid_avaliador,
                PDO::PARAM_STR
            );
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_av_, PDO::PARAM_STR);
            $stmt->bindParam(
                ':DT_INI_PROCESSO_',
                $dt_ini_proc_,
                PDO::PARAM_STR
            );
            $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
            $stmt->bindParam(
                ':RHID_AVALIADOR_',
                $rhid_avaliador_,
                PDO::PARAM_STR
            );
            $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "DELEGACAO#5: " . $ex->getMessage();
        }

        if ($msg == '') {
            #notificacao_delegacao($id, $rhid_new_avaliador, $rhid_old_avaliador, $msg);
        }
    }

    ## output da mensagem
    if ($msg != '') {
        #      $dadosOut = array(
        #          "msg" => $msg
        #      );
        echo $msg;
    }
}
# geração matriz de intervenção
elseif ($action == 'GERACAO_MATRIZ_INTERVENCAO') {
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != ''
    ) {
        $msg_ = '';
        build_fases_fontes_proposal(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $msg_
        );

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
# Identificação Avaliados
elseif ($action == 'IDENTIFICACAO_AVALIADOS') {
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != ''
    ) {
        $msg_ = '';
        $colabs = $colabs_;
        $estabs = '';
        $setores = '';
        $direcoes = '';
        $departs = '';
        $estruts = '';
        $funcoes = '';
        $grupos_func = '';
        $lim_meses_serv = '';
        $vincs = '';
        $sits = '';
        $estado = '';
        $dsp_estado = '';
        get_avaliados(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $colabs,
            $estabs,
            $setores,
            $direcoes,
            $departs,
            $estruts,
            $funcoes,
            $grupos_func,
            $vincs,
            $sits,
            $lim_meses_serv,
            $msg_
        );

        if ($msg_ == '') {
            get_estado_processo(
                $empresa_,
                $id_pa_,
                $dt_ini_pa_,
                $id_proc_av_,
                $dt_ini_proc_,
                $estado,
                $dsp_estado,
                $msg_
            );
        }

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation,
                "estado" => $estado,
                "dsp_estado" => $dsp_estado
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => "",
                "estado" => "",
                "dsp_estado" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
# Remoção Avaliados
elseif ($action == 'REMOCAO_AVALIADOS') {
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != ''
    ) {
        $msg_ = '';
        $grpfunc_ = '';
        $func_ = '';
        $estrut_ = '';
        $sit_ = '';
        $estab_ = '';
        $dir_ = '';
        $dep_ = '';
        $set_ = '';
        $vinc_ = '';
        $rhid_avaliado_ = '';

        remove_avaliados(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $grpfunc_,
            $func_,
            $estrut_,
            $sit_,
            $estab_,
            $dir_,
            $dep_,
            $set_,
            $vinc_,
            $rhid_avaliado_,
            $msg_
        );

        if ($msg_ == '') {
            get_estado_processo(
                $empresa_,
                $id_pa_,
                $dt_ini_pa_,
                $id_proc_av_,
                $dt_ini_proc_,
                $estado,
                $dsp_estado,
                $msg_
            );
        }

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation,
                "estado" => $estado,
                "dsp_estado" => $dsp_estado
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => "",
                "estado" => "",
                "dsp_estado" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
# Selecção Avaliadores
elseif ($action == 'SELECCAO_AVALIADORES') {
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != ''
    ) {
        $msg_ = '';
        get_avaliadores(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $msg_
        );

        if ($msg_ == '') {
            get_estado_processo(
                $empresa_,
                $id_pa_,
                $dt_ini_pa_,
                $id_proc_av_,
                $dt_ini_proc_,
                $estado,
                $dsp_estado,
                $msg_
            );
        }

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation,
                "estado" => $estado,
                "dsp_estado" => $dsp_estado
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => "",
                "estado" => "",
                "dsp_estado" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
# Remoção Avaliadores
elseif ($action == 'REMOCAO_AVALIADORES') {
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != ''
    ) {
        $msg_ = '';
        $grpfunc_ = '';
        $func_ = '';
        $estrut_ = '';
        $sit_ = '';
        $estab_ = '';
        $dir_ = '';
        $dep_ = '';
        $set_ = '';
        $vinc_ = '';
        $rhid_avaliado_ = '';
        $rhid_avaliador_ = '';

        remove_avaliadores(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $grpfunc_,
            $func_,
            $estrut_,
            $sit_,
            $estab_,
            $dir_,
            $dep_,
            $set_,
            $vinc_,
            $rhid_avaliado_,
            $rhid_avaliador_,
            $msg_
        );

        if ($msg_ == '') {
            get_estado_processo(
                $empresa_,
                $id_pa_,
                $dt_ini_pa_,
                $id_proc_av_,
                $dt_ini_proc_,
                $estado,
                $dsp_estado,
                $msg_
            );
        }

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation,
                "estado" => $estado,
                "dsp_estado" => $dsp_estado
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => "",
                "estado" => "",
                "dsp_estado" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
# Distribuição Avaliadores p/ Fases
elseif ($action == 'DISTRIB_AVALIADORES_FASES') {
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != ''
    ) {
        $msg_ = '';
        get_avaliadores_fase(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $msg_
        );

        if ($msg_ == '') {
            get_estado_processo(
                $empresa_,
                $id_pa_,
                $dt_ini_pa_,
                $id_proc_av_,
                $dt_ini_proc_,
                $estado,
                $dsp_estado,
                $msg_
            );
        }

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation,
                "estado" => $estado,
                "dsp_estado" => $dsp_estado
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => "",
                "estado" => "",
                "dsp_estado" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
# Remoção Avaliadores p/ Fases
elseif ($action == 'REMOCAO_AVALIADORES_FASES') {
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != ''
    ) {
        $msg_ = '';
        $grpfunc_ = '';
        $func_ = '';
        $estrut_ = '';
        $sit_ = '';
        $estab_ = '';
        $dir_ = '';
        $dep_ = '';
        $set_ = '';
        $vinc_ = '';
        $fase = '';
        $rhid_avaliado_ = '';
        $rhid_avaliador_ = '';
        remove_avaliadores_fases(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $grpfunc_,
            $func_,
            $estrut_,
            $sit_,
            $estab_,
            $dir_,
            $dep_,
            $set_,
            $vinc_,
            $fase_,
            $rhid_avaliado_,
            $rhid_avaliador_,
            $msg_
        );

        if ($msg_ == '') {
            get_estado_processo(
                $empresa_,
                $id_pa_,
                $dt_ini_pa_,
                $id_proc_av_,
                $dt_ini_proc_,
                $estado,
                $dsp_estado,
                $msg_
            );
        }

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation,
                "estado" => $estado,
                "dsp_estado" => $dsp_estado
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => "",
                "estado" => "",
                "dsp_estado" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
# Geração Fichas Avaliação
elseif ($action == 'GERACAO_FICHAS_AVAL') {
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != ''
    ) {
        $msg_ = '';
        get_fichas_avaliacao(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $msg_
        );

        if ($msg_ == '') {
            get_estado_processo(
                $empresa_,
                $id_pa_,
                $dt_ini_pa_,
                $id_proc_av_,
                $dt_ini_proc_,
                $estado,
                $dsp_estado,
                $msg_
            );
        }

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation,
                "estado" => $estado,
                "dsp_estado" => $dsp_estado
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => "",
                "estado" => "",
                "dsp_estado" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
# Remoção Fichas Avaliação
elseif ($action == 'REMOCAO_FICHAS_AVAL') {
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != ''
    ) {
        $msg_ = '';
        $grpfunc_ = '';
        $func_ = '';
        $estrut_ = '';
        $sit_ = '';
        $estab_ = '';
        $dir_ = '';
        $dep_ = '';
        $set_ = '';
        $vinc_ = '';
        $fase = '';
        $rhid_avaliado_ = '';
        $rhid_avaliador_ = '';
        remove_fichas_avaliacao(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            '',
            $grpfunc_,
            $func_,
            $estrut_,
            $sit_,
            $estab_,
            $dir_,
            $dep_,
            $set_,
            $vinc_,
            $fase_,
            $rhid_avaliado_,
            $rhid_avaliador_,
            $msg_
        );

        if ($msg_ == '') {
            get_estado_processo(
                $empresa_,
                $id_pa_,
                $dt_ini_pa_,
                $id_proc_av_,
                $dt_ini_proc_,
                $estado,
                $dsp_estado,
                $msg_
            );
        }

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation,
                "estado" => $estado,
                "dsp_estado" => $dsp_estado
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => "",
                "estado" => "",
                "dsp_estado" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
# Gerar PDI
elseif ($action == 'GERACAO_PDI') {
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != '' &&
        $rhid_avaliado_ != '' &&
        $dt_adm_avaliado_ != ''
    ) {
        $msg_ = '';
        get_pdi(
            '',
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $rhid_avaliado_,
            $dt_adm_avaliado_,
            $msg_
        );

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation
                #                    "estado" => $estado,
                #                    "dsp_estado" => $dsp_estado
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => ""
                #                    "estado" => "",
                #                    "dsp_estado" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
# Gerar massivamente PDI
elseif ($action == 'GERACAO_MASSIVA_PDI') {
    if ($where_ != '') {
        $msg_ = '';
        get_pdi($where_, '', '', '', '', '', '', '', $msg_);

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation
                #                    "estado" => $estado,
                #                    "dsp_estado" => $dsp_estado
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => ""
                #                    "estado" => "",
                #                    "dsp_estado" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
# Publicação de resultados
elseif ($action == 'PUB_RESULTADOS') {
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != ''
    ) {
        $msg_ = '';
        publica_resultados(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $msg_
        );

        if ($msg_ == '') {
            get_estado_processo(
                $empresa_,
                $id_pa_,
                $dt_ini_pa_,
                $id_proc_av_,
                $dt_ini_proc_,
                $estado,
                $dsp_estado,
                $msg_
            );
        }

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation,
                "estado" => $estado,
                "dsp_estado" => $dsp_estado
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => "",
                "estado" => "",
                "dsp_estado" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
# Publicação de resultados
elseif ($action == 'UNPUB_RESULTADOS') {
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != ''
    ) {
        $msg_ = '';
        despublica_resultados(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $msg_
        );

        if ($msg_ == '') {
            get_estado_processo(
                $empresa_,
                $id_pa_,
                $dt_ini_pa_,
                $id_proc_av_,
                $dt_ini_proc_,
                $estado,
                $dsp_estado,
                $msg_
            );
        }

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation,
                "estado" => $estado,
                "dsp_estado" => $dsp_estado
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => "",
                "estado" => "",
                "dsp_estado" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
# Remoção de UM Avaliado
elseif ($action == 'REMOCAO_AVALIADO') {

//    $dados = json_decode(@$_REQUEST['dados']);
//    $empresa_ = $dados->empresa;
//    $id_pa_ = $dados->id_pa;
//    $dt_ini_pa_ = $dados->dt_ini_pa;
//    $id_proc_av_ = $dados->id_proc_av;
//    $dt_ini_proc_ = $dados->dt_ini_proc;
//    $rhid_avaliado_ = $dados->rhid_avaliado;
    
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != '' &&
        $rhid_avaliado_ != ''
    ) {
        $msg_ = '';

        remove_avaliado(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $rhid_avaliado_,
            $msg_
        );

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
# Troca avaliador para UM Avaliado
elseif ($action == 'TROCA_AVALIADOR') {
    
//    $dados = json_decode(@$_REQUEST['dados']);
//    $empresa_ = $dados->empresa;
//    $id_pa_ = $dados->id_pa;
//    $dt_ini_pa_ = $dados->dt_ini_pa;
//    $id_proc_av_ = $dados->id_proc_av;
//    $dt_ini_proc_ = $dados->dt_ini_proc;
//    $rhid_avaliado_ = $dados->rhid_avaliado;
//    $rhid_old_avaliador_ = $dados->rhid_old_avaliador;
//    $rhid_new_avaliador_ = $dados->rhid_new_avaliador;
    
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != '' &&
        $rhid_avaliado_ != '' &&
        $rhid_old_avaliador_ != '' &&
        $rhid_new_avaliador_ != ''
    ) {
        $msg_ = '';

        troca_avaliador(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $rhid_avaliado_,
            $rhid_old_avaliador_,
            $rhid_new_avaliador_,
            $msg_
        );

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
# Atualiza estado da ficha de avaliacao
elseif ($action == 'ATUALIZA_ESTADO_FICHA') {
    
//    $dados = json_decode(@$_REQUEST['dados']);
//    $empresa_ = $dados->empresa;
//    $id_pa_ = $dados->id_pa;
//    $dt_ini_pa_ = $dados->dt_ini_pa;
//    $id_proc_av_ = $dados->id_proc_av;
//    $dt_ini_proc_ = $dados->dt_ini_proc;
//    $id_fase_ = $dados->id_fase;
//    $dt_ini_fase_ = $dados->dt_ini_fase;
//    $dt_ini_fpa_ = $dados->dt_ini_fpa;
//    $rhid_avaliado_ = $dados->rhid_avaliado;
//    $dt_adm_avaliado_ = $dados->dt_adm_avaliado;
//    $rhid_avaliador_ = $dados->rhid_avaliador;
//    $estado_ = $dados->estado;
    
    if (
        $empresa_ != '' &&
        $id_pa_ != '' &&
        $dt_ini_pa_ != '' &&
        $id_proc_av_ != '' &&
        $dt_ini_proc_ != '' &&
        $id_fase_ != '' &&
        $dt_ini_fase_ != '' &&
        $dt_ini_fpa_ != '' &&
        $rhid_avaliado_ != '' &&
        $dt_adm_avaliado_ != '' &&
        $rhid_avaliador_ != '' &&
        $estado_ != ''    
    ) {
        $msg_ = '';

        actualiza_estado_fase(
            $empresa_,
            $id_pa_,
            $dt_ini_pa_,
            $id_proc_av_,
            $dt_ini_proc_,
            $id_fase_, 
            $dt_ini_fase_,
            $dt_ini_fpa_,
            $rhid_avaliado_,
            $dt_adm_avaliado_,
            $rhid_avaliador_,
            $estado_,
            $msg_
        );

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
?>


 