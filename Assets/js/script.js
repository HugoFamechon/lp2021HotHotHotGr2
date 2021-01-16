//  var tempOut = Math.floor(Math.random() * (50 - (-10) + 1)) + (-10);
//  console.log(tempIn);
//  var tempIn = Math.floor(Math.random() * (40 - 10 + 1)) + 10;


notie.setOptions({
    alertTime: 2
})

function success() {
    console.log('clicked :>> ');
}




let tempIn;
let tempOut;

let dataW;
let dataA;
let dataS;


// let datatempory


// ----------------------- //
// Chargement des données  //
// ----------------------- //

function getXMLHttpRequest() {
    var xhr = null;
    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest();
        }
    } else {
        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
        return null;
    }
    return xhr;
}

function LireFichierJSON() {
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            alerte = JSON.parse(xhr.responseText);

        }
    }
    xhr.open("GET", "Assets/json/data.json", false);
    xhr.send(null);

}

LireFichierJSON();
processData(alerte);

// ----------------------- //
// Event pour charger les  //
//  données de la semaine  //
// ----------------------- //

let tabTwo = document.querySelector("#tabWeek");
tabTwo.addEventListener("click", function(e) {
    console.log(' Event clicked ! ');
    loadWeekData(e);
});


let bandeau = document.querySelector(".bandeau");
bandeau.addEventListener("click", e => loadAlertInside(e));

let bandeauOut = document.querySelector(".bandeauout");
bandeauOut.addEventListener("click", e => loadAlertOutside(e));


let account = document.querySelector("#account");
account.addEventListener("click", function(e) {
    loadSettings(e);
    document.querySelector("#panel_above").style.display = "flex";
    document.querySelector("#panel_nav").addEventListener("click", function(e) {
        document.querySelector("#panel_above").style.display = "none";

    }, { once: true });
});




// ----------------------- //
// Traitement des alertes  //
// ----------------------- //
function processAlert(tempInterieur, tempExterieur) {

    let divBandeau = document.querySelector(".bandeau");
    let pAlertIn = document.createElement('p');


    if (tempInterieur > 50) {
        console.log('Appelez les pompiers ou arrêtez votre barbecue !');
        pAlertIn.textContent = 'Hydratez-vous !\r\n(cliquer ici)';
        divBandeau.style.background = "var(--red)";
    } else if (tempInterieur > 22) {
        console.log('Baissez le chauffage !');
        pAlertIn.textContent = 'Il commence\r\n à faire chaud là...';
        divBandeau.style.background = "var(--orange)";
    } else if (tempInterieur < 0) {
        console.log('Canalisations gelées, appelez SOS plombier - et mettez un bonnet !');
        pAlertIn.textContent = 'Attention gèle !';
        divBandeau.style.background = "var(--blue)";
    } else if (tempInterieur < 12) {
        console.log('Montez le chauffage ou mettez un gros pull  !');
        pAlertIn.textContent = 'Il commence à faire froid...';
        divBandeau.style.background = "var(--blue)";
    } else {
        pAlertIn.textContent = "Jusqu'ici,\r\ntout va bien.";
        divBandeau.style.background = "var(--success)";
    }

    divBandeau.appendChild(pAlertIn);


    let divBandeauOut = document.querySelector(".bandeauout");
    let pAlertOut = document.createElement('p');

    if (tempExterieur > 35) {
        console.log('Hot Hot Hot !');
        // divBandeau.style.background = "var(--orange)";
        divBandeauOut.style.backgroundImage = "url(img/hill.png)";
        pAlertOut.textContent = 'Hydratez-vous !';
    } else if (tempExterieur < 0) {
        console.log("Banquise en vue !");
        pAlertOut.textContent = 'Une bonne journée pour coder 😭';

    } else {
        pAlertOut.textContent = 'Température banale'

    }
    divBandeauOut.appendChild(pAlertOut);
}


function processData(jsonObj) {




    tempIn = jsonObj['temperature'][0]['current'];
    tempOut = jsonObj['temperature'][1]['current'];

    processAlert(tempIn, tempOut);



    var jsonInOut = jsonObj['temperature'];

    for (var i = 0; i < jsonInOut.length; i++) {

        let divParentIn = document.querySelector("#minMaxIn");
        let divParentOut = document.querySelector("#minMaxOut");
        let divTempeIn = document.querySelector(".inside .inout .tempe");
        let divTempeOut = document.querySelector(".outside .inout .tempe");


        let tempInText = document.createElement('p');
        let tempMaxMinText = document.createElement('h4');


        tempInText.textContent = jsonInOut[i].current + "°";
        tempMaxMinText.textContent = "Min : " + jsonInOut[i].min + "° / Max : " + jsonInOut[i].max + "°";

        if (i == 0) {
            divTempeIn.appendChild(tempInText);
            divParentIn.append(tempMaxMinText)
        } else {
            divTempeOut.appendChild(tempInText);
            divParentOut.append(tempMaxMinText)
        }



    }


}



function loadWeekData(e) {

    console.log('dataW :>> ', dataW);

    if (dataW == undefined) {
        let requestURL = "Assets/json/semaine.json";

        let requestWeek = new XMLHttpRequest();
        requestWeek.open('GET', requestURL);
        requestWeek.responseType = 'json';
        requestWeek.send();

        requestWeek.onload = function() {
            let responseData = requestWeek.response;
            dataW = responseData;
            let json = responseData['semaine'];
            for (var i = 0; i < 5; i++) {

                let tableInTemp = document.querySelector("#tableInTemp");
                let tableOutTemp = document.querySelector("#tableOutTemp");

                let tdInTemp = document.createElement('td');
                let tdOutTemp = document.createElement('td');

                tdInTemp.textContent = json[i].in;
                tdOutTemp.textContent = json[i].out;

                tableInTemp.appendChild(tdInTemp);
                tableOutTemp.append(tdOutTemp)

            }
        }
    }
}

function loadAlertOutside(e) {

    if (dataA == undefined) {
        let requestURL = "Assets/json/alerts.json";

        let requestAlert = new XMLHttpRequest();
        requestAlert.open('GET', requestURL);
        requestAlert.responseType = 'json';
        requestAlert.send();

        requestAlert.onload = function() {
            let responseData = requestAlert.response;
            dataA = responseData;
            console.log('dataA :>> ', dataA);
            if (tempOut > 35) {
                notie.alert({ type: 3, text: 'Extérieur : ' + dataA['outside']['>35'], time: 4 });
            } else if (tempOut < 0) {
                notie.alert({ type: 2, text: 'Extérieur : ' + dataA['outside']['<0'], time: 4 });
            } else {
                notie.alert({ type: 1, text: 'Extérieur : ' + dataA['outside']['normal'], time: 4 });
            }
        }


    } else {
        if (tempOut > 35) {
            notie.alert({ type: 3, text: 'Extérieur : ' + dataA['outside']['>35'], time: 4 });
        } else if (tempOut < 0) {
            notie.alert({ type: 2, text: 'Extérieur : ' + dataA['outside']['<0'], time: 4 });
        } else {
            notie.alert({ type: 1, text: 'Extérieur : ' + dataA['outside']['normal'], time: 4 });
        }
    }
}


function loadAlertInside(e) {

    if (dataA == undefined) {
        let requestURL = "Assets/json/alerts.json";

        let requestAlert = new XMLHttpRequest();
        requestAlert.open('GET', requestURL);
        requestAlert.responseType = 'json';
        requestAlert.send();

        requestAlert.onload = function() {
            let responseData = requestAlert.response;
            dataA = responseData;

            if (tempIn > 50) {
                notie.alert({ type: 3, text: 'Intérieur : ' + dataA['inside']['>50'], time: 4 });
            } else if (tempIn > 22) {
                notie.alert({ type: 2, text: 'Intérieur : ' + dataA['inside']['>22'], time: 4 });
            } else if (tempIn < 0) {
                notie.alert({ type: 4, text: 'Intérieur : ' + dataA['inside']['<0'], time: 4 });
            } else if (tempIn < 12) {
                notie.alert({ type: 4, text: 'Intérieur : ' + dataA['inside']['<12'], time: 4 });
            } else {
                notie.alert({ type: 1, text: 'Intérieur : ' + dataA['inside']['normal'], time: 4 });
            }
        }


    } else {
        if (tempIn > 50) {
            notie.alert({ type: 3, text: 'Intérieur : ' + dataA['inside']['>50'], time: 4 });
        } else if (tempIn > 22) {
            notie.alert({ type: 2, text: 'Intérieur : ' + dataA['inside']['>22'], time: 4 });
        } else if (tempIn < 0) {
            notie.alert({ type: 4, text: 'Intérieur : ' + dataA['inside']['<0'], time: 4 });
        } else if (tempIn < 12) {
            notie.alert({ type: 4, text: 'Intérieur : ' + dataA['inside']['<12'], time: 4 });
        } else {
            notie.alert({ type: 1, text: 'Intérieur : ' + dataA['inside']['normal'], time: 4 });
        }
    }
}


function loadSettings(e) {

    console.log('dataW :>> ', dataS);
    if (dataS == undefined) {
        let requestURL = "Assets/json/settings.json";

        let requestSet = new XMLHttpRequest();
        requestSet.open('GET', requestURL);
        requestSet.responseType = 'json';
        requestSet.send();

        requestSet.onload = function() {
            let responseData = requestSet.response;
            dataS = responseData;
            console.log('dataS :>> ', dataS);


            let divAccount = document.querySelector(".settings_panel :nth-child(2)");
            let divSettings = document.querySelector(".settings_panel :nth-child(1)");

            let name = document.createElement('p');
            let email = document.createElement('p');
            let password = document.createElement('p');

            let night_mode = document.createElement('p');
            let langage = document.createElement('p');
            let unit = document.createElement('p');
            let contact_support = document.createElement('p');

            name.textContent = dataS['accountinfo']['name'];
            email.textContent = dataS['accountinfo']['email'];
            password.textContent = dataS['accountinfo']['password'];

            night_mode.textContent = "Mode nuit :  " + dataS['settings']['night_mode'];
            langage.textContent = "Langue :  " + dataS['settings']['langage'];
            unit.textContent = "Unité :  " + dataS['settings']['unit'];
            contact_support.textContent = "Contact :  " + dataS['settings']['contact_support'];

            divAccount.appendChild(name);
            divAccount.appendChild(email);
            divAccount.appendChild(password);

            divSettings.appendChild(night_mode);
            divSettings.appendChild(langage);
            divSettings.appendChild(unit);
            divSettings.appendChild(contact_support);

        }
    }
}