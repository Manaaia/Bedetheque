    <!-- Page d'accueil -->
        <container id="main">
            <div id="searchDiv">
                <h1>Bienvenue au Centre Culturel des Marmusots</h1>

                <!-- FORMULAIRE RECHERCHE DANS LE CATALOGUE (FLAVIE) -->
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
            </form>    
                
            </div>

            <!-- SUGGESTIONS ALEATOIRES DE BDs À DÉCOUVRIR (MANON)--> 
            <div id="newItems">
                <h2 id="discover">Découvrir</h2>
                <div id="cards">
                    <?php foreach($aReco as $reco) {
                    $album = BDMgr::searchBDByISBN($reco); 
                    $albumInfo = BDMgr::searchBDByTitle($album->getTitreAlbum());
                    ?>
                    <figure class="card">
                        <!-- RECUPERATION INFOS BD + LIEN DETAIL BD -->
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <img src="Contenu/assets/image/albumsMini/<?php echo $album->getMiniImage();?>">
                        <figcaption>
                            <?php echo "<p>".$album->getTitreAlbum()."</p>";?>
                            <?php echo "<p> Série : ".$albumInfo[0]['Nom_serie']."</p>";?>
                            <?php echo "<p>Auteur : ".$albumInfo[0]['Nom_auteur']."</p>";?>
                        </figcaption>
                        <input type="hidden" name="auteur" value="<?php echo $albumInfo[0]['Nom_auteur'];?>">
                        <input type="hidden" name="serie" value="<?php echo $albumInfo[0]['Nom_serie'];?>">
                        <input type="hidden" name="id" value="<?php echo $album->getISBN();?>">
                        <input type="hidden" name="action" value="displayBD">
                        <input type="hidden" name="type" value="BD">
                        <button type="submit"> + </button>
                        </form>
                    </figure>
                    <?php } ?>
                </div>
            </div>
        </container>