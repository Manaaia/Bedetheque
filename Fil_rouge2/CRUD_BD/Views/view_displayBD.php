<div class="container">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <fieldset class="form"><legend for="form">Fiche BD</legend>
            <div id="rechercheExemplaire">
                <input type="hidden" name="type" value="BD">
                <input type="hidden" name="id" value="<?php echo $isbn; ?>">

                <!-- AFFICHAGE DETAIL BD -->

                <p class="label">ISBN : <?php echo $isbn; ?></p>
                <p id="isbn"></p>
            </div>
            <hr>
            <div class="visible" id="container-bd" >
                <div id="ajoutBD" class="visible" >
                    <div id="alertesaisie" class="alerte invisible"></div>

                    <div>
                        <p class="label">Titre : <?php echo $titreBD; ?></p>
                        <p id="titreBD">
                    </div>

                    <br/>

                    <div>                    
                        <p class="label">Numéro d'album : <?php echo $numeroBD; ?></p>
                        <p id="numBD"></p>
                    </div>

                    <br/>

                    <div>
                        <input type="hidden" name="auteur" value="<?php echo $nomAuteur; ?>">
                        <p class="label">Auteur : <?php echo $auteurBD." : ".$nomAuteur; ?></p>
                        <p id="selectAuteur"></p>
                    </div>

                    <br/>
                                
                    <div>
                        <input type="hidden" name="serie" value="<?php echo $nomSerie; ?>">
                        <p class="label">Série : <?php echo $serieBD." : ".$nomSerie; ?></p>
                        <p id="selectSerie">
                        </p>
                    </div>

                    <br>
                    <div>
                        <p class="label">Résumé : <?php echo $resumeBD; ?></p>
                        <p id="resumeBD"></p>
                        
                    </div>

                    <br>
                    <div>
                        <p class="label">Prix : <?php echo $prixBD; ?></p>
                        <p id="prixBD"></p>
                    </div>
                    <br>

                    <br>
                    <div>
                        <p class="label">Exemplaires disponibles : <?php echo $nbDispo; ?></p>
                        <p id="expDispo"></p>
                    </div>
                    <br>

                    <br>
                    <div>
                        <p class="label">Emplacements : <ul><?php foreach($lieux as $line_num => $line) {
                            echo "<li>".$line."</li>"; } ?></ul></p>
                        <p id="expDispo"></p>
                    </div>
                    <br>

                    <br>
                </div>
                <div id="th2">
                    <img id="imgBD" src="Contenu/assets/image/albumsMini/<?php echo $couvBD; ?>">
                </div>
            </div>

                <!-- Boutons : NE S'AFFICHENT QUE SI l'UTILISATEUR EST GESTIONNAIRE -->

                <div id="btns">
                <?php if (isset($_SESSION["user"])) {
                        if ($role == 4) { ?>
                            <button type="submit" name="action" id="modifierBD" value="modifyBD">Modifier</button>
                            <button type="submit" name="action" id="supprimerBD" value="deleteBD">Supprimer</button>
                            
                        <?php 
                        }
                    } ?>

                </div>
            </div> 
        </fieldset>
    </form>

    <!-- Bouton : NE S'AFFICHE QUE SI l'UTILISATEUR EST GESTIONNAIRE -->
    
    <?php if (isset($_SESSION["user"])) {
                        if ($role == 4) { ?>
                            <button type="text" style="color: red;" id="ajouterExemplaire">Ajouter Exemplaire : EN CONSTRUCTION</button>
                        <?php 
                        }
                    } ?>
            
</div>