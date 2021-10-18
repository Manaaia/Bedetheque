
<div class="container">
        <fieldset class="form"><legend for="form">Créer un nouvel utilisateur</legend>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div>
                <?php if(isset($addMessage)) { 
                        if($addMessage) { ?>
                    <p class="success">Employé ajouté avec succès</p>
                    <?php } else { ?>
                    <p class="alerte">Erreur : champs renseignés incorrects.</p>
                    <?php }} ?>
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
                            <input type="text" class="lettre" id="netrue" name="adresse1" placeholder="Veuillez renseigner un numéro et nom de rue" required><br/>
                            <label for="rue">Complément d'adresse</label><br/>
                            <input type="text" class="lettre" id="complement" name="adresse2" placeholder="--"><br/>
                            <label for="code">Code postal (*)</label><br/>
                            <input type="text" class="chiffre" id="code" name="cp" placeholder="00000" required><br/>
                            <label for="ville">Ville (*)</label><br/>
                            <input type="text" class="lettre" id="ville" name="ville" placeholder="Veuillez renseigner une ville" required>
                        </p>
                    </div>
                    <div>
                        <h3 class="label">Mot de passe</h3>
                        <label for="mdp">Mot de passe (*)</label><br/>
                        <p><input type="text" id="mdp" name="mdp" placeholder="Au moins 8 caractères dont miniscule, majuscule, chiffre, symbole." required></p>
                    </div>
                    <div>
                        <h3 class="label">Poste occupé</h3>
                        <label for="role">Poste occupé (*)</label><br/>
                        <p>
                            <select name="role">
                                <option value="1"><?php echo RoleMgr::getLabelRole(1) ?></option>
                                <option value="2"><?php echo RoleMgr::getLabelRole(2) ?></option>
                                <option value="3"><?php echo RoleMgr::getLabelRole(3) ?></option>
                                <option value="4"><?php echo RoleMgr::getLabelRole(4) ?></option>
                            </select>
                        </p>
                    </div>
                    <input type="hidden" name="action" value="addEmploye">
                    <input type="hidden" name="type" value="Employe">
                </div>
                <div id="btns">
                    <button type="reset" id="abandon">Réinitialiser</button>
                    <button type="submit" id="submit">Valider</button>
                </div>
            </form>
        </fieldset>
    </div>