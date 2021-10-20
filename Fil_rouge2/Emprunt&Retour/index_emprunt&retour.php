<?php

require_once 'Models/model_emprunt&retour.inc.php';
require_once 'CRUD_Adherent/Models/model_adherent.inc.php';

if(isset($_POST["idAdherent"])) {
    $idAdherent = $_POST["idAdherent"];
    $adherent = UserMgr::getUserById($idAdherent);
    $prenomAdherent = $adherent->getPrenomUser();
    $nomAdherent = $adherent->getNomUser();
    $dateCo = $adherent->getDateCot();
    $checkDateCo = checkDateCo($dateCo);
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
        $checkIfExists2 = checkIfExists($code2);
        if(!$checkIfExists2) {
            $message2 = "Aucun album trouvé avec cet ISBN";
        } else {
            $check2 = checkEmpruntPossible($code2,$idBibli);
            if (!$check2) {
                $message2 = "Album n'appartenant pas à cette bibliothèque";
            } else {
                $aExemplaires2 = ExemplaireMgr::getExemplairesByISBNandBibli($code2,$idBibli);
                $checkAvailability2 = false;
                for ($i = 0; $i < count($aExemplaires2); $i++) {
                    $checkAvailability2 = checkAvailability($aExemplaires2[$i]);

                    if($checkAvailability2 == true) {
                        break;
                    }
                }
                if(!$checkAvailability2) {
                    $message2 = "Aucun exemplaire de cet album actuellement disponible";
                } else {
                    $exemplaire2 = getExemplaire($code2,$idBibli);
                    $checkEmpruntOK2 = addEmprunt($exemplaire2,$idAdherent);
                    if(!$checkEmpruntOK2) {
                        $message2 = "Erreur : l'emprunt n'a pas pu être enregistré.";
                    } else {
                        $messageSuccess2 = "Emprunt bien enregistré";
                    }
                }
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
        $checkIfExists3 = checkIfExists($code3);
        if(!$checkIfExists3) {
            $message3 = "Aucun album trouvé avec cet ISBN";
        } else {
            $check3 = checkEmpruntPossible($code3,$idBibli);
            if (!$check3) {
                $message3 = "Album n'appartenant pas à cette bibliothèque";
            } else {
                $aExemplaires3 = ExemplaireMgr::getExemplairesByISBNandBibli($code3,$idBibli);
                $checkAvailability3 = false;
                for ($i = 0; $i < count($aExemplaires3); $i++) {
                    $checkAvailability3 = checkAvailability($aExemplaires3[$i]);

                    if($checkAvailability3 == true) {
                        break;
                    }
                }
                if(!$checkAvailability3) {
                    $message3 = "Aucun exemplaire de cet album actuellement disponible";
                } else {
                    $exemplaire3 = getExemplaire($code3,$idBibli);
                    $checkEmpruntOK3 = addEmprunt($exemplaire3,$idAdherent);
                    if(!$checkEmpruntOK3) {
                        $message3 = "Erreur : l'emprunt n'a pas pu être enregistré.";
                    } else {
                        $messageSuccess3 = "Emprunt bien enregistré";
                    }
                }
            }
        }
    }
} else {
    $code3 = "";
}

require 'Views/view_emprunt&retour.php';
