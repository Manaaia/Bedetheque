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

if(isset($_POST["code1"])) {
    // for ($i = 1; $i < 4 ; $i++) {
        $code = $_POST["code1"];
        $idBibli = $_POST["bibli"];
        if($code) {
            $check = checkEmpruntPossible($code,$idBibli);
            if ($check) {
                $exemplaire = getExemplaire($code,$idBibli);
                
                $checkEmpruntOK = addEmprunt($exemplaire,$idAdherent);
                echo $checkEmpruntOK;
            } else {
                $message = getMessage($code,$idBibli);
                echo $message;
            }
        }
    // }
    // $code2 = $_POST["code2"];
    // $exemplaire2 = getExemplaire($code2);
    // $code3 = $_POST["code3"];
    // $exemplaire3 = getExemplaire($code3);

}

require 'Views/view_emprunt&retour.php';
