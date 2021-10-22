<!-- FLAVIE -->
<?php
// SWITCH VALEUR ACTION DETERMINE AFFICHAGE ET FONCTIONNALITES
switch ($action) {
    //RECHERCHER UNE BD
    case "searchBD" :
        //PAR TITRE
        if(isset($_POST["searchTitle"]) && !empty($_POST["searchTitle"])) {
            $titre = $_POST["searchTitle"];
            $albums = BDMgr::searchBDByTitle($titre);
        }
        // PAR SERIE
        elseif(isset($_POST["searchSerie"]) && !empty($_POST["searchSerie"])) {
            $serie = $_POST["searchSerie"];
            $albums = BDMgr::searchBDBySerie($serie);
        }
        // PAR AUTEUR
        elseif(isset($_POST["searchAuthor"]) && !empty($_POST["searchAuthor"])) {
            $auteur = $_POST["searchAuthor"];
            $albums = BDMgr::searchBDByAuthor($auteur);
        }
        //VUE RECHERCHE BD
        require 'Views/view_searchBD.php';
        break;

    //AFFICHER DETAIL BD
    case "displayBD" :
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
                $exemplaires = ExemplaireMgr::getExemplairesByISBN($isbn);
                $nbEmprunts = 0;
                $dispos = [];
                $lieux = [];
                // CALCUL du NOMBRE D'EMPRUNTS
                foreach ($exemplaires as $line_num => $exp) {
                    try {
                    $nbEmprunts += count(EmpruntMgr::getCurrentEmpruntsByIdExemplaire($exp['ID_exemplaire']));
                    } catch (EmpruntMgrException $e) {
                        //RECUPERATION EXEMPLAIRES NON EMPRUNTES
                        $dispos[] = $exp['ID_exemplaire'];
                    }
                    
                }
                //CALCUL EXEMPLAIRES DISPOS
                if($nbEmprunts < 0) {
                    $nbDispo = count($exemplaires);
                } else {
                    $nbDispo = count($exemplaires) - ($nbEmprunts);
                }
               
                // RECUPERATION EMPLACEMENTS + BIBLIOTHEQUES DES EXEMPLAIRES DISPOS
                foreach ($dispos as $line_num => $expD) {
                    if(!empty(ExemplaireMgr::getExemplaireEmplacement($expD))) {
                        $idEmp = ExemplaireMgr::getExemplaireEmplacement($expD)[0]['idEmplacement'];
                        $emp = ExemplaireMgr::getExemplaireEmplacement($expD)[0]['code_emplacement'];
                        $bib = BibliothequeMgr::getBibliByEmplacement($idEmp)[0];
                        $lieux[] = $emp." : ".$bib;
                    } else {
                        $lieux[] = "Non renseigné";
                    } 
                    

                }
                //VUE DETAIL BD
                require 'Views/view_displayBD.php';
            } catch (BDMgrException $e) {
                $msg = $e->getMessage();
                //VUE ERREUR
                require 'Views/view_errorBD.php';
            }
            
            
        }
        else {
            $action = "searchBD";
        }
        break;

    // SUPPRIMER UNE BD
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
    
    //VALIDER SUPPRESSION
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

    // MODIFIER UNE BD
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

    // VALIDER MODIFICATION
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

    // AJOUTER UNE NOUVELLE BD
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

    // VALIDER AJOUT
    case "confirmAddBD" :
        //TESTS CHAMPS remplis
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

?>
