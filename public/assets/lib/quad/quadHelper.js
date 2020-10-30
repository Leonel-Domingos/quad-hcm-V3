    $(document).ready(function () {
        window["userAllowedCrud"] = window["userAllowedCrud"] || new Array();
        $(document).on("init.dt", function (e, settings) {
            var obj = window[settings.nTable.id];
            if (obj.syncTimer) {
                obj.syncTable();
            }
        });
        $(document).on("preInit.dt", function (e, settings) {
            var obj = window[settings.nTable.id];
            obj.spinner =
                    "<img class='" +
                    obj.tableId +
                    "_spinner tableSpinner' src='"+ pn + quadConfig.loading_img + "'>";
            $("#" + obj.tableId + "_wrapper").prepend($(obj.spinner));
            $("#" + obj.tableId + "_wrapper").prepend(
                    '<ul class="list-inline ' + obj.tableId + '_sFilters"></ul>'
                    );
            obj.hideSpinner();
            obj.requests = {};
            var cols = settings.aoColumns;
            $.each(cols, function (i, field) {
                if (
                        field.attr &&
                        field.attr["dependent-group"] &&
                        field.attr["domain-list"]
                        ) {
                    obj.compileDomainRequests(field.attr);
                }

                if (field.complexList) {
                    obj.compileRequests(field, null, null);
                }
            });

            if (obj.domainRequests !== undefined) {
                obj.loadDomains(false);
            }

            if (Object.keys(obj.requests).length > 0) {
                $.when(obj.getListsData(true))
                        .then(function (strData) {
                            if (strData && JSON.parse(strData)) {
                                obj.mapListRequest(
                                        strData,
                                        obj.tableCols,
                                        null,
                                        $("#" + obj.tableId + "_editorForm")
                                        );
                            }
                        })
                        .then(function () {
                            obj.tableFirstPaint(settings);
                        });
            } else {
                setTimeout(function () {
                    obj.tableFirstPaint(settings);
                }, 1000);
            }
        });

        // PTE: 2020.10.13 - em certos interfaces (recibo lógico) é necessário um timeout para ativar o trigger on do tab, caso contrário o evento não é registado
setTimeout(function(){
        //TAB CHANGE EVENT
        $(document).on("shown.bs.tab", 'a[data-toggle="tab"]', function (e) {
            
            var container = $(this).attr("href"); //Master tab-pane (top tab)
            $(".dataTables_scrollBody").css("width", "100%");
            var tableInstances = $.fn.dataTable.tables({api: true});
            var tables = $(container)
                    .find("table")
                    .filter(function (index) {
                        //if ($(this).attr('id') && $(this).css('visibility') !== 'hidden') { //ORIGINAL LINE
                        if ($(this).attr("id") && $(this).is(":visible")) {
                            return this.id;
                        }
                    });
            _.map(tables, function (table, index) {
                var obj = window[table.id];
                if (
                        _.find(tableInstances.context, {sTableId: table.id}) &&
                        $.fn.DataTable.isDataTable("#" + table.id)
                        ) {
                    /*obj.tbl.destroy();
                     window[table.id].initTable($.extend({}, datatable_instance_defaults, window[table.id]['parms']));*/
                    try {
                        obj.tbl.responsive.recalc();
                    } catch (e) {
                        console.log("erro",e);
                    }

                    $("#" + obj.tableId)
                            .DataTable()
                            .columns.adjust()
                            .responsive.recalc();
                    if (obj.detailsObjects) {
                    }
                    if (obj.dependsOn) {
                        setTimeout(function () {
                            if (obj.tbl.data().count() === 0) {
                                // $("." + table.id + "_spinner").show();
                                obj.resetData();
                                obj.tbl
                                        .columns()
                                        .search()
                                        .draw();
                            }
                        }, 0);
                    }
                } else {
                    try {
                        obj.quadPrep(); //PMA extention
                    } catch (e) {
                        null;
                    }
                    setTimeout(function () {
                        if (obj instanceof QuadTable) {
                            if (obj.dependsOn) {
                                var childTab = $("#" + obj.tableId).closest(".tab-pane");
                                if (obj.instanceVisible($("#" + obj.tableId), childTab)) {
                                    obj.initDetails();
                                }
                            } else if (obj.detailsObjects) {
                                obj.addTableEvents();
                                obj.addEditorEvents();
                            } else {
                                obj.addTableEvents();
                                obj.addEditorEvents();
                            }

                            $("#" + obj.tableId)
                                    .DataTable()
                                    .columns.adjust()
                                    .responsive.recalc();
                        }
                    }, 0);
                }
            });
            var forms = $(container)
                    .find("form")
                    .filter(function (index) {
                        if ($(this).attr("id")) {
                            return this.id;
                        }
                    });
            _.map(forms, function (form, index) {
                var frm = form.id;
                var obj = window[frm];
                if (obj instanceof QuadForm) {
                    var childTab = $("#" + obj.tableId).closest(".tab-pane");
                    if (obj.instanceVisible($(obj.formId), childTab)) {
                        setTimeout(function () {
                            if (
                                    obj.myData &&
                                    (!obj.myData["data"] || obj.myData["data"].length === 0)
                                    ) {
                                obj.loadForm(obj.formId);
                            }
                        }, 0);
                    }
                }
            });
        });
},2000);

        $.validator.addMethod("notEqualToField", function (value, element, param) {
            var target = $(quadConfig.editorIdsNameSpace + param);
            if (value) {
                return value != target.val();
            } else {
                return this.optional(element);
            }
        });
        $.validator.addMethod("datePreviousThan", function (value, element, param) {
            var target = $("[name=" + param + "]");
            var x = new Date(value);
            var y = new Date(target.val());
            return this.optional(element) || +x < +y;
        });
        $.validator.addMethod("dateNextThan", function (value, element, param) {
            var target = $("[name=" + param + "]");
            var x = new Date(value);
            var y = new Date(target.val());
            return this.optional(element) || +x > +y;
        });
        $.validator.addMethod("dateEqOrNextThan", function (value, element, param) {
            var target = $("[name=" + param + "]");
            var x = new Date(value);
            var y = new Date(target.val());
            return this.optional(element) || +x >= +y;
        });
        $.validator.addMethod("onInterface", function (value, element, param) {
            if (param == "")
                param = "error";
            var target = $("#" + element.id);
            return !target.hasClass(param);
        });
        $.validator.addMethod("datetime", function (value, element, param) {
            if (value) {
                if (new Date(Date.parse(value)) != "Invalid Date") {
                    return /\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}/.test(value);
                } else {
                    return false;
                }
            }

            return true;
        });
        $.validator.addMethod("dateYearMonth", function (value, element, param) {
            if (value) {
                if (new Date(Date.parse(value)) != "Invalid Date") {
                    return /\d{4}-\d{2}/.test(value);
                } else {
                    return false;
                }
            }
            return true;
        });
        $.validator.addMethod("datetimeShort", function (value, element, param) {
            if (value) {
                if (new Date(Date.parse(value)) != "Invalid Date") {
                    return /\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}/.test(value);
                } else {
                    return false;
                }
            }
            return true;
        });
        $.validator.addMethod("prodDateEqOrNextThan", function (
                value,
                element,
                param
                ) {
            var target = $("[name=" + param + "]");
            var x = new Date(value);
            var y = new Date(target.val());
            return this.optional(element) || +x >= +y;
        });
        $.validator.addMethod("prodDateEqOrLessThan", function (
                value,
                element,
                param
                ) {
            var target = $("[name=" + param + "]");
            var x = new Date(value);
            var y = new Date(target.val());
            return this.optional(element) || +x <= +y;
        });
        $.validator.addMethod("time24Minutes", function (value, element) {
            //HH24:MI
            if (!/^\d{2}:\d{2}$/.test(value))
                return false;
            var parts = value.split(":");
            if (parts[0] > 23 || parts[1] > 59)
                return false;
            return true;
        });
        $.validator.addMethod("time24Seconds", function (value, element) {
            //HH24:MI:SS
            if (!/^\d{2}:\d{2}:\d{2}$/.test(value))
                return false;
            var parts = value.split(":");
            if (parts[0] > 23 || parts[1] > 59 || parts[2] > 59)
                return false;
            return true;
        });
        $(document).on("click", ".sFilter", function (evt) {
            var obj = window[$(evt.target.parentElement).data("id")];
            var arr = [];

            arr = $(
                    "." +
                    $(this)
                    .parent()
                    .data("id") +
                    "_sFilters"
                    ).find(
                    '*[data-id="' +
                    $(this)
                    .parent()
                    .data("id") +
                    '"]'
                    );

            $.each(arr, function (i, el) {
                if (evt.target.parentElement === el) {
                    obj.resetFilter(
                            $(el),
                            $(el).data("filter"),
                            arr,
                            $(evt.target.parentElement).data("id")
                            );
                }
            });
        });
        $(document).on("click", ".fileItem > .fas.fa-times", function (e) {
            e.stopImmediatePropagation();
            var parentLI = $(e.currentTarget).parent("li.fileItem"), //parent LI container with Remove Icon and File link details
                    el = $(e.currentTarget), //Remove file icon
                    remFile = $(el).next("a"), //Remove file details;
                    prt = $(e.currentTarget).parents(".fileList"), //List of files
                    o = window[prt.data("role")], //QuadTable instance
                    dataId = el.parent().data("id");
            if (typeof o["inRowDoc"] !== undefined) {
                // ORIGINAL :: $(parentLI).html('<span class="help-block"><i class="fa fa-info-circle" style="color: #6cb8f9; padding-right: 5px;"></i>' + JS_UNDO_REMOVE_FILE + '<span>');
                $(parentLI).html(
                        '<span class="help-block alert alert-warning"><i class="far fa-info-circle" style="color: #6cb8f9; padding-right: 5px;"></i>' +
                        JS_UNDO_REMOVE_FILE +
                        "<span>"
                        );
                $("#mydropzone").show();
                $("#saveFileEditor").show();
                $(document).on("blur", "#saveFileEditor", function (e) {
                    //usamos blur porque senao estariamos a redefenir o click
                    e.stopImmediatePropagation();
                    var o = window[$(this).data("instance")];
                    var data = o.convertToDTRowData(o.dbColumns);
                    var info = o.inRowDoc;
                    (data[info.extField] = ""),
                            (data[info.fileNameField] = ""),
                            (data[info.pathField] = "");
                    data = o.normalizeData(data);
                    //guardamos os dados do registo a atualizar pois no update , se a chave for alvo de atualizacao o ID da row ja nao `e o mesmo
                    window["copyEditorData"] = o.convertToDTRowData(o.dbColumns);
                    window.copyEditorData["DT_RowId"] = o.composeId(
                            o.pk.primary,
                            window["copyEditorData"]
                            );
                    o.prepareData(data);

                    $("#" + o["tableId"] + "_editorForm .docsViewer").hide();
                    $("#" + o["tableId"] + "_editorForm .upload").show();
                    if (!o.editor.frmData) {
                        o.editor["frmData"] = new FormData();
                    }
                    o.editor.frmData.append("upload[]", new File([""], null));
                });
            }
        });
        $(document).on("click", ".fileItem > a", function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            window[$(this).data("instance")].downloadFile(
                    $(this).data("table"),
                    $(this).data("reference")
                    );
        });
        $(document).on(
                "click",
                "." +
                quadConfig.workflow.classNames.quadForm.column +
                ",." +
                quadConfig.workflow.classNames.quadForm.columnImg +
                ",." +
                quadConfig.workflow.classNames.quadTable.column,
                function (e) {
                    e.stopImmediatePropagation();
                    e.stopPropagation();
                    if (
                            $(e.currentTarget).is("td") ||
                            $(e.currentTarget).is("li") ||
                            $(e.currentTarget).is("input") ||
                            $(e.currentTarget).data("instance") //click num media type
                            ) {
                        var obj = window[$(e.currentTarget).data("instance")];
                        if (obj instanceof QuadTable) {
                            //is a quadTable

                            var pkStr = obj.composeIdToString(
                                    obj.pk.primary,
                                    obj.tbl
                                    .row(
                                            "#" +
                                            $($(e.currentTarget).parents("tr")[0])
                                            .prev(".parent")
                                            .attr("id")
                                            )
                                    .data(),
                                    true
                                    );
                            //logica para trabalhar display false e mostrar apenas o icon, click no campo linkdoc deve mostrar o conteudo do bddoc na janela de wkf
                            var colname = $(this).attr("colName");
                            if (obj.inRowDoc && obj.inRowDoc.embedded.display === false) {
                                if (colname === obj.inRowDoc.fileNameField) {
                                    colname = obj.inRowDoc.blobField;
                                }
                            }

                            var res = _.filter(obj.wkf, {
                                PK: pkStr,
                                COLUNA: colname
                            });
                        } else {
                            //is a quadform
                            var pkStr = obj.composeIdToString(obj.pk.primary, null, true);
                            //todo filter by BD_DOC if COLUNA:"BD_DOC" or is a div.docsViewer etc...

                            if (
                                    $(e.currentTarget).find(".docsViewer").length > 0 ||
                                    $(e.currentTarget).find(obj.inRowDoc.domElementId).length > 0
                                    ) {
                                var res = _.filter(obj.wkf, {
                                    PK: pkStr,
                                    COLUNA: obj.inRowDoc.blobField
                                });
                            } else {
                                var res = _.filter(obj.wkf, {
                                    PK: pkStr,
                                    COLUNA: $(e.currentTarget).hasClass("chosen-container")
                                            ? $(this)
                                            .prev()
                                            .attr("name")
                                            : $(this).attr("name")
                                });
                            }
                        }
                    }
                    obj.showWorkflow(pkStr, res, colname);
                }
        );

        $(document).on(
                "click",
                "." +
                quadConfig.workflow.classNames.quadForm.record +
                ",." +
                quadConfig.workflow.classNames.quadTable.record,
                function (e) {
                    e.stopImmediatePropagation();
                    setTimeout(function () {
                        if ($(e.currentTarget).is("span")) {
                            //its a click on the row that means is optimistic insert or postponed delete
                            var obj = window[$($(e.currentTarget).closest("table")).attr("id")];
                            var pkStr = obj.composeIdToString(
                                    obj.pk.primary,
                                    obj.tbl
                                    .row(
                                            "#" +
                                            $(e.currentTarget)
                                            .parents("tr")
                                            .attr("id")
                                            )
                                    .data(),
                                    true
                                    );
                            obj.showByRecordWorkflow(pkStr);
                        } else {
                            // its not a row click, it means is a insert postponed
                            var obj = window[$(e.currentTarget).attr("id")];
                            var pkStr = obj.composeIdToString(obj.pk.primary, null, true);
                            obj.showByRecordWorkflow(pkStr);
                        }
                        //}
                    }, 1000);
                }
        );
        $(document).on(
                "click",
                "." +
                quadConfig.workflow.classNames.quadForm.form +
                ",." +
                quadConfig.workflow.classNames.quadTable.table,
                function (e) {
                    e.stopImmediatePropagation();
                    if (e.target.tagName === "TD") {
                        return;
                    }
                    setTimeout(function () {
                        if ($(e.currentTarget).hasClass("frmRecordWkf2")) {
                            var obj =
                                    window[
                                            $($(e.currentTarget).find("form.form-horizontal")).attr("id")
                                    ];
                            if (obj.myData["data"][0]) {
                                var pkStr = obj.composeIdToString(
                                        obj.pk.primary,
                                        obj.myData["data"][0],
                                        true
                                        );
                            }

                            var res = _.filter(obj.wkf, function (o) {
                                return o.OPERACAO === "INSERT";
                            });
                            obj.showWorkflow(pkStr ? pkStr : null, res);
                            return false;
                        }
                        if ($(e.currentTarget).hasClass("tableRecordWkf2")) {
                            var obj =
                                    window[
                                            $(e.currentTarget)
                                            .parents(".dataTables_scroll")
                                            .find(".dataTable")[1].id
                                    ];
                            var pkStr = obj.composeIdToString(
                                    obj.pk.primary,
                                    obj.tbl.row(e.currentTarget).data(),
                                    true
                                    );
                            if (obj.sFilters) {
                                var formatedFilters = [];
                                //filtros tem que ser formatados para o mesmo formatop do pkstr do registo(campo pk na tabela workflow)
                                obj.sFilters.forEach(function (d) {
                                    formatedFilters[d.name] = d.value;
                                });
                            }

                            var res = _.filter(obj.wkf, function (o) {
                                if (
                                        _.isMatch(
                                                JSON.parse(o.PK),
                                                formatedFilters ? formatedFilters : JSON.parse(pkStr)
                                                )
                                        ) {
                                    if (obj["dependsOn"]) {
                                        var masterObj = window[Object.keys(obj["dependsOn"])[0]];
                                        var masterData = masterObj.convertToDTRowData(
                                                window[Object.keys(obj["dependsOn"])[0]].dbColumns
                                                );
                                        var masterPk = {};
                                        _.each(masterObj.pk.primary, function (k, i) {
                                            masterPk[i] = masterData[i];
                                        });
                                        if (
                                                !_.isMatch(_.pick(JSON.parse(o.PK), _.identity), masterPk)
                                                ) {
                                            return;
                                        }
                                    } else {
                                        if (
                                                !_.isEqual(
                                                        Object.keys(JSON.parse(o.PK)),
                                                        Object.keys(obj.pk.primary)
                                                        )
                                                ) {
                                            return;
                                        }
                                    }
                                    if (obj.workFlow.mode === "postponed") {
                                        if (e.target.tagName === "TH") {
                                            return o.OPERACAO === "INSERT";
                                        }
                                        if (e.target.tagName === "TD") {
                                            return o.OPERACAO === "DELETE";
                                        }
                                    } else {
                                        return o.OPERACAO === "DELETE";
                                    }
                                }
                            });

                            obj.showWorkflow(pkStr, res);
                            return false;
                        }

                        //}
                    }, 1000);
                }
        );
        $(document).on("shown.bs.modal", "#myModal", function (e) {
            console.log("QUADHELPER: Executar codigo on open do modal..");
            /*$(this).find('.modal-body').css({
             width:'auto', //probably not needed
             height:'auto', //probably not needed
             'max-height':'100%'
             });*/
        });
    });
