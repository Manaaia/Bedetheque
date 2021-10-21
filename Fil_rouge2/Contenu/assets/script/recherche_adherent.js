// Recherche adhérent
// Initialisation des variables
var rechercherBtn = document.getElementById("rechercher");
var divResult = document.getElementById("results");
var inputRecherche = document.getElementById("nomcherche");
var alerte = document.getElementById("alerte");
const REGEXPA = /^[a-zA-ZÀ-ÿ-]*$/;


inputRecherche.addEventListener("keyup", function controleSaisieLettre() {
    let bool = false;

    do {
        if (!REGEXPA.test(inputRecherche.value)) {
            inputRecherche.value = inputRecherche.value.slice(0, -1);
            alerte.innerHTML = "Saisie incorrecte : merci de ne saisir que des lettres ou des tirets.";
            alerte.className = "alerte visible";
            break;
        } else {
            alerte.className = "alerte invisible";
            bool = true;
        }
    } while (bool == false);
});