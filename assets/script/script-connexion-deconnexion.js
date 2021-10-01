// INITIALISATION DES VARIABLES
var btnConnexion = document.querySelector("#btnConnexion");
var idConnect = document.querySelector("#user-name");
var mdpConnect = document.querySelector("#password");
var mdpOublie = document.querySelector("#mdpOublie");
var btnRetour = document.querySelector("#retour");

// EVENTLISTENER
var submit = btnConnexion.addEventListener('click',connexion);
var oublie = mdpOublie.addEventListener('click', nouveauMdp);
var retour = btnRetour.addEventListener('click', retourAcceuil);

// FONCTIONS
function retourAcceuil () {
    window.location.href = "index.html";
}

function connexion () {

    // VERIFIER IDENTIFIANT ET MOT DE PASSE

        // INITIALISATION DES FONCTIONS
        var mdp;
        var id;
        var bFlag = false;
        var bFalse = false;
        var role = 0;
        var bDirection = true;


        users.forEach(user => {
            if(user.idA != idConnect.value){
                bFalse = true;
            }
            else{
                id = user.idA;
                mdp = user.mdp;
                role = user.role;
                bFlag = true;
                bFalse=false;
            };
        })
    // VERIFIER SI LE MDP CORRESPOND A L'ID DANS LA MAP USERS
    // STOCKER LE ROLE DE L'IDENTIFIANT TROUVE AU LOCALSTORAGE POUR LA SUITE

    if (bFlag == true){
        if(mdpConnect.value != mdp){
            bFalse=true;
        }
        else{
            bFalse=false;
            localStorage.setItem("role", role);
            localStorage.setItem("id", id);
            bDirection = false;
    // console.log(localStorage)
        }
    }

    // ALERT EN CAS DE MAUVAIS MOT DE PASSE OU MAUVAIS IDENTIFIANT

    if (bFalse == true){
        alert("Identifiant ou mot de passe invalide");
    }

    // REDIRIGER VERS LA BONNE PAGE EN FONCTION DU ROLE
    directionConnexion(bDirection);
console.log(localStorage);
}

// FONCTIONS

function directionConnexion (bBool) {
    if(bBool == false){
        window.location.href = "index.html";
    }

}
/**
 * Gérer le cas du mot de passe oublié
 */
function nouveauMdp () {
    // ENVOYER UNE ALERTE
    alert("Veuillez vous rapprocher de l'un.e de nos bibliothécaires pour récupérer un nouveau mot de passe");
}