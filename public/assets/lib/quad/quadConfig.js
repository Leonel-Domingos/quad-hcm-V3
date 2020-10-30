var quadConfig = {
    regExpressions:{
        alias:/([a-z]{1,}|[A-Z]{1,})\./gm
    },
    file_max_size: 5, //Megabytes -> Used on E-TICKETS.PHP
    workflow: {
        classNames: {
            quadForm: {
                column: "frmColWkf",
                record: "frmRecordWkf",
                form: "frmRecordWkf2",
                columnImg: "frmColImgWkf"
            },
            quadTable: {
              column: "tableColWkf",
              record: "tableRecordWkf",
              table: "tableRecordWkf2"
            }
        }
    },
    timelogUsertype: false,
    defaultCRUD: [true, true, true],
    dateYearMonth: "yy-mm", // quadTables:468 a 492 formatos internos do datepicker
    datePickerFormat: "yy-mm-dd", // quadTables:468 a 492 formatos internos do datepicker
    dateTimePickerTimeFormat: "HH:mm:ss", // quadTables:468 a 492 formatos internos do datepicker
    dateTimePickerTimeFormatShort: "HH:mm", // quadTables:468 a 492 formatos internos do datepicker
    dbDateFormat: "YYYY-MM-DD", // quadCore.toDateToDatetime formatação de where clauses
    dbYearMonth: "YYYY-MM", // quadCore.toDateToDatetime formatação de where clauses
    dbDateTimeFormat: "YYYY-MM-DD HH24:MI:SS", // quadCore.toDateToDatetime formatação de where clauses
    dbDateTimeShortFormat: "YYYY-MM-DD HH24:MI", // quadCore.toDateToDatetime formatação de where clauses
    dbTimeMinutes: "HH24:MI", // quadCore.toDateToDatetime formatação de where clauses
    dbTimeSeconds: "HH24:MI:SS", // quadCore.toDateToDatetime formatação de where clauses
    sqlConditions: [
      "!=",
      "<>",
      "<=",
      ">=",
      "!<",
      "!>",
      ">",
      "<",
      "=",
      "%",
      "LIKE",
      "NOT LIKE",
      "IS NOT NULL",
      "IS NULL",
      "BETWEEN",
      "IN"
    ],
    //sqlConditions: ['=', '>', '<', '<>', '!=', '<=', '>=', '%', 'LIKE', 'IS NULL', 'IS NOT NULL', 'BETWEEN', 'IN'],
    intFormat: "uk-UK",
    env: "prod", // KEY's on EDIT -> dev :: ENABLED ou prod :: DISABLED
    user: 1,
    tabclass: "tab-pane",
    activeTabClass: "active",
    upload_file_controller: "quad_controller_upload.php",
    download_file_controller: "quad_controller_download.php",
    export_controller: "assets/lib/utils/sampleWorker.js",
    columnBDColumn: "BD_DOC",
    columnDefaultBDMime: "BD_MIME",
    columnDefaultName: "LINK_DOC",
    rhid_no_photo: "assets/img/fotos/user-alt.svg",
    loading_img: "assets/img/contiLoading.svg",
    tableEvents: {
      //Extended by PMA 2018-03-16
      loading:
        '<h1 id="load_:tableID:" class="table-wrap custom-scroll animated fast fadeInRight quadWait"><i class="far fa-cog fa-spin"></i> Loading...</h1>',
      eventDefaultParams: ["settings", "json"], //Could be extended to cover all particular parameters usages on ALL events of ALL interfaces. Ex: ['settings', 'json', 'newParameters', ...]
      /* This is the CODE TO BE INJECTED by QuadTable.quadPrep(), in order to control that the "Loading..." would only be executed ONCE on the FIRST RUN. */
      preDrawCallback:
        "if (settings._firstRun === undefined) { " +
        "   settings._firstRun = 1;" +
        "  /* Tornamos transparente a DIV (parent) onde será renderizada a instância */ " +
        "  $('#load_:tableID:').css({opacity: '0.0'});  " +
        "  /* Tornamos transparente a DIV onde será renderizada a instância */ " +
        "   $('#:tableID:_wrapper').css({opacity: 0.0}); " +
        "}",
      /* This is the CODE TO BE INJECTED by QuadTable.quadPrep() to control the data readiness.
       * NOTE: If the HTML of the instance would be placed is inside a DIV w/opacity = 0.0 (the buttons and extras would be also hidden until
       * all data is compiled and ready to be displayed), this have has to be a little change (replacing #:tableID:_wrapper by that DIV selector) */
      initComplete:
        "setTimeout(function () { " +
        "$('#:tableID:_wrapper').css({ " +
        "   opacity: '0.0'}, 0)." +
        "animate({opacity: '0.1', display: 'block'},100)." +
        "animate({opacity: '0.2'},100)." +
        "animate({opacity: '0.3'},100)." +
        "animate({opacity: '0.4'},100)." +
        "animate({opacity: '0.5'},100)." +
        "animate({opacity: '0.6'},100)." +
        "animate({opacity: '0.7'},100)." +
        "animate({opacity: '0.8'},100)." +
        "animate({opacity: '0.9'},100)." +
        "animate({opacity: '1.0'},100);" +
        "$('#load_:tableID:').css({ " +
        "   opacity: '1.0', display: 'block'}, 0)." +
        "animate({opacity: '0.9'},100)." +
        "animate({opacity: '0.8'},100)." +
        "animate({opacity: '0.7'},100)." +
        "animate({opacity: '0.6'},100)." +
        "animate({opacity: '0.5'},100)." +
        "animate({opacity: '0.4'},100)." +
        "animate({opacity: '0.3'},100)." +
        "animate({opacity: '0.2'},100)." +
        "animate({opacity: '0.1'},100)." +
        "animate({opacity: '0.0'},100).css({ " +
        "   display: 'none'}, 0);" +
        "settings._firstRun = 0;" +
        "}, 100)"
    },
    loadData: {
      /* EXEMPLO COM MAIS DO QUE UMA COLUNA DO TIPO "DATE" -> date OR datetime OR datetimeShort
              "dateFields": [{'DT_INI_GRP_MOTIVO':'date'}, {'DT_INI_MOTIVO':'datetimeShort'}]
      */ 
        1: {
          attr: {
            "desigColumn": "A.EMPRESA",
            "data-db-name": "A.EMPRESA",
            "decodeFromTable": "DG_EMPRESAS A",
            "orderBy": "A.NR_ORDEM"
          }
        },
        2: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)",
                "data-db-name": "A.RHID",
                "decodeFromTable": "QUAD_PEOPLE A",
                "orderBy": "A.NOME_REDZ"
            }
        },
        3: {
            attr: {
                "desigColumn": "A.DSP_DOC_ID",
                "data-db-name": "A.CD_DOC_ID",
                "decodeFromTable": "DG_DOCUMENTOS A",
                "orderBy": "A.CD_DOC_ID"
            }
        },
        4: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_ENT_INT,'-'),A.DSP_ENT_INT)",
                "data-db-name": "A.EMPRESA@A.CD_ENT_INT",
                "decodeFromTable": "DG_ENTIDADES_INTERNAS A",
                "orderBy": "A.CD_ENT_INT"
            }
        },
        5: {
            attr: {
                "desigColumn": "NVL(A.DSP_NACIONALIDADE,A.DSP_PAIS)",
                "data-db-name": "A.CD_PAIS",
                "decodeFromTable": "DG_PAISES A",
                "orderBy": "A.CD_PAIS"
            }
        },
        6: {
            attr: {
                "desigColumn": "A.DSP_PAIS",
                "data-db-name": "A.CD_PAIS",
                "decodeFromTable": "DG_PAISES A",
                "orderBy": "A.CD_PAIS"
            }
        },    
        7: {
            attr: {
                "desigColumn": "A.DSP_DISTRITO",
                "data-db-name": "A.CD_PAIS@A.CD_DISTRITO",
                "decodeFromTable": "DG_DISTRITOS A",
                "orderBy": "A.CD_PAIS,A.CD_DISTRITO"
            }
        },
        8: {
            attr: {
                "desigColumn": "A.DSP_CONCELHO",
                "data-db-name": "A.CD_PAIS@A.CD_DISTRITO@A.CD_CONCELHO",
                "decodeFromTable": "DG_CONCELHOS A",
                "orderBy": "A.CD_PAIS,A.CD_DISTRITO,A.CD_CONCELHO"
            }
        },
        9: {
            attr: {
                "desigColumn": "A.DSP_FREGUESIA",
                "data-db-name": "A.CD_PAIS@A.CD_DISTRITO@A.CD_CONCELHO@A.CD_FREGUESIA",
                "decodeFromTable": "DG_FREGUESIAS A",
                "orderBy": "A.CD_PAIS,A.CD_DISTRITO,A.CD_CONCELHO,A.CD_FREGUESIA"
            }
        },
        10: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_SITUACAO,'-'),A.DSP_SITUACAO)",
                "data-db-name": "A.CD_SITUACAO",
                "decodeFromTable": "RH_DEF_SITUACOES A",
                "orderBy": "A.CD_SITUACAO"
            }
        },
        11: {
            attr: {
                "desigColumn": "NVL(A.DSR_ESTAB,A.DSP_ESTAB)",
                "data-db-name": "A.EMPRESA@A.CD_ESTAB",
                "decodeFromTable": "DG_ESTABELECIMENTOS A",
                "orderBy": "A.CD_ESTAB"
            }
        },
        12: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_REGRA, '-'), A.DSR_REGRA)",
                "data-db-name": "A.CD_REGRA",
                "decodeFromTable": "RH_DEF_REGRAS_ATRIBUICAO A",
                "orderBy": "A.CD_REGRA"
            }
        },
        13: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_GRP_CONTAB, '-'), A.DSR_GRP_CONTAB)",
                "data-db-name": "A.CD_GRP_CONTAB",
                "decodeFromTable": "DG_DEF_GRUPOS_CONTABILISTICOS A",
                'whereClause': " AND A.RH_TP_INTERFACE = 'B'",
                "orderBy": "A.CD_GRP_CONTAB"
            }
        },
        14: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_MOEDA,'-'), A.DSP_MOEDA)",
                "data-db-name": "A.CD_MOEDA",
                "decodeFromTable": "DG_MOEDAS A",
                "orderBy": "A.CD_MOEDA"
            }
        },
        15: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_CATG_PROF,'-'),A.DSP_CATG_PROF)",
                "data-db-name": "A.CD_CATG_PROF",
                "decodeFromTable": "RH_DEF_CATS_PROFISSIONAIS A",
                "orderBy": "A.CD_CATG_PROF"
            }
        },
        16: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_CATG_PROF_INTERNA,'-'),A.DSP_CATG_PROF_INTERNA)",
                "data-db-name": "A.CD_CATG_PROF_INTERNA",
                "decodeFromTable": "RH_DEF_CATEG_PROF_INTERNAS A",
                "orderBy": "A.CD_CATG_PROF_INTERNA"
            }
        },
        17: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_IRCT, '-'), A.DSR_IRCT)",
                "data-db-name": "A.CD_IRCT@A.DT_EFICACIA",
                "decodeFromTable": "RH_DEF_IRCT A",
                "orderBy": "A.DT_EFICACIA DESC"
            }
        },
        18: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_PROFISSAO, '-'), A.DSR_PROFISSAO)",
                "data-db-name": "A.CD_PROFISSAO",
                "decodeFromTable": "RH_DEF_PROFISSOES A",
                "orderBy": "A.CD_PROFISSAO"
            }
        },
        19: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_NIVEL_QUALIF, '-'), A.DSP_NIVEL_QUALIF)",
                "data-db-name": "A.CD_NIVEL_QUALIF",
                "decodeFromTable": "RH_DEF_NIVEIS_QUALIFICACAO A",
                "orderBy": "A.CD_NIVEL_QUALIF"
            }
        },
        20: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_REGRA_PONTO, '-'), A.DSR_REGRA_PONTO)",
                "data-db-name": "A.CD_REGRA_PONTO",
                "decodeFromTable": "RH_DEF_REGRAS_PONTO A",
                "orderBy": "A.CD_REGRA_PONTO"
            }
        },
        21: {
            attr: {
                "desigColumn": "A.RV_MEANING",
                "data-db-name": "A.RV_DOMAIN@A.RV_LOW_VALUE",
                "decodeFromTable": "CG_REF_CODES A",
                "whereClause": " AND A.RV_DOMAIN = 'RH_DEF_HORARIOS.TP_HORARIO'",
                "orderBy": "A.RV_LOW_VALUE"
            }
        },
        22: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_HORARIO, '-'), A.DSR_HORARIO)",
                "data-db-name": "A.TP_HORARIO@A.CD_HORARIO",
                "decodeFromTable": "RH_DEF_HORARIOS A",
                "orderBy": "A.CD_HORARIO"
            }
        },
        23: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_GRUPO, '-'), A.DSP_GRUPO)",
                "data-db-name": "A.CD_GRUPO",
                "decodeFromTable": "RH_DEF_GRUPOS A",
                "orderBy": "A.CD_GRUPO"
            }
        },
        24: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_NIVEL, '-'), A.DSP_NIVEL)",
                "data-db-name": "A.CD_NIVEL",
                "decodeFromTable": "RH_DEF_NIVEIS A",
                "orderBy": "A.CD_NIVEL"
            }
        },
        25: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_SIT_CONTRIB, '-'), A.DSP_SIT_CONTRIB)",
                "data-db-name": "A.CD_SIT_CONTRIB",
                "decodeFromTable": "RH_DEF_SIT_CONTRIBUTIVAS A",
                "orderBy": "A.CD_SIT_CONTRIB"
            }
        },
        26: {
            attr: {
                "desigColumn": "A.CD",
                "data-db-name": "A.DSP",
                "decodeFromTable": "RH_ID_FUNCOES_TIPO_IN A",
                "orderBy": "A.CD"
            }
        },     
        27: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.ID_FUNCAO, '-'), A.DSR_FUNCAO)",
                "data-db-name": "A.EMPRESA@A.ID_FUNCAO@A.TP_REGISTO@A.DT_INI_FUNCAO",
                "decodeFromTable": "RH_DEF_FUNCOES A",
                "whereClause": " AND A.TP_REGISTO = 'A' ",
                "orderBy": "A.ID_FUNCAO DESC",
                "dateFields": [{"A.DT_INI_FUNCAO": "date"}]
            }
        },
        28: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_VINCULO,'-'), A.DSR_VINCULO)",
                "data-db-name": "A.TP_VINCULO@A.CD_VINCULO",
                "decodeFromTable": "RH_DEF_VINCULOS_CONTRATUAIS A",
                "orderBy": "A.CD_VINCULO"
            }
        },
        29: {
            attr: {
                "desigColumn": "A.DSP_MOTIVO_SAIDA",
                "data-db-name": "A.TP_VINCULO@A.CD_MOTIVO_SAIDA",
                "decodeFromTable": "RH_DEF_MOTIVOS_SAIDA A",
                "orderBy": "A.CD_MOTIVO_SAIDA DESC"
            }
        },
        30: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_DIRECAO,'-'),A.DSP_DIRECAO)",
                "data-db-name": "A.EMPRESA@A.CD_DIRECAO@A.DT_INI_DIRECAO",
                "decodeFromTable": "DG_DIRECOES A",
                "orderBy": "A.EMPRESA,A.CD_DIRECAO",
                "dateFields": [{"A.DT_INI_DIRECAO": "date"}]
            }
        },
        31: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_DEPT,'-'),A.DSP_DEPT)",
                "data-db-name": "A.EMPRESA@A.CD_DIRECAO@A.DT_INI_DIRECAO@A.CD_DEPT@A.DT_INI_DEPT",
                "decodeFromTable": "DG_DEPARTAMENTOS A",
                "orderBy": "A.EMPRESA,A.CD_DIRECAO,A.CD_DEPT",
                "dateFields": [{"A.DT_INI_DIRECAO": "date"}]
            }
        },
        32: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_JOB,'-'),A.DSP_JOB)",
                "data-db-name": "A.CD_JOB@A.DT_INI_JOB",
                "decodeFromTable": "DG_JOBS A",
                "orderBy": "A.CD_JOB",
                "dateFields": [{"A.DT_INI_JOB": "date"}]
            }
        },
        33: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.ID_SETOR,'-'),A.DSP_SETOR)",
                "data-db-name": "A.EMPRESA@A.CD_ESTAB@A.ID_SETOR@A.DT_INI",
                "decodeFromTable": "DG_SETORES A",
                "orderBy": "A.ID_SETOR",
                "dateFields": [{"A.DT_INI": "date"}]
            }
        },
        34: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_ED,'-'),A.DSP_ED)",
                "data-db-name": "A.CD_ED",
                "decodeFromTable": "RH_DEF_ENTIDADES_DESCONTO A",
                "orderBy": "A.CD_ED"
            }
        },
        35: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_REG_DESC,'-'),A.DSP_REG_DESC)",
                "data-db-name": "A.CD_ED@A.CD_REG_DESC",
                "decodeFromTable": "RH_REGIMES_DESCONTO A",
                "orderBy": "A.CD_REG_DESC"
            }
        },
        36: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_GRELHA_SALARIAL,'-'),A.DSP_GRELHA_SALARIAL)",
                "data-db-name": "A.CD_GRELHA_SALARIAL",
                "decodeFromTable": "RH_DEF_GRELHAS_SALARIAIS A",
                "otherValues": "A.TP_GRELHA_SALARIAL",
                "orderBy": "A.CD_GRELHA_SALARIAL"
            }
        },
        37: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_LINHA_SALARIAL,'-'),A.DSP_LINHA_SALARIAL)",
                "data-db-name": "A.CD_GRELHA_SALARIAL@A.CD_LINHA_SALARIAL",
                "decodeFromTable": "RH_DEF_LINHAS_SALARIAIS A",
                "orderBy": "A.CD_LINHA_SALARIAL"
            }
        },
        38: {
            attr: {
                "desigColumn": "A.VALOR",
                "data-db-name": "A.CD_GRELHA_SALARIAL@A.CD_LINHA_SALARIAL",
                "decodeFromTable": "RH_DEF_VALORES_SALARIAIS A",
                "whereClause": " AND A.DT_INACTIVO IS NULL",
                "orderBy": "A.CD_GRELHA_SALARIAL,A.CD_LINHA_SALARIAL"
            }
        },
        39: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_IRCT, '-'), A.DSP_IRCT)",
                "data-db-name": "A.CD_IRCT@A.DT_EFICACIA@A.DT_INI_RA",
                "decodeFromTable": "RH_DEF_REGRAS_ADAPTABILIDADE_VIEW A",
                "orderBy": "A.DT_INI_RA DESC",
                "dateFields": [{"A.DT_INI_RA": "date"}]
            }
        },
        40: {
            attr: {
                "desigColumn": "A.DSP_PERFIL",
                "data-db-name": "A.ID",
                "decodeFromTable": "WEB_ADM_PERFIS A",
                "orderBy": "A.ID"
            }
        },
        41: {
            attr: {
                "desigColumn": "A.UTILIZADOR",
                "data-db-name": "A.ID",
                "decodeFromTable": "WEB_ADM_UTILIZADORES A",
                "orderBy": "A.ID"
            }
        },
        42: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.CD_HAB_LIT,'-'),A.DSP_HAB_LIT)",
                "data-db-name": "A.CD_HAB_LIT",
                "decodeFromTable": "RH_DEF_HAB_LITERARIAS A",
                "orderBy": "A.CD_HAB_LIT"
            }
        },
        43: {
            attr: {
                "desigColumn": "A.DSP_HAB_PROF",
                "data-db-name": "A.EMPRESA@A.CD_HAB_PROF@A.DT_INI_HAB_PROF",
                "decodeFromTable": "RH_DEF_HAB_PROFISSIONAIS A",
                "orderBy": "A.CD_HAB_PROF",
                "dateFields": [{"A.DT_INI_HAB_PROF": "date"}]
            }
        },
        44: {
            attr: {
                "desigColumn": "A.DSP_EP",
                "data-db-name": "A.EMPRESA@A.ID_EP@A.DT_INI_EP",
                "decodeFromTable": "RH_DEF_ESCALAS_PROFICIENCIA A",
                "orderBy": "A.EMPRESA,A.ID_EP,A.DT_INI_EP",
                "dateFields": [{"A.DT_INI_EP": "date"}]
            }
        },
        45: {
            attr: {
                "desigColumn": "NVL(A.DSR_NEP, A.DSP_NEP)",
                "data-db-name": "A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA",
                "decodeFromTable": "RH_NIVEIS_ESCALA_PROFICIENCIA A",
                "orderBy": "A.EMPRESA,A.ID_EP,A.DT_INI_EP,A.ID_NV_ESCALA,A.DT_INI_NV_ESCALA",
                "dateFields": [{"A.DT_INI_EP": "date"},{"A.DT_INI_NV_ESCALA": "date"}]
            }
        },
        46: {
            attr: {
                "desigColumn": "A.DSP_FF",
                "data-db-name": "A.CD_FF",
                "decodeFromTable": "RH_DEF_FLEXFIELDS A",
                "otherValues": "A.CONTEXTO@A.DOMINIO@A.SQL_CODE@A.SCC_ACTVO",
                "orderBy": "NVL(A.NR_ORDEM,A.CD_FF)"
            }
        },
        47: {
            attr: {
                "desigColumn": "A.DSP_ITEM",
                "data-db-name": "A.CD_ITEM",
                "decodeFromTable": "RH_DEF_ITEMS A",
                "orderBy": "A.CD_ITEM"
            }
        },
        48: {
            attr: {
                "desigColumn": "A.DSP_SUB_ITEM",
                "data-db-name": "A.CD_ITEM@A.CD_SUB_ITEM",
                "decodeFromTable": "RH_DEF_SUB_ITEMS A",
                "orderBy": "A.CD_SUB_ITEM"
            }
        },
        49: {
            attr: {
                "desigColumn": "A.DSP_TP_CARACT",
                "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT",
                "decodeFromTable": "RH_DEF_TP_CARACTERISTICAS A",
                "orderBy": "A.ID_TP_CARACT",
                "dateFields": [{"A.DT_INI_TP_CARACT": "date"}]
            }
        },
        50: {
            attr: {
                "desigColumn": "A.DSP_DOM_1",
                "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT@A.ID_DOM_1@A.DT_INI_DOM_1",
                "decodeFromTable": "RH_DEF_DOMINIOS_1 A",
                "orderBy": "A.ID_DOM_1",
                "dateFields": [{"A.DT_INI_TP_CARACT": "date"},{"A.DT_INI_DOM_1": "date"}]
            }
        },
        51: {
            attr: {
                "desigColumn": "A.DSP_DOM_2",
                "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT@A.ID_DOM_1@A.DT_INI_DOM_1@A.ID_DOM_2@A.DT_INI_DOM_2",
                "decodeFromTable": "RH_DEF_DOMINIOS_2 A",
                "orderBy": "A.ID_DOM_2",
                "dateFields": [{"A.DT_INI_TP_CARACT": "date"},{"A.DT_INI_DOM_1": "date"},{"A.DT_INI_DOM_2": "date"}]
            }
        },
        52: {
            attr: {
                "desigColumn": "A.DSP_CARACTERISTICA",
                "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT@A.ID_DOM_1@A.DT_INI_DOM_1@A.ID_DOM_2@A.DT_INI_DOM_2@A.ID_CARACTERISTICA@A.DT_INI_CARACT",
                "decodeFromTable": "RH_DEF_CARACTERISTICAS A",
                "orderBy": "A.ID_CARACTERISTICA",
                "dateFields": [{"A.DT_INI_TP_CARACT": "date"},{"A.DT_INI_DOM_1": "date"},{"A.DT_INI_DOM_2": "date"},{"A.DT_INI_CARACT": "date"}]
            }
        },
        53: {
            attr: {
                "desigColumn": "A.DSP_CURSO",
                "data-db-name": "A.EMPRESA@A.ID_CURSO@A.TP_REGISTO@A.DT_INI_CURSO",
                "decodeFromTable": "GF_CURSOS A",
                "orderBy": "A.ID_CURSO",
                "dateFields": [{"A.DT_INI_CURSO": "date"}]
            }
        },
        54: {
            attr: {
                "desigColumn": "A.DSP_ACAO",
                "data-db-name": "A.EMPRESA@A.ID_CURSO@A.TP_REGISTO@A.DT_INI_CURSO@A.ID_ACAO@A.DT_INI_ACAO",
                "decodeFromTable": "GF_ACOES A",
                "orderBy": "A.ID_ACAO",
                "dateFields": [{"A.DT_INI_CURSO": "date"},{"A.DT_INI_ACAO": "date"}]
            }
        },
        55: {
            attr: {
                "desigColumn": "A.DSP_COMPETENCIA",
                "data-db-name": "A.EMPRESA@A.ID_COMPETENCIA@A.DT_INI_COMPETENCIA",
                "decodeFromTable": "RH_DEF_COMPETENCIAS A",
                "orderBy": "A.ID_COMPETENCIA",
                "dateFields": [{"A.DT_INI_COMPETENCIA": "date"}]
            }
        },
        56: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)",
                "data-db-name": "A.RHID",
                "decodeFromTable": "QUAD_NAMES A",
                "orderBy": "A.RHID"
            }
        },
        57: {
            attr: {
                "desigColumn": "A.DSP_COMPORTAMENTO",
                "data-db-name": "A.EMPRESA@A.ID_COMPETENCIA@A.DT_INI_COMPETENCIA@A.ID_COMPORTAMENTO@A.DT_INI_COMPORTAMENTO",
                "decodeFromTable": "RH_DEF_COMPORTAMENTOS A",
                "orderBy": "A.ID_COMPORTAMENTO",
                "dateFields": [{"A.DT_INI_COMPETENCIA": "date"},{"A.DT_INI_COMPORTAMENTO": "date"}]
            }
        },
        58: {
            attr: {
                "desigColumn": "A.DSP_OBJECTIVO",
                "data-db-name": "A.EMPRESA@A.ID_OBJECTIVO@A.DT_INI_OBJECTIVO",
                "decodeFromTable": "RH_DEF_OBJECTIVOS A",
                "orderBy": "A.ID_OBJECTIVO",
                "dateFields": [{"A.DT_INI_OBJECTIVO": "date"}]
            }
        },      
        59: {
            attr: {
                "desigColumn": "CONCAT(CONCAT(A.NOME_AGREGADO,'-'), DOMINIO('RH_GRAU_PARENTESCO', A.GRAU_PARENTESCO,'A'))",
                "data-db-name": "A.RHID@A.CD_AGREGADO",
                "decodeFromTable": "RH_ID_AGREGADOS A",
                "orderBy": "A.CD_AGREGADO"
            }
        },
    /*    
     
"attr": {
    "deferred": true,
    "dependent-group": "ANOS_FISCAIS",
    "dependent-level": 1,
    "data-db-name": 'ANO',
    "decodeFromTable": 'DG_ANOS',
    "class": "form-control complexList",
    "desigColumn": "ANO",
    "orderBy": "ANO DESC",     
        
      59: {
          attr: {
              "desigColumn": "",
              "data-db-name": "",
              "decodeFromTable": "",
              "orderBy": ""
          }
      },
      99: {
      attr: {
          "data-db-name": 'CD_PAIS@CD_POSTAL@NR_ORDEM',
          "decodeFromTable": 'DG_CODIGOS_POSTAIS',
          "desigColumn": "DSP_POSTAL",
          "orderBy"': 'CD_PAIS,CD_POSTAL,NR_ORDEM'
      }
    */
    },
    domains: {
        1: {
            "dependent-group": "DG_SIM_NAO"
        },
        2: {
            "dependent-group": "RH_ID_ENT_INTERNAS.TIPO"
        },
        3: {
            "dependent-group": "RH_MOTIVO_ADMISSAO"
        },
        4: {
            "dependent-group": "RH_ESTADO_CIVIL"
        },
        5: {
            "dependent-group": "RH_IDENTIFICACOES.GENERO"
        },
        6: {
            "dependent-group": "RH_ID_DEPTS.TIPO"
        },
        7: {
            "dependent-group": "RH_GRAU_PARENTESCO"
        },
        8: {
            "dependent-group": "GRAU_DEFICIENCIA"
        },
        9: {
            "dependent-group": "RH_INSTITUICOES"
        },
        10: {
            "dependent-group": "RH_AREA_ESTUDO"
        },
        11: {
            "dependent-group": "RH_GRAU_ACADEMICO"
        },
        12: {
            "dependent-group": "RH_CTX_MIS"
        },
        13: {
            "dependent-group": "RH_ID_EMPRESAS.TIPO_TRABALHO"
        },
        14: {
            "dependent-group": "RH_EMP_TRAB_TEMP"
        },
        15: {
            "dependent-group": "RH_TP_IRS"
        },
        16: {
            "dependent-group": "RH_TABELA_IRS"
        },
        17: {
            "dependent-group": "RH_EST_CIVIL_IRS"
        },
        18: {
            "dependent-group": "RH_ID_RETRIBUTIVOS.GRAU_DEFICIENCIA"
        },
        19: {
            "dependent-group": "DG_REPARTICAO_FISCAL"
        },
        20: {
            "dependent-group": "RH_ID_RETRIBUTIVOS.TP_DIUTURNIDADE"
        },
        21: {
            "dependent-group": "RH_AREA_SINDICAL"
        },
        22: {
            "dependent-group": "RH_REGIME_SINDICAL"
        },
        23: {
            "dependent-group": "RH_FORMA_PAGAM"
        },
        24: {
            "dependent-group": "RH_ID_RETRIBUTIVOS.TP_VLR_BI_TB"
        },
        25: {
            "dependent-group": "RH_ID_PROFISSIONAIS.SITUACAO_PROF"
        },
        26: {
            "dependent-group": "RH_ID_PROFISSIONAIS.TP_PROMOCAO"
        },
        /* E-TTCKETS */
        27: {
            "dependent-group": "WEB_PRIO_HLPDSK"
        },
        28: {
            "dependent-group": "WEB_ESTADO_HLPDSK"
        },
        29: {
            "dependent-group": "WEB_PROCESSO_HLPDSK"
        },
        30: {
            "dependent-group": "WEB_TP_PEDIDO_HLPDSK"
        },
        31: {
            "dependent-group": "WEB_CATEG_HLPDSK"
        },
        32: {
            "dependent-group": "ACTIVE_USERS"
        },
        33: {
            "dependent-group": "ALL_USERS"
        },
        34: {
            "dependent-group": "RH_DEF_AUSENCIAS.UNIDADE_LIMITES"
        }
    }
}
