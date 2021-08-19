// Programme principal
// Initialisation des variables
var inputslettre = document.getElementsByClassName("lettre");
var inputschiffre = document.getElementsByClassName("chiffre");
var btnabandon = document.getElementById("abandon");
var btnvalid = document.getElementById("submit");
var inputs = document.getElementsByTagName("input");
var selects = document.getElementsByTagName("select");

var alerte = document.getElementById("alertesaisie");

var inputImage = document.querySelector('#imageBD');
var previewImg = document.querySelector('#imgBD');

const REGEXPA = /^[a-zA-ZÀ-ÿ- ]*$/;
const REGEXP1 = /^[0-9]*$/;

 // EVENTS LISTENER
// inputImage.addEventListener("click",preview);

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
    window.location.reload();
}

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
        localStorage.setItem('input'+i,inputs[i.value]);
        alert("Nouvelle BD ajoutée");
        cleanChamps();

    }
    else {
        alerte.innerHTML = "Veuillez remplir tous les champs";
        alerte.className ="alerte visible";
    }

}
// fonction d'aperçu image

inputImage.onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        //charge les datas
        previewImg.src = e.target.result;

    };

    // lis l'url de du fichier
    reader.readAsDataURL(this.files[0]);
};

// fonction select auteur
var auteurSelect = document.querySelector('#selectAuteur');
var serieSelect = document.querySelector('#selectSerie');
var biblioSelect = document.querySelector("#biblioExemplaire");
var empSelect = document.querySelector("#emplacementBD");


(function affichageFormulaire(){
    // variables
    var bibli = "";
    // select auteurs
    for(var[nom, auteur] of auteurs.entries()){
        nom = auteur.nom;
        id = auteur.id;
        var newElement = document.createElement('option');
        newElement.innerHTML = "<option value ="+"'"+id+"'>"+nom+"</option>";
        auteurSelect.appendChild(newElement);
    }
    // select series
    for(var[nom, serie] of series.entries()){
        nom = serie.nom;
        id = serie.id;
        var newElement = document.createElement('option');
        newElement.innerHTML = "<option value ="+"'"+id+"'>"+nom+"</option>";
        serieSelect.appendChild(newElement);
    }
    // select bibliothèques
    for(var[nom, biblio] of biblios.entries()){
        nom = biblio.nom;
        bibli = biblio;
        var newElement = document.createElement('option');
        newElement.innerHTML = "<option value ="+"'"+bibli+"'>"+nom+"</option>";
        biblioSelect.appendChild(newElement);
    }
    biblioSelect.onchange = function () {
        var biblio = biblioSelect.selectedIndex;
        console.log(biblio);
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

