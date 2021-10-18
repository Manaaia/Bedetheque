    <div class="container">
        <fieldset class="form"><legend for="form">Créer un nouvel adhérent</legend>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div>
                    <?php if(isset($addMessage)) { ?>
                    <p class="success">Adhérent ajouté avec succès</p>
                    <?php } ?>
                    <p id="alertesaisie" class="alerte invisible"></p>
                    <p>(*) Champs obligatoires</p>
                    <div>
                        <h3 class="label">Identité</h3>
                        <p class="identite">
                            <label for="nomadherent">Nom (*)</label><br/>
                            <input type="text" class = "lettre" id="nomadherent" name="nom" placeholder="Veuillez renseigner un nom" required><br/>
                            <label for="prenomadherent">Prénom (*)</label><br/>
                            <input type="text" class = "lettre" id="prenomadherent" name="prenom" placeholder="Veuillez renseigner un prénom" required>
                        </p>
                    </div>
                    <div>
                        <h3 class="label">Adresse</h3>
                        <p id="adresseadherent">
                            <label for="numero">N° et nom de rue (*)</label><br/>
                            <input type="text" class="lettre" id="netrue" name="adresse1" placeholder="Veuillez renseigner un numéro et nom de rue"><br/>
                            <label for="rue">Complément d'adresse</label><br/>
                            <input type="text" class="lettre" id="complement" name="adresse2" placeholder="--"><br/>
                            <label for="code">Code postal (*)</label><br/>
                            <input type="text" class="chiffre" id="code" name="cp" placeholder="00000"><br/>
                            <label for="ville">Ville (*)</label><br/>
                            <input type="text" class="lettre" id="ville" name="ville" placeholder="Veuillez renseigner une ville">
                        </p>
                    </div>
                    <div>
                        <h3 class="label">Mot de passe</h3>
                        <label for="mdp">Mot de passe (*)</label><br/>
                        <p><input type="text" id="mdp" name="mdp" placeholder="Au moins 8 caractères dont miniscule, majuscule, chiffre, symbole."></p>
                    </div>
                    <div>
                        <h3 class="label">Date de règlement de la cotisation annuelle</h3>
                        <label for="datecot">Date de règlement de la cotisation annuelle (*)</label><br/>
                        <p><input type="date" id="datecot" name="dateCo" value=""></p>
                    </div>
                    <input type="hidden" name="action" value="addAdherent">
                    <input type="hidden" name="type" value="Adherent">
                </div>
                <div id="btns">
                    <button id="abandon">Réinitialiser</button>
                    <button type="submit" id="submit">Valider</button>
                </div>
            </form>
        </fieldset>
    </div>