// Programme principal
// Initialisation des variables
var cle = localStorage.getItem("id");

for (var [idUser, user] of users.entries()) {
    if (user.idA == cle) {
        cle =idUser;
    }
}

var casenom = document.getElementById("nomadh");
var caseprenom = document.getElementById("prenomadh");
var caseadress = document.getElementById("adresseadherent");
var caseaffdatecot = document.getElementById("affdatecot");
var caseemprunt = document.getElementById("emprunt");
var caseamende = document.getElementById("amende");
var id = users.get(cle).idA.split(".");
var prenom = id[0][0].toUpperCase()+id[0].slice(1);
var nom = id[1][0].toUpperCase()+id[1].slice(1);
var adress = users.get(cle).adress.split("_");
var datecot = users.get(cle).datecot.split("-");
datecot = datecot[2] + "/" + datecot[1] + "/" + datecot[0];
var rue = adress[1].split("%");
rue = rue.join(" ");
adress = adress[0] + " " + rue + "<br/>" + adress[2] + "<br/>" + adress[3];

// Affichage automatique via clé local storage
caseprenom.innerHTML = prenom;
casenom.innerHTML = nom;
caseadress.innerHTML = adress;
caseaffdatecot.innerHTML = datecot;

affEmprunt();

//Fonctions
function affEmprunt() {
    var compt = 0;
    for (var [identifiant, emprunt] of emprunts.entries()) {
        if (emprunt.identifiant == users.get(cle).idA) {
            caseemprunt.innerHTML += emprunt.album.titre + "<br/>";
            caseemprunt.className = "visible";
            compt ++;
        }
    }

    if (compt == 0) {
        caseemprunt.innerHTML = "Aucun emprunt en cours";
        caseemprunt.className = "visible";
    }
}