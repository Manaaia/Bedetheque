// INITIALISATION DES VARIABLES
var btnConnexion = document.querySelector("#btnConnexion");
var idConnect = document.querySelector("#user-name");
var mdpConnect = document.querySelector("#password");


// EVENTLISTENER
var submit = btnConnexion.addEventListener('click',submit);

// FONCTIONS
function submit () {

    // VERIFIER IDENTIFIANT ET MOT DE PASSE

        // INITIALISATION DES FONCTIONS
        var mdp;
        var id;
        var bFlag = false;
        var bFalse = false;
    // VERIFIER QUE L'IDENTIFIANT EXIXSTE DANS LA MAP USERS
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
    // console.log(localStorage)
        }
    }

    // ALERT EN CAS DE MAUVAIS MOT DE PASSE OU MAUVAIS IDENTIFIANT

    if (bFalse == true){
        alert("Identifiant ou mot de passe invalide");
    }

    // REDIRIGER VERS LA BONNE PAGE EN FONCTION DU ROLE
    directionConnexion(role);
console.log(localStorage);
}

// FONCTIONS

function directionConnexion (nbr) {
    console.log(nbr);
    switch (nbr){
        case 1 : 
console.log("Waou, vous êtes un.e bibliothéquaire");
            window.location.href = "C:/Users/21041626/Desktop/BDtheque_AFPA/creer_adherent.html";
            break;
        case 2 :
console.log("Waou, vous êtes un.e gestionnaire de fond");
window.location.href = "C:/Users/21041626/Desktop/BDtheque_AFPA/ajouter_exemplaire.html";

            break;
        case 3 :
console.log("Waou, vous êtes un.e adhérent.e");
window.location.href = "C:/Users/21041626/Desktop/BDtheque_AFPA/fiche_adherent.html";

            break;
        case 4 :
console.log("Waou, vous êtes un.e responsable");
window.location.href = "C:/Users/21041626/Desktop/BDtheque_AFPA/gestion_adherent.html";

            break;
        default:
console.log("T ki ?");
    }
}