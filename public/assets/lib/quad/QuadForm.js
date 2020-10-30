    var QuadForm = function () {};
    QuadForm.prototype.constructor = QuadForm;
    QuadForm.prototype = $.extend(
            {},
            QuadEvents.prototype,
            QuadCore.prototype,
            QuadList.prototype,
            QuadWorkFlow.prototype
            );

    QuadForm.prototype.loadDomainsForm = function (frm, async) {
        var obj = this;
        return $.Deferred(function () {
            var self = this;
            $.each(obj.domainLists, function (name, attributes) {
                obj.compileDomainRequests(attributes);
                obj.hideSpinner();
            });
            if (
                    obj.domainRequests !== undefined &&
                    Object.keys(obj.domainRequests).length > 0
                    ) {
                $.when(obj.loadDomains(async)).then(function () {
                    obj.populateDomainLists(frm, null);
                    self.resolve();
                });
            } else {
                self.resolve();
            }
        });
    };

    QuadForm.prototype.loadForm = function (frm) {
        var obj = this;
        obj.currentRecord = 0;

        //Activate toolbar
        $(".btn-toolbar", frm).css("display", "block");
        $("a[data-form-action]", frm).hide();

        obj.getForm(frm);

        obj.disableFields(frm);

        obj.hideExternalKeyFields();

        obj.workMode(frm, "standby");
        obj.myData["data"] = [];
        obj.totalRecords = 0;
        obj.operation = "SELECT";
        if (obj.complexLists) {
            obj.loadComplexListsForm(frm, false, "", false);
        }
        if (obj.domainLists) {
            $.when(obj.loadDomainsForm(frm, true)).then(function () {
                if (obj.externalFilter) {
                    if (
                            obj.externalFilter.templateMulti &&
                            !$(obj.externalFilter.templateMulti.selector).hasClass("extendedForm")
                            ) {
                        //its not inicialized before

                        obj.externalMultiFilterInit(
                                obj.externalFilter.templateMulti.selector
                                );
                    }
                    if (
                            obj.externalFilter.template &&
                            !$(obj.externalFilter.template.selector).hasClass("extendedForm")
                            ) {
                        //its not inicialized before
                        obj.externalFilterInit(obj.externalFilter.template.selector);
                    }

                    //return;
                } else {
                    obj.isMasterIsDetail(frm);
                }
            });
        } else {
            obj.isMasterIsDetail(frm);
        }

        obj.enableDatePickers(frm, null);
    };

    QuadForm.prototype.newDbColumnEntry = function (name) {
        var obj = this;
        var colStr = {
            db: name,
            prv_value: "",
            nxt_value: ""
        };
        if (_.find(obj.dbColumns, {db: name}) === undefined) {
            obj.dbColumns.push(colStr);
        }
    };

    QuadForm.prototype.mapHiddenFields = function () {
        var obj = this;
        var colStr = "";
        _.forEach(this.pk.primary, function (i, field) {
            colStr = {
                db: field,
                prv_value: "",
                nxt_value: ""
            };
            if (_.find(obj.dbColumns, {db: field}) === undefined) {
                if (
                        field.type &&
                        (field.type.toLowerCase() === "date" ||
                                field.type.toLowerCase() === "datetime" ||
                                field.type.toLowerCase() === "datetimeshort")
                        ) {
                    colStr["datatype"] = field.type;
                }
                obj.dbColumns.push(colStr);
            }
        });

        _.forEach(obj.complexLists, function (o, n) {
            if (o["distribute-value"]) {
                _.forEach(
                        o["distribute-value"]
                        .replace(quadConfig.regExpressions.alias, "")
                        .split("@"),
                        function (name, i) {
                            obj.newDbColumnEntry(name);
                        }
                );
            } else {
                _.forEach(
                        o["data-db-name"]
                        .replace(quadConfig.regExpressions.alias, "")
                        .split("@"),
                        function (name, i) {
                            obj.newDbColumnEntry(name);
                        }
                );
            }
        });
        if (this.dependsOn) {
            _.forEach(this.dependsOn, function (o, master) {
                var field = Object.keys(o)[0];
                obj.newDbColumnEntry(field);
            });
        }

        if (obj.dateFields) {
            _.forEach(obj.dateFields, function (type, name) {
                var col = _.find(obj.dbColumns, {db: name});
                if (col) {
                    col["datatype"] = type;
                }
            });
        }
    };
    QuadForm.prototype.initForm = function (parms) {
        // Inicialização: identifica form, limpa interface, inicializa preferências e estrutura com DB columns declaradas no form
        // ----------------------------------------------------------------------------------------------------------------------
        // formMainDiv: div container onde constem as TABS se aplicável
        // controllerFileName: programa ajax que devolve dados (controlleer filename)
        // showMultiRecord: Toolbar, inicialização de multiRecord. Se true mostra PREVIOUS e NEXT RECORD buttons. Caso contrário, inibe-os!
        // workflow: Sinaliza ocorrências (colunas) em workFlow?
        // showHideDisabled: Toolbar, inicialização de navButtonsMode
        // defaultNavMode: Toolbar, inicialização de navInitWorkMode
        // this.formAttributes.refreshRecord: Após DML em setDbData(), efetua SELECT devolvendo resultado para interface?
        // ----------------------------------------------------------------------------------------------------------------------
        $.extend(this, parms);
        var obj = this;
        var frm = obj.formId;
        var toolbarElements =
                '<div class="btn-toolbar">' +
                '<ul name="toolbar" class="quad-btns quad-center">' +
                "<li>" +
                extBut +
                "</li>" +
                '<li><a title="' +
                JS_QUERY +
                '" class="btn btn-sm btn-primary quad-left-margin-2 waves-effect waves-themed" data-form-action="enter-query" data-action-scope="local" ><i class="fas fa-filter"></i></a></li>' +
                '<li><a title="' +
                JS_QUERY_EXECUTE +
                '" class="btn btn-sm btn-primary quad-left-margin-2 waves-effect waves-themed" data-form-action="execute-query" data-action-scope="local" ><i class="fas fa-database"></i></a></li>' +
                '<li><a title="' +
                JS_CANCEL +
                '" class="btn btn-sm btn-secondary quad-left-margin-2 waves-effect waves-themed" data-form-action="cancel" data-action-scope="local"><i class="fas fa-undo-alt"></i></a></li>' +
                '<li><a title="' +
                JS_EDIT +
                '" class="btn btn-sm btn-primary quad-left-margin-2 waves-effect waves-themed" data-form-action="edit" data-action-scope="local"><i class="fas fa-edit"></i></a></li>' +
                '<li><a title="' +
                JS_CREATE +
                '" class="btn btn-sm btn-success quad-left-margin-2 waves-effect waves-themed" data-form-action="new" data-action-scope="local"><i class="fas fa-plus"></i></a></li>' +
                '<li><a title="' +
                JS_SAVE +
                '" class="btn btn-sm btn-success quad-left-margin-2 waves-effect waves-themed" data-form-action="save" data-action-scope="local"><i class="fas fa-check"></i></a></li>' +
                '<li><a title="' +
                JS_DELETE +
                '" class="btn btn-sm btn-danger quad-left-margin-2 waves-effect waves-themed" style="width: 26px;" data-form-action="delete" data-action-scope="local"><i class="fas fa-times"></i></a></li>' +
                '<li><a title="' +
                JS_PREVIOUS +
                '" class="btn btn-sm btn-primary quad-left-margin-2 waves-effect waves-themed" data-form-action="previous" data-action-scope="local"><i class="fas fa-chevron-left"></i></a></li>' +
                '<li><a title="' +
                JS_NEXT +
                '" class="btn btn-sm btn-primary quad-left-margin-2 waves-effect waves-themed" data-form-action="next" data-action-scope="local"><i class="fas fa-chevron-right"></i></a></li>' +
                '<li class="qryResults"><span  title="Current record / Total records" class="recordsNav badge bg-color-greenLight pull-right inbox-badge quad-right"></span></li>' +
                " </ul>" +
                " </div>";
        $("form-toolbar", frm).html(toolbarElements);
        $(frm)
                .find("a[data-form-action]")
                .hide();
        obj.dbColumns = obj.dbColumns || [];
        obj.myData = obj.myData || [];
        //$(obj.formId).find(":input[type!=file]:not(.exportForm)").each(function () {

        //PMA: EXCLUDE CONTROL
        $(obj.formId)
                .find(":input")
                .each(function () {
                    var db_col = $(this).attr("name"); //Nome da coluna de BD definida no interface no atributo: "data-db-name"
                    var db_prv = ""; //Valor da coluna na base de dados
                    var db_nxt = ""; //Valor da coluna no interface. Os valores por defeito não são "transferidos", uma vez que só com o "COMMIT" todos os campos serão lidos.
                    // var ok = true;   //Permite verificar se a coluna já existe no objecto (so a inserindo se ok=true). Necessário para os radio, que repetem o nome da mesma coluna por cada opção.
                    if (db_col !== undefined) {
                        // Verifica se a COLUNA já consta no array
                        /*for (var i in obj.dbColumns) {
                         if (db_col == obj.dbColumns[i]["db"]) {
                         ok = false;
                         return;
                         }
                         }*/
                        // Verifica se o USER pode aceder à COLUNA
                        //Nos radio existem tantas colunas com o mesmo nome quantas as opções. Só carrega uma vez o nome da coluna...
                        //  if (ok) {
                        //index = index + 1;
                        //Elemento composto por DB (nome da coluna na tabela) + PRV_VALUE (conteúdo da coluna na BD) + NXT_VALUE (conteúdo da coluna no interface) + DIAGNOSTIC (conteúdo de column workflow)
                        colStr = {
                            db: db_col,
                            prv_value: db_prv,
                            nxt_value: db_nxt,
                            title: $("label[for='" + $(this).attr("name") + "']").text()
                        };
                        //obj.formId.find("["+obj.dbColAttr+"=" + db_col + "]")
                        if ($(this).data("datatype")) {
                            colStr["datatype"] = $(this).data("datatype");
                        }
                        if ($(this).data("func")) {
                            colStr["funcField"] = $(this).data("func");
                        }
                        var o = _.find(obj.complexLists, {name: $(this).attr("name")});
                        if (obj.complexLists && o && !o.inTable) {
                            return;
                        }
                        if (obj.exclude) {
                            if (_.includes(obj.exclude, db_col)) {
                                //PMA :: SECURITY CONTROL
//            $(this)
//              .css({ opacity: 0.5, color: "blue" })
//              .prop("disabled", true);

                                if (db_col !== quadConfig.columnBDColumn) {
                                    //EXCEPT DB. DOC. COLUMN FOR ALL OTHERS ACCESS IS VISIBLE DISABLED
                                    var el = $(this);
                                    if ($("span." + el.attr("NAME")).length === 0) {
                                        $(
                                                '<span class="disableInputAccessClone far fa-user-lock ' +
                                                el.attr("NAME") +
                                                '" data-toggle="tooltip" data-placement="auto" data-delay="{ &quot;show&quot;: 350, &quot;hide&quot;: 100 }"  data-original-title="' +
                                                JS_ACCESS_DENIED +
                                                '"></span>',
                                                {tooltip: JS_ACCESS_DENIED}
                                        )
                                                .insertAfter(el)
                                                .tooltip({
                                                    template:
                                                            '<div class="tooltip noAccess" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                                                });
                                        $(el).remove();
                                    }
                                }
                                return;
                            } else {
                                $(this)
                                        .css("opacity", 1)
                                        .prop("disabled", false);
                            }
                        }
                        //} else {
                        obj.dbColumns.push(colStr);
                    }
                    var el = $('[name="' + $(this).attr("name") + '"]', frm);
                    obj.isRequired($('[for="' + el.prop("name") + '"]', frm), el);
                });

        obj.mapHiddenFields();

        if (obj.domainLists) {
            $.each(obj.domainLists, function (name, attributes) {
                $.each(attributes, function (key, value) {
                    $("[name=" + name + "]", frm).attr(key, value);
                });
            });
        }
        if (obj.complexLists) {
            $.each(obj.complexLists, function (name, attributes) {
                var el = $("[name=" + name + "]", frm);
                $.each(attributes, function (key, value) {
                    if (key === "filter" && value) {
                        el.attr(key, JSON.stringify(value));
                    } else {
                        el.attr(key, value);
                    }
                    el.addClass("complexList");
                });
            });
        }
        obj.spinner =
                "<img class='" +
                obj.formId.substring(1) +
                "_spinner tableSpinner' src='"+ pn + quadConfig.loading_img + "'>";
        $(obj.formId).prepend(obj.spinner);
        obj.hideSpinner();
        $(obj.formId).prepend(
                '<ul class="list-inline ' + obj.formId.substring(1) + '_sFilters"></ul>'
                );
        if (obj.refreshData !== false) {
            $(obj.formId + " > .btn-toolbar").append(
                    '<a id="refresh_' +
                    obj.formId.substring(1) +
                    '" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed refresh"><i class="fas fa-sync"></i></a>'
                    );
            $("#refresh_" + obj.formId.substring(1)).on("click", function (e) {
                e.stopImmediatePropagation();
                delete obj.wkf;
                obj.startIn = 0;
                obj.operation = "SELECT";
                $("." + obj.formId.substring(1) + "_spinner").show();
                if (obj.complexLists) {
                    obj.loadComplexListsForm(frm, true);
                }
                if (obj.domainLists) {
                    $.when(obj.loadDomainsForm(frm, true)).then(function () {
                        console.log("got it");
                    });
                }
debugger;
                obj.isMasterIsDetail(frm);
            });
        }
        this.checkUserPreferences();
        if (obj.order === undefined) {
            obj.order = true; //Requires view <TABLE_NAME>_VW
        }

        obj.orderButtonHighligth();
        if (!this.dependsOn && obj.instanceVisible($(obj.formId))) {
            setTimeout(function () {
                obj.loadForm(frm);
            }, 0);
        } else if (obj.instanceVisible($(obj.formId))) {
            setTimeout(function () {
                obj.loadForm(frm);
            }, 0);
        }
        this.buttonManagerCentralized($(obj.formId));
        if ($("input:file", frm)) {
            $("input:file", frm).css("display", "none");
            this.setUpload(frm, $("input:file", frm));
        }
        setTimeout(function () {
            if (obj.order) {
                obj.sortOrder(obj.formId.substring(1));
            }
        }, 0);
    };

    QuadForm.prototype.b64toBlob = function (b64Data, contentType, sliceSize) {
        contentType = contentType || "";
        sliceSize = sliceSize || 512;

        var byteCharacters = atob(b64Data);
        var byteArrays = [];

        for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            var slice = byteCharacters.slice(offset, offset + sliceSize);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);

            byteArrays.push(byteArray);
        }

        var blob = new Blob(byteArrays, {type: contentType});
        return blob;
    };

    QuadForm.prototype.setUpload = function (frm, el) {
        var obj = this;
        $("input[type=file]", frm).on("change", function (e) {
            e.stopImmediatePropagation();
            obj.frmData = new FormData();

            obj.frmData.append("upload[]", this.files[0]);
            obj.frmData.append("filenames[]", this.files[0].name);
            if (obj["inRowDoc"]) {
                if (!obj.frmData) {
                    obj["frmData"] = new FormData();
                }
                obj.frmData.append("inRowDoc", JSON.stringify(obj["inRowDoc"]));
            }
            $(e.currentTarget).after(
                    '<div class="divUploadFile"><span class="spanFileName badge badge-light">' +
                    this.files[0].name +
                    '<i class="fas fa-times fa-2x faFileRemove pull-right"></i><div/>'
                    );
        });

        $(document).on("click", "#saveFileForm", function (e, data) {
            e.stopImmediatePropagation();

            obj["srcs"] = obj["srcs"] || [];

            obj["srcs"].push(data.file);
            $("img:not(.tableSpinner)", obj.formId).attr(
                    "src",
                    (URL || webkitURL).createObjectURL(data.file)
                    );

            var form = document.getElementById(obj.formId.substring(1));
            obj.frmData = new FormData(form);
            obj.frmData.append("upload[]", data.file);
            obj.frmData.append("filenames[]", data.file.name);
        });
        $(".docsViewer").on("click", ".apagaImg", function (e) {
            e.stopImmediatePropagation();

            obj["srcs"] = [];
            $("img:not(.tableSpinner)", obj.formId).attr(src, quadConfig.rhid_no_photo);
            $(".docsViewer", obj.formId)
                    .find(".undo")
                    .remove();
            obj["srcs"].push(file);
            obj.frmData = new FormData(form);
            obj.frmData.append("upload[]", file);
            obj.frmData.append("filenames[]", file.filename);
        });
        $(document).on("click", obj.formId + " a.docsViewer.inRow", function (e) {
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
        });
    };
    QuadForm.prototype.externalFilterChange = function (
            frm,
            instanceForm,
            obj,
            evtData
            ) {
        var obj = this;
        if ($(frm).hasClass("multiInstance")) {
            // return;
        }
        $(document).one("mouseover", frm, function (evt, evtData) {
            //Evento de alteração de valores de uma instância com ou sem editor/filtro
            $(frm).on(
                    "change",
                    ".complexList, input:not(.chosen-search-input), select",
                    {
                        currentForm: frm,
                        evtData: evtData
                    },
                    function (e, evtdata) {
                        $(frm)
                                .find(".alert")
                                .remove();
                        e.stopImmediatePropagation();
                        obj.filterInstance($(this));
                    }
            );
        });
    };

    QuadForm.prototype.externalFilterFieldsVisibility = function (frm) {
        var obj = this;
        obj.getFiltersFormsData().forEach(function (d) {
            if (d.value) {
                obj.hideThisColumn(frm, d.name);
            } else {
                obj.showThisColumn(frm, d.name);
            }
        });
    };

    QuadForm.prototype.externalFilterInit = function (frm) {
        var obj = this;
        var form = obj.externalFilter.template.selector;
        obj.populateDomainLists(form, null);
        obj.externalFilterChange(form, frm, obj, {submit: false});
        $(form).trigger("mouseover", {submit: false});
        $.each($(form).find(':input:not(".chosen-search-input")'), function (
                i,
                field
                ) {
            if (field.attributes["domain-list"]) {
                obj.populateDomainLists(form, null);
            }
            if (field.attributes["dependent-level"]) {
                var o = _.find(
                        obj.complexLists ? obj.complexLists : quadConfig.loadData,
                        {
                            "data-db-name": $(field).attr("data-db-name"),
                            name: $(field).attr("name")
                        }
                );
                var data = obj.normalizeData(obj.getNormalizedFrmData(form));
                data = obj.mapComplexLists(data);
                obj.prepareData(data);

                obj.fillComplexList(o, form, "editorXt", data, "create");
            }
            //todo signal required based on validations
            obj.signalMandatoryFilters(form, obj.externalFilter.template, field);

            //end todo
            if ($(field).data("def") || $(field).val()) {
                if ($(field).val() === "") {
                    $(field).val($(field).data("def"));
                }
                $(field).trigger("change", [
                    {
                        submit: true,
                        refreshFilters: false
                    }
                ]);
            }
        });
    };
    QuadForm.prototype.getForm = function (frm) {
        // Esta função recebe o ID do widget onde consta o TAB de acesso aos dados (this.containerId), identificando a TAB ATIVA (" ul.nav > li.active").
        // Espera encontrar no atributo definido em "dataForm" da opção ativa o form onde constam os dados: identificando assim o FORM ACTIVO!

        var obj = this;
        obj.editor = obj.editor || {};
        obj.editor.s = obj.editor.s || {};
        obj.editor.s.action = obj.editor.s.action || {};
        obj.editor.s.action = "edit";
        $(frm).on("click", "a[data-form-action]", function (e) {
            e.stopImmediatePropagation();
            //obj.getName(obj.formId);
            obj.buttonPressed($(this));
        });

        $(frm).on("bindChangeEvent", function (e, operation) {
            /* IMPORTANTE só registamos o change das listas complexas quando MOUSEOVER sobre form, ao contrario o processo de filtragem inicial disparava este evento
             * acarretando problemas com a inconsistência dos dados refletidos nos dropdowns
             */
            $($(this)).on(
                    "change",
                    ".complexList, input, select",
                    {
                        currentForm: $(this),
                        operation: operation
                    },
                    function (e) {
                        e.stopImmediatePropagation();
                        obj.frmElemChange(e.data.currentForm, $(this), e.data.operation, true);
                    }
            );
        });
    };
    QuadForm.prototype.showThisColumn = function (frm, dbcolumn) {
        //Esta função chamada do clearForm, de acordo com o definido por userRestriction, permite esconder os campos de input sinalizados.
        //A coluna a esconder é passada no parâmetro dbColumn.
        var frmObj;
        if (dbcolumn != "") {
            var colToShow = $(frm).find("[name=" + dbcolumn + "]");
            colToShow.show();
            var labelToshow = $(frm).find("[for=" + dbcolumn + "]");
            labelToshow.show();
        }
        this.showFieldset();
    };
    QuadForm.prototype.showFieldset = function () {
        console.log("todo develop hidefieldset method");
    };
    QuadForm.prototype.hideFieldset = function () {
        //Esta função chamada no final do clearForm, verifica se TODOS os input em cada FIELDSET estão escondidos, circustância na qual
        //esconde todo os conteúdos desse fieldset (legendas e rows).
        var tot, hidden;
        legendObj = $(this.formId).find("legend");
        //alert( legendObj.length + " " + legendObj.parent('fieldset').length );
        legendObj.parent("fieldset").each(function () {
            //legenda = $(this).find("legend").text();
            tot = 0;
            hidden = 0;
            $(this)
                    .find("div.row")
                    .each(function () {
                        tot = tot + $(this).find(":input[type!=file]").length;
                        hidden =
                                hidden +
                                $(this).find(':input[type!=file][style*="display: none"]').length;
                    });
            //Elementos do fieldset estão todos escondidos?
            //Se sim, esconde TODO o fieldset (legenda incluída)
            if (tot === hidden) {
                $(this).hide();
            }
        });
    };
    QuadForm.prototype.clearForm = function (frm) {
        //Esta função limpa todos os atributos de BD referenciados num FORM, enquanto popula um array com os nomes dessas colunas.
        //Se tipo != 'QRY', assume-se que os valores por defeito devem ser inicializados (aplica-se no NEW record). Caso contrário, assume-se
        //modo ENTER-QUERY em que os valores por defeito não se devem aplicar.
        //var index = -1;
        var obj = this;
        //obj.dbColumns = [];
        //Se houver ERROS associados a campos do interface, devem ser apagados..
        $(".editorErrorContainer", frm).remove();
        $(frm)
                .find("div.state-error")
                .removeClass("state-error");
        $(frm)
                .find("em.invalid")
                .remove();
        this.clearAlerta(frm);
        //Inicialização dos campos de (eventual) consulta anterior
        try {
            $(frm)[0].reset();
            $("input[type=hidden]", frm).val("");
            $("video,embed,audio", frm).remove();
            $("img", frm)
                    .not(".tableSpinner")
                    .attr("src", quadConfig.rhid_no_photo);
        } catch (e) {
            null;
            console.log("catch returnning null :(");
        }

        //Depois de esconder as colunas, verifica se se devem esconder os FIELDSETS (LEGENDS e ROWS) se TODOS os atributos estiverem ESCONDIDOS do utilizador
        this.hideFieldset();
        obj.clearWorkFlow(frm);
    };

    QuadForm.prototype.enableFields = function (frm, query) {
        var obj = this;
        //Permite centralizadamente ACTIVAR todos campos de INPUT do FORM
        query = query || null;
        $(frm)
                .find(":input")
                .removeAttr("disabled readonly");
        if (obj.exclude) {
            _.forEach(obj.exclude, function (name, i) {
                $(frm)
                        .find("[name='" + name + "']")
                        .attr("disabled", "disabled");
            });
        }
        $(".chosen").trigger("chosen:updated");
        //$(frm).find(":input").removeAttr("readonly");
        if (!query) {
            $(frm)
                    .find(".datepicker,.dateTimePicker,.dateTimePickerShort")
                    .removeAttr("disabled");
        }
    };
    QuadForm.prototype.disableFields = function (frm) {
        //Aplica a INIBIÇÃO de todos os campos do interface, excepto: TOOLBAR e ALERTA(s)

        $(frm)
                .find(".hasDatepicker")
                .removeClass("hasDatepicker");
        $(frm)
                .find(".datepicker,.dateTimePicker,.dateTimePickerShort")
                .attr("disable", "disabled");
        $(frm)
                .find(":input:not(.exportForm)")
                .attr({readonly: 1, disabled: 1});
        $(frm)
                .find("select")
                .prop("disabled", 1)
                .trigger("chosen:updated");
        $(".chosen", frm).chosen("destroy");
        //Excepto botões associados a TOOLBAR
        $(frm)
                .find(".btn-toolbar")
                .find("button")
                .removeAttr("disabled");
        //... e botões associados a ALERTAS
        $(frm)
                .find("[data-dismiss=alert]")
                .removeAttr("disabled");
    };
    QuadForm.prototype.alerta = function (titulo, tipo, _msg) {
        //Procedimento de alertas para o FORM
        switch (tipo) {
            case "warning":
                if (titulo == "") {
                    titulo = "<?php  $ui_warning; ?>";
                }
                classe = tipo;
                icon = "warning";
                break;
            case "success":
                if (titulo == "") {
                    titulo = "<?php  $ui_success; ?>";
                }
                classe = tipo;
                icon = "check";
                break;
            case "error":
                if (titulo == "") {
                    titulo = "<?php  $ui_error; ?>";
                }
                classe = "danger";
                icon = "times";
                break;
            default:
                //info
                tipo = "info";
                if (titulo == "") {
                    titulo = "<?php  $ui_information; ?>";
                }
                classe = tipo;
                icon = "info";
                break;
        }
        var _html =
                '<div class="alert alert-' +
                classe +
                ' fade in"> ' +
                '    <i class="fa-fw fa fa-' +
                icon +
                '"></i> ' +
                "    <strong>" +
                titulo +
                ": </strong> " +
                _msg +
                " ";
        '    <button class="close" data-dismiss="alert">x</button> ' + "</div> ";
        if (_msg != null) {
            $(this.formId)
                    .find(".quad-alert")
                    .html(_html);
        }
    };
    QuadForm.prototype.clearAlerta = function (frm) {
        $(frm)
                .find(".quad-alert")
                .html("")
                .removeClass("alert alert-warning fade in");
    };
    QuadForm.prototype.workMode = function (frm, modo) {
        var obj = this;
        if (
                modo === "next" ||
                modo === "previous" ||
                modo === "cancel" ||
                modo === "save"
                ) {
            obj.acl(frm);
            return;
        }
        $(frm)
                .find("a[data-form-action]")
                .hide();
        //TODO navQueryOnly  force always query only mode
        $(frm)
                .find("a[data-form-action=save]")
                .removeAttr("operation");

        if (modo === "" || modo === undefined) {
            modo = "standby";
        }
        //Como o botão NEW cria no SAVE o atributo (INSERT) e o botão EDITO cria no SAVE o atributo (UPDATE)
        // reinicializamos entre chamadas.
        if (modo == "enter-query") {
            $(frm)
                    .find(
                            "a[data-form-action=edit],a[data-form-action=new],a[data-form-action=delete]"
                            )
                    .hide();
            $(frm)
                    .find("a[data-form-action=execute-query],a[data-form-action=cancel]")
                    .show();
            obj.enableFields(frm, "query");
        } else if (modo == "execute-query") {
            $(frm)
                    .find("" + "a[data-form-action=new]")
                    .show();
            obj.editorAction = "query";
        } else if (modo == "on") {
            $(frm)
                    .find("a[data-form-action]")
                    .removeAttr("disabled");
        } else if (modo == "show") {
            $(frm)
                    .find("a[data-form-action]")
                    .removeAttr("disabled");
            $(frm)
                    .find("a[data-form-action]")
                    .show();
        } else if (modo == "hide") {
        } else if (modo == "standby") {

            this.resetButtonsState(frm, undefined, undefined);
            $(frm)
                    .find("a[data-form-action=edit]")
                    .hide();
        } else if (modo == "new") {
            obj.resetButtonsState(frm, 0, obj.currentRecord, modo);
            $(frm)
                    .find("a[data-form-action=cancel]")
                    .show();
            $(frm)
                    .find("a[data-form-action=save]")
                    .show();
            $(frm)
                    .find("a[data-form-action=enter-query]")
                    .hide();
            obj.hideActionButtons(frm);

            //O botão NEW cria no SAVE o atributo OPERATION=INSERT de modo a que o SAVE o passe para o controlador
            $(frm)
                    .find("a[data-form-action=save]")
                    .attr("operation", "INSERT");
            obj.operation = "INSERT";
            obj.actionToEditor("create");

            //mapear como se fosse quatable editor action para funcionar nas listas complexas defereend, bindvalues, etc...
        } else if (modo == "edit") {
            $(frm)
                    .find("a[data-form-action=enter-query]")
                    .hide();

            $(frm)
                    .find("a[data-form-action=edit]")
                    .hide();
            obj.hideActionButtons(frm);

            $(frm)
                    .find("a[data-form-action=save]")
                    .show();
            $(frm)
                    .find("a[data-form-action=cancel]")
                    .show();
            $(frm)
                    .find("a[data-form-action=delete]")
                    .show();
            //O botão EDIT cria no SAVE o atributo OPERATION=UPDATE de modo a que o SAVE o passe para o controlador
            $(frm)
                    .find("a[data-form-action=save]")
                    .attr("operation", "UPDATE");
            obj.operation = "UPDATE";

            obj.actionToEditor("edit");

            //mapear como se fosse quatable editor action para funcionar nas listas complexas defereend, bindvalues, etc...
            if (quadConfig.env == "prod") {
                obj.hideExternalKeyFields();
            }
        }
        obj.acl(frm);
    };

    QuadForm.prototype.hideActionButtons = function (frm) {
        $(frm)
                .find("a[data-form-action=new]")
                .hide();
        $(frm)
                .find("a[data-form-action=next]")
                .hide();
        $(frm)
                .find("a[data-form-action=previous]")
                .hide();
    };

    QuadForm.prototype.buttonPressed = function (el) {
        var obj = this;
        //var frm = $(el).closest('form.formQuadForm');
        var frm = $(obj.formId);
        //Procedimento responsável por encaminhar a resposta por ação sobre um botão da Toolbar (el)
        var _operation = el.attr("data-form-action");
        if (_operation !== undefined) {
            if (obj.formEvents(_operation, frm, el) === false) {
                null;
            } else {
                obj.workMode(frm, _operation);
            }
        } else {
            alert(
                    "No data-form-action defined for this button. Please contact support."
                    );
        }
    };

    QuadForm.prototype.navigate = function (direction, frm, el) {
        var obj = this;

        el.attr("disabled", false);
        $("a[data-form-action=previous],a[data-form-action=next]", frm).attr(
                "disabled",
                false
                );
    };

    QuadForm.prototype.setDefaultButtons = function (frm, defaultButtons) {
        var obj = this;
        $(frm)
                .find("a[data-form-action]")
                .hide();
        $.each(defaultButtons, function (i, item) {
            $(frm)
                    .find("a[data-form-action=" + item + "]")
                    .show();
        });
        obj.isMultiFilteredInstance(frm);
    };
    QuadForm.prototype.isMultiFilteredInstance = function (frm) {
        if (
                this.externalFilter &&
                this.externalFilter.templateMulti &&
                $(this.externalFilter.templateMulti).hasClass("multiInstance")
                ) {
            var formData = $(
                    this.externalFilter.templateMulti.selector
                    ).serializeArray();
            _.remove(formData, {value: ""});
            _.remove(formData, {value: null});
            if (formData.length === 0) {
                $(frm)
                        .find("a[data-form-action=new]")
                        .show();
            }
        }
    };
    QuadForm.prototype.resetButtonsState = function (
            frm,
            recordCount,
            recNumber,
            operation
            ) {
                var obj=this;
        operation = operation || null;
        if (operation === "new") {
            $(".qryResults", $(frm)).hide();
        } else {
            $(".qryResults", $(frm)).show();
        }
        recNumber = recNumber + 1;

        if (!this.detailsObjects && !this.dependsOn) {
            this.setDefaultButtons(frm, this.defaultButtons);
            this.checkNavStatus(frm, recordCount, recNumber);
        }
        if (this.detailsObjects || (this.dependsOn && this.totalRecords > 0)) {
            this.setDefaultButtons(frm, this.defaultButtons);
            this.checkNavStatus(frm, recordCount, recNumber);
        } else if (this.dependsOn && this.totalRecords <= 1) {
            this.setDefaultButtons(frm, this.defaultButtons);
            _.mapKeys(this.dependsOn, function (value, key) {
                if (window[key] instanceof QuadForm) {
                }
                if (window[key] instanceof QuadTable) {
                    setTimeout(function () {
                        var anyRowSelected =
                                window[key].tbl.rows(".selected").indexes().length === 0
                                ? false
                                : true;
                        if (anyRowSelected) {
                            $(frm)
                                    .find("[data-form-action=new]")
                                    .show();
                        }
                        obj.acl(frm,true);
                    }, 1000);
                }
            });
        }
    };

    QuadForm.prototype.checkNavStatus = function (frm, totalRecords, currentRecord) {
        if (this.showMultiRecord === false) {
            $(frm)
                    .find("a[data-form-action=previous]")
                    .hide();
            $(frm)
                    .find("a[data-form-action=next]")
                    .hide();
            $(frm)
                    .find("a[data-form-action=new]")
                    .hide();
            return;
        }
        if (totalRecords > 1) {
            if (currentRecord == 0) {
                //First-Record: Hide PREVIOUS
                $(frm)
                        .find("a[data-form-action=previous]")
                        .hide();
                $(frm)
                        .find("a[data-form-action=next]")
                        .show();
            } else if (currentRecord > 0 && currentRecord < totalRecords) {
                //NOT First-Record NEITHER Last-Record: SHOW's PREVIUOS + NEXT
                $(frm)
                        .find("a[data-form-action=previous]")
                        .show();
                $(frm)
                        .find("a[data-form-action=next]")
                        .show();
            } else {
                //Last-Record: Hide NEXT
                $(frm)
                        .find("a[data-form-action=next]")
                        .hide();
                $(frm)
                        .find("a[data-form-action=previous]")
                        .show();
            }
        }
        if (totalRecords > 1) {
            if (currentRecord == parseInt(totalRecords)) {
                $(frm)
                        .find("a[data-form-action=next]")
                        .hide();
            }
        }
        if (currentRecord == 1) {
            $(frm)
                    .find("a[data-form-action=previous]")
                    .hide();
        }
        if (totalRecords == 0) {
            $(frm)
                    .find(".recordsNav")
                    .text(".sem resultados");
            return;
        }
        if (totalRecords && currentRecord) {
            $(frm)
                    .find(".recordsNav")
                    .text(currentRecord + " / " + totalRecords);
        }
    };
    QuadForm.prototype.dataRender = function (frm, recordPos, action, wkfInfo) {
        action = action || null;

        var obj = this;
        obj["srcs"] = [];
        delete obj.frmData;
        obj.clearForm(frm);
        if (!obj.myData["data"]) {
            this.disableFields(frm);

            return;
        }
        if (obj.exclude) {
            _.forEach(obj.exclude, function (name, i) {
                var el = $(frm).find("[name='" + name + "']");
                if (!$(el).is("[type=file]")) {
                    //PMA
//        $(el)
//          .css("opacity", 0.5)
//          .val("Info not available RGPD blocked???")
//          .prop("disabled", true);
                }
            });
        }
        if (obj.myData["data"].length > 0 && obj.myData["data"][recordPos]) {
            $.each(obj.myData["data"][recordPos], function (key, value) {
                var el = obj.formElementData(
                        obj.myData["data"][recordPos],
                        $(frm),
                        key,
                        value,
                        action
                        );

//      if (el.data("exclude")) {
//        el.css("opacity", 0.1).prop("disabled", true); //.css('display', 'none');
//        //PMA :: SECURITY CONTROL
//        if ( $('span.' + el.attr('NAME')).length === 0 ){
//            $('<span class="disableInputAccessClone far fa-user-lock ' + el.attr("NAME") + '" data-toggle="tooltip" data-placement="auto" data-delay="{ &quot;show&quot;: 350, &quot;hide&quot;: 100 }"  data-original-title="' + JS_ACCESS_DENIED + '"></span>', {"tooltip":JS_ACCESS_DENIED})
//                    .insertAfter(el)
//                    .tooltip({
//                        'template': '<div class="tooltip noAccess" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
//                    });
//        }
////$(el).remove(); //DB INPUT FIELD IS REMOVED
//        //END PMA :: SECURITY CONTROL
//      } else {
//        el.css("opacity", 1).prop("disabled", false);
//      }
            });
        }

        this.resetButtonsState(frm, obj.totalRecords, recordPos);

        if (obj.myData["data"][recordPos]) {
            $(frm)
                    .find("a[data-form-action=edit]")
                    .show();
        } else {
            if ($(obj.formId).hasClass("quadFormInstanceWithInvertedRules")) {
                $(frm)
                        .find("a[data-form-action=new]")
                        .show();
            }
        }

        var dtData = obj.getNormalizedFrmData(frm);

        //very very important!!!! dizemos que as DBcolumns agora tem o conteudo do CURRENTRECORD

        obj.setCurrentRecord(dtData);

        if (this.dependsOn) {
            var masterObj = window[Object.keys(obj.dependsOn)[0]];

            var masterData =
                    masterObj instanceof QuadForm
                    ? masterObj.myData["data"][masterObj.currentRecord]
                    : masterObj.tbl.row(".selected").data();

            if (masterData) {
                obj.checkInactive(masterData, masterObj);
            }
        }

        if (action === "edit") {
            if (obj.workFlow && obj.workFlow["showWorkflowOnEdit"] !== true) {
                return;
            }
        }

        if (action !== "edit") {
            this.disableFields(frm);
            if (!action) {
                $(".docsViewer", frm)
                        .find(".photoButtons")
                        .find(".carrega")
                        .remove();
            }
        }
        obj.acl(frm,true);
        obj.manageWorkflow(obj.workFlow.update, obj.formId, obj["wkf"]);
    };
    QuadForm.prototype.checkInactive = function (data, masterObj) {
        var obj = this;
        var frm = obj.formId;
        var arr = [];
        var disabledLink = "forbidden-bc-grey";
        if (masterObj.crudOnMasterInactive) {
            var dataClone = obj.getInativeCondition(data, masterObj)[0];
            var condition = obj.getInativeCondition(data, masterObj)[1];
            if (eval(condition) === true) {
                _.forEach(masterObj.crudOnMasterInactive.acl, function (ob, i) {
                    if (i === "create") {
                        if (ob === false) {
                            $("a[data-form-action=new]", frm).addClass(disabledLink);
                            arr.push(i);
                        } else {
                            $("a[data-form-action=new]", frm).removeClass(disabledLink);
                        }
                    }
                    if (i === "update") {
                        if (ob === false) {
                            $("a[data-form-action=edit]", frm).addClass(disabledLink);
                            arr.push(i);
                        } else {
                            $("a[data-form-action=edit]", frm).removeClass(disabledLink);
                        }
                    }
                    if (i === "delete") {
                        if (ob === false) {
                            $("a[data-form-action=delete]", frm).addClass(disabledLink);
                            arr.push(i);
                        } else {
                            $("a[data-form-action=delete]", frm).removeClass(disabledLink);
                        }
                    }
                });
            } else {
                if (typeof eval(condition) === "boolean") {
                    $("a[data-form-action=new]", frm).removeClass(disabledLink);
                    $("a[data-form-action=edit]", frm).removeClass(disabledLink);
                    $("a[data-form-action=delete]", frm).removeClass(disabledLink);
                } else {
                    alert(
                            "something wrong. Are you comparing? Its javascript comparision, not SQL comparision"
                            );
                }
            }
        }
    };
    QuadForm.prototype.masterDetail = function (frm) {
        var obj = this;
        //obj.acl(frm);
        var dataCopy = $.extend({}, obj.myData["data"][obj.currentRecord]);
        dataCopy = _.omit(
                dataCopy,
                _.difference(_.keys(dataCopy), _.keys(obj.pk.primary))
                );
        dataCopy = obj.normalizeData(dataCopy);
        if (obj.detailsObjects) {
            obj.detailsObjects.forEach(function (key) {
                if (window[key].externalFilter) {
                    var fdata = window[key].getFiltersFormsData();
                    _.remove(fdata, {value: ""});
                    _.remove(fdata, {value: null});
                    if (!window[key].sFilters) {
                        window[key].sFilters = fdata;
                    } else {
                        window[key].filterFilters(fdata);
                    }
                    _.forEach(fdata, function (ob, i) {
                        window[key].qFilters[ob.name] = ob.name + "=" + ob.value + " ";
                    });
                }
                window[key].operation = "SELECT";
                var el = $(
                        window[key] instanceof QuadForm
                        ? window[key].formId
                        : "#" + window[key].tableId
                        );
                if (window[key].instanceVisible(el)) {
                    window[key].resetData();
                    window[key].prepareData(dataCopy);
                    //window[key].setDML(dataCopy);
                    window[key].initState = false;
                    if (window[key] instanceof QuadForm) {
                        window[key].myData["data"] = [];
                        window[key].totalRecords = 0;
                        window[key].currentRecord = 0;
                        window[key].clearForm(window[key].formId);
                        $.when(window[key].getData()).then(function (dat) {
                            var dat = JSON.parse(dat);
                            if (obj.checkError(dat, $(window[key].formId))) {
                                return;
                            }
                            dat = window[key].fixData(dat);

                            window[key].checkNavStatus(window[key].formId, 0, 0);
                            $.merge(window[key].myData["data"], dat["data"]);
                            window[key].dataRender(
                                    window[key].formId,
                                    window[key].currentRecord,
                                    null
                                    );
                        });
                        window[key].acl(window[key].formId);
                    } else if (window[key] instanceof QuadTable) {
                        if ($.fn.DataTable.isDataTable("#" + window[key].tableId)) {
                            window[key].tbl.clear();
                            window[key].clearTable();
                            window[key].tbl
                                    .columns()
                                    .search()
                                    .draw(); // data to search is allready set in setDML(data)
                        } else {
                            window[key].initDetails();
                        }
                    }
                }
            });
        } else {
            //obj.navigate("next", frm);
        }
    };
    QuadForm.prototype.hideExternalKeyFields = function () {
        return true;
        var obj = this;
        _.each(obj.pk.primary, function (k, i) {
            obj.disableColumn(i);
        });
        if (this.dependsOn) {
            _.mapKeys(this.dependsOn, function (value, key) {
                _.mapKeys(value, function (externalKey, field) {
                    $(obj.formId)
                            .find("[data-db-name=" + field + "]")
                            .closest(".form-group")
                            .hide();
                });
            });
        }
    };
    QuadForm.prototype.prepareDataDT = function (json) {
        var obj = this;
        var fieldValue;
        if (json.data) {
            //this is an INSERT
            var index = Object.keys(json.data);
            for (var i in this.dbColumns) {
                fieldValue = json.data[index][obj.dbColumns[i]["db"]];
                if (fieldValue) {
                    obj.dbColumns[i]["prv_value"] = fieldValue;
                }
            }
        } else {
            //this is an UPDATE . INLINE EDITION returns diferent data structure
            for (var i in obj.dbColumns) {
                fieldValue = json[obj.dbColumns[i]["db"]];
                if (fieldValue) {
                    obj.dbColumns[i]["prv_value"] = fieldValue;
                }
            }
        }
    };
    QuadForm.prototype.logError = function (err) {
        if (window.XMLHttpRequest) {
            var xhr = new XMLHttpRequest();
            var scripturl = "http://yourdomain.example.com/log";
            xhr.open("POST", scripturl);
            xhr.setRequestHeader("Content-Type", "text/plain;charset=UTF-8");
            xhr.send(err);
        }
    };
    QuadForm.prototype.sortOrder = function (frmId) {
        //ORDER BY EDITOR
        var obj = this;

        obj.appendSortButton(frmId);
        $("#sort_" + frmId).on("click", function (e) {
            if (!localStorage.getItem(frmId + "_sortInfo")) {
                localStorage.setItem(frmId + "_sortInfo", "");
            }
            var modalIdentifier = obj.modalSortUi(obj.formId.substring(1));
            obj.registerCustomSortOrderByEvents(modalIdentifier);
            obj.registerOrderByEvents(modalIdentifier);

            //isto serve para que a up/down seja mostrado correctamente...
            $($(".orderByUp").first()).hide();
            $($(".orderByDown").last()).hide();
        });
    };
    QuadForm.prototype.registerOrderByEvents = function (modalIdentifier) {
        var obj = this;
        var frmId = obj.formId.substring(1);
        $(modalIdentifier).on("change", "select", function (e) {
            e.stopImmediatePropagation();

            var obj = window[$("#sortModal").attr("instanceId")];
            obj.orderByChangeHandler(e, frmId, $(this));
        });
        $(modalIdentifier).on("click", ".deleteOrderBy", function (e) {
            e.stopImmediatePropagation();
            var obj = window[$("#sortModal").attr("instanceId")];

            obj.deleteOrderByHandler(e.currentTarget, frmId);
        });
        $(modalIdentifier).on("click", ".orderNow", function (e) {
            e.stopImmediatePropagation();
            var obj = window[$("#sortModal").attr("instanceId")];
            if (obj["sFilters"]) {
                obj.resetData();
                _.forEach(obj["sFilters"], function (o, i) {
                    var el = $('[name="' + o.name + '"]', obj.formId);

                    if (el.attr("dependent-group") && obj["sortInfo"]) {
                        obj.buildWhereClause(o.name, o.text, "query", true);
                    } else {
                        obj.buildWhereClause(o.name, o.value, "query", true);
                    }
                    var ob = $('[name="' + o.name + '"]', obj.formId);

                    if (ob.hasClass("complexList")) {
                        var keys = obj.returnListKeys(ob);

                        _.map(keys, function (field, j) {
                            delete obj.qFilters[field];
                        });
                    }
                });
            }
            obj.startIn = 0;
            obj.refreshCustomOrderData($(obj.formId));

            $("#sortModal").modal("toggle");
        });
    };
    QuadForm.prototype.displaySortOptions = function (
            field,
            sort,
            eTarget,
            options
            ) {
        var obj = this;
        var frm = $(obj.formId);
        field = field || null;
        eTarget = eTarget || null;
        sort = sort || null;
        options = options || null;
        var output = [];
        output.push("<option> </option>");
        if (localStorage.getItem(obj.formId.substring(1) + "_sortInfo")) {
            var filtered = JSON.parse(
                    localStorage.getItem(obj.formId.substring(1) + "_sortInfo")
                    ).map(function (a) {
                return Object.keys(a)[0];
            });
        }

        _.map($(":input", frm), function (el, index) {
            if (_.includes(obj.exclude, $(el).attr("name")) || $(el).data("func")) {
                return;
            }
            if (filtered && filtered.includes($(el).attr("name"))) {
                return;
            }
            if ($(el).is(":not(:hidden)")) {
                var label = $("label[for='" + $(el).attr("name") + "']", frm);
                if (label.length > 0) {
                    if (field && $(el).attr("name") !== field.val()) {
                        output = obj.appendOption(
                                output,
                                $(el).attr("name"),
                                $(label)
                                .html()
                                .toUpperCase()
                                );
                    } else if (!field) {
                        output = obj.appendOption(
                                output,
                                $(el).attr("name"),
                                $(label)
                                .html()
                                .toUpperCase()
                                );
                    }
                }
            }
        });

        return obj.sortFieldUi(sort, field, eTarget, options, output);
    };

    QuadForm.prototype.filterInstance = function (target) {
        var obj = this;
        delete obj["qFilters"];
        var frm = obj.externalFilter.templateMulti.selector;
        obj.operation = "SELECT";
        obj.resetData(true);
        obj.clearWorkFlow(obj.formId);
        var formData = obj.getFiltersFormsData();
        if (!obj.checkMandatoryFilters(formData)) {
            obj.externalFilterFieldsVisibility(obj.formId);
            return false;
        }
        _.remove(formData, {value: ""});
        _.remove(formData, {value: null});
        if (target) {
            if (
                    formData.length > 0 &&
                    _.find(formData, {name: target.attr("name")})
                    ) {
                _.find(formData, {name: target.attr("name")})["text"] = target
                        .find(":selected")
                        .text();
            } else {
                obj.clearForm(obj.formId);
                obj.masterDetail(obj.formId);
            }
            if (
                    target.val() === "" &&
                    _.find(obj.sFilters, {name: target.attr("name")})
                    ) {
                _.remove(obj.sFilters, {name: target.attr("name")});
                obj.qFilters = _.omit(obj.qFilters, target.attr("name"));
            }
        }

        if (obj.sFilters) {
            obj.filterFilters(formData);
        } else {
            obj.sFilters = formData;
        }

        //obj.filtersText(formData, frm);

        var data = obj.normalizeData(obj.getNormalizedFrmData(frm));

        data = obj.normalizeData(data);
        data = obj.mapComplexLists(data);
        obj.prepareData(data);
        obj.manageFiltersData();
        //obj.setDML(data, "query", obj["sortInfo"] ? true : false);
        obj.startIn = 0;

        obj.externalFilterFieldsVisibility(obj.formId);

        $.when(obj.getData(true)).then(function (dat) {
            dat = JSON.parse(dat);
            if (obj.checkError(dat, $(obj.formId), obj.sFilters)) {
                return;
            }
            if (obj.workFlow && obj.workFlow.mode === "postponed") {
                if (obj.operation !== "SELECT") {
                    obj.notifyPostponedWorkflowToUser();
                }
            }
            dat = obj.fixData(dat);
            obj["myData"] = obj["myData"] || [];
            obj.myData["data"] = [];
            $.merge(obj.myData["data"], dat["data"]);

            obj.dataRender(obj.formId, 0, null);
            if ($(obj.formId).hasClass("quadFormInstanceWithInvertedRules")) {
                $(obj.formId)
                        .find("a[data-form-action=new]")
                        .hide();
            }
            var dtData = obj.getNormalizedFrmData(obj.formId);

            obj.setCurrentRecord(dtData);

            $(obj.formId + " > _spinner").hide();
            //obj.resetButtonsState(frm, obj.totalRecords, obj.currentRecord);
            obj.masterDetail(obj.formId);
        });
    };
    QuadForm.prototype.refreshCustomOrderData = function (frm) {
        var obj = this;
        var xtFormData = obj.getFiltersFormsData();
        if (!obj.checkMandatoryFilters(xtFormData)) {
            return false;
        }
        $.when(obj.getData(true)).then(function (dat) {
            var dat = JSON.parse(dat);
            if (obj.checkError(dat, frm)) {
                return;
            }
            dat = obj.fixData(dat);
            obj.myData["data"] = [];
            obj.currentRecord = 0;
            $.merge(obj.myData["data"], dat["data"]);
            obj.dataRender(frm, obj.currentRecord, null);

            obj.hideSpinner();
            obj.masterDetail(frm);
        });
    };
    QuadForm.prototype.masterDataToDetailCurrentRecord = function (o) {
        var obj = this;
        if (o instanceof QuadForm) {
            o.enableFields(window[o].formId);
            var dtData = o.getNormalizedFrmData(o.formId);
        } else {
            var indexes = o.tbl.rows({selected: true}).indexes();
            var dtData = o.tbl.row(indexes).data();
        }

        dtData = obj.setCurrentRecord(dtData);

        //obj.setDML(dtData);
    };

    QuadForm.prototype.isMasterIsDetail = function (frm) {
        var obj = this;
        if (obj.detailsObjects) {
            obj.refreshCustomOrderData($(obj.formId));
        } else if (obj.dependsOn) {
            _.forEach(obj.dependsOn, function (key, o) {
                if (
                        window[o] instanceof QuadForm ||
                        (window[o] instanceof QuadTable &&
                                window[o].tbl.rows({selected: true}).indexes().length > 0)
                        ) {
                    obj.masterDataToDetailCurrentRecord(window[o]);

                    $.when(obj.getData(true)).then(function (dat) {
                        dat = JSON.parse(dat);
                        if (obj.checkError(dat, $(obj.formId))) {
                            return;
                        }
                        dat = obj.fixData(dat);
                        obj.myData["data"] = [];
                        obj.currentRecord = 0;
                        $.merge(obj.myData["data"], dat["data"]);
                        obj.dataRender(frm, obj.currentRecord, null);
                        $(obj.formId + " > _spinner").hide();
                        //obj.resetButtonsState(frm, obj.totalRecords, obj.currentRecord);
                        obj.masterDetail(frm);
                    });
                    var masterData =
                            window[o] instanceof QuadForm
                            ? window[o].myData["data"][window[o].currentRecord]
                            : window[o].tbl.row(".selected").data();
                    obj.checkInactive(masterData, window[o]);
                } else {
                    $(frm)
                            .find("a[data-form-action]")
                            .hide();
                    obj.hideSpinner();
                    $(frm)
                            .find(".quad-alert")
                            .html(window[o].selectRecordMsg)
                            .addClass("alert alert-warning fade in");
                }
            });
        } else {
            obj.refreshCustomOrderData($(obj.formId));
        }
    };
    QuadForm.prototype.actionToEditor = function (action) {
        var obj = this;
        obj.editor = obj.editor || {};
        obj.editor.s = obj.editor.s || {};
        obj.editor.s.action = obj.editor.s.action || {};
        obj.editor.s.action = action;
    };

    QuadForm.prototype.retrieveDisplayData = function (frm) {
        var obj = this;
        $.when(obj.getData(true)).then(function (dat) {
            dat = JSON.parse(dat);

            if (obj.checkError(dat, frm)) {
                return;
            }

            if (dat.data.length > 0) {
                dat = obj.fixData(dat);
                obj.myData["data"] = [];
                obj.currentRecord = 0;
                $.merge(obj.myData["data"], dat["data"]);
                obj.dataRender(frm, obj.currentRecord, null);
                obj.masterDetail(frm);
            } else {
                obj.resetButtonsState(frm, 0, 0);
                obj.clearForm(frm);
                obj.disableFields(frm);
                obj.acl(frm,true);
            }
        });
    };

    QuadForm.prototype.removeFormRecord = function (frm) {
        var obj = this;
        obj.myData["data"].splice(obj.currentRecord, 1);
        --obj.totalRecords;
        obj.dataRender(frm, --obj.currentRecord, null);
    };

    QuadForm.prototype.checkMandatoryFilters = function (xtFormData) {
        var obj = this;
        var status = true;
        if (obj.externalFilter) {
            if (obj.externalFilter.template) {
                //ao criarmos um registos, se os filtros mandatórios não estiverem todos preenchidos, alertamos o utilizador e flag=0

                _.forEach(xtFormData, function (fld, i) {
                    var ob = $(
                            "[name=" + fld.name + "]",
                            obj.externalFilter.template.selector
                            );
                    var elChosen = $("#" + ob.attr("id") + "_chosen");
                    var label = $(
                            "label[for='" + ob.attr("id") + "']",
                            obj.externalFilter.template.selector
                            );
                    if (
                            obj.externalFilter.template.mandatory &&
                            $.inArray(fld.name, obj.externalFilter.template.mandatory) != -1 &&
                            (fld.value == "" || fld.value == null)
                            ) {
                        ob.addClass("error");
                        elChosen.addClass("error");

                        status = false;
                    } else {
                        ob.removeClass("error");
                        elChosen.removeClass("error");
                    }
                });
            }

            if (obj.externalFilter.templateMulti) {
                //ao criarmos um registos, se os filtros mandatórios não estiverem todos preenchidos, alertamos o utilizador e flag=0

                _.forEach(xtFormData, function (fld, i) {
                    var ob = $(
                            "[name=" + fld.name + "]",
                            obj.externalFilter.templateMulti.selector
                            );
                    var elChosen = $("#" + ob.attr("id") + "_chosen");
                    var label = $(
                            "label[for='" + ob.attr("id") + "']",
                            obj.externalFilter.templateMulti.selector
                            );
                    if (
                            obj.externalFilter.templateMulti.mandatory &&
                            $.inArray(fld.name, obj.externalFilter.templateMulti.mandatory) !=
                            -1 &&
                            (fld.value == "" || fld.value == null)
                            ) {
                        ob.addClass("error");
                        elChosen.addClass("error");

                        status = false;
                    } else {
                        ob.removeClass("error");
                        elChosen.removeClass("error");
                    }
                });
            }
        }
        return status;
    };
    QuadForm.prototype.configUpload = function (selector) {
        var obj = this;
        obj.initializeDropZone(selector);
    };
    QuadForm.prototype.outputFiles = function (files, el) {
        var obj = this;
        var html =
                "<ul class='fileList' data-role='" + obj.formId.substring(1) + "'>";
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
                        "><a class='badge badge-light' href='" +
                        fPath +
                        "'>" +
                        filename.replace(":blob", "") +
                        "</a><i class='fas fa-times  pull-right' aria-hidden='true'></i></li>";
            } else {
                html +=
                        "<li class='fileItem' data-id=" +
                        entry.seq +
                        "><a class='badge badge-light' href='" +
                        fPath +
                        "'>" +
                        filename +
                        "</a><i class='fas fa-times  pull-right' aria-hidden='true'></i></li>";
            }
        });
        html += "</ul>";
        el.empty().html(html);
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
    QuadForm.prototype.getFileIcon = function (ext, row) {
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
                            obj.formId.substring(1) +
                            '" data-table="' +
                            obj.table +
                            '" data-reference="' +
                            sendRecordPk +
                            '"><i class="far fa-file-' +
                            extHelper +
                            ' fa-4x"></i></a>';
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
