<div class="container">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <fieldset class="form"><legend for="form">Fiche BD</legend>
            <div id="rechercheExemplaire">
                <p class="label">ISNB : <?php echo $isbn; ?></p>
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
                        <p class="label">Auteur : <?php echo $auteurBD." : ".$nomAuteur; ?></p>
                        <p id="selectAuteur"></p>
                    </div>

                    <br/>
                                
                    <div>
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
                        <p class="label">Emplacements : <?php echo $emplacement." : ".$bibli; ?></p>
                        <p id="expDispo"></p>
                    </div>
                    <br>

                    <br>
                </div>
                <div id="th2">
                    <img id="imgBD" src="Contenu/assets/image/albumsMini/<?php echo $couvBD; ?>">
                </div>
            </div>
                
                <div id="btns">
                <?php if (isset($_SESSION["user"])) {
                        if ($role == 4) { ?>
                            <button type="submit" name="action" id="modifierBD" value="modifyBD">Modifier</button>
                            <button type="submit" name="action" id="supprimerBD" value="deleteBD">Supprimer</button>
                            <button type="submit" name="action" id="ajouterExemplaire" value="add">Ajouter Exemplaire</button>
                        <?php } elseif ($role == 3) { ?>
                            <button type="submit" name="action" id="emprunterBD" value="borrowBD">Effectuer un emprunt</button>

                        <?php }
                        } ?>

                </div>
            </div> 
        </fieldset>
    </form>        
</div>