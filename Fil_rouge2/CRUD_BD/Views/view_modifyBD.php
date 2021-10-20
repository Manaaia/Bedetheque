<div class="container">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <fieldset class="form"><legend for="form">Modification d'une BD</legend>
            <div id="rechercheExemplaire">
                <input type="hidden" name="type" value="BD">
                <input type="hidden" name="id" value="<?php echo $isbn; ?>">
                <p class="label">ISNB : <?php echo $isbn; ?></p>
                <p id="isbn"></p>
            </div>
            <hr>
            <div class="visible" id="container-bd" >
                <div id="modifBD" class="visible" >
                    <div id="alertesaisie" class="alerte invisible"></div>

                    <div>
                        <label class="label" for="titre">Titre : <input type="text" name="titre" id="titre" value="<?php echo $titreBD; ?>"></label>
                        <p id="titreBD"></p>
                    </div>

                    <br/>

                    <div>                    
                        <label class="label" for="num">Numéro d'album : <input type="text" name="num" id="num" value="<?php echo $numeroBD; ?>"></label>
                        <p id="numBD"></p>
                    </div>

                    <br/>

                    <div>
                        <label class="label">Auteur : <select type="text">
                            <optgroup>
                            <?php foreach ($listAuthors as $line_num => $auteur) { 
                                  ?>
                                    <option name="auteur" value="<?php echo $auteur['idAuteur'].' : '.$auteur['Nom_auteur']; ?>" <?php if($auteur['idAuteur'] == $auteurBD) { ?> selected <?php } ?>>
                                    <?php echo $auteur['idAuteur']." : ".$auteur['Nom_auteur'];  { ?></option>
                                <?php }
                            }
                            ?>
                            </optgroup>
                        </select></label>
                        
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