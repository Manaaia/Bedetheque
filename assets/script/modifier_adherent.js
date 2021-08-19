// Programme principal
// Initialisation des variables
var cle = window.location.search;
cle = cle.split("=");
cle = cle[1];
var idBase = users.get(cle).idA;
var id = idBase.split(".");
var prenom = id[0][0].toUpperCase()+id[0].slice(1);
var nom = id[1][0].toUpperCase()+id[1].slice(1);
var caseprenom = document.getElementById("prenomadherent");
var casenom = document.getElementById("nomadherent");
var adress = users.get(cle).adress.split("_");
var datecot = users.get(cle).datecot;
var casenumero = document.getElementById("numero");
var caserue = document.getElementById("rue");
var casecode = document.getElementById("code");
var caseville = document.getElementById("ville");
var casedatecot = document.getElementById("datecot");
var rue = adress[1].split("%");
rue = rue.join(" ");
var btnvalider = document.getElementById("submit");
var btnabandonner = document.getElementById("abandon");
const REGEXPA = /^[a-zA-ZÀ-ÿ- ]*$/;
const REGEXP1 = /^[0-9]*$/;
var alerte = document.getElementById("alertesaisie");
var alertecot = document.getElementById("alertcot");

// Complétion des inputs automatique via clé valeur
caseprenom.value = prenom;
casenom.value = nom;
casenumero.value = adress[0];
caserue.value = rue;
casecode.value = adress[2];
caseville.value = adress[3];
casedatecot.value = datecot;

// Contrôle de saisie live
var inputslettre = document.getElementsByClassName("lettre");
var inputschiffre = document.getElementsByClassName("chiffre");

for (let i = 0; i < inputslettre.length; i++) {
    inputslettre[i].addEventListener("keyup", function controleSaisieLettre() {
        let bool = false;

        do {
            if (!REGEXPA.test(inputslettre[i].value)) {
                inputslettre[i].value = inputslettre[i].value.slice(0, -1);
                alerte.innerHTML = "Saisie incorrecte : merci de ne saisir que des lettres ou des tirets.";
                alerte.className = "alerte visible";
                break;
            } else {
                alerte.className = "alerte invisible";
                bool = true;
            }
        } while (bool == false);
    });
};

for (let i = 0; i < inputschiffre.length; i++) {
    inputschiffre[i].addEventListener("keyup", function controleSaisieChiffre() {
        let bool1 = false;
        
        do {
            if (!REGEXP1.test(inputschiffre[i].value)) {
                inputschiffre[i].value = inputschiffre[i].value.slice(0, -1);
                alerte.innerHTML = "Saisie incorrecte : merci de ne saisir que chiffres.";
                alerte.className = "alerte visible";
                break;
            } else {
                alerte.className = "alerte invisible";
                bool1 = true;
            }
        } while (bool1 == false);
    });
};

// Contrôle validité datecot
flag = checkDatecot(datecot);

if (flag == true) {
    alertecot.className = "alerte visible";
    casedatecot.setAttribute("style", "box-shadow : inset 1px 1px 3px 3px red");
}

// Contrôle amendes retard de retour


// Contrôle amendes pertes

// Gestion boutons
btnabandonner.addEventListener("click", retour);
btnvalider.addEventListener("click", function () {valide(idBase)});




// Fonctions
function valide(idcle) {
    var caseprenom = document.getElementById("prenomadherent");
    var casenom = document.getElementById("nomadherent");
    var checkprenom = caseprenom.value[0].toLowerCase()+caseprenom.value.slice(1);
    var checknom = casenom.value[0].toLowerCase()+casenom.value.slice(1);
    var checkId = checkprenom + "." + checknom;
    var flag = false;

    flag = verifDoublon(flag, checkId, idcle);

    if (flag == false) {
        alert("Formulaire enregistré.");
        window.location = "gestion_adherent.html?var=" + cle;
    } else {
        alert("Cet identifiant est déjà pris.");
    }
}

function retour() {
    window.location = "gestion_adherent.html?var=" + cle;
}