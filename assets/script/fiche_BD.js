// Programme principal
// Initialisation des variables
var casetitre = document.getElementById("titre");
var caseauteur = document.getElementById("auteur");
var casenumero = document.getElementById("numero");
var caseserie = document.getElementById("serie");
var casebibliotheque = document.getElementById("bibliotheque");
var caseemplacement = document.getElementById("emplacement");
var caseimg = document.getElementById("imgBD");
var btnRetour = document.getElementById("abandon");
var cle = window.location.search;
// Récupère la clé valeur url
cle = cle.split("=");
cle = cle[1];
var titre = albums.get(cle).titre;
var idAuteur = albums.get(cle).idAuteur;
var auteur = auteurs.get(idAuteur).nom;
var numero = albums.get(cle).numero;
var idSerie = albums.get(cle).idSerie;
var serie = series.get(idSerie).nom;
var idEmplacement = albums.get(cle).idEmplacement;
var emplacement = emplacements.get(idEmplacement).code;
var idBibliotheque = emplacements.get(idEmplacement).idBibli;
var bibliotheque = biblios.get(idBibliotheque).nom;
var img = 'assets/image/albums/' + serie + '-' + numero + '-' + titre + '.jpg';

        img = img.replace("!", "");
        img = img.replace("\'", "");
        img = img.replace("\'", "");

casetitre.innerHTML = titre;
caseauteur.innerHTML = auteur;
casenumero.innerHTML = numero;
caseserie.innerHTML = serie;
casebibliotheque.innerHTML = bibliotheque;
caseemplacement.innerHTML = emplacement;
caseimg.src = img;

btnRetour.addEventListener("click", redirectAcceuil);

// Fonctions
// Redirection Accueil
function redirectAcceuil() {
    window.location = "index.html";
}