<?php 
require_once('../Models/connexionBDD.class.php');
class BDMgr {

    /**
     * Ajoute une BD dans la liste des albums
     * @param object $bd
     * @return int 0 or $nombre
     */

    public static function addNewBD($bd) {

        $connexionPDO = connexionBDD::getConnexion(); 
   
        try {
            $sql = "INSERT INTO `album` (`ISBN`, `Titre_album`, `Numero_album`, 
                `Prix`, `Resume`, `ID_image`, `Id_mini_image`, `idSerie`, `idAuteur`) 
                VALUES (:isbn, :titre, :num, :prix, :myresume, :myimage, :miniature, :serie, :auteur)";
            $res = $connexionPDO->prepare($sql);

            $res->execute(array(":isbn"=>$bd->getISBN(), ":titre"=>$bd->getTitreAlbum(), 
                ":num"=>$bd->getNumeroAlbum(), ":prix"=>$bd->getPrix(), ":myresume"=>$bd->getResume(), 
                ":myimage"=>$bd->getImage(), ":miniature"=>$bd->getMiniImage(), ":serie"=>$bd->getSerie(),
                ":auteur"=>$bd->getAuteur()));

            $nombre = $res->rowCount();

            $res->closeCursor();
            connexionBDD::disconnect();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                throw new BDMgrException("Erreur : Il semble que la BD correspondant à cet ISBN existe déjà");
            }
        }
        return $nombre;
    }



    /**
     * Recherche une BD par titre dans la liste des albums
     * @param string $titleSearch
     * @return array or
     * @return bool
     */
    public static function searchBDByTitle($titleSearch, $choix = PDO::FETCH_ASSOC) {

        $connexionPDO = connexionBDD::getConnexion();

        $sql = "SELECT Titre_album, ISBN, Nom_serie, Nom_auteur FROM `album` al
            JOIN `auteur` au ON al.idAuteur = au.idAuteur 
            JOIN `serie` s ON al.idSerie = s.idSerie WHERE `Titre_album` LIKE :titreVoulu";
        $res = $connexionPDO->prepare($sql);
        $res->execute(array(':titreVoulu'=>'%'.$titleSearch.'%'));
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

        $sql = "SELECT Titre_album, ISBN, Nom_serie, Nom_auteur FROM `album` al
        JOIN `auteur` au ON al.idAuteur = au.idAuteur 
        JOIN `serie` s ON al.idSerie = s.idSerie WHERE `Nom_serie` LIKE :serieVoulue";
        $res = $connexionPDO->prepare($sql);
        $res->execute(array(':serieVoulue'=>'%'.$serieSearch.'%'));
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

        $sql = "SELECT Titre_album, ISBN, Nom_serie, Nom_auteur FROM `album` al
        JOIN `auteur` au ON al.idAuteur = au.idAuteur 
        JOIN `serie` s ON al.idSerie = s.idSerie WHERE `Nom_auteur` LIKE :auteurVoulu";
        $res = $connexionPDO->prepare($sql);
        $res->execute(array(':auteurVoulue'=>'%'.$authorSearch.'%'));
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
     * @return bool
     */

    public static function updateBD($newTitle, $newAuthorID, $newSerieID, $newPrice, $newNumber, 
                        $newImage, $newMiniImage, $newResume, $searchResultISBN) {

        $connexionPDO = connexionBDD::getConnexion();
        $sql = "UPDATE `album` SET `Titre_album` = :titre, 
                            `Numero_album` = :numero, `Prix` = :prix, 
                            `Resume` = :resum, `idSerie` = :serie, `idAuteur` = :auteur, `ID_image` = :imag, 
                            `Id_mini_image` = :miniImage
                            WHERE `ISBN` = :idVoulue";
        $res = $connexionPDO->prepare($sql);
        $res->execute(array(':idVoulue'=>$searchResultISBN, ':titre'=>$newTitle, ':numero'=>$newNumber, 
                            ':prix'=>$newPrice, ':resum'=>$newResume, ':serie'=>$newSerieID, ':auteur'=>$newAuthorID, 
                            ':imag'=>$newImage, ':miniImage'=>$newMiniImage));
         
        // Ferme le curseur et la connexion
        $res->closeCursor(); // ferme le curseur
        connexionBDD::disconnect();     // ferme la connexion
        
        return true;

    }


    // /**
    //  * Supprime une BD de la liste des albums
    //  * @param int $searchResultISBN
    //  * @return bool
    //  */
    // function deleteBD($searchResultISBN) {
    //     $sql = mysqli_query("DELETE * FROM `album` WHERE `ISBN` = $searchResultISBN");
    //     return true;
    // }
}

?>