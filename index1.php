<?php
$action = "connexion";
if(isset($_GET["action"])) {
    $action = $_GET["action"];
}
switch ($action) {
    case "connexion":
        require("assets/vues/view_connexion.php");
        break;
    case "cptAccueil":
        require("assets/vues/view_cpt_accueil.php");
        break;
    case "rechercheBD":
        require("assets/vues/view_recherche_ISBN.php");
        break;
    case "addBD":
        require("assets/vues/view_ajouter_BD.php");
        break;
    case "addExp":
        require("assets/vues/view_ajouter_exemplaire.php");
        break;
    case "createAdh":
        require("assets/vues/view_creer_adherent.php");
        break;
    case "ficheAdh":
        require("assets/vues/view_fiche_adherent.php");
        break;
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