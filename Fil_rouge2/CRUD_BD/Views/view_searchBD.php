<container id="main">
            <div id="searchDiv">
                <h1>Bienvenue au Centre Culturel des Marmusots</h1>
                <form action="index.php" method="POST">
                <div>
                    <input type="search" name="searchTitle" id="searchTitle">
                    <input type="hidden" name="type" value="BD">
                    <input type="hidden" name="action" value="searchBD">
                    <button type="submit" id="searchBtn">Rechercher</button>
                    
                </div>
                
                <div>
                    <input type="search" name="searchSerie" id="searchSerie">
                    <input type="hidden" name="type" value="BD">
                    <input type="hidden" name="action" value="searchBD">
                    <button type="submit" id="searchBtn">Rechercher</button>
                    
                </div>
                
                <div>
                    <input type="search" name="searchAuthor" id="searchAuthor">
                    <input type="hidden" name="type" value="BD">
                    <input type="hidden" name="action" value="searchBD">
                    <button type="submit" id="searchBtn">Rechercher</button>
                    
                </div>
            </form>    
                
            </div>
            <div id="resultats">
                <h2 id="discover">Résultats de recherche</h2>
                <div id="cards">
                    
                    <?php if(empty($albums)) {
                        echo "<h2>Aucune BD correspondante</h2>";
                    } else {
                        // var_dump($albums);
                        foreach ($albums as $line_num => $album) {
                        $titreAlbum = $album['Titre_album'];
                        $serieAlbum = $album['Nom_serie'];
                        $auteurAlbum = $album['Nom_auteur'];
                        $monAlbum = BDMgr::searchBDByISBN($album['ISBN']);
                        $miniature = $monAlbum->getMiniImage(); ?>
                        <figure class="card">
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