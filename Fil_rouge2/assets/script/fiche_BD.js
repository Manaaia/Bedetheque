// TODO
// - Gérer le cas de codes exemplaire
// - Gérer les emplacements


// INITIALISATION DES VARIABLES
var cle = localStorage.cle;
var isbnP = document.querySelector("#isbn");
var codeP = document.querySelector("#codeBD");
var titreP = document.querySelector("#titreBD");
var etatP = document.querySelector("#etatBD");
var emplacementP = document.querySelector('#emplacementBD');
var auteurP = document.querySelector("#selectAuteur");
var serieP = document.querySelector("#selectSerie");
var bibliP = document.querySelector("#biblioExemplaire");
var imageBD = document.querySelector("#imgBD");
var btnModifier = document.querySelector("#modifierBD");
var btnAjouterExemplaire = document.querySelector("#ajouterExemplaire");

// EVENTLISTENER
btnModifier.addEventListener("click", modifierBD);
btnAjouterExemplaire.addEventListener("click", ajouterExemplaire);

// FONCTIONS
(function(){
    var serie1 = "";
    var titre = "";
    
    isbnP.innerHTML=cle;
    for(var[key, album] of albums.entries()){
        if(cle==key){
            codeP.innerHTML="0000";
            titreP.innerHTML = album.titre;
            isbnP.innerHTML = album.isbn;
            var titre = album.titre;
            var idAuteur = album.idAuteur;
            var idSerie = album.idSerie;
            etatP.innerHTML = album.etat;
            var idBibli = album.idBibli;
            emplacementP.innerHTML = "E00"
            var number = album.numero;

            for(var[key, auteur] of auteurs){
                if(idAuteur==key){
                    auteurP.innerHTML = auteur.nom;
                }
            }
            for(var[key, serie] of series){
                if(idSerie==key){
                    serieP.innerHTML = serie.nom;
                    serie1 = serie.nom;

                }
            }
            for(var[key, biblio] of biblios){
                if(idBibli==key){
                    bibliP.innerHTML = biblio.nom;
                }
            }
        }
    }
    var lienImg = 'assets/image/albums/'+ serie1 + "-" + number + "-" + titre + ".jpg";
    
    lienImg = lienImg.replace("!", "");
    lienImg = lienImg.replace("\'", "");
    lienImg = lienImg.replace("\'", "");
    imageBD.setAttribute("src",  lienImg); 

})();
function modifierBD(){
    alert("Cette fonctionnalité arrive bientôt");
}
function ajouterExemplaire() {
    window.location.href= "ajouter_exemplaire.html";
}