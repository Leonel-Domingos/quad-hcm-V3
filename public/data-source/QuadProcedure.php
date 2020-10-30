<?php
class QuadProcedure
{

    #
    # instânciação a classe QuadProcedure
    #
    #   $reference -  referência do procedimento a executar
    #
    #   $data -  json contendo a informação do pedido
    #   
    #       "operation" : PROCEDURE
    #       "data": dados do pedido em formato JSON 
    #
    #               exemplo: {
    #                           "desporto_key":"001@1900-01-01",
    #                           "dt_inicio":"2019-11-28",
    #                           "setores":[
    #                                       "DECATHLON@1071@001@2015-04-01",
    #                                       "DECATHLON@1071@090@2015-04-01"
    #                                     ]
    #                        }
    #
    function __construct($reference, $data)
    {
        # operação
        $this->operation = $data['operation'];

        # referencia do procedimento
        $this->reference = $reference;
        
        # dados da chamada ao controlador
        $this->data = json_decode($data['data']);
    }

    # efetua o tratamento da mensagem de erro e
    # executa o ROLLBACK da operação devolvendo o erro em formato json
    public static function getErrors($db, $e, $info, $transaction = false)
    {
        $msg = $e->getMessage();
        if ($msg != '') {
            //todo format to development mode or production mode...
            $msg = str_replace('"', "", $msg);
            $msg = str_replace("'", "", $msg);
            $pos = strpos($msg, "EOM");
            if ($pos) {
                $msg = substr($msg, 0, $pos);
            }

            $msg .= $info." ".$msg;
            
            $dadosOut = array(
                "error" => $msg
            );
            if ($transaction !== false) {
                $db->rollback();
            }
            echo json_encode($dadosOut);
            die();
        }
    }

    # sinaliza operação ok com mensagem OK por defeito ou $info
    public static function getOK($info = '')
    {
        $msg = "OK";
        if ($info != '') {
            $msg = $info;
        }
        $dadosOut = array(
            "status" => $msg
        );
        echo json_encode($dadosOut);
    }
    
    # atribuiu práticas desportivas a um setor, com base na seleção de um desporto
    public function RH_CRIA_PRATICAS_DESP_SETOR($db) {
        
        $empresa_ = '';
        $cd_estab_ = '';
        $id_setor_ = '';
        $dt_ini_setor_ = '';
        $cd_desp_ = '';
        $dt_ini_desp_ = '';
        $dt_ini_ = '';

        # COPIA DE DESPORTOS PARA DIVERSOS SETORES
        if (isset($this->data->desporto_key)) {
            # chave do desporto 
            $desporto_key = $this->data->desporto_key;
            $p = explode("@",$desporto_key);
            $cd_desp_ = $p[0];
            $dt_ini_desp_ = $p[1];

            # data início de vigência
            $dt_ini_ = $this->data->dt_inicio;

            ## ["DECATHLON@1071@001@2015-04-01", "DECATHLON@1071@090@2015-04-01", "DECATHLON@1071@999@2015-04-01", "DECATHLON@1137@001@2015-10-01"]
            $setores = $this->data->setores;
            try {
                $db->beginTransaction();
                foreach ($setores as $setor) {

                    $p = explode("@",$setor);
                    $empresa_ = $p[0];
                    $cd_estab_ = $p[1];
                    $id_setor_ = $p[2];
                    $dt_ini_setor_ = $p[3];

                    $sql = "CALL RH_CRIA_PRATICAS_DESP_SETOR(:EMPRESA,:CD_ESTAB,:ID_SETOR,:DT_INI_SETOR,:CD_DESP,:DT_INI_DESP,:DT_INI)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':EMPRESA', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':CD_ESTAB', $cd_estab_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_SETOR', $id_setor_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_SETOR', $dt_ini_setor_, PDO::PARAM_STR);
                    $stmt->bindParam(':CD_DESP', $cd_desp_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_DESP', $dt_ini_desp_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI', $dt_ini_, PDO::PARAM_STR);
                    $stmt->execute();
                }
                $db->commit();
            } catch (PDOException $e) {
                $msg = "PROCEDURE [$this->reference] [".$sql."] :";
                QuadProcedure::getErrors($db, $e, $msg, true);
            }      

            QuadProcedure::getOK();
        } 
        # COPIA DE VÁRIOS DESPORTOS PARA UM SETOR
        elseif (isset($this->data->setor_key)) {
            
            # chave do setor 
            $setor_key = $this->data->setor_key;
            $p = explode("@",$setor_key);
            $empresa_ = $p[0];
            $cd_estab_ = $p[1];
            $id_setor_ = $p[2];
            $dt_ini_setor_ = $p[3];

            # data início de vigência
            $dt_ini_ = $this->data->dt_inicio;

            ## ["001@1900-01-01","002@1900-01-01","030@1900-01-01"]]
            $desportos = $this->data->desportos;
            try {
                $db->beginTransaction();
                foreach ($desportos as $desporto) {

                    $p = explode("@",$desporto);
                    $cd_desp_ = $p[0];
                    $dt_ini_desp_ = $p[1];

                    $sql = "CALL RH_CRIA_PRATICAS_DESP_SETOR(:EMPRESA,:CD_ESTAB,:ID_SETOR,:DT_INI_SETOR,:CD_DESP,:DT_INI_DESP,:DT_INI)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':EMPRESA', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':CD_ESTAB', $cd_estab_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_SETOR', $id_setor_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_SETOR', $dt_ini_setor_, PDO::PARAM_STR);
                    $stmt->bindParam(':CD_DESP', $cd_desp_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_DESP', $dt_ini_desp_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI', $dt_ini_, PDO::PARAM_STR);
                    $stmt->execute();
                }
                $db->commit();
            } catch (PDOException $e) {
                $msg = "PROCEDURE [$this->reference] [".$sql."] :";
                QuadProcedure::getErrors($db, $e, $msg, true);
            }      

            QuadProcedure::getOK();
            
        }
    }
    
    # executa o procedimento
    public function execProc($db) {
        if ($this->operation == 'PROCEDURE' && $this->reference == 'RH_CRIA_PRATICAS_DESP_SETOR') {
            $this->RH_CRIA_PRATICAS_DESP_SETOR($db);
        } 
        else {
            $msg = "Invalid PROCEDURE";
            QuadProcedure::getErrors($db, '', $msg, false);
        }
    }
}