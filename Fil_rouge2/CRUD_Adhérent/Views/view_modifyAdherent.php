<div class="container">
            <fieldset class="form"><legend for="form">Modifier adhérent</legend>
                <div>
                    <p id="alertesaisie" class="alerte invisible"></p>
                    <div>
                        <h3 class="label">Identité</h3>
                        <p class="identite">
                            <label for="nomadherent">Nom</label><br/>
                            <input type="text" class="lettre" id="nomadherent" placeholder="Veuillez renseigner un nom" required><br/>
                            <label for="prenomadherent">Prénom</label><br/>
                            <input type="text" class="lettre" id="prenomadherent" placeholder="Veuillez renseigner un prénom" required>
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
                        <h3 class="label">Date de règlement de la cotisation annuelle</h3>
                        <p><input type="date" id="datecot" value="2021-02-06"></p>
                    </div>
                    <div id="alertcot" class= "alerte invisible">
                        Cotisation annuelle expirée
                    </div>
                    <div>
                        <h3 class="label invisible">Amendes</h3>
                        <p id="amende" class="invisible">Aucune amende en attente</p>
                    </div>
                </div>
                <div id="btns">
                    <button id="abandon">Abandonner</button>
                    <button id="submit">Valider</button>
                </div>
                <br/><hr><br/>
                <div>
                    <button class="delete">Supprimer ce compte adhérent ?</button>
                </div>
            </fieldset>
    </div>