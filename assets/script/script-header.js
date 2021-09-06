$(document).ready(function() {

    let header = `
    <header>
        <div class="visible" id="header-div">
            <button id="back" class="invisible">Retour</button>
            <div id="main-menu" class="invisible">
                <button name="fond" id="fond" class ="btn-nav">Catalogue</button>
                <div id="nav-bibliothecaire" class="invisible">
                    <button id="nouvelAdherent">Nouvel adhérent</button>
                    <button id="gestionAdherent">Gestion adhérents</button>
                </div>
                <button name="nav-gestionnaire" id="nav-gestionnaire" class="invisible">Gestion du fond</button>
                <button name="nav-gestion-emp" id="nav-gestion-emp" class="invisible">Gestion des emplacements</button>
                <div id="nav-responsable" class="invisible">
                    <button id="stats">Statistiques</button>
                    <button id="BdEmprunt">BD empruntées</button>
                    <button id ="autresStats">Autres statistiques</button>
                </div>
                <button id="nav-adherent" class="invisible">Ma fiche adhérent</button>
            </div>
        </div>
        <!-- Compte placeholder-->
    </header>
    `

    let compte = `
    <div id="compte" class = "visible">
        <p id="identification" class="invisible"></p>     
        <button id="deconnexion" class="invisible">Se déconnecter</button>
        <button id="connexion" class="visible" >Se connecter</button>
    </div>
    `
    
    $('body').prepend(header);
    if (true) {
        $('header').append(compte);
    }

    console.log( "Load was performed." );

    // var headerDiv = document.querySelector("#header-div");
    var mainMenu = document.querySelector("#main-menu");
    var navBibliothecaire = document.querySelector("#nav-bibliothecaire");
    var navGestionnaire = document.querySelector("#nav-gestionnaire");
    var navResponsable = document.querySelector("#nav-responsable");
    var navAdherent = document.querySelector("#nav-adherent");
    var btnGestionAdherent = document.querySelector("#gestionAdherent");
    var btnNouvelAdherent = document.querySelector("#nouvelAdherent");
    var btnStats = document.querySelector("#stats");
    var btnBdEmprunt = document.querySelector("#BdEmprunt");
    var btnAutresStats = document.querySelector("#autresStats");
    var btnCatalogue = document.querySelector("#fond");

    var idText = document.querySelector("#identification");

    var btnConnexion = document.querySelector("#connexion");
    var btnDeconnexion = document.querySelector("#deconnexion");
    
    var role = localStorage.role;
    var id = localStorage.id;
    //EVENT LISTENERS
    btnConnexion.addEventListener("click", function(){mouv("1")});
    btnDeconnexion.addEventListener("click",function(){mouv("2")});
    btnGestionAdherent.addEventListener("click", function(){
        localStorage.removeItem("ISBN1");
        localStorage.removeItem("ISBN2");
        localStorage.removeItem("ISBN3");
        mouv("3")});
    btnNouvelAdherent.addEventListener("click", function(){mouv("4")});
    btnStats.addEventListener("click", function(){mouv("5")});
    btnBdEmprunt.addEventListener("click", function(){mouv("6")});
    btnAutresStats.addEventListener("click", function(){mouv("7")});
    navGestionnaire.addEventListener("click", function(){mouv("8")});
    btnCatalogue.addEventListener("click", function(){mouv("9")});
    navAdherent.addEventListener("click", function(){mouv("10")});


    //FONCTIONS

    function mouv (nbr) {
        var link = "";

        switch(nbr){
            case "1":
                link = "connexion.html";
                break;
            case "2":
                localStorage.removeItem('id');
                localStorage.removeItem('role');
                localStorage.removeItem('isbn');
                link="index.html";
                break;
            case "3":
                link="recherche_adherent.html";
                break;
            case "4":
                link="creer_adherent.html";
                break;
            case "5":
                alert("Cette fonctionnalité sera bientôt disponible");
                link="index.html"
                break;
            case "6":
                alert("Cette fonctionnalité sera bientôt disponible");
                link="index.html"
                break;
            case "7":
                alert("Cette fonctionnalité sera bientôt disponible");
                link="index.html"
                break;
            case "8":
                link="recherche_ISBN.html"
                break;
            case "9":
                link="index.html";
                break;
            case "10":
                link="fiche_adherent.html";
            default:
                console.log("erreur de redirection");     
        }
        console.log(link);
        window.location.href=link;
    }
    /**
     * Switch permettant de charger le header en fonction du rôle lors de la connexion
     */
    switch(role){
        case "1" :
            // headerDiv.className = "visible";
            mainMenu.className = "visible";
            btnConnexion.className = "invisible";
            btnDeconnexion.className = "visible";

            navBibliothecaire.className = "visible";

            identification();
            console.log('bibliothéquaire');
            break
        case "2" :
            // headerDiv.className = "visible";
            mainMenu.className = "visible";
            btnConnexion.className = "invisible";
            btnDeconnexion.className = "visible";

            navGestionnaire.className ="visible";
            
            identification();
            console.log('gestionnaire de fond');
            break
        case "3" :
            // headerDiv.className = "visible";
            mainMenu.className = "visible";
            btnConnexion.className = "invisible";
            btnDeconnexion.className = "visible";

            navAdherent.className ="visible";

            identification();
            console.log('adhérent');
            break
        case "4" :
            // headerDiv.className = "visible";
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
    // function connexionMouv(){
    //     window.location.href = "connexion.html";
    // }
    /**
     * Permet de déconnecter et de vider le localstorage des informations de connexion
     */
    function deconnexionMouv(){
    }

    // FOOTER A METTRE EN PLACE ? 
    // <footer>
    // <p>Manon et Amandine, les BG - 2021</p>
    // </footer>

    function test () {
        console.log("tesy");
    }
});
