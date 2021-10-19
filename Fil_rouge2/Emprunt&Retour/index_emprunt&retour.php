<?php

require_once 'Models/model_emprunt&retour.inc.php';

if(isset($_POST["idAdherent"])) {
    $idAdherent = $_POST["idAdherent"];
    $adherent = UserMgr::getUserById($idAdherent);
    $prenomAdherent = $adherent->getPrenomUser();
    $nomAdherent = $adherent->getNomUser();
}

$aBibli = bibliothequeMgr::getListBibli();
$checkEmprunt = checkEmpruntEnCours($idAdherent);

if ($checkEmprunt) {
    $aEmprunt = empruntMgr::getCurrentEmpruntsByUser($idAdherent);
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

require 'Views/view_emprunt&retour.php';
