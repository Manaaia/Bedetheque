// INITIALISATION DES VARIABLES
var btnConnect = document.querySelector("#connexion");


//EVENTLISTENER
var connect = btnConnect.addEventListener("click", connexionMouv);

// FONCTIONS
function connexionMouv(){
    window.location.href = "connexion.html";
}