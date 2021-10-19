
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
                            <input type="text" class = "lettre" id="nomadherent" name="nomEmploye" placeholder="Veuillez renseigner un nom" value="<?php echo $nomEmploye ?>"required><br/>
                            <label for="prenomadherent">Prénom (*)</label><br/>
                            <input type="text" class = "lettre" id="prenomadherent" name="prenomEmploye" placeholder="Veuillez renseigner un prénom" value="<?php echo $prenomEmploye ?>" required>
                        </p>
                    </div>
                    <div>
                        <h3 class="label">Adresse</h3>
                        <p id="adresseadherent">
                            <label for="numero">N° et nom de rue (*)</label><br/>
                            <input type="text" class="lettre" id="netrue" name="adresse1" placeholder="Veuillez renseigner un numéro et nom de rue" value="<?php echo $adresse1 ?>" required><br/>
                            <label for="rue">Complément d'adresse</label><br/>
                            <input type="text" class="lettre" id="complement" name="adresse2" placeholder="--" value="<?php echo $adresse2 ?>"><br/>
                            <label for="code">Code postal (*)</label><br/>
                            <input type="text" class="chiffre" id="code" name="cp" placeholder="00000" value="<?php echo $cp ?>" required><br/>
                            <label for="ville">Ville (*)</label><br/>
                            <input type="text" class="lettre" id="ville" name="ville" placeholder="Veuillez renseigner une ville" value="<?php echo $ville ?>" required>
                        </p>
                    </div>
                    <div>
                        <h3 class="label">Mot de passe</h3>
                        <label for="mdp">Mot de passe (*)</label><br/>
                        <p><input type="text" id="mdp" name="mdp" placeholder="Au moins 8 caractères dont miniscule, majuscule, chiffre, symbole." value="<?php echo $mdp ?>" required></p>
                    </div>
                    <div>
                        <h3 class="label">Poste occupé</h3>
                        <label for="role">Poste occupé (*)</label><br/>
                        <p>
                        <select name="roleEmploye">
                                <?php if($role == 1) { ?>
                                <option value="1" selected><?php echo RoleMgr::getLabelRole(1) ?></option>
                                <option value="2"><?php echo RoleMgr::getLabelRole(2) ?></option>
                                <option value="3"><?php echo RoleMgr::getLabelRole(3) ?></option>
                                <option value="4"><?php echo RoleMgr::getLabelRole(4) ?></option>
                                <?php } else if ($role == 2) { ?>
                                <option value="1"><?php echo RoleMgr::getLabelRole(1) ?></option>
                                <option value="2" selected><?php echo RoleMgr::getLabelRole(2) ?></option>
                                <option value="3"><?php echo RoleMgr::getLabelRole(3) ?></option>
                                <option value="4"><?php echo RoleMgr::getLabelRole(4) ?></option>
                                <?php } else if ($role == 3) { ?>
                                <option value="1"><?php echo RoleMgr::getLabelRole(1) ?></option>
                                <option value="2"><?php echo RoleMgr::getLabelRole(2) ?></option>
                                <option value="3" selected><?php echo RoleMgr::getLabelRole(3) ?></option>
                                <option value="4"><?php echo RoleMgr::getLabelRole(4) ?></option>
                                <?php } else if ($role == 4) { ?>
                                <option value="1"><?php echo RoleMgr::getLabelRole(1) ?></option>
                                <option value="2"><?php echo RoleMgr::getLabelRole(2) ?></option>
                                <option value="3"><?php echo RoleMgr::getLabelRole(3) ?></option>
                                <option value="4" selected><?php echo RoleMgr::getLabelRole(4) ?></option>
                                <?php } ?>
                            </select>
                        </p>
                    </div>
                    <input type="hidden" name="action" value="addEmploye">
                    <input type="hidden" name="type" value="Employe">
                </div>
                <div id="btns">
                    <button type="submit" id="submit">Valider</button>
                    </form>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <input type="hidden" name="action" value="addEmploye">
                    <input type="hidden" name="type" value="Employe">
                    <button type="submit" id="abandon">Réinitialiser</button>
                    </form>
                </div>
        </fieldset>
    </div>