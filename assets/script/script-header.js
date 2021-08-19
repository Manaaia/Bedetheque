$(document).ready(function() {

    let header = `
    <header>
        <div class="visible" id="header-div">
            <button id="back" class="invisible">Retour</button>
                <h1 class="invisible">Centre culturel des Marmusots</h1>
            <div id="main-menu" class="invisible">
                <button name="fond" id="fond" class ="btn-nav">
                    Catalogue
                </button>
                <select name="nav-bibliothecaire" id="nav-bibliothecaire" class="invisible">
                    <option value="Gestion adhérents" disabled selected>Gestion adhérents</option>
                    <option value="Nouvel adhérent">Nouvel adhérent</option>
                    <option value="Gestion compte">Gestion compte</option>
                </select>
                <select name="nav-gestionnaire" id="nav-gestionnaire" class="invisible">
                    <option value="Gestion du fond" disabled selected>Gestion du fond</option>
                    <option value="Ajouter une BD">Ajouter une BD</option>
                    <option value="Rechercher une BD">Rechercher une BD</option>
                </select>
                <select name="nav-gestion-emp" id="nav-gestion-emp" class="invisible">
                    <option value="Gestion des emplacements" disabled selected>Gestion des emplacements</option>
                </select>
                <select name="nav-responsable" id="nav-responsable" class="invisible">
                    <option value="Statistiques" disabled selected>Statistiques</option>
                    <option value="BD empruntées">BD empruntées</option>
                    <option value="Autres statistiques">Autres statistiques</option>
                </select>
                <button id="nav-adherent" class="invisible">
                    Ma fiche adhérent
                </button>
            </div>
        </div>
        <!-- Compte placeholder-->
    </header>
    `

    let compte = `
    <div id="compte" class = "visible">
        <p id="identification" class="invisible"></p>     
        <button id="deconnexion" class="invisible">Se déconnecter</button>
        <button id="connexion" class="invisible" >Se connecter</button>
    </div>
    `
    
    $('body').prepend(header);
    if (true) {
        $('header').append(compte);
    }

    console.log( "Load was performed." );

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
    /**
     * Switch permettant de charger le header en fonction du rôle lors de la connexion
     */
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
    /**
     * Permet d'accéder à la page de connexion via  le bouton connecter
     */
    function connexionMouv(){
        window.location.href = "connexion.html";
    }
    /**
     * Permet de déconnecter et de vider le localstorage des informations de connexion
     */
    function deconnexionMouv(){
        localStorage.removeItem('id');
        localStorage.removeItem('role');
        window.location.reload();
    }

    // FOOTER A METTRE EN PLACE ? 
    // <footer>
    // <p>Manon et Amandine, les BG - 2021</p>
    // </footer>

});
