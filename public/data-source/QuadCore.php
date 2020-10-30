<?php

class QuadCore
{
    const DATE = "'YYYY-MM-DD'";
    const DATETIME = "'YYYY-MM-DD HH24:MI:SS'";
    const DATETIMESHORT = "'YYYY-MM-DD HH24:MI'";
    const DATEYEARMONTH = "'YYYY-MM'";
    const TIME24MINUTES = "'HH24:MI'";
    const TIME24MSECONDS = "'HH24:MI:SS'";
    const ORACLE_REPLICATION = false;
    
    # Tabelas que utilizam a versão extendida do QuadCore
    const TABELAS_EXTENDED = array('RH_ID_REMUNERACOES','RH_ID_RETRIBUTIVOS','RH_ID_PROFISSIONAIS');
    
    #
    # instânciação a classe QuadCore a partir do array $data fornecido
    #
    # array $data:
    #
    #   fieldsData -
    #
    #   validations -
    #
    #   workflow - objecto json com informação do workflow da tabela
    #       mode - modo do workflow (postponed ou optimistic)
    #       showWorkflowOnEdit - true/false mostra sinalização de workflow no editor
    #
    #   operacion - operação a efetuar (SELECT, INSERT, UPDATE ou DELETE)
    #
    #   columnsArray - array contendo os dados existentes no(s) registo(s)
    #          por cada coluna {"db":"<nome_coluna>","prv_value":"<valor_anterior>","nxt_value":"<novo_valor>","diagnostiv":"<>"}
    #          exemplo {"db":"RHID","prv_value":"1","nxt_value":"1","diagnostic":""}
    #
    #   domains -
    #
    #   cxLists -
    #
    #   table - nome da tabela
    #
    #   operacao - operação a efetuar (SELECT, INSERT, UPDATE ou DELETE)
    #
    #   order_by - condição de ORDER BY aplicada à pesquisa dos registos
    #
    #   pk - array contendo o nome das colunas de PK da tabela e respetivos tipos
    #
    #   dbWhere - condição de WHERE aplicada à pesquisa dos registos
    #
    #   funcFields - ????
    #
    #   startIn -  indice do primeiro registo a retornar
    #
    #   maxRecords -  número de registos a retornar
    #
    function __construct($data)
    {
        //this code is only related to formData. If any file in request then proceed...fieldsdata is only send if any file exists. Prepared like this in frontend
        if (array_key_exists('fieldsData',$data)) {
            $data = json_decode($data['fieldsData'], true);
            if (isset($data["validations"])) {
                $this->validations = json_decode($data["validations"]);
            }
        }

        # existe workflow definido para a tabela ?
        if (array_key_exists('workFlow',$data)) {
            # lê o modo de workflow(wkfMode) (postponed ou optimistic)
            $this->wkfMode = '';
            if (array_key_exists('mode',(array)$data['workFlow'])) {
                $this->wkfMode = $data['workFlow']['mode'];
            }
            $this->wkfUpdate = '';
            if (array_key_exists('update',(array)$data['workFlow'])) {
                $this->wkfUpdate = $data['workFlow']['update'];
            }
            /*require_once 'Workflow.php';
             $this->wkf = new Workflow($this->wkfMode);*/

            # se postponed => utiliza class WorkFlowPostPoned
            if ($this->wkfMode === 'postponed') {
                require_once 'WorkFlowPostPoned.php';
                $this->wkf = new WorkFlowPostPoned(
                    @$_SESSION["nome"],
                    @$_SESSION["perfil"]
                );
                # se optimistic => utiliza class WorkFlowOptimistic
            } elseif ($this->wkfMode === 'optimistic') {
                require_once 'WorkFlowOptimistic.php';
                $this->wkf = new WorkFlowOptimistic(
                    $_SESSION["nome"],
                    $_SESSION["perfil"]
                );
            }
        }
        # operação
        $this->operation = $data['operation'];

        # dados
        $this->data = json_decode($data['columnsArray']);
        if (is_object(json_decode($data['columnsArray']))) {
            if (isset($this->data->dbColunas)) {
                $this->where = $this->data->dbWhere;
                $this->data = $this->data->dbColunas;
            }
        }

        # domínios utilizados
        $this->domains = '';
        if (array_key_exists('domains',$data)) {
            $this->domains = json_decode($data['domains']);
        }

        # complexLists utilizadas
        $this->cxLists = '';
        if (array_key_exists('cxLists',$data)) {
            $this->cxLists = $data['cxLists'];
        }

        # nome da tabela
        if (isset($this->data->dbTable)) {
            $this->table = $this->data->dbTable;
        } else {
            $this->table = $data['table'];
        }

        # operação
        if (isset($this->data->dbOperation)) {
            $this->operation = $this->data->dbOperation;
        } else {
            $this->operation = $data['operation']
                ? $data['operation']
                : $data['operacao'];
        }

        # ALIAS utilizado
        if (isset($this->data->dbAlias) && $this->data->dbAlias !== '') {
            $this->alias = $this->data->dbAlias;
        } else {
            $this->alias = "A";
        }

        # ORDER BY  utilizado
        $this->orderBy = '';
        if (array_key_exists('order_by',$data)) {
            $this->orderBy = $data['order_by'];
        }

        if ($this->orderBy == '') {
            $this->orderBy = '1';
        }

        # PK da tabela
        if (isset($this->data->pk)) {
            $this->pk = $this->data->pk;
        } else {
            $this->pk = $data['pk'];
        }

        # COLUNAS da tabela
        if (isset($this->data->dbColunas)) {
            $this->len = sizeof($this->data->dbColunas);
        } else {
            $this->len = sizeof($this->data);
        }
        if (isset($data['dbWhere'])) {
            $this->where = $data['dbWhere'];
        }

        # Condição WHERE do registo
        //todo advanced search dont work....
        if (property_exists($this, 'where')) {
            if ($this->where != '') {
                $this->where = " AND " . $this->where;
            }
        }

        # funcFields ??
        $this->funcFields = '';
        if (array_key_exists('funcFields',$data)) {
            $this->funcFields = $data['funcFields'];
        }

        # MAX RECORDS
        $this->maxRecords = '';
        if (array_key_exists('maxRecords',$data)) {
            $this->maxRecords = $data['maxRecords'];
        }

        # START IN
        $this->startIn = '';
        if (array_key_exists('startIn',$data)) {
            $this->startIn = $data['startIn'];
        }
        //$this->templateType = $data['templateType'];
        
        # Tratamento de blob existente na tabela a selecionar
        $this->blob_embedded = new stdClass();
        $this->blob_embedded->display = false;
        
        if (isset($data['inRowDoc'])) {
            $inRowDoc = json_decode($data['inRowDoc']);
            if (isset($inRowDoc->embedded->display)) {
                $this->blob_embedded->display = $inRowDoc->embedded->display;

                # dimensão da imagem visualizadas
                if (isset($inRowDoc->embedded->dimensions->x)) {
                    $this->blob_embedded->img_width = $inRowDoc->embedded->dimensions->x;
                }

                if (isset($inRowDoc->embedded->dimensions->y)) {
                    $this->blob_embedded->img_height = $inRowDoc->embedded->dimensions->y;
                }
                
                # usa watermark
                $this->blob_embedded->watermark = false;
                if (isset($inRowDoc->embedded->watermark)) {
                    $this->blob_embedded->watermark = $inRowDoc->embedded->watermark;
                }
            }
            
            # coluna do conteúdo do blob
            if (isset($inRowDoc->blobField)) {
                $this->blob_embedded->blobField = $inRowDoc->blobField;
            }
            
            # coluna de MIME do blob
            if (isset($inRowDoc->extField)) {
                $this->blob_embedded->extField = $inRowDoc->extField;
            }
            
            # coluna de Nome do ficheiro do blob
            if (isset($inRowDoc->fileNameField)) {
                $this->blob_embedded->fileNameField = $inRowDoc->fileNameField;
            }
        }

        # Retem o ROWID quando é efetuado um insert numa tabela com PK = SEQUENCIA
        $this->rowid = null;
        
        # Inicialização da funcionalidade de log
        require_once 'QuadLog.php';
        $this->log = new QuadLog();
        $this->active_log = false;
    }

    # constroi a componente ORDER BY do statement
    # a partir o objecto json ($primarykey) contento a PK
    # retornando um array com as colunas pela quais será efetuada a ordenação
    public function setOrderBy($primarykey)
    {
        $odb = [];
        foreach ($primarykey as $key => $value) {
            if (isset($value['type']) && $value['type'] === 'numeric') {
                array_push($odb, "CAST(" . $key . " AS UNSIGNED)");
            } else {
                array_push($odb, "" . $key);
            }
        }
        return $odb;
    }

    # devolve uma matriz com as colunas de chave primária de uma tabela
    # a partir de um objecto json ($primarykey)
    # contendo as colunas de PK com os respetivos valores
    public function setPK($primarykey)
    {
        $odb = [];
        foreach ($primarykey as $key => $value) {
            array_push($odb, "" . $key);
        }
        return $odb;
    }

    # retorna array no formato array{<coluna>] = <valor>
    # a partir da leitura de um array ($columns) com o nome das colunas
    # e de um array $data com os respetivos valores
    public function dataOutput($columns, $data)
    {
        $out = array();
        $cnt = 0;

        foreach ($data as $value) {
            $cnt = count($value);
            break;
        }

        for ($i = 0, $ien = $cnt; $i < $ien; $i++) {
            $row = array();

            for ($j = 0, $jen = count($columns); $j < $jen; $j++) {
                $column = $columns[$j]; //['db']
                $row[$column] = $data[$column][$i];
            }
            $out[] = $row;
        }
        return $out;
    }

    # recolhe a informação e prepara o statment
    # para a operação de SELECT que irá efetuar
    #
    # se datatype = 'just_editor', não é incluído no SELECT
    # utilizado p.exemplo na tabela RH_ID_REMUNERACOES onde existe uma coluna que será utilizada em DML mas não no SELECT
    public function prepareSelect()
    {
        $bindings = [];
        $columns = "";
        $col_without_cast = "";

        for ($i = 0; $i < $this->len; $i++) {
            $col = $this->getColName($i);

            $col_without_cast = $col;
            $dateType = $this->getDatetype($i);

            // para exclusão da coluna com datetype = 'just_editor'
            if ($dateType && strtoupper($dateType) === 'JUST_EDITOR') {
                null;
            }
            else {
                if ($dateType) {
                    $col = self::formatDatetypeToChar($col, $dateType);
                }

                if ($i < $this->len - 1) {
                    $columns .= $col . ", ";
                } else {
                    $columns .= $col;
                }

                array_push($bindings, $col_without_cast);
            }
        }

        # adicionar às colunas de retorno, as colunas associadas a um documento/imagem
        # com base nas propriedades inRow
        if ($this->blob_embedded->display) {
            $columns .= ", TO_BASE64(".$this->blob_embedded->blobField.") ".$this->blob_embedded->blobField.", ".$this->blob_embedded->extField.", ".$this->blob_embedded->fileNameField." ";
        }

        $arr = [];
        $arr['columns'] = $columns;
        $arr['bindings'] = $bindings;
        return $arr;
    }

    # deteta a existência de coluna de imagem guardada na base de dados
    # e redimensiona essa imagem de acordo com a parametrização
    # substituindo a imagem nos resultados retornados
    #
    # https://stackoverflow.com/questions/50775658/resize-or-crop-base64-images-using-php
    # https://stackoverflow.com/questions/22266402/how-to-encode-an-image-resource-to-base64
    public function dimensionaImagem(&$data) {
        # Componente para redimensionar a imagem            
/*
        foreach ($data as $key => $record) {
            $type = '';
            $blob = '';
            //foreach ($record as $keyRec => $valRec) {
            //    if ($keyRec == $this->blob_embedded->blobField) {
            //        $blob = $valRec;
            //    }
            //    elseif ($keyRec == $this->blob_embedded->extField) {
            //        $type = strtoupper($valRec);
            //    }
            //}
            $blob =$record[$this->blob_embedded->blobField];
            $type=strtoupper($record[$this->blob_embedded->extField]);
 
            if ($blob !== '' && $blob !== null && isset($blob) &&
               ($type == 'JPEG' || $type == 'JPG' || $type == 'PNG' || $type == 'GIF' || $type == 'BMP') ) {
                try {
                    $img = imagecreatefromstring(base64_decode($blob));
                    $source_width = imagesx($img);
                    $source_height = imagesy($img);
                    $ratio =  $source_height / $source_width;

                    $new_width = $this->blob_embedded->img_width; // assign new width to new resized image
                    $new_height = $ratio * $this->blob_embedded->img_width;

                    $thumb = imagecreatetruecolor($new_width, $new_height);

                    $transparency = imagecolorallocatealpha($thumb, 255, 255, 255, 127);
                    imagefilledrectangle($thumb, 0, 0, $new_width, $new_height, $transparency);
                    imagecopyresampled($thumb, $img, 0, 0, 0, 0, $new_width, $new_height, $source_width, $source_height);

                    ob_start(); // Let's start output buffering.
                        imagejpeg($thumb); //This will normally output the image, but because of ob_start(), it won't.
                        $contents = ob_get_contents(); //Instead, output above is saved to $contents
                    ob_end_clean(); //End the output buffer.

                    imagedestroy($img);

                    $new_image = base64_encode($contents);

                    $record[$keyRec] = $new_image;
                    $data[$key] = $record;
                } 
                catch (Exception $ex) {
                    QuadCore::getErrors($db, $ex);
                }
            }
        }
 */
    }
    
    # executa as operações de SELECT
    public function doSelect($db, $data)
    {
        $sql =
            $this->operation .
            " " .
            $data['columns'] .
            " FROM " .
            $this->table .
            " " .
            $this->alias .
            " WHERE 1=1 " .
            $this->where .
            " ORDER BY " .
            $this->orderBy;

        //Bloco com restrição ao nr. de registos visualizados?
        #if (trim($this->table) == "RH_ID_ESCALAS_HORARIAS_WKF") {
        #    echo $sql;
        #}

        if ($this->maxRecords !== "") {
            $sql .= " LIMIT " . $this->maxRecords . ' OFFSET ' . $this->startIn;
        }

        //CONTAGEM DOS REGISTOS A RETORNAR PELA QUERY
        $count = 0;
        $sql_count =
            "SELECT count(*) as CNT FROM " .
            $this->table .
            " " .
            $this->alias .
            " WHERE 1=1 " .
            $this->where;

        try {
            $stmt = $db->prepare($sql_count);
            $stmt->execute();

            $dat = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $dat['CNT'];
        } catch (Exception $ex) {
            QuadCore::getErrors($db, $ex);
        }

        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($this->blob_embedded->display) {
                $this->dimensionaImagem($res);
            }
            
            $dadosOut = array(
                "data" => $res,
                "total_Records" => $count
            );
            echo json_encode($dadosOut);
        } catch (Exception $ex) {
            QuadCore::getErrors($db, $ex);
        }
    }

    # efetua o tratamento da mensagem de erro e
    # executa o ROLBACK da operação devolvendo o erro em formato json
    public static function getErrors($db, $e, $transaction = false, $msgIn = '')
    {
        $msg = $msgIn !== '' ? $msgIn : $e->getMessage(); 
        if ($msg != '') {
            //todo format to development mode or production mode...
            $msg = str_replace('"', "", $msg);
            $msg = str_replace("'", "", $msg);
            $pos = strpos($msg, "EOM");
            if ($pos) {
                $msg = substr($msg, 0, $pos);
            }

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

    # formata valores de tempo armazenados como alfanuméticos (DATE, DATETIME, ...) no formato de data
    # retornado a instrução TO_DATE com o formato de data adequado
    public static function formatToDatetype($col, $dateType, $val)
    {
        $format = '';
        if (strtoupper($dateType) == 'DATE') {
            $format = self::DATE;
        }
        if (strtoupper($dateType) == 'DATETIME') {
            $format = self::DATETIME;
        }
        if (strtoupper($dateType) == 'DATETIMESHORT') {
            $format = self::DATETIMESHORT;
        }
        if (strtoupper($dateType) == 'DATEYEARMONTH') {
            $format = self::DATEYEARMONTH;
        }
        if (strtoupper($dateType) == 'TIME24MINUTES') {
            $format = self::TIME24MINUTES;
        }
        if (strtoupper($dateType) == 'TIME24MSECONDS') {
            $format = self::TIME24MSECONDS;
        }
        //todo $format = QuadCore::$dateType;????
        //$format = QuadCore::$dateType;
        return "TO_DATE('$val', $format )";
    }

    # formata valores de tempo (DATE, DATETIME, ...) no formato alfanumérico
    # retornado a instrução TO_CHAR com o formato de data adequado
    public static function formatDatetypeToChar(
        $col,
        $dateType,
        $includeCol = true
    ) {
        $format = '';
        if (strtoupper($dateType) == 'DATE') {
            $format = self::DATE;
        }
        if (strtoupper($dateType) == 'DATETIME') {
            $format = self::DATETIME;
        }
        if (strtoupper($dateType) == 'DATETIMESHORT') {
            $format = self::DATETIMESHORT;
        }
        if (strtoupper($dateType) == 'DATEYEARMONTH') {
            $format = self::DATEYEARMONTH;
        }
        if (strtoupper($dateType) == 'TIME24MINUTES') {
            $format = self::TIME24MINUTES;
        }
        if (strtoupper($dateType) == 'TIME24MSECONDS') {
            $format = self::TIME24MSECONDS;
        }
        if ($includeCol) {
            return "TO_CHAR($col, $format) $col";
        } else {
            return "TO_CHAR($col, $format)";
        }
    }

    # identifica as tabelas que utilizarão a versão extendida do QuadCore
    public static function extendedTable($table) {

        $res = 'N';
        if (in_array($table, self::TABELAS_EXTENDED)) {
            $res = 'S';
        }
        return $res;
    }
    
    
    # retorna o nome da coluna (db) na posição $i de uma das matrizes
    # $this->data->dbColunas ou $this->data
    public function getColName($i)
    {
        isset($this->data->dbColunas[$i]->db)
            ? ($col = $this->data->dbColunas[$i]->db)
            : ($col = $this->data[$i]->db);
        return $col;
    }

    # retorna o datatype da coluna (datatype) na posição $i da matriz
    # $this->data
    public function getDatetype($i)
    {
        if (
            isset($this->data[$i]->datatype) &&
            $this->data[$i]->datatype !== 'sequence' 
        ) {
            $tipo = $this->data[$i]->datatype;
        } else {
            $tipo = '';
        }
        return $tipo;
    }

    # retorna num array a(s) condição(ões) de seleção de um registo
    # de uma tabela cuja chave primária está identificada em $pk
    #   indice getUpdatedRecord = condição de seleção do registo anterior à atualização
    #   indice getUpdatedRecordKeys = condição de seleção do registo após a atualização
    #   indice lastInsertedId = true se a pk da tabela for uma sequência
    public function getUpdatedRecordQuery($pk, $i, $col)
    {
        $selectWhere = '';
        $selectWhereNext = '';
        $select_column_sequence = '';

        for ($x = 0; $x < count($pk); $x++) {
            //PRIMARY KEY
            if ($pk[$x] == $col) {
                $pkColumn = '';
                $skip = false;
                $select_column_sequence = '';
                //CAST DATATYPES
                if (isset($this->data[$i]->datatype)) {
                    //Column is DATE or DATETIME: CAST it
                    if (strtoupper($this->data[$i]->datatype) == 'DATE') {
                        $pkColumn =
                            "TO_CHAR(" . $pk[$x] . "," . self::DATE . ")";
                    } elseif (
                        strtoupper($this->data[$i]->datatype) == 'DATETIME'
                    ) {
                        $pkColumn =
                            "TO_CHAR(" . $pk[$x] . "," . self::DATETIME . ")";
                    } elseif (
                        strtoupper($this->data[$i]->datatype) == 'DATETIMESHORT'
                    ) {
                        $pkColumn =
                            "TO_CHAR(" .
                            $pk[$x] .
                            "," .
                            self::DATETIMESHORT .
                            ")";
                    } elseif (
                        strtoupper($this->data[$i]->datatype) == 'DATEYEARMONTH'
                    ) {
                        $pkColumn =
                            "TO_CHAR(" .
                            $pk[$x] .
                            "," .
                            self::DATEYEARMONTH .
                            ")";
                    } else {
                        $pkColumn = $pk[$x];
                    }

                    // apenas considera coluna de SEQUENCIA se for a Ãºnica da PK
                    if (
                        strtoupper($this->data[$i]->datatype) === 'SEQUENCE' &&
                        count($pk) === 1
                    ) {
                        //PK w/ SEQUENCE (autoincrement no MySQL) ONLY FIRST ONE IS ADMITED AND ISOLETEAD
                        $select_column_sequence = $pkColumn;
                        $prop = 'isSequencePk';

                        $this->{$prop} = true;
                        $field = 'sequenceField';
                        $this->{$field} = $pkColumn;
                    } elseif (
                        strtoupper($this->data[$i]->datatype) === 'SEQUENCE'
                    ) {
                        $prop = 'isSequencePk';

                        $this->{$prop} = true;
                        $field = 'sequenceField';
                        $this->{$field} = $pkColumn;
                    }
                } else {
                    $pkColumn = $pk[$x];
                }
                if ($select_column_sequence != '') {
                $selectWhere .=
                    " AND " .
                    $pkColumn .
                    "='" .
                    $this->data[$i]->prv_value .
                    "'";

                //SELECT RECORD AFTER UPDATE (PK could have been updated)
                $selectWhereNext .=
                    " AND " .
                    $pkColumn .
                    "='" .
                    $this->data[$i]->nxt_value .
                    "'";
            }
        }
        }
        $arr = [];
        $arr['getUpdatedRecord'] =
            $select_column_sequence != "" ? "" : $selectWhere;
        $arr['getUpdatedRecordKeys'] = $selectWhereNext;
        
        if ($select_column_sequence) {
            $arr['lastInsertedId'] = true;
            $arr['sequence'] = $select_column_sequence;
        }
        return $arr;
    }

    # recolhe a informação e prepara o statment
    # para a operação de CRUD que irá efetuar
    #
    # se datatype = 'just_editor', não é incluído no SELECT de retorno da informação
    public function prepareForCrud()
    {
        $bindings = [];
        $columns = "";
        $info = [];
        if ($this->pk) {
            $pk = $this->setPK($this->pk);
        }
        $info['whereUpdatedRecord'] = '';
        for ($i = 0; $i < $this->len; $i++) {
            $col = $this->getColName($i);
            array_push($bindings, $col);
            $dateType = $this->getDatetype($i);

            # as colunas do tipo JUST_EDITOR não são incluídas no return...
            if (strtoupper($dateType) == 'JUST_EDITOR') {
                null;
            } else {
                if ($dateType) {
                    $col = self::formatDatetypeToChar($col, $dateType);
                }
                $info['whereUpdatedRecord'] .= $this->getUpdatedRecordQuery(
                    $pk,
                    $i,
                    $this->getColName($i)
                )['getUpdatedRecord'];
                if ($i < $this->len - 1) {
                    $columns .= $col . ", ";
                } else {
                    $columns .= $col;
                }
            }
        }
        $selectUpdated =
            "SELECT " .
            $columns .
            " FROM " .
            $this->table .
            " " .
            $this->alias .
            ' WHERE 1 = 1 ' .
            $info['whereUpdatedRecord'];

        $info['bindings'] = $bindings;
        $info['columns'] = $columns;
        $info['selectUpdated'] = $selectUpdated;
        return $info;
    }

    #
    # executa DML na base de dados ORACLE
    public function exec_DML_oracle($table, $sql) {
        $msg = '';

        if (self::ORACLE_REPLICATION) {
            $exec = true;
            $exclude_tables = array(
                'COLUNAS',
                'DK_DEF_INDICADOR_PREMIO_TRADS',
                'DK_DEF_INDICADORES_PREMIO',
                'DK_DEF_MATRIZ_PREMIOS',
                'DK_DEF_PREMIOS_APLIC',
                'DK_ID_DET_COEF_PREMIOS',
                'DK_ID_HDR_COEF_PREMIOS',
                'DK_LOAD_VALOR_INDICADORES',
                'DK_PERFIS_ESTABELECIMENTO',
                'DK_PREMIOS_WORKFLOWS',
                'DK_VALORES_INDICADOR',
                'FO_ON_WORKFLOW',
                'MS_OBJETIVOS_VENDAS',
                'MS_VENDAS',
                'PAGINATE',
                'QUAD_QUERIES_CONTEXTS',
                'QUAD_QUERIES_USER',
                'RH_DEF_WORKFLOWS',
                'RH_ID_CELULAS_VALUES',
                'RH_ID_DELEGACOES',
                'RH_ID_MARCACOES_LOG',
                'RH_ID_RECEBIMENTOS',
                'RH_ID_REQUAL_LOG',
                'RH_ID_WORKFLOW_LOGS',
                'TABELAS',
                'testIncrement',
                'WEB_ADM_CERT_DIGITAIS',
                'WEB_ADM_COLUNAS',
                'WEB_ADM_COLUNAS_CTRL',
                'WEB_ADM_COLUNAS_LOG',
                'WEB_ADM_COLUNAS_TRADS',
                'WEB_ADM_COMUNIC_UTILIZ',
                'WEB_ADM_COMUNICACOES',
                'WEB_ADM_CONFIG_DIRECTORIAS',
                'WEB_ADM_CONFIG_PONTO',
                'WEB_ADM_CONFIGURACOES',
                'WEB_ADM_CTRL_VISUALIZACAO',
                'WEB_ADM_EVENTOS_FUTUROS',
                'WEB_ADM_FAQS',
                'WEB_ADM_FILTRO_ESTAB',
                'WEB_ADM_FLEXFIELDS',
                'WEB_ADM_LAYOUTS_EMAILS',
                'WEB_ADM_LEG_FISC',
                'WEB_ADM_LOG',
                'WEB_ADM_LOG_ACESSOS',
                'WEB_ADM_LOG_EMAIL',
                'WEB_ADM_MOD_PORTAL_TRADS',
                'WEB_ADM_MODULOS_PORTAL',
                'WEB_ADM_NOTICIAS',
                'WEB_ADM_OPER_FUNC_ESTAB',
                'WEB_ADM_PASSWORD_LOG',
                'WEB_ADM_PERFIS',
                'WEB_ADM_PERFIS_TRADS',
                'WEB_ADM_PERFIS_UTILIZADORES',
                'WEB_ADM_PROCESSOS',
                'WEB_ADM_PROCESSOS_LOG',
                'WEB_ADM_RGPD',
                'WEB_ADM_RGPD_CTRL',
                'WEB_ADM_SCHED_PROC',
                'WEB_ADM_SCRIPTS',
                'WEB_ADM_TABELAS',
                'WEB_ADM_TRANSFORMA_ABSENTISMO',
                'WEB_ADM_UTILIZADORES',
                'WEB_ADM_WORKFLOW',
                'WEB_DG_MESES_PROCESSOS',
                'WEB_HLPDSK_ANEXOS',
                'WEB_HLPDSK_RESPOSTAS',
                'WEB_HLPDSK_TICKET',
                'WEB_RH_ALTER_CADASTRO',
                'WEB_RH_ALTER_CADASTRO_HIST',
                'WEB_RH_AUSENCIAS',
                'WEB_RH_DEF_DET_POLLS',
                'WEB_RH_DEF_POLLS',
                'WEB_RH_EMPRESAS',
                'WEB_RH_FERIAS',
                'WEB_RH_ID_KPI_DESCONTOS',
                'WEB_RH_ID_KPI_EMPRESAS',
                'WEB_RH_ID_KPI_HORAS',
                'WEB_RH_ID_KPI_RUBRICAS',
                'WEB_RH_ID_POLLS',
                'WEB_RH_ID_PROC_DISCIPLINARES',
                'WEB_RH_IMPORT',
                'WEB_RH_LOG_IMPORT',
                'WEB_RH_NOTIFICACOES',
                'WEB_RH_OUTPUTS',
                'WEB_RH_PROFISSIONAIS',
                'WEB_RH_TIPO_OUTPUTS',
                'WEB_RH_TS_HV',
                'WEB_RH_VALORES_RUBRICAS',
                'WEB_RHID_HAB_LITS_ANEXOS',
                'WEB_RHID_HAB_PROFS_ANEXOS',
                'WEB_SHST_AGENDA',
                'WEB_SHST_DOENCAS',
                'WEB_SHST_EPIS',
                'WEB_SHST_PARTICIP_ACIDENTES',
                'WEB_SHST_PARTICIPACOES_SEGURO',
                'WEB_SHST_RESULTADOS_EXAMES',
                'WEB_TEMP'
            );

            $exec = !in_array($table, $exclude_tables);

            if ($exec) {
                $ora_usr = 'QUAD_HCM';
                $ora_pwd = 'QUAD_HCM';
                $ora_cn = '80.172.253.30/demo';
                $ora_nls = 'AL32UTF8';

                $conn = oci_connect($ora_usr, $ora_pwd, $ora_cn, $ora_nls);

                $stid = oci_parse($conn, $sql);
                $r = @oci_execute($stid);
                if (!$r) {
                    $error = oci_error($stid); // For oci_execute errors pass the statement handle
                    $msg =  '#1 Oracle reports: ' . $error['message']. " [$sql]";
                } else {
                    //            $dadosOut = array(
                    //                "status" => "ok",
                    //                "workflow" => true
                    //            );
                    //            json_encode($dadosOut);
                }

                $committed = oci_commit($conn);

                // Test whether commit was successful. If error occurred, return error message
                if (!$committed) {
                    $error = oci_error($conn);
                    $msg =  '#2 Oracle reports: ' . $error['message']. " [$sql]";
                }

                oci_free_statement($stid);
                oci_close($conn);
            }

            if ($msg != '') {
                $dadosOut = array(
                    "error" => $msg
                );
                echo json_encode($dadosOut);
                die();
            }
        }
    }
    
    # executa as operações de INSERT
    public function doInsert($db, $info)
    {
/*        
$dadosOut = array(
                "error" => 'ESTOU A FORÇAR ERRO NO INSERT'
            );
echo json_encode($dadosOut);
die();
*/
        $statements = [];
        $nulo = 'NULL';
        $sql_cols = '';
        $sql_vals = '';
        $submitDML = false;
        $insert = false;
        $newVal = '';
        $msg = '';

        # constroi o statment de INSERT
        $sql_hdr = "INSERT INTO " . $this->table . "  ";
        for ($i = 0; $i < $this->len; $i++) {
            $col = $this->getColName($i);
            $newVal = $this->data[$i]->nxt_value;

            if ($newVal != '') {
                $submitDML = true;

                $dateType = $this->getDatetype($i);
                if ($dateType) {
                    $newVal = $this->formatToDatetype($col, $dateType, $newVal);
                } else {
                    $newVal = "'" . str_replace("'", "''", $newVal) . "'";
                }
            } else {
                $newVal = $nulo;
            }
            
            if (
                (is_array($this->funcFields) &&
                    in_array($col, $this->funcFields)) ||
                (isset($this->data[$i]->datatype) &&
                    strtoupper($this->data[$i]->datatype) == 'SEQUENCE') ||
                (isset($this->data[$i]->datatype) &&
                    strtoupper($this->data[$i]->datatype) == 'JUST_EDITOR')
            ) {
                // apenas considera coluna de SEQUENCIA se for a única da PK
                if (strtoupper($this->data[$i]->datatype) === 'SEQUENCE' && count($this->pk) === 1) {
                    //PK w/ SEQUENCE (autoincrement no MySQL) ONLY FIRST ONE IS ADMITED AND ISOLETEAD
                    $select_column_sequence = $col;
                }
            } else {
                if (
                    (is_array($this->funcFields) &&
                        in_array($col, $this->funcFields)) ||
                    (isset($this->data[$i]->datatype) &&
                        strtoupper($this->data[$i]->datatype) == 'SEQUENCE') ||
                    (isset($this->data[$i]->datatype) &&
                        strtoupper($this->data[$i]->datatype) == 'JUST_EDITOR')
                ) {
                    null;
                } else {
                    // not a function field , we include in INSERT AND UPDATE
                    if ($sql_cols != '') {
                        $sql_cols .= ', ' . $col;
                        $sql_vals .= ', ' . $newVal;
                    } else {
                        $sql_cols = $col;
                        $sql_vals = $newVal;
                    }
                }
            }
        }

        # no caso de ser um workflow em modo de postponed, só efetua a notificação,
        # não criando o registo e parando o processo em notifyUser
        # com exceção do caso em que existe uma auto-aprovação e aí a variável $submitDML é colocada a true
        # e é efetuado o DML
        if (isset($this->wkf) && $this->wkfMode === 'postponed') {
            $notifyResp = $this->wkf->notifyThis(
                $this->table,
                $this->operation,
                null,
                $this->setPK($this->pk),
                $this->data,
                $this->cxLists,
                $this->domains,
                $this->wkfUpdate
            );

            $submitDML = is_array($notifyResp) ? $notifyResp[1] : $notifyResp;
            $insert = true;
        } 
        elseif (isset($this->wkf) && $this->wkfMode === 'optimistic') {
            $statements = $this->wkf->notifyThis(
                $this->table,
                $this->operation,
                null,
                $this->setPK($this->pk),
                $this->data,
                $this->cxLists,
                $this->domains,
                $this->wkfUpdate
            );
            $submitDML = true;
            $insert = true;
        } 
        else {
            $submitDML = true;
            $insert = true;
        }

        # submeter o statement
        if ($submitDML) {
            # executa o statement de INSERT
            if (isset($select_column_sequence)) {
                $rowid = 0;
                $sql =
                    $sql_hdr .
                    "(" .
                    $sql_cols .
                    ") VALUES (" .
                    $sql_vals .
                    ") ";

                // Execute Statment
                try {
                    # ORACLE REPLICATION
                    $this->exec_DML_oracle($this->table, $sql);

                    if (isset($this->wkf)) {
                        $stmt = $db->prepare($sql);
                        array_push($statements, $stmt);
                        //$stmt->execute();
                    } else {
                        $db->query($sql);

                        $rowid = $db->lastInsertId(); //this doenst work allways return 0 , i mean ALLWAYS

                        # extensão para colunas automáticas que não sejam sequências
                        if ($rowid == 0) {
                            $selectRow =
                                "SELECT " .
                                $select_column_sequence .
                                " FROM " .
                                $this->table .
                                " " .
                                $this->alias .
                                ' ORDER BY COALESCE(DT_UPDATED,DT_INSERTED) ' .
                                ' DESC LIMIT 1';

                            $retRow = $db->prepare($selectRow);
                            $retRow->execute();
                            $data = $retRow->fetch(PDO::FETCH_ASSOC);
                            $rowid = $data[$select_column_sequence];
                        }
                        $this->rowid = $rowid;
                    }
                } catch (Exception $ex) {
                    QuadCore::getErrors($db, $ex);
                }
                
                if ($rowid === 0) {
                    $selectRow =
                        "SELECT " .
                        $info['columns'] .
                        " FROM " .
                        $this->table .
                        " " .
                        $this->alias .
                        ' ORDER BY ' .
                        $select_column_sequence .
                        ' DESC LIMIT 1';
                } else {
                    $selectRow =
                        "SELECT " .
                        $info['columns'] .
                        " FROM " .
                        $this->table .
                        " " .
                        " WHERE " .
                        $select_column_sequence .
                        " = '" .
                        $rowid .
                        "' " .
                        ' LIMIT 1';
                }

                $retRow = $db->prepare($selectRow);
                //$retRow->bindValue(':rid', $rowid);
            } 
            else {
                try {
                    $sql =
                        $sql_hdr .
                        "(" .
                        $sql_cols .
                        ") VALUES (" .
                        $sql_vals .
                        ") ";

                    # ORACLE REPLICATION
                    $this->exec_DML_oracle($this->table, $sql);

                    $stmt = $db->prepare($sql);

                    if (isset($this->wkf)) {
                        array_push($statements, $stmt);
                        //$stmt->execute();
                    } else {
                        $stmt->execute();
                    }
                    $retRow = $db->prepare($info['selectUpdated']);
                } catch (Exception $ex) {
                    QuadCore::getErrors($db, $ex);
                }
            }

            //SELECT para devolver ao QUADTABLES/QUADFORMS o registo alvo de DML
            // Execute Query
            try {
                if (isset($this->wkf) && $this->wkfMode === 'optimistic') {
                    array_push($statements, $retRow);
                    if ($this->wkf->doWorkFlowTransaction($statements, $db)) {
                        
                        # obtem os dados após a execução das operações
                        $retRow->execute();
                        $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                    }
                } elseif (isset($this->wkf) && $this->wkfMode === 'postponed') {
                    /* if(is_array($submitDML) && $submitDML[0]==="S"){ //is finished by administrator (last perfil)
                        $retRow->execute();
                        $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                    }else{*/
                    if ($this->wkf->doWorkFlowTransaction($sql,'',$db)) {
                        
                        # obtem os dados após a execução das operações
                        $retRow->execute();
                        $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                    }
                    // }
                } else {

                    # obtem os dados após a execução das operações
                    $retRow->execute();
                    $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                }
            } catch (Exception $ex) {
                QuadCore::getErrors($db, $ex);
            }

            if (is_array($submitDML) && $submitDML[0] === "N") {
                die();
            }
            
            # dados de retorno do INSERT
            $dadosOut = array(
                "data" => $data
            );
            echo json_encode($dadosOut);
            
        } 
        elseif ($insert) {
            # neste caso existiu uma inserção mas a mesma não é efetivada 
            # porque entrou em processo de workflow
            $dadosOut = array(
                "msg" => "ok"
            );
            echo json_encode($dadosOut);
        }

        if ($this->active_log && $insert) {
            $wkfU = '';
            if (isset($this->wkf)) {
                $wkfU = $this->wkfUpdate;
            }
            $this->log->registoLog(
                $this->table,
                $this->operation,
                null,
                $this->setPK($this->pk),
                $this->data,
                $this->cxLists,
                $this->domains,
                $wkfU);
        }
    }

    # executa as operações de UPDATE
    public function doUpdate($db, $info)
    {
/*
$dadosOut = array(
                "error" => 'ESTOU A FORÇAR ERRO NO UPDATE'
            );
echo json_encode($dadosOut);
die();        
 */
        $statements = [];
        $nulo = 'NULL';
        $sql_body = '';
        $submitDML = false;
        $change = false;

        # constroi o statment de UPDATE
        $sql_hdr = $this->operation . " " . $this->table . " SET ";
        for ($i = 0; $i < $this->len; $i++) {
            if (
            (isset($this->data[$i]->nxt_value) || $this->data[$i]->nxt_value===null) &&
                $this->data[$i]->nxt_value !== $this->data[$i]->prv_value
            ) {
                # existe alteração, que poderá não ser efetivada derivado ao workflow 
                $change = true;
                if (isset($this->wkf)) {
                    if ($this->wkfMode === "postponed") {
                        $submitDML = $this->wkf->notifyThis(
                            $this->table,
                            $this->operation,
                            $this->data[$i],
                            $this->setPK($this->pk),
                            $this->data,
                            $this->cxLists,
                            $this->domains,
                            $this->wkfUpdate
                        );
                    } else {
                        $stt = $this->wkf->notifyThis(
                            $this->table,
                            $this->operation,
                            $this->data[$i],
                            $this->setPK($this->pk),
                            $this->data,
                            $this->cxLists,
                            $this->domains,
                            $this->wkfUpdate
                        );
                        $statements = array_merge($statements, $stt);
                        $submitDML = true;
                    }
                } else {
                    $submitDML = true;
                }

                if (
                    $this->getDatetype($i) != '' &&
                    strtoupper($this->getDatetype($i)) == 'JUST_EDITOR'
                ) {
                    # existe a necessidade de forÃ§ar o upgrade igualando uma coluna da chave
                    if ($sql_body == '') {
                        if ($i > 0 ) {
                            $sql_body =
                                $this->getColName(0) .
                                " = " .
                                $this->getColName(0);
                        } else {
                            $sql_body =
                                $this->getColName(1) .
                                " = " .
                                $this->getColName(1);
                        }
                    }
                } 
                else {
                    
                    $bdColumn = $this->getColName($i);
                    $newVal = $this->data[$i]->nxt_value;
                    if ($newVal == '') {
                        $newVal = $nulo;
                    } else {
                        $dateType = $this->getDatetype($i);
                        if ($dateType) {
                            $newVal = $this->formatToDatetype(
                                $bdColumn,
                                $dateType,
                                $newVal
                            );
                        } else {
                            $newVal = "'" . str_replace("'", "''", $newVal) . "'";
                        }
                    }

                    if (!empty($this->funcFields)) {
                        if ($sql_body != '') {
                            if (
                                !empty($this->funcFields) &&
                                !in_array($bdColumn, $this->funcFields)
                            ) {
                                $sql_body .= ', ' . $bdColumn . '=' . $newVal;
                            } else {
                                $sql_body .= ', ' . $bdColumn . '=' . $newVal;
                            }
                        } else {
                            if (
                                !empty($funcFields) &&
                                !in_array($bdColumn, $this->funcFields)
                            ) {
                                $sql_body .= ' ' . $bdColumn . '=' . $newVal;
                            } else {
                                $sql_body .= ' ' . $bdColumn . '=' . $newVal;
                            }
                        }
                    } else {
                        if ($sql_body != '') {
                            $sql_body .= ', ' . $bdColumn . '=' . $newVal;
                        } else {
                            $sql_body .= ' ' . $bdColumn . '=' . $newVal;
                        }
                    }
                }
            }
        }
        # submeter o statement
        if ($submitDML) {
            # executa o statement de UPDATE
            $sql =
                $sql_hdr .
                $sql_body .
                ' WHERE 1=1 ' .
                $info['whereUpdatedRecord'];

/*            
$dadosOut = array(
                "error" => "UPDATE[$sql]"
            );
echo json_encode($dadosOut);
die();        
 */
            // Execute Statment
            try {
                $stmt = $db->prepare($sql);
                //$stmt->execute();
                array_push($statements, $stmt);
                //SELECT para devolver ao QUADTABLES/QUADFORMS o registo alvo de DML

                //se houver blob && display true , precisamos de devolver a coluna nos updates
                if (
                    isset($this->blob_embedded) &&
                    $this->blob_embedded->display === true
                ) {
                    $bf = $this->blob_embedded->blobField;
                    $info["columns"] .= ",$bf";
                }
                $select_row =
                    "SELECT " .
                    $info['columns'] .
                    " FROM " .
                    $this->table .
                    " " .
                    $this->alias .
                    ' WHERE 1=1 ' .
                    $info['whereUpdatedRecord'];
                //CALL notification center
                $retRow = $db->prepare($select_row);
                // Execute Query
                //$retRow->execute();
                array_push($statements, $retRow);

                if (isset($this->wkf) && $this->wkfMode === 'optimistic') {
                    if ($this->wkf->doWorkFlowTransaction($statements, $db)) {
                        $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                        //print_r($data);
                        $dadosOut = array(
                            "data" => $data
                        );
                        echo json_encode($dadosOut);
                    }
                }
                elseif (isset($this->wkf) && $this->wkfMode === 'postponed') {
                    if ($this->wkf->doWorkFlowTransaction($sql,'',$db)) {
                        $retRow->execute();
                        $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                        //print_r($data);
                        //Torna possivel o json encode de blob
                        if(isset($this->blob_embedded->blobField)) {
                            if (isset($data[0][$this->blob_embedded->blobField])) {
                                $data[0][
                                    $this->blob_embedded->blobField
                                ] = base64_encode(
                                    $data[0][$this->blob_embedded->blobField]
                                );
                            }
                        }
                        $dadosOut = array(
                            "data" => $data
                        );
                        echo json_encode($dadosOut);
                    }
                } 
                else {
                    # ORACLE REPLICATION
                    $this->exec_DML_oracle($this->table, $sql);
                    $stmt->execute();

                    $retRow->execute();
                    $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                    //print_r($data);
                    //Torna possivel o json encode de blob
                    
                    if (isset($this->blob_embedded->blobField)) {
                        if (isset($data[0][$this->blob_embedded->blobField])) {
                            $data[0][
                                $this->blob_embedded->blobField
                            ] = base64_encode(
                                $data[0][$this->blob_embedded->blobField]
                            );
                        }
                    }

                    $dadosOut = array(
                        "data" => $data
                    );
                    echo json_encode($dadosOut);
                }
            } catch (Exception $ex) {
                QuadCore::getErrors($db, $ex);
            }
        } 
        else {
            # se não existiu qualquer coluna alterada ...
            if (!$change) { 
                $dadosOut = array(
                    "status" => "unchanged"
                );
                echo json_encode($dadosOut);
            # neste caso existiu alteração mas a mesma não é efetivada 
            # porque entrou em processo de workflow
            } else {
                $dadosOut = array(
                    "status" => "ok"
                );
                echo json_encode($dadosOut);
            }
        }
        
        if ($submitDML || $change) {
            if ($this->active_log) {
                $wkfU = '';
                if (isset($this->wkf)) {
                    $wkfU = $this->wkfUpdate;
                }
                $this->log->registoLog(
                    $this->table,
                    $this->operation,
                    $this->data[$i],
                    $this->setPK($this->pk),
                    $this->data,
                    $this->cxLists,
                    $this->domains,
                    $wkfU
                );
            }
        }
    }

    # executa as operações de DELETE
    public function doDelete($db, $info)
    {        
/*        
$dadosOut = array(
                "error" => 'ESTOU A FORÇAR ERRO NO DELETE'
            );
echo json_encode($dadosOut);
die();        
 */
        $statements = [];

        # constroi o statment de DELETE
        $sql_hdr = $this->operation . " FROM " . $this->table;
        $sql = $sql_hdr . ' WHERE 1=1 ' . $info['whereUpdatedRecord'];

        //todo is workflow postponed working different from optimistic in DELETE operation???
        # existe workflow
        if (isset($this->wkf)) {
            $submitDML = false;

            # no caso de ser um workflow em modo de postponed, só efetua a notificação,
            # não criando o registo e parando o processo em notifyUser
            # com exceção do caso em que existe uma auto-aprovação e aí a variável $submitDML é colocada a true
            # e é efetuado o DML
            if (isset($this->wkf) && $this->wkfMode === 'postponed') {
                $submitDML = $this->wkf->notifyThis(
                    $this->table,
                    'DELETE',
                    null,
                    $this->setPK($this->pk),
                    $this->data,
                    $this->cxLists,
                    $this->domains,
                    $this->wkfUpdate
                );
            } elseif (isset($this->wkf) && $this->wkfMode === 'optimistic') {
                $statements = $this->wkf->notifyThis(
                    $this->table,
                    'DELETE',
                    null,
                    $this->setPK($this->pk),
                    $this->data,
                    $this->cxLists,
                    $this->domains,
                    $this->wkfUpdate
                );

                $submitDML = true;
            } else {
                $submitDML = true;
            }

            if ($submitDML) {
                # ORACLE REPLICATION
                $this->exec_DML_oracle($this->table, $sql);

                # executa o statement
                try {
                    $stmt = $db->prepare($sql);
                    //$stmt->execute();
                    array_push($statements, $stmt);
                } catch (Exception $ex) {
                    QuadCore::getErrors($db, $ex);
                }

                if (isset($this->wkf) && $this->wkfMode === 'optimistic') {
                    if ($this->wkf->doWorkFlowTransaction($statements, $db)) {
                        $dadosOut = array(
                            "status" => "deleted"
                        );
                        echo json_encode($dadosOut);
                    }
                }
                elseif (isset($this->wkf) && $this->wkfMode === 'postponed') {
                    if ($this->wkf->doWorkFlowTransaction($sql,'',$db)) {
                        $dadosOut = array(
                            "status" => "deleted"
                        );
                        echo json_encode($dadosOut);
                    }
                }
            }
        } 
        else {

            try {
                # ORACLE REPLICATION
                $this->exec_DML_oracle($this->table, $sql);

                $stmt = $db->prepare($sql);
                $stmt->execute();
                $dadosOut = array(
                    "status" => "deleted"
                );
                echo json_encode($dadosOut);
            } catch (Exception $ex) {
                QuadCore::getErrors($db, $ex);
            }
        }
            
        if ($this->active_log) {
            $wkfU = '';
            if (isset($this->wkf)) {
                $wkfU = $this->wkfUpdate;
            }
            $this->log->registoLog(
                $this->table,
                'DELETE',
                null,
                $this->setPK($this->pk),
                $this->data,
                $this->cxLists,
                $this->domains,
                $wkfU);
        }
    }
}
