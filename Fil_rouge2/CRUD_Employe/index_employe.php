<?php

require_once 'Models/model_employe.inc.php';

switch ($action) {
    case 'addEmploye' :
        if (isset( $_POST["nomEmploye"])) {
            $nomEmploye = $_POST["nomEmploye"];
            $prenomEmploye = $_POST["prenomEmploye"];
            $mdp = $_POST["mdp"];
            $adresse1 = $_POST["adresse1"];
            $adresse2 = $_POST["adresse2"];
            $cp = $_POST["cp"];
            $ville = $_POST["ville"];
            $roleEmploye = $_POST["roleEmploye"];
            $addMessage = addEmploye($_POST);
        } else {
            $nomEmploye = "";
            $prenomEmploye = "";
            $mdp = "";
            $adresse1 = "";
            $adresse2 = "";
            $cp = "";
            $ville = "";
            $roleEmploye = "";
        }
        require 'Views/view_addEmploye.php';
        break;

    case 'searchEmploye' :
        if (isset($_POST["do"])) {
            $delMessage = deleteEmploye($_POST["idEmploye"]);
        }
        if (isset($_POST["nomCherche"])) {
            $nomCherche = $_POST["nomCherche"];
            $aNomCherche = getListEmployes($nomCherche);
        }
        require 'Views/view_searchEmploye.php';
        break;

    case 'displayEmploye' :
        $nom = afficheNom($user);
        $prenom = affichePrenom($user);
        $adresse = afficheAdresse($user);
        $role = afficheRole($user);
        require 'Views/view_displayEmploye.php';
        break;

    case 'modifyEmploye' :
        if (isset( $_POST["newNom"])) {
            $modMessage = updateEmploye();
        }
        if (isset($_POST["idEmploye"])) {
            $idEmploye = $_POST["idEmploye"];
            $employe = UserMgr::getUserById($idEmploye);
        }
        $nom = afficheNom($employe);
        $prenom = affichePrenom($employe);
        $adresse = afficheAdresse($employe);
        $aAdress = explode("<br/>",$adresse);
        $nEtRue = $aAdress[0];
        if (count($aAdress) == 4) {
            $adresse2 = $aAdress[1];
            $cp = $aAdress[2];
            $ville = $aAdress[3];
        } else {
            $cp = $aAdress[1];
            $ville = $aAdress[2];
        }
        $role = $employe->getIdRole();
        require 'Views/view_modifyEmploye.php';
        break;
}