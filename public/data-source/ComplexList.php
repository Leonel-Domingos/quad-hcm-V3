<?php
/*
 * Classe para o tratamento das ComplexLists
 *
 * PTE 2019.09.24
 */

class ComplexList
{
    const DATE = "'YYYY-MM-DD'";
    const DATETIME = "'YYYY-MM-DD HH24:MI'";
    const DATETIMESHORT = "'YYYY-MM-DD HH24:MI:SS'";
    const CACHE_ROW_LIMIT = 9999999999;

    # multiRequest = pedido de multirequest
    # dataReq = informação do pedido

    /*
     *  PARÂMETROS:
     *
     *  dbtable - nome da tabela a tratar
     *  alias - alias em uso da tabela
     *  pk_db_name - nome das colunas de PK da tabela (separadas por @)
     *  pk - array contendo as colunas de PK da tabela
     *  desigColumn - nome da coluna de designação
     *  dateFields - lista das colunas do tipo DATE/DATETIME/DATETIMESHORT
     *  filter - condições de filtragem aplicáveis à pesquisa
     *  filtered - statment a utilizar no WHERE com as condições do filtro
     *  where - condição de WHERE aplicável à pesquisa
     *  orderBy - ordenação aplicável à pesquisa
     *  otherValues - outras colunas da tabela a devolver na pesquisa
     *  arrIdx - identificação da pesquisa para o memcache
     *  sql - string contendo a statement a executar
     *  datesFormats - objeto contendo os diversos formatos de data
     *  table_translate - nome da tabela de traduções associada
     *  renew - lista caso exista em memcache deverá ser recarregada
     * TRADUÇÕES
     * exemplo da inclusão de traduções:
     *
     *  SELECT COALESCE(b.DSP_TRAD,a.DSP_DOC_ID) DSP_DOC_ID, a.CD_DOC_ID
     *  FROM DG_DOCUMENTOS a
     *       LEFT JOIN DG_DOCUMENTO_TRADS b
     *       ON b.CD_DOC_ID = a.CD_DOC_ID
     *       AND b.CD_LINGUA = 1
     *       AND b.DT_FIM IS NULL

     */
    function __construct($multiReq, $dataReq, $key) {
        
        # tratamento da informação do pedido
        isset($dataReq['table'])
            ? ($this->dbTable = $dataReq['table'])
            : ($this->dbTable = '');
        if ($this->dbTable != '') {
            $this->alias = 'A';
            $p = strpos($this->dbTable," ");
            if ($p === false) {
                null;
            } else {
                $this->alias = trim(substr($this->dbTable,$p + 1));
                $this->dbTable = trim(substr($this->dbTable,0,$p));
            }
        }

        isset($dataReq['pk'])
            ? ($this->pk_db_name = $dataReq['pk'])
            : ($this->pk_db_name = '');
        $this->pk = explode('@', $this->pk_db_name);
        isset($dataReq['desigColumn'])
            ? ($this->desigColumn = $dataReq['desigColumn'])
            : ($this->desigColumn = '');
        isset($dataReq['dateFields'])
            ? ($this->dateFields = $dataReq['dateFields'])
            : ($this->dateFields = '');
        isset($dataReq['filter'])
            ? ($this->filter = $dataReq['filter'])
            : ($this->filter = '');

        $this->filtered = '';
        if (!isset($multiReq)) {
            $this->filtered = $this->filter;
        } else {
            $editorAction = isset($dataReq['editorAction']) ? true : false;
            $this->filtered = '';
            if ($editorAction) {
                if ($dataReq['editorAction']) {
                    if (isset($this->filter[$dataReq['editorAction']])) {
                        $this->filtered =
                            $this->filter[$dataReq['editorAction']];
                    }
                }
            }
        }

        isset($dataReq['where'])
            ? ($this->where = $dataReq['where'])
            : ($this->where = '');
        isset($dataReq['orderBy'])
            ? ($this->orderBy = $dataReq['orderBy'])
            : ($this->orderBy = '');
        isset($dataReq['otherValues'])
            ? ($this->otherValues = explode('@', $dataReq['otherValues']))
            : ($this->otherValues = '');
        isset($dataReq['idx'])
            ? ($this->arrIdx = $dataReq['idx'])
            : ($this->arrIdx = $key);
        isset($dataReq['renew']) ? ($this->renew = 'S') : ($this->renew = 'N');

        isset($_POST['refresh']) ? ($this->renew = 'S') : ($this->renew = 'N');
        # desabilita o memcache para chamadas cuja $key == '0'
        if ($this->arrIdx == '0') {
            $this->arrIdx = '';
            $this->renew = 'S';
        }

        $this->sql = "";

        $this->datesFormats = new stdClass();
        $this->datesFormats->DATE = self::DATE;
        $this->datesFormats->DATETIME = self::DATETIME;
        $this->datesFormats->DATETIMESHORT = self::DATETIMESHORT;

        # tratamento das traduções
        # obtêm tabela de traduções
        $this->table_translate = $this->is_translated($this->dbTable);

        $this->debug = true;
    }

    # controla o debug da classe
    function set_debug($debug) {
        $this->debug = $debug;
    }

    # se o conteúdo já se encontra em cache, devolve o conteúdo
    function isCached($memcache){

        $memresult = $memcache->get(str_replace(' ', '', $this->arrIdx).@$_SESSION['lang']);
        if ($memresult) {
            return $memresult;
        } else {
            return false;
        }
        return false;
    }

    # obtem as colunas que retornam o valor concatenado da PK do registo a selecionar
    function getConcatPK() {
        $concatPk = '';
        for ($x = 0; $x < count($this->pk); $x++) {
            if ($this->dateFields !== '') {
                if (array_key_exists($this->pk[$x], $this->dateFields[0])) {
                    $prop = mb_strtoupper($this->dateFields[0][$this->pk[$x]]);
                    if ($prop !== 'SEQUENCE') {
                        $this->pk[$x] =
                            "TO_CHAR(" .
                            $this->pk[$x] .
                            " , " .
                            $this->datesFormats->$prop .
                            ") ";
                    } else {
                        $this->pk[$x] = $this->pk[$x];
                    }
                }
            }
            if (count($this->pk) > 1) {
                if ($x > 0) {
                    //$concatPk = str_replace("", "", $concatPk . "||'@'||" . $pk[$x]);
                    $concatPk =
                        "CONCAT(CONCAT(" .
                        $concatPk .
                        ", '@'), " .
                        $this->pk[$x] .
                        ") ";
                } else {
                    //$concatPk = $concatPk . str_replace("'", "", $pk[$x]);
                    $concatPk = $this->pk[$x]; //str_replace("'", "", $pk[$x]);
                }
            } else {
                //$concatPk = str_replace("'", "", $pk[$x]);
                $concatPk = $this->pk[$x];
            }
        }
        return $concatPk;
    }

    # obtem as colunas que retornam o valor concatenado dos otherValues
    function getConcatOtherValues(){

        $concatOtherValues = '';

        if ($this->otherValues !== '') {
            for ($x = 0; $x < count($this->otherValues); $x++) {
                if ($this->dateFields !== '') {
                    if (array_key_exists($this->otherValues[$x], $this->dateFields[0])) {
                        $prop = mb_strtoupper($this->dateFields[0][$this->otherValues[$x]]);
                        $this->otherValues[$x] =
                            "TO_CHAR(" .
                            $this->otherValues[$x] .
                            " , " .
                            $this->datesFormats->$prop .
                            ") ";
                    }
                    if (in_array($this->pk[$x], $this->dateFields)) {
                        //NEW
                        $this->pk[$x] = "TO_CHAR($this->pk[$x], $this->datesFormats->$prop) ";
                    }
                }
                if (count($this->otherValues) > 1) {
                    if ($x > 0) {
                        //$concatOtherValues = str_replace("", "", $concatOtherValues . "||'@'||" . $otherValues[$x]);
                        //$concatOtherValues = "CONCAT(CONCAT(" . $concatOtherValues. ", '@'), " . $otherValues[$x] . ") "; //PMA, 2019-07-29: OTERVALUES W/ MANY NULLS NOT ALWAYS WORKS
                        $concatOtherValues =
                            "CONCAT(CONCAT(" .
                            $concatOtherValues .
                            ", '@'), " .
                            "NVL(" .
                            $this->otherValues[$x] .
                            ",'')" .
                            ") "; //PMA, 2019-07-29 :: TRICK
                    } else {
                        //$concatOtherValues = $concatOtherValues . str_replace("'", "", $otherValues[$x]);
                        $concatOtherValues = $this->otherValues[$x];
                    }
                } else {
                    $concatOtherValues = $this->otherValues[$x];
                }
            }
        }

        return $concatOtherValues;
    }

    ############
    # TRADUÇÕES

    # identifica se a tabela não tem tradução
    function tables_without_translate($table){

        $file = realpath(dirname(__FILE__))."/../../data/trads/trads_no.json";
        $notrads = json_decode(file_get_contents($file),true);

        $resultado = false;
        if (in_array($table,$notrads)) {
            $resultado = true;
        }
        return $resultado;
        
    }

    # identifica a tabela de tradução para a tabela indicada
    function translate_table_name($table) {

        $file = realpath(dirname(__FILE__))."/../../data/trads/trads.json";
        $translate_tabs = json_decode(file_get_contents($file),true);

        if (isset($translate_tabs[$table])) {
            $translate_table = $translate_tabs[$table];
        }
        else {
            $translate_table = $table.'_TRADS';
        }

        return $translate_table;
    }

    # determina se a tabela tem traduções e qual é a tabela de traduções
    function is_translated($table) {
        $tab_trans = false;
        if (!$this->tables_without_translate($table)) {
            $tab_trans = $this->translate_table_name($table);
        }
        return $tab_trans;
    }

    # obtem o statment de join das colunas da PK da tabela
    # para utilizar no JOIN com tabela de tradução
    function getPKColumnsTranslate() {
        $concatPkCols = '';
        for ($x = 0; $x < count($this->pk); $x++) {
            
            # exceções -> TP_VINCULO não faz parte da PK
            # TODO: definir array para exceções
            if ($this->dbTable == 'RH_DEF_VINCULOS_CONTRATUAIS' && $this->pk[$x] == "$this->alias.TP_VINCULO") {
                null;
            } else {
                if ($concatPkCols == '') {
                    $concatPkCols = $this->pk[$x]." = ".str_replace("$this->alias.","B.",$this->pk[$x])." ";
                } else {
                    $concatPkCols .= " AND ".$this->pk[$x]." = ".str_replace("$this->alias.","B.",$this->pk[$x])." ";
                }
            }
        }
        return $concatPkCols;
    }

    # convert string em array separando os elementos pelos carateras indicados em $delimeters
    # guardando no array também os separadores
    function multiexplode ($delimiters,$data) {
        $cnt = 0;
        $result = array();
        for ($x = 0; $x < count($delimiters); $x++) {
            $cnt += substr_count($data, $delimiters[$x]);
        }
        if ($cnt ==0) {
            array_push($result,$data);
        } else {
            for ($x = 0; $x < $cnt; $x++) {
                $min_pos = strlen($data);

                for ($y = 0; $y < count($delimiters); $y++) {
                    $pos = strpos($data,$delimiters[$y]);
                    if ($pos === false) {
                        null;
                    } else {
                        if ($min_pos > $pos) {
                            $min_pos = $pos;
                        }
                    }
                }
                array_push($result,substr($data,0,$min_pos));
                array_push($result,substr($data,$min_pos,1));
                $data = substr($data,$min_pos + 1);
                if ($x == $cnt) {
                    array_push($result,$data);
                }
            }
        }
        return $result;
    }

    # obtem lista de colunas de designações para o statment de SELECT
    # ponderando as colunas de tradução
    function getDSPColumnsTranslate(){

        # constroi array contendo os separadores com as colunas de designação
        $desigs = $this->multiexplode(['(',')',',',' '],$this->desigColumn);
        $existe = false;

        # percorre todos os elementos do array para substituir as colunas de designação
        # exemplo: A.DSP_COL -> COALESCE(B.DSP_TRAD,A.DSP_COL)
        for ($x = 0; $x < count($desigs); $x++) {
            #
            # exceções:
            #
            # CG_REF_CODES : RV_MEANING -> DSP, RV_ABBREVIATION -> DSR
            # DG_GD_VARIAVEIS : OBS -> DESCRICAO
            # WEB_ADM_COLUNAS : CONTEXTO -> CONTEXTO_TRAD, DESCRICAO -> DESCRICAO_TRAD
            #
            if ($this->dbTable == 'CG_REF_CODES') {
                //$this->debug
                //    ? ($col_ = "RV_MEANING")
                //    : ($col_ = "A.RV_MEANING");
                $col_ = "A.RV_MEANING";
                if (strpos(strtoupper($desigs[$x]), $col_) === false) {
                    null;
                } else {
                    $dsp = trim($desigs[$x]);
                    $desigs[$x] = "COALESCE(B.DSP_TRAD,$dsp)";
                    $existe = true;
                }

                //$this->debug
                //    ? ($col_ = "RV_ABBREVIATION")
                //    : ($col_ = "A.RV_ABBREVIATION");
                $col_ = "A.RV_ABBREVIATION";
                if (strpos(strtoupper($desigs[$x]), $col_) === false) {
                    null;
                } else {
                    $dsp = trim($desigs[$x]);
                    $desigs[$x] = "COALESCE(B.DSR_TRAD, $dsp)";
                    $existe = true;
                }
            } elseif ($this->dbTable == 'DG_GD_VARIAVEIS') {
                //$this->debug ? ($col_ = "OBS") : ($col_ = "A.OBS");
                $col_ = "A.OBS";
                if (strpos(strtoupper($desigs[$x]), $col_) === false) {
                    null;
                } else {
                    $dsp = trim($desigs[$x]);
                    $desigs[$x] = "COALESCE(B.DESCRICAO,$dsp)";
                    $existe = true;
                }
            } elseif ($this->dbTable == 'WEB_ADM_COLUNAS') {
                //$this->debug ? ($col_ = "CONTEXTO") : ($col_ = "A.CONTEXTO");
                $col_ = "A.CONTEXTO";
                if (strpos(strtoupper($desigs[$x]), $col_) === false) {
                    null;
                } else {
                    $dsp = trim($desigs[$x]);
                    $desigs[$x] = "COALESCE(B.CONTEXTO_TRAD,$dsp)";
                    $existe = true;
                }

                //$this->debug ? ($col_ = "DESCRICAO") : ($col_ = "A.DESCRICAO");
                $col_ = "A.DESCRICAO";
                if (strpos(strtoupper($desigs[$x]), $col_) === false) {
                    null;
                } else {
                    $dsp = trim($desigs[$x]);
                    $desigs[$x] = "COALESCE(B.DESCRICAO_TRAD,$dsp)";
                    $existe = true;
                }
            } else {
                # tratamento das designações
                //$this->debug ? ($col_ = "DSP") : ($col_ = "A.DSP");
                $col_ = "A.DSP";
                if (strpos(strtoupper($desigs[$x]), $col_) === false) {
                    null;
                } else {
                    $dsp = trim($desigs[$x]);
                    $desigs[$x] = "COALESCE(B.DSP_TRAD,$dsp) ";
                    $existe = true;
                }

                # tratamento das designações reduzidas
                //$this->debug ? ($col_ = "DSR") : ($col_ = "A.DSR");
                $col_ = "A.DSR";
                if (strpos(strtoupper($desigs[$x]), $col_) === false) {
                    null;
                } else {
                    $dsp = trim($desigs[$x]);
                    $desigs[$x] = "COALESCE(B.DSR_TRAD,$dsp) ";
                    $existe = true;
                }

                # tratamento das descrições
                //$this->debug ? ($col_ = "DESCRICAO") : ($col_ = "A.DESCRICAO");
                $col_ = "A.DESCRICAO";
                if (strpos(strtoupper($desigs[$x]), $col_) === false) {
                    null;
                } else {
                    $dsp = trim($desigs[$x]);
                    $desigs[$x] = "COALESCE(B.DESCRICAO,$dsp) ";
                    $existe = true;
                }
            }
        }

        if ($existe) {
            # concatena de volta numa strig o resultado
            $resultado = '';
            for ($x = 0; $x < count($desigs); $x++) {
                $resultado .= $desigs[$x];
            }
            return $resultado;
        }
        return $existe;
    }

    ###########

    # adiciona as colunas aos SELECT
    function buildSelectSQL() {

        $this->sql = "SELECT ";

        # adiciona as colunas ao SELECT
        $concatPk = $this->getConcatPK();
        $concatOtherValues = $this->getConcatOtherValues();

        if ($this->desigColumn !== '') {

            $col_alias = '"'.str_replace($this->alias.".","",$this->desigColumn).'"';

            # tem tabela de traduções -> adiciona COALESCE(DSP_xxx,DSP_TRAD)
            if ($this->table_translate) {
                $desig = $this->getDSPColumnsTranslate();
                if ($desig) {
                    $this->sql = $this->sql . $desig . " $col_alias,";
                } else {
                    # não houve substituição => inativa tabela de tradução
                    $this->table_translate = false;
                    $this->sql = $this->sql . $this->desigColumn . " $col_alias,";
                }
            } else {
                $this->sql = $this->sql . $this->desigColumn . " $col_alias,";
            }

            $this->sql = $this->sql . $concatPk . ' "VAL" ';
        } 
        else {
            $this->sql = $this->sql . $concatPk . ' "VAL" ';
        }

        # adiciona colunas de otherValues
        if ($concatOtherValues !== '') {
            $this->sql = $this->sql . ',' . $concatOtherValues . ' "OTHERVALUES" ';
        }

        # adiciona a tabela
        $this->sql = $this->sql . 'FROM ' . $this->dbTable. ' ' . $this->alias. ' ';

        # tem tabela de traduções -> adiciona join com a respetiva tabela
        if ($this->table_translate && $this->desigColumn !== '') {
            $pkTransCols = $this->getPKColumnsTranslate();
            $cd_lang = @$_SESSION['lang_db'];
            (!isset($cd_lang)) ? $cd_lang = 0 : null;
            $this->sql = $this->sql . " LEFT JOIN ".$this->table_translate." B ".
                                      " ON ".$pkTransCols." ".
                                      " AND B.CD_LINGUA = $cd_lang ".
                " AND B.DT_FIM IS NULL ";
        }

        # adiciona WHERE
        if ($this->where !== '') {
            $this->sql = $this->sql . " WHERE 1 = 1 " . $this->where . $this->filtered;
        } else {
            $this->sql = $this->sql . " WHERE 1 = 1 " . $this->filtered;
        }

        # adiciona ORDER BY
        if ($this->orderBy !== '') {
            $this->sql = $this->sql . " ORDER BY " . $this->orderBy;
        }
    }

    # executa o SELECT
    function executeSQL($db, $memcache, &$msg) {
        $msg = '';

        try {
            $stmt = $db->prepare($this->sql);
            $stmt->execute();
            $nrows = $stmt->rowCount();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            # só coloca em cache query com nr.registos <= ao CACHE_ROW_LIMIT
            if ($nrows <= self::CACHE_ROW_LIMIT && $this->arrIdx != '') {
                # memcached indexes dont accept white spaces
                $memcache->set(str_replace(' ', '', $this->arrIdx).@$_SESSION['lang'], $res, 0);
            }
            return $res;
        } catch (PDOException $e) {
            $msg = "Error FETCHING [$this->sql] on :" . $e->getMessage();
        }
    }
}