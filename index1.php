<?php
$action = "connexion";
if(isset($_GET["action"])) {
    $action = $_GET["action"];
}
switch ($action) {
    // page de connexion
    case "connexion":
        require("assets/vues/view_connexion.php");
        break;

    // page d'accueil avec menu dynamique une fois connecté
    case "cptAccueil":
        require("assets/vues/view_cpt_accueil.php");
        break;

    // page de recherche d'une BD
    case "rechercheBD":
        $titreForm = "Rechercher une BD";
        require("assets/vues/view_recherche_ISBN.php");
        break;

    // page d'ajout d'une BD
    case "addBD":
        require("assets/vues/view_ajouter_BD.php");
        break;

    // page d'ajout d'un Exemplaire
    case "addExp":
        require("assets/vues/view_ajouter_exemplaire.php");
        break;

    // page de création d'adhérent
    case "createAdh":
        require("assets/vues/view_creer_adherent.php");
        break;

    // page de fiche d'adhérent
    case "ficheAdh":
        require("assets/vues/view_fiche_adherent.php");
        break;

    // page de fiche de BD
    case "ficheBD":
        require("assets/vues/view_fiche_BD.php");
        break;
        
    case "gestAdh":
        require("assets/vues/view_gestion_adherent.php");
        break;
    case "modifAdh":
        require("assets/vues/view_modifier_adherent.php");
        break;
    case "supprimBD":
        
        break;
    case "rechercheAdh":
        require("assets/vues/view_recherche_adherent.php");
        break;
    
}
?>