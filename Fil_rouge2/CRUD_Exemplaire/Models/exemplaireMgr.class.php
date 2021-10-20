<?php 

require_once('exemplaireMgrException.class.php');

class ExemplaireMgr {

    /**
     * Get full list of exemplaires from table exemplaires in database bdtk
     * @param void
     * @return array of objects
     */
    public static function getListExemplaires() : array {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM exemplaire';
        
        $resPDOstt = $connexionPDO->query($sql);

        $records = $resPDOstt->fetchAll(PDO::FETCH_ASSOC);

        $exemplaires = array ();
        foreach($records as $record) {
            $exemplaire = new Exemplaire (...(array_values($record)));
            $exemplaires[] = $exemplaire;
        }        

        $resPDOstt->closeCursor();
        connexionBDD::disconnect();

        return $exemplaires;
    }

    /**
     * Get one exemplaire by ID from table exemplaire in database bdtk
     * @param string $id
     * @return object
     */
    public static function getExemplaireById($id) {
   
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM exemplaire WHERE ID_exemplaire = ?';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array($id));

        $record = $result->fetch(PDO::FETCH_ASSOC);

        $result->closeCursor();
        connexionBDD::disconnect();

        if($record) {
            $exemplaire = new Exemplaire (...(array_values($record)));
            return $exemplaire;
        } else {
            throw new ExemplaireMgrException("aucun exemplaire correspondant");
        }
    }

    /**
     * Get exemplaire(s) by dateEntree from table exemplaire in database bdtk
     * @param string $date
     * @return object or
     * @return array of objects
     */
    public static function getExemplairesByDate($date) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM exemplaire WHERE Date_entree_exemplaire = :dateVoulu';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':dateVoulu'=>$date));

        $records = $result->fetchAll(PDO::FETCH_ASSOC);

        $result->closeCursor();
        connexionBDD::disconnect();

        if($records) {
            return $records;
        } else {
            throw new ExemplaireMgrException("Aucun exemplaire entré à cette date");
        }
    }

    /**
     * Get exemplaire(s) by idEmplacement from table exemplaire in database bdtk
     * @param int $idEmplacement
     * @return object or
     * @return array of objects
     */
    public static function getExemplairesByEmplacement($idEmplacement) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM exemplaire WHERE idEmplacement = :idVoulu';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':idVoulu'=>$idEmplacement));

        $records = $result->fetchAll();

        $result->closeCursor();
        connexionBDD::disconnect();

        if($records) {
            return $records;
        } else {
            throw new ExemplaireMgrException("Aucun exemplaire à cet emplacement");
        }
    }

    /**
     * Get exemplaire(s) by statut from table exemplaire in database bdtk
     * @param int $statut
     * @return object or
     * @return array of objects
     */
    public static function getExemplairesByStatut($statut) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM exemplaire WHERE Statut = :statutVoulu';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':statutVoulu'=>$statut));

        $records = $result->fetchAll();

        $result->closeCursor();
        connexionBDD::disconnect();

        if($records) {
            return $records;
        } else {
            throw new ExemplaireMgrException("Aucun exemplaire avec ce statut");
        }
    }

    /**
     * Get exemplaire(s) by etat from table exemplaire in database bdtk
     * @param int $etat
     * @return object or
     * @return array of objects
     */
    public static function getExemplairesByEtat($etat) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM exemplaire WHERE idEtat = :etatVoulu';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':etatVoulu'=>$etat));

        $records = $result->fetchAll();

        $result->closeCursor();
        connexionBDD::disconnect();

        if($records) {
            return $records;
        } else {
            throw new ExemplaireMgrException("Aucun exemplaire avec cet état");
        }
    }

    /**
     * Get exemplaire(s) by etat from table exemplaire in database bdtk
     * @param int $etat
     * @return object or
     * @return array of objects
     */
    public static function getExemplairesByISBNandBibli($isbn,$idBibli) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM exemplaire ex
        JOIN emplacement em ON ex.idEmplacement = em.idEmplacement 
        WHERE ex.ISBN = :isbnVoulu AND Statut = 0
        AND em.idBibli = :idVoulu';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':isbnVoulu'=>$isbn,':idVoulu'=>$idBibli));

        $records = $result->fetchAll(PDO::FETCH_ASSOC);

        $exemplaires = array ();
        foreach($records as $record) {
            $exemplaire = new Exemplaire (...(array_values($record)));
            $exemplaires[] = $exemplaire;
        }      

        $result->closeCursor();
        connexionBDD::disconnect();

        if($exemplaires) {
            return $exemplaires;
        } else {
            throw new ExemplaireMgrException("Aucun exemplaire avec cet isbn dans cette bibliothèque");
        }
    }

    public static function getExemplairesByISBN($isbn) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM exemplaire ex
        WHERE ex.ISBN = :isbnVoulu AND Statut = 0';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':isbnVoulu'=>$isbn));

        $records = $result->fetchAll(PDO::FETCH_ASSOC);      

        $result->closeCursor();
        connexionBDD::disconnect();

        return $records;
    }

    public static function getExemplaireEmplacement($id) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT DISTINCT ex.idEmplacement, code_emplacement FROM exemplaire ex
        JOIN emplacement em ON ex.idEmplacement = em.idEmplacement
        WHERE ex.id_exemplaire = :idVoulu';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':idVoulu'=>$id));

        $records = $result->fetchAll(PDO::FETCH_ASSOC);      

        $result->closeCursor();
        connexionBDD::disconnect();

        return $records;
    }
}