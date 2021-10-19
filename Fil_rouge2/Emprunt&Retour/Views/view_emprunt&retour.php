    
    <div class="container">
        <fieldset class="form"><legend for="form">Gestion adhérent</legend>
            <div class="adherentselect">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
                    <p class="label">Adhérent</p>
                    <p id="adherent"><?php echo $prenom." ".$nom?></p>
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
                    <select name="bibli">
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
                            <!--Placeholder div emprunt-->
                        </div>
                    </div>
                    <div id="divretour" class="casegestion">
                        <div id = "divtitreretour" class="positiontitre">
                            <h2 class="titre">Renseigner un retour</h2>
                        </div>
                        <div id="contenuretour">
                            <!--Placeholder div retour-->
                        </div>
                    </div>
                </div>
                <div id="btns">
                <button id="submit">Enregistrer</button>
            </form>
            <form  method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input type="hidden" name="action" value="searchAdherent">
                <input type="hidden" name="type" value="Adherent">
                <button id="abandon">Retour</button>
            </form>
            </div>
        </fieldset>
    </div>