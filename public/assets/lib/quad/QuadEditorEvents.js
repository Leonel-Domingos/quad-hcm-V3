    var QuadEditorEvents = function () {};
    QuadEditorEvents.prototype.registerEditorEvents = function () {
        var obj = this;
        // todo este evento podia ser substituido pelo ajax do editor com uma promise ...foi feito assim antes das promises ...fica assim...penso que poderia ser suprimido o copyEditorData se o fizessemos
        obj.editor.on("submitComplete", function (e, data, action) {
            data = obj.fixData(obj.normalizeData(data))["data"][0];
            var rowNode = obj.tbl.row("#" + data.DT_RowId).node();
            /* Se for um EDIT */
            //window.copyEditorData 'é o registo corrente para poder fazer atualização da row na tabela entre outras
            //copyEditorData na sua génese servia para manter sempre uma cópia da chave do registo (id da row), no caso de update de chaves
            if (this.s.action === "edit") {
                /* Atualizamos a row com o id em 'cache', pois pode conter atualização de chaves e logo ainda não constar na tabela o novo ID */
                obj.tbl.row("#" + window.copyEditorData.DT_RowId).data(data);
                $("#" + data.DT_RowId)
                        .fadeIn(500)
                        .fadeOut(500)
                        .fadeIn(500)
                        .fadeOut(500)
                        .fadeIn(500);
                obj.tbl.rows("#" + data.DT_RowId).select();

                obj.editor.close();
            } else if (this.s.action === "create") {
                /* Adicionamos o novo registo aos dados para renderização */
                obj.addRecordToTable(data);

                obj.editor.close();
            } else {
                /* It's a delete. Not used at the moment. Usamos metodo removeRow() . Não temos action DELETE no editor*/
                obj.tbl.row("#" + data.DT_RowId).data(data);
                $("#" + data.DT_RowId)
                        .fadeIn(500)
                        .fadeOut(500)
                        .fadeIn(500);
            }
            obj.operation = "SELECT";

            obj["rowCallback"]
                    ? obj["rowCallback"].apply(obj.tbl.settings()[0].oInstance, [
                rowNode,
                data,
                obj.tbl.rows().count()
            ])
                    : void 0;
            /* !!!!MUITO MUITO IMPORTANTE
             * se EDITOR estiver a processar, deixa de funcionar. Foi muito dificil descobrir . Isto acontece porque não seguimos, para atingir os fins, algumas convenções do EDITOR
             */
            obj.editor._processing(false);
            /* Limpamos os campos/valores que não pertencem á chave e fazemos o mapeamento das relações master detail.
             * Neste momento apenas constam os valores sobre os quais depende, se assim for o caso.
             */
            obj.resetData();
            $(window).trigger("resize");
        });
        obj.editor.on("preSubmit", function (e, data, action) {
            //just safe fallback, not dependent on editor internals.
            //data.data[0] = obj.getNormalizedFrmData("#" + obj.tableId + "_editorForm");
            //CLEAR PREVIOUS ERROR MESSAGES

            $(".editorErrorContainer").remove();
            $(".editorForm")
                    .parents(".modal-content")
                    .find(".modal-header")
                    .addClass("loadingList");

            if (action === "query") {
                return;
            }

            //ANTES de enviar , normalizamos dados se ainda não estiverem no formato que utilizamos
            data = obj.normalizeData(data);

            data = obj.mapComplexLists(data);

            var objectAttr = Object.keys(data.data)[0];
            data.data[objectAttr] = obj.emptyStringToNull(data.data[objectAttr]);
            //por causa de compatibilidade , domains contem descodificacao, devolve-se o ["RV_LOW_VALUE"] outra vez

            //If it is an edition we have to keep the prv values, than we send a copy of dbcolumns to use as a backup and restore when need it
            if (action == "edit") {
                //se for um edit , copiamos os valores atuais e fazemos uma comparação , chamando o prepareData() com mais um parametro, só para fazer a distinção
                //enviamos os dados atuais do form e os dados no registo corrente...para podermos tratar o workflow.
                obj.prepareData(data, obj.dbColumns);
                obj.operation = "UPDATE";
            } else {
                //não é edit, então não precisamos de 'comparar' os dados
                obj.resetData();
                
                obj.prepareData(data);
                obj.manageFiltersData();

                obj.operation = "INSERT";
            }
            //because of no render compatibility mode.
            obj.encodeDomains();

            //QUAD-VALIDATOR
            var dataValida = obj.getValidationData();

            var ok_ = true;

            if (obj.on_pre_submit && action != "query") {
                $.when(obj.isValidOperation(dataValida, action)).done(function (data) {
                    try {
                        var dat = JSON.parse(data);
                        if (dat.msg === "OK") {
                            ok_ = true;
                        } else {
                            $(".editorForm")
                                    .parents(".modal-content")
                                    .find(".modal-header")
                                    .removeClass("loadingList");
                            //PMA:ERROR HANDLING: Create ROW to display DB error
                            if ($("#" + obj.tableId + "_editorForm").length) {
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
                        $(".editorForm")
                                .parents(".modal-content")
                                .find(".modal-header")
                                .removeClass("loadingList");
                        console.log("QUAD-VALIDATOR:" + e);
                        ok_ = false;
                        return false;
                    }
                });
            }

            if (ok_) {
                //reformulamos os dados para enviar para o servidor. Dbcolumns, where_str, operation, etc...
                //informamos o metodo SETDML que é uma query, temos que guardar os filtros e um objecto com o campo e as condições ...
                //obj.setDML(obj.normalizeData(obj.convertToDTRowData(obj.dbColumns)));
                //guardamos por causa do delete....para teremos acesso ao Dt_rowId a apagar/remover da tabela. Está disponivel, quando é preciso , vamos buscar a informação
                //por exemplo no caso de  atualização de chaves de um registo

                window.copyEditorData = obj.convertToDTRowData(obj.dbColumns);
                window.copyEditorData.DT_RowId = obj.composeId(
                        obj.pk.primary,
                        window.copyEditorData
                        );

                obj.editor._processing(false); // very important. if editor.s.processing=true (inner editor stuff) everything breaks, so we force it to false
                if ($("#" + obj.tableId + "_editorForm").valid()) {
                    $("#" + obj.tableId + "_editorForm")
                            .find("em.invalid")
                            .remove();
                    $("#" + obj.tableId + "_editorForm")
                            .find(".state-error")
                            .removeClass("state-error");
                    return true;
                } else {
                    $(".editorForm")
                            .parents(".modal-content")
                            .find(".modal-header")
                            .removeClass("loadingList");
                    return false;
                }
            }
            else {
                return false;
            }
        });
        obj.editor.on("open", function (e, mode, action) {
            $(this.dom.form)[0].reset();
            if (_.find(obj.tableCols, {type: "upload"})) {
                obj.setUpload();
            }
            $(".progress-bar")
                    .css("width", 0 + "%")
                    .attr("aria-valuenow", 0);

            $("." + obj.tableId + "_spinner").show();
            //são passados parametros que residem nativamente em obj.editor.s.editOpts
            //pesquisar no código por ##query
            if (obj.editor.s.editOpts["action"] == "query") {
                obj.editor.s.action = "query";
                action = "query";
            }
            //##rowdt

            if (obj.editor.s.editOpts["rowData"]) {
                var rowData = obj.editor.s.editOpts["rowData"];
                var data = obj.normalizeData(rowData);
            }
            /* Enquanto se acrescentam options em runtime */
            $(this.dom.form).addClass("editorForm");
            $(this.dom.form)
                    .prop("enctype", "multipart/form-data")
                    .prop("encoding", "multipart/form-data");
            /* IMPORTANT , atribuimos um id ao form de acordo com a instancia do object, para podermos validar e identificar o form mais facilmente */
            $(".editorForm").attr("id", obj.tableId + "_editorForm");
            /* Reiniciamos as listas (type=select) */
            $("[dependent-group],:input:not([type=file])", this.dom.form).off("change");
            /* IMPORTANT ... ao abrir form carregamos novamente dados das listas complexas, por causa dos filtros onCreate e OnEdit
             * se atributo DEFERRED existir, não carregamos, esperamos que sejam preenchidos as bind variables.
             */
            if (obj.editor.s.action !== "query") {
                $.each(obj.tableCols, function (i, field) {
                    if (
                            field.attr &&
                            field.attr["dependent-group"] &&
                            field.attr["domain-list"]
                            ) {
                        if (field.renew) {
                            obj.compileDomainRequests(field.attr);
                        }
                    }
                    if (
                            field.complexList &&
                            !field.attr.deferred &&
                            field.attr.filter &&
                            field.attr.filter[action]
                            ) {
                        obj.compileRequests(field, false, action, null);
                    }
                    var el = $(
                            "#" + obj.tableId + "_editorForm" + ' [name="' + field.name + '"]'
                            );
                    if (el.length > 0) {
                        var elementId = el.prop("id");
                        obj.isRequired(
                                $(
                                        "[for=" + elementId.escapeSelector() + "]",
                                        $("#" + obj.tableId + "_editorForm")
                                        ),
                                el
                                );
                    }
                });

                if (
                        obj.domainRequests !== undefined &&
                        Object.keys(obj.domainRequests).length > 0
                        ) {
                    obj.loadDomains(true);
                }

                if (Object.keys(obj.requests).length > 0) {
                    $(".complexList", $("#" + obj.tableId + "_editorForm")).addClass(
                            "loadingList"
                            );
                    $(".chosen-container", $("#" + obj.tableId + "_editorForm")).addClass(
                            "loadingList"
                            );
                    $.when(
                            obj.getListsData(true, action, $("#" + obj.tableId + "_editorForm"))
                            ).then(function (strData) {
                        if (strData && JSON.parse(strData)) {
                            //fazemos override de seleçcõ dos defs do datatables e despoletamos outra vez quando os dados das listas filtradas chegam. Pois arriscamos a não ter os dados
                            //no na 1ª vez que usamos o editor...sem side effects...
                            obj.mapListRequest(
                                    strData,
                                    obj.tableCols,
                                    action,
                                    $("#" + obj.tableId + "_editorForm"),
                                    rowData
                                    );

                            obj.editorOpenRules(action, data, rowData);
                        }
                    });
                } else {
                    obj.editorOpenRules(action, data, rowData);
                }
            }
            if (action !== "query") {
                obj.enableDatePickers(this.dom.form, action);
            } else {
                var frm = this.dom.form;
                setTimeout(
                        function () {
                            //if ($(".datepicker").length > 0) {
                            $(".editorForm")
                                    .find(".datepicker")
                                    .datepicker("destroy");
                            //} else if ($(".dateTimePicker").length > 0) {
                            $(".editorForm")
                                    .find(".dateTimePicker")
                                    .datepicker("destroy");
                            // } else if ($(".dateTimePickerShort").length > 0) {
                            $(".editorForm")
                                    .find(".dateTimePickerShort")
                                    .datepicker("destroy");
                            // } else if ($(".dateTimePickerTimeFormatShort").length > 0) {
                            $(".editorForm")
                                    .find(".dateTimePickerTimeFormatShort")
                                    .datepicker("destroy");
                            // } else if ($(".dateYearMonth").length > 0) {
                            $(".editorForm")
                                    .find(".dateYearMonth")
                                    .datepicker("destroy");
                            // }

                            obj.dataToLists(null, action);

                            obj.syncFiltersAndForm(frm, frm);
                        },
                        1000,
                        frm,
                        data,
                        rowData,
                        action
                        );
            }

            obj.filterVisibleSearchFields();

            //se for uma tabela com documentos , também disponibilizamos no editor...
            if ($(".docsViewer", "#" + obj.tableId).length > 0 && action === "edit") {
                if (obj.docsTable && obj.docsTable.fnName) {
                    $(".DTE_Form_Content", "#" + obj.tableId + "_editorForm").append(
                            '<a class="docsViewer" href="#"><span class="badge badge-primary fCount">' +
                            JSON.parse(rowData[obj.docsTable.fnName])[0].count +
                            "</span>Docs</a>"
                            );
                } else {
                    if (rowData["BD_MIME"]) {
                        $(".DTE_Form_Content", "#" + obj.tableId + "_editorForm").append(
                                obj.getFileIcon(rowData["BD_MIME"])
                                );
                    }
                }
            }
            //se não for uma query, permitimos validação e escondemos os campos com datatype sequence
            if (obj.editor.s.action != "query") {
                obj.validateFrm($("#" + obj.tableId + "_editorForm"), obj.validations);
                $(document).trigger(obj.tableId + "AttachEvt");
                var seqField = _.find(obj.dbColumns, {datatype: "sequence"});
                if (seqField) {
                    var els = $(obj.editor.field(seqField["db"]).dom.container).find("*");
                    $.each(els, function (i, el) {
                        $(el).hide();
                    });
                }
            } else {
                $(document).trigger(obj.tableId + "AttachEvt"); //PMA 2019.06.06: Caso contrário se pretender manipular os conteúdos do Editor em modo QUERY não o consigo!!!
                //QUERY mode: IF Column is sequence, hidden from editor, and visible on datatable, then show it on Editor for querying purposes.
                var seqField = _.find(obj.dbColumns, {datatype: "sequence"});
                if (seqField) {
                    var ob = _.find(obj.tableCols, {data: seqField["db"]});
                    if (ob["visible"] !== false) {
                        $(obj.editor.field(seqField["db"]).dom.container).removeClass(
                                "DTE_Field_Type_hidden"
                                );
                        var els = $(obj.editor.field(seqField["db"]).dom.container).find("*");
                        $.each(els, function (i, el) {
                            $(el).hasClass("multi-value") || $(el).hasClass("multi-restore")
                                    ? $(el).hide()
                                    : $(el).show();

                            if ($(el).attr("for") === "DTE_Field_" + ob.name) {
                                $(el)
                                        .empty()
                                        .append(_.find(obj.tableColsCopy, {data: ob.data})["label"]);
                            }
                        });
                    }
                }
            }
            obj.acl("#" + obj.tableId + "_editorForm");
            //depois de tudo carregado, registamos eventos para filtragem de listas e tudo subsequente(preenchimento binds, etc...)
            setTimeout(function () {
                /*  var ev = $._data($("#" + obj.tableId + "_editorForm").get(0), 'events');
                 if (ev && !ev.bindChangeEvent) {*/
                $("#" + obj.tableId + "_editorForm").trigger("bindChangeEvent", [
                    {
                        action: obj.editor.s.action
                    }
                ]);
                //}
                $.each($(".chosen", "#" + obj.tableId + "_editorForm"), function (
                        i,
                        element
                        ) {
                    $(element).trigger("mouseover");
                });
                obj.hideSpinner();
            }, 0);
        });
        obj.editor.on("close", function (e, data, action) {
            /* Function parameters, not used: e, data, action */
            /* Ao fecharmos o form, fazemos um reset aos estados de algumas propriedades e limpamos mensagens de erro, etc...
             * o editor não faz reset ao form quando se fecha a janela!!!!
             */
            $(".modal-header").removeClass("loadingList");
            $(".chosen", this.dom.form).chosen("destroy");
            $(".datepicker").off("change");
            $(".datepicker").removeAttr("data-previous");
            quad_notification_clear();
            $(".editor_upload")
                    .find(".divUploadFile,img")
                    .remove();
            if (obj.editor.frmData) {
                delete obj.editor.frmData;
            }
            if (obj.editor.s.action && obj.editor.s.action !== "query") {
                obj.resetData();
            }
            $("select", "#" + obj.tableId + "_editorForm").empty();
            obj.editor._processing(false);
            //obj.operation = "SELECT";
            var validator = $("#" + obj.tableId + "_editorForm").validate();
            if (validator) {
                validator.destroy();
            }
            $("#" + obj.tableId + "_editorForm .chosen").chosen("destroy");
            $("#" + obj.tableId + "_editorForm .required").removeClass("required");
            /* POST-SAVE on Editor: evento a executar APÓS save do editor */
            if (obj.editor.s.action === "edit" || obj.editor.s.action === "create") {
                $(document).trigger(obj.tableId + "AttachEvtClose");
            }
            //obj.editor.s.action = "";
            //PMA, 2019.11.21 :
            if (obj.footerCallback) {
                obj.footerCallback();
            }
        });

        $(document).on("bindChangeEvent", "#" + obj.tableId + "_editorForm", function (
                e,
                evtData
                ) {

            $(".complexList, input, select", "#" + e.target.id).on(
                    "change",
                    {
                        currentForm: $("#" + e.target.id),
                        action: evtData.action
                    },
                    function (evt) {
                        evt.stopImmediatePropagation();
                        obj.frmElemChange(
                                evt.data.currentForm,
                                $(evt.target),
                                evt.data.action,
                                true
                                );
                    }
            );
        });
    };
