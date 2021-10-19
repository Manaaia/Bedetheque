<?php

function checkEmpruntEnCours($idUser) {
    try {
        $aEmprunt = EmpruntMgr::getCurrentEmpruntsByUser($idUser);
        if($aEmprunt) {
            $flag = true;
        }
    } catch (EmpruntMgrException $e) {
        // echo "Erreur : ".$e;
        $flag = false;
    } finally {
        return $flag;
    }

}