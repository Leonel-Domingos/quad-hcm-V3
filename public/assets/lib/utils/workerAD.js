/* global fetch */
importScripts(
  "../lodash.3.10.1.min.js",
  "../promise.js",
  "../fetch.js"
);
self.onmessage = function(e) {
  var data = JSON.parse(e.data);
  self.postMessage("working");
  dbExecute(data, e);
};

function dbExecute(data, e) {
  function status(response) {
    if (response.status >= 200 && response.status < 300) {
      return Promise.resolve(response);
    } else {
      return Promise.reject(new Error(response.statusText));
    }
  }

  fetch(data.defaults + "ad_action_controller.php", {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json; charset=utf-8"
    },
    method: "POST",
    body: e.data
  })
    .then(status)
    .then(function(sData) {
      return sData.json();
    })
    .then(function(sData) {
      self.postMessage(sData); //PHP return
    })
    .catch(function(exception) {
      exception =
        '<br><img src="/img/blank.gif" class="flag flag-pt">&nbsp;Erro de comunicações.<br>PF consulte o seu Administrador de Sistemas.<br>' +
        '<br><img src="/img/blank.gif" class="flag flag-gb">&nbsp;Communications error. Please contact your Systems Administrator.';
      self.postMessage({ msg: "NOK: " + exception });
    });
}
