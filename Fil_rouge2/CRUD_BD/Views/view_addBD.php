<?php if ($action == "confirmAddBD") { ?>
            
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
        <fieldset class="form"><legend for="form">Ajout d'une BD</legend>
            <div id="rechercheExemplaire">
                <input type="hidden" name="type" value="BD">
                
                <label class="label" for="id">ISBN : </label><input type="text" name="id">
                <p id="isbn"></p>
            </div>
            <hr>
            <div class="visible" id="container-bd" >
                <div id="modifBD" class="visible" >
                    <div id="alertesaisie" class="alerte invisible"></div>

                    <div>
                        <label class="label" for="titre">Titre : <input type="text" name="titre" id="titre"></label>
                        <p id="titreBD"></p>
                    </div>

                    <br/>

                    <div>                    
                        <label class="label" for="num">Numéro d'album : <input type="text" name="num" id="num"></label>
                        <p id="numBD"></p>
                    </div>

                    <br/>
                    <div>
                        
                        <label class="label" for="selectauteur">Auteur : </label><select type="text" name="selectauteur" > 
                            <?php foreach ($listAuthors as $line_num => $auteur) {
                                  ?>
                                    
                                    <option name="selectauteur" value="<?php echo $auteur['idAuteur'].' : '.$auteur['Nom_auteur']; ?>">
                                    <?php echo $auteur['idAuteur']." : ".$auteur['Nom_auteur'];  ?></option>
                                <?php }
                            ?>
                        </select>
                        
                        <p id="selectAuteur"></p>
                    </div>

                    <br/>
                                
                    <div>
                        <label class="label" for="selectserie">Série : <select type="text" name="selectserie">
                            
                            <?php foreach ($listSeries as $line_num => $serie) { 
                                  ?>
                                    <option name="selectserie" value="<?php echo $serie['idSerie'].' : '.$serie['Nom_serie']; ?>">
                                    <?php echo $serie['idSerie']." : ".$serie['Nom_serie'];  ?></option>
                                <?php }
                            
                            ?>
                            
                        </select></label>
                        <p id="selectSerie">
                        </p>
                    </div>

                    <br>
                    <div>
                    <label class="label" for="resume">Résumé : </label> <textarea type="text" rows="5" cols="33" class="input text" name="resume" id="resume" ></textarea>
                        <p id="resumeBD"></p>
                        
                    </div>

                    <br>
                    <div>
                        <label class="label" for="prix">Prix : <input type="text" name="prix" id="prix"></label>
                        <p id="prixBD"></p>
                    </div>
                    <br>


                    <br>
                </div>
                <div id="th2">
                    <div><label class="label" for="image">Choisir une image :</label><input type="file" id="image" name="image" accept="image/png, image/jpeg"></div>       
                </div>
            </div>
                
                <div id="btns">
                <?php if (isset($_SESSION["user"])) {
                        if ($role == 4) { ?>
                            <button type="submit" name="action" id="confirmMod" value="confirmAddBD">Confirmer</button>
                            <button type="submit" name="action" id="resetMod" value="searchBD">Annuler</button>
                        <?php } 
                        } ?>

                </div>
            </div> 
        </fieldset>
    </form>        
</div>
                    <?php } ?>