<div class="container">
        <fieldset class="form"><legend for="form">Créer un nouvel utilisateur</legend>
            <div>
                <p id="alertesaisie" class="alerte invisible"></p>
                <div>
                    <h3 class="label">Identité</h3>
                    <p class="identite">
                        <label for="nomadherent">Nom</label><br/>
                        <input type="text" class = "lettre" id="nomadherent" placeholder="Veuillez renseigner un nom" required><br/>
                        <label for="prenomadherent">Prénom</label><br/>
                        <input type="text" class = "lettre" id="prenomadherent" placeholder="Veuillez renseigner un prénom" required>
                    </p>
                </div>
                <div>
                    <h3 class="label">Adresse</h3>
                    <p id="adresseadherent">
                        <label for="numero">N°</label><br/>
                        <input type="text" class="chiffre" id="numero" placeholder="00"><br/>
                        <label for="rue">Nom de rue</label><br/>
                        <input type="text" class="lettre" id="rue" placeholder="Veuillez renseigner un nom de rue"><br/>
                        <label for="code">Code postal</label><br/>
                        <input type="text" class="chiffre" id="code" placeholder="00000"><br/>
                        <label for="ville">Ville</label><br/>
                        <input type="text" class="lettre" id="ville" placeholder="Veuillez renseigner une ville">
                    </p>
                </div>
                <div>
                    <h3 class="label">Rôle</h3>
                    <p><select name="role">
                        <option value="">--Veuillez choisir une option--</option>
                        <option value="bibliothecaire">Bibliothécaire</option>
                        <option value="gestionnaire">Gestionnaire</option>
                        <option value="responsable">Responsable</option>
                        <option value="admin">Administrateur</option>
                    </select></p>
                </div>
            </div>
            <div id="btns">
                <button id="abandon">Réinitialiser</button>
                <button id="submit">Valider</button>
            </div>
        </fieldset>
    </div>