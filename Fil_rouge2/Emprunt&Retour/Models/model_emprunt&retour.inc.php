<?php

/**
 * Vérifie si l'utilisateur a des emprunts en cours
 * @param int $idUser
 * @return bool
 */
function checkEmpruntEnCours($idUser) {
    try {
        $aEmprunt = EmpruntMgr::getCurrentEmpruntsByUser($idUser);
        if($aEmprunt) {
            $flag = true;
        }
    } catch (EmpruntMgrException $e) {
        $flag = false;
    } finally {
        return $flag;
    }
}

/**
 * Vérifie si des exemplaires de l'album demandé sont disponibles dans la bibliothèque demandée
 * @param int $ISBN
 * @param int $idBibli
 * @return bool
 */
function checkEmpruntPossible($ISBN,$idBibli) {
    $flag = false;
    try {
        $aExemplaires = ExemplaireMgr::getExemplairesByISBNandBibli($ISBN,$idBibli);
        for ($i = 0; $i < count($aExemplaires); $i++) {
            $flag = checkAvailability($aExemplaires[$i]);

            if($flag == true) {
                break;
            }
        }
    } catch (ExemplaireMgrException $e) {
        echo $e;
    } finally {
        return $flag;
    }
}

/**
 * Vérifie si l'exemplaire en paramètre est disponible
 * @param object $exemplaire
 * @return bool
 */
function checkAvailability($exemplaire) {
    $idExemplaire = $exemplaire->getIdExemplaire();
    try {
        $check = EmpruntMgr::getCurrentEmpruntsByIdExemplaire($idExemplaire);
        $flag = false;
    } catch (EmpruntMgrException $e) {
        $flag = true;
    } finally {
        return $flag;
    }
}

/**
 * Récupère le premier exemplaire disponible dans la bibliothèque en paramètre
 * @param int $ISBN
 * @param int $idBibli
 * @return object
 */
function getExemplaire($ISBN,$idBibli) {
    try {
        $aExemplaires = ExemplaireMgr::getExemplairesByISBNandBibli($ISBN,$idBibli);
        for ($i = 0; $i < count($aExemplaires); $i++) {
            $flag = checkAvailability($aExemplaires[$i]);
            if($flag == true) {
                $exemplaire = $aExemplaires[$i];
                return $exemplaire;
            }
        }    
    } catch (ExemplaireMgrException $e) {
        echo $e;
    }
    
}

/**
 * Récupère un message d'erreur
 * @param int $ISBN
 * @param int $idBibli
 * @return string
 */
function getMessage($ISBN,$idBibli) {
    $flag = false;
    try {
        $aExemplaires = ExemplaireMgr::getExemplairesByISBNandBibli($ISBN,$idBibli);
        for ($i = 0; $i < count($aExemplaires)-1; $i++) {
            $flag = checkAvailability($aExemplaires[$i]);
            if($flag == true) {
                $message = null;
            } else {
                $message = "Aucun exemplaire disponible dans cette bibliothèque";
            }
        }
    } catch (ExemplaireMgrException $e) {
        $message = $e;
    } finally {
        return $message;
    }
}

/**
 * Crée un objet emprunt et l'ajoute à la bdd
 * @param objet $exemplaire
 * @param int $idAdherent
 * @return bool
 */
function addEmprunt($exemplaire,$idAdherent) {
    $idExemplaire = $exemplaire->getIdExemplaire();
    $today = new DateTime(date('Y-m-d'));
    $today = $today->format('Y-m-d');

    try {
    $emprunt = new Emprunt (null, $today,null, $idAdherent, $idExemplaire);
    } catch (EmpruntException $e) {
        echo $e;
    }

    if(isset($emprunt)) {
        try {
            $check = EmpruntMgr::addEmprunt($emprunt);
            if(isset($check)) {
                return $flag = true;
            }
        } catch (EmpruntMgrException $eMgr) {
            echo "Erreur : ".$eMgr->getMessage();
        }
    } else {
        return $flag = false;
    }
}