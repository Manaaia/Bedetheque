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



    // /**
    //  * Recherche une BD par série dans la liste des albums
    //  * @param string $serieSearch
    //  * @return array or
    //  * @return bool
    //  */

    // function searchBDBySerie($serieSearch) {
    //     $sql = mysqli_query("SELECT Titre_album, ISBN, Nom_serie, Nom_auteur FROM `album` WHERE `Nom_serie` LIKE '%"$serieSearch"%'");
    //     $res = mysqli_fetch_array($sql);
    //     if ($res !== NULL) {
    //         return $res;
    //     }
    //     return false;
    // }



    // /**
    //  * Recherche une BD par auteur dans la liste des albums
    //  * @param string $titleSearch
    //  * @return array or
    //  * @return bool
    //  */

    // function searchBDByAuthor($authorSearch) {
    //     $sql = mysqli_query("SELECT Titre_album, ISBN, Nom_serie, Nom_auteur FROM `album` WHERE `Nom_auteur` LIKE '%"$authorSearch"%'");
    //     $res = mysqli_fetch_array($sql);
    //     if ($res !== NULL) {
    //         return $res;
    //     }
    //     return false;
    // }

    // /**
    //  * Modifie une BD dans la liste des albums
    //  * @param int $newISBN, $newAuthorID, $newSerieID, $newNumber
    //  * @param float $newPrice
    //  * @param string $newTitle, $newImage, $newMiniImage, $newResume
    //  * @param int $searchResultISBN
    //  * @return bool
    //  */

    // function updateBD($newTitle, $newAuthorID, $newSerieID, $newPrice, $newNumber, 
    //                     $newImage, $newMiniImage, $newResume, $searchResultISBN) {
    //     $sql = mysqli_query("UPDATE `album` SET `Titre_album` = $newTitle, 
    //                         `Numero_album` = $newNumber, `Prix` = $newPrice, 
    //                         `Resume` = $newResume, `idSerie` = $newSerieID, `idAuteur` = $newAuthorID 
    //                         WHERE `album`.`ISBN` = $searchResultISBN");
    //     return true;

    // }


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