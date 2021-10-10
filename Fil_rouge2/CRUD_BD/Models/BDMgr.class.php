<?php 
// fonctions modele CRUD BD

/**
 * Ajoute une BD dans la liste des albums
 * @param int $newISBN, $newAuthorID, $newSerieID, $newNumber
 * @param float $newPrice
 * @param string $newTitle, $newImage, $newMiniImage, $newResume
 * @return bool
 */

function addNewBD($newISBN, $newTitle, $newAuthorID, $newSerieID, $newPrice, $newNumber, 
                    $newImage, $newMiniImage, $newResume) {
        $sql = mysqli_query("SELECT COUNT * FROM `album` WHERE `ISBN` === $newISBN");
        if ($sql === 0) {
            $sql2 = mysqli_query("INSERT INTO `album` (`ISBN`, `Titre_album`, `Numero_album`, 
                `Prix`, `Resume`, `ID_image`, `Id_mini_image`, `idSerie`, `idAuteur`) 
                VALUES ($newISBN, $newTitle, $newNumber, $newPrice, $newResume, $newImage, 
                $newMiniImage, $newSerieID, $newAuthorID)");
                return true;
        }
        return false;
    }
}



/**
 * Recherche une BD par titre dans la liste des albums
 * @param string $titleSearch
 * @return array or
 * @return bool
 */

function searchBDByTitle($titleSearch) {
    $sql = mysqli_query("SELECT Titre_album, ISBN, Nom_serie, Nom_auteur FROM `album` WHERE `Titre_album` LIKE '%"$titleSearch"%'");
    $res = mysqli_fetch_array($sql);
    if ($res !== NULL) {
        return $res;
    }
    return false;
}



/**
 * Recherche une BD par série dans la liste des albums
 * @param string $titleSearch
 * @return array or
 * @return bool
 */

function searchBDBySerie($serieSearch) {
    $sql = mysqli_query("SELECT Titre_album, ISBN, Nom_serie, Nom_auteur FROM `album` WHERE `Nom_serie` LIKE '%"$serieSearch"%'");
    $res = mysqli_fetch_array($sql);
    if ($res !== NULL) {
        return $res;
    }
    return false;
}



/**
 * Recherche une BD par auteur dans la liste des albums
 * @param string $titleSearch
 * @return array or
 * @return bool
 */

function searchBDByAuthor($authorSearch) {
    $sql = mysqli_query("SELECT Titre_album, ISBN, Nom_serie, Nom_auteur FROM `album` WHERE `Nom_auteur` LIKE '%"$authorSearch"%'");
    $res = mysqli_fetch_array($sql);
    if ($res !== NULL) {
        return $res;
    }
    return false;
}

/**
 * Modifie une BD dans la liste des albums
 * @param int $newISBN, $newAuthorID, $newSerieID, $newNumber
 * @param float $newPrice
 * @param string $newTitle, $newImage, $newMiniImage, $newResume
 * @param int $searchResultISBN
 * @return bool
 */

function updateBD($newTitle, $newAuthorID, $newSerieID, $newPrice, $newNumber, 
                    $newImage, $newMiniImage, $newResume, $searchResultISBN) {
    $sql = mysqli_query("UPDATE `album` SET `Titre_album` = $newTitle, 
                        `Numero_album` = $newNumber, `Prix` = $newPrice, 
                        `Resume` = $newResume, `idSerie` = $newSerieID, `idAuteur` = $newAuthorID 
                        WHERE `album`.`ISBN` = $searchResultISBN");
    return true;

}


/**
 * Supprime une BD de la liste des albums
 * @param int $searchResultISBN
 * @return bool
 */
function deleteBD($searchResultISBN) {
    $sql = mysqli_query("DELETE * FROM `album` WHERE `ISBN` = $searchResultISBN");
    return true;
}

?>