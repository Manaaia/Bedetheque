// Programme principal
// Initialisation des variables
var inputslettre = document.getElementsByClassName("lettre");
var inputschiffre = document.getElementsByClassName("chiffre");
var btnabandon = document.getElementById("abandon");
var btnvalid = document.getElementById("submit");
var inputs = document.getElementsByTagName("input");
var alerte = document.getElementById("alertesaisie");
const REGEXPA = /^[a-zA-ZÀ-ÿ- ]*$/;
const REGEXP1 = /^[0-9]*$/;

// Contrôle de saisie live
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

// Gestion boutons
btnabandon.addEventListener("click", cleanChamps);
btnvalid.addEventListener("click", checkForm);


// Fonctions
function cleanChamps() {
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].value = "";
    }
}

function checkForm() {
    var compt = 0;

    for (let i = 0; i < inputs.length; i++) {
        if(inputs[i].value = "") {
            alerte.innerHTML = "Veuillez remplir tous les champs";
            alerte.className ="alerte visible";
            compt ++;
        }
    }

    if (compt == 0) {
        alert("Nouvel adhérent créé");
        cleanChamps();
    }
}