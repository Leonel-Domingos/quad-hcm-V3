/* 
 * Session Storage to manage processes issued by QUADSYSTEMS App's
 */

/***********************************************
***  Constructor with attribute definitions  ***
************************************************/
function Processo (slots) {
  this.id = slots.id;
  this.name = slots.name;
  this.time = slots.time;
};

/***********************************************
***  Class-level ("static") properties  ********
************************************************/
Processo.instances = {};  // initially an empty associative array
var timer = '';
const TIMERATE = 1000; //1 second

/***********************************************
********      Class-level processes     ********
************************************************/

// Convert row to object */
Processo.convertRow2Obj = function (processoRow) {
    var processo = new Processo( processoRow);
    return processo;
};

// Generate key to new process request based on highest key registred (if not, returns 1) */
Processo.nextKey = function(){
    var processosString="", processos={}, keys = {}, cnt=0;  
    try {
        if (localStorage.getItem("processos")) {
          processosString = localStorage.getItem("processos");
        }
    } catch (e) {
        null;
    }
    if (processosString.length > 2) { // If processosString is EMPTY equals to "{}"
        processos = JSON.parse( processosString);
        keys = Object.keys( processos );
        cnt = keys[keys.length-1];//keys.length;
        if (cnt == "NaN") {
            cnt = 0;
        }
    }
    return parseInt(cnt) + 1;
}

// Count number of processes registred (and running) */
Processo.counter = function () {
    var keys=[], num = 0, processosString="", processos={};  

    try {
        if (localStorage.getItem("processos")) {
            processosString = localStorage.getItem("processos");
        }
    } catch (e) {
        null;
    }

    if (processosString !== "{}" && processosString.length > 0) {
        processos = JSON.parse( processosString);
        keys = Object.keys( processos);
        num = keys.length; //[keys.length-1];
    }
    return num;
};

// Load the processes table from Local Storage */
Processo.loadAll = function () {
    var key="", keys=[], processosString="", processos={}, i=0;  
    try {
        if (localStorage.getItem("processos")) {
            processosString = localStorage.getItem("processos");
        }
    } catch (e) {
        alert("Error when reading from Local Storage\n" + e);
    }
    if (processosString) {
        processos = JSON.parse( processosString);
        keys = Object.keys( processos);
        for (i=0; i < keys.length; i++) {
            key = keys[i];
            Processo.instances[key] = Processo.convertRow2Obj( processos[key]);
        }
    }
    //console.log( keys.length +" processos loaded.");
    return Processo.instances[key];
};

//Show formated Process List on selector */
 Processo.listProcessos = function (selector) {
    var str, tableBodyEl = document.querySelector(selector);
    var keys=[], key="", row={}, i=0, timePassed = '';

    if ( $(selector).length > 0) {
        // Load all processes objects
        Processo.loadAll();
        keys = Object.keys( Processo.instances);
        // for each process, create a table row with a cell for each attribute
        str = '';
        for (i=0; i < keys.length; i++) {
            key = keys[i];
            timePassed = 0;
            if (Processo.instances[key].time) {
                str += '<li id="proCtl' + Processo.instances[key].id + '">' +
                          '<span class="padding-10 unread">' + 
                              '<em class="badge padding-5 no-border-radius bg-color-blueLight pull-left margin-right-5">'+
                                  '<!--i class="fa fa-user fa-fw fa-2x"></i-->'+
                              '</em>' +
                              '<span class="text-primary">' + Processo.instances[key].name; 
                timePassed = ellapseTime(Processo.instances[key].time);
                if (timePassed) {
                    str += '<br>' +
                                '<span class="pull-right font-xs text-muted" style="padding-top: 3px;"><i class="fas fa-clock fa-fw" style="font-size: 1.1em;"></i><i class="quad-right-padding-5">' +
                                    '<span class="timerCtl" data-origin="' + Processo.instances[key].id + '" data-start="' + Processo.instances[key].time + '">' + timePassed.toLowerCase() + '...</span></i></span>' +
                                '</span>';
                } else {
                    str += '</span>';
                }
                str += '</span></li>';
            }
        }
    } else {
        alert('1. Unexistent selector. Please correct it...');
    }
    $(selector).html(str);
    //return str;
};

/* Start timer running ellapsed time for each process */
Processo.startTimer = function () {
    function timerCounter(){
        $('.timerCtl').each(function() {
            var timePassed = ellapseTime(this.dataset.start);
            $(this).text(timePassed.toLowerCase() + '...');        
        });
    }
    timer = setInterval( 
                function () {
                    timerCounter();
            }, 
                parseInt(TIMERATE) 
            );
    
} 

/*  Stop timer  */
Processo.stopTimer = function (timeRate) {
    clearInterval(timer);
}

/* Save all processo objects to Local Storage */
Processo.saveAll = function () {
    var processosString="", error=false,
        nmrOfProcessos = Object.keys( Processo.instances).length;  
    try {
      processosString = JSON.stringify( Processo.instances);
      localStorage.setItem("processos", processosString);
    } catch (e) {
      alert("Error when writing to Local Storage\n" + e);
      error = true;
    }
    Processo.updateView(); 
  //if (!error) console.log( nmrOfProcessos + " processos saved.");
};

//  Create a new processo row */
Processo.create = function (slots) {
  var processo = new Processo( slots);
  Processo.instances[slots.id] = processo;
  Processo.saveAll();
  return slots.id;
  //console.log("Processo " + slots.id + " created!");
};

//  Update an existing processo row */
Processo.update = function (slots) {
  var processo = Processo.instances[slots.isbn];
  var year = parseInt( slots.year);
  if (processo.name !== slots.title) { processo.name = slots.title;}
  if (processo.time !== slots.year) { processo.time = year;}
  //console.log("Processo " + slots.id + " modified!");
};

//  Delete a processo row from persistent storage */
Processo.destroy = function (id) {
    if (Processo.instances[id]) {
        var el = '#proCtl' + id;
        delete Processo.instances[id];
    } else {
        Processo.clearData();  
    }
    Processo.saveAll();   
};

Processo.updateView = function () {
    /* Update badge  */
    var cnt = 0, field = document.getElementById("processCtrl"), $this = $('#activity');
    if (field !== null) { //Only runs after authentication (skips on LOGIN)
        cnt = Processo.counter();
        field.textContent = cnt;
    }
    
    /* Update process list if visible */
    if ($this.next('.ajax-dropdown').is(':visible')) {
        $this.next('.ajax-dropdown').fadeIn(150);
        //Upload processes running
        Processo.listProcessos(".notification-body");
        Processo.startTimer();
    }
    
    /* Close if no processes are running */
    if (!cnt) {
        Processo.stopTimer();
        if ($this.next('.ajax-dropdown').is(':visible')) {
            $('#activity').trigger('click');
        }
    }
}
/* Create and save test data */
Processo.createTestProcesses = function () {
  Processo.instances["1"] = new Processo({id:"1", name:"Cálculo de Prémios", time:1519992662049});
  Processo.instances["2"] = new Processo({id:"2", name:"Exportação Artigos", time:1519992663229});
  Processo.instances["3"] = new Processo({id:"3", name:"Exportação de log de erros", time:1519992663795});
  Processo.saveAll();
};

/* Clear data */
Processo.clearData = function () {
  if (confirm("Do you really want to delete all processo data?")) {
    Processo.instances = {};
    localStorage.setItem("processos", "{}");
  }
};