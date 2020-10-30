//exemplo importacao de scripts...jquery nao faz sentido pois nao temos acesso ao Dom
importScripts(
    "../lodash.3.10.1.min.js",
    "../promise.js",
    "../fetch.js"
);
self.onmessage = function(e) {
  var data = JSON.parse(e.data);
  self.postMessage("working");
  sendWorkerArrBuff(data);
};
String.prototype.replaceAll = function(search, replacement) {
  var target = this;
  return target.split(search).join(replacement);
};
function downloadCSV(args) {
  var data;
  var csv = convertArrayOfObjectsToCSV({
    data: args.data[0],
    cols: args.cols,
    dbColumn: args.dbColumns,
    type: args.type,
    visibleCols: args.visibleCols
  });
  if (csv == null) return;
  /* if (!csv.match(/^data:text\/csv/i)) {
           //esta linha codifica os caracteres portugueses etc...remove-se charset=utf-8
           csv = 'data:text/csv;charset=UTF-8,' + "\ufeff" + csv;
       }*/
  data = encodeURI(csv);
  return data;
}

function convertArrayOfObjectsToCSV(args) {
  var result, ctr, keys, header, columnDelimiter, lineDelimiter, data;
  data = args.data || null;
  if (data == null || !data.length) {
    return null;
  }
  columnDelimiter = args.columnDelimiter || ";";
  lineDelimiter = args.lineDelimiter || "\n";
  /*var keys = args.cols.filter(x => (x.visible !== false && x.label != undefined)).map(x => x.name);
       var header = args.cols.filter(x => (x.visible !== false && x.label != undefined)).map(x => x.label);*/
  /*ES6 sintax
       var className="visibleColumn";
       var rxp=new RegExp('\\b' + className + '\\b');
       var keys = args.cols.filter(x => rxp.test(x.className)).map(x => x.name);
       var header = args.cols.filter(x =>  rxp.test(x.className)).map(x => x.label);*/
  //todo export QuadForm
  if (args.type === "QuadForm") {
    /* get visible */
    keys = args.visibleCols;
    header = args.visibleCols;
  } else {
    var className = "visibleColumn";
    var rxp = new RegExp("\\b" + className + "\\b");
    keys = args.cols
        .filter(function(x) {
          return rxp.test(x.className);
        })
        .map(function(x) {
          return x.name;
        });
    header = args.cols
        .filter(function(x) {
          return rxp.test(x.className);
        })
        .map(function(x) {
          var regex = /(<([^>]+)>)/gi, //PMA: 2018.07.03 :: Removes ALL HTML TAGS from column title
              result = x.title.replace(regex, "");
          return result; //return x.title;
        });
  }
  result = "";
  result += header.join(columnDelimiter);
  result += lineDelimiter;
  data.forEach(function(item) {
    ctr = 0;
    keys.forEach(function(key) {
        if(typeof(key) !== "undefined" && key !== null ) {
            if (ctr > 0) result += columnDelimiter;
            if (item[key.toUpperCase()] != null) {
              item[key.toUpperCase()] = item[key.toUpperCase()].replace(
                  /[\n\r]/g,
                  " "
              );
              item[key.toUpperCase()] = item[key.toUpperCase()].replace(/[;]$/, ".");
              item[key.toUpperCase()] = item[key.toUpperCase()].replace(/[;]/g, ", ");
            } else {
              item[key.toUpperCase()] = "";
            }
            result += item[key.toUpperCase()];
            ctr++;
        }
    });
    result += lineDelimiter;
  });   
  return result;
}

function composeId(pk, rowData) {
  if (pk && rowData) {
    var rowId = "";
    var j = 0;
    _.forEach(pk, function(k, i) {
      j++;
      if (j > 1) {
        rowId += rowData[i];
      } else {
        rowId += "row_" + rowData[i];
      }
    });
    return rowId;
  }
}

function returnListKeys(o) {
  var keys;
  if (o.attr) {
    o = o.attr;
  }
  if (o["distribute-value"]) {
    keys = o["distribute-value"].replaceAll("A.", "").split("@");
  } else {
    keys = o["data-db-name"].replaceAll("A.", "").split("@");
  }
  return keys;
}

function getComplexListIndex(target) {
  var idx = "";
  if (target.attr) {
    target = target.attr;
  }
  idx += target["data-db-name"] + "__";
  idx += target["decodeFromTable"] + "__";
  idx += target["desigColumn"]
      ? target["desigColumn"] + "__"
      : target["name"] + "__";
  idx += target["orderBy"] ? target["orderBy"] + "__" : "";
  idx += target["whereClause"] ? target["whereClause"] + "__" : "";
  idx = idx.slice(0, -2);
  return idx;
}

function sendWorkerArrBuff(data) {
  function status(response) {
    if (response.status >= 200 && response.status < 300) {
      return Promise.resolve(response);
    } else {
      return Promise.reject(new Error(response.statusText));
    }
  }

  function json(response) {
    return response.json();
  }

  fetch(
      data.defaults + "returnSqlRes.php?XDEBUG_SESSION_START=PHPSTORM",
      //fetch(data.defaults + 'returnSqlRes.php',
      {
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json; charset=utf-8"
        },
        method: "post",
        body: JSON.stringify(data),
        mode: "cors"
      }
  )
      .then(status)
      .then(json)
      .then(function(sData) {
        if (sData.download) {
          self.postMessage(sData);
          return;
        }
        var dt = {};
        dt["cols"] = data.tableCols;
        dt["dbColumns"] = data.dbColumns;
        dt["o"] = data.tableId;
        dt["data"] = sData;
        dt["type"] = data.type;
        data.visibleCols ? (dt["visibleCols"] = data.visibleCols) : null;
        _.forEach(dt.data[0], function(row) {
          if (data.type === "QuadTable") {
            row.DT_RowId = composeId(data.pk, row);
            _.forEach(data.tableCols, function(o, index) {
              if (_.has(o, "complexList")) {
                var fieldName = o.attr.desigColumn
                    ? o.attr.desigColumn
                    : o.attr.name;
                var field = o.name;
                var keys = returnListKeys(o);
                var search = "";
                _.forEach(keys, function(name, i) {
                  if (i < keys.length - 1) {
                    search += row[name] + "@";
                  } else {
                    search += row[name];
                  }
                });
                var result = _.find(data.loadedData[getComplexListIndex(o)], {
                  VAL: search
                });
                if (result == undefined) {
                  row[field] = "";
                } else {
                  row[field] = result[fieldName];
                }
              }
              if (_.has(o, "attr") && _.has(o.attr, "domain-list")) {
                if (row[o.name] != null) {
                  var ob = _.find(data.domains[o.attr["dependent-group"]], {
                    RV_LOW_VALUE: row[o.name]
                  });
                  if (row[o.name] == null) {
                    row[o.name] = null;
                  } else {
                    row[o.name] = ob["RV_MEANING"];
                  }
                }
              }
            });
          } else {
            _.map(data.formComplexLists, function(o, index) {
              var fieldName = o.desigColumn ? o.desigColumn : o.name;
              var field = o.name;
              var keys = returnListKeys(o);
              var search = "";
              _.map(keys, function(name, i) {
                if (i < keys.length - 1) {
                  search += row[name] + "@";
                } else {
                  search += row[name];
                }
              });
              var result = _.find(data.loadedData[getComplexListIndex(o)], {
                VAL: search
              });
              if (result == undefined) {
                row[field] = "";
              } else {
                row[field] = result[fieldName];
              }
            });
            _.map(data.formDomainsLists, function(o, index) {
              if (row[o.name] != null) {
                var ob = _.find(data.domains[o.attr["dependent-group"]], {
                  RV_LOW_VALUE: row[o.name]
                });
                if (row[o.name] == null) {
                  row[o.name] = null;
                } else {
                  row[o.name] = ob["RV_MEANING"];
                }
              }
              if (row[o.name] != null) {
                var ob = _.find(data.domains[o.attr["dependent-group"]], {
                  RV_LOW_VALUE: row[o.name]
                });
                if (row[o.name] == null) {
                  row[o.name] = null;
                } else {
                  row[o.name] = ob["RV_MEANING"];
                }
              }
            });
          }
        });
        self.postMessage(downloadCSV(dt));
      })
      .catch(function(error) {
        console.log("SampleWorker: " + error);
      });
}
