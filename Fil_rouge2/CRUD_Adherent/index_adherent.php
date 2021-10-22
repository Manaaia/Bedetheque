<?php

require_once 'Models/model_adherent.inc.php';
require_once 'Emprunt&Retour/Models/model_emprunt&retour.inc.php';

switch ($action) {
    case 'addAdherent' :
        if (isset($_POST["nomAdherent"])) {
            $nomAdherent = $_POST["nomAdherent"];
            $prenomAdherent = $_POST["prenomAdherent"];
            $mdp = $_POST["mdp"];
            $adresse1 = $_POST["adresse1"];
            $adresse2 = $_POST["adresse2"];
            $cp = $_POST["cp"];
            $ville = $_POST["ville"];
            $dateCo = $_POST["dateCo"];
            $addMessage = addAdherent($_POST);
        } else {
            $nomAdherent = "";
            $prenomAdherent = "";
            $mdp = "";
            $adresse1 = "";
            $adresse2 = "";
            $cp = "";
            $ville = "";
            $dateCo = "";
        }
        require 'Views/view_addAdherent.php';
        break;

    case 'searchAdherent' :
        if (isset($_POST["do"])) {
            $delMessage = deleteAdherent($_POST["idAdherent"]);
            echo $delMessage;
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
        $idUser = $user->getIdUser();
        $checkEmprunt = checkEmpruntEnCours($idUser);

        if ($checkEmprunt) {
            $aEmprunt = EmpruntMgr::getCurrentEmpruntsByUser($idUser);
            $aAlbums = array();
            foreach($aEmprunt as $emprunt) {
                $exemplaire = ExemplaireMgr::getExemplaireById($emprunt['ID_exemplaire']);
                $aAlbums[] = $exemplaire->getISBN();
            }
            $aBD = array();
            foreach($aAlbums as $album) {
                $bd = BDMgr::searchBDByISBN($album);
                $aBD[] = $bd;
            }
        }
        require 'Views/view_displayAdherent.php';
        break;

    case 'modifyAdherent' :
        if (isset( $_POST["newNom"])) {
            $modMessage = updateAdherent();
        }
        if (isset($_POST["idAdherent"])) {
            $idAdherent = $_POST["idAdherent"];
            $adherent = UserMgr::getUserById($idAdherent);
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
        $checkEmprunt = checkEmpruntEnCours($idAdherent);

        if ($checkEmprunt) {
            $aEmprunt = EmpruntMgr::getCurrentEmpruntsByUser($idAdherent);
            $aAlbums = array();
            foreach($aEmprunt as $emprunt) {
                $exemplaire = ExemplaireMgr::getExemplaireById($emprunt['ID_exemplaire']);
                $aAlbums[] = $exemplaire->getISBN();
            }
            $aBD = array();
            foreach($aAlbums as $album) {
                $bd = BDMgr::searchBDByISBN($album);
                $aBD[] = $bd;
            }
        }
        require 'Views/view_modifyAdherent.php';
        break;
        
}