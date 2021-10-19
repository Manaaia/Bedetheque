    
    <div class="container">
        <fieldset class="form"><legend for="form">Gestion adhérent</legend>
            <div class="adherentselect">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
                    <p class="label">Adhérent</p>
                    <p id="adherent"><?php echo $prenomAdherent." ".$nomAdherent?></p>
                    <input type="hidden" name="action" value="modifyAdherent">
                    <input type="hidden" name="type" value="Adherent">
                    <input type="hidden" name="idAdherent" value="<?php echo $idAdherent?>">
                    <button type="submit" id="fiche">Voir fiche</button>
                </form>
            </div>
            <hr>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
                <div>
                    <p>Choisissez une bibliothèque</p>
                    <select name="bibli" required>
                        <option value="">--Choisissez une bibliothèque--</option>
                        <?php foreach($aBibli as $bibli) { ?>
                        <option value="<?php echo $bibli->getIdBibli()?>"><?php echo $bibli->getNomBibli()?></option>
                        <?php } ?>
                    </select>
                </div><br/><br/>
                <div id="gestionEmpruntRetour">
                    <div id="divemprunt" class="casegestion">
                        <div id="divtitreemprunt" class="positiontitre">
                            <h2 class="titre">Renseigner un emprunt</h2>
                        </div>
                        <div id="contenuemprunt">
                        <?php if(!$checkEmprunt) { ?>
                            <p id="alertemprunt"></p>
                                <label>Code article 1</label><br/>
                                <input id="code1" name="code1" type="text" class="article list"/><br/>
                                <button id="btn1" class="btngestion">Valider</button>
                                <img id="icon1" class ="invisible icon" src="assets/image/icon_valider.png" alt="icon_valider"><br/><br/>
                                <label>Code article 2</label><br/>
                                <input id="code2" name="code2" type="text" class="article list"/><br/>
                                <button id="btn2" class="btngestion">Valider</button>
                                <img id="icon2" class ="invisible icon" src="assets/image/icon_valider.png" alt="icon_valider"><br/><br/>
                                <label>Code article 3</label><br/>
                                <input id="code3" name="code3" type="text" class="article list"/><br/>
                                <button id="btn3" class="btngestion">Valider</button>
                                <img id="icon3" class ="invisible icon" src="assets/image/icon_valider.png" alt="icon_valider"><br/><br/>
                            <?php } else if($checkEmprunt) {?>
                            <p>Impossible d'emprunter tant que l'emprunt en cours n'a pas été rendu</p>
                            <?php } ?>
                        </div>
                    </div>
                    <div id="divretour" class="casegestion">
                        <div id = "divtitreretour" class="positiontitre">
                            <h2 class="titre">Renseigner un retour</h2>
                        </div>
                        <div id="contenuretour">
                        <?php if(!$checkEmprunt) { ?>
                            <p>Aucun emprunt en cours</p>
                        <?php } else if ($checkEmprunt) { 
                            foreach($aBD as $uneBD) {?>
                            <p><?php echo $uneBD->getTitreAlbum()?></p><br/>
                            <select name="etatBD">
                                <option value="selectEtat">Modifier état</option>
                                <option value="neuf">Neuf</option>
                                <option value="abime">Abîmé</option>
                            </select><br/>
                            <div><input type="radio" id="perdu" name="status"><label for="perdu">Perdu</label></div>
                            <div><input type="radio" id="OK" name="status"checked><label for="ok">OK</label></div><br/><br/>
                        <?php }} ?>
                        </div>
                    </div>
                </div>
                <div id="btns">
                <input type="hidden" name="action" value="emprunt&retour">
                <input type="hidden" name="type" value="Emprunt">
                <input type="hidden" name="type" value="Emprunt">
                <button type="submit">Enregistrer</button>
            </form>
            <form  method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input type="hidden" name="action" value="searchAdherent">
                <input type="hidden" name="type" value="Adherent">
                <input type="hidden" name="idAdherent" value="<?php echo $idAdherent ?>">
                <button id="abandon">Retour</button>
            </form>
            </div>
        </fieldset>
    </div>