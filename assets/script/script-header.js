$(document).ready(function() {


    let header = `
    <header>
        <div class="invisible" id="header-div">
            <button id="back" class="invisible">Retour</button>
                <h1 class="invisible">Centre culturel des Marmusots</h1>
            <div id="main-menu" class="invisible">
                <select name="fond" id="fond">
                    <option value="Catalogue" disabled selected>Catalogue</option>
                </select>
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
            </div>
        </div>
        <!-- Compte placeholder-->
    </header>
    `

    let compte = `
    <div id="compte" class = "visible">
        <p id="identification" class="invisible">Bonjour Testitest !</p>      <!--Attention enlever Testitest-->
        <select name="nav" id="nav-adherent" class="invisible">
            <option value="" disabled selected>Mon compte</option>
            <option value="mafiche">Ma fiche adhérent</option>
        </select>
        <button id="deconnexion" class="invisible">Se déconnecter</button>
        <button id="connexion" class="visible" >Se connecter</button>
    </div>
    `
    
    $('body').prepend(header);
    if (true) {
        $('header').append(compte);
    }

    console.log( "Load was performed." );

});
