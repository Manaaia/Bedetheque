    
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
            <?php if(isset($check)) {
                if (!$check) { ?>
                <p class="alerte">Emprunt impossible</p> 
            <?php }} ?>
                <div>
                    <p>Choisissez une bibliothèque</p>
                    <select name="bibli" required>
                        <option value="">--Choisissez une bibliothèque--</option>
                        <?php foreach($aBibli as $bibli) {
                            if(isset($idBibli)) {
                                if($idBibli == $bibli->getIdBibli()) { ?>
                        <option value="<?php echo $bibli->getIdBibli()?>" selected><?php echo $bibli->getNomBibli()?></option> 
                            <?php } else { ?>
                        <option value="<?php echo $bibli->getIdBibli()?>"><?php echo $bibli->getNomBibli()?></option> 
                            <?php }
                            } else { ?>   
                        <option value="<?php echo $bibli->getIdBibli()?>"><?php echo $bibli->getNomBibli()?></option>
                        <?php }} ?>
                    </select>
                </div><br/><br/>
                <div id="gestionEmpruntRetour">
                    <div id="divemprunt" class="casegestion">
                        <div id="divtitreemprunt" class="positiontitre">
                            <h2 class="titre">Renseigner un emprunt</h2>
                        </div>
                        <div id="contenuemprunt">
                        <?php if(!$checkEmprunt) { ?>
                            <?php if(isset($message1)) { ?>
                            <p class="alerte"><?php echo $message1 ?></p>
                            <?php } else if(isset($messageSuccess1)) { ?>
                            <p class="success"><?php echo $messageSuccess1 ?></p>
                            <?php } ?>
                            <label>ISBN 1</label><br/>
                            <input id="code1" name="code1" type="text" class="article list" value="<?php echo $code1 ?>"/><br/>
                            <!-- <button id="btn1" class="btngestion">Valider</button> -->
                            <!-- <img id="icon1" class ="invisible icon" src="assets/image/icon_valider.png" alt="icon_valider"><br/><br/> -->
                            <?php if(isset($message2)) { ?>
                            <p class="alerte"><?php echo $message2 ?></p>
                            <?php } else if(isset($messageSuccess2)) { ?>
                            <p class="success"><?php echo $messageSuccess2 ?></p>
                            <?php } ?>
                            <label>ISBN 2</label><br/>
                            <input id="code2" name="code2" type="text" class="article list" value="<?php echo $code2 ?>"/><br/>
                            <!-- <button id="btn2" class="btngestion">Valider</button> -->
                            <!-- <img id="icon2" class ="invisible icon" src="assets/image/icon_valider.png" alt="icon_valider"><br/><br/> -->
                            <?php if(isset($message3)) { ?>
                            <p class="alerte"><?php echo $message3 ?></p>
                            <?php } else if(isset($messageSuccess3)) { ?>
                            <p class="success"><?php echo $messageSuccess3 ?></p>
                            <?php } ?>
                            <label>ISBN 3</label><br/>
                            <input id="code3" name="code3" type="text" class="article list" value="<?php echo $code3 ?>"/><br/>
                            <!-- <button id="btn3" class="btngestion">Valider</button> -->
                            <!-- <img id="icon3" class ="invisible icon" src="assets/image/icon_valider.png" alt="icon_valider"><br/><br/> -->
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
                            for($i = 0; $i< count($aBD); $i++) {?>
                            <p><?php echo $aBD[$i]->getTitreAlbum()?></p><br/>
                            <select name="etatBD">
                                <?php if($aExemplaires[$i]->getIdEtat() == 0) { ?>
                                <option value="0" selected><?php echo EtatMgr::getLabelEtat(0)?></option>
                                <option value="1"><?php echo EtatMgr::getLabelEtat(1)?></option>
                                <option value="2"><?php echo EtatMgr::getLabelEtat(2)?></option>
                                <?php } else if ($aExemplaires[$i]->getIdEtat() == 1) { ?>
                                <option value="0"><?php echo EtatMgr::getLabelEtat(0)?></option>
                                <option value="1" selected><?php echo EtatMgr::getLabelEtat(1)?></option>
                                <option value="2"><?php echo EtatMgr::getLabelEtat(2)?></option>
                                <?php } else if ($aExemplaires[$i]->getIdEtat() == 2) { ?>
                                <option value="0"><?php echo EtatMgr::getLabelEtat(0)?></option>
                                <option value="1"><?php echo EtatMgr::getLabelEtat(1)?></option>
                                <option value="2" selected><?php echo EtatMgr::getLabelEtat(2)?></option>
                                <?php } ?>
                            </select><br/>
                            <div><input type="radio" id="perdu" name="status" required><label for="perdu">Perdu</label></div>
                            <div><input type="radio" id="OK" name="status"><label for="ok">OK</label></div><br/><br/>
                        <?php }} ?>
                        </div>
                    </div>
                </div>
                <div id="btns">
                <input type="hidden" name="action" value="emprunt&retour">
                <input type="hidden" name="type" value="Emprunt">
                <input type="hidden" name="idAdherent" value="<?php echo $idAdherent ?>">
                <button type="submit">Enregistrer</button>
            </form>
            <form  method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input type="hidden" name="action" value="searchAdherent">
                <input type="hidden" name="type" value="Adherent">
                <button id="abandon">Retour</button>
            </form>
            </div>
        </fieldset>
    </div>