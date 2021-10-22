<?php 

require_once('amendeMgrException.class.php');

class AmendeMgr {

    // Getters
    /**
     * Get tarif by type of fine from table amendes in database bdtk
     * @param int $typeAmende
     * @return decimal
     */
    public static function getTarif($typeAmende) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT Tarif_base FROM amendes WHERE ID_Amende=:typeVoulu';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':typeVoulu'=>$typeAmende));

        $tarif = $result->fetch();

        $result->closeCursor();
        connexionBDD::disconnect();

        if($tarif) {
            return $tarif;
        } else {
            throw new AmendeMgrException("Type d'amende inexistant.");
        }

    }
}