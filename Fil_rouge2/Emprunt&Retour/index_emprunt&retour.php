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
    $aExemplaire = array();
    foreach($aEmprunt as $emprunt) {
        $exemplaire = ExemplaireMgr::getExemplaireById($emprunt['ID_exemplaire']);
        $aExemplaires[] = $exemplaire;
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
        $code1 = $_POST["code1"];
        $idBibli = $_POST["bibli"];
        if($code1) {
            $check1 = checkEmpruntPossible($code1,$idBibli);
            if ($check1) {
                $exemplaire = getExemplaire($code1,$idBibli);
                
                $checkEmpruntOK = addEmprunt($exemplaire,$idAdherent);
                echo $checkEmpruntOK;
            } else {
                $message = getMessage($code1,$idBibli);
                echo $message;
            }
        }
    // }
}

if(isset($_POST["code2"])) {
    $code2 = $_POST["code2"];
    $idBibli = $_POST["bibli"];
    if($code2) {
        $check2 = checkEmpruntPossible($code2,$idBibli);
        if ($check2) {
            $exemplaire = getExemplaire($code2,$idBibli);
            
            $checkEmpruntOK = addEmprunt($exemplaire,$idAdherent);
            echo $checkEmpruntOK;
        } else {
            $message = getMessage($code2,$idBibli);
            echo $message;
        }
    }
}

if(isset($_POST["code3"])) {
    $code3 = $_POST["code3"];
    $idBibli = $_POST["bibli"];
    if($code3) {
        $check3 = checkEmpruntPossible($code3,$idBibli);
        if ($check3) {
            $exemplaire = getExemplaire($code3,$idBibli);
            
            $checkEmpruntOK = addEmprunt($exemplaire,$idAdherent);
            echo $checkEmpruntOK;
        } else {
            $message = getMessage($code3,$idBibli);
            echo $message;
        }
    }
}

require 'Views/view_emprunt&retour.php';
