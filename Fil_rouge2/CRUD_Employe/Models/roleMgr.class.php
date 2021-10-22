<?php 

require_once('roleMgrException.class.php');

class RoleMgr {

    // Getters
    /**
     * Get label role by id from table role in database bdtk
     * @param int $id
     * @return string
     */
    public static function getLabelRole($id) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT Label_role FROM role WHERE id_role = :idVoulu';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':idVoulu'=>$id));

        $label = $result->fetchColumn();

        $result->closeCursor();
        connexionBDD::disconnect();

        if($label) {
            return $label;
        } else {
            throw new RoleMgrException("Aucun rôle correspondant");
        }
    }
}