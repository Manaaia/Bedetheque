<?php 

class AmendeMgr {

    // Getters
    function getTarif($typeAmende) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT Tarif_base FROM amendes WHERE ID_Amende=:typeVoulu';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':typeVoulu'=>$typeAmende));

        $tarif = $result->fetchAll();

        $result->closeCursor();
        connexionBDD::disconnect();

        if($tarif) {
            return $tarif;
        } else {
            throw new AmendeMgrException("Type d'amende inexistant.");
        }

    }