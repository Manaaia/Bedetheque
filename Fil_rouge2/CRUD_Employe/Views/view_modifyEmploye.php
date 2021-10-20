<div class="container">
        <fieldset class="form"><legend for="form">Modifier employé</legend>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div>
                    <?php if(isset($modMessage)) { 
                        if($modMessage) {?>
                    <p class="success">employé mis à jour avec succès.</p>
                    <?php } else { ?>
                    <p class="alerte">Erreur : champs renseignés incorrects.</p>
                    <?php }} ?>
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
                        <h3 class="label">Poste occupé</h3>
                        <label for="newRole">Poste occupé (*)</label><br/>
                        <p>
                            <select name="newRole">
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
                    <input type="hidden" name="action" value="modifyEmploye">
                    <input type="hidden" name="type" value="Employe">
                    <input type="hidden" name="idEmploye" value="<?php echo $idEmploye ?>">
                </div>
                <div id="btns">
                    <button type="submit" id="submit">Valider</button>
            </form>
            <form  method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input type="hidden" name="action" value="searchEmploye">
                <input type="hidden" name="type" value="Employe">
                <button id="abandon">Retour</button>
            </form>
            </div>
            <br/><hr><br/>
            <div>
                <form  method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <input type="hidden" name="action" value="searchEmploye">
                    <input type="hidden" name="type" value="Employe">
                    <input type="hidden" name="do" value="delete">
                    <input type="hidden" name="idEmploye" value="<?php echo $idEmploye ?>">
                    <button class="delete">Supprimer cet employé ?</button>
                </form>
            </div>
        </fieldset>
    </div>