    /**
     * Created by led on 03-12-2015.
     */
    /*jslint
     node: true, browser: true,  nomen: true
     */
    /*global $, QuadCore, QuadList, quadConfig, matchQry, QuadForm */
    "use strict";
    var QuadTable;
    /**
     * Represents a quadTable.
     * @constructor
     */
    QuadTable = function () {};
    //Extende o metodo do quadCore se necessario.
    QuadTable.prototype.logError = function (err) {
        //console.log('chamado do quadTable');
    };
    QuadTable.prototype.constructor = QuadTable;
    QuadTable.prototype = $.extend(
            {},
            QuadEvents.prototype,
            QuadEditorEvents.prototype,
            QuadCore.prototype,
            QuadList.prototype,
            QuadWorkFlow.prototype
            );
    QuadTable.prototype.initTable = function (parms) {
        /* Inicializamos os objectos(se ainda não existirem), onde guardamos os valores que descodificam listas,
         * e carregamos THIS com a parametrização existente no interface
         */
        window["dsbButtons"] = window["dsbButtons"] || [];

        parms = this.filteredParms(parms);

        $.extend(this, parms);
        this["tableColsCopy"] = [];

        $.extend(true, this.tableColsCopy, parms.tableCols);
        /*this['parms']=parms;*/
        this.fixTargets();
        var obj = this;
        try {
            obj.quadPrep(); //PMA extention
        } catch (e) {
            null;
        }
        //disable button while process is running
        setTimeout(function () {
            _.forEach(window["dsbButtons"], function (item, i) {
                $(item.selector).attr("disabled", true);
            });
        }, 1000);
        obj.checkCrud();
        //inicializamos propriedades 'privates',etc...
        this.startIn = 0;
        this.operation = "SELECT";

        /* Percorremos a definição das colunas no interface e construimos o array de objectos que será enviado para o servidor.
         * Neste momento está apenas inicializado.
         * será prenchido de acordo com o contexto com recurso a outos métodos. ex: prepareData() e setDML()
         */

        obj.buildDbColumnsStructure();

        /* Se for um master inicializamos o datatables, o editor e carregamos os dados. */
        if (!this.dependsOn || this.detailsObjects) {
            if (!$.fn.DataTable.isDataTable("#" + obj.tableId)) {
                /* Se datatable para este quadTable estiver inicializado e dentro de uma tab registamos os eventos que permitem a interactividade ex:click, etc.. */
                if (obj.instanceVisible($("#" + obj.tableId))) {
                    setTimeout(function () {
                        obj.addTableEvents();
                        obj.addEditorEvents();
                    }, 0);
                }
            }
        } else {
            /* se for um detail , se estiver visivel e o master estiver "carregado" / inicializado*/
            if (obj.instanceVisible($("#" + obj.tableId))) {
                if (obj instanceof QuadTable) {
                    _.forEach(obj.dependsOn, function (key, o) {
                        setTimeout(function () {
                            /*se o master deste detail já estiver disponível, inicializa datatables e editor da instancia
                             *e carrega dados se master estiver algum registo seleccionado.Regista eventos da UI
                             *Fazemos dentro de um settimeout para assegurar que não inicializamos um detail antes de o master estar completamente carregado /configurado  */
                            if ($.fn.DataTable.isDataTable("#" + window[o].tableId)) {
                                if (!$.fn.DataTable.isDataTable("#" + obj.tableId)) {
                                    obj.initDetails();
                                }
                            }
                        }, 1500);
                    });
                }
            }
        }
        /*Se houver um input do tipo Upload, configuramos/disponibilizamos a feature relacionada */
        if (_.find(this.tableCols, {type: "upload"})) {
            obj.setUpload();
        }
        //verificamos se há persistencia nalgum aspecto da instância ex:orderbY
        this.checkUserPreferences();
    };

    QuadTable.prototype.buildDbColumnsStructure = function () {
        var obj = this;
        var colStr = "";
        obj.dbColumns = [];
        $(obj.tableCols).each(function (i, col) {
            if (col.type === "hidden") {
                delete col.label;
            }
            col.attr = col.attr || {};
            col.attr.name = col.name;
            if (!col.defaultContent) {
                col.defaultContent = "";
            }

            if (obj.colReorder) {
                col.title
                        ? (col.title += '<i class="fa fa-arrows pull-right"></i>')
                        : '<i class="fa fa-arrows pull-right"></i>';
            }
            if (
                    (col.name && col.name !== "BUTTONS" && !col.complexList && col.data) ||
                    col.func
                    ) {
                var db_prv = "" /*Valor da coluna na base de dados*/,
                        db_nxt = "";
                /*Valor da coluna no interface. Os valores por defeito não são "transferidos", uma vez que só com o "COMMIT" todos os campos serão lidos.*/
                if (!col.exclude) {
                    if (col.datatype) {
                        colStr = {
                            db: col.data,
                            prv_value: db_prv,
                            nxt_value: db_nxt,
                            datatype: col.datatype,
                            title: col.label
                        };
                    } else {
                        colStr = {
                            db: col.data,
                            prv_value: db_prv,
                            nxt_value: db_nxt,
                            title: col.label
                        };
                    }
                    if (col.func) {
                        colStr["funcField"] = col.func;
                    }
                    /* Colocamos os objectos filtrados no array */
                    obj.dbColumns.push(colStr);
                }
            }
        });
    };

    QuadTable.prototype.filteredParms = function (parms) {
        var entries = _.filter(parms.tableCols, function (o, i) {
            return o.exclude === true;
        });

        _.forEach(entries, function (o, i) {
            var idx = _.findIndex(parms.tableCols, {data: o.name});
            parms.tableCols.splice(idx, 1);
        });
        return parms;
    };

    QuadTable.prototype.setUpload = function (r) {
        var obj = this;
        if (obj.inRowDoc !== undefined) {
            //In ROW no DATATABLES não usa o EDITOR como intermediário
            $(document).on(
                    "click",
                    "#" + obj.tableId + " a.docsViewer.inRow:not(.inlineEdit)",
                    function (e) {
                        e.preventDefault();
                        e.stopImmediatePropagation();

                        $.post(
                                "data-source/" + quadConfig.download_file_controller,
                                {
                                    tab: $(this).data("table"),
                                    id: $(this).data("reference"),
                                    ref: JSON.stringify(obj.pk.primary)
                                },
                                function (url) {
                                    var link = document.createElement("a");
                                    document.body.appendChild(link);
                                    if (url.blob) {
                                        var dados = base64ToArrayBuffer(url["blob"]);
                                        var blob = new Blob([dados], {type: "application/pdf"});
                                        var downloadBlob = (URL || webkitURL).createObjectURL(blob);
                                        link.download = url["filename"];
                                        link.href = downloadBlob;
                                        link.click();
                                    } else {
                                        var path =
                                                location.origin +
                                                window.location.pathname.replace("home.php", "") +
                                                url;

                                        var arr = url.split("/");
                                        link.download = url;

                                        link.href = path;
                                        link.click();
                                    }
                                    link.remove();
                                }
                        );
                    }
            );
            null;
        }
        //NO EDITOR :: File editor BOTTOM CLOSE button
        $(document).on("click", "#saveFileEditor", function (e) {
            //todo if R and inline edit mode
            if (r) {
                var content = obj.getUploadCell();

                $(content.cell).html(content.template);
                var childCell = $(r)
                        .next(".child")
                        .find(
                                'li[data-dtr-index="' +
                                _.find(obj.tableCols, {name: obj.inRowDoc.fileNameField})[
                                "targets"
                        ] +
                                '"]'
                                );

                $(childCell).html(template);
                return;
            }
            $("div.DTE.DTE_Action_Edit").show();
        });
        //NO EDITOR :: File editor HEADER CLOSE button
        $(document).on(
                "click",
                "#myModal > div > div > div.modal-header > button.close",
                function (e) {
                    $("div.DTE.DTE_Action_Edit").show();
                }
        );
        //NO EDITOR :: File editor OPEN button

        if (r) {
            var selector = "#" + r["id"] + " a.docsViewer.inRow.inlineEdit";
        } else {
            var selector = "#" + obj.tableId + "_editorForm .docsViewer.inRow";
        }
        $(document).on("click", selector, function (e) {
            //DOCS EVENTS :: quadTables AND quadEditor
            e.stopImmediatePropagation();
            e.preventDefault();
            if ($("#myModal", document).length === 0) {
                obj.uploadModal(obj.tableId);
            }
            $("#myModal").modal("toggle");
            var data;
            if (
                    $(
                            $(e.currentTarget)
                            .parent()
                            .get()[0]
                            ).hasClass("DTE_Form_Content")
                    ) {
                data = obj.convertToDTRowData(obj.dbColumns);
                //data= _.find(obj.dbColumns,{db:obj.docsTable.fnName})['prv_value']
            } else {
                data = obj.tbl.row($(this).closest("tr")).data();
                obj.tbl.rows($(this).closest("tr")).select();
            }
            if (
                    $(e.target)
                    .parent()
                    .hasClass("inRow")
                    ) {
                obj.outputFiles(data, $("#mydropzoneFiles"), true);
            } else {
                var filesInfo = JSON.parse(data[obj.docsTable.fnName]);
                obj.outputFiles(filesInfo[1], $("#mydropzoneFiles"), false);
            }
            // $(".dropzone > .dz-preview").remove();
            $(".dz-message").show("slow");
            $("#saveFileEditor").hide();
            obj.loadDropzone();

            if (r) {
            } else {
                if (obj.editor.s.action !== "edit") {
                    $("#mydropzone").hide();
                    //$("div.DTE.DTE_Action_Edit").show(); -> //NO EDITOR :: File editor CLOSE button
                    $(".fas.fa-times", ".fileItem").hide();
                } else {
                    //If instance is inRowDoc and ONE document is present disable DROPZONE.
                    //In this circunstances the document MUST BE FIRST REMOVED by user, in order to UNABLE the upload of ANOTHER ONE
                    if (
                            typeof obj.inRowDoc !== undefined &&
                            data[quadConfig.columnDefaultBDMime] !== ""
                            ) {
                        $("#mydropzone").hide();
                        $("div.DTE.DTE_Action_Edit").hide();
                        $(".fas.fa-times", ".fileItem").show();
                    } else {
                        $("#mydropzone").show();
                        $("div.DTE.DTE_Action_Edit").hide();
                        $(".fas.fa-times", ".fileItem").show();
                    }
                }
            }
        });
    };
    /* Renders file icon OR name. The combinations are as follows:
     *      a) At Interface mode, it renders the icon associated to the file extention.
     *      b) At Editor mode it renders the filename (removing the path for security purposes).
     * Parameters:
     * -----------
     *  ext : File extention. Available just on option (a), on (b) is setted to '' (see function outputFiles).
     *  row : Entire row data. Accept BOTH json (instances) OR Object formats used inside Editor (see function outputFiles).
     *        Only available when called on column (chosed to render file icon) using the render function on QuadTables instance.
     */
    QuadTable.prototype.getFileIcon = function (ext, row) {
        ext = ext || null;
        var html,
                extHelper,
                sendRecordPk,
                returnName = false,
                obj = this;
        if (ext === "" || ext === null) {
            ext = row[quadConfig.columnDefaultBDMime];
            returnName = true;
        }
        if (ext) {
            extHelper = obj.getExtensionType(ext);
            if (obj.inRowDoc !== undefined && (row !== undefined && row !== "")) {
                if (isJson(row)) {
                    // Interface Mode (ex: gd_model_definition.php, instance:dg_gd_templates and column: LINK_DOC)
                    sendRecordPk = obj.getKey(obj.pk.primary, JSON.parse(row));
                } else {
                    //Convert Object data into json format and parse it as json :: Editor mode
                    sendRecordPk = obj.getKey(
                            obj.pk.primary,
                            JSON.parse(JSON.stringify(row))
                            );
                }
                if (!returnName) {
                    html =
                            '<a class="docsViewer inRow" download href="#" data-instance="' +
                            obj.tableId +
                            '" data-table="' +
                            obj.table +
                            '" data-reference="' +
                            sendRecordPk +
                            '"><i class="far fa-file-' +
                            extHelper +
                            ' fa-2x"></i></a>';
                } else {
                    html =
                            '<a class="docsViewer inRow" download href="#" data-instance="' +
                            obj.tableId +
                            '" data-table="' +
                            obj.table +
                            '" data-reference="' +
                            sendRecordPk +
                            '">' +
                            removePath(row[quadConfig.columnDefaultName]) +
                            "</a>";
                }
            } else {
                html =
                        '<a class="docsViewer inRow" href="#"><i class="far fa-file-' +
                        extHelper +
                        ' fa-2x"></i></a>';
            }
            return html;
        }
    };

    /* Método que serve para inicializar o datatables e o editor de um detail, se houver um registo master seleccionado */
    QuadTable.prototype.initDetails = function () {
        this.addTableEvents();
        this.addEditorEvents();
        $("." + this.tableId + "_spinner").hide("slow");
    };
    /* Método chamado através de outro método(setDML), serve para construir o SQL quando os campos são DATE ou DATETIME.
     * Limpa campos com valores,limpa WHERE CLAUSE e faz o reset das relações master detail.
     * Regista os eventos relacionados com EDITOR.
     */

    QuadTable.prototype.addEditorEvents = function () {
        var obj = this;
        /* Criamos O EDITOR */
        this.editor = new $.fn.dataTable.Editor({
            /* Em vez de um url , é uma função pois o método getData tem operações e verificações a aplicar.
             * ajaxUrl: "../php/upload.php"
             * cada vez que se faz um submit no editor, é executada esta função
             */
            ajax: function (data, callback, settings) {
                if (settings.action === "query") {
                    //se for uma query , não faz nada , pois esta é tratada directamente com uma promise, lida com filtros etc...
                    return;
                } else {
                    //se não for uma query ...
                    obj.getData(obj.initState);
                }
            },
            table: "#" + obj.tableId,
            /* Apenas  as colunas com propriedade NAME definida, passam para o EDITOR */
            fields: $.grep(obj.tableCols, function (e) {
                if (e.name) {
                    return e.name;
                }
            }),
            formOptions: {
                main: {
                    focus: 0,
                    onReturn: false,
                    onBackground: false
                }
            }
        });

        obj.registerEditorEvents();
    };
    QuadTable.prototype.checkInactive = function (data, masterObj) {
        var obj = this;
        if (masterObj && masterObj.crudOnMasterInactive) {
            var buttonsCell = $("#" + obj.tableId + " td:last-child");
            var buttonTh = $("#" + obj.tableId + "_wrapper th:last-child");
            var arr = [];
            var dataClone = obj.getInativeCondition(data, masterObj)[0];
            var condition = obj.getInativeCondition(data, masterObj)[1];
            //avalia a condição de inatividade constante nas options da intância
            if (eval(condition) === true) {
                _.forEach(masterObj.crudOnMasterInactive.acl, function (ob, i) {
                    if (i === "create") {
                        if (ob === false) {
                            buttonTh.find(".tblCreateBut").attr("disabled", 1);
                            arr.push(i);
                        } else {
                            buttonTh.find(".tblCreateBut").removeAttr("disabled");
                        }
                    }
                    if (i === "update") {
                        if (ob === false) {
                            buttonsCell.find(".tblEditBut").attr("disabled", 1);
                            arr.push(i);
                        } else {
                            buttonsCell.find(".tblEditBut").removeAttr("disabled");
                        }
                    }
                    if (i === "delete") {
                        if (ob === false) {
                            buttonsCell.find(".tblDelBut").attr("disabled", 1);
                            arr.push(i);
                        } else {
                            buttonsCell.find(".tblDelBut").removeAttr("disabled");
                        }
                    }
                });
            } else {
                if (typeof eval(condition) === "boolean") {
                    //se a condição de inatividade não se verificar, não há restrições
                    buttonTh.find(".tblCreateBut").removeAttr("disabled");
                    buttonsCell.find(".tblEditBut").removeAttr("disabled");
                    buttonsCell.find(".tblDelBut").removeAttr("disabled");
                } else {
                    alert(
                            "Something is wrong. Are you comparing? It's Javascript comparision, not SQL comparison. CheckInactive condition!"
                            );
                }
            }
        }
    };
//todo refactor CRUD/SHow CRUD rever bem todas as condições
    QuadTable.prototype.checkCrud = function () {
        if (window["userAllowedCrud"] && window["userAllowedCrud"][this.tableId]) {
            this["userAllowedCrud"] =
                    this["userAllowedCrud"] || window["userAllowedCrud"][this.tableId];
        }
        /*ver se existe pelo menos um Create ou Update ou Delete*/
        var arr = this.getCrud();
        //se CRUD for  ex: false,false,false , a coluna dos botões é removida
        if (arr != null && arr.indexOf(true) === -1) {
            _.remove(this.tableCols, {name: "BUTTONS"});
        }
    };
//todo refactor CRUD/SHow CRUD rever bem todas as condições
    QuadTable.prototype.getCrud = function () {
        var obj = this;
        var idx;
        if (window["userAllowedCrud"] && window["userAllowedCrud"][obj.tableId]) {
            idx = window["userAllowedCrud"][obj.tableId];
        } else {
            idx = null;
        }
        if (obj.crud) {
            idx = obj.crud;
        } else {
            idx = null;
        }
        if (idx) {
            return idx;
        } else {
            if (_.find(obj.tableCols, {name: "BUTTONS"})) {
                return quadConfig.defaultCRUD;
            } else {
                return [0, 0, 0];
            }
        }
    };
    QuadTable.prototype.fillDetail = function (callback) {
        var obj = this;
        _.forEach(obj.dependsOn, function (key, o) {
            //se master for um QuadTable
            if (window[o] instanceof QuadTable) {
                var anyRowSelected =
                        window[o].tbl.rows({selected: true}).indexes().length === 0
                        ? false
                        : true;
                if (anyRowSelected) {
                    $("#refresh_" + obj.tableId).show("slow");

                    if ($.fn.DataTable.isDataTable("#" + window[o].tableId)) {
                        /* Se datatable para este quadTable estiver inicializado e dentro de uma tab */
                        if (obj.instanceVisible($("#" + obj.tableId))) {
                            obj.retrieveDisplayData(obj["dtCallback"]);
                        }
                    } else {
                        /* Por questões de performance não inicializamos datatables e editor á priori. Só quando precisamos deles.
                         * repete-se toda a preparação dos dados de um details e o datatables, o editor e registamos os eventos associados.
                         * inicializamos e carregamos os dados segundo a master row selecionada
                         */
                        //se datatable para este quadTable estiver inicializado e dentro de uma tab
                        if (obj.instanceVisible($("#" + obj.tableId))) {
                            obj.initDetails();
                        }
                    }
                } else {
                    /* É um detail e não tem master selecionado
                     * fazemos um reset á tabela , estado dos botões e mensagem
                     */
                    $("#" + obj.tableId + "_wrapper th:last-child")
                            .find(".tblCreateBut")
                            .prop("disabled", true);
                    obj.clearTable();

                    obj.informToSelect(window[o]);
                }
                // se master for um quadForm
            } else if (window[o] instanceof QuadForm) {
                /* Se o master for um quadForm */
                //se datatable para este quadTable estiver inicializado e dentro de uma tab
                if (obj.instanceVisible($("#" + obj.tableId))) {
                    obj.initState = false;
                    obj.resetData();
                    $.when(obj.getData(obj.initState)).then(function (dat) {
                        dat = JSON.parse(dat);
                        dat = obj.fixData(dat);
                        obj.advancedSearchStatus(dat);

                        //renderizamos os dados
                        callback(dat);
                        obj.checkInactive(
                                window[o].myData["data"][window[o].currentRecord],
                                window[o]
                                );
                        obj.showCountInfo();
                        $(
                                "a[data-form-action=previous],a[data-form-action=next]",
                                window[o].formId
                                ).attr("disabled", false);
                        $(
                                "a[data-form-action=previous],a[data-form-action=next]",
                                window[o].formId
                                ).on("click", function (e) {
                            e.stopImmediatePropagation();
                            window[o].buttonPressed($(this));
                        });
                    });
                }
            }
        });
    };
    QuadTable.prototype.quadPrep = function () {
        var obj = this,
                cod = "",
                step = 1;
        try {
            if (!obj.dependsOn) {
                //Só se instância for master (uma vez que os DETAILS só após seleção do registo master e já possuem o respetivo loading animado)
                // Inject Loading on instance
                step = 2;
                if (obj.instanceVisible($("#" + obj.tableId))) {
                    var parentEl = $("a#" + this.tableId + "_dtAdvancedSearch").parent(
                            "div"
                            ),
                            parentContent = parentEl.html();
                    step = 3;
                    $(parentEl).html(
                            quadConfig.tableEvents.loading.replaceAll(":tableID:", obj.tableId) +
                            parentContent
                            );
                    step = 4;
                    //Evento no preDrawCallback
                    if (obj.preDrawCallback === undefined) {
                        step = 4.1;
                        obj.preDrawCallback = new Function(
                                quadConfig.tableEvents.eventDefaultParams,
                                quadConfig.tableEvents.preDrawCallback.replaceAll(
                                        ":tableID:",
                                        obj.tableId
                                        )
                                );
                    } else {
                        step = 4.2;
                        cod = obj.preDrawCallback.toString();
                        step = 4.3;
                        cod =
                                cod.substring(cod.indexOf("{") + 1, cod.lastIndexOf("}")) +
                                quadConfig.tableEvents.preDrawCallback.replaceAll(
                                        ":tableID:",
                                        obj.tableId
                                        );
                        step = 4.4;
                        obj.preDrawCallback = new Function(
                                quadConfig.tableEvents.eventDefaultParams,
                                cod
                                );
                        step = 4.5;
                    }
                    cod = "";
                    //Evento no initComplete
                    if (obj.initComplete === undefined) {
                        step = 5;
                        obj.initComplete = new Function(
                                quadConfig.tableEvents.eventDefaultParams,
                                quadConfig.tableEvents.initComplete.replaceAll(
                                        ":tableID:",
                                        obj.tableId
                                        )
                                );
                        step = 6;
                    } else {
                        step = 7;
                        var cod = obj.initComplete.toString();
                        step = 8;
                        cod =
                                cod.substring(cod.indexOf("{") + 1, cod.lastIndexOf("}")) +
                                quadConfig.tableEvents.initComplete.replaceAll(
                                        ":tableID:",
                                        obj.tableId
                                        );
                        step = 9;
                        obj.initComplete = new Function(
                                quadConfig.tableEvents.eventDefaultParams,
                                cod
                                );
                        step = 10;
                        cod = "";
                    }
                }
                step = 11;
            }
            obj = "";
        } catch (err) {
            alert(
                    "DICA => Verifiquem os parâmetros dos eventos desta instância " +
                    obj.tableId +
                    " e comparem-nos com o que está definido em quadConfig.tableEvents.eventDefaultParams\nSe for caso disso, extendam este último parâmetro."
                    );
            obj = "";
        }
    };
    QuadTable.prototype.addTableEvents = function () {
        var obj = this;
        if (this.initState == false) {
            /* Necessário?? Sim . Como que um default */
        } else {
            this.initState = true;
        }
        /* PMA: Permitir-nos-á extender algumas propriedades na instanciação.
         * Se a instância não tiver esta propriedade, inicializa-se com o "habitual".
         */
        if (obj.responsive === undefined) {
            obj.responsive = true;
        }
        if (obj.processing === undefined) {
            obj.processing = true;
        }
        if (obj.order === undefined) {
            obj.order = true; //Requires view <TABLE_NAME>_VW
        }
        try {
            if (isNaN(obj.scrollY)) {
                //Not a Number, assumed with 'px'
                null;
            } else {
                obj.scrollY = obj.scrollY + "px";
            }
        } catch (e) {
            console.log("Error on obj.scrollY: " + obj.scrollY);
        }

        var dtOptions = {
            deferLoading: 0,
            colReorder: obj.colReorder,
            stateSave: false,
            ordering: false,
            select: {
                //SELECT ROW options
                style: "single", //Só permite a seleção de UM ÚNICO registo
                selector: "td:not(:first-child):not(:last-child):not(.excludeRowSelect)" //Exclui a 1ª (Expand/Contract) e a última coluna (Edit/Delete) do critério de seleção da ROW. Ao selecionar essas opções, comutava o estado de seleção do registo o que não correspondia ao desejado!
            },
            dbWhere: obj.whereClause,
            order: obj.order, //PMA EXTENTION: possibility to DISABLE "ORDER BY" interface from instance
            processing: obj.processing,
            searching: obj.searching,
            serverSide: obj.serverSideProcessing,
            responsive: obj.responsive,
            scrollCollapse: obj.scrollCollapse,
            scrollY: obj.scrollY,
            scroller: obj.scroller,
            paging: obj.paging,
            pageLength: obj.recordBundle,
            lengthMenu: [[5, 10, 25, 50, 100, 200, -1], [5, 10, 25, 50, 100, 200]],
            language: {
                url: obj.language_dt,
                decimal: ",",
                thousands: ".",
                info:
                        "<span class='nRecords quad-right'>_TOTAL_" +
                        obj.i18nEntries.record +
                        "</span>",
                infoEmpty:
                        "<span class='nRecords quad-right'>0 " +
                        obj.i18nEntries.record +
                        "</span>",
                emptyTable: JS_NO_RECORDS_FOUND,
                select: {
                    rows: {
                        0:
                                '<span class="nRecords quad-left">' +
                                obj.i18nEntries.clickRow +
                                "</span>",
                        1:
                                '<span class="nRecords quad-left">%d ' +
                                obj.i18nEntries.rowSelected +
                                "</span>"
                    }
                }
            },
            autoWidth: true,
            columnDefs: obj.tableCols,
            createdRow: obj.createdRow,
            rowCallback: obj.rowCallback,
            drawCallback: obj.drawCallback,
            footerCallback: obj.footerCallback,
            headerCallback: obj.headerCallback,
            infoCallback: obj.infoCallback,
            initComplete: obj.initComplete,
            preDrawCallback: obj.preDrawCallback,
            filtroExterno: obj.filtroExterno,
            onDelete: obj.onDelete,
            /* instead of url we use a function and callback
             * callback() é o método intrinseco do datatables.js que faz renderização de rows
             * */
            ajax: function (data, callback, settings) {
                obj.filtersDataToColumns(obj.getFiltersFormsData());
                obj["dtCallback"] = obj["dtCallback"] || callback;
                var xtFormData = obj.getFiltersFormsData();
                if (!obj.checkMandatoryFilters(xtFormData)) {
                    return false;
                }
                //getcrud é chamado mais vezes porque causa dos filtros externos.
                if (obj.getCrud()[0] === true) {
                    /* se primeira entrada do CRUD(create) for true
                     coloca botão de create na ultima cell do header e inibe.
                     Será activado ou não segundo o master tenha registos sellecionados ou não
                     */
                    var lastTH = $("#" + obj.tableId + "_wrapper th:last-child");
                    var bt = lastTH.find(".tblCreateBut");
                    if (bt.length === 0) {
                        $(lastTH[0]).empty();
                        $(lastTH[0]).append(
                                "<button type='button' class='btn btn-xs btn-success tblCreateBut waves-effect waves-themed'><i class='fas fa-plus fa-xs'></i></button>"
                                );
                    } else {
                        bt.prop("disabled", false);
                    }
                }
                $("#refresh_" + obj.tableId).show("slow");

                // try {
                //Filtrers passed on URL ?
                if (obj["sFilters"]) {
                    _.remove(obj["sFilters"], {value: ""});
                    _.remove(obj["sFilters"], {value: null});

                    obj.mapFiltersWhereClause();
                }
                /*} catch (ex) {
                 null;
                 }*/
                if (obj.dependsOn) {
                    /*é detail?*/
                    /* de for um detail
                     * dentro do fillDetail() verificamos se master tem registo activo. Se tiver faz chamada ao controlador e renderiza dados
                     */

                    obj.fillDetail(callback);
                } else {
                    /* Se for um master, tudo normal, carregamos os dados... */
                    /*master e não tem filtros exteriores*/

                    if (!obj.editorXt) {
                        var data = obj.convertToDTRowData(obj.dbColumns);
                        data = obj.normalizeData(data);
                        if (!obj["sortInfo"]) {
                            data = obj.mapComplexLists(data);
                            //obj.setDML(data);
                        } else {
                            //obj.setDML(data, true, true);
                        }
                        obj.retrieveDisplayData(callback);
                    } else {
                        /* Master e tem filtros exteriores (form com filtros)*/
                        if (
                                obj.externalFilter /* tem filtros mandatórios que só depois todos  preenchidos é que o request para obtenção de dados
                                 será despoletado */ &&
                                obj.externalFilter.template &&
                                obj.externalFilter.template.mandatory &&
                                obj.externalFilter.template.mandatory.length > 0
                                ) {
                            if (
                                    !obj.countMandatoryFilledFilters(
                                            obj.externalFilter.template.mandatory
                                            )
                                    ) {
                                /* filtros mandatorios não estão todos preenchidos*/
                                $("." + obj.tableId + "_spinner").hide("slow");
                                var dat = {};
                                dat["data"] = [];
                                dat["recordsTotal"] = 0;
                                dat["recordsFiltered"] = 0;
                                obj["totalRecords"] = 0;
                                callback(dat);
                                setTimeout(function () {
                                    obj.selectFirstRow();
                                }, 0);

                                obj.showCountInfo();
                                return;
                            } else {
                                //obj.setDML();
                                /* todos os filtros estão prrenchidos, request , vê se tem erros , descodifica listas , renderiza rows, atualiza info de navegação*/
                                obj.retrieveDisplayData(callback);
                            }
                            // }
                        } else {
                            //obj.setDML();

                            //fallback , only optional filters
                            obj.retrieveDisplayData(callback);
                        }
                    }
                }
            }
        };
        /* inicializamos o datatables para esta instãncia com as option defenidas no interface e extendidads com os defaults*/

        if (obj.instanceVisible($("#" + obj.tableId))) {
            this.tbl = $("#" + obj.tableId).DataTable(dtOptions);

            if (obj.columnReorder) {
                //read from localstorage, means user change order with drag and drop...by browser session, not user login
                obj.tbl.colReorder.order(obj.columnReorder.split(","));
            }

            $("th.visibleColumn.sorting").off();
            /* verificamos permissões do user e aplicamos de acordo, escondendo botões e colunas etc etc..*/
            this.acl("#" + obj.tableId + "_editorForm");
            /* trabalhamos os extras(export,etc...) , seus eventos , etc...*/
             obj.buttonManagerCentralized();
            /* Datatables instance to quadtable tbl object . Pomos o datatables dentro do quadtable(this) e referenciamos como obj.tbl ou this.tbl, consoante o contexto */
            //PMA, 2017.05.11 :: Atualização dos nomes dos ficheiros a gravar com o nome da Instância
            /* Recalculamos a responsividade */
            $("#" + obj.tableId)
                    .DataTable()
                    .columns.adjust()
                    .responsive.recalc();
            obj.registerTableEvents();

            /* If false doesn't Show Order by button */
            if (obj.order) {
                obj.sortOrder();
            }
            if (obj.workFlow) {
                setTimeout(function () {
                    $(document).on("click", ".detailsWkf", "#" + obj.tableId, function (e) {
                        setTimeout(function () {
                            obj.manageWorkflow(null, "#" + obj.tableId);
                        }, 0);
                    });
                }, 0);
            }
        }
    };

    QuadTable.prototype.showCountInfo = function () {
        //atualizamos o rodapé com nº de registos e registo atual
        var obj = this;
        setTimeout(function () {
            $("#" + obj.tableId + "_info > .nRecords.quad-right").text(
                    parseInt(obj.tbl.data().count()).toLocaleString() +
                    " / " +
                    parseInt(obj.totalRecords).toLocaleString() +
                    " " +
                    obj.i18nEntries.record
                    );
        }, 100);
    };
    /* Método para remover as rows da tabela */
    QuadTable.prototype.recursiveReset = function (obj) {
        // base condition
        if (!obj || !obj.detailsObjects) {
            return;
        }
        //obj.resetData(true);
        _.forEach(obj.detailsObjects, function (o, key) {
            if (window[o] instanceof QuadTable) {
                /* Limpamos o details e reiniciamos a info */
                window[o].resetTableInstance();

                /* Recursive call */
                obj.recursiveReset(window[o]);
                /* PMA risco de entrar em loop. A confirmar condições... */
            } else if (window[o] instanceof QuadForm) {
                window[o].clearForm(window[o].formId);
                $(window[o].formId)
                        .find("a[data-form-action]")
                        .hide("slow");
                $("." + window[o].formId.substring(1) + "_spinner").hide("slow");
                $(window[o].formId)
                        .find(".quad-alert")
                        .html(obj.selectRecordMsg)
                        .addClass("alert alert-info fade in");
            }
        });
    };
    /* Método para limpar a tabela */
    QuadTable.prototype.clearTable = function () {
        //removemos todos os <tr> da tabela
        $("#" + this.tableId)
                .find("tr")
                .remove();
        if (this.workFlow && this.workFlow.mode === "postponed") {
            $("#" + this.tableId + "_wrapper").removeClass("tableRecordWkf2");
        }
    };
    /* Este método serve para automatizar a desabilitação e esconder as chaves primárias*/
    QuadTable.prototype.hideDisableKeyFields = function () {
        var obj = this;
        _.map(obj.tableCols, function (o) {
            if (_.contains(_.keys(obj.pk.primary), o.name) === true) {
                if (o.attr.allowUpdate) {
                    return;
                } else {
                    $('[name="' + o.name + '"]', "#" + obj.tableId + "_editorForm").prop(
                            "disabled",
                            1
                            );
                }
            }

            if (o.attr["distribute-value"]) {
                obj.disableComplexListContainsPk(o, o.attr["distribute-value"]);
            } else if (o.attr["data-db-name"]) {
                obj.disableComplexListContainsPk(o, o.attr["data-db-name"]);
            }
        });
    };

    QuadTable.prototype.disableComplexListContainsPk = function (o, values) {
        var obj = this;
        var keys = values.replace(quadConfig.regExpressions.alias, "").split("@");
        if (
                _.intersection(keys, Object.keys(obj.pk.primary)).length === keys.length
                ) {
            if (o.attr.allowUpdate) {
                //se target tiver allowUpdate, não disabilita campo, permite update deste campo da chave.
            } else {
                $("[name='" + o.name + "']", "#" + obj.tableId + "_editorForm").prop(
                        "disabled",
                        1
                        );
            }
        }
    };

//todo refactor CRUD/SHow CRUD rever bem todas as condições
    QuadTable.prototype.crudButtons = function (newBt, editBt, delBt) {
        var obj = this;
        var buttons = [],
                arr = [];
        var newButton, editButton, deleteButton, buttonTh, buttonsCell;
        buttonTh = $("#" + obj.tableId + "_wrapper th:last-child");
        buttonsCell = $("#" + obj.tableId + " td:last-child");
        if (arguments[0] instanceof Array) {
            jQuery.each(arguments[0], function (i, n) {
                if (i === 0) {
                    newBt = n;
                }
                if (i === 1) {
                    editBt = n;
                }
                if (i === 2) {
                    delBt = n;
                }
            });
            if (newBt) {
                arr.push("create");
                newButton = "";
            } else {
                buttonTh.find(".tblCreateBut").fadeOut();
            }
            if (editBt) {
                arr.push("edit");
                editButton =
                        "<button type=\"button\" class='btn btn-xs btn-default tblEditBut btn-icon waves-effect waves-themed'><i class='fas fa-pencil fa-sm'></i></button>";
            }
            if (delBt) {
                arr.push("delete");
                deleteButton =
                        "<button type=\"button\" class='btn btn-xs btn-default tblDelBut btn-icon waves-effect waves-themed'><i class='fas fa-times'></i></button>";
            }
        }
        //compatible mode
        if (typeof arguments[0] === "boolean") {
            if (arguments[0]) {
                arr.push("create");
                newButton = "";
            } else {
                buttonTh.find(".tblCreateBut").fadeOut();
            }
            if (arguments[1]) {
                arr.push("edit");
                editButton =
                        "<button type=\"button\" class='btn btn-xs btn-default tblEditBut btn-icon waves-effect waves-themed'><i class='fas fa-pencil fa-sm'></i></button>";
            }
            if (arguments[2]) {
                arr.push("delete");
                deleteButton =
                        "<button type=\"button\" class='btn btn-xs btn-default tblDelBut btn-icon waves-effect waves-themed'><i class='fas fa-times'></i></button>";
            }
        }
        if (arguments[0] == null) {
            //nao ha render com crudButtons method ou crudbuttons no render sem argumentos
            var crud;
            if (window["userAllowedCrud"] && window["userAllowedCrud"][this.tableId]) {
                crud = window["userAllowedCrud"][this.tableId];
            } else {
                crud = quadConfig.defaultCRUD;
            }
            jQuery.each(crud, function (i, n) {
                if (i === 0) {
                    newBt = n;
                }
                if (i === 1) {
                    editBt = n;
                }
                if (i === 2) {
                    delBt = n;
                }
            });
        }
        //buttonTh.show('slow');
        //buttonsCell.show('slow');
        if (arr.length === 0) {
            buttonTh.hide("slow");
            buttonsCell.hide("slow");
            return "";
        } else {
            buttons.push(newButton, editButton, deleteButton);
            return buttons.join("");
        }
    };
    QuadTable.prototype.fixTargets = function () {
        var obj = this;
        _.map(obj.tableCols, function (o, i) {
            if (!o["targets"]) {
                o["targets"] = i;
            }
            if (o["type"] === "hidden") {
                if (obj["validations"] && obj["validations"]["rules"]) {
                    delete obj["validations"]["rules"][o["name"]];
                }
            }
        });
    };
    QuadTable.prototype.beforeRender = function () {
        var obj = this;
        if (this.buttonsPos == "left") {
            $.grep(this.tableCols, function (e) {
                if (e.name == "controlo") {
                    var controlo = true;
                }
                if (e.name == "BUTTONS") {
                    if (controlo) {
                        e.targets = 1;
                    } else {
                        e.targets = 0;
                    }
                } else {
                    ++e.targets;
                }
                return e.targets;
            });
        }
        if (this.expand === "right") {
            var expandtarget = -1;
            $.grep(this.tableCols, function (e) {
                --e.targets;
                ++expandtarget;
                obj.tableCols[0].targets = expandtarget;
                return e.targets;
            });
        }
        $.grep(this.tableCols, function (e) {
            e.attr = {"data-db-name": e.data};
        });
    };
    QuadTable.prototype.removeRow = function (data) {
        var obj = this;
        var _operation = "DELETE";
        initApp.playSound(myapp_config.assetsUrl + "/media/sound", "messagebox"),
                "undefined" != typeof bootbox
                ? bootbox.confirm({
                    title: '<i class="fa fa-times" style="color:#ED1C24"></i>&nbsp;' + JS_DELETE_CONFIRMATION,
                    message: JS_WARNING_UNDONE, //"<span><strong>Warning:</strong> This action cannot be undone!</span>",
                    centerVertical: !0,
                    swapButtonOrder: !0,
                    buttons: {
                        confirm: {label: JS_YES, className: "btn-danger"},
                        cancel: {label: JS_NO, className: "btn-default"}},
                    className: "modal-alert",
                    closeButton: !1,
                    callback: function (t) {
                        if (t) {
                            /* YES, delete record! */
                            data = obj.normalizeData(data);
                            /* Data must always have the same format. server retur data id data.data row click is data only and editor return data.data */
                            obj.prepareData(data);
                            /* prepare data for any operation. Globalsearh , advanced search, CRUD ,Where_str and this.dbcolumns*/
                            //obj.setDML(data);
                            window.copyEditorData = obj.convertToDTRowData(obj.dbColumns);
                            //QUAD-VALIDATOR

                            var ok_ = true;
                            if (obj.on_pre_submit) {
                                $.when(obj.isValidOperation(window.copyEditorData, "delete")).then(
                                        function (data) {
                                            try {
                                                ok_ = obj.deleteRecordResponse(data, ok_);
                                            } catch (e) {
                                                console.log("QUAD-VALIDATOR on DELETE:" + e);
                                            }
                                        }
                                );
                            }

                            if (ok_) {
                                /* its not a select so we go directly to executeDml() . If it is an editor operation program enter getData() and then redirect if != from select*/
                                $.when(obj.executeDml(_operation)).then(function (dat) {
                                    obj.resetData();
                                    obj.operation = "SELECT";
                                    if (dat) {
                                        var dat = JSON.parse(dat);
                                        if (obj.checkError(dat, $("#" + obj.tableId + "_editorForm"))) {
                                            return;
                                        }

                                        //copyEditorData na sua génese servia para manter sempre uma cópia da chave do registo (id da row), no caso de update de chaves
                                        window.copyEditorData.DT_RowId = obj.composeId(
                                                obj.pk.primary,
                                                window.copyEditorData
                                                );
                                        if (dat.status && dat.status == "deleted") {
                                            obj.deleteTableRow(dat, "#" + window.copyEditorData.DT_RowId);
                                        }
                                        $("." + obj.tableId + "_spinner").hide();
                                        if (
                                                parseInt(obj.totalRecords) != 0 &&
                                                parseInt(obj.totalRecords) >= obj.recordBundle
                                                ) {
                                            //obj.setDML();
                                            $.when(obj.getData(false, obj.tbl.data().count(), 1)).then(
                                                    function (dat) {
                                                        var dat = JSON.parse(dat);
                                                        if (
                                                                obj.checkError(dat, $("#" + obj.tableId + "_editorForm"))
                                                                ) {
                                                            return;
                                                        }
                                                        if (dat) {
                                                            obj.fixData(dat);
                                                            obj.tbl.rows.add(dat.data);
                                                            _.map(dat.data, function (o, key) {
                                                                var rowNode = obj.tbl.row("#" + o["DT_RowId"]).node();
                                                                $("#" + obj.tableId).append(rowNode);
                                                            });
                                                            obj.showCountInfo();
                                                        }
                                                    }
                                            );
                                        }
                                    }
                                    //PMA, 2020.01.30 : RECALC FOOTER AFTER DELETE
                                    if (typeof obj.footerCallback === "undefined" ? false : true) {
                                        obj.footerCallback();
                                    }
                                    $("#" + obj.tableId)
                                            .DataTable()
                                            .columns.adjust()
                                            .responsive.recalc();
                                    $(window).trigger("resize");
                                });
                            }
                        }
                        //Operação foi cancelada
                        if (!t) {
                            /* NO, record stays! */
                            quad_notification({
                                title: JS_OPERATION_ABORT,
                                content:
                                        '<i class="fa fa-clock-o"></i>&nbsp;<i>' +
                                        JS_RECORD_NOT_DELETED +
                                        "</i>",
                                type: "info",
                                timeout: 1500
                            });
                        }
                    }
                })
                : confirm(JS_OPERATION_CONFIRMATION);

    };
    /*Permite inicializar a where clause desde filtros totalmente alheios ao QuadTables*/
    QuadTable.prototype.setExternalFilter = function (externalFilter) {
        var filters = [],
                obj = this;
        obj.initialWhereClause = "";
        if (externalFilter !== "" || externalFilter !== undefined) {
            obj.operation = "SELECT";
            obj.startIn = 0;
            obj.initState = false;
            obj.initialWhereClause = externalFilter;
            /*externalFilter "TO_CHAR(DIA,'YYYY-MM-DD') ='2017-05-08' AND CD_MAQ = 'BAA01' "; */
        } else {
            obj.initialWhereClause = "";
        }
    };
    /* Se o botão associado à pesquisa da instância tiver a classe [.editorOff] isso será utilizado para efetuar a pesquisa
     * invocando este método que ignora o editor de pesquisa e usa [initialWhereClause] inicializada em [setExternalFilter]
     */
    QuadTable.prototype.filtroExterno = function () {
        var filters = [],
                obj = this;
        obj.tbl.rows().deselect();
        obj.clearTable();
        obj.resetData();
        setTimeout(function () {
            obj.tbl
                    .columns()
                    .search()
                    .draw();
        }, 100);
        $("." + obj.tableId + "_sFilters").empty();
        if (obj.sFilters) {
        }
    };

    QuadTable.prototype.sortOrder = function () {
        var obj = this;
        obj.appendSortButton();

        $("#sort_" + obj.tableId).on("click", function (e) {
            if (!localStorage.getItem(obj.tableId + "_sortInfo")) {
                localStorage.setItem(obj.tableId + "_sortInfo", "");
            }

            var modalIdentifier = obj.modalSortUi(obj.tableId);

            obj.registerCustomSortOrderByEvents(modalIdentifier);
            obj.registerOrderByEvents(modalIdentifier);

            //isto serve para que a up/down seja mostrado correctamente...
            $($(".orderByUp").first()).hide();
            $($(".orderByDown").last()).hide();
        });
    };
    QuadTable.prototype.registerOrderByEvents = function (modalIdentifier) {
        var obj = this;
        $(modalIdentifier).on("change", "select", function (e) {
            e.stopImmediatePropagation();
            var obj = window[$("#sortModal").attr("instanceId")];

            obj.orderByChangeHandler(e, obj.tableId, $(this));
        });
        $(modalIdentifier).on("click", ".deleteOrderBy", function (e) {
            e.stopImmediatePropagation();
            var obj = window[$("#sortModal").attr("instanceId")];

            obj.deleteOrderByHandler(e.currentTarget, obj.tableId, $(this));
        });
        $(modalIdentifier).on("click", ".orderNow", function (e) {
            e.stopImmediatePropagation();
            var obj = window[$("#sortModal").attr("instanceId")];
            if (obj["sFilters"]) {
                obj.resetData();

                _.forEach(obj["sFilters"], function (o, i) {
                    if (
                            _.find(obj.tableCols, {name: o.name})["attr"]["dependent-group"] &&
                            obj["sortInfo"]
                            ) {
                        obj.buildWhereClause(o.name, o.text, "query", true);
                    } else {
                        obj.buildWhereClause(o.name, o.value, "query", true);
                    }

                    var ob = _.find(obj.tableCols, {name: o.name});
                    if (ob["complexList"]) {
                        var keys = obj.returnListKeys(ob);

                        _.map(keys, function (field, j) {
                            delete obj.qFilters[field];
                        });
                    }
                });
            }
            obj.startIn = 0;
            obj.retrieveDisplayData(obj["dtCallback"]);
            $("#sortModal").modal("toggle");
        });
    };
    /* Returns SELECTED ROW DATA of the INSTANCE */
    QuadTable.prototype.selectedRowData = function () {
        var obj = this;
        return obj.tbl.row(".selected").data();
    };
    /* Inconsistency watchdog */
    QuadTable.prototype.syncTable = function () {
        var obj = this;
        /* var optionArtigo = { syncTimer:60000, //millisegundos, neste caso 1 minuto... */
        //var tVal = $.extend({}, obj.syncTimer);
        //todo delete syncInterval
        obj["syncInterval"] = setInterval(timerFn, obj.syncTimer);

        function timerFn() {
            //todo clearinterval
            if (!$("#" + obj.tableId).is(":visible")) {
                clearInterval(obj["syncInterval"]);
                return;
            }
            var x = new Date().getTimezoneOffset() * 60000;
            var syncDate = new Date(Date.now() - x);
            syncDate.setMinutes(syncDate.getMinutes() - obj.syncTimer / 1000 / 60);
            syncDate = syncDate
                    .toISOString()
                    .slice(0, 19)
                    .replace("T", " ");
            $.when(obj.getData(true, 0, obj.tbl.data().count(), true, syncDate)).then(
                    function (dat) {
                        if (dat && JSON.parse(dat) && JSON.parse(dat)[0].length > 0) {
                            var dat = JSON.parse(dat);
                            dat = obj.normalizeData(dat[0][0]);
                            dat = obj.fixData(dat);
                            if (dat.data.length > 0) {
                                _.forEach(dat.data, function (o, i) {
                                    if (_.find(obj.tbl.data(), {DT_RowId: o.DT_RowId})) {
                                        obj.tbl.row("#" + o.DT_RowId).data(o);
                                        $("#" + o.DT_RowId).addClass("error");
                                        //obj.checkInactive(window[o].tbl.row('.selected').data(), window[o]);
                                        // Example : Alert user
                                        quad_notification({
                                            type: "info",
                                            title: JS_RECORDS_CHANGE_BY_OTHER_USER,
                                            content:
                                                    '<span class="goEye" title="' +
                                                    JS_GO_RECORD +
                                                    '"><i data-rowId="' +
                                                    o.DT_RowId +
                                                    '" class="far fa-eye fa-2x"></i></span>'
                                        });
                                        //por exemplo se for apenas um registo alterado...pode-se mostrar se estiver fora do viewport
                                        $('[id="' + o.DT_RowId + '"]')[0].scrollIntoView(false);
                                    }
                                });
                            }
                        }
                    }
            );
        }
    };

    QuadTable.prototype.prepareInlineOperation = function (id, row, action) {
        var obj = this;
        if ($(":input", "#newRForm,#editRForm").length > 0) {
            // only one row is allowed to be in edit mode at a time
            return false;
        }
        $(".dataTables_scrollBody", "#" + obj.tableId + "_wrapper").wrap(
                "<form id='" + id + "' class='form-inline'></form>"
                );
        if (action === "create") {
            $("#" + obj.tableId).prepend(row);
        }
        obj.validateFrm($("#" + id), obj.validations);

        $(row)
                .find("td:first-child")
                .trigger("click");
    };
    QuadTable.prototype.formCellsContents = function (
            frm,
            row,
            action,
            rowData,
            bt,
            bt2
            ) {
        var obj = this;
        obj.manageCellsDataInlineOperation(row, frm, action, rowData, bt, bt2);
        obj.manageDetailsCellsDataInlineOperation(row, rowData, action, frm);
        obj.displayInlineUpload(rowData, row);
    };
    QuadTable.prototype.rowOpEdit = function (frm, data, r, bt, bt2, action) {
        var obj = this;

        obj.formCellsContents(frm, r, action, data, bt, bt2);

        $(":input", frm).on(
                "change",
                {
                    currentForm: frm,
                    action: action
                },
                function (evt) {
                    evt.stopImmediatePropagation();
                    if ($(evt.target).hasClass("chosen")) {
                        $(evt.target).trigger("chosen:updated");
                    }
                    var rowData = frm.serializeAllArray();
                    obj.frmElemChange(
                            $(evt.data.currentForm),
                            $(evt.target),
                            evt.data.action,
                            true,
                            rowData
                            );
                    bt.html("Save")
                            .addClass("tblSave")
                            .removeClass("tblEditBut")
                            .show("slow");
                    bt2.removeClass("tblDelBut");
                    bt2.html("Cancel").addClass("tblCancel");

                    obj.registerInlineSaveOperationEdit(r, frm, "UPDATE");
                    $(".tblCancel", r).on("click", function (e) {
                        e.stopImmediatePropagation();
                        $(this).removeClass("tblDelBut");
                        var el = $(r).find("td:last-child");
                        //removemos a row child se estiver aberta/visivel
                        el.empty();
                        el.html(obj.crudButtons(obj.getCrud()));
                        $(".dataTables_scrollBody", "#" + obj.tableId + "_wrapper").unwrap();

                        obj.dataToCells(r, data);
                        obj.dataToDetailsCells(r, data);

                        $(r)
                                .find("td:first-child")
                                .trigger("click");
                        $("#" + obj.tableId)
                                .DataTable()
                                .columns.adjust()
                                .responsive.recalc();
                        $(window).trigger("resize");
                    });
                    var newData = obj.getNormalizedFrmData(frm);
                    newData = obj.normalizeData(newData);
                    newData = obj.mapComplexLists(newData);
                }
        );

        $("#" + obj.tableId)
                .DataTable()
                .columns.adjust()
                .responsive.recalc();
        $(r)[0].scrollIntoView({
            behavior: "auto",
            block: "center",
            inline: "center"
        });
    };

    QuadTable.prototype.inlineEdit = function (data, r, bt, bt2, action) {
        var obj = this;
        var data = obj.normalizeData(data);
        obj.prepareInlineOperation("editRForm", r, action);
        obj.formCellsContents($("#editRForm"), r, action, data, bt, bt2);
        obj.loadCxListsInlineOperation(action, $("#editRForm"), r, data, bt, bt2);
        obj.enableDatePickers($("#editRForm"), action);

        obj.registerInlineSaveOperationEdit(r, $("#editRForm"), "UPDATE");

        obj.tbl.on("responsive-resize", function (e, datatable, columns) {
            setTimeout(function () {
                if (obj.operation === "UPDATE") {
                    var rowData = obj.tbl.row(r).data();
                    // convert row data to array of objects
                    _.map(rowData, function (value, name) {
                        return {name: name, value: value};
                    });
                    rowData = obj.normalizeData(rowData);

                    $(r)
                            .next(".child")
                            .removeClass("loadingList");

                    $(":input", $("#editRForm")).on(
                            "change",
                            {
                                currentForm: $("#editRForm"),
                                action: "edit"
                            },
                            function (evt) {
                                evt.stopImmediatePropagation();
                                if ($(evt.target).hasClass("chosen")) {
                                    $(evt.target).trigger("chosen:updated");
                                }
                                var rowData = $("#editRForm").serializeAllArray();
                                obj.frmElemChange(
                                        $(evt.data.currentForm),
                                        $(evt.target),
                                        evt.data.action,
                                        true,
                                        rowData
                                        );

                                $(".tblSave", $(r)).on("click", function () {
                                    if ($("#editRForm").valid()) {
                                        //obj.resetData();
                                        var copyOfDbcolumns = $.extend({}, obj.dbColumns);
                                        var newData = obj.getNormalizedFrmData($("#editRForm"));
                                        newData = obj.normalizeData(newData);
                                        newData = obj.mapComplexLists(newData);
                                        obj.prepareData(newData, copyOfDbcolumns);
                                        obj.operation = "UPDATE";
                                        //$('#newRForm').find('em.invalid').remove();
                                        $("#editRForm")
                                                .find(".error")
                                                .removeClass("error");
                                        $.when(obj.executeDml("UPDATE")).then(function (dat) {
                                            var dat = JSON.parse(dat);
                                            if (obj.checkError(dat, $("#editRForm"), true)) {
                                                return;
                                            }

                                            $(r)
                                                    .find(".tblCancel")
                                                    .trigger("click");

                                            window.copyEditorData = obj.convertToDTRowData(obj.dbColumns);
                                            window.copyEditorData.DT_RowId = obj.composeId(
                                                    obj.pk.primary,
                                                    window.copyEditorData
                                                    );
                                            dat = obj.fixData(data);
                                            //dat=dat.data[0];
                                            obj.tbl.row("#" + window.copyEditorData.DT_RowId).data(dat);
                                            $("#" + dat.DT_RowId)
                                                    .fadeIn(500)
                                                    .fadeOut(500)
                                                    .fadeIn(500)
                                                    .fadeOut(500)
                                                    .fadeIn(500);
                                            obj.tbl.rows("#" + dat.DT_RowId).select();
                                            obj.operation = "SELECT";
                                            $(window).trigger("resize");
                                        });
                                    }
                                    $(r)
                                            .next(".child")
                                            .removeClass("loadingList");
                                    $("#editRForm").valid();
                                    obj.rowToViewport(r);
                                });
                                $(".tblCancel", $(r)).on("click", function () {
                                    $(this).removeClass("tblDelBut");
                                    var el = $(r).find("td:last-child");
                                    //removemos a row child se estiver aberta/visivel
                                    el.empty();
                                    el.html(obj.crudButtons(obj.getCrud()));
                                    $(
                                            ".dataTables_scrollBody",
                                            "#" + obj.tableId + "_wrapper"
                                            ).unwrap();

                                    obj.dataToCells(r, data);
                                    obj.dataToDetailsCells(r, data);

                                    $(r)
                                            .find("td:first-child")
                                            .trigger("click");
                                    obj.rowToViewport(r);
                                });
                                var newData = obj.getNormalizedFrmData($("#editRForm"));
                                newData = obj.normalizeData(newData);
                                newData = obj.mapComplexLists(newData);
                            }
                    );
                }

                //obj.rowToViewport(r);
                obj.formCellsContents($("#editRForm"), r, action, data, bt, bt2);

                obj.displayInlineUpload(data, r);

                //$(window).trigger("resize");
            }, 1000);
        });

        $(".tblCancel", r).on("click", function (e) {
            e.stopImmediatePropagation();
            $(this).removeClass("tblDelBut");
            var el = $(r).find("td:last-child");
            //removemos a row child se estiver aberta/visivel
            el.empty();
            el.html(obj.crudButtons(obj.getCrud()));
            $(".dataTables_scrollBody", "#" + obj.tableId + "_wrapper").unwrap();
            $(r)
                    .children("td")
                    .each(function (i, it) {
                        if ($(it).is(":not(:first-child):not(:last-child)")) {
                            var target = _.find(obj.tableCols, {
                                targets: it._DT_CellIndex.column
                            });
                            var od = obj.tbl
                                    .row(r)
                                    .cells(it)
                                    .data();
                            $(it).html(od[0]);
                        }
                    });
            $(r)
                    .next(".child")
                    .find(".dtr-data")
                    .each(function (i, it) {
                        var od = obj.tbl
                                .row(r)
                                .cells(it)
                                .data();
                        $(it).html(od[0]);
                    });
            if (_.find(obj.tableCols, {type: "upload"})) {
                var rowIdx = obj.tbl.row(obj.tbl.row(r).index())[0][0];
                var colIdx = obj.tbl
                        .row(obj.tbl.row(r).index())
                        .column(obj.inRowDoc.fileNameField + ":name")
                        .index();
                var cell = obj.tbl
                        .row(r)
                        .columns()
                        .cell({row: rowIdx, column: colIdx})
                        .nodes()[0];
                if (data[obj.inRowDoc.fileNameField]) {
                    $(cell).html(
                            $(obj.getFileIcon(data[obj.inRowDoc.extField], data)).removeClass(
                            "inlineEdit"
                            )
                            );
                } else {
                    $(cell).html(data[obj.inRowDoc.fileNameField]);
                }
                obj.setUpload(r);
            }
            $(r)
                    .find("td:first-child")
                    .trigger("click");
            $("#" + obj.tableId)
                    .DataTable()
                    .columns.adjust()
                    .responsive.recalc();
            $(window).trigger("resize");
            obj.operation = "SELECT";
        });

        obj.rowToViewport(r);

        obj.displayInlineUpload(data, r);
    };
    QuadTable.prototype.mapDataToInlineInputs = function (
            target,
            h,
            rowData,
            action,
            frm
            ) {
        var obj = this;
        if (target.complexList) {
            h.addClass("complexList");
            if (action === "create") {
                obj.fillComplexList(target, frm, null, null, action);
            } else {
                obj.onEditFillComplexList(
                        target,
                        frm,
                        rowData,
                        action,
                        h,
                        h.attr("dependent-level")
                        );
            }
        } else if (h.attr("domain-list")) {
            if (action === "edit") {
                obj.onEditFillDomain(frm, target, rowData.data[0], action);
            }
        } else {
            if (action === "edit") {
                h.val(rowData.data[0][h.attr("name")]);
            }
        }
    };

    QuadTable.prototype.loadCxListsInlineOperation = function (
            action,
            frm,
            row,
            data,
            bt,
            bt2
            ) {
        var obj = this;
        $.each(obj.tableCols, function (i, field) {
            if (
                    field.complexList &&
                    !field.attr.deferred &&
                    field.attr.filter &&
                    field.attr.filter[action]
                    ) {
                obj.compileRequests(field, false, action, null);
            }
        });
        if (Object.keys(obj.requests).length > 0) {
            $(".complexList", frm).addClass("loadingList");
            $(".chosen-container", frm).addClass("loadingList");
            $.when(obj.getListsData(true, action, row)).then(function (strData) {
                if (strData && JSON.parse(strData)) {
                    //fazemos override de seleçcõ dos defs do datatables e despoletamos outra vez quando os dados das listas filtradas chegam. Pois arriscamos a não ter os dados
                    //no na 1ª vez que usamos o editor...sem side effects...
                    obj.mapListRequest(strData, obj.tableCols, action, frm, data);
                }
                if (action === "edit") {
                    obj.rowOpEdit(frm, data, row, bt, bt2, action);
                } else {
                    var results = obj.tableCols.filter(function (item) {
                        return item.hasOwnProperty("def");
                    });
                    _.forEach(results, function (item, i) {
                        $('[name="' + item.name + '"]', frm).trigger("change");
                    });
                }

                $("." + obj.tableId + "_spinner").hide("slow");
                $(".complexList", frm).removeClass("loadingList");
                $(".chosen-container", frm).removeClass("loadingList");
            });
        } else {
            if (action === "edit") {
                obj.rowOpEdit(frm, data, row, bt, bt2, action);
            }
        }
    };

    QuadTable.prototype.inlineCreate = function (data, row, bt, action) {
        var obj = this;
        delete obj["otherValues"];

        obj.prepareInlineOperation("newRForm", row, action);
        obj.formCellsContents($("#newRForm"), row, action, data);
        obj.populateDomainLists($("#newRForm"), "create");
        obj.loadCxListsInlineOperation(action, $("#newRForm"), row, data);
        obj.enableDatePickers($("#newRForm"), action);

        obj.registerInlineSaveOperationCreate(bt, row);

        obj.tbl.on("responsive-resize", function (e, datatable, columns) {
            setTimeout(function () {
                if (obj.operation === "INSERT") {
                    var rowData = obj.normalizeData(
                            obj.getNormalizedFrmData($("#newRForm"))
                            );
                    rowData = obj.mapComplexLists(rowData);

                    $(row)
                            .next(".child")
                            .addClass("loadingList");

                    obj.registerInlineSaveOperationCreate(bt, row);
                }

                //obj.rowToViewport(row);
                obj.formCellsContents($("#newRForm"), row, action, rowData);
                obj.setupInlineCreateUpload(row);
            }, 1000);
        });

        bt.hide();

        if ($(bt).siblings(".tblCancel").length > 0) {
            $(bt)
                    .siblings(".tblCancel")
                    .show("slow");
        } else {
            var cBut = $(
                    '<button title="' +
                    JS_CANCEL +
                    '" class="btn btn-xs btn-danger waves-effect waves-themed tblCancel"><i class="fas fa-ban"></button>'
                    );
            bt.parent().append(cBut);
            cBut.on("click", function () {
                obj.removeInlineCreateForm(action, cBut, bt);

                $(".dataTables_scrollBody", "#" + obj.tableId + "_wrapper").unwrap();
            });
        }

        obj.rowToViewport(row);

        obj.setupInlineCreateUpload(row);

        if (obj.sFilters) {
            //ALTERADO POR PMA: 2017.05.11 :: obj.editor.s.action != 'create'
            var el;
            var conditionalValue = false;
            setTimeout(function () {
                obj.syncFiltersAndForm(obj.externalFilter.template, "#newRForm");
            }, 1000);
        }
    };
    QuadTable.prototype.removeInlineCreateForm = function (action, cBut, bt) {
        var obj = this;
        obj.operation = "SELECT";
        var rowNode = obj.tbl.row("#newRow").node();
        var el = $("#" + obj.tableId).find(rowNode);
        obj.tbl.row("#newRow").remove();
        //_.remove(obj.tbl.data(),{DT_RowId:'newRow'});
        //removemos a row child se estiver aberta/visivel
        if (el.next("tr").hasClass("child")) {
            el.next("tr").remove();
        }
        el.hide("slow", function () {
            el.remove();
            if (action === "create") {
                cBut.remove();
                $(bt)
                        .siblings(".tblSave")
                        .remove();
            }

            bt.show("slow");
        });
    };
    QuadTable.prototype.rowToViewport = function (row) {
        var obj = this;
        $("#" + obj.tableId)
                .DataTable()
                .columns.adjust()
                .responsive.recalc();
        $(row)[0].scrollIntoView({
            behavior: "auto",
            block: "center",
            inline: "center"
        });
        $(window).trigger("resize");
    };
    QuadTable.prototype.cloneDataOnCreate = function (frm, clonedData, action) {
        var obj = this;
        $.each(clonedData, function (key, value) {
            if (_.contains(_.keys(obj.pk.primary), key) === true) {
                return;
            }
            obj.formElementData(clonedData, frm, key, value, action);
        });
    };

    /*QuadTable.prototype.multiInstanceFilter = function(target) {
     var obj = this;
     var frm = obj.externalFilter.templateMulti.selector;
     var formData = obj.getFiltersFormsData();
     _.remove(formData, { value: "" });
     _.remove(formData, { value: null });
     if (!obj.sFilters) {
     obj.sFilters = formData;
     } else {
     if (target && target.val() === "") {
     _.remove(obj.sFilters, {
     name: target.attr("name")
     });
     }
     formData = _.difference(formData, obj.sFilters);
     obj.sFilters = _(obj.sFilters)
     .concat(formData)
     .groupBy("name")
     .map(_.spread(_.merge))
     .value();
     }
     obj.operation = "SELECT";

     obj.resetData(true);
     obj.resetData();
     obj.recursiveReset(obj);
     if (obj.sFilters) {
     _.remove(obj.sFilters, { value: "" });
     _.remove(obj.sFilters, { value: null });
     }
     var data = obj.normalizeData(obj.getNormalizedFrmData(frm));
     obj.prepareData(data);
     if (!obj["sortInfo"]) {
     data = obj.mapComplexLists(data, true);

     //obj.setDML(data, "query");
     } else {
     //obj.setDML(data, "query", true);
     }

     if (obj.tbl) {
     obj.tbl.clear();
     obj.clearTable();
     obj.startIn = 0;

     obj.tbl
     .columns()
     .search()
     .draw();
     }
     };*/
    QuadTable.prototype.registerInlineSaveOperationCreate = function (bt, row) {
        var obj = this;
        $(":input", "#newRForm").on(
                "change",
                {
                    currentForm: $("#newRForm"),
                    action: "create"
                },
                function (evt) {
                    evt.stopImmediatePropagation();
                    //var rowData=obj.tbl.rows('#newRow').data()[0];
                    var rowData = $("#newRForm").serializeAllArray();
                    obj.frmElemChange(
                            evt.data.currentForm,
                            $(evt.target),
                            evt.data.action,
                            true,
                            rowData
                            );
                    $("#" + obj.tableId)
                            .DataTable()
                            .columns.adjust()
                            .responsive.recalc();
                    $(window).trigger("resize");
                    var sBut = $(
                            '<button title="' +
                            JS_SAVE +
                            '" class="btn btn-xs btn-success tblSave"><i class="far fa-save"></i></button>'
                            );
                    if ($(bt).siblings(".tblSave").length > 0) {
                        $(bt)
                                .siblings(".tblSave")
                                .show("slow");
                    } else {
                        bt.parent().append(sBut);
                        $(sBut[0]).on("click", function () {
                            if ($("#newRForm").valid()) {
                                var data = obj.getNormalizedFrmData($("#newRForm"));
                                data = obj.normalizeData(data);
                                data = obj.mapComplexLists(data);
                                obj.prepareData(data);
                                obj.operation = "INSERT";
                                //$('#newRForm').find('em.invalid').remove();
                                $("#newRForm")
                                        .find(".error")
                                        .removeClass("error");
                                $.when(obj.executeDml("INSERT")).then(function (dat) {
                                    var dat = JSON.parse(dat);
                                    if (obj.checkError(dat, $("#newRForm"), true)) {
                                        return;
                                    }
                                    dat = obj.normalizeData(dat);
                                    dat = obj.fixData(dat);
                                    obj.addRecordToTable(dat.data[0]);

                                    var rowNode = obj.tbl.row("#newRow").node();
                                    var el = $("#" + obj.tableId).find(rowNode);
                                    obj.tbl.row("#newRow").remove();

                                    if (el.next("tr").hasClass("child")) {
                                        el.next("tr").remove();
                                    }
                                    el.hide("slow", function () {
                                        el.remove();
                                    });

                                    $("#" + obj.tableId)
                                            .DataTable()
                                            .columns.adjust()
                                            .responsive.recalc();
                                    $(window).trigger("resize");
                                });
                            } else {
                                $(window).trigger("resize");
                            }
                            $(row)
                                    .next(".child")
                                    .removeClass("loadingList");
                            $("#newRForm").valid();
                            $("#" + obj.tableId)
                                    .DataTable()
                                    .columns.adjust()
                                    .responsive.recalc();
                            $(window).trigger("resize");
                        });
                    }
                }
        );
    };
    QuadTable.prototype.manageDetailsCellsDataInlineOperation = function (
            r,
            rowData,
            action,
            frm
            ) {
        var obj = this;
        $(r)
                .next(".child")
                .find(".dtr-data")
                .each(function (i, it) {
                    var search = {};
                    search["label"] = it.previousElementSibling.innerText.toUpperCase();
                    var target = obj.findtargetByLabel(search);
                    if (
                            target &&
                            (target["type"] === undefined || target["type"] !== "hidden")
                            ) {
                        var h = obj.renderInlineInput(target, it, action, rowData, frm);

                        if (action === "create") {
                            obj.convertRowToForm(it, target, h, rowData, action, frm);
                        } else {
                            obj.mapDataToInlineInputs(target, h, rowData, action, frm);
                        }
                        obj.isRequired($(h), $(h));
                    } else {
                        $(it)
                                .parent()
                                .html("");
                    }
                });
    };
    QuadTable.prototype.inlineInputFormat = function (target, it, rowData) {
        var obj = this;
        var h = obj.domInputType(target);
        $.each(target["attr"], function (key, value) {
            h.attr(key, value);
        });
        if (h.attr("disabled")) {
            h.removeAttr("disabled");
        }
        h.width($(it).width() + 50);
        return h;
    };

    QuadTable.prototype.domInputType = function (target) {
        var h = "";
        if (target["attr"] && target["attr"]["dependent-group"]) {
            h = $("<select  class='form-control'>");
        } else {
            h = $("<input type='text' class='form-control'>");
        }
        return h;
    };

    QuadTable.prototype.convertRowToForm = function (
            it,
            target,
            h,
            rowData,
            action,
            frm
            ) {
        var obj = this;
        $(it).html(h);
        $.each(target["attr"], function (key, value) {
            h.attr(key, value);
        });
        h.css("padding", "5px 5px");
        if (target.complexList) {
            h.addClass("complexList");
            var el = $("[name='" + target.attr["name"] + "']", frm);

            obj.listOtherValues(target, rowData, el);

            obj.onEditFillComplexList(
                    target,
                    frm,
                    rowData,
                    "edit",
                    h,
                    h.attr("dependent-level")
                    );
        } else if (h.attr("domain-list")) {
            obj.onEditFillDomain(frm, target, rowData ? rowData.data[0] : null, action);
        } else {
            h.val(rowData ? rowData.data[0][h.attr("name")] : null);
        }
        if (target.fieldInfo) {
            h.after('<div class="help-block" style="display: none;"></div>');
        }
    };
    QuadTable.prototype.mapTargetToInlineInput = function (
            it,
            target,
            rowData,
            action,
            frm
            ) {
        var obj = this;
        if (target["type"] === undefined || target["type"] !== "hidden") {
            var h = obj.inlineInputFormat(target, it, rowData);

            obj.convertRowToForm(it, target, h, rowData, action, frm);
        } else {
            $(it).html("");
        }

        obj.isRequired($(h), $(h));
    };

    QuadTable.prototype.registerInlineSaveOperationEdit = function (
            r,
            frm,
            operation
            ) {
        var obj = this;
        $(".tblSave", r).on("click", function (e) {
            e.stopImmediatePropagation();
            obj.validateFrm(frm, obj.validations);
            if (frm.valid()) {
                var copyOfDbcolumns = $.extend({}, obj.dbColumns);
                var newData = obj.getNormalizedFrmData(frm);
                newData = obj.normalizeData(newData);
                newData = obj.mapComplexLists(newData);
                obj.prepareData(newData, copyOfDbcolumns);
                obj.operation = operation;
                $.when(obj.executeDml(operation)).then(function (dat) {
                    var dat = JSON.parse(dat);

                    if (obj.checkError(dat, frm, true)) {
                        return;
                    }

                    $(r)
                            .find(".tblCancel")
                            .trigger("click");

                    window.copyEditorData = obj.convertToDTRowData(obj.dbColumns);
                    window.copyEditorData.DT_RowId = obj.composeId(
                            obj.pk.primary,
                            window.copyEditorData
                            );
                    dat = obj.fixData(dat);
                    dat = dat.data[0];
                    /* RowNode tem o formato html de uma row. ex:<tr>...</tr> , para fazer o prepend(rowNode) */
                    obj.tbl.row("#" + window.copyEditorData.DT_RowId).data(dat);
                    $("#" + dat.DT_RowId)
                            .fadeIn(500)
                            .fadeOut(500)
                            .fadeIn(500)
                            .fadeOut(500)
                            .fadeIn(500);
                    obj.tbl.rows("#" + dat.DT_RowId).select();

                    obj.operation = "SELECT";
                    $(window).trigger("resize");
                });
            } else {
                $(window).trigger("resize");
            }
            $(r)
                    .next(".child")
                    .removeClass("loadingList");
            $("#editRForm").valid();
            $("#" + obj.tableId)
                    .DataTable()
                    .columns.adjust()
                    .responsive.recalc();
            $(window).trigger("resize");
        });
    };
    QuadTable.prototype.displayInlineUpload = function (data, r) {
        var obj = this;

        if (_.find(obj.tableCols, {type: "upload"})) {
            var content = obj.getUploadCell(r);

            if (data[obj.inRowDoc.fileNameField]) {
                $(content.cell).html(
                        $(obj.getFileIcon(data[obj.inRowDoc.extField], data)).addClass(
                        "inlineEdit"
                        )
                        );
                var childCell = $(r)
                        .next(".child")
                        .find(
                                'li[data-dtr-index="' +
                                _.find(obj.tableCols, {name: obj.inRowDoc.fileNameField})[
                                "targets"
                        ] +
                                '"]'
                                );
                $(childCell).html(
                        $(obj.getFileIcon(data[obj.inRowDoc.extField], data)).addClass(
                        "inlineEdit"
                        )
                        );
            } else {
                $(content.cell).html(content.template);
            }
            obj.setUpload(r);
        }
    };
    QuadTable.prototype.setupInlineCreateUpload = function (row) {
        var obj = this;
        if (_.find(obj.tableCols, {type: "upload"})) {
            var template =
                    '<input type="file" class="form-control"  aria-invalid="false"/>';
            //var cellIndex=obj.tbl.row( row[0] ).column('LINK_DOC:name' )[0][0]
            //var cell=obj.tbl.row( row ).column('LINK_DOC:name' );
            var rowIdx = obj.tbl.row(obj.tbl.row("#newRow").index())[0][0];
            var colIdx = obj.tbl
                    .row(obj.tbl.row("#newRow").index())
                    .column(obj.inRowDoc.fileNameField + ":name")
                    .index();
            var cell = obj.tbl
                    .row($(row)[0])
                    .columns()
                    .cell({row: rowIdx, column: colIdx})
                    .nodes()[0];
            var pgrBar =
                    '<div class="progress">' +
                    '<div class="progress-bar" role="progressbar" style="width: 0% " aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>' +
                    "</div>" +
                    "</div>";
            $(cell).html(pgrBar + template);
            var childCell = $(row)
                    .next(".child")
                    .find(
                            'li[data-dtr-index="' +
                            _.find(obj.tableCols, {name: obj.inRowDoc.fileNameField})[
                            "targets"
                    ] +
                            '"]'
                            );
            $(childCell).html(pgrBar + template);
            $("input[type=file]", "#newRForm").on("change", function (e) {
                e.stopImmediatePropagation();
                if (!obj.editor.frmData) {
                    obj.editor["frmData"] = new FormData();
                }
                if (obj["inRowDoc"]) {
                    //formDataDelete(obj.editor.frmData, 'upload[]', 0);
                    if (!obj.editor.frmData) {
                        obj.editor["frmData"] = new FormData();
                    }
                    obj.editor.frmData.append("upload[]", this.files[0]);
                    obj.editor.frmData.append("inRowDoc", JSON.stringify(obj["inRowDoc"]));
                    //container.find('.divUploadFile').remove();
                }
                $(this)
                        .parent()
                        .append(
                                '<div class="divUploadFile"><span class="spanFileName">' +
                                this.files[0].name +
                                '<i class="fas fa-times faFileRemove pull-right"></i><div/>'
                                );
            });
            obj.setUpload();
        }
    };
    QuadTable.prototype.externalFilterChangeEvent = function (settings) {
        var obj = this;
        $(document).one("mouseover", obj.externalFilter.template.selector, function (
                evt
                ) {
            $($(this)).on(
                    "change",
                    ".complexList, input:not(.chosen-search-input), select",
                    {currentForm: $(this)},
                    function (e, evtdata) {
                        var currentTarget = $(e.currentTarget);
                        $("#" + e.data.currentForm[0].id)
                                .find(".alert")
                                .remove();
                        e.stopImmediatePropagation();

                        var formData = obj.getFiltersFormsData();
                        obj.checkMandatoryFilters(formData);
                        _.remove(formData, {value: ""});
                        _.remove(formData, {value: null});

                        if (!obj.sFilters || obj.sFilters.length===0) {
                            obj.sFilters = formData;
                        } else {
                            obj.filterFilters(formData);
                            if ($(this).val() === "") {
                                var elm = $(this);

                                _.remove(obj.sFilters, {
                                    name: elm.attr("name")
                                });
                                obj.qFilters = _.omit(obj.qFilters, elm.attr("name"));

                                if (elm.hasClass("complexList")) {
                                    var keys = elm.attr("distribute-value")
                                            ? elm.attr("distribute-value").split("@")
                                            : elm.attr("data-db-name").split("@");

                                    _.map(keys, function (field, j) {
                                        if (obj["qFilters"]) {
                                            delete obj["qFilters"][field];
                                        }
                                    });
                                }
                            }
                        }
                        _.forEach(formData, function (o, i) {
                            //remove all empty properties and put it into an array
                            var ob = _.find(obj.tableCols, {name: o.name});
                            var el = $(
                                    "#" + $(e.data.currentForm).attr("id") + ' [name="' + o.name + '"]'
                                    );
                            var idx = _.findIndex(obj.sFilters, {
                                name: o.name
                            });
                            if (el.attr("dependent-group")) {
                                //add text propertie if is domain or complexList for further use if custom order by                                                _.find(formData, {name: o.name})['value'] = el.val();
                                if (el.hasClass("complexList")) {
                                    o["text"] = _.find(obj.getComplexListIndex(ob), {
                                        VAL: el.val()
                                    })[
                                            Object.keys(
                                                    _.find(obj.getComplexListIndex(ob), {
                                                        VAL: el.val()
                                                    })
                                                    )[0]
                                    ];
                                } else {
                                    var idxField = ob["attr"]["showValues"]
                                            ? Object.keys(ob["attr"]["showValues"])[0]
                                            : "RV_MEANING";
                                    o["text"] = _.find(
                                            initApp.joinsData[ob.attr["dependent-group"]],
                                            {RV_LOW_VALUE: el.val()}
                                    )[idxField];
                                }
                                if (obj.sFilters) {
                                    obj.sFilters[idx]["text"] = _.find(formData, {
                                        name: o.name
                                    })["text"];
                                }
                            }
                        });
                        obj.operation = "SELECT";
                        var data = obj.normalizeData(
                                obj.getNormalizedFrmData($(obj.externalFilter.template))
                                );
                        obj.prepareData(data);
                        obj.frmElemChange(e.data.currentForm, $(this), "create");
                        data = obj.convertToDTRowData(obj.dbColumns);
                        obj.resetData(true);
                        obj.resetData();

                        obj.recursiveReset(obj);
                        if (obj.sFilters) {
                            _.remove(obj.sFilters, {value: ""});
                            _.remove(obj.sFilters, {value: null});
                            var dtData = {};
                            var tmp = Object.values(obj.sFilters);
                            tmp.forEach(function (d, i) {
                                if (d.overrideName) {
                                    return false;
                                }
                                dtData[d.name.toUpperCase()] = d.value;
                                var o = _.find(obj.tableCols, {name: d.name});

                                if (
                                        o["attr"]["dependent-group"] ===
                                        currentTarget.attr("dependent-group")
                                        ) {
                                    var levels = [];
                                    if (o["attr"]["dependent-level"]) {
                                        if (
                                                o["attr"]["dependent-level"].toString().indexOf("&") != -1
                                                ) {
                                            levels = o["attr"]["dependent-level"].split("&");
                                        } else {
                                            levels.push(o["attr"]["dependent-level"]);
                                        }
                                    }
                                    $.each(levels, function (i, level) {
                                        if (
                                                d.name !== currentTarget.attr("name") &&
                                                parseInt(level) ===
                                                parseInt(currentTarget.attr("dependent-level")) + 1
                                                ) {
                                            var results = _.filter(obj.getComplexListIndex(o), function (
                                                    ob
                                                    ) {
                                                if (_.startsWith(ob.VAL, currentTarget.val())) {
                                                    return ob.VAL;
                                                }
                                            });
                                            if (!_.find(results, {VAL: d.value})) {
                                                obj.sFilters.splice(i, 1);
                                                $("." + obj.tableId + "_sFilters")
                                                        .find('li[data-filter^="' + d.name + ':"]')
                                                        .remove();
                                            }
                                        }
                                    });
                                }
                            });
                        }
                        data = obj.normalizeData(dtData);

                        if (!obj["sortInfo"]) {
                            data = obj.mapComplexLists(data);
                            obj.prepareData(data);

                            //obj.setDML(data, "query");
                        } else {
                            data = obj.mapComplexLists(data);
                            obj.prepareData(data);
                            //obj.setDML(data, "query", true);
                        }

                        if ($("#newRow", "#" + obj.tableId).length > 0) {
                            $("th > .tblCancel", "#" + obj.tableId + "_wrapper").trigger("click");
                        }
                        if ($("#editRForm", document).length > 0) {
                            $(".tblCancel", "#editRForm").trigger("click");
                        }
                        obj.tbl.clear();
                        obj.clearTable();
                        obj.startIn = 0;
                        $(".select-info", "#" + obj.tableId + "_info").remove();

                        if (obj.tbl.data().count() == 0) {
                            obj.tableNoRecordsMsg();
                        }
                        $("#" + obj.tableId + "_info > .nRecords").text(
                                obj.tbl.data().count() + " " + obj.i18nEntries.record
                                );
                        var setgs = obj.tbl.settings()[0];
                        if (evtdata && evtdata["targetedFrm"]) {
                            formData = _.difference(
                                    obj.getFiltersFormsData(),
                                    evtdata["targetedFrm"].serializeAllArray()
                                    );
                        }

                        obj.externalFilterFieldsVisibility(setgs);
                        if (evtdata && evtdata.submit === false) {
                        } else {
                            obj.tbl
                                    .columns()
                                    .search()
                                    .draw();
                        }
                    }
            );
        });
    };

    QuadTable.prototype.dataToLists = function (data, action) {
        var obj = this;
        var frm = $("#" + obj.tableId + "_editorForm");
        $(".upload", frm).show("slow");
        frm.find(".editorErrorContainer").remove(); //PMA:ERROR HANDLING: Removes ERROR ROW if exists
        /* Carregamos os valores das domain lists */
        obj.populateDomainLists(frm, obj.editor.s.action);
        /* Carregamos os dados das listas complexas com nivel 1 */
        _.forEach(obj.tableCols, function (o, key) {
            var el = $("#" + obj.tableId + "_editorForm" + ' [name="' + o.name + '"]');
            /* Activamos as que estão disabled , pois é um CREATE e precisamos de todos os campos para preencher */
            if (el.attr("disabled")) {
                el.removeAttr("disabled");
            }
            if (_.has(o, "complexList")) {
                if (obj.editorXt) {
                    //este método detecta se a lista existe nos filtros e preenche com valor do filtro, por isso também enviamo o data.data[0] e o xtform
                    obj.fillComplexList(
                            o,
                            frm,
                            $(obj.externalFilter.template.selector),
                            data ? data.data[0] : null,
                            obj.editor.s.action
                            );
                } else {
                    if (o.attr["dependent-level"] && o.attr["dependent-level"] == 1) {
                        obj.fillComplexList(o, frm, null, null, obj.editor.s.action);
                    }
                }
            }
            if (_.has(o.attr, "domain-list") && obj.editorXt) {
                //se o domain existir no filtro
                obj.onEditFillDomain(
                        frm,
                        o,
                        data ? data.data[0] : null,
                        obj.editor.s.action
                        );
            }
            if (o.def && action !== "query") {
                el.val(o.def);
            }
        });
    };

    QuadTable.prototype.retrieveDisplayData = function (callback) {
        var obj = this;
        callback = callback || obj["dtCallback"];
        var xtFormData = obj.getFiltersFormsData();
        if (!obj.checkMandatoryFilters(xtFormData)) {
            return false;
        }
        //obj.setDML()

        $.when(obj.getData(false, null, null)).then(function (dat) {
            var dat = JSON.parse(dat);
            if (obj.checkError(dat, $("#" + obj.tableId + "_editorForm"), true)) {
                return;
            }

            dat = obj.fixData(dat);
            obj.advancedSearchStatus(dat);

            //renderizamos os dados
            callback(dat);
            obj.acl("#" + obj.tableId + "_editorForm");
            $("#" + obj.tableId)
                    .DataTable()
                    .columns.adjust()
                    .responsive.recalc();
            $(window).trigger("resize");
            obj.showCountInfo();
            if (obj.dependsOn) {
                var detail = Object.keys(obj.dependsOn)[0];
                obj.checkInactive(
                        window[detail].tbl.row(".selected").data(),
                        window[detail]
                        );
            }

            setTimeout(function () {


                obj.selectFirstRow();

            }, 0);

        });
    };

    QuadTable.prototype.editorOpenRules = function (action, data, rowData) {
        var obj = this;
        var frm = $("#" + obj.tableId + "_editorForm");

        if (action === "create") {
            obj.resetData();
            obj.dataToLists(rowData, action);

            setTimeout(function () {
                var results = obj.tableCols.filter(function (item) {
                    return item.hasOwnProperty("def");
                });
                _.forEach(results, function (item, i) {
                    $(
                            '[name="' + item.name + '"]',
                            "#" + obj.tableId + "_editorForm"
                            ).trigger("change");
                });
                if (obj.cloneData) {
                    if (obj.editor.s.editOpts["cloneData"]) {
                        var clonedData = obj.editor.s.editOpts["rowData"][0];

                        obj.cloneDataOnCreate(frm, clonedData, action);
                    }
                }
            }, 10);
        } else if (action === "edit") {
            if (_.find(obj.tableCols, {type: "upload"})) {
                if (obj.inRowDoc) {
                    if (rowData[obj.inRowDoc.extField]) {
                        $(".upload", frm).hide("slow"); //EDITOR HIDE UPLOAD BUTTON
                    } else {
                        $(".upload", frm).show("slow"); //EDITOR SHOW UPLOAD BUTTON
                    }
                } else {
                    //todo docsTable multifile
                }
            }

            //$('#' + obj.tableId + '_editorForm').off('change', '.complexList, input, select');
            obj.fillListsAndDomains(action, data, rowData, frm);
        }
        obj.manageFiltersData();

        //obj.dataToLists(rowData,action);
        if (action !== "edit") {
            obj.syncFiltersAndForm(frm, frm);
        }
    };

    QuadTable.prototype.externalFilterRegister = function (settings) {
        var obj = this;
        if (!obj.editorXt) {
            var EditorXt = $.fn.dataTable.Editor;
            EditorXt.display.xtFormDisplay = $.extend(
                    true,
                    {},
                    EditorXt.models.displayController,
                    {
                        init: function (editor, form, callback) {
                            obj.externalFilterChangeEvent(settings);

                            return this;
                        },
                        open: function (editor, form, callback) {
                            form = $(obj.externalFilter.template.selector);

                            form.show();
                            form.addClass("extendedForm"); //to know if allready filters loaded
                            $(".chosen", form).chosen("destroy");
                            var el, ob;
                            form.trigger("mouseover");

                            $.each(form.find(':input:not(".chosen-search-input")'), function (
                                    i,
                                    field
                                    ) {
                                ob = _.find(obj.tableCols, {name: field.name});
                                $("[for=" + field.id + "]", form).text(ob.label);

                                if (
                                        field.attributes["dependent-level"] &&
                                        field.attributes["dependent-level"].value == 1
                                        ) {
                                    var data = obj.normalizeData(
                                            obj.getNormalizedFrmData(
                                                    $("#" + settings.nTable.id + "_xtForm")
                                                    )
                                            );
                                    data = obj.mapComplexLists(data);
                                    obj.prepareData(data);

                                    obj.fillComplexList(ob, form, "editorXt", data, "create");
                                }

                                if (_.has(field.attributes, "domain-list")) {
                                    setTimeout(function () {
                                        obj.populateDomainLists(form, null);
                                    }, 0);
                                }

                                //todo signal required based on validations

                                obj.signalMandatoryFilters(
                                        form,
                                        obj.externalFilter.template,
                                        field
                                        );

                                if ($(field).data("def")) {
                                    setTimeout(function () {
                                        if ($(field).val() === "") {
                                            $(field).val($(field).data("def"));
                                            $(field).trigger("change", [
                                                {
                                                    submit: false,
                                                    refreshFilters: false
                                                }
                                            ]);
                                        }
                                    }, 0);
                                }
                            });
                        },
                        // Hide the form
                        close: function (editor, callback) {}
                    }
            );

            obj.editorXt = new $.fn.dataTable.Editor({
                table: "#" + obj.tableId,
                display: "xtFormDisplay",
                template: obj.externalFilter.template
            });
        }

        setTimeout(function () {
            obj.editorXt.create();

            obj.sFilters = obj.getFiltersFormsData();

            //obj.sFilters = $(obj.externalFilter.template).serializeAllArray();
            _.remove(obj.sFilters, {value: ""});
            _.remove(obj.sFilters, {value: null});
            obj.tbl
                    .columns()
                    .search()
                    .draw();
        }, 0);
    };

    QuadTable.prototype.externalFilterFieldsVisibility = function (settings) {
        var obj = this;
        obj.getFiltersFormsData().forEach(function (d) {
            var col = _.find(settings.aoColumns, {data: d.name});
            var column = obj.tbl.column(col.idx);

            if (_.find(obj.tableCols, {data: d.name})["visible"] !== false) {
                if (d.value) {
                    if (settings.aoColumns[col.idx].bVisible) {
                        if (!matchQry(d.value)) {
                            //PMA: DOES NOT HIDE QUADTABLE COLUMN :: Only HIDES if DOESN'T START with OPERATOR
                            if (column.responsiveHidden() === false) {
                                //todo hide if details
                                /* $(obj.tbl.row(rowIndex).node())
                                 .next(".child")
                                 .find("[data-dt-column='" + d.name + "']").hide()*/
                            } else {
                                column.visible(false);
                            }
                        }
                    }
                } else {
                    if (!settings.aoColumns[col.idx].bVisible) {
                        column.visible(true);
                    }
                    //todo show if details
                }
            }
        });
    };

    QuadTable.prototype.filterInstance = function (target) {
        var obj = this;
        delete obj["qFilters"];
        obj.resetData(true);
        obj.clearWorkFlow("#" + obj.tableId);
        $(obj.externalFilter.templateMulti).addClass("extendedForm"); //only to check if firts run ...data is loaded on lists etc...
        var formData = obj.getFiltersFormsData();
        //var formData = $(obj.externalFilter.template).serializeAllArray();
        _.remove(formData, {value: ""});
        _.remove(formData, {value: null});
        if (!obj.sFilters) {
            obj.sFilters = formData;
        } else {
            if (target && target.val() === "") {
                _.remove(obj.sFilters, {
                    name: target.attr("name")
                });
            }
            obj.filterFilters(formData);
        }
        obj.recursiveReset(obj);
        obj.operation = "SELECT";

        obj.manageFiltersData();
        obj.externalFilterFieldsVisibility(obj.tbl.settings()[0]);
        if (obj.tbl) {
            obj.tableDomReset();

            obj.tbl
                    .columns()
                    .search()
                    .draw();
        }
    };
    QuadTable.prototype.tableDomReset = function () {
        var obj = this;
        obj.tbl.clear();
        obj.clearTable();
        obj.startIn = 0;
        $(".select-info", "#" + obj.tableId + "_info").remove();

        if (obj.tbl.data().count() == 0) {
            obj.tableNoRecordsMsg();
        }
        $("#" + obj.tableId + "_info > .nRecords").text(
                obj.tbl.data().count() + " " + obj.i18nEntries.record
                );
    };
    QuadTable.prototype.renderInlineInput = function (target, it, action, rowData) {
        var obj = this;

        var h = obj.domInputType(target);
        $.each(target["attr"], function (key, value) {
            h.attr(key, value);
        });
        if (h.attr("disabled") && action === "create") {
            h.removeAttr("disabled");
        }
        h.width($(it).width() + 50);
        h.attr("name", target.name);
        h.attr("id", obj.tableId + target.name + action);
        $(it).html(h);
        h.css("padding", "5px 5px");

        if (target.fieldInfo) {
            h.after('<div class="help-block">' + target.fieldInfo + "</div>");
        }
        return h;
    };

    QuadTable.prototype.selectFirstRow = function () {
        var obj = this;

        if (obj.tbl.rows(0)) {
            var rowData = obj.tbl.row(0).data();
        }
        if (rowData) {
            var pk = obj.composeId(obj.pk.primary, rowData);
            //todo trigger row events ... duplicate requests potential
            $(obj.tbl.row("#" + pk).node()).addClass("selected");
            obj.tbl.row("#" + pk).select();
            $(obj.tbl.row("#" + pk).node()).trigger("click");
            $(".goEye", "#" + obj.tableId + "_info").remove();
            $(".select-info", "#" + obj.tableId + "_info").append(
                    '<span class="goEye" title="' +
                    JS_GO_RECORD +
                    '"><i data-rowId="' +
                    pk +
                    '" class="far fa-eye fa-2x"></i></span>'
                    );
        }
    };
    QuadTable.prototype.advancedSearchStatus = function (dat) {
        var obj = this;
        if (dat.data.length == 0) {
            $("#" + obj.tableId + "_dtAdvancedSearch").hide("slow");
        } else if (dat.data.length > 0) {
            $("#" + obj.tableId + "_dtAdvancedSearch").show("slow");
        }
    };

    QuadTable.prototype.getUploadCell = function (r) {
        var obj = this;
        var template =
                '<input type="file" class="form-control" aria-invalid="false"/>';
        var rowIdx = obj.tbl.row(obj.tbl.row(r).index())[0][0];
        var colIdx = obj.tbl
                .row(obj.tbl.row(r).index())
                .column(obj.inRowDoc.fileNameField + ":name")
                .index();
        var cell = obj.tbl
                .row(r)
                .columns()
                .cell({row: rowIdx, column: colIdx})
                .nodes()[0];
        return {cell: cell, template: template};
    };

    QuadTable.prototype.dataToCells = function (r, data) {
        var obj = this;

        $(r)
                .children("td")
                .each(function (i, it) {
                    if ($(it).is(":not(:first-child):not(:last-child)")) {
                        var target = _.find(obj.tableCols, {
                            targets: it._DT_CellIndex.column
                        });
                        obj.cellContent(r, data, target, it);
                    }
                });
    };

    QuadTable.prototype.dataToDetailsCells = function (r, data) {
        var obj = this;
        $(r)
                .next(".child")
                .find(".dtr-data")
                .each(function (i, it) {
                    var search = {};
                    search["label"] = it.previousElementSibling.innerText.toUpperCase();
                    var target = obj.findtargetByLabel(search);

                    obj.cellContent(r, data, target, it);
                });
    };

    QuadTable.prototype.findtargetByLabel = function (search) {
        var obj = this;
        var target = _.find(obj.tableCols, function (o) {
            if (o.label) {
                return o.label.toUpperCase() === search.label;
            }
        });
        return target;
    };

    QuadTable.prototype.cellContent = function (r, data, target, it) {
        var obj = this;
        var od = obj.tbl
                .row(r)
                .cells(it)
                .data();
        if (target.type && target.type === "upload") {
            $(it).html(
                    $(obj.getFileIcon(data[obj.inRowDoc.extField], data)).removeClass(
                    "inlineEdit"
                    )
                    );
        } else {
            $(it).html(od[0]);
        }
    };

    QuadTable.prototype.tableFirstPaint = function (settings) {
        var obj = this;
        obj.resetData();
        if (obj.externalFilter) {
            if (obj.externalFilter.template) {
                if (obj.externalFilter.templateMulti) {
                    obj.externalMultiFilterInit(
                            obj.externalFilter.templateMulti.selector,
                            false
                            );
                    obj.externalFilterFieldsVisibility(settings);
                }
                obj.externalFilterRegister(settings);

                obj.externalFilterFieldsVisibility(settings);
                return;
            }
            if (obj.externalFilter.templateMulti) {
                obj.externalMultiFilterInit(obj.externalFilter.templateMulti.selector);
                obj.externalFilterFieldsVisibility(settings);
                return;
            }
            var formData = obj.getFiltersFormsData();
            obj.sFilters = formData;
            //obj.setDML();
        }

        setTimeout(function () {
            //esperamos que datatables inicialize se for o caso
            obj.tbl
                    .columns()
                    .search()
                    .draw();
        }, 0);
    };

    QuadTable.prototype.manageCellsDataInlineOperation = function (
            row,
            frm,
            action,
            rowData,
            bt,
            bt2
            ) {
        var obj = this;
        $(row)
                .children("td")
                .each(function (i, it) {
                    if ($(it).is(":not(:first-child):not(:last-child)")) {
                        if (obj.colReorder) {
                            var target = _.find(obj.tableCols, {
                                targets: obj.tbl.colReorder.order()[it._DT_CellIndex.column]
                            });
                        } else {
                            var target = _.find(obj.tableCols, {
                                targets: it._DT_CellIndex.column
                            });
                        }
                        if (
                                (target && target["type"] === undefined) ||
                                target["type"] !== "hidden"
                                ) {
                            var h = obj.renderInlineInput(target, it, action, frm, rowData);
                            obj.mapDataToInlineInputs(target, h, rowData, action, frm);
                        } else {
                            $(it).html("");
                        }
                    }
                    if ($(it).is(":last-child")) {
                        if (action === "edit") {
                            bt.html(JS_SAVE)
                                    .addClass("tblSave waves-effect waves-themed")
                                    .removeClass("tblEditBut")
                                    .show("slow");
                            bt2.html(JS_CANCEL).addClass("tblCancel waves-effect waves-themed");
                            bt2.removeClass("tblDelBut");
                            bt.hide();
                        } else {
                            $(it).html("");
                        }
                    }
                    obj.isRequired($(h), $(h));
                });
    };

    QuadTable.prototype.addRecordToTable = function (data) {
        var obj = this;

        obj.tbl.row.add(data);
        /* RowNode tem o formato html de uma row. ex:<tr>...</tr> , para fazer o prepend(rowNode) */
        var rowNode = obj.tbl.row("#" + data.DT_RowId).node();
        $("#" + obj.tableId).prepend(rowNode);
        ++obj.totalRecords;
        obj.tbl.row("#" + data.DT_RowId).data(data);
        $(rowNode)[0].scrollIntoView(false);

        obj.showCountInfo();
        /* Remover a mensagem , se houver registos */
        if (obj.tbl.data().count() > 0) {
            $("#" + obj.tableId + " .dataTables_empty")
                    .parent()
                    .remove();
        }
        /* Removemos a seleção prévia e seleccionamos o registo adicionado */
        obj.tbl.rows().deselect();
        $("#" + data.DT_RowId)
                .addClass("selected")
                .fadeIn(500)
                .fadeOut(500)
                .fadeIn(500);
        obj.tbl.rows("#" + data.DT_RowId).select();
    };

    QuadTable.prototype.filterVisibleSearchFields = function (action) {
        var obj = this;
        if (obj.externalFilter && obj.externalFilter.template) {
            var xtFormData = obj.getFiltersFormsData();
            //var xtFormData = $(obj.externalFilter.template).serializeAllArray();

            if (_.has(obj.externalFilter.template, "optional")) {
                _.forEach(obj.externalFilter.template.optional, function (field) {
                    if (action === "query") {
                        $(
                                ".DTE_Field_Name_" + field,
                                "#" + obj.tableId + "_editorForm"
                                ).show();
                    }
                });
                //se houver filtros exteriores preenchidos e que sejam optionais , preenchemos valor no input e escondemo-lo. Se não tiver valor mostramos o input para preenchimento
                _.forEach(xtFormData, function (fld, i) {
                    if ($.inArray(fld.name, obj.externalFilter.template.optional) !== -1) {
                        if (fld.value !== "") {
                            $(
                                    ".DTE_Field_Name_" + fld.name,
                                    "#" + obj.tableId + "_editorForm"
                                    ).hide();
                        } else {
                            $(
                                    ".DTE_Field_Name_" + fld.name,
                                    "#" + obj.tableId + "_editorForm"
                                    ).show();
                        }
                    }
                });
            }
            if (_.has(obj.externalFilter.template, "mandatory")) {
                //se houver filtros exteriores preenchidos e que sejam obrigatórios , preenchemos valor no input e escodemo-lo. Se não tiver valor mostramos o input para preenchimento
                _.forEach(obj.externalFilter.template.mandatory, function (field) {
                    if (action === "query") {
                        $(
                                ".DTE_Field_Name_" + field,
                                "#" + obj.tableId + "_editorForm"
                                ).show();
                        _.forEach(xtFormData, function (fld, i) {
                            if (
                                    $.inArray(fld.name, obj.externalFilter.template.mandatory) !== -1
                                    ) {
                                fld.value !== ""
                                        ? $(
                                                ".DTE_Field_Name_" + fld.name,
                                                "#" + obj.tableId + "_editorForm"
                                                ).hide()
                                        : $(
                                                ".DTE_Field_Name_" + fld.name,
                                                "#" + obj.tableId + "_editorForm"
                                                ).show();
                            }
                        });
                    } else {
                        //escondemos os campos com o mesmo nome dos filtros obrigatórios pois já estamos a dizer que só abre editor se todos os filtros obrigatórios estiverem preenchidos
                        $(
                                ".DTE_Field_Name_" + field,
                                "#" + obj.tableId + "_editorForm"
                                ).hide();
                    }
                });
            }
        }
    };

    QuadTable.prototype.resetTableInstance = function () {
        var obj = this;

        $("." + obj.tableId + "_sFilters").empty();
        if (obj.sFilters) {
            delete obj.sFilters;
        }
        if (obj.qFilters) {
            delete obj.qFilters;
        }
        $("#" + obj.tableId + "_info")
                .find(".nRecords")
                .remove();
        if ($.fn.DataTable.isDataTable("#" + obj.tableId)) {
            obj.tableDomReset();
            if (obj.dependsOn) {
                obj.informToSelect(window[Object.keys(obj.dependsOn)[0]]);
            }
            obj.tbl.responsive.recalc();
            $("#" + obj.tableId + "_wrapper th:last-child")
                    .find(".tblCreateBut")
                    .attr("disabled", 1);

            if (obj.editorXt) {
                $(obj.externalFilter.template.selector)[0].reset();
            }
            //Repomos os filtros multiinstance
            obj["sFilters"] = obj.getFiltersFormsData();
            obj.resetData();
        }
    };

    QuadTable.prototype.informToSelect = function (master) {
        var obj = this;
        var elId = "#" + obj.tableId + "_processing";
        $(elId).hide("slow");

        var dtSelectMessage =
                '<tr class="odd"><td valign="top" colspan="100" class="dataTables_empty">' +
                master.selectRecordMsg +
                " </td></tr>";
        $("#" + obj.tableId + " tbody").html(dtSelectMessage);
        $("#" + obj.tableId + "_dtAdvancedSearch").hide("slow");
        $("." + obj.tableId + "_spinner").hide("slow");
    };

    QuadTable.prototype.deleteTableRow = function (dat, rowId) {
        var obj = this;
        if (dat.workflow) {
            return;
        }
        var rowNode = obj.tbl.row(rowId).node();
        var el = $("#" + obj.tableId).find(rowNode);
        //removemos a row child se estiver aberta/visivel
        if (el.next("tr").hasClass("child")) {
            el.next("tr").remove();
        }
        obj.tbl.row(rowId).remove(); // this remove row from datatables data(removes object from array)
        el.hide("slow", function () {
            el.remove();
            //PMA :: Se o registo a ser removido for o ultimo, mostramos mensagem de que não há registos
            if (obj.tbl.data().count() == 0) {
                obj.tableNoRecordsMsg();
            }
        }); //this removes row from table(removes the <tr>) because we dont use API draw()
        --obj.totalRecords;
        obj.showCountInfo();
        obj.initState = true;
    };
    QuadTable.prototype.tableNoRecordsMsg = function () {
        var obj = this;
        var dtEmpty =
                '<tr class="odd"><td valign="top" colspan="100%" class="dataTables_empty">' +
                JS_NO_RECORDS_FOUND +
                "</td></tr>";
        $("#" + obj.tableId + " tbody").append(dtEmpty);
    };

    QuadTable.prototype.configUpload = function (selector) {
        var obj = this;

        obj.initializeDropZone(selector);

        $("." + obj.tableId + "_spinner").hide("slow");
    };
    QuadTable.prototype.outputFiles = function (files, el, inRow) {
        var obj = this;
        var lnk = "";
        if (inRow === undefined) {
            if (obj.inRowDoc) {
                inRow = true;
            } else {
                inRow = false;
            }
        }
        var html = "<ul class='fileList' data-role='" + obj.tableId + "'>";
        if (inRow) {
            var x = quadConfig.columnDefaultBDMime;
            if (files !== undefined) {
                lnk = obj.getFileIcon("", files);
                html +=
                        "<li class='fileItem'><i class='fas fa-times quad-right-padding-4' aria-hidden='true'></i>" +
                        lnk +
                        "</li>";
            }
        } else {
            console.log("LEO LINK's...");
            files.forEach(function (entry, i) {
                //var filename = f.replace(/^.*[\\\/]/, '')
                var filename = entry.file
                        .split("\\")
                        .pop()
                        .split("/")
                        .pop();
                var fPath = pn + entry.file.substring(entry.file.indexOf("..") + 3);
                if (filename.indexOf(":blob") !== -1) {
                    html +=
                            "<li class='fileItem' data-id=" +
                            entry.seq +
                            "><i class='fas fa-times quad-right-padding-4' aria-hidden='true'><a class='' href='" +
                            fPath +
                            "'>" +
                            filename.replace(":blob", "") +
                            "</a></li>";
                } else {
                    html +=
                            "<li class='fileItem' data-id=" +
                            entry.seq +
                            "><i class='fas fa-times quad-right-padding-4' aria-hidden='true'><a class='' href='" +
                            fPath +
                            "'>" +
                            filename +
                            "</a>/li>";
                }
            });
        }
        html += "</ul>";
        el.empty().html(html);
    };
