<?php

require_once 'Models/model_adherent.inc.php';

// if (isset($_POST["dateCo"])) {
//     $newDateCo = $_POST["dateCo"];
//     $adherent->setDateCot($newDateCo);
// }

switch ($action) {
    case 'addAdherent' :
        require 'Views/view_addAdherent.php';
        break;

    case 'searchAdherent' :
        if (isset($_POST["nomCherche"])) {
            $nomCherche = $_POST["nomCherche"];
            $aNomCherche = getListAdherent($nomCherche);
            print_r($aNomCherche);
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
        if (isset($_POST["idAdherent"])) {
            $idAdherent = $_POST["idAdherent"];
            $adherent = UserMgr::getUserById($idAdherent);
            print_r($adherent);
        }
        $nom = afficheNom($adherent);
        echo $nom;
        $prenom = affichePrenom($adherent);
        $adresse = afficheAdresse($adherent);
        echo $adresse;
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

    case 'modifyAdherentUpdate' :


}