    var QuadEvents = function () {};

    QuadEvents.prototype.registerTableDropzoneEvents = function (selector) {
        var obj = this;
        obj["dropZone"].on("removedfile", function (file, xhr, formData) {
            if (!obj.editor.frmData) {
                obj.editor["frmData"] = new FormData();
            }
            obj.editor.frmData.append("upload[]", new File([""], null));
        });
        obj["dropZone"].on("sending", function (file, xhr, formData) {
            var that = this;
            var dt = obj.convertToDTRowData(obj.dbColumns);
            var dataCopy = obj.normalizeData(dt);
            obj.prepareData(dataCopy);

            var mData = {
                templateType: "datatable",
                pk: obj.pk.primary,
                operation: "UPLOAD",
                //dbColunas: JSON.stringify(obj.dbColumns),
                columnsArray: JSON.stringify(obj.dbColumns),
                table: obj.table,
                funcFields: obj.getFuncFields(),
                data: JSON.stringify(dt),
                //filename: obj['inRowDoc']['fileNameField'] ? renameFile(file.name, true, that, file) : renameFile(file.name)
                filename: file.name
            };

            $("." + obj.tableId + "_spinner").show("slow");
            formData.append("fieldsData", JSON.stringify(mData));
            obj.docsTable
                    ? formData.append("docsTable", JSON.stringify(obj.docsTable))
                    : formData.append("inRowDoc", JSON.stringify(obj.inRowDoc));
            formData.append("operation", "UPLOAD");
        });

        obj["dropZone"].on("success", function (file, response, evt) {
            if (this.files.length > 0) {
                this.removeFile(this.files[0]);
            }

            try {
                var res = JSON.parse(response),
                        dados;
                var oData = obj.convertToDTRowData(obj.dbColumns);
                var pk = obj.composeId(obj.pk.primary, oData);
                //_.find(obj.tbl.data(), obj.tbl.row("#" + pk).data());
                obj.docsTable ? (oData[obj.docsTable.fnName] = response) : null;
                //obj.tbl.row('#' + pk).data(oData);
                if (obj.inRowDoc) {
                    //ONE FILE per ROW
                    $("#saveFileEditor").click(); //Close File manager Window
                    obj.editor.close(); //Close Datatables Editor
                    obj.tbl.rows().deselect(); //Deslecionarar todas as linhas selecionadas do QuadTables
                    res = obj.normalizeData(res); //Normalização das estruturas de dados ("data": {dados})
                    dados = obj.fixData(res); //Acrescenta aos dados do (novo) registo o DT_ROWID (identificador único da linha) no QuadTables, descodificando (eventuais) listas necessárias
                    obj.tbl.row("#" + pk).data(dados.data[0]); //Update RECORD on datatables
                    $("#" + pk)
                            .addClass("selected")
                            .fadeIn(500)
                            .fadeOut(500)
                            .fadeIn(500); //Visual identification of record updated on quadTables
                } else {
                    //MULTIFILE
                    $(obj.tbl.row("#" + pk).node())
                            .find(".fCount")
                            .text(res[0].count);
                    $("#" + obj.tableId + "_editorForm")
                            .find(".fCount")
                            .text(res[0].count);
                    $("#mydropzone")[0].reset();
                    outputFiles(res[1], $("#mydropzoneFiles"), false);
                    //$('#myModal').modal('toggle');
                    $(".dz-file-preview,.dz-image-preview").remove();
                }
                //var k = _.findIndex(obj.tbl.data(), obj.tbl.row("#" + pk).data());
                $("." + obj.tableId + "_spinner").hide("slow");
            } catch (ex) {
                $("img." + obj.tableId + "_spinner.tableSpinner").hide(); //More precise selector
                setTimeout(function () {
                    $("#mydropzone")
                            .find(
                                    "div.dz-preview.dz-file-preview.dz-processing.dz-success.dz-complete"
                                    )
                            .removeClass("dz-success")
                            .addClass("dz-error");
                    $("#mydropzone")
                            .find("div.dz-error-message")
                            .addClass("quadMark")
                            .text(ex.message);
                }, 1000);
            }
            $("." + obj.tableId + "_spinner").hide("slow");
        });
    };

    QuadEvents.prototype.registerFormDropzoneEvents = function (selector) {
        var obj = this;
        obj["dropZone"].on("addedfile", function (file) {
            obj["srcs"] = obj["srcs"] || [];
            $(".dz-preview", selector).remove();

            obj["srcs"].push(file);
            //todo move this to quadconfig
            var imgMimeTypes = ["jpg", "jpeg", "png", "svg", "gif", "bmp", "webp"];
            var fileType = file.type.split("/");
            if (imgMimeTypes.indexOf(fileType[1].toLowerCase()) !== -1) {
                $("img:not(.tableSpinner)", obj.formId).attr(
                        "src",
                        (URL || webkitURL).createObjectURL(file)
                        );
            } else {
                //just force a non rendered src to display alt atribute

                $("img:not(.tableSpinner)", obj.formId).attr("src", "blabla");
                var cnp = file.name + " Cannot preview this file :( ";
                $("img:not(.tableSpinner)", obj.formId).attr("alt", cnp);
                $("img:not(.tableSpinner)", obj.formId).show();
            }

            if (obj["srcs"].length > 0) {
                if (
                        $(".docsViewer", obj.formId)
                        .find(".photoButtons")
                        .find(".apagaImg").length === 0
                        ) {
                    var deleteImg =
                            '<a class=\'apagaImg pull-left\'><i class="fa fa-trash fa-2x" aria-hidden="true"></i><a/>';
                    $(".docsViewer", obj.formId)
                            .find(".photoButtons")
                            .append(deleteImg);
                }
            }
            var form = document.getElementById(obj.formId.substring(1));
            obj.frmData = new FormData(form);
            obj.frmData.append("upload[]", file);
            obj.frmData.append("filenames[]", file.name);
            obj.uploadsUndoIcon();
        });
        obj["dropZone"].on("removedfile", function (file, xhr, formData) {
            obj.frmData.append("upload[]", new File([""], null));
        });
        obj["dropZone"].on("sending", function (file, xhr, formData) {
            $("." + obj.formId.substring(1) + "_spinner").show("slow");
            var dt = obj.getNormalizedFrmData(obj.formId);
            var dataCopy = obj.normalizeData(dt);
            obj.prepareData(dataCopy);

            var mData = {
                templateType: "datatable",
                pk: obj.pk.primary,
                operation: "UPLOAD",
                //dbColunas: JSON.stringify(obj.dbColumns),
                columnsArray: JSON.stringify(obj.dbColumns),
                table: obj.table,
                funcFields: obj.getFuncFields(),
                data: JSON.stringify(dt),
                filename: file.name
            };
            formData.append("fieldsData", JSON.stringify(mData));
            formData.append("docsTable", JSON.stringify(obj.docsTable));
            formData.append("inRowDoc", JSON.stringify(obj.inRowDoc));
            formData.append("operation", "UPLOAD");
        });
        obj["dropZone"].on("success", function (file, response, evt) {
            var res = JSON.parse(response);

            $("#mydropzone")[0].reset();

            $(".dz-file-preview,.dz-image-preview").remove();
            $("." + obj.formId.substring(1) + "_spinner").hide("slow");
            obj.myData["data"][obj.currentRecord] = res["data"][0];
            $("#myModal").modal("toggle");
            obj.dataRender(obj.formId, obj.currentRecord, null, obj["wkf"]);
        });
    };

    QuadEvents.prototype.getAdvancedSearchData = function () {
        var obj = this;
        $("button:contains('" + JS_EXECUTE + "')").click({obj: this}, function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $("#" + obj.tableId + "_dtAdvancedSearch").show("slow");
            $("." + obj.tableId + "_sFilters").empty();

            /* get dos valores do form*/
            var rowData = $("#" + obj.tableId + "_editorForm").serializeAllArray();
            /* Se o form não estiver vazio, significa que temos que mostrar os filtros para poderem ser removidos
             interactivamente (metodo resetFilter) através de evento no quadHelper */

            //_.remove(rowData, { value: "" });
            // _.remove(rowData, { value: null });

            if (obj.sFilters) {
                obj.filterFilters(rowData);
            } else {
                obj.sFilters = rowData;
            }
            if (obj.isEmptyForm($("#" + obj.tableId + "_editorForm")) === false) {
                var o, el, elText;
                /* Valores que são preenchidos no form de filtros (xtForm) */
                $("." + obj.tableId + "_sFilters").addClass("qryFilters");
                rowData.forEach(function (d) {
                    //se houver filtros exteriores , sincronizamos uns com os outros. ex: preenchemos no form de filtros exteriores o valor se houver campos comuns
                    if (obj.editorXt) {
                        if (d.value) {
                            el = $(obj.externalFilter.template).find('[name="' + d.name + '"]');
                            if (el.length > 0) {
                                if (el.val() === "") {
                                    el.val(d.value);
                                    if (el.hasClass("chosen")) {
                                        el.trigger("chosen:updated");
                                    }
                                    /* Dizemos ao form de filtros para não fazer o request, apenas atualizar os valores
                                     dos filtros, senão teriamos requests duplicados,
                                     mas fazemos a filtragem de listas etc com o evento change do elemento */
                                    el.trigger("change", [
                                        {
                                            submit: false,
                                            refreshFilters: false,
                                            targetedFrm: frm
                                        }
                                    ]);
                                }
                            }
                        }
                    }
                    if (d.value) {
                        //Identificamos o filtro e agarramos o texto/valor do filtro
                        el = $("#" + obj.tableId + "_editorForm").find(
                                '[name="' + d.name + '"]'
                                );
                        o = _.find(obj.tableCols, {name: d.name});

                        if (el.is("select")) {
                            if (el.hasClass("complexList")) {
                                elText = _.find(obj.getComplexListIndex(el), {
                                    VAL: el.val()
                                })[
                                        Object.keys(
                                                _.find(obj.getComplexListIndex(el), {VAL: el.val()})
                                                )[0]
                                ];
                            } else {
                                var idxField = o["attr"]["showValues"]
                                        ? Object.keys(o["attr"]["showValues"])[0]
                                        : "RV_MEANING";
                                elText = _.find(initApp.joinsData[el.attr("dependent-group")], {
                                    RV_LOW_VALUE: el.val()
                                })[idxField];
                            }
                        } else {
                            elText = d.value;
                        }
                        if (!obj.isExternalFilter(d.name)) {
                            obj.filterTag(d.value, o.data, o.sTitle.toUpperCase(), elText);
                        } else {
                            if (obj.externalFilter.template) {
                                var el = $(
                                        "[name=" + d.name + "]",
                                        obj.externalFilter.template.selector
                                        );
                                el.val(d.value);
                            }
                        }
                    }
                });
            }

            var dat = obj.getNormalizedFrmData($("#" + obj.tableId + "_editorForm"));

            dat["data"] = [];
            dat["data"].push(dat);
            if (!obj["sortInfo"]) {
                dat = obj.mapComplexLists(dat);

                //obj.setDML(dat, "query");
            } else {
                //se não houver 'sortInfo', não precisamos de mapear listas complexas e o ultimo parametro de setDml é passado a true
                //obj.setDML(dat, "query", true);
            }
            $.when(obj.getData(false)).then(function (dat) {
                var dat = JSON.parse(dat);
                if (
                        obj.checkError(dat, $("#" + obj.tableId + "_editorForm"), obj.sFilters)
                        ) {
                    return;
                }
                obj.tbl.clear();
                obj.clearTable();
                if (dat.data.length == 0) {
                    obj.totalRecords = 0;
                    var recordSet = obj.fixData(dat);
                    obj["dtCallback"](recordSet);
                    obj.totalRecords = 0;
                } else {
                    var recordSet = obj.fixData(dat);
                    obj["dtCallback"](recordSet);
                }
                obj.tbl.rows().deselect();
                obj.editor.close();
                /* Atualiza informação de rodapé no QuadTables */
                obj.showCountInfo();
                setTimeout(function () {
                    obj.selectFirstRow();
                }, 0);
                $("#" + obj.tableId)
                        .DataTable()
                        .columns.adjust()
                        .responsive.recalc();
                $(window).trigger("resize");
            });
            /* Se houver DETAILS, reiniciamos/limpamos pois não temos registos seleccionados logo após uma pesquisa*/
            if (obj.detailsObjects) {
                _.forEach(obj.detailsObjects, function (o, key) {
                    if (window[o] instanceof QuadTable) {
                    } else if (window[o] instanceof QuadForm) {
                        window[o].clearForm(window[o].formId);
                    }
                    window[o].startIn = 0;
                });
            }
            /* MUITO IMPORTANTE após qualquer operação no editor, por sempre propriedade processing = false senão editor deixa de funcionar */
            obj.editor._processing(false);
        });
    };

    QuadEvents.prototype.deleteOrderByHandler = function (e, instanceName, el) {
        var obj = this;
        var entry = $(".deleteOrderBy").index(e.currentTarget);
        if (obj["qFilters"]) {
            delete obj["qFilters"][$(e.currentTarget).attr("name")];
        }
        if (obj.sortInfo) {
            obj.sortInfo.splice(entry, 1);
        }

        if (obj["sortInfo"].length === 0) {
            delete obj.sortInfo;

            delete localStorage[instanceName + "_sortInfo"];
            if (obj["sFilters"]) {
                obj.resetData();

                obj.filtersToWhereClause();
            }
            $("#sortModal").modal("toggle");
            if (obj instanceof QuadForm) {
                obj.refreshCustomOrderData($(obj.formId));
            } else {
                obj.retrieveDisplayData(obj["dtCallback"]);
            }
        }
        obj.removeSortElement(el);

        obj.listOrderOptions(e);

        obj.orderButtonHighligth();
    };

    QuadEvents.prototype.orderByChangeHandler = function (e, instanceName, el) {
        var obj = this;
        obj.sortInfo = obj.sortInfo || [];
        if (!localStorage.getItem(instanceName + "_sortInfo")) {
            localStorage.setItem(instanceName + "_sortInfo", "");
        } else {
            localStorage.setItem(
                    instanceName + "_sortInfo",
                    JSON.stringify(obj.sortInfo)
                    );
        }

        obj.appendSortField(el);

        obj.displaySortOptionsType(el, e.currentTarget);

        obj.nextSortVisible(el);

        localStorage.setItem(
                instanceName + "_sortInfo",
                JSON.stringify(obj.sortInfo)
                );
        obj.orderButtonHighligth();
    };

    QuadEvents.prototype.advancedSearchHandler = function (e) {
        var obj = this;
        var xtFormData = obj.getFiltersFormsData();

        if (!obj.checkMandatoryFilters(xtFormData)) {
            return false;
        }
        /* PMA EXTERNAL FILTER :: Filtros externos ao QuadTable e/ou QuadForms que permitam interação com estes componentes */
        var skipEditor = e.currentTarget["className"].indexOf("editorOff"); //.target.hasClass('editorOff'));
        obj.resetData(true);
        var frm = $("#" + obj.tableId + "_editorForm");

        if (skipEditor < 0) {
            obj.operation = "SELECT";
            obj.startIn = 0;
            obj.initState = false;
            /* Abrimos o EDITOR em modo create, ou seja, sem dados */
            obj.editor.create({
                title: JS_ADVANCE_SEARCH_TITLE, //PMA
                buttons: [
                    {
                        label: JS_CANCEL, //PMA
                        className: 'waves-effect waves-themed',
                        fn: function () {
                            this.close();
                        }
                    },
                    {
                        label: JS_EXECUTE,
                        className: 'waves-effect waves-themed',
                    }
                    //"Query" /* A alterar: $("button:contains('Query')") PARA $("button:contains('" + JS_EXECUTE + "')") */
                ],
                //!important , defenimos uma pseudo nova action para o editor pois este só disponibiliza edit e create
                //##query
                action: "query"
            });
            var el, o;
            /* Carregamos os valores nas listas complexas nível 1 */
            _.forEach(obj.tableCols, function (o, key) {
                el = $("#" + obj.tableId + "_editorForm" + ' [name="' + o.name + '"]');
                if (el.attr("disabled")) {
                    el.prop("disabled", 0);
                    el.removeClass("forbidden");
                }
                /* se for uma lista complexa criamos options  com os dados*/
                if (_.has(o, "complexList")) {
                    if (o.attr["dependent-level"] && o.attr["dependent-level"] == 1) {
                        obj.fillComplexList(
                                o,
                                $("#" + obj.tableId + "_editorForm"),
                                null,
                                null,
                                obj.editor.s.action
                                );
                    }
                }
                /* Não queremos na pesquisa, que os valores por defeito sejam preenchidos*/
                if (o.def) {
                    el.val("");
                }
            });

            //PMA: 2018.10.10 :: Escondemos os Hints de multi-values (que não sei como passaram a aparecer.P.ex: gd_modelo_definition.php -> Model -> Adv. Qry)
            //understand cause and fixed in commit
            /*$('.well.multi-value', frm).hide('fast');
             $('.well.multi-restore', frm).hide('fast');*/
            //escondemos os uploads quando em modo de pesquisa
            $(".upload", frm).hide("slow");
            //não validamos o form quando em modo de pesquisa
            $(frm).prop("novalidate", "novalidate");
            //limpamos os erros se estes persistirem , pois o editor na sua génese não o faz...
            frm.find(".editorErrorContainer").remove();
            /* PMA:ERROR HANDLING: Removes ERROR ROW if exists */
            /* Carregamos os valores das listas DOMAIN */
            obj.populateDomainLists(frm, "query");
            //não queremos datepicker e dattimepickers no modo pesquisa

            if (obj.editor.s.action === "query") {
                $(".datepicker,.dateTimePicker,.dateTimePickerShort").change(function () {
                    $(this).data("previous", $(this).val());
                });
            }
            /* Evento de execução de Query Avançada no Editor */
            obj.getAdvancedSearchData();
            if (xtFormData) {

     obj.syncFiltersAndForm(
                        obj.externalFilter.template.selector,
                        "#" + obj.tableId + "_editorForm"
                        );

            }
        } else {
            /* Gestão dos Filros externos */
            obj.filtroExterno();
        }
    };

    QuadEvents.prototype.newRecordHandler = function (el) {
        var obj = this;
        //limpamos alertas, othervalues e mudamos operation para insert
        obj.operation = "INSERT";
        delete obj["otherValues"];

        //ao criarmos um registos, se os filtros mandatórios não estiverem todos preenchidos, alertamos o utilizador e flag=0
        if (obj.externalFilter) {
            if (!obj.manageFiltersData()) {
                return;
            }
        }

        if (obj.inlineOp && obj.inlineOp.create) {
            //var r = obj.tbl.rows(0).nodes()[0];
            var data = $.extend({}, obj.tbl.rows(0).data()[0]);
            for (var key in data[0]) {
                if (data[0].hasOwnProperty(key)) {
                    data[0][key] = null;
                }
            }
            data["DT_RowId"] = "newRow";
            obj.tbl.row.add(data);
            var r = obj.tbl.row("#" + data["DT_RowId"]).node();

            obj.inlineCreate(
                    obj.editorXt ? obj.convertToDTRowData(obj.dbColumns) : data,
                    r,
                    el,
                    "create"
                    );
            $(this).removeClass("fa-spin");
            return;
        }
        /* Abrimos editor se a flag!=0 . significa que os filtros mandatórios estão preenchidos */

        obj.editor.create({
            title: JS_CREATE_RECORD_TITLE, //PMA
            buttons: [
                {
                    label: JS_CANCEL, //PMA
                    className: 'waves-effect waves-themed',
                    fn: function () {
                        this.close();
                    }
                },
                {
                    label: JS_CREATE, //PMA
                    className: 'waves-effect waves-themed',
                    fn: function () {
                        this.submit();
                    }
                }
//        {
//            label: JS_CANCEL, //PMA
//            fn: function() {
//              this.close();
//            }
//        },
//        JS_CREATE //PMA
            ],
            rowData:
                    obj.tbl.rows({selected: true}).indexes().length === 0
                    ? data
                    : obj.tbl.rows({selected : true}).data(),
            cloneData:
                    obj.tbl.rows({selected: true}).indexes().length === 0 ? false : true
        });
    };

    QuadEvents.prototype.editRecordHandler = function (el) {
        var obj = this;
        /*
         * Alterado por PMA, 2019.02.21: usando o API se a ROWjá estivesse selecionada, havendo uma instância detail QUADFORMS os seus botões de operações eram escondidos, como se tivesse havido um "deselect".
         * Alteramos para uma sinalização só ao nível do CSS, só a row não tiver sido selecionada. Visualmente o efeito é o mesmo que o provocado pela API, mas sem as suas consequências...
         */
        // obj.tbl.row($(this).closest('tr')).select(); //Select CURRRENT ROW
        obj.tbl.rows().deselect();
        /* $(this)
         .closest("tr")
         .addClass("selected");*/

        obj.operation = "UPDATE";
        var rowData = obj.tbl.row(el.closest("tr")).data();
        if (obj.inlineOp && obj.inlineOp.edit) {
            //loadScript("inlineEditor.js");
            var r = obj.tbl.rows(el.closest("tr")).nodes()[0];
            obj.inlineEdit(rowData, r, el, el.next(".tblDelBut"), "edit");
            el.removeClass("fa-spin");
            return;
        }
        if (obj.tbl.row(el.closest("tr")).child.isShown()) {
            $("#" + el.closest("tr").prop("id") + " > td:nth-child(1)").trigger(
                    "click"
                    );
        }
        /* MUITO importante. Defenimos o tipo de operação. Temos que fazer isto para o controlador fazer a distinção pois a OPERATION vai no request */
        /* Abrimos editor em modo EDIT e enviamos RowData para termos disponivel no evento open do editor*/

        obj.editor.edit(el.closest("tr"), {
            title: JS_UPDATE_RECORD_TITLE,
            submit: "allIfChanged",
            buttons: [
                {
                    label: JS_CANCEL,
                    className: 'waves-effect waves-themed',
                    fn: function () {
                        this.close();
                    }
                },
                {
                    label: JS_SAVE,
                    className: 'waves-effect waves-themed',
                    fn: function () {
                        this.submit();
                    }
                }
            ],
            //##rowdt
            rowData: rowData
        });
        $("#" + obj.tableId + "_editorForm")
                .find(".editorErrorContainer")
                .remove();
        /* PMA:ERROR HANDLING: Removes ERROR ROW if exists */
        if (quadConfig.env === "prod") {
            obj.hideDisableKeyFields();
        }
        obj.tbl.rows(el.closest("tr")).select();
    };

    QuadEvents.prototype.clientSideOrderHandler = function () {
        var obj = this;
        var sorting = "";
        if ($(this).hasClass("sorting_desc")) {
            $(this).addClass("sorting_asc");
            $(this).removeClass("sorting_desc");
            sorting = "asc";
        } else {
            $(this).removeClass("sorting_asc");
            $(this).addClass("sorting_desc");
            sorting = "desc";
        }
        var dtData = e.data.tbl
                .rows()
                .data()
                .toArray();
        //_.sortBy(dtData, 'CD_DEPT');
        var o = _.find(obj.tableCols, {title: $(this).text()});
        dtData = _.sortByOrder(dtData, [o.data], [sorting]);
        //e.data.tbl.data(dtData);
        e.data.clearTable();
        //e.data.tbl.clear();
        //e.data.tbl.data(dtData);
        var newData = {};
        newData["data"] = dtData;
        newData = e.data.fixData(newData);
        e.data["dtCallback"](newData);
    };

    QuadEvents.prototype.selectRecordHandler = function (e, type, indexes) {
        var obj = this;

        if (obj.cloneData) {
            $("#" + obj.tableId + "_wrapper th:last-child")
                    .find(".tblCreateBut")
                    .addClass("btn-warning");
        } else {
            $("#" + obj.tableId + "_wrapper th:last-child")
                    .find(".tblCreateBut")
                    .removeClass("btn-warning");
        }
        if ($("#editRForm,#newRForm").length > 0) {
            obj.tbl.row(indexes).deselect();
            return;
        }
        /* RESET da operação para o default SELECT */
        obj.operation = "SELECT";
        /* Prevenimos a propagação do evento para as outras rows */
        e.stopImmediatePropagation();
        e.stopPropagation();
        if (type === "row") {
            /* Capturamos os dados da row seleccionada */
            var dataCopy = obj.tbl.row(indexes).data();
            //geramos o id da row para identificarmos através do ID da <tr>
            var composedId = obj.composeId(obj.pk.primary, dataCopy);
            $(".select-info", "#" + obj.tableId + "_info").append(
                    '<span class="goEye" title="Go to record"><i data-rowId="' +
                    composedId +
                    '" class="far fa-eye fa-2x"></i></span>'
                    );
            /*guardamos uma row com todos os dados em data, pois ao dataCopy vão ser retirados todos os dados que não pertençam á chave
             para corrigir um bug descrito a seguir. Neste momento o data não será utilizado mas fica cá por segurança.*/
            //var data = {};

            //$.extend(data, dataCopy);
            obj.setCurrentRecord(dataCopy);
            if (obj.detailsObjects) {
                /* obj.resetData(); */
                /* !!IMPORTANT Clean all in datacopy that dont exist in pk...keep only pk to avoid DT_NASCIMENTO problem(columns with same name in dependent object)
                 * a instrução seguinte previne problemas que foram dificies de fazer debug. Por exemplo, colunas com mesmo nome no master e no detail.
                 */

                /* Master / Detail */
                _.forEach(obj.detailsObjects, function (o, key) {
                    /* Se details for um QuadTable */

                    if (window[o] instanceof QuadTable) {
                        /* Datatable está inicializado? */
                        if ($.fn.DataTable.isDataTable("#" + window[o].tableId)) {
                            /* Está inicializado e está dentro de uma tab com as classes defenidas no config? */
                            if (window[o].instanceVisible($("#" + window[o].tableId))) {
                                /* Normalizamos dados da row do master , se ainda não estiverem normalizadas*/
                                /* Reiniciamos os dados e as relações */

                                window[o].resetData();
                                /*window[o].setDML(
                                 window[o].normalizeData(
                                 window[o].convertToDTRowData(window[o].dbColumns)
                                 ),
                                 "query",
                                 window[o]["sortInfo"] ? true : false
                                 );*/
                                window[o].initState = false;
                                window[o].operation = "SELECT";

                                window[o].tbl
                                        .columns()
                                        .search()
                                        .draw();
                                /* data to search is allready set in setDML(data) */
                                if (window[o].editorXt) {
                                    $(window[o].externalFilter.template.selector)[0].reset();
                                }
                            }
                        } else {
                            /* Datatables não está inicializado neste QuadTable, então fazemos initDetails() precedido
                             * das operações de preparação dos dados a serem enviados para o servidor.
                             */
                            if (window[o].instanceVisible($("#" + window[o].tableId))) {
                                // preparamos os dados para o initdetails() fazer o primeiro carregamento de dados e filtrados pela chave constante no master
                                window[o].initState = false;
                                window[o].resetData();

                                //window[o].setDML();
                                window[o].initDetails();
                            }
                        }
                    }
                    /* Se details for um QuadForm */
                    if (window[o] instanceof QuadForm) {
                        if (
                                window[o].instanceVisible($(window[o].formId)) ||
                                window[o].myData
                                ) {
                            /* Reiniciamos os dados */
                            window[o].clearForm(window[o].formId);
                            window[o].myData = [];
                            window[o].totalRecords = "";
                            /* Normalizamos */
                            /* Preparamos as relações e as dbColumns */
                            window[o].resetData();
                            //window[o].setDML();
                            window[o].operation = "SELECT";
                             setTimeout(function() {
                               window[o].retrieveDisplayData(window[o].formId);
                                 var masterData =
                                     obj instanceof QuadForm
                                         ? obj.myData["data"][window[o].currentRecord]
                                         : obj.tbl.row(indexes).data();

                                 window[o].checkInactive(masterData, obj);
                             }, 1000);



                        }
                    }
                });
            }
        }
    };

    QuadEvents.prototype.scrollHandler = function () {
        var obj = this;
        var el = $("#" + obj.tableId + "_wrapper").find(".dataTables_scrollBody");
        obj.position = el.scrollTop();
        el.scroll(function () {
            var scroll = $(this).scrollTop();
            if (scroll > obj.position) {
                if (
                        $(this).scrollTop() + $(this).innerHeight() >=
                        //$(this)[0].scrollHeight - 10
                        $(this)[0].scrollHeight
                        ) {
                    // -10 como Tolerância na renderização no WINDOWS
                    /* Incrementa-se o valor do LIMIT com o valor do recordBundle
                     * se o numero de registos na tabela for menor que o total de registos faz request e acrescenta os dados á tabela
                     */
                    if (obj.tbl.data().count() < parseInt(obj.totalRecords)) {
                        if ($("#newRow", "#" + obj.tableId)) {
                            $("th > .tblCancel", "#" + obj.tableId + "_wrapper").trigger(
                                    "click"
                                    );
                        }
                        if ($("#editRForm", document)) {
                            $(".tblCancel", "#editRForm").trigger("click");
                        }
                        obj.startIn += obj.recordBundle;
                        obj.operation = "SELECT";
                        $.when(obj.getData(false)).then(function (dat) {
                            var dat = JSON.parse(dat);
                            if (obj.checkError(dat, $("#" + obj.tableId + "_editorForm"))) {
                                return;
                            }
                            var recordSet = obj.fixData(dat);
                            _.map(recordSet.data, function (o, key) {
                                obj.tbl.row.add(o);
                                var rowNode = obj.tbl.row("#" + o["DT_RowId"]).node();
                                $("#" + obj.tableId).append(rowNode);
                                obj["rowCallback"]
                                        ? obj["rowCallback"].apply(obj.tbl.settings()[0].oInstance, [
                                    rowNode,
                                    o,
                                    obj.tbl.rows().count()
                                ])
                                        : void 0;
                            });
                            obj.showCountInfo();
                            obj.acl("#" + obj.tableId + "_editorForm");
                            $("#" + obj.tableId)
                                    .DataTable()
                                    .columns.adjust()
                                    .responsive.recalc();
                            $(window).trigger("resize");
                        });
                    }
                }
            }
            obj.position = scroll;
        });
    };

    QuadEvents.prototype.tableRefreshHandler = function () {
        var obj = this;
        obj.resetData(true);
        delete obj.wkf;

        obj.startIn = 0;
        obj.operation = "SELECT";
        obj.recursiveReset(obj);
        $("." + obj.tableId + "_spinner").show("slow");
        if (obj.editorXt) {
            /*
             Se houver filtros exteriores, ao fazer o refresh, mostramos as colunas que poderiam estar escondidads pelos filtros
             e reinicializamos os campos do form com os filtros
             */
            var column, col;

            if (obj.externalFilter.template) {
                $(obj.externalFilter.template.selector)[0].reset();
                obj.resetLists(
                        $(obj.externalFilter.template.selector),
                        $(obj.externalFilter.template.selector).find("[dependent-level=1]")
                        );
            }

            if (
                    obj.externalFilter &&
                    obj.externalFilter.template &&
                    obj.externalFilter.template.mandatory &&
                    obj.externalFilter.template.mandatory.length > 0
                    ) {
                _.forEach(obj.externalFilter.template.mandatory, function (name) {
                    col = _.find(obj.tbl.settings()[0].aoColumns, {data: name});
                    column = obj.tbl.column(col.idx);
                    column.visible(true);
                });
            }
        }
        $.each(obj.tableCols, function (i, field) {
            //fazemos os requests dos domains
            if (
                    field.attr &&
                    field.attr["dependent-group"] &&
                    field.attr["domain-list"]
                    ) {
                var result = _.find(obj.tableCols, {
                    attr: {
                        "domain-list": true,
                        "dependent-group": field.attr["dependent-group"]
                    }
                });
                if (result && result.targets < field.targets) {
                    return;
                } else {
                    obj.compileDomainRequests(field.attr);
                }
            }
            //Compilamos os requests a fazer para trazer novamente as listas complexas
            if (field.complexList) {
                var result = _.find(obj.tableCols, {
                    attr: {"data-db-name": field.attr["data-db-name"]}
                });
                if (result && result.targets < field.targets) {
                } else {
                    obj.compileRequests(field, true, null, null);
                }
            }
        });
        if (
                obj.domainRequests !== undefined &&
                Object.keys(obj.domainRequests).length > 0
                ) {
            obj.loadDomains(true);
        }
        //pedido das listas
        if (Object.keys(obj.requests).length > 0) {
            $.when(obj.getListsData(true, null, null, true))
                    .then(function (strData) {
                        if (strData && JSON.parse(strData)) {
                            /*guardamos o resultado para os indices correspondentes e
                             "reabrimos" o form dos filtros exteriores para que sejam preenchidos valores por defeito e registados eventos, etc...
                             */
                            obj.mapListRequest(
                                    strData,
                                    obj.tableCols,
                                    null,
                                    $("#" + obj.tableId + "_editorForm")
                                    );
                            if (obj.externalFilter && obj.externalFilter.template) {
                                obj.editorXt.open();
                            }
                            setTimeout(function () {
                                $("." + obj.tableId + "_spinner").hide("slow");
                            }, 1);
                        }
                    })
                    .then(function () {
                        /*
                         fazemos uma reinicialização da tabela e um request de dados que será feito se os campos mandatórios estiverem
                         preenchidos ex: request é bem sucedido se houver um campo mandatory EMPRESA e tiver um valor DEF
                         */
                        /* obj.tbl.rows().deselect();
                         obj.clearTable();
                         obj.resetData(true);
                         $("." + obj.tableId + "_sFilters").empty();*/
                        obj.resetTableInstance();
                        if (obj.sFilters) {
                            obj.resetExternalFilters();
                        }
                        setTimeout(function () {
                            obj.tbl
                                    .columns()
                                    .search()
                                    .draw();

                        }, 100);
                    });
        } else {
            if (obj.sFilters) {
                obj.resetExternalFilters();
            }

            setTimeout(function () {
                obj.tbl
                        .columns()
                        .search()
                        .draw();
            }, 100);
        }

    };

    QuadEvents.prototype.registerTableEvents = function () {
        var obj = this;
        $(document).on(
                "click",
                "table.table-responsive > tbody tr > td:first-child",
                function (evt) {
                    var instance_name = $(this)
                            .closest("table")
                            .attr("id");
                    $("#" + instance_name)
                            .DataTable()
                            .columns.adjust()
                            .responsive.recalc();
                    $(window).trigger("resize");
                }
        );
        /* EVENTO click na pesquisa avançada */
        $("#" + obj.tableId + "_dtAdvancedSearch").on("click", function (e) {
            //$(this).addClass("fa-spin");
            e.preventDefault();
            obj.advancedSearchHandler(e);
            //$(this).removeClass("fa-spin");
        });
        /* EVENTO para APAGAR registos */
        $("#" + obj.tableId).on("click", ".tblDelBut", function (e) {
            e.stopPropagation();
            e.stopImmediatePropagation();
            //$(this).addClass("fa-spin");
            /* Registo a remover */
            var data = obj.tbl.row($(this).closest("tr")).data();
            if (typeof obj.onDelete == "function") {
                obj.onDelete(data);
            } else {
                /* Método para remover registo */

                obj.removeRow(data);
                obj.operation = "SELECT";
                /* PMA:: Deseleciona o registo a eliminar, efetuando assim o refresh dos eventuais blocos de detail */
                obj.tbl.rows().deselect();
            }
            //console.log(obj.detailsObjects);
            $(this).removeClass("fa-spin");
            //PMA, 2019.11.21 : RECALC FOOTER
            if (obj.footerCallback) {
                obj.footerCallback();
            }
        });
        /* EVENTO para CRIAR registos */
        $("#" + obj.tableId + "," + "#" + obj.tableId + "_wrapper").on(
                "click",
                ".tblCreateBut",
                function (e) {
                    e.stopImmediatePropagation();
                    e.stopPropagation();

                    obj.newRecordHandler($(this));
                }
        );
        /* EVENTO para EDITAR registos */
        $("#" + obj.tableId).on("click", ".tblEditBut", function (e) {
            e.stopPropagation();
            e.stopImmediatePropagation();
            obj.editRecordHandler($(this));
        });
        obj.tbl.on("column-reorder", function (e, settings, details) {
            localStorage.setItem(
                    obj.tableId + "_columnReorder",
                    obj.tbl.colReorder.order()
                    );
            var headerCell = $(obj.tbl.column(details.to).header());
            headerCell.addClass("reordered");
            setTimeout(function () {
                headerCell.removeClass("reordered");
                $(window).trigger("resize");
            }, 2000);
        });
        //evento de double click numa row despoleta o edit, o mesmo que clickar no botão de edição
        $("#" + obj.tableId + " tbody").on("dblclick", "tr", function (e) {
            e.stopPropagation();
            $($(this).find(".tblEditBut")).trigger("click");
        });

        $(
                $("#" + obj.tableId)
                .closest(".dataTables_scroll")
                .find("thead")[0]
                ).on("click", "th.visibleColumn.sorting", obj, function (e) {
            //Seletor do ORDER BY no Client Side :: Não está a ser usado
            e.stopImmediatePropagation();
            obj.clientSideOrderHandler(); //not used at the moment
        });
        //EVENTO de seleçcão de um registo(click numa row)
        obj.tbl.on("select", function (e, dt, type, indexes) {
            obj.tbl
                    .rows()
                    .eq(0)
                    .each(function (idx) {
                        var row = obj.tbl.row(idx);

                        if (row.child.isShown()) {
                            $(row.node())
                                    .find("td:first-child")
                                    .trigger("click");
                        }
                    });

            obj.selectRecordHandler(e, type, indexes);
        });
        /* EVENTO de DESELEÇCÃO de um registo(click numa row) */
        obj.tbl.on("deselect", function (e, dt, type, indexes) {
            //prevenimos a propagação do evento a outras rows
            e.stopImmediatePropagation();
            if (type === "row") {
                //resetamos todos os details e details de details

                obj.recursiveReset(obj);
            }
            if (obj.cloneData) {
                $("#" + obj.tableId + "_wrapper th:last-child")
                        .find(".tblCreateBut")
                        .removeClass("btn-warning");
            }
        });
        //Evento que coloca a row activa/seleccionada no campo de visão
        $(document).on(
                "click",
                "#" + obj.tableId + "_info  .select-info .fa-eye ",
                function (e) {
                    $('[id="' + $(this).data("rowid") + '"]')[0].scrollIntoView(false);
                }
        );

        /* EVENTO de SCROLL */
        obj.scrollHandler();

        /* Se a diretiva "refresh data" estiver activa */
        if (obj.refreshData !== false) {
            $("#" + obj.tableId + "_dtAdvancedSearch").before(
                    '<a id="refresh_' +
                    obj.tableId +
                    '" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed refresh"><i class="fas fa-sync"></i></a>'
                    );
            $(document).on("click", "#refresh_" + obj.tableId, function (e) {
                e.stopImmediatePropagation();
                obj.tableRefreshHandler();
            });
        }
    };

    QuadEvents.prototype.formEvents = function (_operation, frm, el) {
        var obj = this;
        var status = true;
        if (_operation === "enter-query") {
            status = obj.enterQueryFormHandler(_operation, frm, el);
        } else if (_operation === "execute-query") {
            status = obj.executeQueryFormHandler(_operation, frm, el);
        } else if (_operation === "new") {
            status = obj.newRecordFormHandler(_operation, frm, el);
        } else if (_operation === "edit") {
            status = obj.editRecordFormHandler(_operation, frm, el);
        } else if (_operation === "cancel") {
            status = obj.cancelOperationFormHandler(_operation, frm, el);
        } else if (_operation === "save") {
            status = obj.saveFormHandler(_operation, frm, el);
        } else if (_operation === "delete") {
            status = obj.deleteRecordFormHandler(_operation, frm, el);
        } else if (_operation === "previous") {
            status = obj.previousRecordHandler(_operation, frm, el);
        } else if (_operation === "next") {
            status = obj.nextRecordHandler(_operation, frm, el);
        }
        return status;
    };

    QuadEvents.prototype.enterQueryFormHandler = function (_operation, frm, el) {
        var obj = this;

        obj.clearForm(frm);
        obj.syncFiltersAndForm(frm, frm);
        if (obj.sFilters && obj.sFilters.length > 0) {
            if (obj.externalFilter && obj.externalFilter.template) {
                obj.syncFiltersAndForm(frm, obj.externalFilter.template.selector);
            }
        }

        if (obj.detailsObjects) {
            obj.detailsObjects.forEach(function (key) {
                if (window[key] instanceof QuadForm) {
                    window[key].clearForm(window[key].formId);
                    $(window[key].formId)
                            .find("a[data-form-action]")
                            .hide();
                    window[key].disableFields(window[key].formId);
                }
                if (window[key] instanceof QuadTable) {
                    window[key].clearTable();
                }
            });
        }
        obj.enableFields(frm, "query");
        obj.resetLists(frm);
        //todo fill lists and domains and sync filters and show hide fields based on filters.
    };

    QuadEvents.prototype.executeQueryFormHandler = function (_operation, frm, el) {
        var obj = this;
        obj.operation = "SELECT";
        var xtFormData = obj.getFiltersFormsData();

        if (!obj.checkMandatoryFilters(xtFormData)) {
            return false;
        }
        $("." + obj.formId.substring(1) + "_sFilters").empty();
        var rowData = $(frm).serializeAllArray();
        _.remove(rowData, {value: ""});
        _.remove(rowData, {value: null});
        if (obj.sFilters) {
            obj.filterFilters(rowData);
        } else {
            obj.sFilters = rowData;
            _.remove(obj.sFilters, {value: ""});
            _.remove(obj.sFilters, {value: null});
        }
        var o, el, elText, label;
        //valores são preenchidos no form de filtros(xtForm)

        rowData.forEach(function (d) {
            if (d.value) {
                el = $(frm).find('[name="' + d.name + '"]');
                label = $("label[for='" + d.name + "']", frm);
                //label = el.closest('label');
                $("." + obj.formId.substring(1) + "_sFilters").addClass("qryFilters");
                o = _.find(obj.dbColumns, {db: d.name.toUpperCase()});
                if (el.is("select")) {
                    elText = el.find(":selected").text();
                } else {
                    elText = d.value;
                }
                if (!obj.isExternalFilter(d.name)) {
                    obj.filterTag(d.value, d.name, label.text(), elText);
                } else {
                    var el = $(
                            "[name=" + d.name + "]",
                            obj.externalFilter.template.selector
                            );
                    el.val(d.value);
                }
            }
        });
        var arr = $("." + obj.formId.substring(1) + "_sFilters").find(
                '*[data-id="' + obj.formId.substring(1) + '"]'
                );

        if (obj.isEmptyForm($(frm)) === false) {
            obj.resetData(true);
            //use rowData here????
            var dtData = obj.normalizeData(obj.getNormalizedFrmData(frm));

            obj.prepareData(dtData);
            if (!obj["sortInfo"]) {
                dtData = obj.mapComplexLists(dtData);
                //obj.setDML(dtData, "query");
            } else {
                //se não houver 'sortInfo', não precisamos de mapear listas complexas e o ultimo parametro de setDml é passado a true
                //obj.setDML(dtData, "query", true);
            }

            obj.retrieveDisplayData(frm);
        } else {
            var requireSomeField = JS_REQUIRED_QUERY;
            if (obj.queryAll) {
                // obj.setDbData('QRYALL');
                //obj.clearForm();
                $.when(obj.getData(true)).then(function (dat) {
                    var dat = JSON.parse(dat);
                    if (obj.checkError(dat, $(obj.formId))) {
                        return;
                    }
                    dat = obj.fixData(dat);
                    obj.clearForm(frm);
                    obj.myData["data"] = [];
                    $.merge(obj.myData["data"], dat["data"]);
                    obj.currentRecord = 0;
                    obj.dataRender(frm, obj.currentRecord, null);
                    obj.masterDetail(frm);
                });
            } else {
                frm
                        .find(".quad-alert")
                        .html(requireSomeField)
                        .addClass("alert alert-warning fade in");
                obj.enableFields(frm);

                $(frm)
                        .find("a[data-form-action=edit]")
                        .hide();
            }
        }
        //Inativar campos "abertos" para o execute-query, caso não haja registos retornados pela query
        if (obj.totalRecords == 0) {
            //$(frm).find(":input").attr("disabled", "disabled");
            $(frm)
                    .find("a[data-form-action]")
                    .hide();
            $(frm)
                    .find("a[data-form-action=execute-query]")
                    .show();
            $(frm)
                    .find("a[data-form-action=cancel]")
                    .show();
        }
        if (obj.detailsObjects && obj.totalRecords > 0) {
            //obj.masterDetail(frm);
        }
    };

    QuadEvents.prototype.newRecordFormHandler = function (_operation, frm, el) {
        var obj = this;

        if (obj.workFlow) {
            obj.clearWorkFlow(frm);
        }
        if (obj.externalFilter) {
            if (!obj.manageFiltersData()) {
                var status = false;

                if (obj instanceof QuadForm) {
                    if ($(obj.formId).hasClass("quadFormInstanceWithInvertedRules")) {
                        $(obj.externalFilter.templateMulti.selector)
                                .find(".chosen-container")
                                .removeClass("error");
                        //obj.currentRecord = null;
                        status = true;
                    }
                }
                if (status === false) {
                    return false;
                }
            }
        }

        obj.clearForm(frm);
        if (obj.complexLists) {
            obj.loadComplexListsForm(frm, false, "create");
        }

        obj.populateDomainLists(frm, null);
        if (obj.detailsObjects) {
            obj.masterDetail(frm);
        }

        obj.enableFields(frm);

        frm.trigger("bindChangeEvent", ["create"]);
        if (obj.sFilters) {
            setTimeout(function () {
                obj.syncFiltersAndForm(frm, frm);
                if (obj.sFilters && obj.sFilters.length > 0) {
                    if (obj.externalFilter && obj.externalFilter.template) {
                        obj.syncFiltersAndForm(frm, obj.externalFilter.template.selector);
                    }
                }
            }, 0);
        }
        obj.hideSpinner();

        obj.loadDropzone();

        obj.uploadsCarregaIcon(frm);
        $(".docsViewer img", frm).show();
    };

    QuadEvents.prototype.editRecordFormHandler = function (_operation, frm, el) {
        var obj = this;

        if (obj.complexLists) {
            obj.loadComplexListsForm(frm, false, "edit");
        }
        obj.loadDomains(true);
        obj.dataRender(frm, obj.currentRecord, "edit");
        frm.trigger("bindChangeEvent", ["edit"]);
        $(document).trigger(obj.formId.substring(1) + "AttachEvt");
        obj.enableFields(frm);
        if (obj.workFlow && obj.workFlow["showWorkflowOnEdit"] !== true) {
            obj.clearWorkFlow(frm);
        }
    };

    QuadEvents.prototype.cancelOperationFormHandler = function (
            _operation,
            frm,
            el
            ) {
        var obj = this;
        obj.operation = "SELECT";
        obj.disableFields(frm);

        obj.setDefaultButtons(frm, obj.defaultButtons);
        $(frm)
                .validate()
                .reset();
        $(frm)
                .find("div.state-error")
                .removeClass("state-error");
        $(frm)
                .find("em.invalid")
                .remove();
        $(frm)
                .find("label.error")
                .remove();
        $(frm)
                .find(".error")
                .removeClass("error");

        obj.populateComplexLists(frm, null);
        obj.populateDomainLists(frm, null);
        if (obj.detailsObjects) {
            obj.detailsObjects.forEach(function (key) {
                var el = $(
                        window[key] instanceof QuadForm
                        ? window[key].formId
                        : "#" + window[key].tableId
                        );
                if (window[key].instanceVisible(el)) {
                    if (window[key] instanceof QuadForm) {
                        window[key].dataRender(
                                window[key].formId,
                                window[key].currentRecord,
                                null
                                );
                    }
                    if (window[key] instanceof QuadTable) {
                        window[key].tbl
                                .columns()
                                .search()
                                .draw();
                    }
                }
            });
        }

        obj.disableFields(frm);

        obj.isMultiFilteredInstance(frm);

        if ($(frm).hasClass("quadFormInstanceWithInvertedRules")) {
            if (!obj.sFilters) {
                obj.dataRender(frm, obj.sFilters ? obj.currentRecord : null, null);
                $(".docsViewer", frm)
                        .find(".apagaImg,.undo,.carrega")
                        .remove();
                $(".docsViewer", frm).removeClass("dropzone");
                return;
            }
        }
        // se existir current record senao null
        obj.dataRender(
                frm,
                obj.myData["data"][obj.currentRecord] ? obj.currentRecord : null,
                null
                );
        $(".docsViewer", frm)
                .find(".apagaImg,.undo,.carrega")
                .remove();
        $(".docsViewer", frm).removeClass("dropzone");
    };

    QuadEvents.prototype.saveFormHandler = function (_operation, frm, el) {
        var obj = this;
        obj.operation = el.attr("operation");

        //If it is an edition we have to keep the prv values, than we send a copy of dbcolumns to use as a backup and restore when need it

        var validator = $(frm).validate();
        if (validator) {
            validator.destroy();
        }
        obj.validateFrm($(frm), obj.validations);
        if (
                $(frm)
                .validate(obj.validations)
                .form()
                ) {
            if (obj.externalFilter) {
                var xtFormData = obj.getFiltersFormsData();

                var dtData = {};
                _.map(xtFormData, function (d, i) {
                    dtData[d.name] = d.value;
                });
                $.extend(dtData, obj.getNormalizedFrmData($(frm)));
            } else {
                var dtData = obj.getNormalizedFrmData($(frm));
            }

            var copyOfDbcolumns = $.extend({}, obj.dbColumns);
            dtData = obj.normalizeData(dtData);
            dtData = obj.mapComplexLists(dtData);
            dtData.data[0] = obj.emptyStringToNull(dtData.data[0]);

            if (obj.operation === "UPDATE") {
                obj.prepareData(dtData, copyOfDbcolumns);
            } else {
                obj.prepareData(dtData);
            }

            var dataValida = obj.getValidationData();
            var ok_ = true;

            if (obj.on_pre_submit) {
                var action = obj.operation === "UPDATE" ? "edit" : "create";
                $.when(obj.isValidOperation(dataValida, action)).done(function (data) {
                    try {
                        var dat = JSON.parse(data);
                        if (dat.msg === "OK") {
                            ok_ = true;
                        } else {
                            //PMA:ERROR HANDLING: Create ROW to display DB error
                            if ($(obj.formId).length) {
                                $(".editorErrorContainer").remove();
                                $("#" + obj.tableId + "_editorForm")
                                        .append(
                                                '<div class="editorErrorContainer"><div class="editorError">' +
                                                dat.error +
                                                "</div></div>"
                                                )
                                        .css("display", "block");
                                $(".editorErrorContainer")
                                        .get(0)
                                        .scrollIntoView();
                                ok_ = false;
                                return false;
                            }
                        }
                    } catch (e) {
                        console.log("QUAD-VALIDATOR:", e);
                    }
                });
            }

            if (ok_) {
                $.when(obj.executeDml(obj.operation)).then(function (dat) {
                    //IMPORTANT DO 'NOTHING' an return
                    var dat = JSON.parse(dat);
                    if (obj.checkError(dat, frm, true)) {
                        return;
                    }
                    //se for uma resposta status ok ou msg ok quer dizer que nao devolvido o registo e apenas se deve notificar o user acerca do workflow
                    if (
                            (dat.status || dat.msg) &&
                            (dat.status === "ok" || dat.msg === "ok")
                            ) {
                        if (obj.workFlow && obj.workFlow.mode === "postponed") {
                            obj.notifyPostponedWorkflowToUser(dat);

                            obj.disableFields(frm);

                            return;
                        }
                    } else {
                        dat = obj.normalizeData(dat);
                        dat = obj.fixData(dat);
                    }

                    dat = obj.fixData(dat);
                    obj.prepareData(dat);
                    obj.prepareData(dat, obj.dbColumns);
                    obj.resetButtonsState(frm, obj.totalRecords, obj.currentRecord);
                    if (obj.operation === "INSERT") {
                        ++obj.totalRecords;
                        obj.myData["data"].splice(obj.currentRecord, 0, dat["data"][0]);
                        if ($(obj.formId).hasClass("quadFormInstanceWithInvertedRules")) {
                            //acrescentar novo id ao filtro com evento
                            $("a[data-form-action=save]", obj.formId).trigger("updateFilter");
                            obj["wkf"] = [];
                            obj.clearWorkFlow(obj.formId);

                            obj.instanceUpToDate();
                            return;
                        }
                        obj.dataRender(frm, obj.currentRecord, null);
                    } else if (obj.operation === "UPDATE") {
                        obj.myData["data"][obj.currentRecord] = dat["data"][0];
                        obj.dataRender(frm, obj.currentRecord, null);
                    }

                    if (obj.detailsObjects && obj.totalRecords > 0) {
                        obj.masterDetail(frm);
                    }
                    obj.operation = "SELECT";
                });
            }
        } else {
            return;
        }
    };

    QuadEvents.prototype.deleteRecordFormHandler = function (_operation, frm, el) {
        var obj = this;

        initApp.playSound(myapp_config.assetsUrl + "/media/sound", "messagebox"),
                "undefined" != typeof bootbox
                ? bootbox.confirm({
                    title: '<i class="fa fa-exclamation-triangle" style="color:#DF8505;"></i>!',
                    message: JS_DELETE_CONFIRMATION,
                    centerVertical: !0,
                    swapButtonOrder: !0,
                    buttons: {
                        confirm: {label: JS_YES, className: "btn-danger"},
                        cancel: {label: JS_NO, className: "btn-default"}},
                    className: "modal-alert",
                    closeButton: !1,
                    callback: function (t) {
                        // YES
                        if (t) {
                            var ok_ = true;
                            if (obj.on_pre_submit) {
                                $.when(
                                        obj.isValidOperation(
                                                obj.myData["data"][obj.currentRecord],
                                                "delete"
                                                )
                                        ).then(function (data) {
                                    try {
                                        ok_ = obj.deleteRecordResponse(data, ok_);
                                    } catch (e) {
                                        console.log("QUAD-VALIDATOR on DELETE:", e);
                                    }
                                });
                            }
                            if (ok_) {
                                // YES, delete record!
                                $(frm)
                                        .find("a[data-form-action]")
                                        .removeAttr("disabled");
                                $.when(obj.executeDml(_operation)).then(function (dat) {
                                    try {
                                        JSON.parse(dat);
                                    } catch (e) {
                                        if (obj.workFlow && obj.workFlow.mode === "postponed") {
                                            obj.notifyPostponedWorkflowToUser();
                                        }
                                        return false;
                                    }

                                    dat = JSON.parse(dat);
                                    if (dat.error) {
                                        //PMA:ERROR HANDLING: Create ROW to display DB error
                                        quad_notification({
                                            type: "error",
                                            title: JS_OPERATION_ERROR,
                                            content: dat.error
                                        });
                                    }
                                    if (obj.workFlow && obj.workFlow.mode === "postponed") {
                                        obj.notifyPostponedWorkflowToUser(dat);
                                    }
                                    if (dat.status && dat.status == "deleted") {
                                        if (dat.workflow) {
                                            obj.resetButtonsState(frm, obj.totalRecords, obj.currentRecord);
                                            $("a[data-form-action=edit]", frm).attr("disabled", true);
                                        } else {
                                            obj.removeFormRecord(frm);
                                        }
                                    }
                                });
                                //obj.clearForm();
                                obj.disableFields(frm);
                                if (obj.currentRecord < obj.totalRecords) {
                                    obj.workMode(frm, "next");
                                } else if (obj.currentRecord == obj.totalRecords) {
                                    obj.workMode(frm, "previous");
                                }
                            }
                        }
                        // NO
                        //Operação foi cancelada
                        if (!t) {
                            // NO, record stays!
                            quad_notification({
                                type: "info",
                                title: JS_OPERATION_ABORT,
                                content:
                                        '<i class="fa fa-clock-o"></i> <i>' +
                                        JS_RECORD_NOT_DELETED +
                                        "</i>",
                                timeout: 1500
                            });
                            obj.dataRender(obj.formId, obj.currentRecord, null);
                        }
                    }
                })
                : confirm(JS_OPERATION_CONFIRMATION);
    };

    QuadEvents.prototype.previousRecordHandler = function (_operation, frm, el) {
        var obj = this;

        obj.operation = "SELECT";
        var prevRecord = parseInt(obj.currentRecord) - 1;

        obj.currentRecord = prevRecord;

        $("a[data-form-action=previous],a[data-form-action=next]", obj.formId).attr(
                "disabled",
                true
                );
        $("a[data-form-action=previous],a[data-form-action=next]", obj.formId).off(
                "click"
                );
        obj.dataRender(frm, obj.currentRecord, null);

        obj.masterDetail(frm);
        obj.navigate("previous", frm, el);
        obj.instanceUpToDate();
    };

    QuadEvents.prototype.nextRecordHandler = function (_operation, frm, el) {
        var obj = this;
        obj.operation = "SELECT";
        var nxtRecord;
        nxtRecord = parseInt(obj.currentRecord) + 1;
        obj.currentRecord = nxtRecord;

        $("a[data-form-action=previous],a[data-form-action=next]", obj.formId).attr(
                "disabled",
                true
                );
        $("a[data-form-action=previous],a[data-form-action=next]", obj.formId).off(
                "click"
                );
        if (
                obj.currentRecord == obj.myData["data"].length &&
                obj.totalRecords > obj.currentRecord &&
                obj.recordBundle
                ) {
            $.when(obj.getData(false, obj.currentRecord, obj.recordBundle, false)).then(
                    function (dat) {
                        var dat = JSON.parse(dat);
                        if (obj.checkError(dat, $(obj.formId))) {
                            return;
                        }
                        dat = obj.fixData(dat);
                        $.merge(obj.myData["data"], dat["data"]);

                        obj.dataRender(frm, nxtRecord, null);
                        if (obj.detailsObjects && obj.totalRecords > 0) {
                            obj.masterDetail(frm);
                        }
                    }
            );
        } else {
            if (nxtRecord > parseInt(obj.totalRecords) - 1) {
                nxtRecord = parseInt(obj.totalRecords) - 1;
            }
            obj.dataRender(frm, nxtRecord, null);
            obj.masterDetail(frm);
            obj.instanceUpToDate();
        }
        obj.navigate("next", frm, el);
    };
