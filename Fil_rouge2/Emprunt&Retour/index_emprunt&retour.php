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

if(isset($_POST["bibli"])) {
    $idBibli = $_POST["bibli"];
}

if(isset($_POST["code1"]) && $_POST["code1"] != "") {
    // for ($i = 1; $i < 4 ; $i++) {
        $code1 = $_POST["code1"];
        $checkSyntaxe1 = checkSyntaxe($code1);
        if(!$checkSyntaxe1) {
            $message1 = "Syntaxe inccorecte : L'ISBN est un code à 13 chiffres";
        } else {
            $checkIfExists = checkIfExists($code1);
            if(!$checkIfExists) {
                $message1 = "Aucun album trouvé avec cet ISBN";
            } else {
                $check1 = checkEmpruntPossible($code1,$idBibli);
                if (!$check1) {
                    $message1 = "Album n'appartenant pas à cette bibliothèque";
                } else {
                    $aExemplaires = ExemplaireMgr::getExemplairesByISBNandBibli($code1,$idBibli);
                    $checkAvailability = false;
                    for ($i = 0; $i < count($aExemplaires); $i++) {
                        $checkAvailability = checkAvailability($aExemplaires[$i]);

                        if($checkAvailability == true) {
                            break;
                        }
                    }
                    if(!$checkAvailability) {
                        $message1 = "Aucun exemplaire de cet album actuellement disponible";
                    } else {
                        $exemplaire = getExemplaire($code1,$idBibli);
                        $checkEmpruntOK = addEmprunt($exemplaire,$idAdherent);
                        if(!$checkEmpruntOK) {
                            $message = "Erreur : l'emprunt n'a pas pu être enregistré.";
                        } else {
                            $messageSuccess1 = "Emprunt bien enregistré";
                        }
                    }
                }
            }
        }
    // }
} else {
    $code1 = "";
}

if(isset($_POST["code2"]) && $_POST["code2"] != "") {
    $code2 = $_POST["code2"];
    $checkSyntaxe2 = checkSyntaxe($code2);
    if(!$checkSyntaxe2) {
        $message2 = "Syntaxe inccorecte : L'ISBN est un code à 13 chiffres";
    } else {
        if($code2) {
            $check2 = checkEmpruntPossible($code2,$idBibli);
            if ($check2) {
                $exemplaire = getExemplaire($code2,$idBibli);
                
                $checkEmpruntOK = addEmprunt($exemplaire,$idAdherent);
            } else {
                $message2 = getMessage($code2,$idBibli);
            }
        }
    }
} else {
    $code2 = "";
}

if(isset($_POST["code3"]) && $_POST["code3"] != "") {
    $code3 = $_POST["code3"];
    $checkSyntaxe3 = checkSyntaxe($code3);
    if(!$checkSyntaxe3) {
        $message3 = "Syntaxe inccorecte : L'ISBN est un code à 13 chiffres";
    } else {
        if($code3) {
            $check3 = checkEmpruntPossible($code3,$idBibli);
            if ($check3) {
                $exemplaire = getExemplaire($code3,$idBibli);
                
                $checkEmpruntOK = addEmprunt($exemplaire,$idAdherent);
            } else {
                $message3 = getMessage($code3,$idBibli);
            }
        }
    }
} else {
    $code3 = "";
}

require 'Views/view_emprunt&retour.php';
