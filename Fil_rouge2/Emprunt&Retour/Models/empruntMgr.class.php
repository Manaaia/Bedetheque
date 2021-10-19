<?php 

require_once('empruntMgrException.class.php');

class EmpruntMgr {

    /**
     * Get full list of emprunts from table emprunt in database bdtk
     * @param void
     * @return array of objects
     */
    public static function getListEmprunts() : array {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM emprunt';
        
        $resPDOstt = $connexionPDO->query($sql);

        $records = $resPDOstt->fetchAll(PDO::FETCH_ASSOC);

        $emprunts = array ();
        foreach($records as $record) {
            $emprunt = new Emprunt (...(array_values($record)));
            $emprunts[] = $emprunt;
        }        

        $resPDOstt->closeCursor();
        connexionBDD::disconnect();

        return $emprunts;
    }

    /**
     * Get one emprunt by ID from table emprunt in database bdtk
     * @param int $id
     * @return object
     */
    public static function getEmpruntById($id) {
   
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM emprunt WHERE id_emprunt = ?';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array($id));

        $record = $result->fetch(PDO::FETCH_ASSOC);

        $result->closeCursor();
        connexionBDD::disconnect();

        if($record) {
            $emprunt = new Emprunt (...(array_values($record)));
            return $emprunt;
        } else {
            throw new EmpruntMgrException("aucun emprunt correspondant");
        }
    }

    /**
     * Get emprunt(s) by dateEmprunt sans retour from table emprunt in database bdtk
     * @param string $date
     * @return object or
     * @return array of objects
     */
    public static function getEmpruntByDate($date) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM emprunt WHERE Date_emprunt = :dateVoulu AND Date_retour = null';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':dateVoulu'=>$date));

        $records = $result->fetchAll(PDO::FETCH_ASSOC);

        $result->closeCursor();
        connexionBDD::disconnect();

        if($records) {
            return $records;
        } else {
            throw new EmpruntMgrException("Aucun emprunt fait à cette date");
        }
    }

    /**
     * Get emprunt(s) by id_user from table emprunt in database bdtk
     * @param int $idUser
     * @return object or
     * @return array of objects
     */
    public static function getCurrentEmpruntsByUser($idUser) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM emprunt WHERE id_user = :idVoulu AND Date_retour IS NULL';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':idVoulu'=>$idUser));

        $records = $result->fetchAll(PDO::FETCH_ASSOC);

        $result->closeCursor();
        connexionBDD::disconnect();

        if($records) {
            return $records;
        } else {
            throw new EmpruntMgrException("Aucun emprunt en cours pour cet adhérent");
        }
    }

    /**
     * Get emprunt by ID_exemplaire from table emprunt in database bdtk
     * @param int $idExemplaire
     * @return object or
     * @return array of objects
     */
    public static function getCurrentEmpruntsByIdExemplaire($idExemplaire) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM emprunt WHERE ID_exemplaire = :idVoulu AND Date_retour IS NULL';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':idVoulu'=>$idExemplaire));

        $records = $result->fetchAll();

        $result->closeCursor();
        connexionBDD::disconnect();

        if($records) {
            return $records;
        } else {
            throw new EmpruntMgrException("Aucun emprunt en cours pour cet exemplaire");
        }
    }

    /**
     * Add emprunt from table emprunt in database bdtk
     * @param object $emprunt
     * @return string
     */
    public static function addEmprunt($emprunt) {
        $connexionPDO = connexionBDD::getConnexion();

        $dateEmprunt = $emprunt->getDateEmprunt();
        $idUser = $emprunt->getIdUser();
        $idExemplaire = $emprunt->getIdExemplaire();

        $sql = 'INSERT INTO emprunt (Date_emprunt, id_user, ID_exemplaire)
        VALUES (:dateEVoulu,:idUVoulu,:idEVoulu)';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':dateEVoulu'=>$dateEmprunt,
        ':idUVoulu'=>$idUser,':idEVoulu'=>$idExemplaire));

        $count = $result->rowCount();
        if ($count == 0) {
            $message = "Lignes affectées : ".$count;
        } else {
            $message = "Confirmation : emprunt bien ajouté à la BDD.";
        }

        $result->closeCursor();
        connexionBDD::disconnect();

        return $message;
    }
}