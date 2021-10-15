        <container>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                <button id="retour" class="visible" name="action" value="accueil">Retour</button>
            </form>
            <section id="connexion-section">
                <div id="connexion-title">
                    <div id="bubble-connexion-title">
                        <img src="assets/image/comic-bubble.png" alt="bulle">
                    </div>
                    <div id="txt-connexion-title">
                        <h1>Connexion</h1>
                    </div>

                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <button type="submit" name="action" value="mdp_oublie" class="btn-link">Mot de passe oublié ?</button>
                </form>
                <div id="connexion-content">
                    <?php if(isset($checkConnexion)) {
                        if (!$checkConnexion) { ?>
                        <p class="alerte">Nom d'utilisateur ou mot de passe incorrect</p>
                        <?php }} ?>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                        <div>
                            <label for="user-name">Nom d'utilisateur</label>
                            <input type="text" name="user_name" id="user_name" placeholder="Renseignez votre identifiant">
                        </div>
                        <div>
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" id="password" placeholder="Renseignez votre mot de passe"> 
                            <input type="hidden" name="action" value="accueil">
                            <input type="hidden" name="type" value="Accueil">    
                        </div>

                        <div id="btnConnexion">
                            <button type="submit">Se connecter</button>
                        </div>
                    </form>

                </div>
                <div id="comment-connexion">
                    <p>Vous n'avez pas de compte chez nous ? Rendez-vous dans une de nos BDthèque pour ouvrir un compte et rejoignez l'aventure. Des centaines de BD vous attendent !</p>
                </div>
            </section>
        </container>