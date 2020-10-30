    /**
     * Created by led on 04-03-2017.
     */
    "use strict";
    var QuadCore = function () {};
    QuadCore.prototype.validateFrm = function (frm, rules) {
        //extendemos o validate() nativo com algumas regras da Quad.
        //em vez de chamarmos frm.validate(), fazemos frm.validateFrm(meuform,rules defenidas na instancia)
        frm.validate(
                $.extend(
                        {
                            //ignore: ['#newRForm input:hidden'], //include hidden elements rhid_gestao_documentalREF_INTERNAcreate
                            //ignore: '#newRForm :input:hidden[id]',
                            ignore: [],
                            highlight: function (element, errorClass, validClass) {
                                //$($("[name=REF_INTERNA]")[1]).removeClass('error')

                                if ($(element).length === 1) {
                                    $(element)
                                            .next(".chosen-container > .chosen-default")
                                            .addClass("error");
                                    $(element).addClass("error");
                                }
                                if ($(element).length === 2) {
                                    $(element[1])
                                            .next(".chosen-container > .chosen-default")
                                            .addClass("error");
                                    $(element[1]).addClass("error");
                                }
                            },
                            unhighlight: function (element, errorClass, validClass) {
                                //$($("[name=REF_INTERNA]")[1]).removeClass('error')
                                if ($(element).length === 1) {
                                    $(element)
                                            .next(".chosen-container > .chosen-default")
                                            .removeClass("error");
                                    $(element).removeClass("error");
                                }
                                if ($(element).length === 2) {
                                    $(element[1])
                                            .next(".chosen-container > .chosen-default")
                                            .removeClass("error");
                                    $(element[1]).removeClass("error");
                                }
                            },
                            errorPlacement: function (error, element) {
                                //$($("[name=REF_INTERNA]")[1]).removeClass('error')

                                if ($(element).hasClass("chosen")) {
                                    if ($("#" + $(element).attr("id") + "_chosen").length > 0) {
                                        //chosen tem resultados disponiveis
                                        error.insertAfter("#" + $(element).attr("id") + "_chosen");
                                        $(element)
                                                .next(".chosen-container > .chosen-default")
                                                .addClass("error");
                                    } else {
                                        //chosen nao tem resultados disponiveis
                                        error.insertAfter(element);
                                    }
                                } else {
                                    if ($(element).length === 1) {
                                        error.insertAfter(element);
                                    }
                                    if ($(element).length === 2) {
                                        error.insertAfter(element[1]);
                                    }
                                }
                            },
                            focusCleanup: true,
                            onfocusout: function (element, evt) {
                                if (!$(element).hasClass("datepicker")) {
                                    $(element).valid();
                                } else {
                                    if ($(element).val()) {
                                        $(element).valid();
                                    }
                                }
                                if ($(element).hasClass("chosen-search-input")) {
                                    //$(element).parents('.DTE_Field_InputControl').find('.chosen').trigger("chosen:updated");
                                    // setTimeout(function () {
                                    if (frm.attr("id") === "newRForm" || "editRForm") {
                                        //todo child details
                                        if ($(element).hasClass("chosen")) {
                                            if ($(element).parents(".dtr-data")) {
                                                $(element)
                                                        .parents(".dtr-data")
                                                        .find(".chosen")
                                                        .valid();
                                            } else {
                                                $(element)
                                                        .parents("td")
                                                        .find(".chosen")
                                                        .valid();
                                            }
                                        }
                                    } else {
                                        $(element)
                                                .parents(".DTE_Field_InputControl")
                                                .find(".chosen")
                                                .valid();
                                    }
                                    // }, 1000);
                                }
                            },
                            onkeyup: function (element) {
                                if (!$(element).hasClass("datepicker")) {
                                    $(element).valid();
                                }
                            },
                            onclick: false
                        },
                        rules
                        )
                );
    };
    QuadCore.prototype.instanceVisible = function (el, container) {
        //a instancia está visivel ??? está o container visivel??
        container = container || el.closest("." + quadConfig.tabclass);
        /* Está inicializado e está dentro de uma tab com as classes defenidas no config? */
        if (
                ($(container).hasClass(quadConfig.tabclass) &&
                        $(container).hasClass(quadConfig.activeTabClass) &&
                        el.is(":visible")) ||
                container.length == 0
                ) {
            return true;
        } else {
            return false;
        }
    };

    QuadCore.prototype.getFiltersFormsData = function () {
        var obj = this;

        if (obj.externalFilter && obj.externalFilter.templateMulti) {
            var multiFilterData = obj.getFilterData(
                    obj.externalFilter.templateMulti.selector
                    );
        }
        if (obj.externalFilter && obj.externalFilter.template) {
            var filterData = obj.getFilterData(obj.externalFilter.template.selector);
        }
        if (multiFilterData && filterData) {
            return multiFilterData.concat(filterData);
        }
        if (multiFilterData) {
            return multiFilterData;
        }
        if (filterData) {
            return filterData;
        }
    };
    QuadCore.prototype.getFilterData = function (frm) {
        var obj = this;
        var el;
        var filterData = $(frm).serializeAllArray();
        _.forEach(filterData, function (ob, i) {
            el = $('[name="' + ob.name + '"]', frm);
            if (el.attr("dependent-group")) {
                ob["text"] = el.find(":selected").text();
            } else {
                ob["text"] = ob.value;
            }
        });
        return filterData;
    };
    QuadCore.prototype.setCurrentRecord = function (dtData) {
        var obj = this;
        obj.resetData();

        dtData = obj.normalizeData(dtData);
        if (obj instanceof QuadForm) {
            dtData = obj.mapComplexLists(dtData);
        }
        dtData.data[0] = obj.emptyStringToNull(dtData.data[0]);

        obj.prepareData(dtData);
        obj.encodeDomains();
        obj.manageFiltersData();

        return dtData;
    };
    QuadCore.prototype.emptyStringToNull = function (data) {
        Object.keys(data).forEach(function (key) {
            if (data[key] === "") {
                data[key] = null;
            }
        });
        return data;
    };

    QuadCore.prototype.getNormalizedFrmData = function (frm) {
        //pomos o object/array de dados dentro de um array data[] para acedermos como data.data (convencionei assim...)
        var data = $(frm).serializeAllArray();
        var dtData = {};
        data.forEach(function (d) {
            dtData[d.name.toUpperCase()] = d.value;
        });
        return dtData;
    };
    QuadCore.prototype.convertToDTRowData = function (dbColumns) {
        //extraimos o registos corrente do obj.dbColumns com uma estrutura complexa para um flat array/object mais simples de manipular.
        var rowData = {};
        var field, fieldValue;
        for (var i in dbColumns) {
            field = dbColumns[i]["db"];
            fieldValue = dbColumns[i]["prv_value"];
            rowData[field] = fieldValue;
        }
        return rowData;
    };
    QuadCore.prototype.composeId = function (pk, rowData) {
        //método que cria o id da row. Contornamos desta forma a limitação do datatables em trabalhar chaves compostas
        if (pk && rowData) {
            var rowId = "";
            var j = 0;
            _.each(pk, function (k, i) {
                j++;
                if (j > 1) {
                    rowId += rowData[i];
                } else {
                    rowId += "row_" + rowData[i];
                }
            });
            return rowId.escapeSelector();
        }
    };
    QuadCore.prototype.datepickersPosSelection = function (picker, text, action) {
        if (picker.data("previous")) {
            if (action === "query") {
                picker.val($(this).data("previous") + text);
            }
        }
        picker.focus();
        picker.trigger("change"); //PMA, 2019.12.26
    };
    QuadCore.prototype.enableDatePickers = function (container, action) {
        var obj = this;

        $(".datepicker", container).datepicker({
            dateFormat: quadConfig.datePickerFormat,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            constrainInput: false,
            //este código não está a fazer nada. Era para fazer pesquisas utilizando expressão mais datepicker value
            beforeShow: function () {
                $(this).val();
            },
            onSelect: function (dateText) {
                obj.datepickersPosSelection($(this), dateText, action);
            }
        });
        /* datetimePicker :: http://trentrichardson.com/examples/timepicker/ */
        $(".dateTimePicker", container).datetimepicker({
            timeFormat: quadConfig.dateTimePickerTimeFormat,
            dateFormat: quadConfig.datePickerFormat,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            timeInput: true,
            onSelect: function (dateText) {
                obj.datepickersPosSelection($(this), dateText, action);
            }
        });
        $(".dateTimePickerShort", container).datetimepicker({
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            timeFormat: quadConfig.dateTimePickerTimeFormatShort,
            dateFormat: quadConfig.datePickerFormat,
            timeInput: true,
            onSelect: function (dateText) {
                obj.datepickersPosSelection($(this), dateText, action);
            }
        });
        $(".dateTimePickerTimeFormatShort", container).datetimepicker({
            timeOnly: true,
            timeInput: true,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            timeFormat: quadConfig.dateTimePickerTimeFormatShort,
            //                dateFormat: quadConfig.datePickerFormat,
            //                timeOnlyShowDate: true,
            onSelect: function (dateText) {
                obj.datepickersPosSelection($(this), dateText, action);
            }
        });
        $(".dateYearMonth", container).datepicker({
            dateFormat: quadConfig.dateYearMonth,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            constrainInput: false,
            //este código não está a fazer nada. Era para fazer pesquisas utilizando expressão mais datepicker value
            beforeShow: function () {
                $(this).val();
            },
            onSelect: function (dateText) {
                obj.datepickersPosSelection($(this), dateText, action);
            }
        });

        $(".dateYearMonth,.dateTimePickerTimeFormatShort,.dateTimePickerShort,.dateTimePicker,.datepicker").attr("autocomplete","off");

    };

    QuadCore.prototype.toDateToDateTime = function (type, column) {
        //prepara SQl para servidor a fim de retornar as datas no formato correto segundo a datetype defenido na instância
        var cast;
        type = type.toUpperCase();
        if (type === "DATE") {
            cast = "TO_CHAR(" + column + ",'" + quadConfig.dbDateFormat + "')";
        } else if (type === "DATETIMESHORT") {
            cast = "TO_CHAR(" + column + ",'" + quadConfig.dbDateTimeShortFormat + "')";
        } else if (type === "DATEYEARMONTH") {
            cast = "TO_CHAR(" + column + ",'" + quadConfig.dbYearMonth + "')";
        } else if (type === "DATETIME") {
            cast = "TO_CHAR(" + column + ",'" + quadConfig.dbDateTimeFormat + "')";
        } else if (type === "TIME24MINUTES") {
            cast = "TO_CHAR(" + column + ",'" + quadConfig.dbTimeMinutes + "')";
        } else if (type === "TIME24SECONDS") {
            cast = "TO_CHAR(" + column + ",'" + quadConfig.dbTimeSeconds + "')";
        }
        return cast;
    };
    QuadCore.prototype.mapRelations = function (i) {
        var obj = this;
        var str = "";
        _.mapKeys(obj.dependsOn, function (value, key) {
            if (_.has(obj.dependsOn[key], obj.dbColumns[i]["db"])) {
                str = obj.masterKeyDetailKey(window[key], obj.dbColumns[i], value);
                //se a clausula ainda não constar no WHERE ...evitamos a repetição da clausula(bug fix)
                obj.sFilters = obj.sFilters || [];
                obj.qFilters = obj.qFilters || {};
                obj.qFilters = _.omit(obj.qFilters, obj.dbColumns[i]["db"]);
                _.remove(obj.sFilters, {name: obj.dbColumns[i]["db"]});
                obj.qFilters[obj.dbColumns[i]["db"]] = str.name + "='" + str.value + "'";
                obj.sFilters.push({name: obj.dbColumns[i]["db"], value: str.value});
                //just a safe fallback
                obj.dbColumns[i].prv_value = str.value;
                obj.dbColumns[i].nxt_value = str.value;
                //}
            }
        });
    };

    QuadCore.prototype.masterKeyDetailKey = function (master, dbCol, value) {
        var obj = this;
        var v = _.result(
                _.findWhere(master.dbColumns, {
                    db: value[dbCol["db"]]
                }),
                "db"
                );
        var t, datatype, str;
        var k = _.findIndex(master.dbColumns, {db: v});
        if (obj instanceof QuadTable) {
            t = _.find(master.tableCols, {data: v});
            datatype = t.datatype;
        } else {
            t = $(obj.formId).find("input[name='" + v + "']");
            datatype = t.prop("datatype");
        }

        dbCol["prv_value"] = master.dbColumns[k]["prv_value"];
        dbCol["nxt_value"] = master.dbColumns[k]["prv_value"];
        var o = {};
        if (datatype && datatype !== "sequence") {
            o["name"] = obj.toDateToDateTime(datatype, dbCol["db"]);
            o["value"] = master.dbColumns[k]["prv_value"];
        } else {
            o["name"] = dbCol["db"];
            o["value"] = master.dbColumns[k]["prv_value"];
        }
        return o;
    };

    QuadCore.prototype.resetData = function (hardReset) {
        //reinicilizamos a estrutura dbColumns que contêm o registo corrente. Há momentos que não queremos reinicializar os campos chave
        //se quisermos reinicializar também as chave, fazemos obj.resetData(true)
        //neste método também reinicializamos/refazemos as relações
        var obj = this;

        _.map(obj.dbColumns, function (o, i) {
            for (var prop in o) {
                if (!_.has(obj.pk.primary, o["db"])) {
                    obj.resetDbColumn(o, prop);
                }
                if (hardReset) {
                    obj.resetDbColumn(o, prop);
                }
            }
            return o;
        });
        //se for um detail, reinicializamos/refazemos as relações

        for (var i in obj.dbColumns) {
            if (obj.dependsOn) {
                if (
                        _.contains(
                                _.keys(obj.dependsOn[Object.keys(obj.dependsOn)[0]]),
                                obj.dbColumns[i]["db"]
                                ) === true
                        ) {
                    obj.mapRelations(i);
                }
            }
        }
    };
    QuadCore.prototype.resetDbColumn = function (o, prop) {
        if (
                o.hasOwnProperty(prop) &&
                prop != "db" &&
                prop != "datatype" &&
                prop != "funcField"
                ) {
            o[prop] = "";
        }
    };
    QuadCore.prototype.valueToDbColumn = function (i, fieldValue) {
        var obj = this;
        obj.dbColumns[i]["prv_value"] = fieldValue;

        obj.dbColumns[i]["nxt_value"] = fieldValue;
    };
    QuadCore.prototype.prepareData = function (json, copy) {
        //método que serve para por os dados que vêm de um form, no dbColumns, ou para atualizar dados do registo corrente....já sei que o nome não é feliz :)
        var obj = this;

        var fieldValue = "";
        var copyValue = "";
        if (json.data) {
            var index = Object.keys(json.data);
            for (var i in this.dbColumns) {
                //valor atual no ciclo ex rhid:'1'
                fieldValue = json.data[index][obj.dbColumns[i]["db"]];
                //se fizer parte da chave ,  o value consta na entrada dbColumns correspondente
                 if (
                            obj.dependsOn &&
                            _.has(
                                    obj.dependsOn[Object.keys(obj.dependsOn)],
                                    obj.dbColumns[i]["db"]
                                    )
                            ) {
                        fieldValue = obj.dbColumns[i]["nxt_value"];
                    }
                // este parametro é chamado apenas preSubmit do editor para fazer a distinção para workflow
                if (copy) {
                    copyValue = copy[i]["prv_value"];
                }
                //Se o campo pertencer á chave e for um detail, mapeamos os campos da relação
                // if (_.contains(_.keys(obj.pk.primary), obj.dbColumns[i]["db"]) === true) {
                //passamos o valor para a dbcolumn correspondente
                //se não for um detail não precisamos ir ao master buscar os valores
                if (fieldValue !== undefined) {
                    obj.valueToDbColumn(i, fieldValue);
                }

                // } else {
                if (
                        obj.dbColumns[i]["prv_value"] == "" ||
                        obj.dbColumns[i]["prv_value"] == undefined
                        ) {
                    if (fieldValue) {
                        obj.valueToDbColumn(i, fieldValue);
                    }
                }
                if (
                        fieldValue != obj.dbColumns[i]["prv_value"] &&
                        fieldValue !== undefined
                        ) {
                    if (fieldValue === "") {
                        fieldValue = null;
                    }
                    if (
                            obj.dependsOn &&
                            _.has(
                                    obj.dependsOn[Object.keys(obj.dependsOn)],
                                    obj.dbColumns[i]["db"]
                                    )
                            ) {
                        null;
                    } else {
                        obj.dbColumns[i]["nxt_value"] = fieldValue;
                    }
                }
                //}
                // distinção para workflow
                if (copy != undefined) {
                    obj.dbColumns[i]["prv_value"] = copyValue;
                }
            }
        }
    };
//TODO check https://hiddentao.com/squel/ to use here
// advantages : client side,dont have to construct sql on server.
//php orm's: http://www.gajotres.net/best-available-php-orm-libraries-part-1/
    QuadCore.prototype.setDML = function (json, query, orderInfo) {
        query = query || null;
        var obj = this;

        var fieldValue;
        if (orderInfo) {
            _.forEach(obj["sFilters"], function (o, i) {
                fieldValue = o.value;
                if (obj instanceof QuadTable) {
                    if (
                            _.find(obj.tableCols, {name: o.name})["attr"]["dependent-group"]
                            ) {
                        fieldValue = o.text;
                    }
                } else {
                    if ($('[name="' + o.name + '"]', obj.formId).attr("dependent-group")) {
                        fieldValue = o.text;
                    }
                }
                if (fieldValue) {
                    obj.buildWhereClause(o.name, fieldValue, query, true);
                }
            });
        } else {
            for (var i in this.dbColumns) {
                if (json && json.data) {
                    var index = Object.keys(json.data);
                    if (
                            json.data[index][this.dbColumns[i]["db"]] !==
                            this.dbColumns[i]["nxt_value"]
                            ) {
                        fieldValue = this.dbColumns[i]["nxt_value"];
                    } else {
                        fieldValue = json.data[index][this.dbColumns[i]["db"]];
                    }
                }
                // !important line for operation UPDATE and INSERT
                if (fieldValue) {
                    obj.buildWhereClause(i, fieldValue, query);
                }
            }
        }
        if (obj["sFilters"]) {
            obj.mapFiltersWhereClause();
        }
    };
    QuadCore.prototype.filterFilters = function (formData) {
        var obj = this;
        formData = _.difference(formData, obj.sFilters);
        //se o form tiver o elemento vazio , apagamos o filtro com o mesmo nome.
        _.forEach(formData, function (ob, i) {
            var entry = _.find(formData, {name: ob.name});
            if (entry !== -1) {
                var idx = _.findIndex(obj.sFilters, {name: ob.name});
                obj.sFilters.splice(idx, 1);
                if (obj.qFilters && obj.qFilters[ob.name]) {
                    delete obj.qFilters[ob.name];
                }
            }
        });
        obj.sFilters = _(obj.sFilters)
                .concat(formData)
                .groupBy("name")
                .map(_.spread(_.merge))
                .value();
    };
    QuadCore.prototype.filtersToWhereClause = function () {
        var obj = this;
        var status = false;
        _.forEach(obj["sFilters"], function (o, i) {
            if (obj instanceof QuadForm) {
                var ob = $('[name="' + o.name + '"]', obj.formId);
                if (ob.hasClass("complexList")) {
                    status = true;
                }
            } else {
                var ob = _.find(obj.tableCols, {name: o.name});
                if (ob["complexList"]) {
                    status = true;
                }
            }
            var idx = _.findIndex(obj.dbColumns, {db: o.name});
            if (status == true) {
                obj.mapComplexListFilterToWhereClause(o, ob);
                if (obj["qFilters"]) {
                    delete obj["qFilters"][o.name];
                }
            } else {
                if (obj["sortInfo"]) {
                    obj.buildWhereClause(o.name, obj["sFilters"][i]["text"], "query", true);
                } else {
                    obj.buildWhereClause(idx, obj["sFilters"][i]["value"], "query");
                }
            }
        });
    };
    QuadCore.prototype.mapFiltersWhereClause = function () {
        var obj = this;
         _.remove(obj["sFilters"], {value: ""});
                    _.remove(obj["sFilters"], {value: null});
        _.forEach(obj["sFilters"], function (o, i) {
            var idx = _.findIndex(obj.dbColumns, {db: o.name});

            if (o.value) {
                if (!obj["sortInfo"]) {
                    if (obj instanceof QuadTable) {
                        var ob = _.find(obj.tableCols, {name: o.name});
                        if (ob) {
                            if (ob["complexList"]) {
                                obj.mapComplexListFilterToWhereClause(o, ob);
                            } else {
                                if(idx!==-1){
                                  obj.buildWhereClause(idx, o.value, "query");
                                }

                            }
                        }
                    } else {
                        var ob = $('[name="' + o.name + '"]', obj.formId);
                        if (ob) {
                            if (ob.hasClass("complexList")) {
                                obj.mapComplexListFilterToWhereClause(o, ob);
                            } else {
                                if(idx!==-1){
                                  obj.buildWhereClause(idx, o.value, "query");
                                }
                            }
                        }
                    }
                } else {
                    obj.buildWhereClause(o.name, o.text ? o.text : o.value, "query", true);
                }
            }


          if (o.overrideName) {
            obj["qFilters"][" "] = o.value;
          }
        });
    };

    QuadCore.prototype.mapComplexListFilterToWhereClause = function (o, ob) {
        var obj = this;
        var keys = obj.returnListKeys(ob);
        var f = _.find(obj["sFilters"], {name: o.name});
        var value = f.value.replace(quadConfig.regExpressions.alias, "").split("@");

        _.map(keys, function (field, j) {
            obj.buildWhereClause(
                    _.findIndex(obj.dbColumns, {db: field}),
                    value[j],
                    "query"
                    );
        });
    };

    QuadCore.prototype.buildWhereClause = function (
            i,
            fieldValue,
            query,
            orderInfo
            ) {
        query = query || null;
        var obj = this;
        obj.qFilters = obj.qFilters || {};
        var hascondition = false;
        fieldValue = $.trim(fieldValue);
        quadConfig.sqlConditions.map(function (condition) {
            /* adicionar espaço pois texto pode coincidir com uma clause ex:ADMIN pode conter a clause IN*/
            if (fieldValue.indexOf(condition, 0) === 0) {
                hascondition = condition;
                fieldValue = fieldValue.replace(hascondition, "");
            } else if (fieldValue.indexOf(condition, 0) > 0) {
                console.log("1. Check condition");
            } else if (fieldValue.indexOf(condition, 0) === -1) {
                //alert("condição mal formada, etc...");
            }
            if (fieldValue.indexOf(condition.toLowerCase(), 0) === 0) {
                hascondition = condition.toUpperCase();
                fieldValue = fieldValue.replace(condition.toLowerCase(), "");
            } else if (fieldValue.indexOf(condition.toLowerCase(), 0) > 0) {
                console.log("2. Check condition");
            } else if (fieldValue.indexOf(condition.toLowerCase(), 0) === -1) {
                //alert("condição mal formada, etc...");
            }
        });
        if (query) {
            //se for uma query , temos que guardar os filtros e compor as condições
            if (orderInfo) {
                if (obj instanceof QuadTable) {
                    var dtType = _.find(obj.tableCols, {name: i})["datatype"];
                } else {
                    var dtType = _.find(obj.dbColumns, {db: i})
                            ? _.find(obj.dbColumns, {db: i})["datatype"]
                            : null;
                }
                if (dtType && dtType !== "sequence") {
                    var str =
                            obj.toDateToDateTime(dtType, i) +
                            obj.conditionClause(fieldValue, hascondition, i, true);
                } else {
                    var str = obj.conditionClause(fieldValue, hascondition, i);
                }
            } else {
                if (
                        i && obj.dbColumns[i] &&
                        obj.dbColumns[i].datatype &&
                        obj.dbColumns[i].datatype !== "sequence"
                        ) {
                    var str =
                            obj.toDateToDateTime(
                                    obj.dbColumns[i].datatype,
                                    obj.dbColumns[i]["db"]
                                    ) +
                            obj.conditionClause(
                                    fieldValue,
                                    hascondition,
                                    obj.dbColumns[i]["db"],
                                    true
                                    );
                } else {
                    var str = obj.conditionClause(
                            fieldValue,
                            hascondition,
                            obj.dbColumns[i]["db"]
                            );
                }
                //IMPORTANT se for uma query guardamos clausula no array , para posterior manipulação ex: quando user remove filtro etc...
                // obj.qFilters[obj.dbColumns[i]["db"]] = str;
            }
        } else {
            if (obj.dbColumns[i].datatype && obj.dbColumns[i].datatype !== "sequence") {
                var str =
                        obj.toDateToDateTime(
                                obj.dbColumns[i].datatype,
                                obj.dbColumns[i]["db"]
                                ) +
                        "='" +
                        fieldValue +
                        "' ";
            } else {
                var str = obj.dbColumns[i]["db"] + "='" + fieldValue + "' ";
            }
        }

        obj.qFilters[obj.dbColumns[i] ? obj.dbColumns[i]["db"] : i] = str;
        //}
    };
    QuadCore.prototype.getFuncFields = function () {
        var obj = this;
        var funcFields = [];

        _.forEach(obj.dbColumns, function (o, i) {
            if (o && o.funcField) {
                funcFields.push(o.db);
            }
        });

        return funcFields;
    };
    QuadCore.prototype.executeDml = function (operation) {
        var obj = this;
        //se houver colunas que são funções, guardamos num array que será enviado para o servidor. Estas funções(campos) apenas são usadas em SELECTS

        //guardamos a operação numa propriedade
        if (operation) {
            obj.operation = operation;
        }
        //dados para o servidor interpretar
        var cxLists = obj.getInstanceComplexLists();

        var domains = obj.getInstanceDomains();

        var mData = {
            domains: JSON.stringify(domains),
            cxLists: cxLists,
            pk: obj.pk.primary,
            workFlow: obj.workFlow,
            operation: obj.operation,
            operacao: obj.operation,
            columnsArray: JSON.stringify(obj.dbColumns),
            table: obj.table,
            dbAlias: "A1",
            funcFields: obj.getFuncFields()
        };
        if (obj["inRowDoc"]) {
            mData["inRowDoc"] = JSON.stringify(obj["inRowDoc"]);
        }
        //se houver ficheiros, existe um formData...obj.editor.frmData para quadTable , obj.frmData para quadForm
        if (obj instanceof QuadForm) {
            if (obj.frmData) {
                obj.frmData.append("fieldsData", JSON.stringify(mData));
                obj.frmData.append("docsTable", JSON.stringify(obj.docsTable));
                obj.frmData.append("inRowDoc", JSON.stringify(obj["inRowDoc"]));
            }
        } else {
            if (obj.editor.frmData) {
                obj.editor.frmData.append("fieldsData", JSON.stringify(mData));
                obj.editor.frmData.append("docsTable", JSON.stringify(obj.docsTable));
                obj.editor.frmData.append("inRowDoc", JSON.stringify(obj["inRowDoc"]));
            }
        }
        //console.table(obj.dbColumns);

        var ajx = $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                if (obj.editor.frmData || obj.frmData) {
                    // Upload progress
                    xhr.upload.addEventListener(
                            "progress",
                            function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = (evt.loaded / evt.total) * 100;
                                    //upload progress show
                                    $(".progress-bar")
                                            .css("width", percentComplete + "%")
                                            .attr("aria-valuenow", percentComplete);
                                    if (percentComplete >= 100) {
                                        setTimeout(function () {
                                            obj.showSpinner();
                                        }, 0);
                                    }
                                }
                            },
                            false
                            );
                    // Download progress
                    xhr.addEventListener(
                            "progress",
                            function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = (evt.loaded / evt.total) * 100;
                                    console.log(percentComplete + "download");
                                }
                            },
                            false
                            );
                }
                return xhr;
            },
            //condicionamos os atributos do ajax consoante houver ficheiros/uploads ou não.
            //com ficheiros, vai para upload_controller
            //com ficheiros o processData tem que ser true
            //com ficheiros , contentType é "application/x-www-form-urlencoded; charset=UTF-8"
            type: "POST",
            url:
                    obj.editor.frmData || obj.frmData
                    ? obj.pathToSqlFile + obj.uploadController
                    : obj.pathToSqlFile + obj.sqlFile,
            data:
                    obj.editor.frmData || obj.frmData
                    ? obj.editor.frmData || obj.frmData
                    : mData,
            processData: obj.editor.frmData || obj.frmData ? false : true,
            contentType:
                    obj.editor.frmData || obj.frmData
                    ? false
                    : "application/x-www-form-urlencoded; charset=UTF-8",
            cache: false,
            async: true,
            beforeSend: function () {
                if (!obj.editor.frmData && !obj.frmData) {
                    obj.showSpinner();
                } else {
                    if (obj instanceof QuadForm) {
                        var pgrBar =
                                '<div class="progress">' +
                                '<div class="progress-bar" role="progressbar" style="width: 0% " aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>' +
                                "</div>" +
                                "</div>";
                        $(obj.formId).prepend(pgrBar);
                    }
                }
            },
            success: function () {
                obj.instanceUpToDate();
                if (obj instanceof QuadForm) {
                    $(obj.formId)
                            .find(".progress")
                            .remove();
                }
            }
        });
        return ajx;
    };
    QuadCore.prototype.getData = function (
            init,
            startIndex,
            endIndex,
            asyncBool,
            syncDate
            ) {
        var obj = this;
        syncDate = syncDate || null;
        asyncBool = asyncBool || true;
        if (obj["sortInfo"]) {
            $("#sort_" + obj.tableId).addClass("btn-warning");
        }
        //redireccionado se operação for diferente de SELECT
        if (this.operation != "SELECT") {
            obj.requestForOperation();

            return;
        }

        //descodificação do orderBy personalizado
        if (init) {
            this.startIn = 0;
        }
        // PMA EXTENTION to ORDER BY
        if (obj instanceof QuadTable) {
            var hasComplexList = _.find(obj.tableCols, {complexList: true}),
                    hasDomain = _.find(obj.tableCols, {attr: {"domain-list": true}}),
                    tableClauseOnOrder = "";
        } else {
            var hasComplexList = $(".complexList", obj.formId),
                    hasDomain = $(obj.formId).find("[domain-list]"),
                    tableClauseOnOrder = "";
        }
        tableClauseOnOrder = obj.table;
        try {
            if (
                    obj["sortInfo"] &&
                    (obj["order"] !== false && obj["order"] !== undefined)
                    ) {
                if (hasComplexList !== undefined || hasDomain !== undefined) {
                    //Has ComplexList(s) OR Domain(s)-> Order BY uses TABLE+_ORD_VW
                    tableClauseOnOrder = obj.table + "_ORD_VW";
                }
            }
        } catch (e) {
            console.log("try catch null :(");
        }
        var sqlData = {};
        if (syncDate) {
            sqlData = obj.sqlForSyncronizeData(sqlData, syncDate, tableClauseOnOrder);
        }
        //obj.setDML()

        if (obj.order && obj.sortInfo) {
            obj.decodeFiltersText();
            obj.mapSortFiltersToWhereClause();
        } else {
            obj.mapFiltersWhereClause();
        }

        //towards backwards compatible Line of code
        obj.where_str = obj.finalWhereClause();
        //console.table(obj.dbColumns);
        var postData = {
            pk: obj.pk.primary,
            workFlow: obj.workFlow,
            operation: obj.operation,
            operacao: obj.operation,
            columnsArray: JSON.stringify(obj.dbColumns),
            table: tableClauseOnOrder,
            maxRecords: endIndex ? endIndex : obj.recordBundle,
            startIn: startIndex ? startIndex : obj.startIn,
            order_by: obj.decodeOrderBy(),
            sql: sqlData["sql"],
            dbWhere: obj.finalWhereClause(),
            inRowDoc: JSON.stringify(obj["inRowDoc"])
                    //dbAlias: "A1"
        };

        return obj.requestForSelect(postData, asyncBool, syncDate);
    };
    QuadCore.prototype.decodeFiltersText = function () {
        var obj = this;
        if (obj instanceof QuadForm) {
            var el = "";
            _.forEach(obj.sFilters, function (ob, i) {
                el = $('[name="' + ob.name + '"]', obj.formId);
                if (el.attr("dependent-group")) {
                    obj.sFilters[i]["value"] = el.val();
                    obj.sFilters[i]["text"] = el.find(":selected").text();
                }
            });
        } else {
            _.forEach(obj["sFilters"], function (o, i) {
                var ob = _.find(obj.tableCols, {name: o.name});
                var idx = _.findIndex(obj["sFilters"], {name: ob.name});
                if (ob["complexList"]) {
                    var arr =
                            initApp.joinsComplexData[obj.getComplexListIndex(ob, null, true)];
                    var search = {};
                    var value = _.find(arr, search);
                    obj["sFilters"][idx]["text"] = value[Object.keys(arr[0])[0]];
                    obj.buildWhereClause(
                            ob.name,
                            obj["sFilters"][idx]["text"],
                            "query",
                            true
                            );
                } else if (ob["attr"]["domain-list"]) {
                    var search = {};
                    var arr = initApp.joinsData[ob["attr"]["dependent-group"]];
                    search["RV_LOW_VALUE"] = obj["sFilters"][i]["value"];
                    var value = _.find(arr, search);
                    obj["sFilters"][idx]["text"] = value["RV_MEANING"];
                    obj.buildWhereClause(
                            ob.name,
                            obj["sFilters"][idx]["text"],
                            "query",
                            true
                            );
                }
            });
        }
    };

    QuadCore.prototype.requestForSelect = function (postData, asyncBool, syncDate) {
        var obj = this;
        var promise = $.ajax({
            type: "POST",
            url: syncDate
                    ? obj.pathToSqlFile + "returnSqlRes.php"
                    : obj.pathToSqlFile + obj.sqlFile,
            data: postData,
            cache: false,
            async: asyncBool,
            beforeSend: function () {
                obj.showSpinner();
            },
            
        }).done(function () {
            obj.instanceUpToDate();

        });
        return promise;
    };

    QuadCore.prototype.requestForOperation = function () {
        var obj = this;
        $.when(obj.executeDml()).then(function (dat) {
            var data = JSON.parse(dat);
            if (obj.checkError(data, $("#" + obj.tableId + "_editorForm"))) {
                return;
            }
            if (obj.workFlow && obj.workFlow.mode) {
                if (obj.workFlow.mode === "postponed") {
                    obj.editor.close();

                    obj.notifyPostponedWorkflowToUser(data);
                    if (data["status"] == "ok" || data["msg"] == "ok") {
                        return;
                    }
                }
            }

            if (dat) {
                //se operação de delete for bem sucedida, temos em memória o registo alvo de delete e apagamos da tabela.
                //fazemos assim pois depois de apagar registo na bd , não o podemos devolver , pois já não existe
                window.copyEditorData.DT_RowId = obj.composeId(
                        obj.pk.primary,
                        window.copyEditorData
                        );
                if (data.status && data.status == "deleted") {
                    obj.deleteTableRow(data, "#" + window.copyEditorData.DT_RowId);
                    return;
                }
                //CREATE COMPLEX LIST COLUMN IN DATATABLE
                // Criamos dinamicamente as colunas de listas complexas pois estas não existem na tabela
                //todo substituir este código por obj.fixData(data)????
                data = obj.fixData(obj.normalizeData(data));
                var rowData = data.data;
                rowData[0].DT_RowId = obj.composeId(obj.pk.primary, rowData[0]);
                _.map(obj.tableCols, function (o, index) {
                    if (_.has(o, "complexList")) {
                        //fazemos a distinção entre o nome do campo e o nome do campo com o valor
                        var fieldName = o.attr.desigColumn ? o.attr.desigColumn : o.attr.name;
                        var field = o.name;
                        //pomos o nome dos campos com os valores que compoem o valor da coluna a ser descodificada
                        var keys = obj.returnListKeys(o);
                        //Compomos e descodificamos com o resultado
                        var search = "";
                        _.map(keys, function (name, i) {
                            if (i < keys.length - 1) {
                                search += rowData[0][name] + "@";
                            } else {
                                search += rowData[0][name];
                            }
                        });
                        var result = _.find(obj.getComplexListIndex(o), {VAL: search});
                        if (result == undefined) {
                            rowData[0][field] = "";
                        } else {
                            rowData[0][field] = result[fieldName];
                        }
                    }
                });
                // END OF CREATE COMPLEX LIST COLUMN IN TABLE
                // FIRE EVENT
                //no evento submit complete reagimos segundo a action pois há que manter/atualizar estados de forma diferente segundo a action

                obj.editor._event("submitComplete", rowData[0]);
                //atualizamos rodapé com count e registo current
                obj.showCountInfo();
            }
        });
    };
    QuadCore.prototype.sqlForSyncronizeData = function (
            sqlData,
            syncDate,
            tableClauseOnOrder
            ) {
        var obj = this;
        var cols = obj.getStringOfColumnsWithDatatypes();
        try {
            //sqlData['sql']=["SELECT * FROM " + tableClauseOnOrder + " T WHERE TO_CHAR(T.TY_TIMELOG.DT_UPDATED,'YYYY-MM-DD HH24:MI:SS')  > '" + syncDate + "'"];
            if (quadConfig.timelogUsertype) {
                //Oracle DB before TIMELOG UPGRADE
                sqlData["sql"] = [
                    "SELECT " +
                            cols +
                            ", T.TY_TIMELOG.DT_INSERTED, T.TY_TIMELOG.DT_UPDATED FROM " +
                            tableClauseOnOrder +
                            " T WHERE  TO_CHAR(T.TY_TIMELOG.DT_UPDATED,'YYYY-MM-DD HH24:MI:SS')  > '" +
                            syncDate +
                            "'"
                ];
            } else {
                sqlData["sql"] = [
                    "SELECT " +
                            cols +
                            ", T.DT_INSERTED, T.DT_UPDATED FROM " +
                            tableClauseOnOrder +
                            " T WHERE TO_CHAR(T.DT_UPDATED,'YYYY-MM-DD HH24:MI:SS')  > '" +
                            syncDate +
                            "'"
                ];
            }
        } catch (ex) {
            sqlData["sql"] = [
                "SELECT " +
                        cols +
                        ", T.DT_INSERTED, T.DT_UPDATED FROM " +
                        tableClauseOnOrder +
                        " T WHERE TO_CHAR(T.DT_UPDATED,'YYYY-MM-DD HH24:MI:SS')  > '" +
                        syncDate +
                        "'"
            ];
        }
        return sqlData;
    };
    QuadCore.prototype.finalWhereClause = function () {
        var whereStr = "";
        if (this["initialWhereClause"]) {
            whereStr += this["initialWhereClause"];
        }

        if (this["qFilters"]) {
            //PMA 2020.10.11 :: Quando as condições de pesquisa deixam de ser NULAS (RESET dos FILTROS) dava erro,
            //                  porque terminava com " AND " quando existe uma initialWhereClause inicializada!
            // EXEMPLO:
            //      ...
            //      where_status = '';
            //      ...
            //      refreshQuadTable(WEB_ETICKETS, where_status);
            //
            //if (this["initialWhereClause"]) {
            if (this["initialWhereClause"] && Object.entries(this.qFilters).length ) {
                whereStr += " AND ";
            }

            //acrescentamos AND se nao for a primeira entrada de filtro...
            var first_loop = true;
            for (const [key, value] of Object.entries(this.qFilters)) {
                if (key.trim()) {
                    if (!first_loop)
                        whereStr += " AND";
                    whereStr += " " + value;
                } else {
                    whereStr += " " + value;
                }
                first_loop = false;
            }
        }

        return whereStr;
    };

    QuadCore.prototype.fixData = function (dat) {
        var obj = this;
        // APPEND TO RESPONSE . NEEDED FOR PAGINATION AND RECORDS INFO MANIPULATION
        //datatables os nomes das propriedades da esquerda, por isso colocamos la os dados que vem do servidor. Optou-se por esta solução pois seria mais trabalhoso alterar o controlador
        //já que o quadForm usa esta informação
        dat["recordsTotal"] = dat.total_Records
                ? dat.total_Records
                : obj.totalRecords;
        dat["recordsFiltered"] = dat.total_Records
                ? dat.total_Records
                : obj.totalRecords;
        obj["totalRecords"] = dat.total_Records
                ? dat.total_Records
                : obj.totalRecords;
        //CREATE COMPLEX LIST COLUMNS IN TABLE todo centralize in method
        //criação das colunas com as listas complexas. Descrito anteriormente
        _.forEach(dat.data, function (row) {
            var row = row;
            //Replace null by empty stringify
            row = obj.emptyStringToNull(row);

            if (obj instanceof QuadTable) {
                row.DT_RowId = obj.composeId(obj.pk.primary, row);

                _.map(obj.tableCols, function (o, index) {
                    var fieldName = o.attr.desigColumn ? o.attr.desigColumn : o.attr.name;
                    if (fieldName) {
                        fieldName = fieldName.replace(quadConfig.regExpressions.alias, "");
                    }

                    var field = o.name;
                    if (_.has(o, "complexList")) {
                        row = obj.complexListValue(row, o, fieldName, field);
                    }
                    if (_.has(o["attr"], "domain-list")) {
                        row = obj.backwardsCompatibleDomainValue(row, o, fieldName, field);
                    }
                });
            } else {
                //descodificação de listas no quadForm
                _.map(obj.complexLists, function (o, index) {
                    var fieldName = o.desigColumn ? o.desigColumn : o.name;
                    if (fieldName) {
                        fieldName = fieldName.replace(quadConfig.regExpressions.alias, "");
                    }
                    var field = o.name;
                    row = obj.complexListValue(row, o, fieldName, field);
                });
            }
        });
        // END OF CREATE COMPLEX LIST COLUMNS IN TABLE
        //retornamos os dados para renderizar no datatables
        setTimeout(function () {
            //obj.hideSpinner();

            if (obj instanceof QuadTable) {
                if (obj.editor.s.action == "query") {
                    obj.editor.close();
                }
            }
        }, 1);

        return dat;
    };
    QuadCore.prototype.conditionClause = function (txt, clause, field, date) {
        var obj = this;
        //Recebe uma string com a condição (txt) e o uma condição por defeito (LIKE, =) e devolve a string a aplicar no SQL
        var clauseTrimmed = $.trim(clause);
        var output = "";
        txt = $.trim(txt);
        if (!isNaN(txt)) {
            txt = "'" + txt + "'"; //txt = txt;
        } else {
            txt = "'" + txt + "'";
        }
        if (clause) {
            clause = clauseTrimmed + " ";
            output = obj.conditionClauseString(txt, clause, field, date);
        } else {
            if (date) {
                output = "=" + txt;
            } else {
                if (txt.indexOf("%") !== -1) {
                    output = field + " LIKE " + txt;
                } else {
                    output = field + "=" + txt;
                }
            }
        }
        this.qFilters = this.qFilters || {};
        //guardamos o filtro num array para posterior manipulação
        this.qFilters[field] = output;
        return output;
    };

    QuadCore.prototype.conditionClauseString = function (txt, clause, field, date) {
        var obj = this;
        var output = "";
        switch (clause.trim()) {
            case "BETWEEN":
                if (date) {
                    var match = txt.match(/\d{4}-\d{2}-\d{2}/g);
                    if (match && match[0] && match[1]) {
                        output = " " + clause + " '" + match[0] + "' AND '" + match[1] + "'";
                    } else {
                        console.log("3. Check condition");
                    }
                } else {
                    var match = txt.match(/\d+/g);
                    if (match && match[0] && match[1]) {
                        output = field + " " + clause + " " + match[0] + " AND " + match[1];
                    } else {
                        console.log("4. Check condition.");
                    }
                }
                break;
            case "IN":
                output =
                        field + " " + clause + " " + txt.substring(1, txt.length - 1) + " "; //On txt, removes first and last char (')
                break;
            case "IS NULL":
                if (date) {
                    output = " " + clause;
                } else {
                    output = field + " " + clause;
                }
                break;
            case "IS NOT NULL":
                if (date) {
                    output = " " + clause;
                } else {
                    output = field + " " + clause;
                }
                break;
            case "LIKE":
                output = obj.likeClause(clause, field, txt, date);

                break;
            case "%":
                clause = "LIKE ";
                output = obj.likeClause(clause, field, txt, date);
                break;
            default:
                if (date) {
                    output = " " + clause + " " + txt + " ";
                } else {
                    output = field + " " + clause + " " + txt + " ";
                }
                break;
        }
        return output;
    };

    QuadCore.prototype.likeClause = function (clause, field, txt, date) {
        var output = "";
        if (!isNaN(txt)) {
            if (date) {
                output = " LIKE '%" + txt + "%'";
            } else {
                output = " CAST(" + field + " AS VARCHAR(20)) LIKE '%" + txt + "%'";
            }
        } else {
            if (date) {
                output = " " + clause + "'%" + txt.replace(/'/g, "") + "%'";
            } else {
                output = field + " " + clause + "'%" + txt.replace(/'/g, "") + "%'";
            }
        }
        return output;
    };
    QuadCore.prototype.normalizeData = function (json) {
        //pomos {} dentro de data[];
        if (!json.hasOwnProperty("data")) {
            var normalizedJson = {};
            normalizedJson.data = [];
            normalizedJson.data.push(json);
            return normalizedJson;
        } else {
            return json;
        }
    };
    QuadCore.prototype.filterTag = function (val, name, title, text) {
        var obj = this;
        var container =
                obj instanceof QuadForm ? obj.formId.substring(1) : obj.tableId;
        $("." + container + "_sFilters").append(
                '<li style="margin-right:5px" data-filter="' +
                name +
                ":" +
                val +
                '" data-id="' +
                container +
                '" class="label label-info">' +
                title +
                " : " +
                text +
                '<i style="margin-left:5px" class="sFilter fas fa-times"></i></li>'
                );
    };
    QuadCore.prototype.checkError = function (dat, frm, filters) {
        //filters é passado para distinguir se é uma query....
        //este método é sempre chamado após um request ao servidor para determinar se a resposta contém erros ou outra informação relevante.
        //retornamos true se assim for e não prosseguimos com a renderização na tabela pois a informação não contem registos e já foi tratada aqui
        var obj = this;

        if (dat && dat.error && filters) {
            //PMA:ERROR HANDLING: Create ROW to display DB error
            toastr.clear();

            quad_notification({
                type: "error",
                title: JS_OPERATION_ERROR,
                content: dat.error
            });

            obj.hideSpinner();
            if (!obj["sFilters"]) {
                $("." + obj.tableId + "_sFilters").empty();
            }

            obj.resetData();
            return true;
        }
        if (dat && dat.error) {
            //PMA:ERROR HANDLING: Create ROW to display DB error
            if (frm && frm.length > 0) {
                $(".editorForm")
                        .parents(".modal-content")
                        .find(".modal-header")
                        .removeClass("loadingList");
                $(".editorErrorContainer", frm).remove();
                frm
                        .append(
                                '<div class="editorErrorContainer"><div class="editorError">' +
                                dat.error +
                                "</div></div>"
                                )
                        .css("display", "block");
                $(".editorErrorContainer")
                        .get(0)
                        .scrollIntoView();
            } else {
                quad_notification({
                    type: "error",
                    title: JS_OPERATION_ERROR,
                    content: dat.error
                });
            }
            return true;
        }
        if (dat && dat.status && dat.status == "unchanged") {
            $(".editorForm")
                    .parents(".modal-content")
                    .find(".modal-header")
                    .removeClass("loadingList");
            $(".editorErrorContainer", frm).remove();
            if (obj instanceof QuadTable) {
                frm
                        .append(
                                '<div class="editorErrorContainer"><div class="editorError">' + JS_CHANGE_BEFORE_PROCEED + '</div></div>'
                                )
                        .css("display", "block");
                $(".editorErrorContainer")
                        .get(0)
                        .scrollIntoView();
            } else {
                quad_notification({
                    type: "warning",
                    title: JS_OPERATION_ABORT,
                    content: JS_CHANGE_BEFORE_PROCEED,
                    timeout: 5000
                });
            }

            return true;
        } else {
            return false;
        }
    };
    QuadCore.prototype.getFromSql = function (sql, asyncBool) {
        //Método que serve para enviar um statement sql ou um array de statements , para ser executado no servidor.
        var obj = this;
        if (asyncBool !== false) {
            asyncBool = true;
        }
        _.forEach(sql, function (sq, key) {
            sq = sq.replace(":where", " where " + obj.finalWhereClause());
            sql[key] = sq;
        });
        var promise = $.ajax({
            type: "POST",
            url: datatable_instance_defaults.pathToSqlFile + "returnSqlRes.php",
            data: {sql: sql},
            cache: false,
            async: asyncBool
        });
        return promise;
    };
    QuadCore.prototype.getInstanceComplexLists = function () {
        var obj = this;
        if (obj instanceof QuadTable) {
            var cxLists = obj.tableCols
                    .filter(function (x) {
                        return x.complexList === true;
                    })
                    .map(function (x) {
                        x.attr["idx"] = obj.getComplexListIndex(x, null, true);
                        return x.attr;
                    });
        } else {
            var cxLists = obj.complexLists;
            _.map(cxLists, function (x) {
                x["idx"] = obj.getComplexListIndex(x, null, true);
                return x;
            });
        }

        return cxLists;
    };
    QuadCore.prototype.getInstanceDomains = function () {
        var obj = this;
        if (obj instanceof QuadTable) {
            var domains = obj.tableCols
                    .filter(function (x) {
                        return x["attr"]["domain-list"] === true;
                    })
                    .map(function (x) {
                        x.attr["idx"] = x.attr["dependent-group"];
                        return x.attr;
                    });
        } else {
            var domains = obj.domainLists;
            _.map(domains, function (x) {
                if (!x["idx"]) {
                    x["idx"] = x["dependent-group"];
                }

                return x;
            });
        }

        return domains;
    };

    QuadCore.prototype.getStringOfColumnsWithDatatypes = function () {
        var obj = this;
        var cols = obj.dbColumns.map(function (v) {
            if (v.datatype && v.datatype.toUpperCase() !== "SEQUENCE") {
                return obj.toDateToDateTime(v.datatype, v.db) + " AS " + v.db;
            } else {
                return v.db;
            }
        });
        return cols.join(",");
    };

    QuadCore.prototype.exportData = function () {
        var obj = this;
        var worker1 = new Worker(pn + quadConfig.export_controller); //"assets/lib/utils/sampleWorker.js");
        var cols = obj.getStringOfColumnsWithDatatypes();

        /* array pois podemos querer mais dados de diferent SQL*/
        var sql = ["select " + cols + " from " + obj.table + " :where"];
        _.forEach(sql, function (sq, key) {
            sq = sq.replace(
                    ":where",
                    obj.finalWhereClause() !== ""
                    ? " where " + obj.finalWhereClause()
                    : " where 1 = 1"
                    );
            obj.order_by
                    ? (sql[key] = sq + " ORDER BY " + obj.order_by)
                    : (sql[key] = sq);
        });
        if (obj instanceof QuadForm) {
            var visibleCols = $(obj.formId)
                    .find(".visibleColumn")
                    .map(function (i, col) {
                        return col.getAttribute("name");
                    });
            var arrCols = [];
            arrCols = _.map(visibleCols, function (name, i) {
                if (i < visibleCols.length) {
                    return name;
                }
            });
        }
        if (obj instanceof QuadTable) {
            //todo???
        }
        var cxLists = obj.getInstanceComplexLists();

        var message = {
            operation: "export",
            cxLists: cxLists,
            sql: sql,
            defaults: datatable_instance_defaults.pathToSqlFile,
            tableId: obj.tableId,
            tableCols: obj.tableCols,
            dbColumns: obj.dbColumns,
            pk: obj.pk.primary,
            loadedData: initApp.joinsComplexData,
            domains: initApp.joinsData,
            type: obj instanceof QuadForm ? "QuadForm" : "QuadTable",
            visibleCols: arrCols ? arrCols : null,
            formComplexLists: obj.complexLists,
            formDomainsLists: obj.domainLists,
            decodeExport:
                    obj["export"].decodeExport === false ? obj["export"].decodeExport : null
        };
        worker1.postMessage(JSON.stringify(message));
        worker1.onmessage = function (event) {
            if (event.data.download) {
                //o ficheiro foi criado no servidor, é necessário fazer o download

                obj.manageFileDownload(event.data.download);

                //Remoção do ficheiro temporário no servidor
                setTimeout(function () {
                    quad_notification_clear();
                    obj.hideProcess();
                    $.get(
                            window.location.origin +
                            datatable_instance_defaults.pathToSqlFile +
                            "returnSqlRes.php",
                            {
                                file: event.data.file,
                                action: "delete"
                            }
                    );
                }, 100);
                return;
            }
            //processo foi despoletado, mostra informação
            if (event.data === "working") {
                obj.showProcess(JS_EXPORTING + " " + obj.tableId);
            } else {
                //a resposta do web worker é diferente de 'working', tratar de descarregar o ficheiro...
                // descarregado através de "clientside". Até 500 mb é seguro fazer assim
                //persiste problema no servidor partilhado e com pouca RAM
                quad_notification_clear();
                //var fileData = decodeURI(event.data);
                var fileData = "\ufeff" + decodeURI(event.data); //ADD BOM to EXCEL
                var blobObject = new Blob([fileData], {
                    type: "text/csv;charset=utf-8,%EF%BB%BF"
                });
                if (window.navigator.msSaveOrOpenBlob) {
                    // for IE and Edge
                    window.navigator.msSaveOrOpenBlob(
                            blobObject,
                            initCaps(obj.tableId ? obj.tableId : obj.formId.substring(1)) + ".csv"
                            );
                } else {
                    obj.manageFileDownload((URL || webkitURL).createObjectURL(blobObject));
                }
                quad_notification_clear();
                obj.hideProcess();
            }
        };
    };

    QuadCore.prototype.manageFileDownload = function (binaryData) {
        var obj = this;
        var link = document.createElement("a");
        document.body.appendChild(link);
        link.download =
                initCaps(obj.tableId ? obj.tableId : obj.formId.substring(1)) + ".csv";
        link.href = binaryData;
        link.click();
        link.remove();
    };

    QuadCore.prototype.showProcess = function (process) {
        var obj = this,
                i = parseInt(Processo.nextKey()),
                slots = {};
        obj.workerId = "";
        if (process && i) {
            slots = {
                id: i,
                name: process,
                time: Date.now()
            };
            Processo.create(slots);
            obj.workerId = i;
        } else {
            alert("QuadCore: Unable no catch process or id (" + process + +", " + id);
        }
        obj.updateProcessList();
    };
    QuadCore.prototype.hideProcess = function () {
        var obj = this;
        if (obj.workerId) {
            Processo.destroy(obj.workerId);
            obj.workerId = "";
        } else {
            alert(
                    "QuadCore: Unable no catch process or id (" + process + ", w/ Id. " + id
                    );
        }
        obj.updateProcessList();
    };
    /* If process list is visible update it ... */
    QuadCore.prototype.updateProcessList = function () {
        var cnt = 0,
                field = document.getElementById("processCtrl");
        if (field !== null) {
            //Only runs after authentication (skips on LOGIN)
            cnt = Processo.counter();
            field.textContent = cnt;
        }
        if (
                $("#activity")
                .next(".ajax-dropdown")
                .is(":visible")
                ) {
            Processo.stopTimer();
            Processo.listProcessos(".notification-body");
            Processo.startTimer();
        }
    };
    QuadCore.prototype.buttonManagerCentralized = function (frm) {
        //controla estado, localização e eventos do switch de extras
        var obj = this;
        if (obj.export != false) {
            if (obj instanceof QuadForm) {
                /* removemos # do id do form*/
                var objName = obj.formId.substring(1);
                frm.find(".switchSpan").addClass("switchSpan_" + objName);
                var switchExtras = frm.find(".exportForm");
                $(switchExtras).attr("id", "switch_" + objName);
                var labelExtras = $("#switch_" + objName).next("label");
                $(labelExtras).attr("for", "switch_" + objName);
                $("#switch_" + objName).click(function () {
                    $(this).toggleClass("open");
                    if ($(this).hasClass("open")) {
                        if (frm.find(".dt-buttons").length === 0) {
                            $(".switchSpan_" + objName).after(
                                    '<div class="dt-buttons"><a class="dt-button buttons-excel buttons-html5 btn btn-default btn-xs" tabindex="0"  href="#"><span><i class="fal fa-file-excel fa-lg" aria-hidden="true"></i></span></a></div>'
                                    );
                            if (obj.import) {
                                var importBt =
                                        '<a class="dt-button importBt " tabindex="0"  href="#"><span>Import</span></a>';
                                frm.find(".dt-buttons").append(importBt);
                            }
                        }
                    } else {
                        frm.find(".dt-buttons").remove();
                    }
                });
                frm.on("click", ".buttons-excel", function (e) {
                    e.preventDefault();
                    exportTo.call(obj);
                });
                frm.on("click", ".importBt", function (e) {
                    e.preventDefault();
                    importTo.call(obj);
                });
            } else {
                obj.tbl.extBut = extBut;
                var tableTools = new $.fn.dataTable.Buttons(obj.tbl, {
                    buttons: obj.buttons
                });

                $(obj.buttonInsertOn).length !== 0
                        ? $(obj.buttonInsertOn).html(tableTools.container())
                        : $(tableTools.container()).insertBefore(
                        "#" + this.tableId + "_dtAdvancedSearch"
                        );
                $(tableTools.container()).insertBefore(
                        $("#" + this.tableId + "_dtAdvancedSearch")
                        ? $("#" + this.tableId + "_dtAdvancedSearch")
                        : $("#" + this.tableId)
                        );
                $(obj.tbl.extBut)
                        .insertBefore(tableTools.container())
                        .addClass("switchSpan_" + this.tableId);
                var switchExtras = $(".switchSpan_" + this.tableId).find(
                        'input[type="checkbox"]'
                        );
                $(switchExtras).attr("id", "switch_" + obj.tableId);
                var labelExtras = $(".switchSpan_" + this.tableId).find("label");
                $(labelExtras).attr("for", "switch_" + obj.tableId);
                $(obj.tbl.buttons().container()).hide();
                $("#switch_" + obj.tableId).click(function () {
                    $(this).toggleClass("open");
                    if ($(this).hasClass("open")) {
                        $(obj.tbl.buttons().container()).show();
                        _.forEach(obj.tbl.buttons(), function (o, i) {
                            $(obj.tbl.buttons().container()).show(o.node);
                            $(o.node).show();
                        });
                    } else {
                        $(obj.tbl.buttons().container()).hide();
                        _.forEach(obj.tbl.buttons(), function (o, i) {
                            $(obj.tbl.buttons().container()).hide(o.node);
                            $(o.node).hide();
                        });
                    }
                });
                if (obj.import) {
                    obj.tbl.button().add(0, {
                        action: function (e, dt, button, config) {
                            //dt.ajax.reload();
                            importTo.call(obj);
                        },
                        text: "Import"
                    });
                }
            }
        }
    };
    QuadCore.prototype.resetFilter = function (el, tag, arrTags, frm) {
        //todo método deve ser simplificado, mais pequeno
        var obj = this;
        var xtFormData = obj.getFiltersFormsData();

        if (!obj.checkMandatoryFilters(xtFormData)) {
            return false;
        }

        var keys,
                keys2 = [];
        var arr = tag.split(":");
        var f =
                obj instanceof QuadTable
                ? _.find(obj.tableCols, {data: arr[0]})
                : $("#" + frm + " [name=" + arr[0] + "]");
        if (obj.sFilters && f) {
            var idx = arr[0];
            if (
                    (f.complexList || (f instanceof $ && f.hasClass("complexList"))) &&
                    !obj["sortInfo"]
                    ) {
                keys = obj.returnListKeys(f);
                _.forEach(arrTags, function (item) {
                    //if current cycle element its not same element as the click target
                    if (el.get(0) !== $(item).get(0)) {
                        var arr2 = $(item)
                                .data("filter")
                                .split(":");
                        var y =
                                obj instanceof QuadTable
                                ? _.find(obj.tableCols, {data: $.trim(arr2[0])})
                                : $("#" + frm + " [name=" + $.trim(arr2[0]) + "]");
                        if (y.complexList) {
                            if (obj.returnListKeys(y).length > obj.returnListKeys(f).length) {
                                //todo bug fix, this can lead to bugs
                                keys = _.intersection(keys, obj.returnListKeys(f));
                            } else {
                                keys = _.difference(obj.returnListKeys(f), obj.returnListKeys(y));
                            }
                        } else {
                        }
                    } else {
                        if (obj.editorXt) {
                            _.remove(obj.sFilters, {
                                name: $(item)
                                        .data("filter")
                                        .split(":")[0]
                            });
                            if (f.complexList) {
                                keys2 = _.difference(
                                        Object.keys(obj.qFilters),
                                        _.difference(Object.keys(obj.qFilters), obj.returnListKeys(f))
                                        );
                            }
                        }
                    }
                });
                if (keys2.length > 0) {
                    keys = keys2;
                }
                if (keys) {
                    _.map(keys, function (val, i) {
                        var k = _.findIndex(obj.dbColumns, {db: val});
                        if (k !== -1) {
                            obj.dbColumns[k]["prv_value"] = "";
                            obj.dbColumns[k]["nxt_value"] = "";
                        }
                        delete obj.qFilters[val];
                    });
                }
            } else {
                if (obj["sortInfo"]) {
                    null;
                } else {
                    var k = _.findIndex(obj.dbColumns, {db: arr[0]});
                    if (k !== -1) {
                        obj.dbColumns[k]["prv_value"] = "";
                        obj.dbColumns[k]["nxt_value"] = "";
                    }
                }
                delete obj.qFilters[$.trim(idx)];
            }
            _.remove(obj.sFilters, {name: idx});
            //removemos o elemento clickado do array de filters tags
            if (obj.sFilters.length === 0) {
            }
            if (Object.keys(obj.qFilters).length === 0) {
                delete obj.qFilters;
            }
            if (obj.editorXt) {
                //atualizamos os filtros exteriores , sincronizamos de acordo com o evento despoletado pelo user
                $("[name=" + f.name + "]", obj.externalFilter.template.selector).val("");
                $("[name=" + f.name + "]", obj.externalFilter.template.selector).trigger(
                        "change"
                        );
            }
            if (el.closest("form").hasClass("extendedForm")) {
                //return
                if (el.is("li")) {
                    el.remove();
                }
            } else {
                el.remove();
            }
        }
        //fazemos o request dos dados segundo o tipo da instância
        if (obj instanceof QuadTable) {
            obj.editor.s.action = "query";
            obj.operation = "SELECT";
            $.when(obj.getData(true)).then(function (dat) {
                var dat = JSON.parse(dat);
                if (obj.checkError(dat, $("#" + obj.tableId + "_editorForm"), true)) {
                    return;
                }
                $("#" + obj.tableId + "_dtAdvancedSearch").show();
                //renderizamos os dados
                obj.clearTable();
                obj.tbl.clear();
                var recordSet = obj.fixData(dat);
                obj.tbl.rows.add(recordSet.data);
                obj["dtCallback"](recordSet);
                obj.showCountInfo();
                obj.tbl.rows().deselect();
                $("#" + obj.tableId)
                        .DataTable()
                        .columns.adjust()
                        .responsive.recalc();
                $(window).trigger("resize");
            });
        } else if (obj instanceof QuadForm) {
            obj.retrieveDisplayData($("#" + frm));
        }
    };
    QuadCore.prototype.userRestrictions = function () {
        //Interface em QUERY ONLY mode?
        //Which columns CAN'T this guy SEE?
        var index = -1;
        var colStr = "";
        var obj = this;
        var strData = [];
        obj.userSpecifics = [];
        $.ajax({
            type: "POST",
            url:
                    window.location.pathname.replace("home.php", "") +
                    "data-source/" +
                    obj.sqlFile,
            data: {
                user: quadConfig.user,
                request_id: "userSpecifics",
                table: obj.table
            },
            cache: false,
            async: false,
            success: function (strData) {
                step = 3;
                try {
                    step = 4;
                    myObjectName.userSpecifics = jQuery.parseJSON(strData);
                } catch (e) {
                    if (obj.myData["data"] !== undefined) {
                        alert("A0.ERRO->" + step + " Idx:" + idx + ": " + e);
                    }
                }
            }
        });
    };
    QuadCore.prototype.acl = function (frm,flag) {
        //todo requests to get userspecifics are in userRestrictions()
        var obj = this;
        if (this.crud) {
            _.forEach(this.crud, function (status, i) {
                if (i === 0) {
                    if (status === false) {
                        $("a[data-form-action=new]", frm).hide();
                        $("a[data-form-action=new]", frm).off("click");
                    } else {
                        if(flag){
                            $("a[data-form-action=new]", frm).show();
                        }
                     }
                }

                if (i === 1) {
                    if (status === false) {
                        $("a[data-form-action=edit]", frm).hide();
                        $("a[data-form-action=edit]", frm).off("click");
                    } else {
                        if(flag){
                          $("a[data-form-action=edit]", frm).show();
                        }

                     }
                }
                if (i === 2) {
                    if (status === false) {
                        $("a[data-form-action=delete]", frm).hide();
                        $("a[data-form-action=delete]", frm).off("click");
                    } else {
                         if(flag){
                           $("a[data-form-action=delete]", frm).show();
                         }

                     }
                }
            });
        }
        if (obj.userSpecifics && obj.userSpecifics.hideColumns) {
            _.mapKeys(obj.userSpecifics.hideColumns, function (value, key) {
                obj.hideThisColumn(frm, value);
            });
        }
        if (obj.userSpecifics && obj.userSpecifics.disableColumns) {
            _.mapKeys(obj.userSpecifics.disableColumns, function (value, key) {
                obj.disableColumn(frm, value);
            });
        }
        if (obj.userSpecifics && obj.userSpecifics.hideActions) {
            _.mapKeys(obj.userSpecifics.hideActions, function (value, key) {
                if (value == "create") {
                    value = "new";
                }
                obj.hideAction(frm, value);
            });
        }

        if (obj.userSpecifics && obj.userSpecifics.navQueryOnly === true) {
            if (obj instanceof QuadForm) {
                $(frm)
                        .find("a[data-form-action=new]")
                        .hide();

                $(frm)
                        .find("a[data-form-action=edit]")
                        .hide();
            } else {
                var buttonTh;
                buttonTh = $("#" + obj.tableId + "_wrapper th:last-child");
                //buttonsCell = $("#" + obj.tableId + " td:last-child");
                $(".tblEditBut", "#" + obj.tableId).hide();
                $(".tblCreateBut", buttonTh).hide();
                $(".tblDelBut", "#" + obj.tableId).hide();
            }
        }
    };
    QuadCore.prototype.hideThisColumn = function (frm, dbcolumn) {
        //Esta função chamada do clearForm, de acordo com o definido por userRestriction, permite esconder os campos de input sinalizados.
        //A coluna a esconder é passada no parâmetro dbColumn.
        if (dbcolumn != "") {
            if (this instanceof QuadForm) {
                $("[name=" + dbcolumn + "]", frm).hide();
                $("[for=" + dbcolumn + "]", frm).hide();
                this.hideFieldset();
            } else {
                var col = _.find(this.tbl.settings()[0].aoColumns, {data: dbcolumn});
                var column = this.tbl.column(col.idx);
                column.visible(false);
            }
        }
    };
    QuadCore.prototype.disableColumn = function (frm, dbcolumn) {
        var colToDisable;
        var frmObj;
        if (dbcolumn != "") {
            if (this instanceof QuadForm) {
                $("[name=" + dbcolumn + "]", frm).prop("readonly", true);
            } else {
                $("[name=" + dbcolumn + "]", frm).prop("readonly", true);
            }
        }
    };
    QuadCore.prototype.hideAction = function (frm, action) {
        var actionToDisable;
        var obj = this;
        if (action != "") {
            if (this instanceof QuadForm) {
                if (action === "read") {
                    $(frm).hide();
                    quad_notification({
                        type: "error",
                        title: JS_OPERATION_ABORT,
                        content: JS_INVALID_OPERATION
                    });
                }
                $("a[data-form-action=" + action + "]", frm).hide();
            } else {
                if (action === "read") {
                    $("#" + obj.tableId).hide();
                    quad_notification_clear();
                    quad_notification({
                        type: "error",
                        title: JS_OPERATION_ABORT,
                        content: JS_INVALID_OPERATION
                    });
                }
                if (action === "new") {
                    var buttonTh = $("#" + obj.tableId + "_wrapper th:last-child");
                    $(".tblCreateBut", buttonTh).hide();
                }
                if (action === "edit") {
                    $(".tblEditBut", "#" + obj.tableId).hide();
                }
                if (action === "delete") {
                    $(".tblDelBut", "#" + obj.tableId).hide();
                }
            }
        }
    };

    QuadCore.prototype.nextSortVisible = function (e) {
        $(".orderByUp,.orderByDown").show();
        $($(".orderByUp")[0]).hide();
        $($(".orderByDown")[$(".orderByDown").length - 1]).hide();
        var index = $(".sortField").index(e);
        if (index === 0) {
            $($(".orderByUp")[index]).hide();
        }
        if (index === $(".orderByUp").length - 1) {
            $($(".orderByDown")[index]).hide();
            if ($(".orderByUp").length > 2) {
                $($(".orderByDown")[0]).show();
            }
        }
    };

    QuadCore.prototype.mapSortFiltersToWhereClause = function () {
        var obj = this;
        _.forEach(obj["sFilters"], function (o, i) {
            if (obj instanceof QuadTable) {
                var ob = _.find(obj.tableCols, {name: o.name});
            } else {
                var ob = $(obj.formId).find('[name="' + o.name + '"]');
            }
            var columnName = ob.name || ob.attr("name");
            if (
                    (obj instanceof QuadTable && ob["complexList"]) ||
                    (obj instanceof QuadForm && ob.hasClass("complexList"))
                    ) {
                obj.buildWhereClause(
                        columnName,
                        obj["sFilters"][i][obj["sortInfo"] ? "text" : "value"],
                        "query",
                        true
                        );
            } else if (ob["attr"]["domain-list"]) {
                obj.buildWhereClause(
                        columnName,
                        obj["sFilters"][i][obj["sortInfo"] ? "text" : "value"],
                        "query",
                        true
                        );
            } else {
                obj.buildWhereClause(
                        columnName,
                        obj["sFilters"][i]["value"],
                        "query",
                        true
                        );
            }
        });
    };
    QuadCore.prototype.displaySortOptions = function (
            field,
            sort,
            eTarget,
            options
            ) {
        var obj = this;
        field = field || null;
        eTarget = eTarget || null;
        sort = sort || null;
        options = options || null;
        var output = [];
        output.push("<option> </option>");
        _.map(this.tableCols, function (ob, index) {
            // to exclude functions from orderBy ...
            //  if (ob['title'] && ob['data'] && ob['visible'] !== false && !ob['funcField'] ) {
            if (ob["title"] && ob["data"] && ob["visible"] !== false) {
                if (field && ob.data !== field.val()) {
                    output.push(
                            '<option value="' + ob.data + '">' + ob["title"] + "</option>"
                            );
                } else if (!field) {
                    output.push(
                            '<option value="' + ob.data + '">' + ob["title"] + "</option>"
                            );
                }
            }
        });
        //se as options forem passadas , usamos, senão é usado o output

        return obj.sortFieldUi(sort, field, eTarget, output, output);
    };
    QuadCore.prototype.sortFieldUi = function (
            sort,
            field,
            eTarget,
            options,
            output
            ) {
        var obj = this;
        var el = $('<select class="form-control sortField"></select>').html(
                options ? options : output.join("")
                );

        //se o valor do campo for a nulo(1ª opção)
        if (field && !field.val()) {
            if (obj instanceof QuadForm) {
                field.addClass("error");
                delete obj.sortInfo[field.data("previousValue")];
                var elem = $("[name='" + field.data("previousValue") + "'", obj.formId);
                obj.nextSortVisible(field);
            } else {
                field.addClass("error");
                delete obj.sortInfo[field.data("previousValue")];
                var ob = _.find(obj.tableCols, {data: field.data("previousValue")});
                obj.nextSortVisible(field);
            }

            return;
        }
        if (field && field.val()) {
            field
                    .find('option[value="' + field.val() + '"]')
                    .attr("selected", "selected");
            field.attr("disabled", 1);
            el.html(field.html());
            el.find('option[value="' + field.val() + '"]').remove();
            if (field.val()) {
                field.removeClass("error");
                var o = {};
                o[field.val()] = sort.val();
                //obtemos o index do elemento e pomos no array na mesma ordem porque pode mudar apena o sortValue(asc/desc)
                obj.sortInfo[$(".sortField").index(field)] = o;

                if (obj["sFilters"]) {
                    obj.resetData();

                    obj.mapSortFiltersToWhereClause();
                }
            }
            //se etarget for um sortValue (asc/desc) , return, não criamos main nenhuma row
            if ($(eTarget).hasClass("sortValue")) {
                $(eTarget)
                        .find('option[value="' + $(eTarget).val() + '"]')
                        .attr("selected", "selected");
                return;
            }
        } else {
            //isto é na inicialização
            var el = $('<select class="form-control sortField"></select>').html(
                    options ? options : output.join("")
                    );
        }
        var sortEl = $(
                '<select class="form-control sortValue"><option value="ASC">ASC</option><option value="DESC">DESC</option></select>'
                );
        var html = $('<div class="row form-group contentRow"></div>')
                .append($('<div class="col-sm-5"></div>').append(el))
                .append($('<div class="col-sm-3"></div>').append(sortEl));
        return html;
    };

    QuadCore.prototype.isEmptyForm = function (frm) {
        var obj = this;
        var emptyFrm = true;
        frm.find(":input").each(function (idx) {
            //se houver algum campo com valores, significa que o form não está vazio
            if ($(this).val()) {
                emptyFrm = false;
            }
        });
        return emptyFrm;
    };
    QuadCore.prototype.decodeOrderBy = function () {
        /*
         Metodo que descodifica o array de objectos constantes no obj.sortInfo , para uma string, a ser usada no SQL order by
         */
        var obj = this;
        var o, ob, keys;
        var orderByStr = "";
        if (obj.sortInfo) {
            _.map(obj.sortInfo, function (name, i) {
                orderByStr +=
                        Object.keys(name)[0] + " " + name[Object.keys(name)[0]] + ", ";
            });
            orderByStr = orderByStr.replace(/,\s*$/, "");
            return orderByStr;
        } else {
            return obj.order_by;
        }
    };
    QuadCore.prototype.checkUserPreferences = function () {
        var obj = this;
        //adicionar aqui quando se fizer utilização de uma nova key no localStorage
        var persistenceKeys = ["sortInfo", "columnReorder"];
        _.forEach(persistenceKeys, function (key, i) {
            if (obj instanceof QuadTable) {
                if (localStorage.getItem(obj.tableId + "_" + key) !== "undefined") {
                    try {
                        obj[key] = JSON.parse(localStorage.getItem(obj.tableId + "_" + key));
                    } catch (e) {
                        obj[key] = localStorage.getItem(obj.tableId + "_" + key);
                    }
                }
            } else {
                var frm = obj.formId.substring(1);
                if (localStorage.getItem(frm + "_" + key) !== "undefined") {
                    try {
                        obj[key] = JSON.parse(localStorage.getItem(frm + "_" + key));
                    } catch (e) {
                        obj[key] = localStorage.getItem(frm + "_" + key);
                    }
                }
            }
        });
    };
    QuadCore.prototype.externalMultiFilterInit = function (frm, requestData) {
        var obj = this;

        $.each($(frm).find(':input:not(".chosen-search-input")'), function (i, field) {
            obj.signalMandatoryFilters(frm, obj.externalFilter.templateMulti, field);
        });

        //todo load complexLists....but problem with non standard externalMulti fform filters
        obj.populateDomainLists(frm, null);
        if (!$(frm).hasClass("registered")) {
            obj.externalMultiFilterChange(frm);
            $(frm).addClass("registered");
        }
        if (requestData !== false) {
            obj.filterInstance();
        }

        obj.instanceUpToDate();
    };
    QuadCore.prototype.isExternalFilter = function (name) {
        var obj = this;
        if (obj.externalFilter && obj.externalFilter.templateMulti) {
            var el = $(
                    "[name=" + name + "]",
                    obj.externalFilter.templateMulti.selector
                    );
            if (el.length > 0) {
                return true;
            }
        }
        if (obj.externalFilter && obj.externalFilter.template) {
            var el = $("[name=" + name + "]", obj.externalFilter.template.selector);
            if (el.length > 0) {
                return true;
            }
        }
        return false;
    };
    QuadCore.prototype.signalMandatoryFilters = function (form, attribute, field) {
        var obj = this;
        if (attribute.mandatory) {
            if ($.inArray(field.name, attribute.mandatory) !== -1) {
                $("[for=" + field.id + "]", form).addClass("required");
                $("[for=" + field.name + "]", form).addClass("required");
            }
        }
    };
    QuadCore.prototype.checkMandatoryFilters = function (xtFormData) {
        var obj = this;
        var status = true;

        if (obj.externalFilter) {
            if (obj.externalFilter.template) {
                status = obj.checkMandatoryFilterFields(
                        obj.externalFilter.template,
                        xtFormData,
                        status
                        );
            }

            if (obj.externalFilter.templateMulti) {
                status = obj.checkMandatoryFilterFields(
                        obj.externalFilter.templateMulti,
                        xtFormData,
                        status
                        );
            }
        }

        return status;
    };
    QuadCore.prototype.checkMandatoryFilterFields = function (
            filter,
            xtFormData,
            status
            ) {
        var obj = this;
        $(filter.selector)
                .nextAll(".quadAlert")
                .remove();
        //ao criarmos um registos, se os filtros mandatórios não estiverem todos preenchidos, alertamos o utilizador e flag=0

        _.forEach(xtFormData, function (fld, i) {
            var el = $('[name="' + fld.name + '"]', filter.selector);
            var elChosen = $("#" + el.attr("id") + "_chosen");
            if (
                    filter.mandatory &&
                    $.inArray(fld.name, filter.mandatory) != -1 &&
                    (fld.value == "" || fld.value == null)
                    ) {
                /*el.addClass("error");
                 elChosen.addClass("error");*/
                $("#" + obj.tableId + "_dtAdvancedSearch").hide("slow");
                status = false;
            } else {
                el.removeClass("error");
                elChosen.removeClass("error");
            }
        });
        return status;
    };
    QuadCore.prototype.manageFiltersData = function () {
        var obj = this;
        var xtFormData = obj.getFiltersFormsData();

        if (!obj.checkMandatoryFilters(xtFormData)) {
            return false;
        }

        obj.filtersDataToColumns(xtFormData);
        return true;
    };

    QuadCore.prototype.filtersDataToColumns = function (xtFormData) {
        var obj = this;
        if (xtFormData) {
            //limpamos valores menos campos que estejam relacionados com o master, se for um master resetamos tudo(referimonos á dbColumns)
            //obtemos os dados num formato mais simples  e preenchemos com valores dos filtros exteriores, pois estes estão preenchidos
            var data = obj.convertToDTRowData(obj.dbColumns);
            //pomos os valores dos filtros nos campos correspondentes(mapeamos os filtros) para serem pre-preenchidos
            xtFormData.forEach(function (d) {
                data[d.name] = d.value;
            });

            //depois dos filtros pre-preenchidos temos que atualizar a dbColumns
            //normalizamos...ie, pomos dentro de data.data , convencionamos assim
            data = obj.normalizeData(data);

            //voltamos a por dentro do dbcolumns para estar acessível no post etc..
            obj.prepareData(data);
        }
    };

    QuadCore.prototype.externalMultiFilterChange = function (frm) {
        var obj = this;

        var formData = obj.getFiltersFormsData();
        _.remove(formData, {value: ""});
        _.remove(formData, {value: null});
        if (!obj.sFilters) {
            obj.sFilters = formData;
        } else {
            obj.filterFilters(formData);
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
                        e.stopImmediatePropagation();
                        var element = $(this);

                        setTimeout(
                                function () {
                                    $(frm)
                                            .find(".alert")
                                            .fadeOut(500, "linear")
                                            .text("");
                                    e.stopImmediatePropagation();

                                    for (var key in window) {
                                        if (
                                                (window[key] instanceof QuadTable &&
                                                        $.fn.DataTable.isDataTable("#" + window[key].tableId)) ||
                                                window[key] instanceof QuadForm
                                                ) {
                                            if (
                                                    window[key].externalFilter &&
                                                    window[key].externalFilter.templateMulti &&
                                                    $(window[key].externalFilter.templateMulti.selector)
                                                    ) {
                                                if (
                                                        window[key].externalFilter.templateMulti.selector === frm
                                                        ) {
                                                    window[key].operation = "SELECT";
                                                    //var formData = $(e.data.currentForm).serializeAllArray();
                                                    window[key].resetData(true);
                                                    var formData = window[key].getFiltersFormsData();
                                                    //var formData = $(frm).serializeAllArray();

                                                    //PMA, 2020-08-17: RL error on CHECKBOX encharge of view TOGGLE
                                                    if (element.attr("name")) {
                                                        _.find(formData, {name: element.attr("name")})[
                                                                "text"
                                                        ] = element.find(":selected").text();
                                                    }
                                                    _.remove(formData, {value: ""});
                                                    _.remove(formData, {value: null});
                                                    if (
                                                            element.val() === "" &&
                                                            _.find(window[key].sFilters, {
                                                                name: element.attr("name")
                                                            })
                                                            ) {
                                                        _.remove(window[key].sFilters, {
                                                            name: element.attr("name")
                                                        });
                                                    }

                                                    window[key].filtersDataToColumns(formData);
                                                    if ($("#" + key)) {
                                                        window[key].filterInstance(element);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                },
                                0,
                                element
                                );
                    }
            );
        });
    };
    QuadCore.prototype.appendSortButton = function (frmId) {
        var obj = this;
        if (obj instanceof QuadTable) {
            $("#" + obj.tableId + "_dtAdvancedSearch").before(
                    '<a id="sort_' +
                    obj.tableId +
                    '" class="sort_' +
                    obj.tableId +
                    ' btn btn-sm btn-primary toRight quad-left-margin-2"><i class="fas fa-sort-amount-down"></i></a>'
                    );
        } else {
            $(".btn-toolbar", obj.formId).append(
                    '<a id="sort_' +
                    frmId +
                    '" class="sort_' +
                    frmId +
                    ' btn btn-sm btn-primary toRight quad-left-margin-2"><i class="fas fa-sort-amount-down"></i></a>'
                    );
        }
        obj.orderButtonHighligth();
    };

    QuadCore.prototype.registerCustomSortOrderByEvents = function (modalIdentifier) {
        $(modalIdentifier).on("click", ".orderByUp", function (e) {
            e.stopImmediatePropagation();
            var obj = window[$("#sortModal").attr("instanceId")];
            var entry = $(".orderByUp").index(e.currentTarget);
            var rm = $(this).parents(".contentRow");
            rm.prev()
                    .insertAfter(rm)
                    .fadeOut(500)
                    .fadeIn(500);
            var dt = obj.sortInfo[entry];
            obj.sortInfo.splice(entry, 1);
            obj.sortInfo.splice(entry - 1, 0, dt);
            entry = $(".orderByUp").index(e.currentTarget);
            if (entry === 0) {
                $(this)
                        .parents(".contentRow")
                        .find(".orderByUp")
                        .hide();
            } else {
                $(this)
                        .parents(".contentRow")
                        .find(".orderByUp")
                        .show();
            }
            $(".orderByUp,.orderByDown").show();
            $($(".orderByUp")[0]).hide();
            $($(".orderByDown")[$(".orderByDown").length - 1]).hide();
        });
        $(modalIdentifier).on("click", ".orderByDown", function (e) {
            e.stopImmediatePropagation();
            var obj = window[$("#sortModal").attr("instanceId")];
            var entry = $(".orderByDown").index(e.currentTarget);
            var rm = $(this).parents(".contentRow");
            rm.next()
                    .insertBefore(rm)
                    .fadeOut(500)
                    .fadeIn(500);
            var dt = obj.sortInfo[entry];
            obj.sortInfo.splice(entry, 1);
            obj.sortInfo.splice(entry + 1, 0, dt);
            entry = $(".orderByDown").index(e.currentTarget);
            if (entry === $(".orderByUp").length - 1) {
                $(this)
                        .parents(".contentRow")
                        .find(".orderByDown")
                        .hide();
            } else {
                $(this)
                        .parents(".contentRow")
                        .find(".orderByDown")
                        .show();
            }
            $(".orderByUp,.orderByDown").show();
            $($(".orderByUp")[0]).hide();
            $($(".orderByDown")[$(".orderByDown").length - 1]).hide();
        });
    };
    QuadCore.prototype.listOrderOptions = function (eventTarget) {
        var obj = this;
        if (obj instanceof QuadTable) {
            var myEl = $("#sortModal").find(
                    '[value="' + $(eventTarget).attr("name") + '"]'
                    );
            var idx = $(".sortField").index(myEl.parent());
            var ob = _.find(obj.tableCols, {
                data: $(eventTarget).attr("name")
            });

            obj.nextElementOptions(idx, ob);
        }
    };

    QuadCore.prototype.deleteRecordResponse = function (data, ok_) {
        var obj = this;
        var dat = JSON.parse(data);
        if (dat.msg === "OK") {
            ok_ = true;
        } else {
            quad_notification_clear();
            //PMA:ERROR HANDLING: Delete ROW to display DB error
            quad_notification({
                type: "error",
                title: JS_OPERATION_ERROR,
                content: '<i class="fa fa-clock-o"></i>&nbsp;<i>.' + dat.error + "</i>"
            });

            ok_ = false;
        }
        return ok_;
    };

    QuadCore.prototype.nextElementOptions = function (idx, ob) {
        $.each($(".sortField"), function (i, element) {
            if (
                    i > idx &&
                    $(element).find("option[value='" + ob.data + "']").length === 0
                    ) {
                $(element).append($("<option>", {value: ob.data, text: ob.title}));
            }
        });
    };
    QuadCore.prototype.syncFiltersAndForm = function (frm, frm2) {
        var obj = this;
        _.forEach(obj["sFilters"], function (d, i) {
            /* No "INSERT", se a coluna tiver filtro condicional (LIKE, IS NULL, >=, ...)
             * esse filtro não passa para o registo assumindo valor por defeito se aplicável
             */
            if (d.value) {
                var el = $(frm2).find('[name="' + d.name + '"]');
                if (el.length > 0) {
                    if (el.is("select")) {
                        //se for lista complexa ou domain e houver orderInfo, usamos o texto como referencia pois as views assim o exigem
                        if (el.attr("dependent-group") && obj["sortInfo"]) {
                            el.find("option")
                                    .filter(function () {
                                        return $(this).html() == d.text;
                                    })
                                    .attr("selected", "selected");
                        } else {
                            el.val(d.value);
                        }
                        if (el.hasClass("chosen")) {
                            el.trigger("chosen:updated");
                        }

                        el.trigger("change", [{currentForm: $(frm2), action: "query"}]);
                    } else {
                        el.val(d.value);
                        if (!el.valid()) {
                            $("label.error").hide();
                            $(".error").removeClass("error");
                            el.val("");
                        }
                        el.trigger("change", [{currentForm: $(frm2), action: "query"}]);
                    }
                }
            }
        });
    };

    QuadCore.prototype.orderButtonHighligth = function () {
        var obj = this;
        var selector =
                obj instanceof QuadTable ? obj.tableId : obj.formId.substring(1);
        if (obj["sortInfo"]) {
            //ORDER BY BUTTON
            $(".sort_" + selector)
                    .removeClass("btn-primary")
                    .addClass("btn-warning");
        } else {
            $(".sort_" + selector)
                    .removeClass("btn-warning")
                    .addClass("btn-primary");
        }
    };

    QuadCore.prototype.filtersText = function (frmData, frm) {
        var obj = this;
        _.forEach(frmData, function (o, i) {
            var el = $(' [name="' + o.name + '"]', frm);

            if (el.attr("dependent-group")) {
                //replace value by text if is domain or complexList on sortable instance
                _.find(frmData, {name: o.name})["value"] = el.val();
                _.find(frmData, {name: o.name})["text"] = el.find(":selected").text();
                if (obj.sFilters) {
                    var idx = _.findIndex(obj.sFilters, {name: o.name});
                    obj.sFilters[idx]["text"] = el.find(":selected").text();
                }
            } else {
                var idx = _.findIndex(obj.sFilters, {name: o.name});
                obj.sFilters[idx]["text"] = o.value;
            }
        });
    };

    QuadCore.prototype.displaySortOptionsType = function (el, currentTarget) {
        var obj = this;
        if (el.hasClass("sortValue")) {
            //change no asc/desc
            $(
                    obj.displaySortOptions(
                            el
                            .parent()
                            .parent()
                            .find(".sortField"),
                            el,
                            currentTarget
                            )
                    )
                    .clone()
                    .appendTo(".modal-body");
        } else {
            $(
                    obj.displaySortOptions(
                            el,
                            el
                            .parent()
                            .parent()
                            .find(".sortValue"),
                            currentTarget
                            )
                    )
                    .clone()
                    .appendTo(".modal-body");
        }
    };

    QuadCore.prototype.getCustomOrderUi = function (output) {
        var obj = this;
        var options = output;
        _.forEach(obj["sortInfo"], function (o, i) {
            var el = $('<select class="form-control sortField"></select>').html(
                    options.join("")
                    );
            el.find('option[value="' + Object.keys(o)[0] + '"]').attr(
                    "selected",
                    "selected"
                    );
            var sortEl = $(
                    '<select class="form-control sortValue"><option value="ASC">ASC</option><option value="DESC">DESC</option></select>'
                    );
            sortEl
                    .find('option[value="' + o[Object.keys(o)[0]] + '"]')
                    .attr("selected", "selected");
            var html = $('<div class="row form-group contentRow"></div>')
                    .append($('<div class="col-sm-5"></div>').append(el))
                    .append($('<div class="col-sm-3"></div>').append(sortEl))
                    .append(
                            $('<div class="col-sm-1"></div>').append(
                            '<i name="' +
                            Object.keys(o)[0] +
                            '" class="far fa-trash-alt fa-2x deleteOrderBy"></i>'
                            )
                            )
                    .append(
                            $('<div class="col-sm-1"></div>').append(
                            '<i name="' +
                            Object.keys(o)[0] +
                            '" class="far fa-level-up-alt fa-2x orderByUp"></i>'
                            )
                            )
                    .append(
                            $('<div class="col-sm-1"></div>').append(
                            '<i name="' +
                            Object.keys(o)[0] +
                            '" class="far fa-level-down-alt fa-2x orderByDown"></i>'
                            )
                            );
            $("#sortModal")
                    .find(".modal-body")
                    .append(html[0]);
            el.attr("disabled", 1);

            //filtramos as options retirando os que já existem ...
            var output = _.filter(output, function (item) {
                return $(item).val() !== Object.keys(o)[0];
            });
        });
        return output;
    };

    QuadCore.prototype.modalSortUi = function (InstanceName) {
        var obj = this;

        obj.modalSortTemplate();

        $("#sortModal").on("show.bs.modal", function (e) {
            $("#sortModal")
                    .find(".modal-body")
                    .html("");

            var obj = window[$("#sortModal").attr("instanceId")];
            if (obj["sortInfo"]) {
                var output = [];
                output.push("<option> </option>");
                if (obj instanceof QuadTable) {
                    _.map(obj.tableCols, function (ob, index) {
                        if (ob["title"] && ob["data"] && ob["visible"] !== false) {
                            output.push(
                                    '<option value="' + ob.data + '">' + ob["title"] + "</option>"
                                    );
                        }
                    });
                } else {
                    _.map($(":input", obj.formId), function (el, index) {
                        // to exclude functions from orderBy ...//todo read exclude from obj.exclude
                        if ($(el).data("exclude") || $(el).data("func")) {
                            return;
                        }
                        if ($(el).is(":not(:hidden)")) {
                            var label = $("label[for='" + $(el).attr("name") + "']", obj.frmId);
                            if ($(label).length > 0) {
                                output = obj.appendOption(
                                        output,
                                        $(el).attr("name"),
                                        $(label)
                                        .html()
                                        .toUpperCase()
                                        );
                            }
                        }
                    });
                }
                output = obj.getCustomOrderUi(output);
                //mandamos o output para diferentiar
                $("#sortModal")
                        .find(".modal-body")
                        .append(obj.displaySortOptions(null, null, null, null, output));
            } else {
                $("#sortModal")
                        .find(".modal-body")
                        .html(obj.displaySortOptions());
            }
        });
        $("#sortModal").on("hidden.bs.modal", function () {
            var instId = $("#sortModal").attr("instanceId");
            var obj = window[InstanceName];
            /*var container =
             obj instanceof QuadTable ? obj.tableId : obj.formId.substring(1);*/
            if (obj["sortInfo"]) {
                $("#sortModal")
                        .find(".modal-body")
                        .html("");
                localStorage.setItem(
                        InstanceName + "_sortInfo",
                        JSON.stringify(obj.sortInfo)
                        );
            }
        });

        $("#sortModal")
                .attr("instanceId", InstanceName)
                .addClass(InstanceName + "sortModal");
        $("#sortModal").modal("show");

        return "." + InstanceName + "sortModal";
    };

    QuadCore.prototype.modalSortTemplate = function () {
        $("#sortModal").remove();
        var x =
                '<div id="sortModal" class="modal fade" role="dialog">' +
                '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"> ' +
                JS_ORDER_BY_TITLE +
                '<button type="button" class="close" data-dismiss="modal">&times;</button></h4>' +
                "</div>" +
                '<div class="modal-body orderEditor">' +
                "</div> " +
                '<div class="modal-footer">' +
                '<button  type="button" class="btn btn-default orderNow" > ' +
                JS_ORDER_BUTTON +
                "</button>" +
                "</div> </div> </div>";
        $("body").append(x);
    };

    QuadCore.prototype.appendSortField = function (el) {
        if (el.val() && el.hasClass("sortField")) {
            el.data("previousValue", el.val());
            el.attr("name", el.val());
            el.parent()
                    .parent()
                    .append(
                            $('<div class="col-sm-1"></div>').append(
                            '<i name="' +
                            el.val() +
                            '" class="far fa-trash-alt fa-2x deleteOrderBy"></i>'
                            )
                            );
            el.parent()
                    .parent()
                    .append(
                            $('<div class="col-sm-1"></div>').append(
                            '<i name="' +
                            el.val() +
                            '" class="far fa-level-up-alt fa-2x orderByUp"></i>'
                            )
                            );
            el.parent()
                    .parent()
                    .append(
                            $('<div class="col-sm-1"></div>').append(
                            '<i name="' +
                            el.val() +
                            '" class="far fa-level-down-alt fa-2x orderByDown"></i>'
                            )
                            );
        }
    };

    QuadCore.prototype.instanceUpToDate = function () {
        var obj = this;
        setTimeout(function () {
            obj.hideSpinner();
            if (obj.workFlow) {
                /*if (obj instanceof QuadForm && !obj.currentRecord) {
                 return;
                 }*/
                obj.workflowToUi();
            }
        }, 1000);
    };

    QuadCore.prototype.countMandatoryFilledFilters = function (mandatoryFields) {
        var nFilters = [],
                obj = this;
        _.forEach(mandatoryFields, function (name, i) {
            if (obj.sFilters) {
                var find = _.find(obj.sFilters, {name: name});
                if (find && find.value != "") {
                    nFilters.push(name);
                }
            }
        });
        if (nFilters.length != mandatoryFields.length) {
            return false;
        } else {
            return true;
        }
    };

    QuadCore.prototype.showSpinner = function () {
        var obj = this;
        if (obj instanceof QuadForm) {
            $("." + obj.formId.substring(1) + "_spinner").show();
        }
        if (obj instanceof QuadTable) {
            $("." + obj.tableId + "_spinner").show();
        }
    };

    QuadCore.prototype.hideSpinner = function () {
        var obj = this;
        if (obj instanceof QuadForm) {
            $("." + obj.formId.substring(1) + "_spinner").hide();
        }
        if (obj instanceof QuadTable) {
            $("." + obj.tableId + "_spinner").hide();
        }
    };

    QuadCore.prototype.isRequired = function (target, el) {
        var obj = this;
        if (
                obj.validations &&
                obj.validations.rules[el.prop("name")] &&
                obj.validations.rules[el.prop("name")]["required"] === true
                ) {
            if (el.hasClass("onoffswitch-checkbox")) {
                el.parent()
                        .parent()
                        .find("span.onoffswitch-title")
                        .addClass("required");
            } else {
                target.addClass("required");
            }
        }
    };
    QuadCore.prototype.loadDropzone = function () {
        var obj = this;
        // PTE: 2020.10.16 -- em instâncias de QuadForms que não têm campo de imagem instanciado dava erro quando efetuava novo registo...
        if (typeof obj.inRowDoc !== "undefined") {
            if (typeof Dropzone == "undefined") {
                initApp.loadScript(
                        "assets/js/dropzone/dropzone.min.js",
                        obj.configUpload(obj.inRowDoc.domElementId)
                        );
            } else {
                obj.configUpload(obj.inRowDoc.domElementId);
            }
        }
    };
    QuadCore.prototype.isPdfFile = function (frm, action, mimeType, value) {
        var obj = this;
        $(obj.inRowDoc.domElementId, obj.formId)
                .find("embed")
                .remove();
        var fileSrc = "data:application/" + mimeType + ";base64," + value;
        if ($(obj.inRowDoc.domElementId, obj.formId).find("embed").length === 0) {
            $(obj.inRowDoc.domElementId, obj.formId).prepend(
                    '<embed src= "' +
                    fileSrc +
                    '" width= "500" height= "375" position="absolute">'
                    );
            if (action) {
                obj.loadDropzone();
                setTimeout(function () {
                    obj.uploadsUndoIcon();
                    obj.uploadsCarregaIcon(frm);
                }, 1000);
                $("embed", frm).remove();
                return;
            } else {
                $(".docsViewer", frm)
                        .find(".apagaImg,.undo,.carrega")
                        .remove();
            }
        }
    };
    QuadCore.prototype.isVideoFile = function (frm, action, mimeType, value) {
        var obj = this;
        if (action) {
            obj.loadDropzone();
            setTimeout(function () {
                obj.uploadsUndoIcon();
                obj.uploadsCarregaIcon(frm);
            }, 1000);

            return;
        }

        //todo extende this method in instance...this is too generic, cannot predict behaviour.

        var player =
                '<video id="testeVideo" position="absolute" width="320" height="240" controls autoplay name="media"></video>';

        $(obj.inRowDoc.domElementId, obj.formId).prepend(player);
        var video = document.getElementById("testeVideo");
        var source = document.createElement("source");

        video.appendChild(source);
        source.setAttribute("src", "data:video/" + mimeType + ";base64," + value);
        //todo not working
        /* var alertMessage = mimeType + " nao suportado";
         source.setAttribute("onerror","alert(" + alertMessage + ")");*/
        $(obj.inRowDoc.domElementId, frm).removeClass("dropzone");
        $("img", frm)
                .not(".tableSpinner")
                .hide();
        $(".docsViewer", frm)
                .find(".apagaImg,.undo,.carrega")
                .remove();
    };
    QuadCore.prototype.isImageFile = function (frm, action, mimeType, value) {
        var obj = this;
        var toShow = "data:image/*;base64," + value;

        $("img:not(.tableSpinner)", obj.formId).attr("src", toShow);
        obj["srcs"] = obj["srcs"] || [];
        obj["srcs"].push("data:image/*;base64," + value);

        if (action === "edit") {
            obj.loadDropzone();
            setTimeout(function () {
                obj.uploadsUndoIcon();
                obj.uploadsCarregaIcon(frm);
            }, 1000);
        } else {
            //todo replace docsviewer by configuration
            $(".docsViewer", frm)
                    .find(".apagaImg,.undo,.carrega")
                    .remove();
            $(".docsViewer", frm).removeClass("dropzone");
        }
    };

    QuadCore.prototype.isAudioFile = function (frm, action, mimeType, value) {
        var obj = this;
        if (action) {
            obj.loadDropzone();
            setTimeout(function () {
                obj.uploadsUndoIcon();
                obj.uploadsCarregaIcon(frm);
            }, 1000);

            return;
        }

        var player =
                '<audio id="testeAudio" position="absolute" width="320" height="240" controls autoplay name="media"></audio>';
        $(obj.inRowDoc.domElementId, obj.formId).prepend(player);
        var video = document.getElementById("testeAudio");
        var source = document.createElement("source");

        video.appendChild(source);
        source.setAttribute("src", "data:audio/" + mimeType + ";base64," + value);
        //source.setAttribute("src", "mp3_file.mp3");
        $("img", frm)
                .not(".tableSpinner")
                .hide();
        $(".docsViewer", frm)
                .find(".apagaImg,.undo,.carrega")
                .remove();
        $(".docsViewer", frm).removeClass("dropzone");
    };

    QuadCore.prototype.fileDataIsEmpty = function (action, frm) {
        var obj = this;

        if (action) {
            obj.loadDropzone();
            setTimeout(function () {
                obj.uploadsUndoIcon();
                obj.uploadsCarregaIcon(frm);
            }, 1000);
        }
        $("img:not(.tableSpinner)", obj.formId).attr("src", quadConfig.rhid_no_photo);
        obj["srcs"] = obj["srcs"] || [];
        obj["srcs"].push(new File([""], null));
        $(".docsViewer", frm).removeClass("dropzone");
        $("video,embed,audio", frm).remove();
    };
    QuadCore.prototype.displayInputTypeFileOrText = function (
            data,
            value,
            key,
            frm,
            action
            ) {
        var obj = this;
        if (!$("[name='" + key + "']", frm).is("[type=file]")) {
            //todo this logic is wrong
            $(frm)
                    .find("[name='" + key + "']")
                    .val(value);
            if (key === "BD_MIME") {
                if (
                        obj.inRowDoc &&
                        obj.inRowDoc["embedded"] &&
                        obj.inRowDoc["embedded"]["display"] === false
                        ) {
                    var toShow = obj.getFileIcon(data[obj.inRowDoc.extField], data);

                    $(".docsViewer.inRow", obj.inRowDoc.domElementId).remove();
                    $(obj.inRowDoc.domElementId).prepend(toShow);
                    $("img", obj.inRowDoc.domElementId).hide();

                    if (action) {
                        obj.loadDropzone();
                        setTimeout(function () {
                            obj.uploadsUndoIcon();
                            obj.uploadsCarregaIcon(frm);
                        }, 1000);
                    } else {
                        $(".docsViewer", frm)
                                .find(".photoButtons")
                                .empty();
                        $(obj.inRowDoc.domElementId, frm).removeClass("dropzone");
                    }
                } else {
                    $("img", obj.inRowDoc.domElementId).show();
                    if (action) {
                        obj.loadDropzone();
                        setTimeout(function () {
                            obj.uploadsUndoIcon();
                            obj.uploadsCarregaIcon(frm, data);
                        }, 1000);
                    }
                }
            }
            if (key === "BD_DOC") {
                if (
                        obj.inRowDoc &&
                        obj.inRowDoc["embedded"] &&
                        obj.inRowDoc["embedded"]["display"] === true
                        ) {
                    if (value) {
                        obj.fileDataManager(frm, action, data, value);
                    } else {
                        obj.fileDataIsEmpty(action, frm);
                    }
                }
            }
        } else {
            $("[name='" + key + "']", frm).hide();
            if (value) {
                obj.fileDataManager(frm, action, data, value);
            } else {
                obj.fileDataIsEmpty(action, frm);
            }
        }
    };
    QuadCore.prototype.getExtensionType = function (ext) {
        var extHelper = "";
        switch (ext.toLowerCase()) {
            case "mp3":
            case "wav":
                extHelper = "audio";
                break;
            case "mp4":
            case "ogg":
                extHelper = "video";
                break;
            case "doc":
            case "docx":
                extHelper = "word";
                break;
            case "pdf":
                extHelper = "pdf";
                break;
            case "xls":
            case "xlsx":
                extHelper = "excel";
                break;
            case "gif":
            case "jpg":
            case "jpeg":
            case "png":
                extHelper = "image";
                break;
            default:
                extHelper = "alt";
                break;
        }
        return extHelper;
    };

    QuadCore.prototype.fileDataManager = function (frm, action, data, value) {
        var obj = this;
        //todo moove to quadconfig
        $("video,embed,audio", frm).remove();
        var videoMimeTypes = ["avi", "mpg", "mp4", "ogg", "wmv", "mov"];

        if (
                data.BD_MIME &&
                videoMimeTypes.indexOf(data.BD_MIME.toLowerCase()) !== -1
                ) {
            obj.isVideoFile(frm, action, data.BD_MIME, value);
        }
        if (data.BD_MIME && data.BD_MIME.toLowerCase() === "pdf") {
            obj.isPdfFile(frm, action, data.BD_MIME, value);
        }
        //todo moove to quadconfig
        var imgMimeTypes = ["jpg", "jpeg", "png", "svg", "gif", "bmp", "webp"];
        if (data.BD_MIME && imgMimeTypes.indexOf(data.BD_MIME.toLowerCase()) !== -1) {
            obj.isImageFile(frm, action, data.BD_MIME, value);
        }
        var audioMimeTypes = ["mp3", "wav", "ac3", "aiff", "wma", "m4a"];
        if (
                data.BD_MIME &&
                audioMimeTypes.indexOf(data.BD_MIME.toLowerCase()) !== -1
                ) {
            obj.isAudioFile(frm, action, data.BD_MIME, value);
        }
    };

    QuadCore.prototype.uploadsCarregaIcon = function (frm, data) {
        var obj = this;
        var carregaNewPicture =
                '<a class=\'carrega btn btn-primary btn-sm btn-icon waves-effect waves-themed\'><i class="fas fa-folder-open" aria-hidden="true"></i><a/>';

        var deleteImg =
                '<a class=\'apagaImg btn btn-danger btn-sm btn-icon waves-effect waves-themed\'><i class="fas fa-trash" aria-hidden="true"></i><a/>';
        if (
                $(".docsViewer", frm)
                .find(".photoButtons")
                .find(".carrega").length === 0
                ) {
            $(".docsViewer", frm)
                    .find(".photoButtons")
                    .append(carregaNewPicture);
            $(".photoButtons", ".docsViewer").on("click", ".carrega", function (e) {
                e.stopImmediatePropagation();

                $(obj.inRowDoc.domElementId, frm).trigger("click");
            });
        }
        if (
                $(".docsViewer", frm)
                .find(".photoButtons")
                .find(".apagaImg").length === 0
                ) {
            if (data && data[obj.inRowDoc.fileNameField]) {
                $(".docsViewer", frm)
                        .find(".photoButtons")
                        .append(deleteImg);
            }

            $(".photoButtons", ".docsViewer").on("click", ".apagaImg", function (e) {
                e.stopImmediatePropagation();

                obj["srcs"] = [];
                $(".docsViewer", obj.formId)
                        .find(".undo")
                        .remove();
                if (!obj.frmData) {
                    obj["frmData"] = new FormData();
                    obj.frmData.append("upload[]", new File([""], null));
                } else {
                    obj.frmData.append("upload[]", new File([""], null));
                }

                if (obj.inRowDoc.embedded && obj.inRowDoc.embedded.display) {
                    $("img", frm)
                            .not(".tableSpinner")
                            .attr("src", quadConfig.rhid_no_photo);
                } else {
                    $(".inRow", obj.inRowDoc.domElementId).remove();
                }

                $(".docsViewer", frm)
                        .find(".photoButtons")
                        .find(".apagaImg")
                        .remove();
            });
        }
    };
    QuadCore.prototype.uploadsUndoIcon = function () {
        var obj = this;
        var undoNewPicture =
                '<a class=\'undo btn btn-secondary btn-sm btn-icon waves-effect waves-themed \'><i class="fas fa-undo-alt" aria-hidden="true"></i><a/>';
        if (obj["srcs"] && obj["srcs"].length > 1) {
            if (
                    $(".docsViewer", obj.formId)
                    .find(".photoButtons")
                    .find(".undo").length === 0
                    ) {
                $(".docsViewer", obj.formId)
                        .find(".photoButtons")
                        .append(undoNewPicture);
                $(".photoButtons", ".docsViewer").on("click", ".undo", function (e) {
                    e.stopImmediatePropagation();
                    obj["srcs"].pop();
                    if (obj["srcs"].length === 1) {
                        $(".docsViewer", obj.formId)
                                .find(".undo")
                                .remove();
                    }

                    if (typeof obj["srcs"][obj["srcs"].length - 1] === "string") {
                        $("img:not(.tableSpinner)", obj.formId).attr(
                                "src",
                                obj["srcs"][obj["srcs"].length - 1]
                                );
                        var block = obj["srcs"][obj["srcs"].length - 1].split(";");
                        // Get the content type of the image
                        var contentType = block[0].split(":")[1]; // In this case "image/gif"
                        // get the real base64 content of the file
                        var realData = block[1].split(",")[1]; // In this case "R0lGODlhPQBEAPeoAJosM...."

                        // Convert it to a blob to upload
                        var blob = obj.b64toBlob(realData, contentType);

                        var form = document.getElementById(obj.formId.substring(1));
                        obj.frmData = new FormData(form);
                        obj.frmData.append("upload[]", new File([blob], "filename"));
                        obj.frmData.append(
                                "filenames[]",
                                obj["srcs"][obj["srcs"].length - 1].name
                                );
                    } else if (typeof obj["srcs"][obj["srcs"].length - 1] === "object") {
                        if (obj["srcs"][obj["srcs"].length - 1].size === 0) {
                            $("img:not(.tableSpinner)", obj.formId).attr(
                                    "src",
                                    quadConfig.rhid_no_photo
                                    );

                            return;
                        }
                        const reader = new FileReader();
                        reader.onloadend = () => {
                            const base64String = reader.result;
                            var mime = base64String.match(
                                    /data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).*,.*/
                                    );

                            if (mime && mime.length) {
                                var fileType = mime[1].split("/");
                            }
                            if (fileType[1] === "img") {
                                $("img:not(.tableSpinner)", obj.formId).attr("src", base64String);
                            } else {
                                //just force a non rendered src to display alt atribute

                                $("img:not(.tableSpinner)", obj.formId).attr("src", "blabla");
                                var cnp =
                                        obj["srcs"][obj["srcs"].length - 1].name +
                                        " Cannot preview this file :( ";
                                $("img:not(.tableSpinner)", obj.formId).attr("alt", cnp);
                            }
                        };
                        reader.readAsDataURL(obj["srcs"][obj["srcs"].length - 1]);

                        var form = document.getElementById(obj.formId.substring(1));
                        obj.frmData = new FormData(form);
                        obj.frmData.append("upload[]", obj["srcs"][obj["srcs"].length - 1]);
                        obj.frmData.append(
                                "filenames[]",
                                obj["srcs"][obj["srcs"].length - 1].name
                                );
                    }
                });
            }
        }
    };

    QuadCore.prototype.complexListValue = function (row, o, fieldName, field) {
        var obj = this;

        var search = "";

        var keys = obj.returnListKeys(o);
        //todo search with in otherValues....????
        _.map(
                keys,
                function (name, i) {
                    if (i < keys.length - 1) {
                        search += row[name] + "@";
                    } else {
                        search += row[name];
                    }
                },
                row
                );
        var result = _.find(obj.getComplexListIndex(o, null, false), {
            VAL: search
        });
        if (result == undefined) {
            //todo o.inTable , Intable está a ser usado no quaForm para complexlist (ex: empresa) de campos que existem na tabela.
            row[field] = "";
        } else {
            if (o.inTable) {
                //problema das listas que estao na tabela e listas que temos que acrescentar
            } else {
                row[field] = result[fieldName];
            }
        }
        return row;
    };

    QuadCore.prototype.backwardsCompatibleDomainValue = function (
            row,
            o,
            fieldName,
            field
            ) {
        var obj = this;
        if (row[field] !== null && row[field] !== "") {
            if (o["attr"]["showValues"]) {
                var ob = obj.getDomainDataEntry(
                        row,
                        o,
                        Object.keys(o["attr"]["showValues"]),
                        field
                        );

                if (ob) {
                    if (obj["sortInfo"]) {
                        if (o["render"]) {
                            //backwards compatible (render exists in old interfaces)
                            row[field] = ob["RV_LOW_VALUE"];
                        } else {
                            row[field] = row[field];
                        }
                    } else {
                        if (o["render"]) {
                            //backwards compatible (render exists in old interfaces)
                            row[field] = ob["RV_LOW_VALUE"];
                        } else {
                            row[field] =
                                    ob[
                                            o["attr"]["showValues"][Object.keys(o["attr"]["showValues"])[0]]
                                    ];
                        }
                    }
                } else {
                    console.log(
                            o["attr"]["dependent-group"] +
                            "problema com descodificacao  do valor" +
                            row[field]
                            );
                }
            } else {
                var ob = obj.getDomainDataEntry(row, o, "RV_LOW_VALUE", field);
                if (ob) {
                    if (obj["sortInfo"]) {
                        if (o["render"]) {
                            //backwards compatible (render exists in old interfaces)
                            var ob = obj.getDomainDataEntry(row, o, "RV_MEANING", field);

                            row[field] = ob["RV_LOW_VALUE"];
                        } else {
                            row[field] = row[field];
                        }
                    } else {
                        if (o["render"]) {
                            //backwards compatible (render exists in old interfaces)
                            row[field] = ob["RV_LOW_VALUE"];
                        } else {
                            row[field] = ob["RV_MEANING"];
                        }
                    }
                } else {
                    console.log(
                            o["attr"]["dependent-group"] +
                            "problema com descodificacao  do valor " +
                            row[field]
                            );
                }
            }
        }
        return row;
    };
    QuadCore.prototype.getDomainDataEntry = function (row, o, attribute, field) {
        var obj = this;
        var search = {};
        search[attribute] = row[field];
        return _.find(initApp.joinsData[o["attr"]["dependent-group"]], search);
    };
    QuadCore.prototype.checkboxTypeSwitchType = function (el, value) {
        //PMA, 2019.02.22 : Include Switch interface. Set Value and "checked" property, accordingly.

        if (el.hasClass("onoffswitch-checkbox")) {
            //SWITCH

            if (value === "S" || el.checked) {
                el.prop("checked", true);
            } else {
                el.prop("checked", false);
            }
        } else {
            if (el.attr("data-value-checked") == value) {
                el.prop("checked", true);
            } else {
                el.prop("checked", false);
            }
        }
    };

    QuadCore.prototype.removeSortElement = function (el) {
        var rm = el.parents(".contentRow");
        rm.hide("slow", function () {
            rm.remove();
            $(".orderByUp,.orderByDown").show();
            $($(".orderByUp")[0]).hide();
            $($(".orderByDown")[$(".orderByDown").length - 1]).hide();
        });
    };

    /*
     QuadCore.prototype.nextSortVisible = function(field, ob, eTarget) {
     var obj = this;
     var idx = $(".sortField").index(field);

     obj.nextElementOptions(idx, ob);

     if ($(eTarget).hasClass("sortField")) {
     var rm = field.parents(".contentRow");
     rm.hide("slow", function() {
     rm.remove();
     });
     }
     };*/

    QuadCore.prototype.resetExternalFilters = function () {
        var obj = this;
        if (obj.externalFilter && obj.externalFilter.templateMulti) {
            //nothing
        }
        if (obj.externalFilter && obj.externalFilter.template) {
            _.forEach(obj.sFilters, function (o, k) {
                if (
                        $('[name="' + o.name + '"]', obj.externalFilter.template.selector)
                        .length > 0
                        ) {
                    obj.sFilters.splice(_.findIndex(obj.sFilters, {name: o.name}));
                    if (obj.qFilters) {
                        delete obj.qFilters[o.name];
                    } else {
                        return false;
                    }
                }
            });

            $(obj.externalFilter.template.selector)[0].reset();
        }
    };

    QuadCore.prototype.formElementData = function (data, frm, key, value, action) {
        var obj = this;
        var el = frm.find("[name='" + key + "']");
        var atrib = el.attr("type");
        if (atrib == "radio") {
            el.each(function () {
                if ($(this).val() == value) {
                    $(this).prop("checked", true);
                }
            });
        } else if (atrib == "checkbox") {
            obj.checkboxTypeSwitchType(el, value);
        } else if (el.is("select")) {
            if (el.attr("domain-list")) {
                obj.onEditFillDomain(frm, el, data, action);
            }
            if (el.hasClass("complexList")) {
                if (obj instanceof QuadForm) {
                    var o = _.find(
                            obj.complexLists ? obj.complexLists : quadConfig.loadData,
                            {
                                name: el.attr("name")
                            }
                    );
                } else {
                    var o = _.find(obj.tableCols, {
                        name: el.attr("name")
                    });
                }

                obj.onEditFillComplexList(o, frm, obj.normalizeData(data), action);
            }
        } else {
            obj.displayInputTypeFileOrText(data, value, key, frm, action);
        }
        return el;
    };

    QuadCore.prototype.isValidOperation = function (data, action) {
        var obj = this;
        var dados_para_validacao = {
            reference: obj.on_pre_submit,
            action: action,
            data: data,
            workflow: obj.workFlow
        };
        var req = $.ajax({
            type: "POST",
            url: obj.pathToSqlFile + obj.sqlValidator,
            data: dados_para_validacao,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            cache: false,
            async: false
        });
        return req;
    };
    QuadCore.prototype.initializeDropZone = function (selector) {
        var obj = this;
        selector = selector || "#mydropzone";

        setTimeout(function () {
            Dropzone.autoDiscover = false;
            var options = {
                //acceptedFiles: "image/*",
                addRemoveLinks: true,
                maxFiles: 1,
                autoProcessQueue:false,
                //autoQueue: obj instanceof QuadTable ? true : false,
                // parallelUploads: 1,
                previewsContainer: null,
                url: obj.pathToSqlFile + obj.uploadController,
                uploadMultiple: true,
                // maxFilesize: 30.0,
                dictDefaultMessage:
                        '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"><i class="fa fa-caret-right text-danger"></i> Drop files <span class="font-xs">to upload</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (Or Click)</h4></span>',
                dictResponseError: "Error uploading file!"
            };

            if (!obj["dropZone"]) {
                obj["dropZone"] = new Dropzone(selector, options);

                if (obj instanceof QuadForm) {
                    obj.registerFormDropzoneEvents(selector);
                    $(selector).addClass("docsViewer");
                    obj.uploadsUndoIcon();
                    obj.uploadsCarregaIcon(obj.formId);
                } else {
                    obj.registerTableDropzoneEvents();
                }
            }
            if (obj instanceof QuadForm) {
                $(selector, obj.formId).addClass("dropzone");
                $(selector)
                        .find(".dz-default")
                        .remove();
            } else {
                $(selector)
                        .find(".dz-preview")
                        .remove();
            }
        }, 1000);
    };

    QuadCore.prototype.uploadModal = function (instanceName) {
        var obj = this;
        var btId = obj instanceof QuadTable ? "saveFileEditor" : "saveFileForm";
        var m =
                '<div id="myModal" class="modal fade" role="dialog">' +
                '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                '<h4 class="modal-title DTE_Header_Content">' +
                obj.i18nEntries.uploadModalTitle +
                "</h4>" +
                '</div><div class="modal-body"><div id="mydropzoneFiles"></div>' +
                '<form action="data-source/' +
                quadConfig.upload_file_controller +
                '" class="dropzone dz-clickable" id="mydropzone">' +
                '<div class="dz-default dz-message"><span><span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg">' +
                '<i class="fas fa-caret-right text-danger"></i> Drop files <span class="font-xs">to upload</span></span><span>&nbsp;&nbsp;<h4 class="display-inline"> (Or Click)</h4></span></span></span></span></div>' +
                ' </form></div><div class="modal-footer">' +
                '<button id="' +
                btId +
                '" data-instance="' +
                instanceName +
                '" type="button" class="btn btn-default" data-dismiss="modal">' +
                JS_SAVE +
                " </button>" +
                "</div> </div> </div> </div>";
        $(m).appendTo(document.body);
    };

//metodo que resolve quala condicao , baseada na existencia de um domain ou nao na condicao.
// Limitacao dos domains nao terem field helper(DSP) como
//as complexlists
    QuadCore.prototype.getInativeCondition = function (data, masterObj) {
        var obj = this;
        var conditionArr = masterObj.crudOnMasterInactive.condition.split(" ");

        var dataClone = $.extend({}, data);
        _.forEach(conditionArr, function (i) {
            if (i.indexOf("data.") !== -1) {
                var fieldName = i.split(".")[1];

                if (fieldName) {
                    var cfgOb,
                            domainIdx,
                            isDomain = false;
                    if (obj instanceof QuadForm) {
                        if (_.has(obj.domainLists, fieldName)) {
                            cfgOb = obj.domainLists[fieldName];
                            domainIdx = cfgOb["dependent-group"];
                            isDomain = true;
                        }
                    } else {
                        cfgOb = _.find(obj.tableCols, {data: fieldName});
                        if (cfgOb && cfgOb["attr"] && cfgOb["attr"]["domain-list"]) {
                            domainIdx = cfgOb["attr"]["dependent-group"];
                            isDomain = true;
                        }
                    }

                    if (isDomain) {
                        var encodedValue = _.find(initApp.joinsData[domainIdx], {
                            RV_LOW_VALUE: data[fieldName]
                        })["RV_LOW_VALUE"];
                        if (encodedValue) {
                            dataClone[fieldName] = encodedValue;
                            obj[
                                    "clonedCondition"
                            ] = masterObj.crudOnMasterInactive.condition.replace(
                                    "data.",
                                    "dataClone."
                                    );
                        }
                    }
                }
            }
        });

        var condition = obj["clonedCondition"]
                ? obj["clonedCondition"]
                : masterObj.crudOnMasterInactive.condition;
        var dataSource = dataClone ? dataClone : data;
        return [dataSource, condition];
    };
    QuadCore.prototype.getValidationData = function () {
        var dataValida = {};
        var field, fieldValue;
        var obj = this;
        for (var i in obj.dbColumns) {
            field = obj.dbColumns[i]["db"];
            fieldValue = obj.dbColumns[i]["nxt_value"];
            dataValida[field] = fieldValue;
        }
        return dataValida;
    };

    /* Returns the primary key data of an entire record separating each pk column as defined on the instance (using @)
     * Used by getFileIcon method.
     */
    QuadCore.prototype.getKey = function (pk, rowData) {
        if (pk && rowData) {
            var rowId = "";
            var j = 0;
            _.each(pk, function (k, i) {
                j++;
                if (j > 1) {
                    rowId += "@" + rowData[i];
                } else {
                    rowId += rowData[i];
                }
            });
            return rowId;
        }
    };
