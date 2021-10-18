<?php 
// require_once('../Header&Footer/Models/connexionBDD.class.php');
require_once('BDMgrException.class.php');

class BDMgr {

    /**
     * Get list of ISBN from table album in database bdtk
     * @param void
     * @return array
     */
    public static function getListISBN() : array {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT ISBN FROM album';
        
        $resPDOstt = $connexionPDO->query($sql);

        $ISBN = $resPDOstt->fetchAll(PDO::FETCH_COLUMN); 

        $resPDOstt->closeCursor();
        connexionBDD::disconnect();

        return $ISBN;
    }

    /**
     * Search BD by ISBN in table album from database bdtk
     * @param int $id
     * @return object
     */

    public static function searchBDByISBN($id) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM album WHERE ISBN=:idVoulu';
        $res = $connexionPDO->prepare($sql);
        $res->execute(array(':idVoulu'=>$id));

        // Lit le résultat
        $album = $res->fetch(PDO::FETCH_ASSOC);

        $album = new BD (...(array_values($album)));

        // Ferme le curseur et la connexion
        $res->closeCursor(); // ferme le curseur
        connexionBDD::disconnect();     // ferme la connexion

        // Retourne la / les BDs ou FALSE
        return $album;
    }

    /**
     * Ajoute une BD dans la liste des albums
     * @param object $bd
     * @return int 0 or $nombre
     */

    public static function addNewBD($bd) {

        $connexionPDO = connexionBDD::getConnexion(); 
   
        try {
            $sql = "CALL prcAddBd(:isbn, :titre, :num, :prix, :myresume, :myimage, :miniature, :serie, :auteur)";
            $res = $connexionPDO->prepare($sql);

            $res->execute(array(":isbn"=>$bd->getISBN(), ":titre"=>$bd->getTitreAlbum(), 
                ":num"=>$bd->getNumeroAlbum(), ":prix"=>$bd->getPrix(), ":myresume"=>$bd->getResume(), 
                ":myimage"=>$bd->getImage(), ":miniature"=>$bd->getMiniImage(), ":serie"=>$bd->getSerie(),
                ":auteur"=>$bd->getAuteur()));

            $nombre = $res->rowCount();

            $res->closeCursor();
            connexionBDD::disconnect();
            return $nombre;

        } catch (PDOException $e) {
            if ($e->getCode() == 23000 || $e->getCode() == 45000) {
                throw new BDMgrException("Erreur : Il semble que la BD correspondant à cet ISBN existe déjà");
            }
        }
        
    }



    /**
     * Recherche une BD par titre dans la liste des albums
     * @param string $titleSearch
     * @return array or
     * @return bool
     */
    public static function searchBDByTitle($titleSearch, $choix = PDO::FETCH_ASSOC) {

        $connexionPDO = connexionBDD::getConnexion();

        $sql = "CALL prcSearchTitle(:titreVoulu)";
        $res = $connexionPDO->prepare($sql);
        $res->execute(array(':titreVoulu'=>$titleSearch));
            $res->setFetchMode($choix);

        // Lit le résultat
        $tBDs = $res->fetchAll();

        // Ferme le curseur et la connexion
        $res->closeCursor(); // ferme le curseur
        connexionBDD::disconnect();     // ferme la connexion

        // Retourne la / les BDs ou FALSE
        return $tBDs;
        
    }



    /**
     * Recherche une BD par série dans la liste des albums
     * @param string $serieSearch
     * @return array or
     * @return bool
     */

    public static function searchBDBySerie($serieSearch, $choix = PDO::FETCH_ASSOC) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = "CALL prcSearchSerie(:serieVoulue)";
        $res = $connexionPDO->prepare($sql);
        $res->execute(array(':serieVoulue'=>$serieSearch));
        $res->setFetchMode($choix);

        // Lit le résultat
        $tBDs = $res->fetchAll();

        // Ferme le curseur et la connexion
        $res->closeCursor(); // ferme le curseur
        connexionBDD::disconnect();     // ferme la connexion

        // Retourne la / les BDs ou FALSE
        return $tBDs;
    }



    /**
     * Recherche une BD par auteur dans la liste des albums
     * @param string $titleSearch
     * @return array or
     * @return bool
     */

    public static function searchBDByAuthor($authorSearch, $choix = PDO::FETCH_ASSOC) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = "CALL prcSearchAuthor(:auteurVoulu)";
        $res = $connexionPDO->prepare($sql);
        $res->execute(array(':auteurVoulu'=>'%'.$authorSearch.'%'));
        $res->setFetchMode($choix);

        // Lit le résultat
        $tBDs = $res->fetchAll();

        // Ferme le curseur et la connexion
        $res->closeCursor(); // ferme le curseur
        connexionBDD::disconnect();     // ferme la connexion

        // Retourne la / les BDs ou FALSE
        return $tBDs;
    }

    /**
     * Modifie une BD dans la liste des albums
     * @param int $newAuthorID, $newSerieID, $newNumber
     * @param float $newPrice
     * @param string $newTitle, $newImage, $newMiniImage, $newResume
     * @param int $searchResultISBN
     * @return int $nombre
     */

    public static function updateBD($newTitle, $newNumber, $newPrice, $newResume, $newSerieID, $newAuthorID,  
                        $newImage, $newMiniImage, $searchResultISBN) {
        try {
            $connexionPDO = connexionBDD::getConnexion();
            $sql = "CALL prcUpdateBd(:titre, 
                                    :numero, :prix, 
                                :resum, :serie, :auteur, :imag, 
                                :miniImage,
                                :idVoulue)";
            $res = $connexionPDO->prepare($sql);
            $res->execute(array(':idVoulue'=>$searchResultISBN, ':titre'=>$newTitle, ':numero'=>$newNumber, 
                                ':prix'=>$newPrice, ':resum'=>$newResume, ':serie'=>$newSerieID, ':auteur'=>$newAuthorID, 
                                ':imag'=>$newImage, ':miniImage'=>$newMiniImage));

            $nombre = $res->rowCount();

            // Ferme le curseur et la connexion
            $res->closeCursor(); // ferme le curseur
            connexionBDD::disconnect();     // ferme la connexion
            
            return $nombre;

        } catch (PDOException $e) {
            if ($e->getCode() == 45000) {
                if(stristr($e->getMessage(), 'auteur') !== false) {
                    throw new BDMgrException("Erreur : Il semble que l'auteur sélectionné ne soit pas dans la liste");
                } elseif(stristr($e->getMessage(), 'série') !== false) {
                    throw new BDMgrException("Erreur : Il semble que la série sélectionnée ne soit pas dans la liste");
                }
            }
        }
        

    }


    /**
     * Supprime une BD de la liste des albums
     * @param int $searchResultISBN
     * @return int $nombre
     */
    public static function deleteBD($searchResultISBN) {
        try {
            $connexionPDO = connexionBDD::getConnexion();
            $sql = "CALL prcDeleteBd(:idVoulue)";
            $res = $connexionPDO->prepare($sql);
            $res->execute(array(':idVoulue'=>$searchResultISBN));

            $nombre = $res->rowCount();

            // Ferme le curseur et la connexion
            $res->closeCursor(); // ferme le curseur
            connexionBDD::disconnect();     // ferme la connexion
            
            return $nombre;

        } catch (PDOException $e) {
            if ($e->getCode() == 45000) {
                
                throw new BDMgrException("Erreur : La BD selectionnée fait l'objet d'un emprunt en cours.");
        
            }
        }
    }
}

?>