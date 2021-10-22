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
            try {

                $isbn = $_POST["id"];
                $nomAuteur = $_POST["auteur"];
                $nomSerie = $_POST["serie"];
                $album = BDMgr::searchBDByISBN($isbn);
                $titreBD = $album->getTitreAlbum();
                $numeroBD = $album->getNumeroAlbum();
                $serieBD = $album->getSerie();
                $auteurBD = $album->getAuteur();
                $resumeBD = $album->getResume();
                $prixBD = $album->getPrix();
                $couvBD = $album->getImage();
                $exemplaires = ExemplaireMgr::getExemplairesByISBN($isbn);
                $nbEmprunts = 0;
                $dispos = [];
                $lieux = [];
                foreach ($exemplaires as $line_num => $exp) {
                    // var_dump($nbEmprunts);
                    try {
                    $nbEmprunts += count(EmpruntMgr::getCurrentEmpruntsByIdExemplaire($exp['ID_exemplaire']));
                    } catch (EmpruntMgrException $e) {
                        $dispos[] = $exp['ID_exemplaire'];
                    }
                    
                }
                // var_dump($nbEmprunts);
                if($nbEmprunts < 0) {
                    $nbDispo = count($exemplaires);
                } else {
                    $nbDispo = count($exemplaires) - ($nbEmprunts);
                }
                // var_dump($nbDispo);
                // var_dump($dispos);
                foreach ($dispos as $line_num => $expD) {
                    if(!empty(ExemplaireMgr::getExemplaireEmplacement($expD))) {
                        $idEmp = ExemplaireMgr::getExemplaireEmplacement($expD)[0]['idEmplacement'];
                        $emp = ExemplaireMgr::getExemplaireEmplacement($expD)[0]['code_emplacement'];
                        // var_dump($idEmp);
                        // var_dump($emp);
                        $bib = BibliothequeMgr::getBibliByEmplacement($idEmp)[0];
                        $lieux[] = $emp." : ".$bib;
                    } else {
                        $lieux[] = "Non renseigné";
                    } 
                    

                }
                require 'Views/view_displayBD.php';
            } catch (BDMgrException $e) {
                $msg = $e->getMessage();
                require 'Views/view_errorBD.php';
            }
            // var_dump($lieux);
            
        }
        else {
            $action = "searchBD";
        }
        break;

    case "deleteBD" :
        if(isset($_POST["id"]) && !empty($_POST["id"])) {
            //recupération de l'isbn, du nom de l'auteur et du nom de la série
            $isbn = $_POST["id"];
            $nomAuteur = $_POST["auteur"];
            $nomSerie = $_POST["serie"];
            require 'Views/view_deleteBD.php';
        }
        else {
            //retour à la recherche
            $action = "searchBD";
        }
        break;
    case "confirmDeleteBD" :
        if(isset($_POST["id"]) && !empty($_POST["id"])) {
            //récupération de l'isbn
            $isbn = $_POST["id"];
            try {
                //suppression de la BD
                BDMgr::deleteBD($isbn);
                //Confirmation
                $msg = "La BD ".$isbn." a bien été supprimée";
                require 'Views/view_deleteBD.php';
            } catch (BDMgrException $e) {
                //Message d'erreur
                $msg = "Cette BD fait l'objet d'un emprunt en cours et ne peut être supprimée.";
                require 'Views/view_deleteBD.php';
            }
        }
        break;

    case "modifyBD" :
        if(isset($_POST["id"]) && !empty($_POST["id"])) {
            try {
                //récupération des infos de la BD
                $isbn = $_POST["id"];
                $nomAuteur = $_POST["auteur"];
                $nomSerie = $_POST["serie"];
                $album = BDMgr::searchBDByISBN($isbn);
                $titreBD = $album->getTitreAlbum();
                $numeroBD = $album->getNumeroAlbum();
                $serieBD = $album->getSerie();
                $auteurBD = $album->getAuteur();
                $resumeBD = $album->getResume();
                $prixBD = $album->getPrix();
                $couvBD = $album->getImage();

                //récupération de la liste des auteurs
                $listAuthors = BDMgr::getListAuteurs();

                //récupération de la liste des séries
                $listSeries = BDMgr::getListSeries();
                require 'Views/view_modifyBD.php';
            } catch (BDMgrException $e) {
                //Message d'erreur si BD introuvable
                $msg = $e->getMessage();
                require 'Views/view_errorBD.php';
            }    
     
        }
        else {
            $action = "searchBD";
        }
        break;

    case "confirmModifyBD" :
        if(isset($_POST["id"]) && !empty($_POST["id"])) {
            try {
                //récupération des infos de la BD
                $titre = $_POST['titre'];
                $num = $_POST['num'];
                $resume = $_POST['resume'];
                $prix = $_POST['prix'];
                $serie = explode(" : ",$_POST['selectserie']);
                $idSerie = $serie[0];
                $auteur = explode(" : ",$_POST['selectauteur']);
                $idAuteur = $auteur[0];

                if(isset($_POST['image']) && !empty($_POST['image'])) {
                    $image = explode("/", $_POST['image']);
                    $idImage = $image[count($image)-1];
                    $idMiniImage = $idImage;
                } else {
                    $idImage = $_POST['idImage'];
                    $idMiniImage = $idImage;
                }

                $isbn = $_POST["id"];

                //Modification de la BD avec valeurs récupérées
                BDMgr::updateBD($titre, $num, $prix, $resume, $idSerie, $idAuteur,  
                $idImage, $idMiniImage,$isbn);

                //confirmation
                $msg = "La BD ".$isbn." a bien été modifiée";
                require 'Views/view_modifyBD.php';
            } catch (BDMgrException $e) {
                //Message d'erreur
                $msg = $e->getMessage();
                require 'Views/view_modifyBD.php';
            }    
        
        }
        else {
            $action = "searchBD";
        }
        break;


        case "addNewBD" :
            try {
                //récupération de la liste des auteurs
                $listAuthors = BDMgr::getListAuteurs();

                //récupération de la liste des séries
                $listSeries = BDMgr::getListSeries();
                require 'Views/view_addBD.php';
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            break;

        case "confirmAddBD" :
            if(isset($_POST["id"]) && !empty($_POST["id"])) {
                if(isset($_POST["titre"]) && !empty($_POST["id"])) {
                    if(isset($_POST["num"]) && !empty($_POST["num"])) {
                        if(isset($_POST["resume"])) {
                            if(isset($_POST["prix"]) && !empty($_POST["prix"])) {
                                if(isset($_POST["selectserie"]) && !empty($_POST["selectserie"])) {
                                    if(isset($_POST["selectauteur"]) && !empty($_POST["selectauteur"])) {
                                        if(isset($_POST["image"]) && !empty($_POST["image"])) {
                
                                            try {
                                                //récupération des infos de la BD
                                                $titre = $_POST['titre'];
                                                $num = $_POST['num'];
                                                if(!empty($_POST['resume'])) {
                                                    $resume = $_POST['resume'];
                                                } else {
                                                    $resume = null;
                                                }
                                                
                                                $prix = $_POST['prix'];
                                                $serie = explode(" : ",$_POST['selectserie']);
                                                $idSerie = $serie[0];
                                                $auteur = explode(" : ",$_POST['selectauteur']);
                                                $idAuteur = $auteur[0];
                                
                                                if(isset($_POST['image']) && !empty($_POST['image'])) {
                                                    $image = explode("/", $_POST['image']);
                                                    $idImage = $image[count($image)-1];
                                                    $idMiniImage = $idImage;
                                                } else {
                                                    $idImage = $_POST['idImage'];
                                                    $idMiniImage = $idImage;
                                                }
                                
                                                $isbn = $_POST["id"];
                                                //création d'un obje BD avec les informations récupérées
                                                $newBD = new BD ($isbn, $titre, $num, $prix, $resume, $idImage, $idMiniImage, $idSerie, $idAuteur);

                                                //Ajout de la BD avec valeurs récupérées
                                                BDMgr::addNewBD($newBD);
                                                //confirmation
                                                $msg = "La BD ".$isbn." a bien été ajoutée";
                                                require 'Views/view_addBD.php';
                                            } catch (BDMgrException $e) {
                                                //Message d'erreur
                                                $msg = $e->getMessage();
                                                require 'Views/view_addBD.php';
                                            }    
                                        } else {
                                            $msg = "Erreur : Veuillez saisir toutes les informations relatives à l'album (résumé facultatif).";
                                            require 'Views/view_addBD.php';
                                        } 
                                    } else {
                                        $msg = "Erreur : Veuillez saisir toutes les informations relatives à l'album (résumé facultatif).";
                                        require 'Views/view_addBD.php';
                                    }
                                } else {
                                    $msg = "Erreur : Veuillez saisir toutes les informations relatives à l'album (résumé facultatif).";
                                    require 'Views/view_addBD.php';
                                }
                            } else {
                                $msg = "Erreur : Veuillez saisir toutes les informations relatives à l'album (résumé facultatif).";
                                require 'Views/view_addBD.php';
                            }
                        } else {
                            $msg = "Erreur : Veuillez saisir toutes les informations relatives à l'album (résumé facultatif).";
                            require 'Views/view_addBD.php';
                        }
                    } else {
                        $msg = "Erreur : Veuillez saisir toutes les informations relatives à l'album (résumé facultatif).";
                        require 'Views/view_addBD.php';
                    }
                } else {
                    $msg = "Erreur : Veuillez saisir toutes les informations relatives à l'album (résumé facultatif).";
                    require 'Views/view_addBD.php';
                }
            } else {
                $msg = "Erreur : Veuillez saisir toutes les informations relatives à l'album (résumé facultatif).";
                require 'Views/view_addBD.php';
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
