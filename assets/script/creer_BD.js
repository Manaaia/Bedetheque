
// TODO
// -transformer les saisies en une fiche une fois le clique sur valider
// -récupérer l'image rentrée dans le local storage
// -ajouter la possibilité d'ajouter un auteur et une série quand celui-ci n'est pas dans la liste
// -proposer cette recherche en tapant des lettres (meilleur UX, gain de temps)

// Programme principal
// Initialisation des variables
var inputslettre = document.getElementsByClassName("lettre");
var inputschiffre = document.getElementsByClassName("chiffre");
var btnabandon = document.getElementById("abandon");
var btnvalid = document.getElementById("submit");
var inputs = document.getElementsByTagName("input");
var selects = document.getElementsByTagName("select");

var isbnInput=document.querySelector("#isnbTap");


var alerte = document.getElementById("alertesaisie");

var inputImage = document.querySelector('#imageBD');
var previewImg = document.querySelector('#imgBD');

const REGEXPA = /^[a-zA-ZÀ-ÿ- ]*$/;
const REGEXP1 = /^[0-9]*$/;

 // EVENTS LISTENER

btnabandon.addEventListener("click", cleanChamps);
btnvalid.addEventListener("click", checkForm);

// FONCTION
/**
 * Permet de controler la saisie des utilisateurs au moment où ils font une saisie dans les
 */
(function(){

    isbnInput.value = localStorage.isbn;

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
})();

/**
 * Permet de recharger la page et de vider les champs remplis
 */
function cleanChamps() {
    window.location.reload();
}
/**
 * Permet de vérifier que les champs obligatoires ne sont pas vides
 */
function checkForm() {

    var compt = 0;
    for (let i = 0; i < inputs.length; i++) {
        if(inputs[i].value == "") {
            compt ++;
        }
    }
    for (let i = 0; i < selects.length; i++) {
        if(selects[i].selectedIndex == 0 ) {
            compt ++;
        }
    }
    
    if(compt == 0){

        alert("Nouvelle BD ajoutée");
        console.log("isbn : "+isbnInput.value+",\ncodeBD :"+querySelector("#codeBD").value+",\ntitre :"+document.querySelector("#titreBD").value+",\nidAuteur:"+document.querySelector('#selectAuteur').selectedIndex+",\nidSerie:"+document.querySelector('#selectSerie').selectedIndex+",\netat"+document.querySelector('#etatBD').selectedIndex+",\commentaire:"+"blabla"+",\nbibliothèque:"+document.querySelector('#biblioExemplaire').selectedIndex+",\nemplacement:"+document.querySelector('#emplacementBD').selectedIndex+",\nresume:"+"blabla2")
        localStorage.setItem("isbn",isbnInput.value);
        cleanChamps();

    }
    else {
        alerte.innerHTML = "Veuillez remplir tous les champs";
        alerte.className ="alerte visible";
    }



}
// APERCU IMAGE
/**
 * Permet de charger dynamiquement un aperçu de l'image choisi par l'utilisateur pour illustrer la couverture de la BD entrée
 */

inputImage.onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        //charge les datas
        previewImg.src = e.target.result;

        localStorage.setItem("urlImg", e.target.result);


    };

    // lis l'url de du fichier
    reader.readAsDataURL(this.files[0]);
};

/**
 * Permet de charger dynamiquement le contenu des select de se formulaire
 */
(function affichageFormulaire(){
    // INITIALISATION DES VAIRABLES
    var bibli = "";
    var auteurSelect = document.querySelector('#selectAuteur');
    var serieSelect = document.querySelector('#selectSerie');
    var biblioSelect = document.querySelector("#biblioExemplaire");
    var empSelect = document.querySelector("#emplacementBD");

    // CHARGEMENT DU SELECT AUTEUR

    for(var[nom, auteur] of auteurs.entries()){
        nom = auteur.nom;
        id = auteur.id;
        var newElement = document.createElement('option');
        newElement.innerHTML = "<option value ="+"'"+id+"'>"+nom+"</option>";
        auteurSelect.appendChild(newElement);
    }

    // CHARGEMENT DU SELECT SERIE

    for(var[nom, serie] of series.entries()){
        nom = serie.nom;
        id = serie.id;
        var newElement = document.createElement('option');
        newElement.innerHTML = "<option value ="+"'"+id+"'>"+nom+"</option>";
        serieSelect.appendChild(newElement);
    }

    // CHARGEMENT DU SELECT BIBLIOTHEQUE

    for(var[nom, biblio] of biblios.entries()){
        nom = biblio.nom;
        bibli = biblio;
        var newElement = document.createElement('option');
        newElement.innerHTML = "<option value ="+"'"+bibli+"'>"+nom+"</option>";
        biblioSelect.appendChild(newElement);
    }

    // CHARGEMENT DU SELECT EMPLACEMENT
    //ce code ne se déclenche qu'en cas de changement sur le select bibliothèque
    biblioSelect.onchange = function () {
        var biblio = biblioSelect.selectedIndex;
        empSelect.options.length=1;


        for(var[code,emplacement] of emplacements.entries()){
            code = emplacement.code;
            idBiblio = emplacement.idBibli;
            if(idBiblio == biblio){
                var newElement = document.createElement('option');
                newElement.innerHTML = "<option value ="+"'"+idBiblio+"'>"+code+"</option>";
                empSelect.appendChild(newElement);
            }
    }
    
    }
})();

