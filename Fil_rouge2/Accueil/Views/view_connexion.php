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
                <div id="connexion-content">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                        <div>
                            <label for="user-name">Nom d'utilisateur</label>
                            <input type="text" name="user-name" id="user-name" value="clement.lepecheur">
                        </div>
                        <div>
                            <label for="password">Mot de passe</label>
                            <input type="text" name="password" id="password" value="Gp3t3d3s0l3"> 
                            <input type="hidden" name="action" value="accueil">   
                            <a href="" id="mdpOublie">Mot de passe oublié ?</a>
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