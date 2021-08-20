// TO DO
// - Gérer code exemplaire


// INITIALISATION DES VARIABLES
var cle = localStorage.cle;

var titreP = document.querySelector("#titreBD");
var isbnP = document.querySelector("#isbn");
var imageBD = document.querySelector("#imgBD");
var btnValider = document.querySelector("#submit");
var btnAnnuler = document.querySelector("#abandon");
var codeInput = document.querySelector("#codeBD");
var etatSelect = document.querySelector("#etatExemplaire");

var titre;
var serie1;
// EVENTLISTENER
btnValider.addEventListener("click", validation);
btnAnnuler.addEventListener("click", annulation);

// FONCTIONS
(function(){
    for(var[key, album] of albums.entries()){
        if(cle == key){
            titre = album.titre;
            number = album.numero;
            var idSerie = album.idSerie;
            titreP.innerHTML = titre;
            isbnP.innerHTML = album.isbn;
        }
        for(var[key, serie] of series){
            if(idSerie==key){
                serie1 = serie.nom;

            }
        }
    }
    imageBD.setAttribute("src", 'assets/image/albums/'+ serie1 + "-" + number + "-" + titre + ".jpg"); 

})();
function validation(){
    if(codeInput.value !="" && etatSelect.selectedIndex != 0){
        alert("Votre exemplaire a été ajouté avec succès");
        window.location.href="recherche_ISBN.html";
    }
    else{
        alert("Veuillez saisir un code exemplaire et un état svp");
    }
}
function annulation(){
    window.location.href="recherche_ISBN.html";
}