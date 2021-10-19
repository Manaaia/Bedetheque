    
        <container id="main">
            <div id="searchDiv">
                <h1>Bienvenue au Centre Culturel des Marmusots</h1>
                <form action="index.php" method="POST"></form>
                <div>
                    <input type="search" name="searchTitle" id="searchTitle"> <button id="searchBtn">Rechercher</button>
                    
                </div>
                
                <div>
                    <input type="search" name="searchSerie" id="searchSerie"> <button id="searchBtn">Rechercher</button>
                    
                </div>
                
                <div>
                    <input type="search" name="searchAuthor" id="searchAuthor"> <button id="searchBtn">Rechercher</button>
                    
                </div>
                
                
            </div>
            <div id="newItems">
                <h2 id="discover">Découvrir</h2>
                <div id="cards">
                    <?php foreach($aReco as $reco) { 
                    $album = BDMgr::searchBDByISBN($reco); ?>
                    <figure class="card">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                        <img src="Contenu/assets/image/albumsMini/<?php echo $album->getMiniImage()?>">
                        <figcaption><?php echo $album->getTitreAlbum()?></figcaption>
                        <input type="hidden" name="action" value="displayBD">
                        <input type="hidden" name="type" value="BD">
                        <button type="submit"> + </button>
                        </form>
                    </figure>
                    <?php } ?>
                </div>
            </div>
        </container>