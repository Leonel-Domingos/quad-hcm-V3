    /**
     * Created by led on 04-03-2017.
     */
    "use strict";
    var QuadList = function () {};
    QuadList.prototype.deferredBindListsQueue = function (
            frm,
            elTriggered,
            elem,
            action,
            level,
            i,
            data,
            evt
            ) {
        var obj = this;
        var info, field;

        if (frm.is("tr")) {
            data = obj.normalizeData(obj.getNormalizedFrmData(frm));
        } else {
            data = obj.normalizeData(obj.getNormalizedFrmData(frm));
        }
        data = obj.mapComplexLists(data);
        if (obj instanceof QuadForm) {
            field = _.find(obj.complexLists, {name: $(elem).prop("name")});
        } else {
            field = _.find(obj.tableCols, {name: $(elem).prop("name")});
            field = field.attr;
        }
        if (
                field.filter &&
                Object.keys(field.filter).indexOf(level + "." + (i + 1)) !== -1
                ) {
            level = level + "." + (i + 1);
        }
        if (field.filter && Object.keys(field.filter).length != 0) {
            if (
                    $(elem)
                    .attr("dependent-level")
                    .indexOf("&") != -1
                    ) {
                if (
                        !elTriggered.hasClass("complexList") &&
                        field.filter[level][action].indexOf(":" + elTriggered.attr("name")) ===
                        -1
                        ) {
                    return;
                }
                info = obj.bindValues(
                        field.filter[level][action],
                        field,
                        elTriggered,
                        frm,
                        elem,
                        data
                        );
            } else {
                if (
                        !elTriggered.hasClass("complexList") &&
                        field.filter[action].indexOf(":" + elTriggered.attr("name")) === -1
                        ) {
                    return;
                }
                info = obj.bindValues(
                        field.filter[action],
                        field,
                        elTriggered,
                        frm,
                        elem,
                        data
                        );
            }
            if (elTriggered.hasClass("complexList")) {
                var fields = elTriggered
                        .attr("data-db-name")
                        .replace(quadConfig.regExpressions.alias, "")
                        .split("@");
                if (info.regExp.exec(info.sql) !== null) {
                    return;
                }
            }
            //verificamos se todas as BIND VARIABLES estão preenchidas
            var elmt = frm.find('[name="' + field.name + '"]');
            obj.getDeferredBindList(
                    info,
                    elmt,
                    elTriggered,
                    field,
                    frm,
                    data,
                    elmt.attr("dependent-level"),
                    action,
                    evt
                    );
        }
    };
    QuadList.prototype.mapOtherValues = function (el, action, result) {
        var obj = this;
        var keys = obj.returnListOtherValues(el.attr("otherValues"));
        var oVals = [];
        obj["otherValues"] = [];
        $.each(keys, function (i, field) {
            if (result.OTHERVALUES) {
                oVals = result.OTHERVALUES.replace(
                        quadConfig.regExpressions.alias,
                        ""
                        ).split("@");
                var o = {};
                o[field] = oVals[i];
                obj["otherValues"].push(o);
            }
        });
    };
    QuadList.prototype.returnListOtherValues = function (otherValues) {
        var obj = this;
        var keys = otherValues
                .replace(quadConfig.regExpressions.alias, "")
                .split("@");
        return keys;
    };
    QuadList.prototype.frmElemChange = function (
            frm,
            el,
            action,
            evt,
            data,
            resetLists = true
            ) {
        //resetLists=resetLists || true;
        var obj = this;
        var rExp = /:([^']+)/g;
        var formData = data || $(frm).serializeAllArray();
        //todo we can use this, maybe better /reliable
        //_.find(obj.tbl.data(),{DT_RowId:data['formdata'][0]['DT_RowId']})
        //end todo

        action = action || null;
        evt = evt || null;
        var levels = [];
        /*selecionamos todos os elementos do mesmo dependent-group*/
        var els = $('[dependent-group="' + el.attr("dependent-group") + '"]', frm);

        /*repomos o valor por defeito das listas*/
        if (resetLists) {
            obj.resetLists(frm, el);
        }

        var res = [],
                match;
        /* Se houver otherValues, disponibilizamos no caso do elemento não estar vazio*/

        if (el.attr("otherValues")) {
            if (el.val() !== "") {
                var result = _.find(
                        initApp.joinsComplexData[obj.getComplexListIndex(el, null, true)],
                        {VAL: el.val()}
                );
                if (result) {
                    obj.mapOtherValues(el, action, result);
                }
            } else {
                /*reinicializamos as othervalues se não houver valor no elemento*/
                delete obj["otherValues"];
            }
        }
        /* os restantes devem refletir os valores filtrados relativos ao elemento alvo do change*/
        if (resetLists) {
            obj.propagateFormChanges(els, el, frm, action, formData, evt);
        }
    };
    QuadList.prototype.getComplexListIndex = function (
            target,
            action,
            idxOnly,
            level
            ) {
        var obj = this;
        var arr = initApp.joinsComplexData;
        var idx = "";
        if (!target instanceof $ && target.attr) {
            target = target.attr;
        }

        if (target instanceof $) {
            //se for um objecto jquery usa-se .attr(). normalmente vem de um QuadForm

            idx += target.attr("data-db-name") + "__";
            idx += target.attr("decodeFromTable") + "__";
            idx += target.attr("desigColumn")
                    ? target.attr("desigColumn") + "__"
                    : target.attr("name") + "_";
            idx += target.attr("orderBy") ? target.attr("orderBy") + "__" : "";
            idx += target.attr("whereClause") ? target.attr("whereClause") + "__" : "";
        } else if (target.attr != undefined) {
            //usado pelo quadTable , .attr[] significa que é o attr de um target do tablecols

            idx += target.attr["data-db-name"] + "__";
            idx += target.attr["decodeFromTable"] + "__";
            idx += target.attr["desigColumn"]
                    ? target.attr["desigColumn"] + "__"
                    : target.attr["name"] + "_";
            idx += target.attr["orderBy"] ? target.attr["orderBy"] + "__" : "";
            idx += target.attr["whereClause"] ? target.attr["whereClause"] + "__" : "";
        } else {
            //fallback de segurança...

            idx += target["data-db-name"] + "__";
            idx += target["decodeFromTable"] + "__";
            idx += target["desigColumn"]
                    ? target["desigColumn"] + "__"
                    : target["name"] + "_";
            idx += target["orderBy"] ? target["orderBy"] + "__" : "";
            idx += target["whereClause"] ? target["whereClause"] + "__" : "";
        }
        if (action) {
            //se o parametro action existir , acrescentamos ao indice
            idx += action;
            idx += obj instanceof QuadTable ? obj.tableId : obj.formId.substring(1);
        } else {
            idx = idx.slice(0, -2);
        }
        if (idxOnly) {
            // retornamos apenas o indice ou o array com os dados , dependente do parametro e da necessidade no momento
            return idx;
        } else {
            return arr[idx];
        }
    };
    QuadList.prototype.emulateComplexListJoin = function (
            bindStrFilled,
            field,
            action,
            rowValues,
            asyncBool,
            frm,
            level,
            elTriggered,
            evt,
            renew = false
            ) {
        var el = frm.find("[name='" + field.name + "']");
        var elChosen = el.attr("id") + "_chosen";
        el.attr("dependent-level").indexOf("&") != -1
                ? (asyncBool = false)
                : (asyncBool = asyncBool);
        var dateFields = [],
                dataStore = "";
        var obj = this;
        if (field.attr) {
            field = field.attr;
        }
        //COLLECT datatype fields to send to controller
        //Se for um campo date ou datetime enviamos para servidor para formatar a query
        //Este método tambem é chamado na abertura do editor com condições predefenidas e binds
        //substituimos as bind variables pelos valores
        var params = {
            renew: renew,
            idx: obj.getComplexListIndex(field, action, true, level) + "*deferred",
            pk: field["data-db-name"],
            table: field.decodeFromTable,
            dateFields: obj.compileDateFields(
                    field["data-db-name"]
                    .replace(quadConfig.regExpressions.alias, "")
                    .split("@"),
                    field["otherValues"]
                    ? field["otherValues"]
                    .replace(quadConfig.regExpressions.alias, "")
                    .split("@")
                    : null,
                    null
                    ),
            filter: bindStrFilled,
            where: field.whereClause,
            orderBy: field.orderBy,
            desigColumn: field.desigColumn
        };
        $.ajax({
            type: "POST",
            url: obj.pathToComplexListsFile,
            data: params,
            cache: false,
            async: asyncBool,
            beforeSend: function () {
                el.addClass("loadingList");
                $("#" + elChosen).addClass("loadingList");
            },
            success: function (strData) {
                //todo este callback deveria ser refeito ou simplificado
                var dat = JSON.parse(strData);
                dataStore =
                        obj.getComplexListIndex(field, action, true, level) + "*deferred";
                initApp.joinsComplexData[dataStore] = dat;
                if (rowValues && action === "edit") {
                    //é um edit e temos que preencher o valor do campo no registo e fazer o trigger change , etc...
                    var value = "";
                    var keys = obj.returnListKeys(field);

                    _.map(keys, function (name, i) {
                        if (i < keys.length - 1) {
                            value += rowValues.data[0][name]
                                    ? rowValues.data[0][name] + "@"
                                    : "";
                        } else {
                            value += rowValues.data[0][name];
                        }
                    });
                    if ($(frm).is("tr")) {
                    } else {
                        var elChosen = el.attr("id") + "_chosen";
                    }
                    //var elChosen = el.attr('id') + '_chosen';
                    if (evt === true && initApp.joinsComplexData[dataStore].length > 0) {
                        obj.addOptionsToList(el, initApp.joinsComplexData[dataStore]);
                    } else {
                        if (initApp.joinsComplexData[dataStore].length > 0) {
                            obj.fillDropdown(
                                    initApp.joinsComplexData[dataStore],
                                    el,
                                    field,
                                    null,
                                    value,
                                    action,
                                    null,
                                    true
                                    );
                        }
                    }

                    if (el.hasClass("chosen")) {
                        obj.toChosen(el, elChosen);
                    }
                    el.removeClass("loadingList");
                } else {
                    //chega aqui se for um create...não precisamos selecionar o valor do campo no registo corrente, apenas preencher a lista com os valores do request
                    obj.addOptionsToList(el, initApp.joinsComplexData[dataStore]);
                }
            }
        });
    };
    QuadList.prototype.toChosen = function (el, elChosen) {
        var obj = this;
        obj.createSearchableList(el);
        el.trigger("chosen:updated");

        $("#" + elChosen).removeClass("loadingList");
    };
    QuadList.prototype.compileDomainRequests = function (field, refresh = false) {
        var obj = this;
        var grp = field["dependent-group"];
        obj.domainRequests = obj.domainRequests || {};
        if (refresh) {
            obj.domainRequests[grp] = grp;
        } else {
            if (!initApp.joinsData[grp]) {
                obj.domainRequests[grp] = grp;
            }
    }
    };

    QuadList.prototype.emulateJoin = function (fieldAttr, force, asyncBool) {
        //metodo de obtenção dos domains....
        var obj = this;
        var grp = fieldAttr["decodeFromCol"];
        var params = {
            decodeColumn: grp,
            table: fieldAttr.decodeFromTable,
            codeColumn: fieldAttr.name,
            dependentGroup: fieldAttr["dependent-group"],
            request_id: fieldAttr["dependent-group"],
            join: true
        };
        //podemos comentar esta linha (if)  se não quisermos tar sempre a fazer request. Se os dados não mudarem como por exemplo nas domain lists
        if (initApp.joinsData[fieldAttr["dependent-group"]] && !force) {
            return;
        } else {
            obj.dependentListsMode = "all";
            $.ajax({
                type: "POST",
                url: obj.pathToListsFile,
                data: params,
                cache: false,
                async: asyncBool,
                success: function (strData) {
                    initApp.joinsData[fieldAttr["dependent-group"]] = JSON.parse(strData);
                    obj.hideSpinner();
                },
                beforeSend: function () {
                    if (obj instanceof QuadForm) {
                        $(obj.formId + " > ._spinner").show();
                    }
                    if (obj instanceof QuadTable) {
                        $("." + obj.tableId + "_spinner").show();
                    }
                }
            });
        }
    };
    QuadList.prototype.fillDropdown = function (
            arr,
            el,
            o,
            formType,
            value,
            action,
            elTriggered,
            evt
            ) {
        action = action || action;
        evt = evt || null;
        var obj = this,
                oValues;
        var elChosen = el.attr("id") + "_chosen";
        el.addClass("loadingList");
        $("#" + elChosen).addClass("loadingList");

        if (arr && arr.length > 0) { //PMA; 2020-07-13: Para evitar arr === undefined
            obj.addOptionsToList(el, arr);
        }

        if (!formType) {
            if (action === "create") {
                if (o && o.def) {
                    if (_.find(arr, {VAL: o.def})) {
                        el.val(o.def);
                        el.trigger("change");
                    }
                }
            }
        } else {
            if (el && el.data("def")) {
                if (_.find(arr, {VAL: el.data("def")})) {
                    if (el.val() === "") {
                        el.val(el.data("def"));
                        el.trigger("change", [
                            {
                                submit: false,
                                refreshFilters: false
                            }
                        ]);
                    }
                }
            }
        }
        if (value) {
            el.val(value);
            //!important bug fix !!!!IMPORTANT
            if (!el.val()) {
                el.val(el.find("option:contains(" + value.escapeSelector() + ")").val());
            }
        } else {
            obj.ifIsRequired(arr, el, action);
        }

        el.removeClass("loadingList");
        $("#" + elChosen).removeClass("loadingList");
    };
    QuadList.prototype.ifIsRequired = function (arr, el, action) {
        var obj = this;
        if (action === "create") {
            //se for um create , se existir apenas um elemento e for um required , selecionamos a unica option disponível
            if (
                    arr.length === 1 &&
                    obj["validations"] &&
                    obj["validations"]["rules"][el.attr("name")] &&
                    obj["validations"]["rules"][el.attr("name")].required &&
                    el.val() === ""
                    ) {
                el.val(arr[0].VAL ? arr[0].VAL : arr[0].RV_LOW_VALUE);
                setTimeout(function () {
                    //trigger change para filtrar os elementos subsequentes , preencher binds etc...
                    el.trigger("change", [
                        {
                            submit: false,
                            refreshFilters: false
                        }
                    ]);
                }, 0);
            }
        }
    };
    QuadList.prototype.createSearchableList = function (el) {
        var obj = this;
        var options = {
            no_results_text: "_RESULTS_VARIABLE",
            placeholder_text_single: " ",
            allow_single_deselect: true,
            search_contains: true
        };
        el.hover(function () {
            if (el.attr("readonly") || el.attr("disabled")) {
                return;
            }
            el.chosen(options);
            el.trigger("chosen:updated");
            if (el.hasClass("error")) {
                $(el.next(".chosen-container")).addClass("error");
            }
        });
    };
//populamos as listas complexas no editor
    QuadList.prototype.fillComplexList = function (o, frm, formType, data, action) {
        var obj = this;
        var keys = this.returnListKeys(o);
        var el = $('[name="' + o.name + '"]', frm);

        if (obj instanceof QuadTable) {
            if (o.def) {
                o.attr["def"] = o.def;
            }
            o = o.attr;
        }
        if (el.attr("dependent-level") == 1) {
            //preenchemos as listas se for um level 1

            if (el.attr("deferred")) {
                //se for um deferred (binds) procuramos fazer o preenchimento das binds e sbsequente request
                if (o.filter && Object.keys(o.filter).length != 0) {
                    if (o.filter[action]) {
                        var info = obj.bindValues(o.filter[action], o, null, frm, el, data);
                        obj.getDeferredBindList(
                                info,
                                el,
                                null,
                                o,
                                frm,
                                data,
                                el.attr("dependent-level"),
                                action
                                ); //PMA FALTAVA
                        obj.createSearchableList(el); //PMA FALTAVA tratar a classe CHOSEN
                    }
                }
                //se for um detail pomos os valores dos campos correspondentes do master num array para posteriormente substituirmos os valores na string
                //estas variáveis não estão a ser usadas...ficam comentadas para memória futura
                //var masterInstance = Object.keys(obj.dependsOn);
                //var masterRowData = window[masterInstance].tbl.row({selected: true}).data();
                if (o.whereClause) {
                    var info = obj.bindValues(o.whereClause, o, null, null, null, null);

                    obj.getDeferredBindList(
                            info,
                            el,
                            null,
                            o,
                            frm,
                            data,
                            el.attr("dependent-level"),
                            action
                            ); //PMA FALTAVA
                    obj.createSearchableList(el); //PMA FALTAVA tratar a classe CHOSEN
                }
            } else {
                obj.fillDropdown(
                    obj.getListOptions(o, action),
                        el,
                        o,
                        formType,
                        data ? data.data[0][o.name] : null,
                        action
                        );
            }
        }else{
            obj.fillDropdown(
                    obj.getListOptions(o, action),
                        el,
                        o,
                        formType,
                        data ? data.data[0][o.name] : null,
                        action
                        );
        }
    };
    /* Método que verifica se o valor de uma lista dependente (value) coincide com o valor da sua lista "master" (parentFilterValue),
     * retornando esse "valor" se e só se a resposta for afirmativa.
     */
    QuadList.prototype.filterListValue = function (value, parentFilterValue) {
        //if (_.startsWith(ob.VAL, parentFilterValue)) {
        //    return ob.VAL;
        //}
        // PMA: 2020.01.03 :: Se procurasse "5" a lista devolvia não só o "5" mas ERRADAMENTE também o: "50", "51", etc..
        if (_.startsWith(value, parentFilterValue)) {
            if (value.length === parentFilterValue.length) {
                return value;
            } else {
                var lookFor = parentFilterValue + "@",
                        len_ = lookFor.length,
                        y = value.substr(0, len_);
                if (parentFilterValue + "@" === y) {
                    return value;
                }
            }
        }
    };
    QuadList.prototype.filterList = function (
            el,
            o,
            parentFilterValue,
            formType,
            value,
            action,
            evt
            ) {
        evt = evt || null;
        action = action || null;
        var obj = this;
        var arrRes = obj.getListOptions(o, action);
        var results = _.filter(arrRes, function (ob) {
            return obj.filterListValue(ob.VAL, parentFilterValue);
        });

        //preenchemos o elemento com o resultado da filtragem
        obj.fillDropdown(results, el, o, formType, value, action, null, evt);
    };
    QuadList.prototype.getListOptions = function (o,action) {
        var obj=this;
        if(obj.getComplexListIndex(o, action) && obj.getComplexListIndex(o, action).length > 0) {
            return obj.getComplexListIndex(o, action)
        } else{
            return obj.getComplexListIndex(o);
        }
    }
    QuadList.prototype.returnListKeys = function (o) {
        var obj = this;
        var keys;
        if (o instanceof $) {
            //se for um quadForm, é passado um objecto jquery em vez de um target do tableCols do quadtable
            o = _.transform(
                    o[0].attributes,
                    function (attrs, attribute) {
                        attrs[attribute.name] = attribute.value;
                    },
                    {}
            );
        } else if (obj instanceof QuadTable) {
            if (o.attr) {
                o = o.attr;
            }
        }
        if (o["distribute-value"]) {
            // retornar o distribute-value, se existir
            keys = o["distribute-value"]
                    .replace(quadConfig.regExpressions.alias, "")
                    .split("@");
        } else {
            keys = o["data-db-name"]
                    .replace(quadConfig.regExpressions.alias, "")
                    .split("@");
        }
        return keys;
    };
    QuadList.prototype.onEditFillComplexList = function (
            o,
            frm,
            data,
            action,
            el,
            elLevel
            ) {
        var obj = this;
        var el = $("[name=" + o.name + "]", frm);


        var elLevel = el.attr("dependent-level");
        obj.fillComplexList(o, frm, obj.externalFilter ? true : null, data, action);
        var value = "";
        var levels;
        levels = [];
        var keys = obj.returnListKeys(o);
        //temos que descodificar o valor da lista baseado no data-db-name ex:empresa@cd_direcao@cd_dept para cmip@400@100
        _.map(keys, function (name, i) {
            if (i < keys.length - 1) {
                value += data.data[0][name] + "@";
            } else {
                value += data.data[0][name];
            }
        });
        //se for um multilevel, temos que contituir um array com os niveis a fim de percorrer e operar os vários níveis
        levels = obj.getCtxListLevels(el, levels);

        //percorremos os niveis e obtemos o nivel anterior para filtrar pelo valor de $(parent).val()
        $.each(levels, function (i, level) {
            if (level > 1) {
                //filtramos as listas e operamos tendo em conta o valor do parent, se for um dependent level > 1
                if (obj.colReorder) {
                    setTimeout(function () {
                        var parentFilterEls = obj.dependentGroupParentElements(
                                el,
                                level,
                                frm
                                );
                        if (el.attr("deferred")) {
                            //tem binds, tentamos preencher...se foram todas preenchidas, submetemos o request para obter os dados
                            obj.manageDeferredLists(o, el, frm, level, data, value, action, i);
                        } else {
                            var els = parentFilterEls.filter(
                                    '[dependent-level*="' + parseInt(parseInt(level) - 1) + '"]'
                                    );
                            $.each(els, function (j, parent) {
                                //we send the value because we need to use the values cause is an edit....
                                var idx = obj.getComplexListIndex(
                                        _.find(obj.tableCols, {name: $(parent).attr("name")}),
                                        null,
                                        false,
                                        level
                                        );
                                var search = {};
                                var field = Object.keys(idx[0])[0];
                                if (field) {
                                    search[field] = data.data[0][$(parent).attr("name")];
                                    var parentVal = _.find(idx, search)["VAL"];
                                    obj.filterList(el, o, parentVal, null, value, action);
                                }
                            });
                        }
                    }, 1000);
                } else {
                    var parentFilterEls = obj.dependentGroupParentElements(el, level, frm);

                    if (el.attr("deferred")) {
                        //tem binds, tentamos preencher...se foram todas preenchidas, submetemos o request para obter os dados
                        obj.manageDeferredLists(o, el, frm, level, data, value, action, i);
                    } else {
                        var els = parentFilterEls.filter(
                                '[dependent-level*="' + parseInt(parseInt(level) - 1) + '"]'
                                );
                        $.each(els, function (j, parent) {
                            //we send the value because we need to use the values cause is an edit....
                            obj.filterList(el, o, $(parent).val(), null, value, action);
                        });
                    }
                }
            }
        });
        //prenchemos com o valor correspondente
        el.val(value);
        if (el.hasClass("chosen")) {
            setTimeout(function () {
                el.trigger("chosen:updated");
            }, 1000);
        }
    };
    QuadList.prototype.getCtxListLevels = function (el, levels) {
        if (el.attr("dependent-level").indexOf("&") != -1) {
            levels = el.attr("dependent-level").split("&");
        } else {
            levels.push(el.attr("dependent-level"));
        }
        return levels;
    };

    QuadList.prototype.dependentGroupParentElements = function (el, level, frm) {
        //todo  led "dependent-group": "HORARIO" rh_time_management ???
        //foi originalmente desenvolvido porque havia no prs
        // situacoes em que assim era. nao alterava se nao houvesse concordancia com data-db-name dos elementos do mesmo grupo.
        var parentFilterEls = $(
                " [dependent-level='" + parseInt(level - 1) + "']",
                frm
                ).filter(function () {
            if ($(this).attr("dependent-group") == el.attr("dependent-group")) {
                if (el.attr("data-db-name").includes($(this).attr("data-db-name"))) {
                    return this;
                } else if (
                        el.attr("distribute-value") &&
                        $(this).attr("distribute-value")
                        ) {
                    if (
                            el.attr("distribute-value").includes($(this).attr("distribute-value"))
                            ) {
                        return this;
                    }
                }
            }
        });
        return parentFilterEls;
    };

    QuadList.prototype.manageDeferredLists = function (
            o,
            el,
            frm,
            level,
            data,
            value,
            action,
            i
            ) {
        action = action || null;
        var obj = this,
                bindStr;
        if (o.attr) {
            o = o.attr;
        }
        if (obj instanceof QuadTable) {
            var previousLevel = _.find(obj.tableCols, {
                attr: {
                    "dependent-group": el.attr("dependent-group"),
                    "dependent-level": parseInt(level) - 1
                }
            });
        } else {
            var previousLevel = _.find(obj.complexLists, {
                "dependent-group": el.attr("dependent-group"),
                "dependent-level": parseInt(level) - 1
            });
        }
        if (
                previousLevel &&
                $('[name="' + previousLevel.name + '"]', frm).val() &&
                _.find(
                        initApp.joinsComplexData[
                                obj.getComplexListIndex(previousLevel, null, true)
                        ],
                        {VAL: $('[name="' + previousLevel.name + '"]', frm).val()}
                )
                ) {
            if (o.filter && Object.keys(o.filter).length !== 0) {
                if (obj instanceof QuadForm && !action) {
                    return;
                }
                bindStr = o.filter[action];
                //se for um level tipo REAL , ex: dependent-level = 3.1, pois temos que agarrar o sql do filtro correspondente
                if (Object.keys(o.filter).indexOf(level + "." + (i + 1)) !== -1) {
                    level = level + "." + (i + 1);
                    previousLevel = $("[name=" + o.filter[level]["triggeredBy"] + "]", frm);
                }
                //se não for um multilevel ex: 3&4
                if (o.filter && _.has(o.filter, level)) {
                    bindStr = o.filter[level][action];
                }
                //obtemos o filtro com as binds prrenchidas ou não
                var info = obj.bindValues(bindStr, o, previousLevel, frm, el, data);
                //se as binds estiverem todas prrenchidas, é despoletado o request
                obj.getDeferredBindList(
                        info,
                        el,
                        previousLevel,
                        o,
                        frm,
                        data,
                        level,
                        action
                        );
            } else {
                //fallback...
                el.val(value);
            }
            //asseguramos que o campo não está disabled...
            el.prop("disabled", false);
        }
    };
    QuadList.prototype.getDeferredBindList = function (
            info,
            el,
            previousLevel,
            o,
            frm,
            data,
            level,
            action,
            evt
            ) {
        action = action || null;
        var obj = this;
        if (obj instanceof QuadForm) {
            frm = $(frm);
        }
        //estão todas as binds preenchidas(info.regExp.exec(info.sql) === null)?
        if (info.regExp.exec(info.sql) === null) {
            //fazemos o request dos dados
            obj.emulateComplexListJoin(
                    info.sql,
                    o,
                    action,
                    data,
                    true,
                    frm,
                    level,
                    previousLevel,
                    evt,
                    true
                    );
        }
    };
    QuadList.prototype.bindValues = function (
            bindStr,
            o,
            previousLevel,
            frm,
            el,
            data
            ) {
        var obj = this;
        if (obj instanceof QuadForm) {
            if (data) {
                data = obj.normalizeData(data);
            }
        }

        var rExp = /:([^']+)/g;
        var res = [],
                match;
        var fieldsBind = {};
        if (obj.dependsOn) {
            while ((match = rExp.exec(bindStr)) !== null) {
                res.push(match[1]);
                var k = _.findIndex(obj.dbColumns, {db: match[1]});
                if (o.whereClause && bindStr === o.whereClause) {
                    fieldsBind[match[1]] = obj.dbColumns[k]["prv_value"];
                } else {
                    fieldsBind[match[1]] = data
                            ? data.data[0][match[1]]
                            : obj.dbColumns[k]["prv_value"];
                }
            }
        } else {
            //se for um master os valores do proprio registo são utilizados ex:data.data[0]
            while ((match = rExp.exec(bindStr)) !== null) {
                res.push(match[1]);
                if (data && data.data[0][match[1]]) {
                    fieldsBind[match[1]] = data.data[0][match[1]];
                }
                //!!!!!very important to othervalues feature
                if (obj.otherValues && _.findKey(obj.otherValues, match[1])) {
                    fieldsBind[match[1]] =
                            obj.otherValues[_.findKey(obj.otherValues, match[1])][match[1]];
                }
            }
        }
        //substituimos os valores na string sql
        var bindStrFilled = bindStr.replace(rExp, function ($0, $1) {
            return fieldsBind[$1] != undefined ? fieldsBind[$1] : $0;
        });
        //retornamos o filtro com as binds totalmente preenchidas ou não, a expressão regular(para não estarmos sempre a defeni-la e o array com as binds encontradas.
        return {sql: bindStrFilled, regExp: rExp, res: res};
    };
//Populamos as domain lists no editor com todos os valores. Na pesquisa avançada e no create

    QuadList.prototype.populateDomainLists = function (frm, action) {
        action = action || null;
        var output = [];
        var obj = this;
        $(" [domain-list]", frm).each(function (index) {
            var elem = $(this);
            elem.empty();
            var grp = $(this).attr("dependent-group");
            output = [];
            output.push("<option> </option>");
            if (obj instanceof QuadTable) {
                var ob = _.find(obj.tableCols, {name: elem.attr("name")});
            }
            //se for um quadForm , as domains estão defenidas de forma diferente, pois não existe o tablecols próprio do quadTable

            if (obj instanceof QuadForm) {
                var ob = _.has(obj.domainLists, elem.attr("name"));
                if (_.has(obj.domainLists, elem.attr("name"))) {
                    var ob = obj.domainLists[elem.attr("name")];
                    if (!ob["attr"]) {
                        ob["attr"] = {};
                        var key;
                        for (key in ob) {
                            if (key !== "attr") {
                                ob["attr"][key] = ob[key];
                            }
                        }
                    }
                }
            }

            //Este código elimina a necessidade do render constante nas domains.
            if (ob["attr"] && ob["attr"]["showValues"]) {
                _.forEach(initApp.joinsData[grp], function (o, i) {
                    output.push(
                            "<option value='" +
                            o[Object.keys(ob.attr.showValues)[0]] +
                            "'>" +
                            o[ob.attr.showValues[Object.keys(ob.attr.showValues)[0]]] +
                            "</option>"
                            );
                });
            } else {
                _.forEach(initApp.joinsData[grp], function (o, i) {
                    output.push(
                            "<option value='" + o.RV_LOW_VALUE + "'>" + o.RV_MEANING + "</option>"
                            );
                });
            }
            elem.html(output.join(""));
            obj.ifIsRequired(initApp.joinsData[grp], elem, action);
            setTimeout(function () {
                if (elem.hasClass("chosen")) {
                    //inicializamos o chosen no elemento
                    obj.createSearchableList(elem);
                }
            }, 1);
            //se estivermos num 'CREATE' e o elemento tiver um valor por defeito, temos que despoletar um Change para filtrar ou despoletar o prrenchimento de binds que estejam relacionadas com este domain
            if (action === "create") {
                if (ob && ob.def) {
                    if (_.find(initApp.joinsData[grp], {RV_LOW_VALUE: ob.def})) {
                        elem.val(ob.def);
                        elem.trigger("change");
                    }
                }
            }
        });
    };
    QuadList.prototype.populateComplexLists = function (frm, action = false) {
        //método genérico para preencher todas as complexLists
        var obj = this;
        var output = [];
        $(".complexList", frm).each(function (index) {
            var elem = $(this);
            elem.empty();
            output = [];
            output.push("<option> </option>");
            var idx = obj.getComplexListIndex($(elem), action, true);
            $(elem).attr("deferred") ? (idx += "*deferred") : "";
            _.map(initApp.joinsComplexData[idx], function (ob, i) {
                output.push(
                        '<option value="' + ob.VAL + '">' + ob[Object.keys(ob)[0]] + "</option>"
                        );
            });
            elem.html(output.join(""));
            obj.ifIsRequired(
                    initApp.joinsComplexData[obj.getComplexListIndex($(elem), action, true)],
                    elem,
                    action
                    );
            if (action == "edit") {
                var o = _.find(
                        obj.complexLists ? obj.complexLists : quadConfig.loadData,
                        {
                            "data-db-name": elem.attr("data-db-name"),

                            name: elem.attr("name")
                        }
                );
                obj.onEditFillComplexList(
                        o,
                        frm,
                        obj.normalizeData(obj.myData["data"][obj.currentRecord]),
                        action
                        );
            }
        });

        if (action !== "edit") {
            obj.resetLists(frm);
    }
    };
    QuadList.prototype.encodeDomains = function () {
        var obj = this;

        _.forEach(obj.tableCols, function (ob) {
            if (ob.attr && _.has(ob.attr, "domain-list")) {
                var preVal = _.find(obj.dbColumns, {db: ob.name})["prv_value"];
                if (preVal) {
                    var bool = _.find(initApp.joinsData[ob["attr"]["dependent-group"]], {
                        RV_MEANING: preVal
                    });
                    if (bool) {
                        _.find(obj.dbColumns, {db: ob.name})["prv_value"] =
                                bool["RV_LOW_VALUE"];
                    }
                }

                var nextVal = _.find(obj.dbColumns, {db: ob.name})["nxt_value"];
                if (nextVal) {
                    var bool = _.find(initApp.joinsData[ob["attr"]["dependent-group"]], {
                        RV_MEANING: nextVal
                    });
                    if (bool) {
                        _.find(obj.dbColumns, {db: ob.name})["nxt_value"] =
                                bool["RV_LOW_VALUE"];
                    }
                }
            }
        });
    };

    QuadList.prototype.onEditFillDomain = function (frm, o, data, action) {
        action = action || null;
        var obj = this;
        var el = obj instanceof QuadTable ? frm.find('[name="' + o.name + '"]') : o;
        el.empty();
        var output = [];
        output.push("<option> </option>");
        var idx =
                obj instanceof QuadTable
                ? o.attr["dependent-group"]
                : o.attr("dependent-group");
        if (o["attr"]["showValues"] || (o instanceof $ && o.attr("showValues"))) {
            _.map(initApp.joinsData[idx], function (v, index) {
                if (obj instanceof QuadForm) {
                    var ob = _.has(obj.domainLists, o.attr("name"));
                    if (_.has(obj.domainLists, o.attr("name"))) {
                        var ob = obj.domainLists[o.attr("name")];
                        output.push(
                                "<option value='" +
                                v[Object.keys(ob.showValues)[0]] +
                                "'>" +
                                v[ob.showValues[Object.keys(ob.showValues)[0]]] +
                                "</option>"
                                );
                    }
                } else {
                    output.push(
                            "<option value='" +
                            v[Object.keys(o.attr.showValues)[0]] +
                            "'>" +
                            v[o.attr.showValues[Object.keys(o.attr.showValues)[0]]] +
                            "</option>"
                            );
                }
            });
        } else {
            _.map(initApp.joinsData[idx], function (v, index) {
                output.push(
                        "<option value='" + v.RV_LOW_VALUE + "'>" + v.RV_MEANING + "</option>"
                        );
            });
        }

        el.html(output.join(""));
        if (o.def && action === "create") {
            el.val(o.def);
            el.trigger("change");
        }
        if (data) {
            var value = data[obj instanceof QuadTable ? o.name : o.attr("name")];
            if (value) {
                //decode domain.
                var bool = _.find(initApp.joinsData[o["attr"]["dependent-group"]], {
                    RV_MEANING: value
                });
                if (bool) {
                    value = bool["RV_LOW_VALUE"];
                }

                el.val(value); //select the option
                if (!el.val()) {
                    el.val(
                            el.find("option:contains('" + value.escapeSelector() + "')").val()
                            ); //fallback por causa dos renders
                }
                if (el.hasClass("chosen")) {
                    el.trigger("chosen:updated");
                }
            }
        } else {
            obj.ifIsRequired(initApp.joinsData[idx], el, action);
        }
        setTimeout(function () {
            if (el.hasClass("chosen")) {
                obj.createSearchableList(el);
            }
        }, 1);
    };
// MAP COMPLEX LIST VALUES TO MATCHING FIELDS
    QuadList.prototype.mapComplexLists = function (data) {
        //passamos data-db-name ex: de empresa@direcao@departamento para cmip@400@100
        var obj = this;
        var index = Object.keys(data.data);
        var d = data.data[index],
                previousLevel;
        if (obj instanceof QuadTable) {
            _.map(obj.tableCols, function (ob) {
                if (ob.complexList && ob.type !== "hidden") {
                    var keys = obj.returnListKeys(ob);
                    _.map(keys, function (name, i) {
                        if (d[ob.data]) {
                            try {
                                var listData = d[ob.data]
                                        .replace(quadConfig.regExpressions.alias, "")
                                        .split("@");
                                d[name] = listData[i];
                            } catch (e) {
                                //CHOSEN MULTI-OPTION
                                null;
                                console.log("catch null :(");
                            }
                        } else {
                            d[name] ? (d[name] = d[name]) : (d[name] = "");
                            previousLevel = _.find(obj.tableCols, {
                                attr: {
                                    "dependent-group": ob.attr["dependent-group"],
                                    "dependent-level": parseInt(ob.attr["dependent-level"]) - 1
                                }
                            });
                            //!!IMPORTANTE se field existe noutro data-db-name relacionado(dependent-level -1) , não faz o reset ao campo . Só faz reset aos campos que são unicos a este data-db-name
                            if (
                                    previousLevel &&
                                    _.contains(
                                            _.intersection(keys, obj.returnListKeys(previousLevel)),
                                            name
                                            )
                                    ) {
                                return;
                            }
                        }
                    });
                }
            });
        } else {
            _.map(obj.complexLists, function (ob) {
                var keys = obj.returnListKeys(ob);
                _.map(keys, function (name, i) {
                    if (d[ob.name]) {
                        var listData = d[ob.name]
                                .replace(quadConfig.regExpressions.alias, "")
                                .split("@");
                        d[name] = listData[i];
                    } else {
                        d[name] ? (d[name] = d[name]) : (d[name] = "");
                        previousLevel = _.find(obj.complexLists, {
                            "dependent-group": ob["dependent-group"],
                            "dependent-level": parseInt(ob["dependent-level"]) - 1
                        });
                        //!!IMPORTANTE se field existe noutro data-db-name relacionado(dependent-level -1) , não faz o reset ao campo . Só faz reset aos campos que são unicos a este data-db-name
                        if (
                                previousLevel &&
                                _.contains(
                                        _.intersection(keys, obj.returnListKeys(previousLevel)),
                                        name
                                        )
                                ) {
                            return;
                        }
                    }
                });
            });
        }
        data.data[index] = d;
        return data;
    };
    QuadList.prototype.getComplexListValue = function (keys) {
        //este método serve para obter o valor da lista a partir do data-db-name e dos valores do registo corrente(obj.dbColumns)
        var obj = this;
        var val = [],
                key;
        _.forEach(keys, function (name, i) {
            key = _.find(obj.dbColumns, {db: name})["prv_value"];
            if (key) {
                val.push(key);
            }
        });
        return val.join("@");
    };
    QuadList.prototype.resetLists = function (frm, elem) {
        var obj = this;
        var elems = $(
                ' [dependent-group="' + $(elem).attr("dependent-group") + '"]',
                frm
                );
        if (elem && elem.length > 0) {
            $.each(elems, function (index, value) {
                if (
                        $(value).attr("dependent-level") > $(elem).attr("dependent-level") &&
                        $(value)
                        .attr("data-db-name")
                        .indexOf($(elem).attr("data-db-name")) !== -1
                        ) {
                    obj.clearList(value);

                    if ($(frm).hasClass("extendedForm")) {
                        _.remove(obj.sFilters, {name: $(value).attr("name")});
                    }
                }
            });
        } else {
            var elems = $(frm).find(".complexList");
            $.each(elems, function (index, value) {
                if ($(value).attr("dependent-level") != 1) {
                    obj.clearList(value);
                }
            });
        }
        // }
    };
//metodo para trabalhar as seleçcões em campo multilevel quando não existe uma seleçcão do valor(opção vazia)
//Não está a ser usado
    QuadList.prototype.multiLevel = function (el, res, frm) {
        if (el.val() == "") {
            var elements = $(".complexList", frm).filter(
                    '[dependent-group="' + el.attr("dependent-group") + '"]'
                    );
            var sameLevel = parseInt(el.attr("dependent-level"));
            var prvLevelEls = $(elements).filter(
                    '[dependent-level="' + sameLevel + '"]'
                    );
            $.each(prvLevelEls, function (i, elemt) {
                if ($(elemt).val()) {
                    var fields = $(elemt)
                            .attr("data-db-name")
                            .replace(quadConfig.regExpressions.alias, "")
                            .split("@");
                    //se todos os campos do data-db-name existirem nas bind , quer dizer que é este o element a filtrar/mudar
                    if (_.intersection(fields, res).length === fields.length) {
                        $(elemt).trigger("change");
                    }
                }
            });
        }
    };
    QuadList.prototype.propagateFormChanges = function (
            els,
            el,
            frm,
            action,
            data,
            evt
            ) {
        evt = evt || null;
        action = action || null;
        var obj = this;
        var levels, match;
        //percorremos cada complexList
        _.map(els, function (element, i) {
            levels = [];
            if ($(element).attr("dependent-level")) {
                if (
                        $(element)
                        .attr("dependent-level")
                        .indexOf("&") != -1
                        ) {
                    levels = $(element)
                            .attr("dependent-level")
                            .split("&");
                } else {
                    levels.push($(element).attr("dependent-level"));
                }

                _.map(levels, function (level, i) {
                    //se o level do elemento alvo do evento change for < que o elemento no ciclo
                    if (
                            el.attr("dependent-group") === $(element).attr("dependent-group") &&
                            parseInt(el.attr("dependent-level")) < parseInt(level)
                            ) {
                        //se for o próximo elemento dependente
                        if (parseInt(el.attr("dependent-level")) + 1 == parseInt(level)) {
                            if (!$(element).attr("deferred")) {
                                if (el.val()) {
                                    var search = el.val();
                                    //filtramos os resultados segundo a operação e o filtro defenido onEdit/onCreate
                                    //se existir filtro
                                    var ob = _.find(
                                            obj.tableCols ? obj.tableCols : obj.complexLists,
                                            {name: $(element).attr("name")}
                                    );

                                    if (
                                            $(element)
                                            .attr("data-db-name")
                                            .indexOf(el.attr("data-db-name")) !== -1 ||
                                            ($(element).attr("distribute-value") &&
                                                    $(element)
                                                    .attr("distribute-value")
                                                    .indexOf(el.attr("distribute-value") !== undefined)
                                                    ? el.attr("distribute-value")
                                                    : el.attr("data-db-name")) !== -1
                                            ) {
                                        var srh = {};
                                        srh["name"] = $(element).attr("name");
                                        if (_.find(data, srh)) {
                                            var value = _.find(data, srh)["value"];
                                        }

                                        if (!value) {
                                            try {
                                                //PMA 2018.09.14
                                                value = obj.getComplexListValue(
                                                        $(element)
                                                        .attr("distribute-value")
                                                        .replace(quadConfig.regExpressions.alias, "")
                                                        .split("@")
                                                        );
                                            } catch (e) {
                                                value = obj.getComplexListValue(
                                                        $(element)
                                                        .attr("data-db-name")
                                                        .replace(quadConfig.regExpressions.alias, "")
                                                        .split("@")
                                                        );
                                            }
                                        }
                                        if (obj instanceof QuadTable) {
                                            obj.filterList(
                                                    $(element),
                                                    ob,
                                                    search,
                                                    frm.hasClass("extendedForm") ? "editorXt" : null,
                                                    null,
                                                    action,
                                                    evt
                                                    );
                                        } else {
                                            obj.filterList(
                                                    $(element),
                                                    ob,
                                                    search,
                                                    frm,
                                                    null,
                                                    action,
                                                    evt
                                                    );
                                        }
                                    }
                                }
                            } else {
                                // se for um complexList DEFERRED e se o elementoa atualizar não for o mesmo que o elemento event target
                                if ($(element).get(0) !== el.get(0)) {
                                    obj.deferredBindListsQueue(
                                            frm,
                                            el,
                                            $(element),
                                            action === "query" ? "create" : action,
                                            level,
                                            i,
                                            data,
                                            evt
                                            );
                                }
                            }
                        }
                    }
                });
            }
        });
        // se não for uma complexList ou domain ex: for um input(ano/mes no interface prs_materialcosts e provavelmente no prs_evaluations )
        if (!el.hasClass("complexList")) {
            var levels = [];
            var elsDeferred = frm.find("[deferred=true]");
            // há mais de que um elemento DEFERRED então temos de os percorrer e despoletar o change EVENT se houver bind associada ao elemento
            $.each(elsDeferred, function (i, elem) {
                if (
                        $(elem)
                        .attr("dependent-level")
                        .indexOf("&") != -1
                        ) {
                    levels = $(elem)
                            .attr("dependent-level")
                            .split("&");
                } else {
                    levels.push($(elem).attr("dependent-level"));
                }
                _.map(levels, function (level, i) {
                    obj.deferredBindListsQueue(
                            frm,
                            el,
                            elem,
                            action === "query" ? "create" : action,
                            level,
                            i,
                            data,
                            evt
                            );
                });
            });
        }
    };
    QuadList.prototype.compileDateFields = function (keys, otherValues, frm) {
        //método que serve para compilar os dateFields num array a fim de serem enviados para o servidor.
        var dateFields = [];
        var obj = this;
        var el;
        var oDate = {};
        dateFields = obj.collectDateFields(frm, keys, dateFields, oDate);

        if (otherValues) {
            dateFields = obj.collectDateFields(frm, otherValues, dateFields, oDate);
        }
        return dateFields;
    };
    QuadList.prototype.collectDateFields = function (frm, data, dateFields, oDate) {
        var obj = this;
        _.forEach(data, function (name, i) {
            name = name.escapeSelector();
            if (frm) {
                var el = $("[name=" + name + "]", frm);
                if (el.attr("datatype")) {
                    oDate[name] = el.attr("datatype");
                    dateFields.push(oDate);
                }
            }
            if (obj instanceof QuadTable) {
                var o = _.find(obj.tableCols, {data: name});
                if (o && o.datatype) {
                    oDate[name] = o.datatype;
                    dateFields.push(oDate);
                }
            } else {
                if (obj.dateFields && _.has(obj.dateFields, name)) {
                    oDate[name] = obj.dateFields[name];
                    dateFields.push(oDate);
                }
            }
        });
        return dateFields;
    };

    QuadList.prototype.compileRequests = function (field, refresh, action, frm) {
        //concatenao os dados dos requests das compleXlists , para ser feito apenas um request...diferente dos domains em que é feito um request por cada domain existente.
        var obj = this;
        var renew = false;
        if (field.renew) {
            renew = field.renew;
        }
        if (obj instanceof QuadTable) {
            field = field.attr;
        }
        var grp = field["data-db-name"];
        var keys = grp.replace(quadConfig.regExpressions.alias, "").split("@");
        obj.requests = obj.requests || {};
        //COLLECT datatype fields to send to controller
        //Se for um campo date ou datetime enviamos para servidor para formatar a query
        var dateFields = obj.compileDateFields(
                keys,
                field["otherValues"]
                ? field["otherValues"]
                .replace(quadConfig.regExpressions.alias, "")
                .split("@")
                : null,
                frm ? frm : null
                );
        var params = {
            renew: renew,
            pk: grp,
            table: field.decodeFromTable,
            dateFields: dateFields.length > 0 ? dateFields : field.dateFields,
            filter: field.filter,
            where: field.whereClause,
            orderBy: field.orderBy,
            desigColumn: field.desigColumn,
            otherValues: field.otherValues ? field.otherValues : ""
        };
        if (action) {
            params["editorAction"] = action;
        }
        if (field["otherValues"]) {
            params["otherValues"] = field["otherValues"];
        }

        if (refresh) {
            //Eliminação, após refresh dos recursos associados ao Editor, de modo a que a próxima edição também os refresque...
            delete initApp.joinsComplexData[
                    obj.getComplexListIndex(field, "create", true)
            ];
            delete initApp.joinsComplexData[
                    obj.getComplexListIndex(field, "edit", true)
            ];
            obj.requests[obj.getComplexListIndex(field, null, true)] = params;
        }
        if (
                (!refresh &&
                        !initApp.joinsComplexData[
                                obj.getComplexListIndex(field, action ? action : null, true)
                        ]) ||
                renew
                ) {
            obj.requests[
                    obj.getComplexListIndex(field, action ? action : null, true)
            ] = params;
        }
    };

    QuadList.prototype.getDomainsData = function (asyncBool, refresh = false) {
        var obj = this;
        var params = obj.domainRequests;
        var promise = $.ajax({
            type: "POST",
            url: obj.pathToListsFile,
            data: {domains: params, multiRequest: true, refresh: refresh},
            dataType: "text",
            cache: false,
            async: asyncBool,
            beforeSend: function (action) {
                obj.showSpinner();
            }
        });
        obj.domainRequests = {};
        return promise;
    };

    QuadList.prototype.mapDomainsRequest = function (strData) {
        if (strData && JSON.parse(strData)) {
            var dat = JSON.parse(strData);
            _.each(dat, function (ob, i) {
                initApp.joinsData[i] = ob;
            });
        }
    };

    QuadList.prototype.getListsData = function (
            asyncBool,
            action,
            frm,
            refresh = false
            ) {
        var obj = this;

        var params = obj.requests;
        var promise = $.ajax({
            type: "POST",
            url: obj.pathToComplexListsFile,
            data: {lists: params, multiRequest: true, refresh: refresh},
            dataType: "text",
            cache: false,
            async: asyncBool,
            beforeSend: function (action) {
                obj.showSpinner();
            }
        });
        obj.requests = {};
        return promise;
    };

    QuadList.prototype.addOptionsToList = function (el, arr, elChosen) {
        var obj = this,
                oValues;
        var elChosen = el.attr("id") + "_chosen";
        el.empty();
        var output = [];
        output.push("<option> </option>");
        _.forEach(arr, function (ob, index) {
            oValues = ob["OTHERVALUES"]
                    ? 'data-otherValues="' + ob["OTHERVALUES"] + '"'
                    : "";
            output = obj.appendOption(output, ob.VAL, ob[Object.keys(ob)[0]], oValues);
        });
        el.html(output.join(""));

        if (el.hasClass("chosen")) {
            obj.toChosen(el, elChosen);
        }
        el.removeClass("loadingList");
    };

    QuadList.prototype.appendOption = function (output, name, label, otherValues) {
        if (otherValues) {
            output.push(
                    '<option value="' + name + '" ' + otherValues + ">" + label + "</option>"
                    );
        } else {
            output.push('<option value="' + name + '">' + label + "</option>");
        }

        return output;
    };

    QuadList.prototype.mapListRequest = function (
            strData,
            source,
            action,
            frm,
            rowData,
            externalFilter
            ) {
        //Todo , este modo está confuso e deveria ser alvo de um refatoring
        var obj = this;
        var evtArr = [];
        var rowData = rowData || null;
        var externalFilter = externalFilter || null;
        if (strData && JSON.parse(strData)) {
            var match = {};
            var dat = JSON.parse(strData);
            _.each(dat.data, function (ob, i) {
                match["attr"] = {};
                initApp.joinsComplexData[i] = ob;
                if (action && obj instanceof QuadTable) {
                    var keys = i.split("__");
                    var oIdx = _.find(source, {
                        attr: {"data-db-name": keys[0]}
                    });
                    oIdx ? oIdx : (oIdx = match.attr);
                    if (action == "create") {
                        var el = $(' [name="' + oIdx.name + '"]', frm);
                        obj.fillComplexList(oIdx, $(frm), null, null, action);
                        evtArr.push(el);
                    }
                    if (action == "edit") {
                        var el = $(' [name="' + oIdx.name + '"]', frm);
                        var elChosen = el.attr("id") + "_chosen";
                        obj.addOptionsToList(el, ob, elChosen);

                        if (rowData && rowData[oIdx.name]) {
                            var search = {};
                            if (ob.length > 0) {
                                search[Object.keys(ob[0])[0]] = rowData[oIdx.name];
                                el.val(_.find(ob, search) ? _.find(ob, search)["VAL"] : "");
                                evtArr.push(el);
                            }
                        }
                        if (el.hasClass("chosen")) {
                            el.trigger("chosen:updated");
                        }
                    }
                }
                if (action && obj instanceof QuadForm) {
                    var keys = i.split("__");
                    var oIdx = _.find(source, {
                        "data-db-name": keys[0]
                    });
                    oIdx ? oIdx : (oIdx = match.attr);
                    if (action === "create") {
                        var el = $(' [name="' + oIdx.name + '"]', frm);
                    }
                    if (action === "edit") {
                        var arr = obj.getComplexListIndex(oIdx, null, false);
                        var el = $(' [name="' + oIdx.name + '"]', frm);
                        if (oIdx["dependent-level"] == 1 && oIdx["complexList"] && oIdx.def) {
                            evtArr.push(el);
                        }
                        _.forEach(evtArr, function (el, key) {
                            $(el).trigger("change");
                        });
                        setTimeout(function () {
                            obj.hideSpinner();
                        }, 1);
                    }
                    obj.fillComplexList(
                            oIdx ? oIdx : match.attr,
                            $(frm),
                            externalFilter,
                            rowData ? obj.normalizeData(rowData) : null,
                            action
                            );
                }
            });
        }
        if (frm) {
            frm.trigger("mouseover");
        }
        //se tiver def value
        _.forEach(evtArr, function (el, key) {
            $(el).trigger("change");
        });
        setTimeout(function () {
            $(".complexList", frm).removeClass("loadingList");
            $(".chosen-container", frm).removeClass("loadingList");
            obj.hideSpinner();
        }, 500);
    };
    QuadList.prototype.loadComplexListsForm = function (
            frm,
            refresh = false,
            action = "",
            asyncBool = true
            ) {
        var obj = this;

        $.each(obj.complexLists, function (name, attributes) {
            if (action) {
                obj.compileRequests(attributes, refresh, action, frm);
            } else {
                obj.compileRequests(attributes, refresh, null, frm);
            }
        });
        if (Object.keys(obj.requests).length > 0) {
            obj.disableFields(frm);
            $(".complexList", frm).addClass("loadingList");
            $(".chosen-container", frm).addClass("loadingList");
            $.when(obj.getListsData(asyncBool, action, frm)).then(function (strData) {
                if (strData && JSON.parse(strData)) {
                    obj.mapListRequest(
                            strData,
                            obj.complexLists,
                            action,
                            $(frm),
                            obj.myData.data[obj.currentRecord]
                            ? obj.myData.data[obj.currentRecord]
                            : null,
                            obj.externalFilter ? true : false
                            );

                    setTimeout(function () {
                        obj.hideSpinner();
                        $(".complexList", frm).removeClass("loadingList");
                        $(".chosen-container", frm).removeClass("loadingList");
                    }, 1);
                    obj.populateComplexLists(frm, action);
                    obj.enableFields(frm);
                }
            });
        } else {
            obj.populateComplexLists(frm, action);
    }
    };
    QuadList.prototype.loadComplexListsTable = function () {
        //todo return a promise
    };

    QuadList.prototype.loadDomains = function (async) {
        var obj = this;
        return $.Deferred(function () {
            var self = this;
            if (
                    obj.domainRequests !== undefined &&
                    Object.keys(obj.domainRequests).length > 0
                    ) {
                $.when(obj.getDomainsData(async)).then(function (strData) {
                    if (strData && JSON.parse(strData)) {
                        obj.mapDomainsRequest(strData);
                    }
                    obj.hideSpinner();
                    self.resolve();
                });
            }
        });
    };

    QuadList.prototype.fillListsAndDomains = function (action, data, rowData, frm) {
        var obj = this;
        _.forEach(obj.tableCols, function (o, key) {
            var el = $(
                    "[name='" + o.attr["name"] + "']",
                    $("#" + obj.tableId + "_editorForm")
                    );
            if (_.has(o, "complexList")) {
                /*disponiblizamos os otherValues para estarem disponíveis se for o caso*/
                obj.listOtherValues(o, rowData, el);

                /*preenchemos as listas complexas e enviamos o argumento data(dados do registo) para serem preenchidas com os dados.
                 Dentro desta função também são chamados métodos de filtragem das listas dependentes*/
                obj.onEditFillComplexList(
                        o,
                        $("#" + obj.tableId + "_editorForm"),
                        data,
                        obj.editor.s.action
                        );
            }
            if (_.has(o.attr, "domain-list")) {
                //preenchemos os domais e enviamos o datacopy para estarem disponíveis os dados da row para preencher os valores corretamente
                obj.onEditFillDomain(frm, o, rowData, obj.editor.s.action);
            }
            if (_.has(o.attr, "disabled") && action === "edit") {
                el.attr("disabled", "disabled");
            }
            if (!_.has(o, "complexList") && !_.has(o.attr, "domain-list")) {
                if (el.length > 0) {
                    if (rowData) {
                        el.val(rowData[o.attr["name"]]);
                    }
                }
            }
        });
    };

    QuadList.prototype.listOtherValues = function (o, data, el) {
        var obj = this;
        if (o.attr["otherValues"]) {
            var prop = el.attr("desigColumn");
            var search = {};
            search[prop] = data[el.attr("name")];
            var result = _.find(
                    initApp.joinsComplexData[obj.getComplexListIndex(el, null, true)],
                    search
                    );
            if (result) {
                delete obj["othervalues"];
                obj.mapOtherValues(el, "edit", result);
            }
        }
    };

    QuadList.prototype.clearList = function (el) {
        $(el).empty();
        $(el).append("<option> </option>");
        if ($(el).hasClass("chosen")) {
            $(el).trigger("chosen:updated");
        }
    };
