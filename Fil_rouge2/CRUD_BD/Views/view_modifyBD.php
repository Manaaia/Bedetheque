<?php if ($action == "confirmModifyBD") { ?>
            
            <div class="container">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <fieldset class="form"><legend for="form">Modification d'une BD</legend>
                    <div id="rechercheExemplaire">
                        <div>
                            <p><?php echo $msg; ?></p>
                        </div>
                    </div>
                    </fieldset>
                </form>
            </div>

       <?php } else {
        ?>

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
<input type="hidden" name="auteur" value="<?php echo $nomAuteur; ?>">
                    <div>
                        
                        <label class="label" for="selectauteur">Auteur : </label><select type="text" name="selectauteur" > 
                            <optgroup>
                            <?php foreach ($listAuthors as $line_num => $auteur) {
                                  ?>
                                    
                                    <option name="selectauteur" value="<?php echo $auteur['idAuteur'].' : '.$auteur['Nom_auteur']; ?>" <?php if($auteur['idAuteur'] == $auteurBD) { ?> selected <?php } ?>>
                                    <?php echo $auteur['idAuteur']." : ".$auteur['Nom_auteur'];  ?></option>
                                <?php }
                            ?>
                            </optgroup>
                        </select>
                        
                        <p id="selectAuteur"></p>
                    </div>

                    <br/>
                                
                    <div>
                        <input type="hidden" name="serie" value="<?php echo $nomSerie; ?>">
                        <label class="label" for="selectserie">Série : <select type="text" name="selectserie">
                            
                            <?php foreach ($listSeries as $line_num => $serie) { 
                                  ?>
                                    <option name="selectserie" value="<?php echo $serie['idSerie'].' : '.$serie['Nom_serie']; ?>" <?php if($serie['idSerie'] == $serieBD) { ?> selected <?php } ?>>
                                    <?php echo $serie['idSerie']." : ".$serie['Nom_serie'];  ?></option>
                                <?php }
                            
                            ?>
                            
                        </select></label>
                        <p id="selectSerie">
                        </p>
                    </div>

                    <br>
                    <div>
                    <label class="label" for="resume">Résumé : </label> <textarea type="text" rows="5" cols="33" class="input text" name="resume" id="resume" value="<?php echo $resumeBD; ?>"><?php echo $resumeBD; ?></textarea>
                        <p id="resumeBD"></p>
                        
                    </div>

                    <br>
                    <div>
                        <label class="label" for="prix">Prix : <input type="text" name="prix" id="prix" value="<?php echo $prixBD; ?>"></label>
                        <p id="prixBD"></p>
                    </div>
                    <br>


                    <br>
                </div>
                <div id="th2">
                    <input type="hidden" name="idImage" value="<?php echo $couvBD; ?>">
                    <div><label class="label" for="image">Choisir une image :</label><input type="file" id="image" name="image" accept="image/png, image/jpeg"></div>
                    <img id="imgBD" src="Contenu/assets/image/albumsMini/<?php echo $couvBD; ?>">       
                    
                </div>
            </div>
                
                <div id="btns">
                <?php if (isset($_SESSION["user"])) {
                        if ($role == 4) { ?>
                            <button type="submit" name="action" id="confirmMod" value="confirmModifyBD">Confirmer</button>
                            <button type="submit" name="action" id="resetMod" value="displayBD">Annuler</button>
                        <?php } elseif ($role == 3) { ?>
                            <button type="submit" name="action" id="emprunterBD" value="borrowBD">Effectuer un emprunt</button>

                        <?php }
                        } ?>

                </div>
            </div> 
        </fieldset>
    </form>        
</div>
                    <?php } ?>