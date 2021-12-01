<?php

require_once('etatMgrException.class.php');

class EtatMgr
{

    // Getters
    /**
     * Get label etat by id from table etat in database bdtk
     * @param int $id
     * @return string
     */
    public static function getLabelEtat($id)
    {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT `Label etat` FROM etat WHERE idEtat = :idVoulu';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':idVoulu' => $id));

        $label = $result->fetchColumn();

        $result->closeCursor();
        connexionBDD::disconnect();

        if ($label) {
            return $label;
        } else {
            throw new EtatMgrException("Aucun etat correspondant");
        }
    }
}
