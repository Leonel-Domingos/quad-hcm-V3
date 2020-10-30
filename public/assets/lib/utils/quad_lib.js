/*
 * QUAD-IN-MEMORY (QIM) RESOURCES
 *
 * Na sua utilização mais comum, o parâmetro "group" está pensado para identificar a TABELA,
 * enquanto o parâmetro key (se especificado) está pensado para identicar a "chave complementar", SEPARADOS por "#"
 *
 * P.Ex: DG_ANOS_DEMO
 *      TABELA: DG_ANOS
 *      KEY:  "DEMO"
 */


//Inicialização
function initQim() {
    initApp.QuadInMemory = initApp.QuadInMemory || {};
}

//Drop
function dropQim() {
    delete initApp.QuadInMemory;
}

//Add Resource
function setQim(group, key, resource, force) {
    var idx = (typeof key !== 'undefined') ? group + '#' + key : group;

    initQim();

    force = (typeof force !== 'undefined') ? force : false;

    initApp.QuadInMemory[ idx ] = initApp.QuadInMemory[ idx ] || {};

    if ( force ) {
        initApp.QuadInMemory[ idx ] = {};
    }
    initApp.QuadInMemory[ idx ] = resource;
}

//Get Resource
function getQim(group, key) {
    var idx = (typeof key !== 'undefined') ? group + '#' + key : group;

    initQim();
    if ( initApp.QuadInMemory[ idx ] ) {
        return initApp.QuadInMemory[ idx ];
    }
    return {};
}

//Delete Resource
function delQim(group, key) {
    initQim();
    key = (typeof key !== 'undefined') ? group + '#' + key : group;
    delete initApp.QuadInMemory.key;
}
/*
 * END QUAD-IN-MEMORY (QIM) RESOURCES
 */

/**
 *
 *  Javascript string pad
 *  http://www.webtoolkit.info/
 *
 **/

/*
 * Polyfills
 * -------------------
 * IE -> ECMAScript 6
 */
if (!String.prototype.includes) {
  String.prototype.includes = function(search, start) {
    'use strict';

    if (search instanceof RegExp) {
      throw TypeError('first argument must not be a RegExp');
    }
    if (start === undefined) { start = 0; }
    return this.indexOf(search, start) !== -1;
  };
}
if (!String.prototype.startsWith) {
    Object.defineProperty(String.prototype, 'startsWith', {
        value: function(search, rawPos) {
            var pos = rawPos > 0 ? rawPos|0 : 0;
            return this.substring(pos, pos + search.length) === search;
        }
    });
}
if (!String.prototype.endsWith) {
	String.prototype.endsWith = function(search, this_len) {
		if (this_len === undefined || this_len > this.length) {
			this_len = this.length;
		}
		return this.substring(this_len - search.length, this_len) === search;
	};
}
/*
 * END Polyfills
 * -------------------
 */

/*
 * Notificações
 */

// ############
// Notificações

// https://github.com/CodeSeven/toastr
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": 300,
  "hideDuration": 100,
  "timeOut": 5000,
  "extendedTimeOut": 1000,
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

/*
 * Mostra notificação no canto superior direito
 * param data_ :
 *  {
 *     type:  success ou info ou warning ou error
 *     title: JS_OPERATION_ABORT,
 *     content:
 *           '<i class="fa fa-clock-o"></i>&nbsp;<i>.' +
 *           JS_RECORD_NOT_DELETED +
 *           "</i>",
 *     timeout: 1500
 *  }
 */

// emite notificação
function quad_notification(data_) {

    var title_ = '', content_ = '', type_ = 'info';

    if (typeof data_.type !== 'undefined') {
        type_ = data_.type;
    }

    if (typeof data_.title !== 'undefined') {
        title_ = data_.title;
    }

    if (typeof data_.content !== 'undefined') {
        content_ = data_.content;
    }

    if (typeof data_.timeout !== 'undefined') {
        toastr.options.timeOut = data_.timeout;
    } else {
        toastr.options.timeOut = 0;
    }

    initApp.playSound(myapp_config.assetsUrl + "/media/sound", "messagebox"),
    "undefined" != typeof toastr
        ? toastr[type_](content_, title_)
        : confirm(content_);
};

// limpa todas as notificações
function quad_notification_clear() {
    toastr.clear();
};
/* END NOTIFICAÇÓES */

/* GET FILTER CONDITIONS */
function getFilterCondition (specifics) {
    //var data = JSON.parse([[{"scope": "filter_cadastro","lang": y, "perfil": _id_perfil, "rhid": _rhid, "user": user_id, "hierarquia": hierarquia, "rhid_delegado": _rhid_delegado}]);
    var filter_where = "", data = JSON.parse(specifics);
    //console.log(data);
    if (data.scope === 'filter_cadastro') { //Interface de Cadastro
        if (data.perfil === '1') { //Perfil Colaborador
                filter_where = " AND RHID = " + data.rhid + "";
        } else { //Outros casos...
            if (data.hierarquia === 'S') { //Perfil Hierarquico
                if (!data.rhid_delegado) {
                    filter_where = " RHID IN (SELECT RHID FROM RH_ID_WORKFLOWS WHERE (ID_UTILIZADOR = " +  data.user + " OR RHID_CHEFIA = '" + data.rhid + "')"+
                            " AND QUADATE() BETWEEN DT_INI AND NVL(DT_FIM, QUADATE()) AND ID_PERFIL = " + data.perfil + ")";
                } else {
                    filter_where = " RHID IN (SELECT RHID FROM RH_ID_WORKFLOWS WHERE (ID_UTILIZADOR= " +  data.user + " OR RHID_CHEFIA IN ('" + data.rhid + "','" + data.rhid_delegado + "'))" +
                            " AND QUADATE() BETWEEN DT_INI AND NVL(DT_FIM, QUADATE()) AND ID_PERFIL = " + data.perfil + ")";
                }
            } else { //Perfil Funcional
                filter_where = "";
            }
        }
    } else if (data.scope === 'filter_time_management') { //Interface de Gestão de Tempo
        if (data.perfil === '1') { //Perfil Colaborador
                filter_where = " AND RHID = " + data.rhid + "";
        } else { //Outros casos...
            if (data.hierarquia === 'S') { //Perfil Hierarquico
                if (!data.rhid_delegado) {
                    filter_where = " RHID IN (SELECT RHID FROM RH_ID_WORKFLOWS WHERE (ID_UTILIZADOR = " +  data.user + " OR RHID_CHEFIA = '" + data.rhid + "')"+
                            " AND QUADATE() BETWEEN DT_INI AND NVL(DT_FIM, QUADATE()) AND ID_PERFIL = " + data.perfil + ")";
                } else {
                    filter_where = " RHID IN (SELECT RHID FROM RH_ID_WORKFLOWS WHERE (ID_UTILIZADOR= " +  data.user + " OR RHID_CHEFIA IN ('" + data.rhid + "','" + data.rhid_delegado + "'))" +
                            " AND QUADATE() BETWEEN DT_INI AND NVL(DT_FIM, QUADATE()) AND ID_PERFIL = " + data.perfil + ")";
                }
            } else { //Perfil Funcional
                filter_where = "";
            }
        }
    } else if (data.scope === 'workflow_management') { //Interface de Wokflow Massivo
        if (data.hierarquia === "S") { //Perfil Hierarquico
            filter_where = " FINISHED = 'N' AND REJECTED = 'N' AND NEXT_PERFIL <= " + data.perfil + " AND JSON_EXTRACT(PK, '$.RHID') IN "
            if (!data.rhid_delegado) {
                filter_where += " (SELECT RHID FROM RH_ID_WORKFLOWS WHERE (ID_UTILIZADOR = " +  data.user + " OR RHID_CHEFIA = '" + data.rhid + "')"+
                                " AND QUADATE() BETWEEN DT_INI AND NVL(DT_FIM, QUADATE()) AND ID_PERFIL = " + data.perfil + ")";
            } else {
                filter_where += " (SELECT RHID FROM RH_ID_WORKFLOWS WHERE (ID_UTILIZADOR= " +  data.user + " OR RHID_CHEFIA IN ('" + data.rhid + "','" + data.rhid_delegado + "'))" +
                        " AND QUADATE() BETWEEN DT_INI AND NVL(DT_FIM, QUADATE()) AND ID_PERFIL = " + data.perfil + ")";
            }
        } else { //Perfil Funcional
            filter_where = " FINISHED = 'N' AND REJECTED = 'N' AND NEXT_PERFIL <= " + data.perfil;
        }
    }
    return filter_where;
}

/* RGPD QUADFORMS resources*/
if ( 1 === 1 ) {
    //Serve para atribuir o data-exclude NUMA COLUNA ESPECÍFICA de uma Instância QUADFORMS
    function setRGPD_Field_on_Form (instanceId, colName, acesso) {
        var el = $(instanceId + ' ' + '[name="' + colName + '"]');
        if ( el.length) {
            el.attr('data-exclude', !acesso); //NOME: false MEANS exclude-> true, and vice-versa
            el.attr( "disabled", true );
            el.prop( "disabled", true );
        }
        return;
    }

    //Serve para atribuir o data-exclude A TODAS AS COLUNAS ESPECÍFICADAS NO DIC. DADOS de uma Instância QUADFORMS
    function setBulk_RGPD_on_Form (instanceId, rgpdContainer) {
        //Receives an Object convert it to Array (using entries, to access both NAME and VALUE)
        //EX: {NOME:true, DT_NASCIMENTO:false} -> [ [NOME, true], [DT_NASCIMENTO,false] ]
        if (typeof rgpdContainer === 'object') {
            var entries = Object.entries(rgpdContainer);
            for (var [key, val] of entries) {
                //console.log(key + ' - ' + val );
                setRGPD_Field_on_Form (instanceId, key, val);
            }
        }
        return;
    }
}

//RESOURCE to be COPIED and USED ON CONTEXT :: TEMPLATE
//Receives an Object convert it to Array (using entries, to access both NAME and VALUE)
//EX: {NOME: João Ratão, DT_NASCIMENTO: 2001-03-01} -> [ [NOME, João Ratão], [DT_NASCIMENTO, 2001-03-01] ]
function loopObject (obj) {
    var entries = Object.entries(obj);
    for (var [key, val] of entries) {
        console.log(key + ' - ' + val );
    }
}

/* CRUD + WORKFLOW :: ERROR*/
function go_no_go (error_code, user, profile, tables_to_check) {

    //Exit Interface with ERROR on ACCESS FILE DEFINITION doesn't EXIST or it's CONTENT is NOT JSON
    error_code = JSON.parse(error_code);

    if (error_code.length) {
        error_code = JS_REPORT_ERROR_CODE.replace( '{0}', ('0001-' + error_code[0] + '-' + user + '-' + profile).toUpperCase() );

        quad_notification('error', error_code);
/*
        $(".SmallBox").remove();
        $.smallBox({
            title: JS_WORKFLOW_ERROR.toUpperCase(),
            content: error_code,
            color: "#C79121", //RED: "#C46A69",
            iconSmall: "fa fa-times fa-2x fadeInRight animated",
            //timeout: 1500 -> Se isto estiver comentado tem de fazer “dismiss” no canto superior direito, senão demoraria 1.5 seg até desaparecer
        });
*/
        $('#left-panel > nav > ul > li.open.active > ul > li:nth-child(1) > a').trigger('click');
        return false;
    }
    return true;
}

/* CRUD + WORKFLOW :: ERROR*/
function valid_requirements (form_name, json_definitions, tables_array, user, profile) {

    //If any of the properties table not present on JSON definition -> EXITS Interface with ERROR
    var msg_error = '';
    for (var i = 0, len = tables_array.length; i < len; i++) {

        //CHECK WORKFLOW
        try {
            if ( !json_definitions[tables_array[i]].hasOwnProperty("workflow") ) {
                msg_error += '<li>' + tables_array[i]  + ' <sup>( WKF )</sup> </li>';
            } else {
                //Optei por não validar, por depender do componente que pode ainda vir a ser alterado.
                //Quando os componentes estiverem estaváveis a este nível poder-se-à acrescentar mais tarde.
            }
        } catch (e) {
            msg_error += '<li>' + tables_array[i] + ' <sup>( WKF-N/A )</sup> </li>';
        }
        //CHECK CRUD
        try {
            if (!json_definitions[tables_array[i]].hasOwnProperty("crud") ) {
                msg_error += '<li>' + tables_array[i]  + ' <sup>( CRUD )</sup> </li>';
            } else {
                //CHECK BOOLEANS
                if ( (typeof json_definitions[tables_array[i]]["crud"][0] !== "boolean") ||
                     (typeof json_definitions[tables_array[i]]["crud"][1] !== "boolean") ||
                     (typeof json_definitions[tables_array[i]]["crud"][2] !== "boolean")
                   ) {
                    msg_error += '<li>' + tables_array[i] + ' <sup>( CRUD-TYPE )</sup> </li>';
                }
            }
        } catch (e) {
            msg_error += '<li>' + tables_array[i] + ' <sup>( CRUD-N/A )</sup> </li>';
        }

        //CHECK ACESSO
        try {
            if (!json_definitions[tables_array[i]].hasOwnProperty("access") ) {
                msg_error += '<li>' + tables_array[i]  + ' <sup>( ACCESS )</sup> </li>';
            } else {
                //CHECK BOOLEAN
                if (typeof json_definitions[tables_array[i]]["access"] !== "boolean") {
                    msg_error += '<li>' + tables_array[i] + ' <sup>( ACCESS-TYPE )</sup> </li>';
                }
            }
        } catch (e) {
            msg_error += '<li>' + tables_array[i] + ' <sup>( ACCESS-TYPE-N/A )</sup> </li>';
        }
    }

    if (msg_error.length) {
        error_code = JS_NO_ACCESS + "<br>" + "<br>" + JS_REPORT_ERROR_CODE.replace( '{0}', ('0002-' + form_name + '-' + user + '-' + profile).toUpperCase() );

        quad_notification_clear();
        quad_notification({
            type: "error",
            title: JS_WORKFLOW_ERROR.toUpperCase(),
            content: '<ul>' + msg_error + '</ul>' + error_code,
        });

        $('#left-panel > nav > ul > li.open.active > ul > li:nth-child(1) > a').trigger('click');
        return false;
    }

    return true;
}

/* CRY */
function quadC (str) {
    //str = str + "codificação";
    return JSON.parse(str);
}

/* Given Birthdate return AGE */
function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

//https://stackoverflow.com/questions/21928083/iban-validation-check
// Se for necessário algo mais... implementar com  -> https://github.com/arhs/iban.js/blob/master/iban.js
function validateIBAN(iban) {
    var newIban = iban.toUpperCase(),
        modulo = function (divident, divisor) {
            var cDivident = '';
            var cRest = '';

            for (var i in divident ) {
                var cChar = divident[i];
                var cOperator = cRest + '' + cDivident + '' + cChar;

                if ( cOperator < parseInt(divisor) ) {
                        cDivident += '' + cChar;
                } else {
                        cRest = cOperator % divisor;
                        if ( cRest == 0 ) {
                            cRest = '';
                        }
                        cDivident = '';
                }

            }
            cRest += '' + cDivident;
            if (cRest == '') {
                cRest = 0;
            }
            return cRest;
        };

    if (newIban.search(/^[A-Z]{2}/gi) < 0) {
        return false;
    }

    newIban = newIban.substring(4) + newIban.substring(0, 4);

    newIban = newIban.replace(/[A-Z]/g, function (match) {
        return match.charCodeAt(0) - 55;
    });

    return parseInt(modulo(newIban, 97), 10) === 1;
}

// Validação do NIF Português
// https://gist.github.com/eresende/88562d2c4dc85b62cb0c
function validateNIF_PT(str) {
    let nif = str.toUpperCase();
    if (!/(PT)?([123568]\d{1}|45|7[0124579]|9[0189])(\d{7})/.test(nif)) {
        return false;
        //throw new Error('Invalid format');
    }

    nif = nif.replace(/PT/, ''); //remove the PT part
    function checkDigit () {
        c = 0;
        for (i = 0; i < nif.length - 1; ++i) {
            c += Number(nif[i]) * (10 - i - 1);
        }
        c = 11 - (c % 11);
        return c >= 10 ? 0 : c;
    };

    return checkDigit() === Number(str.charAt(str.length - 1));
}

// Validação do Cartão Cidadão Português
//https://gist.github.com/ReskatoR-FR/1bf8713f6a3f6e216b992339bb988984
function validateCC_PT(number) {
    letter_value = { A: 10, B: 11, C: 12, D: 13, E: 14, F: 15, G: 16, H: 17, I: 18, J: 19, K: 20, L: 21, M: 22, N: 23, O: 24, P: 25, Q: 26, R: 27, S: 28, T: 29, U: 30, V: 31, W: 32, X: 33, Y: 34, Z: 35};
    cc_number = number.replace(/-|\s/g, ''); // remove space and -
    cc_number = cc_number.toUpperCase();
    cc_number = [...cc_number];
    cc_number = cc_number.reverse();
    cc_number[1] = letter_value[cc_number[1]];
    cc_number[2] = letter_value[cc_number[2]];
    sum = 0;
    dum = 0;
    jQuery.each(cc_number, function(k, v) {
                if ( k % 2 == 0) {
                        dum = parseInt(v);
                }
                else {
                        dum = parseInt(v) * 2;
                        if (dum >= 10)
                                dum -= 9;
                }
                sum += dum;
                //console.log('k : '+ k + ' | sum : '+ sum);
    });

    return (sum % 10 == 0) ? true : false;
}

// Validação do NISS Português
function validateNISS_PT(number) {
    niss = number.replace(/-|\s/g, ''); // remove space and -
    niss = niss.toUpperCase();
    if (niss.length !== 11) {
        return false;
    } else {
        ctrlDigit = [29, 23, 19, 17, 13, 11, 7, 5, 3, 2];
        chkDigit = niss[10];
        c = 0;
        for (i = 0; i < niss.length - 1; ++i) {
            c += Number(niss[i]) * ctrlDigit[i];
        }
        c = 9 - (c % 10);
        return (c === Number(chkDigit));
    }
    return false;
}

// Validação do número de documento
function validaDocumento(tp_doc, pais, number) {
    if (tp_doc === 'A') {
        if (pais === 'PT' || pais === '') {
            return validateCC_PT(number);
        }
    }
    else if (tp_doc === 'B') {
        if (pais === 'PT' || pais === '') {
            return validateNIF_PT(number);
        }
    }
    else if (tp_doc === 'C') {
        if (pais === 'PT' || pais === '') {
            return validateNISS_PT(number);
        }
    }
    return true;
}

/* REMOVES ENTER + CR + TAB + BEGIN SPACES + END SPACES + "n" SPACES from STRING */
function cleanString(txt){
  return txt.replace(/[\n\r\t]/g,' ').trim().replace(/\s*$/,"").replace(/ +(?= )/g,'');
}

/* QUADTABLES Record History Prototype Display */
function tablesRecordHistory (val, type, row) {
    var txt = '';

    if (row['INSERTED_BY'] !== null || row['CHANGED_BY'] !== null) {
        if (row['INSERTED_BY'] !== null && row['CHANGED_BY'] === null) {
            txt = '<span class="timelogValue" title="' + JS_CREATED + '"><i class="fas fa-user-plus timelogIcon"></i> ' + row['INSERTED_BY'] + ' - ' + row['DT_INSERTED'] + '</span>';
        } else if (row['INSERTED_BY'] === null && row['CHANGED_BY'] !== null) {
            txt = '<span class="visible-xs visible-sm visible-md visible-lg timelogValue timelogChanged" title="' + JS_LAST_CHANGED + '">' +
                    '<i class="fas fa-user-edit timelogIcon"></i> '
                        + row['CHANGED_BY'] + ' em ' + row['DT_UPDATED']
                        + '</span>';
        } else {
            txt = '<span class="timelogValue" title="' + JS_CREATED + '"><i class="fas fa-user-plus timelogIcon"></i> ' + row['INSERTED_BY'] + ' - ' + row['DT_INSERTED'] + '</span>' +
                  '<span class="visible-xs visible-sm visible-md visible-lg timelogValue timelogChanged" title="' + JS_LAST_CHANGED + '">' +
                    '<i class="fas fa-user-edit timelogIcon"></i> '
                        + row['CHANGED_BY'] + ' em ' + row['DT_UPDATED']
                        + '</span>';
        }
    } else  {
        txt = '<span class="timelogValue">&nbsp;</span>';
    }
    return txt;
}

/* QUADTABLES Record History Prototype Display */
function workflowRecordHistory (row) {
     if ( row['DT_INSERTED'] !== null ) {
        ins_time = ellapseTime ( row['DT_INSERTED'] );
    }
    if ( row['DT_UPDATED']  !== null ) {
        upd_time = ellapseTime ( row['DT_UPDATED'] );
    }

    if (row['INSERTED_BY'] ) {
        txt = '<span class="timelogValue" title="' + JS_CREATED + '"><i class="fas fa-user-plus timelogIcon"></i> ' + row['INSERTED_BY'] + '</span> ';
        if (ins_time) {
            txt += '<span class="timelogValue" title="' + JS_ELAPSED_TIME + '"><i class="fas fa-history timelogIcon quad-left-padding-10"></i> ' + ins_time + '</span>';
        }
    }

    if (row['CHANGED_BY'] ) {
        txt += '<span class="visible-xs visible-sm visible-md visible-lg timelogValue timelogChanged" title="' + JS_LAST_CHANGED + '"><i class="fas fa-user-edit timelogIcon"></i> ' + row['CHANGED_BY'];
        if (upd_time) {
            txt += ' <span title="' + JS_ELAPSED_TIME + '"><i class="fas fa-history timelogIcon quad-left-padding-10"></i> ' + upd_time + '</span>';
        }
        txt +=  '</span> ';
    }
    return txt;
}

/* Transitions & Effects */
function slideMe (el, direction, duration) {
    if (!duration) {
        duration = 600;
    }
    if (!direction) {
        direction = 'Up';
    }
    if (el) {
        if (direction.toUpperCase() === 'DOWN') {
            $(el)
                .css({'display':'none'}, {'ocacity':'0'})
                .fadeTo(duration, 0.1)
                .slideDown({
                    "duration": duration,
                    "easing": 'swing',
                })
                .css('animation-timing-function','cubic-bezier(0, 0, 0.79, 0.99)')
                .fadeTo(duration, 1);
        } else {
            $(el)
                .fadeTo(duration/4, 0.5)
                .fadeTo(duration/2, 0.25)
                .fadeTo(duration/2, 0.1)
                .slideUp({
                    "duration": duration,
                    "easing": 'swing',
                })
                .fadeTo(duration/3, 0)
                .css('animation-timing-function','cubic-bezier(0, 0, 0.79, 0.99)');
        }
    }
}

/* END Transitions & Effects */

/* Recebendo um array devolve o maior elemento (numérico) ou o seu comprimento se tipo= 'length */
function maxFromArray (arr, tipo) {
    var max = null;
    for (var n = 0; n < arr.length; n++){
        if (n === 0) {
            max = arr[n];
        } else {
            if (arr > max ) {
                max = arr;
            }
        }
    }
    if (max !== null) {
        if ( tipo === 'length') {
            return String(max).length;
        }
    }
    return max;
}

/* Detect if STR is String (returns FALSE) or JSON format (returns TRUE) */
function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

/* Does the FILE or URL exist? Returns file '' if no returns last modified date of the file */
function fileExists(url, wch) {
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    if(http.status== 200){
        return http.getResponseHeader(wch);
    }
    return '';
}

/* Round a number to "n" decimals */
function round(value, decimals) {
    vlr = renderNumber( Number(Math.round(value+'e'+decimals)+'e-'+decimals), '', '.', decimals, '', '' );
    return vlr;
}

//Receives 2 number and calculates percentage with "decimals" precision:
function percentage (value_numerator, value__denominator, decimals) {
    if (typeof (value__denominator) === "object" && value__denominator === null) {
        null;
    } else {
        if (typeof (value_numerator) === "object" && value_numerator === null) {
            null;
        } else {
            try {
                return parseFloat( (parseFloat(value_numerator) / parseFloat(value__denominator)) * 100).toFixed(decimals);
            } catch (e) {
                null;
            }
        }
    }
    return '';
}

//Formata um JSON para ser renderizado num Gráfico do tipo Dygraph
//Ex: Date,A,B,C\n20070101,46;51;56,43;45;48,13;15;16\n20070102
function formatJson_to_Dygraphs (jsonData, legendArrayFull, legendArray, valuesArray) {
    var res = '';
    res = legendArrayFull.toString() + "\n";
    console.log( res );
    console.log( legendArray );
    var dias = getDistinct(jsonData, "DIA");
    console.log(dias);

    //'Date,A,B,C\n20070101, 46;51;56 , 43;45;48 , 13;15;16 \n20070102...'

    for ( var a = 0; a < dias.length; a++) { //DIAS
        res += '\n' + dias[a] + " alias " +String(dias[a]).replaceAll("-",""); //DIA
        for ( var b = 0; b <  legendArray.length; b++) { //EQUIPAS
            vlr = 0;
            skip = false;
            res += " Team " + legendArray[b] + " ";
            for ( var c = 0; c < jsonData.length; c++) {
                try {
                    res +=  " => " + obj[c][dias[a]] + " == " + dias[a] + " && " + obj[c][legendArray[b]] + " == " + legendArray[b];
                    /*
                    if ( obj[c][dias[a]] == dias[a] && obj[c][legendArray[b]] ==  legendArray[b]) {
                        res += ',' + String(obj[c]["TEMPO_PROD"] ? 0 : obj[c]["TEMPO_PROD"]) + ";" + String( obj[c]["TEMPO_LOSSES"] ? 0 : obj[c]["TEMPO_LOSSES"]);
                        skip = true;
                        break;
                    }
                    */
                } catch(err) {
                    //res += ',0;0';
                }
            }
        }
    }
    console.log(res);
}

//Return distinct values from array of Ojects[key] :: Used for Graph Labels
function getDistinct(obj, key) {
    var vals = [];

    if (typeof obj === 'object') {
        //console.log(obj);
        for ( var i = 0; i <  obj.length; i++) {
            vals.push( obj[i][key] );
        }
        //console.log(vals);
        //vals = [...new Set(vals.map(item => item))];
        function _toConsumableArray(arr) {
            if (Array.isArray(arr)) {
                for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) {
                    arr2[i] = arr[i];
                }
                return arr2;
            } else {
                return Array.from(arr);
            }
        }

        vals = [].concat(_toConsumableArray(new Set(vals.map(function (item) {
                return item;
        }))));

    }
    return vals;
}

//Return values from array of Ojects[key] :: Used for Graph Labels
function getValues(labels, labelName, serie, serieName, obj, retKey) {
    var valor = Array.from(serie), el = {}, skip = false, eval = '', vlr;
    valor.fill('');
    if (typeof obj === 'object') {
        for ( var a = 0; a < labels.length; a++) { //P.e: Motivos
            for ( var b = 0; b <  serie.length; b++) { //P. ex: Produção e Losses
                vlr = 0;
                skip = false;
                for ( var c = 0; c < obj.length; c++) { //Array de dados para emparelhamento
                    eval = labels[a] + " " + serie[b];
                    try {
                        if ( obj[c][labelName] == labels[a] && obj[c][serieName] ==  serie[b]) {
                            vlr = obj[c][retKey];
                            skip = true;
                            break;
                        }
                    } catch(err) {
                        vlr = 0;
                    }
                }

                if (valor[b] !== "") {
                    valor[b] = valor[b] + "," + vlr;
                } else {
                    valor[b] = vlr;
                }
                //console.log(labels[a] + " => " + serie[b] + " => " + vlr);
            }
        }
    }
    return valor;
}

//https://simonsmith.io/speeding-things-up-with-sessionstorage/
var storage = {
  storageAdaptor: sessionStorage,

  // Thanks Angus! - http://goo.gl/GtvsU
  toType: function(obj) {
    return ({}).toString.call(obj).match(/\s([a-z|A-Z]+)/)[1].toLowerCase();
  },

  getItem: function(key) {
    var item = this.storageAdaptor.getItem(key);

    try {
      item = JSON.parse(item);
    } catch (e) {}

    return item;
  },

  setItem: function(key, value) {
    var type = this.toType(value);

    if (/object|array/.test(type)) {
      value = JSON.stringify(value);
    }

    this.storageAdaptor.setItem(key, value);
  },

  removeItem: function(key) {
    this.storageAdaptor.removeItem(key);
  }
};

/* Retorna objecto com os últimos "X" dias (por defeito 30) a terminar no DIA passado como parâmetro (gráficos)
 * Se passei 2017-01-30, o resultado será o seguinte:
    {
        0: '2017-01-01 : ',
        1: '2017-01-02 : ',
        2: '2017-01-03 : ',
        ...
        29: '2017-01-30 : ',
    }
 * */
/* Lista os últimos nr_dias (30 por defeito) a partir de dia (por defeito now()) */
function lista_x_dias(dia, nr_dias, sufixo) {
    var data, str = '', months = {}, idx = 0;
    if (dia !== undefined || dia !== null) {
        data = new Date(dia);
    } else {
        data = new Date();
    }
    nr_dias = nr_dias || 30;

    if (sufixo === undefined || sufixo === null) {
        sufixo = '';
    }
    /* Reverse Order :: dia -> last position! */
    for (i=nr_dias-1; i >=0; --i) {
        data = new Date(data);
        //console.log(i + ") " + initCaps(month));

        if (i === (nr_dias-1)) {
            str = '"' +  i +'":"' + newData(data) + sufixo + '"}';
        } else {
            str = '"' + i +'":"' + newData(data) + sufixo + '",' + str;
        }
        //console.log(i + ") " + str);
        data.setDate( data.getDate()-1 );
    }

    str = '{' + str;
    //console.log("-------------------------------------");
    //console.log(dia + " ->" + nr_dias);
    //console.log(JSON.parse(str));
    //console.log("-------------------------------------");
    return JSON.parse(str);
    /*
    months: {
            0: 'Jan : ',
            1: 'Feb : ',
            2: 'Mar : ',
            3: 'Abr : ',
            4: 'Mai : ',
            5: 'Jun : ',
            6: 'Jul : ',
            7: 'Ago : ',
            8: 'Set : ',
            9: 'Out : ',
            10: 'Nov : ',
            11: 'Dez : ',
    }*/
}

/* Retorna objecto com os 12 meses a terminar no passado como parâmetro (gráficos)
 * Se passei Dez, o resultado será o seguinte:
    {
        0: 'Jan : ',
        1: 'Feb : ',
        2: 'Mar : ',
        3: 'Abr : ',
        4: 'Mai : ',
        5: 'Jun : ',
        6: 'Jul : ',
        7: 'Ago : ',
        8: 'Set : ',
        9: 'Out : ',
        10: 'Nov : ',
        11: 'Dez : ',
    }
 * */
function lista_12_Meses(lang, mes, sufixo) {
    var data, str = '', months = {}, idx = 0;
    if (mes !== undefined || mes !== null) {
        data = new Date(null,mes);
    } else {
        data = new Date();
    }

    if (lang === 'pt') {
        lang = 'pt';
    } else {
        lang ='en-US';
    }

    if (sufixo === undefined || sufixo === null) {
        sufixo = '';
    }
    /*
        for (i=1; i<13; i++) {

            data = new Date(data),
                        locale = lang, //"pt-PT" en-US OU pt, fr, ...
                        month = data.toLocaleString(locale, { month: "short" }); //long
            //console.log(i + ") " + initCaps(month));
            idx = i -1;

            if (i === 1) {
                str = '{"' + idx +'":"'+initCaps(month) + sufixo + '"';
            } else {
                str = str + ',"' + idx + '":"' + initCaps(month) + sufixo + '"';
            }
            //console.log(i + ") " + str);
            data.setMonth( data.getMonth()-1 );
        }
    */
    /* Reverse Order :: mes -> last position! */
    for (i=11; i >=0; --i) {

        data = new Date(data),
                    locale = lang, //"pt-PT" en-US OU pt, fr, ...
                    month = data.toLocaleString(locale, { month: "short" }); //long
        //console.log(i + ") " + initCaps(month));

        if (i === 11) {
            str = '"' +  i +'":"'+initCaps(month) + sufixo + '"}';
        } else {
            str = '"' + i +'":"'+initCaps(month) + sufixo + '",' + str;
        }
        //console.log(i + ") " + str);
        data.setMonth( data.getMonth()-1 );
    }

    str = '{' + str;
    //console.log(JSON.parse(str));
    return JSON.parse(str);
    /*
    months: {
            0: 'Jan : ',
            1: 'Feb : ',
            2: 'Mar : ',
            3: 'Abr : ',
            4: 'Mai : ',
            5: 'Jun : ',
            6: 'Jul : ',
            7: 'Ago : ',
            8: 'Set : ',
            9: 'Out : ',
            10: 'Nov : ',
            11: 'Dez : ',
    }*/
}

/* Format number */
function renderNumber( myNumber, thousands, decimal, precision, prefix, postfix ) {
    if ( typeof myNumber !== 'number' && typeof myNumber !== 'string' ) {
            return myNumber;
    }

    var negative = myNumber < 0 ? '-' : '';
    var flo = parseFloat( myNumber );
    var val;

    // If NaN then there isn't much formatting that we can do - just
    // return immediately, escaping any HTML (this was supposed to
    // be a number after all)
    if ( isNaN( flo ) ) {
            return ''; //__htmlEscapeEntities( myNumber );
    }

    myNumber = Math.abs( flo );

    var intPart = parseInt( myNumber, 10 );
    var floatPart = precision ?
            decimal+(myNumber - intPart).toFixed( precision ).substring( 2 ):
            '';

    val = negative + (prefix||'') +
            intPart.toString().replace(
                    /\B(?=(\d{3})+(?!\d))/g, thousands
            ) + floatPart + (postfix||'');
    return val.replace('..', '.');
};

/* Ellapse Time between to datetimes. If end is null it uses now() JS_VARIABLES :: PUBLIC/INCLUDES/quad_js_init.php */
function ellapseTime (start, end) {
    var endTime;
    if (!start) {
        alert('ellapseTime on QUAD_LIB: Please tell me where to get the begin date(time).');
    } else {
        start = Date.parse(start);

    }
    // ALL DATES -> NUMERIC format since  desde 1 de janeiro de 1970 00:00:00 UTC
    if (!end || end == 'undefined') {
        endTime = Date.now();
    } else {
         endTime = Date.parse(end);
    }

    var timeDiff = endTime - start, str=''; //in ms

    var seconds = parseInt(timeDiff/1000, 10);
    var days = Math.floor(seconds / (3600*24));
    seconds  -= days*3600*24;
    var hrs   = Math.floor(seconds / 3600);
    seconds  -= hrs*3600;
    var mnts = Math.floor(seconds / 60);
    seconds  -= mnts*60;
    //console.log(days+" days, "+hrs+" Hrs, "+mnts+" Minutes, "+seconds+" Seconds");
    if (days) {
        if (days === 1) {
           str += days  + " " + JS_DAY + " ";
        } else {
           str += days  + " " + JS_DAYS + " ";
        }
    }
    if (hrs) {
        if (!mnts && !seconds && str.length > 0) {
           str += " " + JS_AND + " "
        }
        if (mnts === 1) {
            str += hrs  + " " + JS_HOUR + " ";
        } else {
            str += hrs  + " " + JS_HOURS + " ";
        }
    }
    if (mnts) {
        if (!seconds && str.length > 0) {
           str += " " + JS_AND + " "
        }
        if (mnts === 1) {
            str += mnts  + " " + JS_MINUTE + " ";
        } else {
            str += mnts  + " " + JS_MINUTES + " ";
        }
    }
    if (seconds) {
        if (str.length > 0) {
           str += " " + JS_AND + " "
        }
        if (seconds === 1) {
            str += seconds  + " " + JS_SECOND + " ";
        } else {
            str += seconds  + " " + JS_SECONDS + " ";
        }
    }
    return (str);
}


/* Ellapse Time between to datetimes. If end is null it uses now(). Uses Short Labels for HOURS & MINUTES, IGNORES SECONDS!!!*/
function ellapseTimeAbreviated (start, end) {
    var endTime;
    if (!start) {
        alert('ellapseTime on QUAD_LIB: Please tell me where to get the begin date(time).');
    } else {
        start = Date.parse(start);

    }
    // ALL DATES -> NUMERIC format since  desde 1 de janeiro de 1970 00:00:00 UTC
    if (!end || end == 'undefined') {
        endTime = Date.now();
    } else {
         endTime = Date.parse(end);
    }

    var timeDiff = endTime - start, str=''; //in ms

    var seconds = parseInt(timeDiff/1000, 10);
    var days = Math.floor(seconds / (3600*24));
    seconds  -= days*3600*24;
    var hrs   = Math.floor(seconds / 3600);
    seconds  -= hrs*3600;
    var mnts = Math.floor(seconds / 60);
    seconds  -= mnts*60;
    //console.log(days+" days, "+hrs+" Hrs, "+mnts+" Minutes, "+seconds+" Seconds");
    if (days) {
        if (days === 1) {
           str += days  + " " + JS_DAY;
        } else {
           str += days  + " " + JS_DAYS;
        }
    }
    if (hrs) {
        if (!mnts && !seconds && str.length > 0) {
           str += " " + JS_AND + " ";
        }
        if (mnts === 1) {
            str += hrs  + " " + JS_HOUR_SHORT;
        } else {
            str += hrs  + " " + JS_HOURS_SHORT;
        }
    }
    if (mnts) {
        if (!seconds && str.length > 0) {
           str += " " + JS_AND + " "
        }
        if (mnts === 1) {
            str += mnts  + " " + JS_MINUTES_SHORT;
        } else {
            str += mnts  + " " + JS_MINUTES_SHORT;
        }
    }
    /*
    if (seconds) {
        if (str.length > 0) {
           str += " " + JS_AND + " "
        }
        if (seconds === 1) {
            str += seconds  + " " + JS_SECOND + " ";
        } else {
            str += seconds  + " " + JS_SECONDS + " ";
        }
    }
    */
    return (str);
}

//https://gist.github.com/mafigit/770cd4927a1dbc40b87a
/* Procedimento responsável pela captação das colunas no DOM a passar para os controladores */
$.fn.serializeAllArray = function () {
    var frm = this.selector ? this.selector : '#' + $(this).attr("id"); //this.context.id;
    //console.log( $(':input',this).toArray() );
    var serialize_array =
        $(':input',this).toArray().reduce(function (acc, input) {
            var form_attr = input.name;
            var form_value = $(input).val(), el = $(input);
            //Alterado por PMA: 2019.02.25
            //if ($(input).is(":checkbox") && !$(input).is(":checked")) {
            if ( el.is(":checkbox") ) {
                //Alterado por PMA: 2019.02.22
                //form_value = 0;

                //if ( $(input)[0]['checked'] ) {
                if ( el.prop("checked") || el.val() === 'S') {
                    form_value = 'S';
                } else {
                    form_value = 'N';
                }
                //console.log(form_attr + " " + form_value );
            }
            if ($(input).is(":radio")) {
                form_value = $("input[name='" + form_attr + "']:checked").val();
            }

            if (form_attr) {
                acc.push({
                    name: form_attr,
                    value: form_value
                });
            }
            return acc;
        }, []);
    return serialize_array;
}

/*Emulates disabled
function emulateDisabled(el, flag) {
    //$._data( $('.element')[0], 'events' );
    //return el;
    if (flag === undefined) {
        flag = 1;
    }
    if (flag) {
        console.log($._data(el[0], 'events'));
        console.log('emulateDisabled ON');
        return el.attr('readonly', 1).addClass('quadDisabled').off();
    } else {
        console.log('emulateDisabled OFF');
        return el.removeAttr('readonly').removeClass('quadDisabled').on();
    }
}
*/

function anoMesAberto(empresa_) {
    if (empresa_) {
        var frm = document.querySelector('#formid'), fdat = null;
        if (frm) {
            fdat = new FormData(frm);
        } else {
            fdat = new FormData();
        }
        fdat.append('request_id', 'PRS_MES_ABERTO');
        fdat.append('empresa', empresa_);
        return $.ajax({
            //url: "data-source/quad_lists_lib.php",
            url: datatable_instance_defaults.pathToListsFile,
            type: 'POST',
            dataType: "JSON",
            async: false, //Sem esta informação os interfaces não podem prosseguir!!
            data: fdat,
            processData: false,
            contentType: false,
        });
    }
    return '{}';
}

// VALID HOST
// ^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])$
// (/^(=|>|<|>|>=|<=|!=)[a-zA-Z0-9 '"][^IS|IN|NOT|LIKE|_|%]|(_|%|^BETWEEN\s|^LIKE\s|^IS NULL$|^IS NOT NULL$)/igm);
function matchQry(str) {
    var pat =  /^(=|>|<|>|>=|<=|!=|IS|IN|NOT|LIKE|_|%|_|%|BETWEEN\s|LIKE\s|IS NULL|IS NOT NULL$)/igm; //new RegExp (^(=|>|<|>|>=|<=|!=|IS|IN|NOT|LIKE|_|%|_|%|BETWEEN\s|LIKE\s|IS NULL|IS NOT NULL$)/igm);

    nStr = str.toUpperCase();
    var bExist = pat.test(nStr);
    return (bExist);
}

function matchMe(str, subst) {

    var str1 = '', str = '< 555',
            sbstr = '';
    var arr = str.split(' ');
    var arrayLength = arr.length;
    for (var i = 0; i < arrayLength; i++) {
        console.log("[" + arr[i] + "]");
        //Do something
    }
    var pattern = ['=', '>', '<', '<>', '<=', '>=', '!=', '%', 'LIKE', 'IS NULL', 'IS NOT NULL'];
    for (var i = 0; i < pattern.length; i++) {
        if (arr[0] === pattern[i])
            console.log(" MATCH [" + pattern[i] + "]");
        //Do something
    }
    str1 = arr[0].substr(0, str.indexOf(' '));

    str1 = str.substr(0, str.indexOf(' '));
    var m = 0, match;
    console.log("MATCH ME inputs: [" + str + "] Replace by [" + subst + "]");
}

//Returns JS language-COUNTRY applicable
function getLocal() {
// navigator.language     : Netscape & Firefox
// navigator.userLanguage : Internet Explorer
    var lang = navigator.language || navigator.userLanguage;
    return lang;
}

//Replace ALL ocorrences
String.prototype.replaceAll = function (search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};
String.prototype.escapeSelector = function () {
    var str= this.replace(
        /([$%&()*+,./:;<=>?@\[\\\]^\{|}~])/g,
        '\\$1'
    );
    return str.replace(/\s/g, '');
};
/* Formata uma data no formato YYYY-MM-DD */
function newData(dt) {
    var d = new Date(dt),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    //console.log(dt + ": " + [year, month, day].join('-'));
    return [year, month, day].join('-');
}

/* Returns TRUE if DATE is valid, FALSE otherwise */
function isValidDate (dt) {
    if ( Object.prototype.toString.call(dt) === "[object Date]" || Object.prototype.toString.call(dt) === "[object String]" ) {
        if ( isNaN( new Date(dt).getTime() ) ) {
            return false;
        } else {
            return true;
        }
    }
    return false;
}

/* Formata uma data no formato YYYY-MM-DD HH24:MI:SS*/
function newDataFull(dt) {
    var d = new Date (dt),
        dformat = [d.getFullYear(),
                   padFloat((d.getMonth()+1), 2),
                   padFloat(d.getDate(), 2) + ' ',
                   ].join('-') +' ' +
                  [padFloat(d.getHours(), 2),
                   padFloat(d.getMinutes(), 2),
                   padFloat(d.getSeconds(), 2)].join(':');
        return dformat;
}

/* Transforma números entre -.99 e .99 em -0.99 e 0.99 (Gráficos) */
function leadingZero (number) {
    var s = String(number);
    if (number < 0 && number > -1) {
        s = s.replace('-.', '-0.');
    } else if (number > 0 && number < 1) {
        s = s.replace('.', '0.');
    }
    /*OR
    if (number < 0 && number > -1) {
        s = s.replace('-,', '-0,');
    } else if (number > 0 && number < 1) {
        s = s.replace(',', '0,');
    } */
    //console.log(number + " " + " = " + s);
    return s;
}

function padFloat(number, size) {
    var s = String(number);
    while (s.length < (size || 2)) {
        s = "0" + s;
    }
    return s;
}

//Alows padding
//EX: pad(str, 2, 0, 1) + ":" + pad(minutes.toString(), 2, 0, 1);
// ALTERNATIVA:
//  String.prototype.lpad = function(padString, length)
//  var str = "5";
//  alert(str.lpad("0", 4)); //result "0005"
function pad(str, len, pad, dir) {
    var STR_PAD_LEFT = 1;
    var STR_PAD_RIGHT = 2;
    var STR_PAD_BOTH = 3;
    if (str === parseInt(str))
        str = str.toString();
//console.log("PAD " + str +","+ len+","+pad+","+dir +" + " + str.length);
    len = parseInt(len);
    if (typeof (len) == "undefined") {
        var len = 0;
    }
    if (typeof (pad) == "undefined") {
        var pad = ' ';
    }
    if (typeof (dir) == "undefined") {
        var dir = STR_PAD_RIGHT;
    }
//pad(str, len, pad, dir)
//console.log("len+1 (" + len + ") str.length (" + str.length+")");
    if (len + 1 >= str.length) {

        switch (dir) {

            case STR_PAD_LEFT:
                str = Array(len + 1 - str.length).join(pad) + str;
                break;
            case STR_PAD_BOTH:
                var right = Math.ceil((padlen = len - str.length) / 2);
                var left = padlen - right;
                str = Array(left + 1).join(pad) + str + Array(right + 1).join(pad);
                break;
            default:
                str = str + Array(len + 1 - str.length).join(pad);
                break;
        } // switch

    }
    return str;
}

function initCaps(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

/*Returns the property descriptor on object */
function showAcessorProps(obj, prop) {
    console.group("Acessors to " + prop);
    var d = Object.getOwnPropertyDescriptor(obj, prop);
    console.log(JSON.stringify(d, null, 4));
    console.groupEnd();
}

function print_object(o) {
    console.group("Object");
    var str = JSON.stringify(o, null, 4); // (Optional) beautiful indented output.
    root.console.log("%c" + str, 'color: darkred; font-weight:bold');
    console.groupEnd();
}

//Returns label for field (selector id) with ou without FOR label tag
function getLabelForID(selector) {
    var label = $('label[for="' + selector + '"]');
    if (label.length <= 0) {
        var parentElem = $(this).parent(),
                parentTagName = parentElem.get(0).tagName;
        if (parentTagName == "label") {
            label = parentElem;
        }
    }
    return label[0].innerHTML;
}

//Verifica se uma imagem (ou outro ficheiro) existe no servidor
function imageExists(image_url) {
    var http = new XMLHttpRequest();    // https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/Synchronous_and_Asynchronous_Requests
    http.open('HEAD', image_url, true); //false = Synchronous; true = Asyncchronous
    http.send();
    if (http.status != 404)
        return true;
    return false;
}

//Retorna o dia de hoje no formato: YYYY-MM-DD
function hoje(part) {
    var date = new Date();
    var year = date.getFullYear();
    var month = ("0" + (date.getMonth() + 1)).slice(-2);
    var day = ("0" + date.getDate()).slice(-2);
    var hours = ("0" + (date.getHours())).slice(-2);
    var minutes = ("0" + date.getMinutes()).slice(-2);
    var seconds = ("0" + (date.getSeconds())).slice(-2);
    if (part === 'year') {
        return year;
    } else if (part === 'month') {
        return month;
    } else if (part === 'day') {
        return day;
    }
    if (part === 'minutes') {
        return year + "-" + month + "-" + day + " " + hours + ":" + minutes;
    }
    if (part === 'seconds') {
        return year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;
    }
    if (!part) {
        return year + "-" + month + "-" + day;
    }
}

//Formata uma data num formato determinado (dentro dos Standard QUAD): YYYY-MM-DD
function formataData(dt, part) {
    if (dt) {
        var dia = new Date(dt);
        var year = dia.getFullYear();
        var month = ("0" + (dia.getMonth() + 1)).slice(-2);
        var day = ("0" + dia.getDate()).slice(-2);
        var hours = ("0" + (dia.getHours())).slice(-2);
        var minutes = ("0" + dia.getMinutes()).slice(-2);
        var seconds = ("0" + (dia.getSeconds())).slice(-2);

        //Just SCLICED parts
        if (part === 'year') {
            return year;
        } else if (part === 'month') {
            return month;
        } else if (part === 'day') {
            return day;
        }
        if (part === 'minutes') {
            return year + "-" + month + "-" + day + " " + hours + ":" + minutes;
        }
        if (part === 'seconds') {
            return year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;
        }
        if (!part) {
            return year + "-" + month + "-" + day;
        }
        //Composed parts
        if (part === 'y-m') {
            return year + '-' + month;
        }

        if (part === 'y-m-d') {
            return year + '-' + month + '-' + day;
        }
        if (part === 'y-m-d hh:mi' || part === 'y-m-d hh24:mi') {
            return year + '-' + month + '-' + day + '- ' + hours + ':' + minutes;
        }
        if (part === 'y-m-d hh:mi:ss' || part === 'y-m-d hh24:mi:ss') {
            return year + '-' + month + '-' + day + '- ' + hours + ':' + minutes + ':' + seconds;
        }

    }
    return dt;
}

//Formata uma data devolvendo-a no formato ajustado ao seu conteúdo (dentro dos Standard QUAD): YYYY-MM-DD [HH24:MI[:SS]]
function autoFormatDate(dt) {

    if (dt) {
        var dia = new Date(dt);
        var year = dia.getFullYear();
        var month = ("0" + (dia.getMonth() + 1)).slice(-2);
        var day = ("0" + dia.getDate()).slice(-2);
        var hours = ("0" + (dia.getHours())).slice(-2);
        var minutes = ("0" + dia.getMinutes()).slice(-2);
        var seconds = ("0" + (dia.getSeconds())).slice(-2);
        var sec = true, min = true, hor = true;
        var data_result = '';
        if (seconds === "00") {
            sec = false;
        }
        if (minutes === "00") {
            min = false;
        }
        if (hours === "00") {
            hor = false; //false;
        }
        data_result = year + "-" + month + "-" + day;
        if (sec) {
            data_result = data_result + ' ' + hours + ":" + minutes;
        } else if (!sec && ( min || hor) ) {
            data_result = data_result + ' ' + hours + ":" + minutes + ":" + seconds;
        }
        return data_result;
    }
    return dt;
}

//Formata uma data devolvendo-a no formato ajustado ao seu conteúdo (dentro dos Standard QUAD): YYYY-MM-DD]
function formatDate(dt, mask) {

    if (dt) {
        var dia = new Date(dt);
        var year = dia.getFullYear();
        var month = ("0" + (dia.getMonth() + 1)).slice(-2);
        var day = ("0" + dia.getDate()).slice(-2);
        var hours = ("0" + (dia.getHours())).slice(-2);
        var minutes = ("0" + dia.getMinutes()).slice(-2);
        var seconds = ("0" + (dia.getSeconds())).slice(-2);
        var sec = true, min = true, hor = true;
        var data_result = '';
        if (seconds === "00") {
            sec = false;
        }
        if (minutes === "00") {
            min = false;
        }
        if (hours === "00") {
            hor = false; //false;
        }
        data_result = year + "-" + month + "-" + day;
        if (sec) {
            data_result = data_result + ' ' + hours + ":" + minutes;
        } else if (!sec && ( min || hor) ) {
            data_result = data_result + ' ' + hours + ":" + minutes + ":" + seconds;
        }

        if (mask === 'YYYY-MM-DD') {
            data_result = year + "-" + month + "-" + day;
        }
        return data_result;
    }
    return dt;
}

//Soma minutos a uma data devolvendo uma nova data hora
var add_minutes =  function (dt, minutes, parte) {
    if (dt) {
        var dia = new Date(dt);
        //console.log(add_minutes(new Date(2014,10,2), 30).toString());
        return formataData (new Date(dia.getTime() + minutes*60000), parte);
    }
    return '';
}

//Formata hora em formato simplificado recorrendo a (:,.) ou em minutos, devolvendo
//array com o formato HH24:MI e o correspondente nr. de minutos
function QuadTimeToMinutes(tempo) {
    var ret = [];
    var hourVal = null;
    var minVal = null;

    var tmp = tempo.toString().replaceAll('.', ':').replaceAll(',', ':');

    var arr = tmp.split(":");
    var cnt = arr.length - 1;
    var vlr = '00:00';
    var err = false;
    if (!tempo) {
        return vlr;
    }
    for (var i = 0; i < arr.length; i++) {

        if (cnt === 0) { //Não há separadores :: INPUT em minutos
            var hours = Math.floor(arr[0] / 60);
            var minutes = arr[0] % 60;

            if (hours !== parseInt(hours) && minutes !== parseInt(minutes)) {
                ret[0] = "00:00";
                ret[1] = 0;
                err = true;
            } else {
                ret[0] = pad(hours.toString(), 2, 0, 1) + ":" + pad(minutes.toString(), 2, 0, 1);
                ret[1] = tempo;
            }
        } else if (cnt >= 1) { //Há 1 separador :: INPUT no formato HH:MI
            var hours = Math.floor(arr[0]);
            var minutes = arr[1];
            if (hours !== parseInt(hours) && minutes !== parseInt(minutes)) {
                ret[0] = "00:00";
                ret[1] = 0;
                err = true;
            } else {
                ret[0] = pad(hours.toString(), 2, 0, 1) + ":" + pad(minutes.toString(), 2, 0, 2);
                ret[1] = (parseInt(hours) * 60) + parseInt(pad(minutes.toString(), 2, 0, 2));
            }
            break;
        }

    }

// PTE: 201.05.04: retirado por limitar o registo das timesheets
//    if (ret[1] >= 1440) { //Limite a 1 dia
//        ret[0] = "24:00";
//        ret[1] = 1440;
//    }
    if (!err)
        return ret;
    else
        return err;
    //console.log("RESULT: " + ret[0] + " vs " + ret[1]);
}

/* Radio buttons manager
 HTML example:
 <form name="radioExampleForm" method="get" action="" onsubmit="return false;">
 ...
 <input type="radio" value="0" name="number" id="number0">
 ...
 <input type="radio" value="1" name="number" id="number1">
 ...
 <input type="radio" value="2" name="number" id="number2">
 ...
 <input type="radio" value="3" name="number" id="number3">
 ...
 <input type="radio" value="4" name="number" id="number4">
 ...
 </form>
 JS (button) CALLS:
 <input type="button" onclick="alert('Checked value is: ' + quadRadio.getCheckedValue(document.forms['radioExampleForm'].elements['number']));" value="Show Checked Value">
 <input type="button" onclick="setCheckedValue(document.forms['radioExampleForm'].elements['number'], '2');" value="Set Checked to Two">
 <input type="button" onclick="setCheckedValue(document.forms['radioExampleForm'].elements['number'], '4');" value="Set Checked to Four">
 <input type="button" onclick="setCheckedValue(document.forms['radioExampleForm'].elements['number'], '');" value="Uncheck All">
 ... OR ....
 alert( getCheckedValue(frm.find('[name=scope]')) + " EQUAL TO " + frm.find('.radiobox[name=scope]:checked').val() );
 setCheckedValue(frm.find('[name=scope]'), 'both');
 alert( getCheckedValue(frm.find('[name=scope]')) + " EQUAL TO " + frm.find('.radiobox[name=scope]:checked').val() );
 */

// Return the value of the radio button that is checked
// return an empty string if none are checked, or
// there are no radio buttons
function getCheckedValue(radioObj) {
    if (!radioObj)
        return "";
    var radioLength = radioObj.length;
    if (radioLength === undefined)
        if (radioObj.checked)
            return radioObj.value;
        else
            return "";
    for (var i = 0; i < radioLength; i++) {
        if (radioObj[i].checked) {
            return radioObj[i].value;
        }
    }
    return "";
}

// Set the radio button with the given value as being checked
// do nothing if there are no radio buttons
// if the given value does not exist, all the radio buttons
// are reset to unchecked
function setCheckedValue(radioObj, newValue) {
    if (!radioObj)
        return;
    var radioLength = radioObj.length;
    if (radioLength === undefined) {
        radioObj.checked = (radioObj.value == newValue.toString());
        return;
    }
    for (var i = 0; i < radioLength; i++) {
        radioObj[i].checked = false;
        if (radioObj[i].value == newValue.toString()) {
            radioObj[i].checked = true;
        }
    }
}

//Get GPS Coordinates where the APP is beeing runned
function getGPSCoordinates() {

    var options = {
      enableHighAccuracy: true,
      timeout: 5000,
      maximumAge: 0
    };

    function success(pos) {
      var crd = pos.coords;

      console.log('Your current position is:');
      console.log('Latitude : ${crd.latitude}');
      console.log('Longitude: ${crd.longitude}');
      console.log('More or less ${crd.accuracy} meters.');
    }

    function error(err) {
        console.log(err);
      //console.warn('ERROR(${err.code}): ${err.message}');
    }

    navigator.geolocation.getCurrentPosition(success, error, options);

    //ALTERNATIVE
    //navigator.geolocation.getCurrentPosition(function (position) {
    //    console.log('Lat: ' + position.coords.latitude + ' ' +
    //            'Lon: ' + position.coords.longitude);
    //});
}

/* Removes path from filename, returning JUST the name of the file */
function removePath(filename) {
    var pos = filename.lastIndexOf("/");
    return filename.substr(pos+1);
}

// Detect the browser in use
var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{
			string: navigator.userAgent,
			subString: "Chrome",
			identity: "Chrome"
		},
		{ 	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari",
			versionSearch: "Version"
		},
		{
			prop: window.opera,
			identity: "Opera",
			versionSearch: "Version"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			   string: navigator.userAgent,
			   subString: "iPhone",
			   identity: "iPhone/iPod"
	    },
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

};
BrowserDetect.init();

// Open URL in separate window
function showDoc(URL, titulo){
  if (BrowserDetect.browser == 'Chrome') {
	newwindow = window.open(URL, "_blank", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=no, width=700, height=500, top=10, left=10");
  } else {
	page =	"<html><head><title>"+titulo+"</title></head>"
		+"<frameset rows='100%,*'><frame src='"+URL+"'></frame>"
		+"</frameset></html>";
	var popUp = window.open("javascript:opener.page","");
	if (popUp == null || typeof(popUp)=='undefined') {
		  alert('Please disable popup blocker.');
	}
  }
}

function logout(url_) {
    setTimeout(function (){
        try {
            quad_sse.close();
            console.log( "Connection to server closed!");
        } catch(e) {
            console.log( 'SSE: ' + e );
        }
    }, 10);
    window.location = url_;

}

// Evento que implementa as ações associadas ao menu do canto superior direito da app.
myapp_config.root_.on("click touchend", "[data-action]", function (e) {
    var o = $(this).data("action");
    switch (!0) {
        // Event to change password
        case "change-password" === o:
            console.log("CHANGE PASSWORD");
            return;
        case "logout" === o:
            var url_ = $(this).data('href');
            console.log("LOGOUT",url_);
            // ask verification
            bootbox.confirm({
                title: "<i class='fa fa-sign-out txt-color-orangeDark'></i> " + JS_LOGOUT + " <span class='txt-color-orangeDark'><strong>" + $('.nome_user').text() + "</strong></span> ?",
                message: $(this).data('logout-msg'),
                centerVertical: !0,
                swapButtonOrder: !0,
                buttons: { confirm: {
                                label: JS_YES,
                                className: "btn-danger shadow-0"
                           },
                           cancel: {
                               label: JS_NO,
                               className: "btn-default" }
                },
                className: "modal-alert",
                closeButton: !1,
                callback: function (t) {
                    if (t) {
                        $.root_.addClass('animated fadeOutUp');
                        setTimeout(logout(url_), 100);
                    } else {
                        // para esconder o menu
                        $("#app_user_menu").trigger("click");
                    }
                }
            })
            return;

        // Event to change language
        case "lang" === o:
            lang_ = $(this).attr("data-lang");

            /* lang_db defined on quad_js_init.php */
            if (lang_db && lang_db !== lang_) {

                // ask verification
                bootbox.confirm({
                    title: "<i class='fa fa-sign-out txt-color-orangeDark'></i> " + JS_SAVE_NEW_LANG + "<span class='txt-color-orangeDark'></span>",
                    message: JS_HINT_PREFERENCE,
                    centerVertical: !0,
                    swapButtonOrder: !0,
                    buttons: { confirm: {
                                    label: JS_YES,
                                    className: "btn-danger shadow-0"
                               },
                               cancel: {
                                   label: JS_NO,
                                   className: "btn-default" }
                    },
                    className: "modal-alert",
                    closeButton: !1,
                    callback: function (t) {
                        var gravar = 'N'; //Nao gravar
                        if (t) {
                            gravar = 'S'; //Gravar
                        }

                        $.ajax({
                            url: pn + "data-source/quad_controller_muda_lang.php",
                            data: {
                                lang: lang_,
                                save: gravar
                            },
                            success: function (msg) {
                                if (msg == '')
                                    location.reload();
                                else
                                    alert(msg);
                            }
                        });
                    }
                })
                e.preventDefault();

            }
            else {
                $.ajax({
                    url: pn + "data-source/quad_controller_muda_lang.php",
                    data: {
                            lang: lang_,
                            save: 'N'
                        },
                    success: function (msg) {
                        if (msg == '')
                            location.reload();
                        else
                            alert(msg);
                    }
                });
            }

            return;
        // Event to change profile
        case "profile_change" === o:
            var value_ = $(this).find("a").attr("value");
console.log("novo perfil",value_);
            if (value_ != '') {
                $.ajax({
                    url: "data-source/quad_controller_muda_perfil.php",
                    data: {
                        perfil: value_,
                    },
                    async: false,
                    success: function (JS_PERFIL) {
//                        window.location.reload(true);
                        if (JS_PERFIL == 'A') {
                            window.location.hash="#ajax/gd_rhid_document_management.php";
                        } else if (JS_PERFIL == 'B') {
                            window.location.hash="#ajax/dashboard.php";
                        } else if (JS_PERFIL == 'C') {
                            window.location.hash="#ajax/dashboard.php";
                        } else if (JS_PERFIL == 'D') {
                            window.location.hash="#ajax/dashboard.php";
                        } else if (JS_PERFIL == 'E') {
                            window.location.hash="#ajax/dashboard_gestor.php";
                        } else if (JS_PERFIL == 'F') {
                            window.location.hash="#ajax/dashboard_gestor.php";
                        } else if (JS_PERFIL == 'H') {
                            window.location.hash="#ajax/dk_coefficients.php";
                        } else if (JS_PERFIL == 'I') {
                            window.location.hash="#ajax/dk_coefficients.php";
                        } else if (JS_PERFIL == 'J') {
                            window.location.hash="#ajax/dk_coefficients.php";
                        } else if (JS_PERFIL == 'Z') {
                            window.location.hash="#ajax/dashboard_gestor.php";
                        }
        //                if (msg == '') {
        //                } else {
        //                    alert(msg);
        //                }
                    }
                });
            }

            return;
    }
});

// Evento para mudar o perfil
$(document).on('change', '#profile_change', function (e) {
    e.preventDefault();
    var value_ = $(this).val();

    if (value_ != '') {
        $.ajax({
            url: pn + "data-source/quad_controller_muda_perfil.php",
            data: {
                perfil: value_,
            },
            async: false,
            success: function (JS_PERFIL) {
                // colocar num ficheiro de controlo
                if (JS_PERFIL == 'A') {
                    window.location.hash="#ajax/gd_rhid_document_management.php";
                } else if (JS_PERFIL == 'B') {
                    window.location.hash="#ajax/dashboard.php";
                } else if (JS_PERFIL == 'C') {
                    window.location.hash="#ajax/dashboard.php";
                } else if (JS_PERFIL == 'D') {
                    window.location.hash="#ajax/dashboard.php";
                } else if (JS_PERFIL == 'E') {
                    window.location.hash="#ajax/dashboard_gestor.php";
                } else if (JS_PERFIL == 'F') {
                    window.location.hash="#ajax/dashboard_gestor.php";
                } else if (JS_PERFIL == 'H') {
                    window.location.hash="#ajax/dk_coefficients.php";
                } else if (JS_PERFIL == 'I') {
                    window.location.hash="#ajax/dk_coefficients.php";
                } else if (JS_PERFIL == 'J') {
                    window.location.hash="#ajax/dk_coefficients.php";
                } else if (JS_PERFIL == 'Z') {
                    window.location.hash="#ajax/dashboard_gestor.php";
                }
window.location.reload(true);
//                if (msg == '') {
//                } else {
//                    alert(msg);
//                }
            }
        });
    }
});

// Converte os parâmetros de um URL para um json a passar para o QuadTables
function QueryStringToJSON() {
    var pairs = location.hash.substr(location.hash.lastIndexOf("?")+1).split('&');
    var result = [];
    pairs.forEach(function(pair) {
        pair = pair.split('=');
        result.push( {'name':pair[0],'value': decodeURIComponent(pair[1] || '')} );
    });
    return JSON.parse(JSON.stringify(result));
}

// Deteta se um URL tem parâmetros
function detectQueryString() {
    // get the current URL
    var currentUrl = window.location.href;
    // regex pattern for detecting ? character
    var pattern = new RegExp(/\?+/g);
    return pattern.test(currentUrl);
}

// Chama o interface passando parâmetros, abrindo a árvore de navegação até ao interface
function callInterface(interfaceName,strParams) {
/*
*/
    var interface = "ajax/"+interfaceName, href_, title_;

  //var el = $("#left-panel > nav > ul li > a[href='ajax/ad_employee_evaluation_sheet.php?key=DEMO@8@2018-01-01@2@2018-12-01@1@2008-02-04@6@3@2010-01-01@1900-01-01@1900-01-01']").parentsUntil("em.fa-plus-square").parent("li:not('.open')");
    var el = $("#left-panel > nav > ul li > a[href='"+interface+"']").parentsUntil("em.fa-plus-square").closest("li:not('.open')");

    // ciclo que percorre desde o nó "root" do interface, abrindo os nós até chegar ao interface
    el.find("a").each(function(){
        title_ = $(this).attr("title");
        href_ = $(this).attr("href");
//console.log(title_+" "+href_);

        // cheguei ao interface
        if (href_ === interface) {

            var lnk = $(this);
            var ref_orig = lnk.attr("href");

            // se o interface chamado tem parâmetros, terá que adicionar os parâmetros só nesta chamada
            if (interface.replace("?","").length < interface.length) {
                lnk.attr("href",ref_orig+"&"+strParams);
            } else {
                lnk.attr("href",ref_orig+"?"+strParams);
            }
            lnk.trigger("click");

            setTimeout( function() {
                lnk.attr("href",ref_orig);
            },10);

            return false;
        } else {
            $(this).trigger('click');
        }
    });


}

// Recebe uma instância QuadTable (instance) e uma where clase (new_where), inicializando-a na instância
// Cabe ao programador despoletar o evento de DB call dessa instância
// Util em filros autónomos das instâncias onde o resultado da instância seja consultado em (p.ex:) em tab separado dos filtros
// FILTER VERSION ::
//function refreshQuadTable (instance, new_where) {
//
//    if ($.fn.DataTable.isDataTable('#' + instance.tableId) ) {
//        //instance.tbl.destroy();
//        $('.' + instance.tableId + '_spinner').show('slow');
//        instance.initialWhereClause = new_where;
//
//        instance.tbl.clear();
//        instance.clearTable();
//        instance.tbl.columns().search().draw();
//        $('.' + instance.tableId + '_spinner').hide('slow')
//    } else {
//        instance.initialWhereClause = new_where;
//    }
//    return true;
//}
//
// EXEMPLOS:
//
//      --> DEFAULT VIEW
//      if (vista === 'A') {
//          FilterwhereClause_ = initialWhere_;
//          //refreshQuadTable(DK_VALORES_INDICADOR, false);
//          refreshQuadTable(DK_VALORES_INDICADOR, false);
//      }
//      --> OTHER VIEWS:::
//      if (vista === 'V') {
//        refreshQuadTable(DK_VALORES_INDICADOR,
//            [  {'name': 'QTD', 'value': 'IS NOT NULL'},
//               {'name': 'MONTANTE', 'value': 'IS NOT NULL'}
//            ], {
//                show: ['QTD','MONTANTE'],
//                hide: ['OBJ_MIN', 'OBJ_MAX']
//            }
//        );
//      }
//      if (vista === 'O') {
//            refreshQuadTable(DK_VALORES_INDICADOR,
//                [  {'name': 'OBJ_MIN', 'value': 'IS NOT NULL'},
//                   {'name': 'OBJ_MAX', 'value': 'IS NOT NULL'},
//                ], {
//                    show: ['OBJ_MIN', 'OBJ_MAX'],
//                    hide: ['QTD','MONTANTE']
//                }
//            );
//      }
//
//      ---------------------------------------------------------
//      MORE COMPLEX ALTERNATIVES:
//      ---------------------------------------------------------
//          ************************
//          With GROUP of COLUMNS:
//          {"name": "", "value": "(CD_ESTAB,ID_SETOR) IN (('002','001'),('002','150'),('005','002'))) ","overrideName":true}
//          ************************
//          FREE STYLE :: using OR
//          {"name": "", "value": "(CD_ESTAB,ID_SETOR) IN (('002','001'),('002','150'),('005','002')) OR (CD_DIRECAO,CD_DEPT) IN (('A','001'),('B','150'),('B','002')) ","overrideName":true}
//          ************************
//      ---------------------------------------------------------

function refreshQuadTable(instance, new_where, fields, tab) {
  instance.where_str = "";
  if ($.fn.DataTable.isDataTable("#" + instance.tableId)) {
    $("." + instance.tableId + "_spinner").show("slow");

    //console.log('PREV: ' + instance.initialWhereClause);
    instance.resetData();
    instance.where_str = "";
    instance["sFilters"] = [];
    instance["qFilters"] = {};
    instance["sFilters"] = instance.getFiltersFormsData();
    _.remove(instance["sFilters"], { value: "" });
    _.remove(instance["sFilters"], { value: null });

    if (instance["sFilters"]) {
      _.forEach(instance["sFilters"], function(o, i) {
        fieldValue = o.value;
        if (fieldValue) {
          if (!instance["sortInfo"]) {
            var ob = _.find(instance.tableCols, { name: o.name });
            if (ob) {
              if (ob["complexList"]) {
                var keys = ob["attr"]["data-db-name"]
                  .replace(quadConfig.regExpressions.alias, "")
                  .split("@");
                var f = _.find(instance["sFilters"], { name: o.name });
                var value = f.value.split("@");
                _.map(keys, function(field, j) {
                  instance.buildWhereClause(
                    _.findIndex(instance.dbColumns, { db: field }),
                    value[j],
                    "query"
                  );
                });
              } else {
                instance.buildWhereClause(
                  _.findIndex(instance.dbColumns, { db: o.name }),
                  fieldValue,
                  "query"
                );
              }
            }
          } else {
            instance.buildWhereClause(o.name, o.text, "query", true);
          }
        }
      });
    }

    if (new_where) {
      instance["sFilters"] = instance.getFiltersFormsData();
      _.remove(instance["sFilters"], { value: "" });
      _.remove(instance["sFilters"], { value: null });
      instance.sFilters = _.union(instance.sFilters, new_where);

      _.forEach(new_where, function(o, i) {
        if (o.overrideName) {
          instance["qFilters"][" "] = o.value;
        } else {
          var i = _.findIndex(instance.dbColumns, { db: o.name });
          instance.buildWhereClause(i, o.value, true, instance.sortInfo);
        }
      });
    }

    instance.where_str = instance.finalWhereClause();
    instance.tbl.clear();
    instance.clearTable();

    function searchTbl(instance, new_where, fields) {
      return $.Deferred(function() {
        var self = this;
        instance.tbl
          .columns()
          .search()
          .draw();
        self.resolve();
      });
    }

    $.when(searchTbl(instance, new_where, fields)).then(function() {
      if (fields) {
        _.forEach(fields.hide, function(name, i) {
          var col = _.find(instance.tbl.settings()[0].aoColumns, {
            data: name
          });
          var column = instance.tbl.column(col.idx);
          column.visible(false);
        });

        _.forEach(fields.show, function(name, i) {
          var col = _.find(instance.tbl.settings()[0].aoColumns, {
            data: name
          });
          var column = instance.tbl.column(col.idx);
          column.visible(true);
        });
      }
      if (!new_where && !fields) {
        var visibleCols = _.filter(instance.tableCols, function(o, i) {
          if (o.visible !== false && o.data) {
            return o.data;
          }
        });
        _.forEach(visibleCols, function(o, i) {
          var col = _.find(instance.tbl.settings()[0].aoColumns, {
            data: o.name
          });
          var column = instance.tbl.column(col.idx);
          if (
            instance.externalFilter &&
            instance.externalFilter.mandatory &&
            $.inArray(o.name, instance.externalFilter.mandatory) != -1
          ) {
            null;
          } else {
            column.visible(true);
          }
        });
      }
      $("." + instance.tableId + "_spinner").hide("slow");
    });
  } else {
    if (new_where) {
      instance["qFilters"] = {};
      instance["sFilters"] = [];
      instance["sFilters"] = instance.getFiltersFormsData();
      _.remove(instance["sFilters"], { value: "" });
      _.remove(instance["sFilters"], { value: null });
      instance.sFilters = _.union(instance.sFilters, new_where);
      _.forEach(new_where, function(o, i) {
        if (o.overrideName) {
          instance["qFilters"][" "] = o.value;
        } else {
          var i = _.findIndex(instance.dbColumns, { db: o.name });
          instance.buildWhereClause(i, o.value, true, instance.sortInfo);
        }

        instance.where_str = instance.finalWhereClause();
      });
    }
  }
  $(tab).attr("data-toggle", "tab");
  $(tab).tab("show");
  return true;
}

// Função que cria um filtro para seleção de  Colaboradores (QUAD_PEOPLE)
// retorno deverá estar associado a um trigger com a classe .returnResults
//
// title: título da Janela (p.defeito não é colocado título)
// url_filter: controlador utilizador pelo filtro (por defeito: ajax/dg_filtros.php
// visibleColumns: Array com as colunas QUAD_PEOPLE visíveis na instância QUAD_TABLES(por defeito terá sempre o NOME)
// width: largura da modal (poderá ter ser ajustada dependendo das colunas do parãmetro anterior)
function filterQUAD_HCM(title,url_filter,visibleColumns, width) {
    var tar, htm;

    // tútlo da janela
    if (title === '') {
        title = JS_QUADHCM_FILTER_TITLE;
    }

    // controlador por defeito dos filtros
    if (url_filter === '') {
        url_filter = "ajax/dg_filtros.php";
    }

    htm = '<div class="modal fade" id="FiltroQUADPEOPLE" role="dialog">'+
          ' <div class="modal-dialog">'+
          '  <div class="modal-content">'+
          '  <div class="modal-header">'+
         '       <button type="button" class="close" data-dismiss="modal">&times;</button>';
     if (title) {
        htm += '       <h4 class="modal-title"><i class="fal fa-id-card"></i>  '+title+'</h4>';
     }
     htm += '   </div>'+
         '   <div class="modal-body" style="overflow-x: hidden;">'+
         '   </div>'+
        '    <div class="modal-footer">'+
        '        <button type="button" class="btn btn-default" data-dismiss="modal">' + JS_CLOSE + '</button>'+
        '        <button type="button" class="btn btn-default" data-dismiss="modal" id="returnModalQUAD_HCM">' + JS_QUAD_HCM_FILTER_SELECT + '</button>'+
        '    </div>'+
        '</div>'+
        '</div>'+
        '</div>';

    if  (!$("#FiltroQUADPEOPLE").length) {
        $("#content").after(htm);
        try {
            $('#FiltroQUADPEOPLE > div.modal-dialog').css('width', width);
        } catch (e) {
            null;
        }
    }
    setTimeout(function(){
        $('#FiltroQUADPEOPLE > div > div > div.modal-body').load(url_filter,{ showColumns: visibleColumns } ,function(){
            $("#returnModalQUAD_HCM").hide();
            $('#FiltroQUADPEOPLE').modal({show:true});
        });
    },200);
}

// Atualiza uma coluna (valor e etiqueta) de uma instância
function changeQuadtableColumn(instance_,column_name_, index_, label_, value_) {
    var newStatusDsp = '', newStatusVal = '',
        el = instance_.tbl.rows('.selected'),
        masterRecord, masterKey;
    try {
        newStatusDsp = label_;
        newStatusVal = value_;

        masterRecord = instance_.selectedRowData();
        masterKey = instance_.composeId(instance_.pk.primary, masterRecord);

        // ----------------------------------------------------------------------------------------------------
        // ATENÇÃO: rhid_gestao_documental.tbl.data() :: Devolve TODAS as ROWS do MASTER e respetivos métodos
        // ----------------------------------------------------------------------------------------------------
        //Atualizamos a FASE no registo MASTER respetivo no DOM
        $('table#' + instance_['tableId'] + ' > tbody > tr#' + masterKey + ' > td:nth-child(' + index_ + ')').html(newStatusDsp);

        //Aqui só ajustamos a tabela master de acordo com o novo conteúdo
        $('#' + instance_['tableId']).DataTable().columns.adjust().responsive.recalc();

        //Atualizamos o valor da coluna de dados FASE, na MEMÓRIA, de modo a que a EDIÇÃO reflita o novo valor,
        //sem necessidade de refrescarmos TODO o registo MASTER comm mais uma roundtrip à base de dados.
        instance_.selectedRowData()[column_name_] = newStatusVal;
        // se a coluna for uma função, sai com erro mas garantiu-se a atualização do DOM (label).
    } catch (e) {
        null;
    }
}

//Searches if a given ARRAY of objects, has any "property" with "value". Returns object is exists...
function isReferenceValueOnObject (arrayOfObjects, property, value) {
    var BreakException = {};
    try {
        arrayOfObjects.forEach(function (arrayItem) {
            if (value === arrayItem[property]) {
                res = arrayItem;
                throw BreakException;
            }
        });
    } catch (e) {
        if (e !== BreakException) {
            throw e;
        } else {
            return res;
        }
    }
}

//Função que permite Mostar/Esconder Colunas de uma instância no Tables não interfere no Editor!!
// var instance = RH_ID_RUBRICAS,
//     fields = {
//                show: ['VALOR_DIF'],
//                hide: ['VALOR']
//              };
// ...
// QuadTablesViewColumnsManager(instance, fields);
// ...
function QuadTablesShowHideColumns (instance, fields) {

        if ($.fn.DataTable.isDataTable("#" + instance.tableId) && instance.instanceVisible($("#" + instance.tableId))) {
            //Hide column(s)
            _.forEach(fields.hide, function (name, i) {
                var col = _.find(instance.tbl.settings()[0].aoColumns, {data: name});
                var column = instance.tbl.column(col.idx);
                column.visible(false);
            });

            //Show column(s)
            _.forEach(fields.show, function (name, i) {
                var col = _.find(instance.tbl.settings()[0].aoColumns, {data: name});
                var column = instance.tbl.column(col.idx);
                column.visible(true);
            })
            $("#"+instance.tableId)
                .DataTable()
                .columns.adjust()
                .responsive.recalc();
        }

}

/* Draws QUADTABLE FOOTERS */
function DrawTablesFooter (instance, colspan_, totColumnsIndex, sql, title) {
    //------------------
    //  :: PARAMETERS ::
    //------------------
    //      instance: QuadTable Instance (object)
    //      colspan_: First colspan (nr. of columns). Ex: 4 (first 4 columns grouped on only 1)
    //      totColumnsIndex: Columns references to "totalize": [IDX] visible column index starting with 0 + [NAME] "db colmun name" on SQL statement. Ex: [{idx:4, name: "TOTAL_ESTIMADO"},{idx:5, name: "TOTAL_REAL"}]
    //      sql: //SQL statistics statement. Ex: ['select sum(VALOR_ESTIMADO) as TOTAL_ESTIMADO, sum(VALOR_REAL) as TOTAL_REAL from GF_CURSO_CUSTOS']

    var dadosEstatisticos = {};

    //DB call to execute statistics
    if (1 === 1) {
        var where_filter = instance.where_str.length > 0 ? " WHERE " + instance.where_str : "",
            obj = instance,
            sql = [ sql[0] + where_filter], //Automatic aplication of particular query details used on instance at the moment of the call
            rqt = obj.getFromSql(sql);

        $.when(rqt).then(function (data) {
            try {
                /*
                 [0:
                    [0: {MEDIA: "327.9999",TOTAL_HORAS: "7022.0"}],
                    [1: {MEDIA_2: "389.99"}]
                 ]
                 */
                dadosEstatisticos = JSON.parse(data);
                dadosEstatisticos = dadosEstatisticos[0][0]; //Convert to single Object: {MEDIA_2: "389.99"}. Comment and deal when using array of SELECTS...
            } catch (e) {
                return true;
            }
        });
    }

    setTimeout(function () {
        var myFooter = $("#" + instance.tableId + "_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollFoot > div > table > tfoot > tr#tsRow-" + instance.tableId), //Footer selector
            htm_ = '',              //Variável com o texto de cada coluna a inserir no footer
            width_ = parseInt(0),   //Variável que totaliza o comprimento de todas as colunas a incluir no colspan_
//        colspan_ = 4,             //Nr. de colunas a agrupar NO INÍCIO DA ROW. Basta contar de 1 até à última coluna a agrupar, usando o Header da instância como referência.
        rowTitle = title;           //Título da footer ROW

        try {
            //Percorrendo todas as colunas VISIVEIS no HEADER do Interface...
            $("#" + instance.tableId + "_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead th.hdrShow:not(.none)")
                .each(function (index, element) {
                    var clone = $(this).clone(); //Criamos uma réplica da coluna elegível no Header
                    //Agrupamos as primeiras "colspan_" colunas do header numa só, com a soma do seu comprimento individual e
                    //atribuímos-lhe o título (rowTitle) para incluir no Footer
                    if ( index < colspan_ ) {
                        width_ = parseInt(width_) + parseInt( clone.css('width'));
                        //Se estivermos na última coluna do colspan...
                        if (index+1 === colspan_) {
                            htm_ = clone //Usa o clone da última coluna
                                    .addClass('quadFooter') //Acrescenta a class quadFooter (como recurso para customizações).
                                    .empty() //Esvazia o seu título
                                    .html(rowTitle) //...substituindo-o pelo Título do Footer
                                    .attr("colspan", colspan_) //Atribui o colspan definido para a 1ª coluna do footer
                                    .css("width", width_) //Atribui-lhe o total dos comprimentos somados
                                    .prop('outerHTML'); //Usa o texto que resulta de todas as manipulações anteriores, para inserção no Footer
                            myFooter.append( htm_ ); //Adiciona o texto resultante na 1ª posição do Footer
                        }
                    } else { //Se coluna não pertence ao colspan...
                        //A posição desta coluna está referênciada no array de objectos de colunas com totalizadores?
                        //Parâmetros:
                        //  [totColumnsIndex] -> array de configuração :: No array de configuração
                        //  ["idx"] -> nome da propriedade onde devo procurar o match :: ... na propriedade "idx"
                        //  [index] -> valor dessa propriedade a que corresponderá um "match" :: ...vê se encontras a coluna com a referência "index" que corresponde ao índice visível da coluna onde quero depositar um "total"
                        var y =  isReferenceValueOnObject(totColumnsIndex, "idx", index);
                        var BreakException = {};
                        if (y) { //Se é uma coluna onde vão constar "VALORES", atribuimos-lhe a classe com a coluna NOME da QUERY de RESUMO
                            var tot_ = '';
                            try {
                                if ( dadosEstatisticos[ y['name'] ]) {
                                    htm_ = clone.addClass('quadFooter ' + y['name'])
                                            .empty()
                                            .html(dadosEstatisticos[ y['name'] ])
                                            .css("text-align", 'right') //Valores justificados à direita (tipicamente os headers são-no sempre à esquerda)
                                            .prop('outerHTML');
                                    myFooter.append( htm_ );
                                } else {
                                    throw BreakException; //Print without value if value = null, etc
                                }
                            } catch (e) {
                                if (e !== BreakException) {
                                    throw e;
                                } else { //Colunas de totais com "null"
                                    htm_ = clone.addClass('quadFooter ' + y['name']).empty().prop('outerHTML');
                                    myFooter.append( htm_ );
                                }
                            }
                        } else { //Ás outras colunas onde não há valores, a border RIGHT é "suprimida". A última (se também for suprimível) é resolvida pela border da própria ROW.
                            htm_ = clone.addClass('quadFooter').empty().css("border-right", 0).prop('outerHTML');
                            myFooter.append( htm_ );
                        }
                    }
            });
        } catch (e) {
            console.log(e);
        }
    }, 500);

}


// QUADTABLE COLUMNS VIEW extention manager
// Show/Hide column on :
//  1. Editor (create ou edit). Extends "instance"AttachEvt EVENT
//  2. Advance Query editor. Extends "instance"_dtAdvancedSearch EVENT
// Example:
//
/*
        ...
        GF_ACOES.initTable($.extend({}, datatable_instance_defaults, optionGF_ACOES));
        var refineColumns = [
                {
                    "DSP_VERSAO": {
                        create: false, //What to do on create. Show column ?
                        edit: false,   //What to do on edit. Show column ?
                        search: true   //What to do on search mode. Show column ?
                    }
                }, {
                    "DT_FIM_ACAO": {
                        create: false, //Omissions applies column default definition on instance
                    }
                }
            ];
            ...
            manageQuadTableColumns(GF_ACOES, refineColumns);
            ...
 */
function manageQuadTableColumns (instance, fields) {

    //According to fields and operation it shows / hiddens the columns
    function onOperation (fields, operation) {
        for (var i=0; i<fields.length; i++) {
            Object.keys(fields[i]).map(function(key) {
                var el = $('#' + instance.tableId + '_editorForm > div > div.DTE_Field.row.DTE_Field_Name_' + key);
                if (el.length) {
                    //console.log(key); :: COLUMN NAME
                    //console.log(key + ' ' + operation + ' ' + fields[i][key][operation]);
                    if (fields[i][key][operation]) {
                        el.show();
                    } else {
                        if (fields[i][key][operation] === false) {
                            el.hide();
                        } else if (typeof fields[i][key][operation] === "undefined") {
                            if (el.hasClass('DTE_Field_Type_hidden') ) {
                                console.log('This column (not mentioned on the list) has to be hidden...');
                            } else {
                                el.show();
                            }
                        }
                    }
                }
            });
        }
    }

    //Editor INSERT/UPDATE event
    $(document).on(instance.tableId + 'AttachEvt', function (e) {
        var operation = instance.editor.s["action"];
        onOperation (fields, operation);
    });

    //EDITOR PESQUISA AVANÇADA
    $(document).on('click', '#' + instance.tableId + '_dtAdvancedSearch', function (e) {
        onOperation (fields, 'search');
    });

}

//Recebe duas referências Horárias (HH24:MI ou YYY-MM-DD HH24:MI) e devolve os MINUTOS desse INTERVALO. EX: 480
//É IMPORTANTE begin <= end!!!
function timeDifference (begin, end) {
    //console.log('>>> De ' + begin + ' a ' + end);
    var start, endTime, timeDiff = 0, res_in_minutes = 0;

    if (begin.length === 5 && end.length === 5) {
        //1. HORA INÍCIO formating
        start = new Date('1900-01-01 ' + begin);

        //2. HORA FIM  formating
        if ( begin <= end ) {
            endTime = new Date('1900-01-01 ' + end);
        } else { //Next Day
            endTime = new Date('1900-01-02 ' + end);
        }
    } else {
        //1. HORA INÍCIO formating
        start = new Date(begin);
        endTime = new Date(end);
    }
    //3. Compute DIFFEENCE in MINUTES
    try {
        timeDiff = endTime - start;
        res_in_minutes = Math.floor((timeDiff/1000)/60);
    } catch (e) {
        null;
    }
    return res_in_minutes;
}

function getConfigListValue(instancia, idx, val) {
    var res = '';
    try {
        res = _.find( instancia.getComplexListIndex( quadConfig.loadData[idx].attr ), {VAL: val} );
        return res[Object.keys(res)[0]];
    } catch(e) {
        null;
    }
    return res;
}

/* Função de suporte ao download de BLOBs */
function base64ToArrayBuffer(data) {
    var binaryString = window.atob(data);
    var binaryLen = binaryString.length;
    var bytes = new Uint8Array(binaryLen);
    for (var i = 0; i < binaryLen; i++) {
        var ascii = binaryString.charCodeAt(i);
        bytes[i] = ascii;
    }
    return bytes;
};

//Is Integer?
function isInt(n){
    return Number(n) === n && n % 1 === 0;
}

//Is Float?
function isFloat(n){
    return Number(n) === n && n % 1 !== 0;
}
//Format sets of 3 seperated vy space
function numberWithSpaces(x, splitter) {
    if ( isInt(x) ) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    }

    //Is Floatish: .split(".") for numbers OR .split(":") for hours
    var parts = x.toString().split(splitter); //
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    return parts.join(splitter);

}
//Retorna DATA [YYYY-MM-DD]+ NR_DAYS (default 1 day)
function nextDay (data_, nr_days) {
//    var nxt_day = new Date(data_);
    if (!nr_days) {
        nr_days = 1;
    }

/*  Este cálculo não estava a devolver sempre a data correta.  REDIRECIONADA PARA addDays()
 *  var tmp = new Date(nxt_day).getDate();
    console.log("data:"+data_+" nr_days:"+nr_days+" tmp:"+tmp+" set date:" + nxt_day.setDate( tmp + nr_days));
    return formatDate(nxt_day.setDate( new Date(nxt_day).getDate() + nr_days), 'YYYY-MM-DD');
*/
    return formatDate(addDays(data_,nr_days), 'YYYY-MM-DD');
}

//VERSÃO A USAR :: Retorna DATA + NR_DAYS (default 1 day)
function addDays(data_, days) {
  const date = new Date(data_);
  const copy = new Date(Number(date));
  copy.setDate(date.getDate() + days);
  return copy;
}

//Get Horário Diario DETAILS
function getHorarioDiarioDetails (empresa_, rhid_, dt_adm_, dia_) {
    var dados = {
        empresa: empresa_,
        rhid : rhid_,
        dt_adm: dt_adm_,
        dia: dia_
    }, results = '';
    $.ajax({
        type: "POST",
        url:  "data-source/quad_requests_lib.php",
        data: "request_id=getHorarioDiario"+
              "&params="+JSON.stringify(dados),
        async: false,
        cache: false,
        success: function(res){
            results = res;
        }
    });

    return results;
}

//Get Horário Diario DETAILS
function getTimeDuration (dados) {
    /* Estrutura TIPO. Ex:
        dados = {
            tabela: dados['tabela],
            empresa: dados['empresa'],
            rhid : dados['rhid'],
            dt_adm: dados['dt_adm'],
            dt_ini: dados['dt_ini'],
            dt_fim: dados['dt_ini'],
            ...
            OBS: Pode haver casos em que esta estrutura é EXTENDIDA, para endereçar necessidades particulares dos módulos.
                 Consultar o Controlador PHP e/ou o interface RH_TIME_MANAGEMENT.php para mais detalhes.
        };
    */
    var results = '';
    $.ajax({
        type: "POST",
        url:  "data-source/quad_requests_lib.php",
        data: "request_id=getTimeDuration"+
              "&params="+JSON.stringify(dados),
        async: false,
        cache: false,
        success: function(res){
            // O(s) valor(s) devolvidos dependem das convenções e necessidades específicas de cada módulo envolvido na chamada.
            results = res;
        }
    });

    return results;
}
//"Escapes" PHP strings to be js "ready" (to JSON.parse), Ex: \n -> \\n, etc
function jsonEscape(str)  {
    return str.replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t");
}

/* QUADTABLES :: AVALIAÇÃO DESEMPENHO :: FOLOW-UP :: Record History Prototype Display */
function AD_Master_History (val, type, row) {
    var txt = '';

    if (row['INSERTED_BY'] !== null  && row['DT_INSERTED'] !== null) {
        txt = '<li><span class="cronoAd"><strong>' + JS_CREATED_AD.toUpperCase() + ':</strong> ' + row['INSERTED_BY'] + ' - ' + row['DT_INSERTED'] + '</span></li>';
    }

    if (row['RHID_AVALIADOR'] !== null && row['DT_HR_AVALIADOR'] !== null) {
        txt += '<li><span class="cronoAd"><strong>' + JS_EVALUATION_AD.toUpperCase() + ':</strong> ' + row['NOME_AVALIADOR'] + ' <sup class="myBold">(' + row['RHID_AVALIADOR'] + ')</sup>, ' + row['DT_HR_AVALIADOR'] + '</span></li>';
    }

    if (row['RHID_HOMOLOGADOR'] !== null && row['DT_HR_HOMOLOGADOR'] !== null) {
        txt += '<li><span class="cronoAd"><strong>' + JS_HOMOLOGATION_AD.toUpperCase() + ':</strong> ' + row['NOME_HOMOLOGADOR'] + ' <sup class="myBold">(' + row['RHID_HOMOLOGADOR'] + ')</sup>, ' + row['DT_HR_HOMOLOGADOR'] + '</span></li>';
    }

    if (row['AVALIADO_OK'] !== null && row['DT_HR_AVALIADO'] !== null) {
        txt += '<li><span class="cronoAd"><strong>' + JS_AGREMENT_AD.toUpperCase() + ':</strong> ' + row['NOME_AVALIADO'] + ' <sup class="myBold">(' + row['RHID'] + ')</sup>, ' + row['DT_HR_AVALIADO'] + '</span></li>';
    }

    if (txt) {
        txt = '<ul style="margin-left: -60px;">' + txt + '</ul>';
    }
    return txt;
}


//Redraw the elementos com CHOSEN, quando o REDRAW da WINDOW não os deixa ajustados às novas dimensões
// Exemplo:
//  $(window).resize(function(){
//      redrawChosen();
//      ...
//  });
function redrawChosen() {
   $(".chosen-container").each(function() {
       $(this).attr('style', 'width: 100%');
   });
}

function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}
