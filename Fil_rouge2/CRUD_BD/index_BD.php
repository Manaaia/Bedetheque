<?php

switch ($action) {
    case "searchBD" :
        if(isset($_POST["searchTitle"]) && !empty($_POST["searchTitle"])) {
            $titre = $_POST["searchTitle"];
            $albums = BDMgr::searchBDByTitle($titre);
            foreach ($albums as $line_num => $album) {
                // $miniature = $album['Id_mini_image'];
                // $titreAlbum = $album['Titre_album'];
                // $monAlbum = BDMgr::searchBDByISBN($album['ISBN']);
                // $miniature = $monAlbum->getMiniImage();  
            }
        }
        elseif(isset($_POST["searchSerie"]) && !empty($_POST["searchSerie"])) {
            $serie = $_POST["searchSerie"];
            $albums = BDMgr::searchBDBySerie($serie);
        }
        elseif(isset($_POST["searchAuthor"]) && !empty($_POST["searchAuthor"])) {
            $auteur = $_POST["searchAuthor"];
            $albums = BDMgr::searchBDByAuthor($auteur);
        }
        require 'Views/view_searchBD.php';
        break;

    case "displayBD" :
        if(isset($_POST["id"]) && !empty($_POST["id"])) {
            $isbn = $_POST["id"];
            $album = BDMgr::searchBDByISBN($isbn);
            $titreBD = $album->getTitreAlbum();
            $numeroBD = $album->getNumeroAlbum();
            $serieBD = $album->getSerie();
            $auteurBD = $album->getAuteur();
            $resume = $album->getResume();
            $prix = $album->getPrix();
            $couv = $album->getImage();
            require 'Views/view_displayBD.php';
        }
        else {
            $action = "searchBD";
        }
        break; 
}
// try {
//     spl_autoload_register(function($classe) {
//         include "Models/".$classe.".class.php";
//     });
// } catch (Exception $e) {
//     echo $e->getMessage();
// }

// const OBJET = PDO::FETCH_OBJ;
// const ASSOC = PDO::FETCH_ASSOC;

// try {
//     $bd1 = new BD (9780269887519, "Le club des cinq : à Venise !", 16, "8.50", 
//     "Blablabla, ils trouvent toujours la solution parce que c'est les zéros.", 1, 1, 3, 11);
//     echo $bd1;
//     echo "<br />";
//     echo BDMgr::addNewBD($bd1);
//     echo "<br />"; 
//     echo BDMgr::updateBD('Mort à Venise', '58', '4.02', 'My bad I dunno', 2, 62,  
//     3, 3, 9780269887519);
//     echo "<br />";
//     echo BDMgr::deleteBD(9780269887519);
//     echo "<br />";

//     echo BDMgr::deleteBD(9780312429621);


    
// } catch (BDException $e) {
//     echo $e->getMessage();
// } catch (BDMgrException $e) {
//     echo $e->getMessage();
// }

// var_dump(BDMgr::searchBDByTitle("Venise", OBJET)?BDMgr::searchBDByTitle("Venise", OBJET):
//     "Il n'y a aucune BD correspondante");
// echo "<br />";
// var_dump(BDMgr::searchBDByTitle("Vunise", OBJET)?BDMgr::searchBDByTitle("Vunise", OBJET):
//     "Il n'y a aucune BD correspondante");
// echo "<br />";
// var_dump(BDMgr::searchBDByTitle("V", OBJET)?BDMgr::searchBDByTitle("V", OBJET):
//     "Il n'y a aucune BD correspondante");


// var_dump(BDMgr::searchBDBySerie("Spirou", OBJET)?BDMgr::searchBDBySerie("Spirou", OBJET):
//     "Il n'y a aucune BD correspondante");
// echo "<br />";
// var_dump(BDMgr::searchBDBySerie("Spurou", OBJET)?BDMgr::searchBDBySerie("Spurou", OBJET):
//     "Il n'y a aucune BD correspondante");
// echo "<br />";
// var_dump(BDMgr::searchBDBySerie("S", OBJET)?BDMgr::searchBDBySerie("S", OBJET):
//     "Il n'y a aucune BD correspondante");


// var_dump(BDMgr::searchBDByAuthor("Tom", OBJET)?BDMgr::searchBDByAuthor("Tom", OBJET):
//     "Il n'y a aucune BD correspondante");
// echo "<br />";
// var_dump(BDMgr::searchBDByAuthor("Frikolin", OBJET)?BDMgr::searchBDByAuthor("Frikolin", OBJET):
//     "Il n'y a aucune BD correspondante");
// echo "<br />";
// var_dump(BDMgr::searchBDByAuthor("T", OBJET)?BDMgr::searchBDByAuthor("T", OBJET):
//     "Il n'y a aucune BD correspondante");




?>
