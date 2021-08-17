// INITIALISATION DES VARIABLES
setTimeout(function(){
    var headerDiv = document.querySelector("#header-div");
    var mainMenu = document.querySelector("#main-menu");
    var navBibliothecaire = document.querySelector("#nav-bibliothecaire");
    var navGestionnaire = document.querySelector("#nav-gestionnaire");
    var navResponsable = document.querySelector("#nav-responsable");
    var navAdherent = document.querySelector("#nav-adherent")

    var idText = document.querySelector("#identification");

    var btnConnexion = document.querySelector("#connexion");
    var btnDeconnexion = document.querySelector("#deconnexion");
    
    var role = localStorage.role;
    var id = localStorage.id;
    //EVENT LISTENERS
    btnConnexion.addEventListener("click", connexionMouv);
    btnDeconnexion.addEventListener("click",deconnexionMouv);

    //FONCTIONS
    switch(role){
        case "1" :
            headerDiv.className = "visible";
            mainMenu.className = "visible";
            btnConnexion.className = "invisible";
            btnDeconnexion.className = "visible";

            navBibliothecaire.className = "visible";

            identification();
            console.log('bibliothéquaire');
            break
        case "2" :
            headerDiv.className = "visible";
            mainMenu.className = "visible";
            btnConnexion.className = "invisible";
            btnDeconnexion.className = "visible";

            navGestionnaire.className ="visible";
            
            identification();
            console.log('gestionnaire de fond');
            break
        case "3" :
            headerDiv.className = "visible";
            mainMenu.className = "visible";
            btnConnexion.className = "invisible";
            btnDeconnexion.className = "visible";

            navAdherent.className ="visible";

            identification();
            console.log('adhérent');
            break
        case "4" :
            headerDiv.className = "visible";
            mainMenu.className = "visible";
            btnConnexion.className = "invisible";
            btnDeconnexion.className = "visible";

            navResponsable.className ="visible";

            identification();
            console.log('responsable');
            break
        default:
            console.log("il ne se passe rien");
    }

    //FONCTIONS
    /**
     * Permet de formater l'identifiant avant de l'afficher sur le header
     */
    function identification(){
        var idPrenomNom = id.split(".");

        idPrenomNom[0] = idPrenomNom[0][0].toUpperCase()+idPrenomNom[0].slice(1);
        idPrenomNom[1] = idPrenomNom[1][0].toUpperCase()+idPrenomNom[1].slice(1);
        var PrenomNom = idPrenomNom.join(' ');


        idText.innerHTML = "Hi " + PrenomNom + " !";
        idText.className = "visible";
    }
},50)

// FONCTIONS
function connexionMouv(){
    window.location.href = "connexion.html";
}
function deconnexionMouv(){
    localStorage.clear();
    window.location.reload();
}

