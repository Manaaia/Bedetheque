<?php

require_once 'Models/model_adherent.inc.php';

switch ($action) {
    case 'addAdherent' :
        if (isset( $_POST["nom"])) {
            echo "Check one";
            $addMessage = addAdherent($_POST);
            echo $addMessage;
        }
        require 'Views/view_addAdherent.php';
        break;

    case 'searchAdherent' :
        if (isset($_POST["do"])) {
            $delMessage = deleteAdherent($_POST["idAdherent"]);
        }
        if (isset($_POST["nomCherche"])) {
            $nomCherche = $_POST["nomCherche"];
            $aNomCherche = getListAdherent($nomCherche);
        }
        require 'Views/view_searchAdherent.php';
        break;

    case 'displayAdherent' :
        $nom = afficheNom($user);
        $prenom = affichePrenom($user);
        $adresse = afficheAdresse($user);
        $dateCo = afficheDateCo($user);
        $dateEndCo = afficheDateEndCo($dateCo);
        $interval = getInterval($dateEndCo);
        $checkDateCo = checkDateCo($dateCo);
        require 'Views/view_displayAdherent.php';
        break;

    case 'modifyAdherent' :
        if (isset( $_POST["newNom"])) {
            $modMessage = updateAdherent();
        }
        if (isset($_POST["idAdherent"])) {
            $idAdherent = $_POST["idAdherent"];
            $adherent = UserMgr::getUserById($idAdherent);
            print_r($adherent);
        }
        $nom = afficheNom($adherent);
        $prenom = affichePrenom($adherent);
        $adresse = afficheAdresse($adherent);
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
        $dateCo = afficheDateCo($adherent);
        $dateEndCo = afficheDateEndCo($dateCo);
        $interval = getInterval($dateEndCo);
        $checkDateCo = checkDateCo($dateCo);
        require 'Views/view_modifyAdherent.php';
        break;
        
}