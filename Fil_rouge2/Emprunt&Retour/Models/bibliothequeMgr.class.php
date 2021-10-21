<!-- FLAVIE -->
<?php 

require_once('bibliothequeMgrException.class.php');

class BibliothequeMgr {

    // Getters
    /**
     * Get bibliotheque by id from table bibliotheque in database bdtk
     * @param int $id
     * @return string
     */
    public static function getBibliById($id) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT Nom_bibli FROM bibliotheque WHERE idBibli=:idVoulu';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':idVoulu'=>$id));

        $labelBibli = $result->fetch();

        $result->closeCursor();
        connexionBDD::disconnect();

        if($labelBibli) {
            return $labelBibli;
        } else {
            throw new BibliothequeMgrException("Bibliotheque inexistante.");
        }
    }

    /**
     * Get list of bibliotheques from table bibliotheque in database bdtk
     * @param int $id
     * @return array of objects
     */
    public static function getListBibli() {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM bibliotheque';
        
        $resPDOstt = $connexionPDO->query($sql);

        $records = $resPDOstt->fetchAll(PDO::FETCH_ASSOC);

        $aBibli = array ();
        foreach($records as $record) {
            $bibli = new Bibliotheque (...(array_values($record)));
            $aBibli[] = $bibli;
        }        

        $resPDOstt->closeCursor();
        connexionBDD::disconnect();

        return $aBibli;
    }

    /** FLAVIE
     * Gets bibliotheque's name by idEmplacement from table bibliotheque in database bdtk
     * @param int $id
     * @return array $labelBibli
     */
    public static function getBibliByEmplacement($id) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT DISTINCT Nom_bibli FROM bibliotheque b
        JOIN emplacement em ON em.idBibli = b.idBibli
        WHERE em.idEmplacement =:idVoulu';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':idVoulu'=>$id));
        
        //Lit le résultat
        $labelBibli = $result->fetch();

        $result->closeCursor(); // ferme le curseur
        connexionBDD::disconnect(); // ferme la connexion

        if($labelBibli) {
            return $labelBibli;
        } else {
            throw new BibliothequeMgrException("Bibliotheque inexistante.");
        }
    }
}