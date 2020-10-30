/*
 * Inicialização asincrona das estruturas de dados
 *
 * Só carregado no início da aplicação - landing page
 */

//Carregamento do QUADCONFIG
initApp.joinsData = initApp.joinsData || {};
initApp.joinsComplexData = initApp.joinsComplexData || {};

var o = new QuadTable();
o.pathToComplexListsFile = pn + "data-source/complexLists.php",
o.pathToListsFile = pn + "data-source/quad_lists_lib.php",
$.each(quadConfig.loadData, function (i, field) {
    o.compileRequests(field, false, null);
});

$.each(quadConfig.domains, function (i, item) {
    o.compileDomainRequests(item);
});

if(o.domainRequests!==undefined){
    if (Object.keys(o.domainRequests).length > 0) {
        $.when(o.getDomainsData(true)).then(function (strData) {
            if (strData && JSON.parse(strData)) {
                o.mapDomainsRequest(strData);
            }
        });
    }
}
if (o.requests !== undefined) {
    if (Object.keys(o.requests).length > 0) {
        $.when(o.getListsData(true)).then(function (strData) {
            if (strData && JSON.parse(strData)) {
                o.mapListRequest(strData, quadConfig.loadData, null);
            }
        });
    }
}

