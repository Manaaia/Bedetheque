<div class="container">
            <fieldset class="form"><legend for="form">Modifier adhérent</legend>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div>
                    <p id="alertesaisie" class="alerte invisible"></p>
                    <div>
                        <h3 class="label">Identité</h3>
                        <p class="identite">
                            <label for="nomadherent">Nom</label><br/>
                            <input type="text" class="lettre" id="nomadherent" name="newNom" value="<?php echo $nom ?>" required><br/>
                            <label for="prenomadherent">Prénom</label><br/>
                            <input type="text" class="lettre" id="prenomadherent" name="newPrenom" value="<?php echo $prenom ?>" required>
                        </p>
                    </div>
                    <div>
                        <h3 class="label">Adresse</h3>
                        <p id="adresseadherent">
                            <label for="NetRue">N° et rue</label><br/>
                            <input type="text" class="lettre" id="NetRue" name="newAdresse1" value="<?php echo $nEtRue ?>"><br/>
                            <label for="rue">Complément d'adresse</label><br/>
                            <?php if (isset($adresse2)) { ?>
                            <input type="text" class="lettre" id="complement" name="newAdresse2" value="<?php echo $adresse2 ?>"><br/>
                            <?php } else { ?>
                            <input type="text" class="lettre" id="complement" name="newAdresse2" placeholder="--"><br/>
                            <?php } ?>
                            <label for="code">Code postal</label><br/>
                            <input type="text" class="chiffre" id="code" name="newCp" value="<?php echo $cp ?>"><br/>
                            <label for="ville">Ville</label><br/>
                            <input type="text" class="lettre" id="ville" name="newVille" value="<?php echo $ville ?>">
                        </p>
                    </div>
                    <div>
                        <h3 class="label">Date de règlement de la cotisation annuelle</h3>
                        <p><input type="date" id="datecot" name="newDateCot" value="<?php echo $dateCo ?>"></p>
                    
                    <?php if ($checkDateCo == 1) { ?>
                        <p class="alerte">Attention, la cotisation expire dans <?php echo $interval ?> jours.</p>
                    <?php } else if ($checkDateCo == 0) { ?>
                        <p class="alerte">La cotisation est expirée.</p>
                     <?php } ?>
                    </div>
                    <div>
                        <h3 class="label invisible">Amendes</h3>
                        <p id="amende" class="invisible">Aucune amende en attente</p>
                    </div>
                    <input type="hidden" name="action" value="modifyAdherentUpdate">
                    <input type="hidden" name="type" value="Adherent">
                </div>
                <div id="btns">
                    <button id="abandon">Abandonner</button>
                    <button type="submit" id="submit">Valider</button>
                </div>
                    </form>
                <br/><hr><br/>
                <div>
                    <button class="delete">Supprimer ce compte adhérent ?</button>
                </div>
            </fieldset>
    </div>