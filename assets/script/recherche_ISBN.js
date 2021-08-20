// INITIALISATION DES VARIABLES
// ISBN : XXX - X - XXXX - XXXX - X
var rechercherBtn = document.querySelector("#rechercher");
var divResult = document.querySelector("#results");
var rechercheEx = document.querySelector("#isbnCherche");
var choixAjoutDiv = document.querySelector("#choixAjout");
var btnAjoutBdOk = document.querySelector("#AjoutBdOk");
/* REGEX ISBN */
const REGEXPISBN = /^\d+$/;

// EVENTLISTENER

rechercherBtn.addEventListener("click", clickRecherche);
btnAjoutBdOk.addEventListener("click", mouvAjoutBd);

// FONCTIONS
/**
 * Permet de clear le local-storage et d'engager une nouvelle recherche
 */
/**
 * Permet de controler la saisie du numero ISBN
 * @param {boolean} bool flag permettant de savoir si la recherche est valable 
 * @param {number} nbr représente le nombre saisie dans le recherche ISBN
 * @returns 
 */
function controleSaisie(bool, nbr){
    do {
        if (nbr == ""){
            alert("Veuillez remplir le champ recherche");
            break;
        }
        else if(!REGEXPISBN.test(nbr)){
            alert("Saisie incorrecte : merci de ne saisir que des nombres");
            document.querySelector('#isbnCherche').value = "";
            break;
        }
        else {
            bool = true;
        }
    }
    while(bool==false);
    return bool;
}
/**
 * Permet de lancer la recherche lorsque l'utilisateur clique sur le bouton rechercher
 */
 function clickRecherche() {
    var inputValue = parseInt(rechercheEx.value);
    var bFlag = false;

    bFlag = controleSaisie(bFlag, inputValue);

    if(bFlag == true){
        divResult.innerHTML = "";
        rechercheMapAlbums(inputValue)
    }
}
/**
 * Lance la recherche de BD en fonction du numero ISBN saisi
 * @param {number} nbr représente le nombre saisie dans le recherche ISBN
 */
function rechercheMapAlbums(nbr){
    var compt = 0;

    for (var [isbn, album] of albums.entries()){
        var appel = album.isbn;
        if(appel.includes(nbr)){
            var titre = album.titre; 
            afficheResult(titre, isbn);
            compt++;
        }
    }
    if(compt == 0){
        divResult.innerHTML = 'Aucun résultat';
        choixAjoutDiv.className ="visible";
    }
}
function afficheResult(str, key){
    var newElement = document.createElement('ul');
    newElement.innerHTML = 
    "<li>" + str + "</li>";
    newElement.addEventListener("click", function() {clickResult(key)});
    divResult.appendChild(newElement);
}
function mouvAjoutBd(){

    localStorage.setItem('isbn',rechercheEx.value);

    window.location.href="ajouter_BD.html";
}
// Clique résultat pour redirection avec clé valeur dans url
function clickResult(cle) {
    localStorage.removeItem("isbn");
    localStorage.setItem('isbn',rechercheEx.value);
    window.location = "fiche_BD.html?var=" + cle;
}