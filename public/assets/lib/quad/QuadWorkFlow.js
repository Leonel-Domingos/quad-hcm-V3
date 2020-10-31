    "use strict";
    var QuadWorkFlow = function () {};

    QuadWorkFlow.prototype.showWorkflow = function (pkstr, res, colname) {
        var obj = this;

        if ($("#myModal", document).length === 0) {
            var m =
                    '<div id="myModal" class="modal fade workflow_visio" role="dialog">' +
                    '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">' +
                    '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                    //'<h4 class="modal-title DTE_Header_Content">' + obj.i18nEntries.uploadModalTitle + '</h4>' +
                    '<h4 class="modal-title DTE_Header_Content"></h4>' +
                    '</div><div class="modal-body">' +
                    '</div><div class="modal-footer">' +
                    "</div> </div> </div> </div>";
            $(m).appendTo(document.body);
        }

        $(".modal-title", "#myModal").html("Workflow ");

        $(".modal-body", "#myModal").html(obj.formatWkf(res, colname));

        _.forEach(res, function (ob, k) {
            if (ob["OPERACAO"] === "INSERT" || ob["OPERACAO"] === "UPDATE") {
                if (ob["BD_DOC_POS"]) {
                    obj.workflowMedia(ob, ob["BD_DOC_POS"], ob["BD_MIME_POS"], k);
                }
            }
        });

        $("#myModal").modal("toggle");

        $(".wkfDelete").on("click", {pkstr: pkstr}, function (e) {
            e.stopImmediatePropagation();
            var wkfId = $(e.currentTarget).data("wkfid");
            var index = $(".wkfDelete").index(e.currentTarget);

            obj.deleteWorkflow("delete", wkfId, res[index], pkstr);
        });
        $(".wkfAproove").on("click", {pkstr: pkstr}, function (e) {
            e.stopImmediatePropagation();
            var wkfId = $(e.currentTarget).data("wkfid");
            var index = $(".wkfAproove").index(e.currentTarget);
            obj.aprooveWorkflow("aproove", wkfId, res[index], pkstr);
        });
        $(".wkfReject").on("click", {pkstr: pkstr}, function (e) {
            e.stopImmediatePropagation();

            var wkfId = $(e.currentTarget).data("wkfid");
            var index = $(".wkfReject").index(e.currentTarget);
            obj.rejectWorkflow("reject", wkfId, res[index], pkstr);
        });
        $(".wkfAprooveBulk").on("click", {pkstr: pkstr}, function (e) {
            e.stopImmediatePropagation();
            var wkfType = $(e.currentTarget).data("wkfType");
            obj.aprooveWorkflowBulk(wkfType, res, pkstr);
        });
        $(".wkfRejectBulk").on("click", {pkstr: pkstr}, function (e) {
            e.stopImmediatePropagation();
            var wkfType = $(e.currentTarget).data("wkfType");
            obj.rejectWorkflowBulk(wkfType, res, pkstr);
        });
    };

    QuadWorkFlow.prototype.composeIdToString = function (pk, data, jsonPK) {
        var obj = this;
        var rowData;
        if (obj instanceof QuadForm) {
            rowData = obj.myData["data"][obj.currentRecord];
        } else {
            //todo sometimes dbcolumns are empty/no values if row not selected
            rowData = obj.convertToDTRowData(obj.dbColumns);
        }
        if (data) {
            rowData = data;
        }
        if (pk && jsonPK) {
            var rowId = {};
            _.each(pk, function (k, i) {
                rowId[i] = rowData[i];
            });

            return JSON.stringify(_.pick(rowId, _.identity));
        }

        if (pk && rowData) {
            var rowId = [];
            _.each(pk, function (k, i) {
                rowId.push(rowData[i]);
            });
            return rowId.join("");
        }
    };

    QuadWorkFlow.prototype.clearWorkFlow = function (container) {
        var obj = this;
        if (obj instanceof QuadForm) {
            $(
                    "." + quadConfig.workflow.classNames.quadForm.columnImg,
                    container
                    ).removeClass(quadConfig.workflow.classNames.quadForm.columnImg);
            $(
                    "." + quadConfig.workflow.classNames.quadForm.column,
                    container
                    ).removeClass(quadConfig.workflow.classNames.quadForm.column);
            $(container).removeClass(quadConfig.workflow.classNames.quadForm.record);
            $(container)
                    .parent()
                    .removeClass(quadConfig.workflow.classNames.quadForm.form);
        } else {
            $(
                    $(container)
                    .parents(".dataTables_scroll")
                    .find("THEAD")
                    .find("TH")[0]
                    ).removeClass(quadConfig.workflow.classNames.quadTable.table);
            $(
                    "." + quadConfig.workflow.classNames.quadTable.column,
                    container
                    ).removeClass(quadConfig.workflow.classNames.quadTable.column);
            $(
                    "." + quadConfig.workflow.classNames.quadTable.record,
                    container
                    ).removeClass(quadConfig.workflow.classNames.quadTable.record);
            $(".detailsWkf", container).removeClass("detailsWkf");
        }
    };

    QuadWorkFlow.prototype.manageWorkflow = function (wkfType, container, wkfInfo) {
        var obj = this;

        var arr = obj.wkf;

        obj.clearWorkFlow(container);
        if (obj instanceof QuadForm) {
            if (_.find(arr, {OPERACAO: "INSERT"})) {
                if (obj.workFlow.mode === "postponed") {
                    $(container)
                            .parent()
                            .addClass(quadConfig.workflow.classNames.quadForm.form);
                }
            }
            if (obj.myData["data"][obj.currentRecord]) {
                var res = _.filter(arr, function (o) {
                    return (
                            o.OPERACAO == "INSERT" ||
                            o.PK == obj.composeIdToString(obj.pk.primary, null, true)
                            );
                });
            } else {
                var res = _.filter(arr, function (o) {
                    return o.OPERACAO == "INSERT";
                });
            }

            if (res) {
                _.map(res, function (o, i) {
                    if (o.OPERACAO === "INSERT") {
                        if (obj.workFlow.mode === "optimistic") {
                            $(container).addClass(
                                    quadConfig.workflow.classNames.quadForm.record
                                    );
                        }
                    } else if (o.OPERACAO === "DELETE") {
                        obj.disableCrud(container);

                        if (obj.workFlow.mode === "postponed") {
                            $(container).addClass(
                                    quadConfig.workflow.classNames.quadForm.record
                                    );
                        } else {
                            $(container)
                                    .parent()
                                    .addClass(quadConfig.workflow.classNames.quadForm.form);
                        }
                    } else if (o.OPERACAO === "UPDATE") {
                        if (obj.myData["data"][obj.currentRecord]) {
                            var el = null;
                            if (obj.inRowDoc && o.COLUNA === obj.inRowDoc.blobField) {
                                el = $(container)
                                        .find(obj.inRowDoc.domElementId)
                                        .parent();
                            } else {
                                el = $('[name="' + o.COLUNA + '"]', container);
                            }

                            if (_.includes(obj.exclude, o.COLUNA)) {
                                // return;
                            }
                            if (el.length > 0) {
                                if (el.attr("dependent-group") && el.hasClass("chosen")) {
                                    obj.createSearchableList(el);
                                    el.trigger("mouseover");
                                    el.next(".chosen-container")
                                            .addClass(quadConfig.workflow.classNames.quadForm.column)
                                            .attr("data-instance", obj.formId.substring(1));
                                    el.addClass(
                                            quadConfig.workflow.classNames.quadForm.column
                                            ).attr("data-instance", obj.formId.substring(1));
                                } else {
                                    if (
                                            obj.inRowDoc &&
                                            el.prevObject.get(0) === $(obj.inRowDoc.domElementId).get(0)
                                            ) {
                                        el.addClass(
                                                quadConfig.workflow.classNames.quadForm.columnImg
                                                ).attr("data-instance", obj.formId.substring(1));
                                    } else {
                                        el.addClass(
                                                quadConfig.workflow.classNames.quadForm.column
                                                ).attr("data-instance", obj.formId.substring(1));
                                    }
                                }

                                el.removeAttr("disabled").attr("readonly", true);
                                el.prop("readonly", true).trigger("chosen:updated");
                            }
                        }
                    }
                });
            }
        } else {
            if (obj.wkf) {
                _.forEach(obj.wkf, function (o, i) {
                    var selector = "#row_" + Object.values(JSON.parse(o.PK)).join("");

                    selector = selector.escapeSelector();
                    if (o.OPERACAO === "DELETE" || o.OPERACAO === "INSERT") {
                        if (obj.workFlow.mode === "postponed") {
                            if (o.OPERACAO === "INSERT") {
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

                                var selector = $("#" + obj.tableId)
                                        .closest(".dataTables_scroll")
                                        .find("thead")
                                        .find("th")[0];
                                if (obj.externalFilter) {
                                    var filterData = obj.getFiltersFormsData();

                                    _.remove(filterData, {value: ""});
                                    _.remove(filterData, {value: null});
                                    _.forEach(filterData, function (o, i) {
                                        if (!obj["sortInfo"]) {
                                            if (obj instanceof QuadTable) {
                                                var ob = _.find(obj.tableCols, {name: o.name});
                                                if (ob["complexList"]) {
                                                    filterData = obj.mapComplexListFilterData(
                                                            o,
                                                            filterData
                                                            );
                                                }
                                            } else {
                                                var ob = $('[name="' + o.name + '"]', obj.formId);
                                                if (ob.hasClass("complexList")) {
                                                    filterData = obj.mapComplexListFilterData(
                                                            o,
                                                            filterData
                                                            );
                                                }
                                            }
                                        } else {
                                        }
                                    });
                                    filterData = filterData.reduce(
                                            (obj, item) =>
                                        Object.assign(obj, {[item.name]: item.value}),
                                            {}
                                    );
                                    if (_.some([JSON.parse(o.PK)], filterData)) {
                                        $(selector).addClass(
                                                quadConfig.workflow.classNames.quadTable.table
                                                );
                                    }
                                } else {
                                    $(selector).addClass(
                                            quadConfig.workflow.classNames.quadTable.table
                                            );
                                }
                            } else {
                                $(selector, "#" + obj.tableId)
                                        .find("td:last")
                                        .append(
                                                "<span style='position:absolute ;width:20px; height:20px' class='" +
                                                quadConfig.workflow.classNames.quadTable.record +
                                                "'></span>"
                                                );

                                obj.disableCrud(selector);
                            }
                        } else {
                            if (o.OPERACAO === "INSERT") {
                                $(selector, "#" + obj.tableId).addClass(
                                        quadConfig.workflow.classNames.quadTable.record
                                        );
                            } else {
                                var selector = $("#" + obj.tableId)
                                        .closest(".dataTables_scroll")
                                        .find("thead")[0];
                                $(selector).addClass(
                                        quadConfig.workflow.classNames.quadTable.table
                                        );
                            }
                        }
                    } else {
                        if (
                                _.find(obj.tableCols, {name: o.COLUNA}) &&
                                _.find(obj.tableCols, {name: o.COLUNA})["exclude"]
                                ) {
                            return;
                        }

                        if (obj.colReorder) {
                            var rowIndex = obj.tbl.row(selector).index();

                            var complexLists = obj.tableCols.filter(function (item) {
                                return item.attr.hasOwnProperty("data-db-name");
                            });

                            var complexListswithColumn = complexLists.filter(function (item) {
                                return item.attr["data-db-name"].includes(o.COLUNA);
                            });
                            //usually is always the first entry if architecture doesnt change...
                            //prs_producoes
                            //todo find the correct complexlist...is it o.coluna visible? ok...do nothing. not visible? exclude from complexListswithColumn the ones that includes
                            //return the ones that are included in another... ex EMPRESA@CD_DIRECAO@DT_INI_DIRECAO@CD_DEPT@DT_INI_DEPT  is included in EMPRESA@CD_DIRECAO@DT_INI_DIRECAO@CD_DEPT@DT_INI_DEPT@CD_PROC@DT_INI_PROC

                            if (complexListswithColumn[0]) {
                                var target = obj.tbl.colReorder.order().indexOf(
                                        _.find(obj.tableCols, {
                                            name: complexListswithColumn[0].name
                                        })["targets"]
                                        );
                            } else {
                                var target = obj.tbl.colReorder
                                        .order()
                                        .indexOf(_.find(obj.tableCols, {name: o.COLUNA})["targets"]);
                            }

                            obj.markColumnWorkflow(target, rowIndex, o);
                        } else {
                            if (_.find(obj.tableCols, {name: o.COLUNA})) {
                                var target = _.find(obj.tableCols, {name: o.COLUNA})["targets"];

                                var rowIndex = obj.tbl.row(selector).index();
                                if (typeof rowIndex !== "undefined") {
                                    obj.markColumnWorkflow(target, rowIndex, o);
                                }
                            }
                        }
                    }
                });
            }
        }
    };

    QuadWorkFlow.prototype.disableCrud = function (selector) {
        var obj = this;
        if (obj instanceof QuadTable) {
            $(selector, "#" + obj.tableId)
                    .find("td:last")
                    .find(".tblEditBut,.tblDelBut")
                    .attr("disabled", "disabled");
        } else {

            $(selector)
                    .find("a[data-form-action=edit]")
                    .hide();
        }
        //todo rh_cadstro dont have relations, have multiinstance filter.
        //if (obj.workFlow.disableDetailsOnDelete) {
        /* if (obj.detailsObjects) {
         _.forEach(obj.detailsObjects, function(o, key) {
         if (window[o] instanceof QuadTable) {
         $("#" + obj.tableId)
         .find("td:last")
         .find(".tblEditBut,.tblDelBut")
         .attr("disabled", "disabled");
         } else if (window[o] instanceof QuadForm) {
         $(window[o].formId)
         .find("a[data-form-action=edit]")
         .hide();
         }
         });
         }*/
        // }
    };

    QuadWorkFlow.prototype.markColumnWorkflow = function (target, rowIndex, o) {
        var obj = this;
        if (obj.tbl.column(target).responsiveHidden() === false) {
            $(obj.tbl.cell(rowIndex, 0).node()).addClass("detailsWkf");
            setTimeout(function () {
                $(obj.tbl.row(rowIndex).node())
                        .next(".child")
                        .find("[data-dt-column='" + target + "']")
                        .addClass(quadConfig.workflow.classNames.quadTable.column)
                        .attr("colName", _.find(obj.tableCols, {name: o.COLUNA})["name"])
                         .attr("data-instance", obj.tableId);;
            }, 1000);
        } else {
            //se for uma table e a cluna for de documento e nao for visivel o documento e sim o icon ...
            if (
                    obj.inRowDoc &&
                    obj.inRowDoc.embedded &&
                    !obj.inRowDoc.embedded.display &&
                    o.COLUNA === obj.inRowDoc.blobField
                    ) {
                var cell = $(obj.tbl.row(rowIndex).node());
                cell
                        .find(".docsViewer")
                        .parent("td")
                        .addClass("tableColWkf")
                        .attr("colName", o.COLUNA)
                        .attr("data-instance", obj.tableId);
            }
            $(obj.tbl.cell(rowIndex, target).node()).addClass(
                    quadConfig.workflow.classNames.quadTable.column
                    );
            $(obj.tbl.cell(rowIndex, target).node())
                    .attr("colName", o.COLUNA)
                    .attr("data-instance", obj.tableId);
        }
    };

    QuadWorkFlow.prototype.mapComplexListFilterData = function (o, filterData) {
        var obj = this;
        var f = _.find(obj["sFilters"], {name: o.name});
        var value = f.value.replace(quadConfig.regExpressions.alias, "").split("@");
        _.map(keys, function (field, j) {
            filterData[field] = value[j];
        });
        delete filterData[o.name];
        return filterData;
    };

    QuadWorkFlow.prototype.commitWorkFlow = function (operation, idWkf, res) {
        var obj = this;
        var json = JSON.stringify(obj.convertToDTRowData(obj.dbColumns));

        var cxLists = obj.getInstanceComplexLists();
        var domains = obj.getInstanceDomains();
        $(".modal-header").addClass("loadingList");
        var paramsData = {
            domains: JSON.stringify(domains),
            cxLists: cxLists,
            results: res,
            idWkf: idWkf,
            operation: operation,
            wkfInfo: obj.workFlow,
            workFlow: obj.workFlow,
            pk: obj.pk.primary,
            columnsArray: json,
            dbColumns: JSON.stringify(obj.dbColumns),
            table: obj.table
        };
        var promise = $.ajax({
            type: "POST",
            url: pn + "data-source/workflow_controller.php",
            data: paramsData,
            cache: false,
            async: true,
            success: function () {
                $(".modal-header").removeClass("loadingList");
            }
        });
        return promise;
    };

    QuadWorkFlow.prototype.workFlowUpdateTableUi = function (
            rowId,
            res,
            dat,
            wkfOperation,
            pkstring
            ) {
        var obj = this;
        if (res["OPERACAO"] === "DELETE") {
            if (obj.workFlow.mode === "postponed") {
                if (wkfOperation === "aproove") {
                    if (dat["status"] === "deleted") {
                        obj.deleteTableRow(dat, rowId);
                    }
                } else {
                    console.log("rejected");
                }
                return;
            }
            if (obj.workFlow.mode === "optimistic") {
                if (wkfOperation === "aproove") {
                } else {
                    //insert Record on reject deleted optimistic
                    var dt = JSON.parse(res["VLR_POS"]);
                    dt = obj.normalizeData(dt);
                    dt = obj.fixData(dt);
                    obj.addRecordToTable(dt.data[0]);
                }
                return;
            }
        }

        if (res["OPERACAO"] === "INSERT") {
            if (obj.workFlow.mode === "postponed") {
                if (wkfOperation === "aproove") {
                    dat.data[0]["DT_RowId"] = obj.composeId(obj.pk.primary, dat.data[0]);

                    obj.addRecordToTable(dat.data[0]);
                } else {
                }
                return;
            }

            if (obj.workFlow.mode === "optimistic") {
                if (wkfOperation === "aproove") {
                } else {
                    obj.deleteTableRow(dat, rowId);
                }
                return;
            }
        }

        if (res["OPERACAO"] === "UPDATE") {
            if (obj.workFlow.mode === "postponed") {
                if (wkfOperation === "aproove") {
                    dat = obj.fixData(dat);
                    obj.tbl.row(rowId).data(dat.data[0]);
                    $(rowId)
                            .fadeIn(500)
                            .fadeOut(500)
                            .fadeIn(500)
                            .fadeOut(500)
                            .fadeIn(500);
                } else {
                    console.log("reject postponed update");
                }
                return;
            }
            if (obj.workFlow.mode === "optimistic") {
                if (wkfOperation === "aproove") {
                    console.log("aproove optimistic update");
                } else {
                    obj.tbl.row(rowId).data(dat[0]);
                    $(rowId)
                            .fadeIn(500)
                            .fadeOut(500)
                            .fadeIn(500)
                            .fadeOut(500)
                            .fadeIn(500);
                }
                return;
            }
        }
    };

    QuadWorkFlow.prototype.workFlowUpdateFormUi = function (
            rowId,
            res,
            dat,
            wkfOperation,
            pkstring
            ) {
        var obj = this;
        var container = obj.formId;
        if (res["OPERACAO"] === "DELETE") {
            if (obj.workFlow.mode === "postponed") {
                if (wkfOperation === "aproove") {
                    obj.removeFormRecord(container);
                } else {
                    console.log("rejected");
                }
            }
            if (obj.workFlow.mode === "optimistic") {
                if (wkfOperation === "aproove") {
                } else {
                    //insert record
                    obj.myData["data"].splice(obj.currentRecord, 0, dat[0]);
                    obj.dataRender(obj.formId, obj.currentRecord, null);
                }
            }
            return;
        }
        if (res["OPERACAO"] === "INSERT") {
            if (obj.workFlow.mode === "postponed") {
                if (wkfOperation === "aproove") {
                    $.merge(obj.myData["data"], dat["data"][0]);

                    obj.myData["data"].splice(obj.currentRecord, 0, dat["data"][0]);
                    var idx = _.findIndex(obj.myData["data"], dat["data"][0]);
                    obj.currentRecord = idx;
                    obj.dataRender(obj.formId, idx, null);
                } else {
                    console.log("rejected");
                }
            }
            if (obj.workFlow.mode === "optimistic") {
                if (wkfOperation === "aproove") {
                    console.log("aproove");
                } else {
                    obj.removeFormRecord(container);
                    $("#myModal").modal("toggle");
                }
            }
            return;
        }
        if (res["OPERACAO"] === "UPDATE") {
            if (obj.workFlow.mode === "postponed") {
                if (wkfOperation === "aproove") {
                    obj.myData["data"][obj.currentRecord] = dat.data[0];
                    obj.dataRender(obj.formId, obj.currentRecord, null);
                } else {
                    quad_notification({
                        type: "error",
                        title: JS_OPERATION_COMPLETED,
                        content: JS_CHANGE_REJECTED
                    });
                }
            }
            if (obj.workFlow.mode === "optimistic") {
                if (wkfOperation === "aproove") {
                    console.log("aproove");
                } else {
                    obj.myData["data"][obj.currentRecord] = dat["data"][0];
                    obj.dataRender(obj.formId, obj.currentRecord, null);
                }
            }
            return;
        }
    };

    QuadWorkFlow.prototype.refreshRecordAfterWkf = function (
            data,
            pkstring,
            res,
            wkfOperation
            ) {
        var obj = this;
        if (!data) {
            $("#myModal").modal("toggle");
            return;
        }

        var rowId = "#row_" + Object.values(JSON.parse(pkstring)).join("");
        if (res["OPERACAO"] === "DELETE") {
        } else {
            data = obj.normalizeData(data);
            data = obj.fixData(data);
        }
        if (obj instanceof QuadTable) {
            obj.workFlowUpdateTableUi(rowId, res, data, wkfOperation, pkstring);
        } else {
            obj.workFlowUpdateFormUi(rowId, res, data, wkfOperation, pkstring);
            if ($(obj.formId).hasClass("quadFormInstanceWithInvertedRules")) {
                //acrescentar novo id ao filtro com evento
                $("a[data-form-action=save]", obj.formId).trigger("updateFilter");
                obj.clearWorkFlow(obj.formId);
                obj.instanceUpToDate();
            }
        }
        $("#myModal").modal("toggle");
    };

    QuadWorkFlow.prototype.aprooveWorkflow = function (
            operation,
            id,
            res,
            pkstring
            ) {
        var obj = this;
        if (res["OPERACAO"] === "INSERT" || res["OPERACAO"] === "DELETE") {
            pkstring = res["PK"];
        }

        $.when(obj.commitWorkFlow(operation, id, res, pkstring)).then(function (data) {
            var container = "";
            if (obj instanceof QuadForm) {
                container = obj.formId;
            } else {
                container = $("#" + obj.tableId).parents(".widget-body");
            }
            data = JSON.parse(data);
            if (obj.checkError(data)) {
                $("#myModal").modal("toggle");
                return;
            }
            _.remove(obj["wkf"], {ID: res.ID});
            if (data["status"] == "ok") {
                $("#myModal").modal("toggle");

                obj.notifyPostponedWorkflowToUser(data);
                obj.getWorkflowAfterCommit();
                return;
            }

            obj.refreshRecordAfterWkf(data, pkstring, res, operation);

            obj.getWorkflowAfterCommit();
        });
    };

    QuadWorkFlow.prototype.deleteWorkflow = function (operation, id, res, pkstring) {
        var obj = this;
        $.when(obj.commitWorkFlow(operation, id, res, pkstring)).then(function (data) {
            data = JSON.parse(data);
            if (obj.checkError(data)) {
                return;
            }
            obj.getWorkflowAfterCommit();

            $("#myModal").modal("toggle");
        });
    };

    QuadWorkFlow.prototype.rejectWorkflow = function (operation, id, res, pkstring) {
        var obj = this;

        if (res["OPERACAO"] === "INSERT" || res["OPERACAO"] === "DELETE") {
            $.when(obj.commitWorkFlow(operation, id, res, res["PK"])).then(function (
                    data
                    ) {
                data = JSON.parse(data);
                if (obj.checkError(data)) {
                    return;
                }
                if (
                        obj.workFlow.mode === "postponed" &&
                        data.status &&
                        data.status === "rejected"
                        ) {
                    //DELETES condicionam as operacoes. Volta-se a restabelecer
                    if (res["OPERACAO"] === "DELETE") {
                        $("#myModal").modal("toggle");
                        $.when(obj.getWorkflow()).then(function (data) {
                            data = JSON.parse(data);
                            obj["wkf"] = obj["wkf"] || [];

                            obj["wkf"] = data;
                            if (obj instanceof QuadForm) {
                                obj.dataRender(obj.formId, obj.currentRecord, null, data);
                            } else {
                                var rowId = obj.composeId(obj.pk.primary, JSON.parse(res["PK"]));
                                var row = obj.tbl.row("#" + rowId).node();
                                var el = $(row).find("td:last-child");
                                el.empty();
                                el.html(obj.crudButtons(obj.getCrud()));
                                obj.manageWorkflow(
                                        obj.workFlow.update,
                                        "#" + obj.tableId,
                                        obj["wkf"]
                                        );
                            }
                        });
                    } else {
                        obj.getWorkflowAfterCommit();
                        if (obj instanceof QuadForm) {
                            obj.resetButtonsState(
                                    obj.formId,
                                    obj.totalRecords,
                                    obj.currentRecord
                                    );
                            $(obj.formId)
                                    .find("a[data-form-action=edit]")
                                    .show();
                        }
                        obj.refreshRecordAfterWkf(data, pkstring, res, operation);
                    }

                    return;
                }
            });
        } else {
            $.when(obj.commitWorkFlow(operation, id, res, pkstring)).then(function (
                    data
                    ) {
                data = JSON.parse(data);
                if (obj.checkError(data, $(container))) {
                    return;
                }
                if (
                        obj.workFlow.mode === "postponed" &&
                        data.status &&
                        data.status === "rejected"
                        ) {
                    $("#myModal").modal("toggle");
                    obj.getWorkflowAfterCommit();
                    return;
                }
                _.remove(obj["wkf"], {ID: res.ID});
                obj.getWorkflowAfterCommit();
                obj.refreshRecordAfterWkf(data, pkstring, res, operation);
            });
        }
    };

    QuadWorkFlow.prototype.aprooveWorkflowBulk = function (type, res, pkstring) {
        var obj = this;
        $.when(obj.commitWorkFlow("aprooveAll", type, res)).then(function (data) {
            data = JSON.parse(data);
            if (obj.checkError(data, $(container))) {
                return;
            }
            obj.refreshRecordAfterWkf(data, pkstring, res, "aprooveAll");
            obj.getWorkflowAfterCommit();
        });
    };

    QuadWorkFlow.prototype.rejectWorkflowBulk = function (type, res, pkstring) {
        var obj = this;
        $.when(obj.commitWorkFlow("rejectAll", type, res)).then(function (data) {
            data = JSON.parse(data);
            if (obj.checkError(data, $(container))) {
                return;
            }
            obj.refreshRecordAfterWkf(data, pkstring, res, "rejectAll");
            obj.getWorkflowAfterCommit();
        });
    };

    QuadWorkFlow.prototype.getWorkflowAfterCommit = function () {
        var obj = this;

        obj.clearWorkFlow();
        obj.instanceUpToDate();
    };

    QuadWorkFlow.prototype.workflowToUi = function () {
        var obj = this;
        $.when(obj.getWorkflow()).then(function (data) {
            data = JSON.parse(data);
            obj["wkf"] = obj["wkf"] || [];

            obj["wkf"] = data;
            var container = obj instanceof QuadTable ? "#" + obj.tableId : obj.formId;
            if (obj instanceof QuadForm) {
                if ($(obj.formId).hasClass("quadFormInstanceWithInvertedRules")) {
                    if (obj.operation === "INSERT") {
                        _.remove(obj["wkf"], {OPERACAO: "UPDATE"});
                    }
                    obj.manageWorkflow(obj.workFlow.update, container, obj["wkf"]);
                    return;
                }
                obj.dataRender(obj.formId, obj.currentRecord, null, obj["wkf"]);
                obj.manageWorkflow(obj.workFlow.update, container, obj["wkf"]);
            } else {
                obj.manageWorkflow(obj.workFlow.update, container, obj["wkf"]);
            }
        });
    };

    QuadWorkFlow.prototype.getWorkflow = function () {
        var obj = this;
        if (!(obj instanceof QuadForm)) {
            var json = JSON.stringify(obj.convertToDTRowData(obj.dbColumns));
        } else {
            obj.myData["data"] = obj.myData["data"] || [];
            var json = JSON.stringify(obj.myData["data"][obj.currentRecord]);
        }
        var paramsData = {
            //wkfInfo: wkfInfo,
            workFlow: obj.workFlow,
            pk: obj.pk.primary,
            columnsArray: json,
            dbColumns: JSON.stringify(obj.dbColumns),
            table: obj.table
        };
        paramsData["operation"] = "get";
        var promise = $.ajax({
            type: "POST",
            url: pn + "data-source/workflow_controller.php",
            data: paramsData,
            cache: false,
            async: true
                    /* beforeSend: function() {
                     obj.showWkfSpinner();//because of delay when exists blobs
                     },
                     success: function() {
                     obj.hideWkfSpinner();//because of delay when exists blobs
                     }*/
        });
        return promise;
    };

    QuadWorkFlow.prototype.generateWkfButtons = function (wkf) {
        var obj = this;

        var aprooveBt =
                '<button title="' +
                JS_APPROVE +
                '" class="wkfAproove wkfBt" data-wkfId="' +
                wkf.ID +
                '"> <i class="fa fa-check fa-sm" ></i></button>';
        var rejectBt =
                '<button title="' +
                JS_REJECT +
                '" class="wkfReject wkfBt" data-wkfId="' +
                wkf.ID +
                '"><i class="fa fa-ban fa-sm" ></i></button>';
        var delBt =
                '<button title="' +
                JS_DELETE +
                '" class="wkfDelete wkfBt" data-wkfId="' +
                wkf.ID +
                '"><i class="fa fa-trash fa-sm"></i></button>';

        var buttons = obj.wkfButtonsContext([aprooveBt, rejectBt, delBt], wkf);

        var html = "<span class='pull-right'>" + buttons.join() + "</span>";

        return html;
    };

    QuadWorkFlow.prototype.wkfButtonsContext = function (buttons, wkf) {
        var obj = this;
        if (wkf.NEXT_PERFIL > JS_ID_PERFIL) {
            buttons.splice(0, 2);
        }
        return buttons;
    };

    QuadWorkFlow.prototype.buildWorkflowRecordUi = function (
            elem,
            outputData,
            buttons,
            output
            ) {
        var obj = this;
        var lineOutput = obj.wkfAboutInfo(elem, outputData);

        lineOutput += buttons;

        output += lineOutput;
        return output;
    };

    QuadWorkFlow.prototype.formatWkf = function (wkfList, colname) {
        var obj = this;
        var output = "";
        var bulkAction =
                '<div class="text-center wkfBtDiv"><button class="wkfAprooveBulk wkfBt" data-wkfType="' +
                obj.workFlow.update +
                '">' +
                JS_APPROVE_ALL +
                '</button><button class="wkfRejectBulk wkfBt" data-wkfType="' +
                obj.workFlow.update +
                '">' +
                JS_REJECT_ALL +
                "</button></div>";
        var outputData = "<ul>";

        _.forEach(wkfList, function (elem, i) {
            outputData = "";
            if (elem.OPERACAO == "DELETE") {
                output = obj.buildWorkflowRecordUi(
                        elem,
                        outputData,
                        obj.generateWkfButtons(elem),
                        output
                        );
            }
            if (elem.OPERACAO == "INSERT") {
                var data = obj.fixData(obj.normalizeData(JSON.parse(elem.VLR_POS)));
                if (elem.BD_DOC_POS) {
                    data.data[0][obj.inRowDoc.blobField] = elem.BD_DOC_POS;
                }
                outputData += "<ul>";
                _.forEach(data.data[0], function (value, field) {
                    if (value) {
                        if (obj instanceof QuadForm) {
                            if (obj.inRowDoc && field === obj.inRowDoc.blobField && value) {
                                outputData += "<li class='workflowmedia'>" + "</li>";
                            }
                            if ($('[name="' + field + '"]', obj.formId).is(":visible")) {
                                outputData +=
                                        "<li>" +
                                        $("label[for='" + field + "']").text() +
                                        " = " +
                                        value +
                                        "</li>";
                            }
                        } else {
                            if (obj.inRowDoc && field === obj.inRowDoc.blobField && value) {
                                outputData += "<li class='workflowmedia'>" + "</li>";
                            }
                            var target = _.find(obj.tableCols, {name: field});
                            if (
                                    target &&
                                    (target.visible !== false || target.visible === undefined)
                                    ) {
                                outputData += "<li>" + target.title + " = " + value + "</li>";
                            }
                        }
                    }
                });
                outputData += "</ul>";
                output = obj.buildWorkflowRecordUi(
                        elem,
                        outputData,
                        obj.generateWkfButtons(elem),
                        output
                        );
            }

            if (elem.OPERACAO == "UPDATE") {
                if (obj.workFlow.update === "record") {
                    if (colname === obj.inRowDoc.blobField) {
                        if (elem.BD_DOC_ANT) {
                            var decodedAnt = elem.BD_DOC_ANT;
                        } else {
                            var decodedAnt = "";
                        }
                    } else {
                        if (elem.VLR_ANT) {
                            var decodedAnt = obj.fixData(
                                    obj.normalizeData(JSON.parse(elem.VLR_ANT))
                                    )["data"][0][elem.COLUNA];
                        } else {
                            var decodedAnt = "";
                        }
                    }
                    if (colname === obj.inRowDoc.blobField) {
                        if (elem.BD_DOC_POS) {
                            var decodedPos = elem.BD_DOC_POS;
                        } else {
                            var decodedPos = "";
                        }
                    } else {
                        if (elem.VLR_POS) {
                            if (
                                    obj.inRowDoc &&
                                    obj.inRowDoc.embedded &&
                                    obj.inRowDoc.embedded.display == false
                                    ) {
                                //todo logic here
                                if (colname && colname === obj.inRowDoc.blobField) {
                                    var decodedPos = obj.fixData(
                                            obj.normalizeData(JSON.parse(elem.VLR_POS))
                                            )["data"][0][obj.inRowDoc.blobField];
                                } else {
                                    var decodedPos = obj.fixData(
                                            obj.normalizeData(JSON.parse(elem.VLR_POS))
                                            )["data"][0][elem.COLUNA];
                                }
                            } else {
                                var decodedPos = obj.fixData(
                                        obj.normalizeData(JSON.parse(elem.VLR_POS))
                                        )["data"][0][elem.COLUNA];
                            }
                        }
                    }

                    output += obj.wkfDomLine(elem, decodedAnt, decodedPos);
                } else {
                    //is update
                    var decodedAnt = elem.BD_DOC_ANT;
                    var decodedPos = elem.BD_DOC_POS;
                    if (obj instanceof QuadTable) {
                        var target = _.find(obj.tableCols, {name: elem.COLUNA});
                        if (target) {
                            if (target.attr && target.attr["dependent-group"]) {
                                if (target.attr["dependent-level"]) { //distingue uma complexList de um domain

                                    decodedAnt = _.find(obj.getComplexListIndex(target), {
                                        VAL: Object.values(JSON.parse(elem.CTXLIST_VLR_ANT)).join("@")
                                    })[target.attr["desigColumn"].replace(quadConfig.regExpressions.alias, "")];
                                    decodedPos = _.find(obj.getComplexListIndex(target), {
                                        VAL: Object.values(JSON.parse(elem.CTXLIST_VLR_POS)).join("@")
                                    })[target.attr["desigColumn"].replace(quadConfig.regExpressions.alias, "")];
                                } else {
                                    decodedAnt = _.find(
                                            initApp.joinsData[target.attr["dependent-group"]],
                                            {
                                                RV_LOW_VALUE: elem.VLR_ANT
                                            }
                                    )["RV_MEANING"];
                                    decodedPos = _.find(
                                            initApp.joinsData[target.attr["dependent-group"]],
                                            {
                                                RV_LOW_VALUE: elem.VLR_POS
                                            }
                                    )["RV_MEANING"];
                                }
                            } else {
                                var decodedAnt = elem.VLR_ANT;
                                var decodedPos = elem.VLR_POS;
                            }
                        }
                    } else {
                        var target = $('[name="' + elem.COLUNA + '"]', obj.formId);

                        if (target.length > 0) {
                            if (target.attr("dependent-group")) {
                                if (target.hasClass("complexList")) {
                                    var dspCol = target.attr("desigcolumn");
                                    dspCol = dspCol.replace(quadConfig.regExpressions.alias, "");
                                    if (elem.VLR_ANT) {
                                        var ctxInfo = Object.values(
                                                JSON.parse(elem.CTXLIST_VLR_ANT)
                                                ).join("@");
                                        if (ctxInfo) {
                                            decodedAnt = _.find(obj.getComplexListIndex(target), {
                                                VAL: Object.values(JSON.parse(elem.CTXLIST_VLR_ANT)).join(
                                                        "@"
                                                        )
                                            })[dspCol];
                                        } else {
                                            decodedAnt = "";
                                        }
                                    }
                                    if (elem.VLR_POS) {
                                        var ctxInfo = Object.values(
                                                JSON.parse(elem.CTXLIST_VLR_POS)
                                                ).join("@");
                                        if (ctxInfo) {
                                            decodedPos = _.find(obj.getComplexListIndex(target), {
                                                VAL: Object.values(JSON.parse(elem.CTXLIST_VLR_POS)).join(
                                                        "@"
                                                        )
                                            })[dspCol];
                                        } else {
                                            decodedAnt = "";
                                        }
                                    }
                                } else {
                                    if (elem.VLR_ANT) {
                                        decodedAnt = _.find(
                                                initApp.joinsData[target.attr("dependent-group")],
                                                {
                                                    RV_LOW_VALUE: JSON.parse(elem.CTXLIST_VLR_ANT)[
                                                            "RV_LOW_VALUE"
                                                    ]
                                                }
                                        )["RV_MEANING"];
                                    }
                                    if (elem.VLR_POS) {
                                        decodedPos = _.find(
                                                initApp.joinsData[target.attr("dependent-group")],
                                                {
                                                    RV_LOW_VALUE: JSON.parse(elem.CTXLIST_VLR_POS)[
                                                            "RV_LOW_VALUE"
                                                    ]
                                                }
                                        )["RV_MEANING"];
                                    }
                                }
                            } else {
                                if (obj.inRowDoc && elem.COLUNA === obj.inRowDoc.blobField) {
                                    var decodedAnt = elem.BD_DOC_ANT;
                                    var decodedPos = elem.BD_DOC_POS;
                                } else {
                                    var decodedAnt = elem.VLR_ANT;
                                    var decodedPos = elem.VLR_POS;
                                }
                            }
                        }
                    }

                    output += obj.wkfDomLine(elem, decodedAnt, decodedPos);
                }
            }
        });
        if (wkfList.length > 1) {
            return bulkAction + output;
        } else {
            return output;
        }
    };
    QuadWorkFlow.prototype.workflowMedia = function (data, value, mimeType, idx) {
        var obj = this;

        var mediaElem = $(".wkfRecordData")
                .eq(idx)
                .find(".workflowmedia");

        var mediaStyle = "style=max-width:320px; max-height= 240px;";

        var videoMimeTypes = ["avi", "mpg", "mp4", "ogg", "wmv", "mov"];

        if (mimeType && videoMimeTypes.indexOf(mimeType.toLowerCase()) !== -1) {
            var player =
                    '<video id="testeVideo" position="absolute " controls autoplay name="media" ' +
                    mediaStyle +
                    "></video>";

            mediaElem.append(player);
            var video = document.getElementById("testeVideo");
            var source = document.createElement("source");

            video.appendChild(source);
            source.setAttribute("src", "data:video/" + mimeType + ";base64," + value);
        }
        if (mimeType && mimeType.toLowerCase() === "pdf") {
            var fileSrc = "data:application/" + mimeType + ";base64," + value;

            mediaElem.append(
                    '<embed src= "' + fileSrc + '"  position="absolute" ' + mediaStyle + ">"
                    );
        }
        //todo moove to quadconfig
        var imgMimeTypes = ["jpg", "jpeg", "png", "svg", "gif", "bmp", "webp"];
        if (mimeType && imgMimeTypes.indexOf(mimeType.toLowerCase()) !== -1) {
            var toShow = "data:image/*;base64," + value;
            mediaElem.append(
                    '<img src= "' + toShow + '"  position="absolute" ' + mediaStyle + "/>"
                    );
        }
        var audioMimeTypes = ["mp3", "wav", "ac3", "aiff", "wma", "m4a"];
        if (mimeType && audioMimeTypes.indexOf(mimeType.toLowerCase()) !== -1) {
            var player =
                    '<audio id="testeAudio" position="absolute" controls autoplay name="media" + mediaStyle +></audio>';
            mediaElem.append(player);
            var video = document.getElementById("testeAudio");
            var source = document.createElement("source");

            video.appendChild(source);
            source.setAttribute("src", "data:audio/" + mimeType + ";base64," + value);
        }
    };
    QuadWorkFlow.prototype.wkfDomLine = function (elem, decodedAnt, decodedPos) {
        var obj = this;

        if (obj.inRowDoc && elem.COLUNA === obj.inRowDoc.blobField) {
            // BD_MIME_ANT and BD_MIME_POS is convention ...fields name in workflow table
            decodedAnt = obj.showWkfBlob(elem.BD_MIME_ANT, decodedAnt);
            decodedPos = obj.showWkfBlob(elem.BD_MIME_POS, decodedPos);
        }
        var lineOutput =
                "<div class='well well-sm'" + " data-wkfId='" + elem.ID + "'>";
        lineOutput +=
                '<span class="label label-info">  ' +
                JS_COLUMN +
                ": </span><span>" +
                elem.COLUNA +
                "</span>";
        lineOutput += obj.wkfAboutOperation(elem);
        lineOutput +=
                '<span class="label label-info">  ' +
                JS_BEFORE +
                ": </span><span>" +
                decodedAnt +
                "</span>";
        lineOutput +=
                '<span class="label label-info">  ' +
                JS_AFTER +
                ": </span><span>" +
                decodedPos +
                "</span>";
        lineOutput += obj.generateWkfButtons(elem);
        lineOutput += "</div>";
        return lineOutput;
    };

    QuadWorkFlow.prototype.wkfAboutInfo = function (elem, outputData) {
        var obj = this;
        var lineOutput = obj.wkfAboutOperation(elem);
        if (elem.OPERACAO == "DELETE") {
            null;
        } else {
            lineOutput +=
                    "<div class='label label-info'>  DADOS: </div><div class='wkfRecordData'>" +
                    outputData +
                    "</div>";
        }

        return lineOutput;
    };

    QuadWorkFlow.prototype.wkfAboutOperation = function (elem) {
        var obj = this;
        var lineOutput =
                '<div class="wkfAboutInfo"><span class="label label-info">  ' +
                JS_OPERATION +
                ": </span><span>" +
                elem.OPERACAO +
                "</span>";
        lineOutput +=
                '<span class="label label-info">  ' +
                JS_ON_DATE +
                ": </span><span>" +
                elem.DT_INSERTED +
                "</span>";
        lineOutput +=
                '<span class="label label-info">  ' +
                JS_USER +
                ": </span><span>" +
                elem.INSERTED_BY +
                "</span>";
        lineOutput +=
                '<span class="label label-info">  ' +
                JS_TIT_PROFILE +
                ": </span><span>" +
                elem.LAST_PERFIL +
                "</span></div>";
        return lineOutput;
    };

    QuadWorkFlow.prototype.formWorkflowLabels = function (frm, act) {
        var obj = this;
        $(".frmColWkf", frm).removeClass("frmColWkf");
        $(frm).removeClass("frmRecordWkf");
        if (obj.workFlow && obj.workFlow.mode === "postponed") {
            $(frm).removeClass("frmRecordWkf2");
        }
    };

    QuadWorkFlow.prototype.enableWkfPopup = function () {
        var obj = this;
        var bt =
                '<div class="btn btn-default btShowWkf_' +
                obj.tableId +
                '"><i class="fa fa-hand-o-left "></i> </div>';
        return bt;
    };

    QuadWorkFlow.prototype.notifyPostponedWorkflowToUser = function (data) {
        var obj = this;
        if (data) {
            typeof data === "object" ? (data = data) : (data = JSON.parse(data));
            if (data["data"] && data["data"][0]) {
                if (obj instanceof QuadTable) {
                    obj.editor._event("submitComplete", data["data"][0]);
                } else {
                    if (obj.operation === "INSERT") {
                        ++obj.totalRecords;
                        obj.myData["data"].splice(obj.currentRecord, 0, data["data"][0]);
                        if ($(obj.formId).hasClass("quadFormInstanceWithInvertedRules")) {
                            //acrescentar novo id ao filtro com evento
                            $("a[data-form-action=save]", obj.formId).trigger("updateFilter");
                            obj["wkf"] = [];
                            obj.clearWorkFlow(obj.formId);
                            obj.instanceUpToDate();
                            return;
                        }
                        obj.dataRender(obj.formId, obj.currentRecord, "INSERT");
                    } else if (obj.operation === "UPDATE") {
                        var goodData = obj.normalizeData(data["data"][0]);
                        goodData = obj.fixData(goodData);
                        obj.myData["data"][obj.currentRecord] = goodData["data"][0];
                        obj.dataRender(obj.formId, obj.currentRecord, null);
                    }
                    obj.disableFields(obj.formId);
                }

                return;
            } else {
                if (obj instanceof QuadForm) {
                    if ($(obj.formId).hasClass("quadFormInstanceWithInvertedRules")) {
                        if (obj.operation === "INSERT") {
                            _.remove(obj["wkf"], {OPERACAO: "UPDATE"});
                            obj.manageWorkflow(obj.workFlow.update, obj.formId, obj["wkf"]);

                            obj.clearForm(obj.formId);
                            obj.resetButtonsState(obj.formId, null, null);
                            $("a[data-form-action=edit]", obj.formId).hide();
                            $("a[data-form-action=new]", obj.formId).show();
                            return;
                        }
                    }
                    obj.dataRender(obj.formId, obj.currentRecord, null);
                }
            }
        }

        quad_notification({
            type: "success",
            title: JS_OPERATION_COMPLETED,
            content: JS_CHANGE_REGISTERED,
            timeout: 5000
        });
    };
    QuadWorkFlow.prototype.showByRecordWorkflow = function (pkStr) {
        var obj = this;
        var res = _.filter(obj.wkf, function (o) {
            return (
                    o.PK === pkStr && (o.OPERACAO === "DELETE" || o.OPERACAO === "INSERT")
                    );
        });
        obj.showWorkflow(pkStr, res, true);
    };

    QuadWorkFlow.prototype.showWkfBlob = function (mime, value) {
        var obj = this;
        if (value) {
            var mediaStyle = "style=max-width:320px; max-height= 240px;";
            var videoMimeTypes = ["avi", "mpg", "mp4", "ogg", "wmv", "mov"];

            if (mime && videoMimeTypes.indexOf(mime.toLowerCase()) !== -1) {
                return (
                        '<video position="absolute" controls="" autoplay="" name="media" ' +
                        mediaStyle +
                        ' ><source src="' +
                        "data:video/" +
                        mime +
                        ";base64," +
                        value +
                        '"></video>'
                        );
            }
            if (mime && mime.toLowerCase() === "pdf") {
                return (
                        '<embed src= "' +
                        "data:application/" +
                        mime +
                        ";base64," +
                        value +
                        '" ' +
                        mediaStyle +
                        ">"
                        );
            }

            var imgMimeTypes = ["jpg", "jpeg", "png", "svg", "gif", "bmp", "webp"];
            if (mime && imgMimeTypes.indexOf(mime.toLowerCase()) !== -1) {
                return (
                        '<img    src="' +
                        "data:image/*;base64," +
                        value +
                        '"' +
                        mediaStyle +
                        "/>"
                        );
            }
            var audioMimeTypes = ["mp3", "wav", "ac3", "aiff", "wma", "m4a"];
            if (mime && audioMimeTypes.indexOf(mime.toLowerCase()) !== -1) {
                return (
                        '<audio id="testeAudio" position="absolute"  controls="" autoplay="" name="media"' +
                        mediaStyle +
                        '><source src="' +
                        "data:audio/" +
                        mime +
                        ";base64," +
                        value +
                        '"></audio>'
                        );
            }
        }
        return "<img src='" + quadConfig.rhid_no_photo + "' style=\"max-width:250px ;max-height:250px\" />";
    };
    QuadWorkFlow.prototype.showWkfSpinner = function () {
        var obj = this;
        if (obj instanceof QuadForm) {
            //$("." + obj.formId.substring(1) + "_spinner").wrap( "<div class='wkfblink'>loading wkf</div>")
            $("." + obj.formId.substring(1) + "_spinner").show();
        }
        if (obj instanceof QuadTable) {
            //$("." + obj.tableId + "_spinner").wrap( "<div class='wkfblink'>loading wkf</div>")
            $("." + obj.tableId + "_spinner").show();
        }
    };

    QuadWorkFlow.prototype.hideWkfSpinner = function () {
        var obj = this;
        //$(".wkfblink").find("span").remove()
        if (obj instanceof QuadForm) {
            $("." + obj.tableId + "_spinner").hide();
            //$("." + obj.formId.substring(1) + "_spinner").unwrap().hide();
        }
        if (obj instanceof QuadTable) {
            $("." + obj.tableId + "_spinner").hide();
            //$("." + obj.tableId + "_spinner").unwrap().hide();
        }
    };
