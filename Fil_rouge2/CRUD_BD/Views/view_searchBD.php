<!-- FLAVIE --> 

<!-- Page de recherche (+ ajout si gestionnaire) BDs -->
<container id="main">
           
            <div id="searchDiv">
                <h1>Albums BDs</h1>

                <!-- FORMULAIRE RECHERCHE DANS LE CATALOGUE -->
                <form action="index.php" method="POST">
                <!-- TITRE -->
                <div>
                    <label class="label" for="searchTitle">Titre : </label>
                    <input type="search" name="searchTitle" id="searchTitle">
                    <input type="hidden" name="type" value="BD">
                    <input type="hidden" name="action" value="searchBD">
                    <button type="submit" id="searchBtn">Rechercher</button>
                    
                </div>
                
                <!-- SERIE -->
                <div>
                    <label class="label" for="searchSerie">Série : </label>
                    <input type="search" name="searchSerie" id="searchSerie">
                    <input type="hidden" name="type" value="BD">
                    <input type="hidden" name="action" value="searchBD">
                    <button type="submit" id="searchBtn">Rechercher</button>
                    
                </div>
                
                <!-- AUTEUR -->
                <div>
                    <label class="label" for="searchAuthor">Auteur : </label>
                    <input type="search" name="searchAuthor" id="searchAuthor">
                    <input type="hidden" name="type" value="BD">
                    <input type="hidden" name="action" value="searchBD">
                    <button type="submit" id="searchBtn">Rechercher</button>
                    
                </div>
                <br />
        <!-- Bouton ajouter BD : NE S'AFFICHE QUE SI l'UTILISATEUR EST GESTIONNAIRE -->
        <?php if (isset($_SESSION["user"])) {
            if ($role == 4) { ?>
                <div>
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
                        <div>
                            <button type="submit" name="action" value="addNewBD">Ajouter une BD</button>
                        </div>
                    </form>
                </div>
        <?php }
                } ?>

            <!-- AFFICHAGE DES RÉSULTATS DE RECHERCHE -->
            </form>    
            </div>
            <div id="resultats">
                <h2 id="discover">Résultats de recherche</h2>
                <div id="cards">
                    
                    <?php if(empty($albums)) {
                        echo "<h2>Aucune BD correspondante</h2>";
                    } else {
                        foreach ($albums as $line_num => $album) {
                        $titreAlbum = $album['Titre_album'];
                        $serieAlbum = $album['Nom_serie'];
                        $auteurAlbum = $album['Nom_auteur'];
                        $monAlbum = BDMgr::searchBDByISBN($album['ISBN']);
                        $miniature = $monAlbum->getMiniImage(); ?>
                        <figure class="card">
                            <!-- RECUPERATION INFOS BD + LIEN DETAIL BD -->
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <img src="Contenu/assets/image/albumsMini/<?php echo $miniature; ?>">
                            <figcaption><?php echo "<p>".$titreAlbum."</p>
                                <p>Série : ".$serieAlbum."</p>
                                <p>Auteur : ".$auteurAlbum."</p>"; ?></figcaption>
                            <input type="hidden" name="auteur" value="<?php echo $auteurAlbum; ?>">
                            <input type="hidden" name="serie" value="<?php echo $serieAlbum; ?>">
                            <input type="hidden" name="id" value="<?php echo $album['ISBN']; ?>">
                            <input type="hidden" name="action" value="displayBD">
                            <input type="hidden" name="type" value="BD">
                            <button type="submit"> + </button>
                            </form>
                        </figure>
                        <?php }
                        } ?>
                    
                    
                </div>
            </div>
        </container>