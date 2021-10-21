
        <header>
            <div id="header-div">
                <?php
                if (isset($_SESSION["user"])) {
                    if ($role == 1) { ?>
                    <div id="main-menu">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <input type="hidden" name="type" value="Accueil">
                            <button type="submit" id="fond" name="action" value="accueil" class ="btn-nav">Catalogue</button>
                        </form>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <input type="hidden" name="type" value="Employe">
                            <button type="submit" id="nouvelEmploye" name="action" value="addEmploye">Nouvel utilisateur</button>
                        </form>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <input type="hidden" name="type" value="Employe">
                            <button type="submit" id="gestionEmploye" name="action" value="searchEmploye">Gestion utilisateur</button>
                        </form>
                    </div>
                    <?php } else if ($role == 2) { ?>
                    <div id="main-menu">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <input type="hidden" name="type" value="Accueil">
                            <button type="submit" id="fond" name="action" value="accueil" class ="btn-nav">Catalogue</button>
                        </form>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <input type="hidden" name="type" value="Statistiques">
                            <button type="submit" id="stats" name="action" value="stats">Statistiques</button>
                        </form>
                    </div>
                    <?php } else if ($role == 3) { ?>
                    <div id="main-menu">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <input type="hidden" name="type" value="Accueil">
                            <button type="submit" id="fond" name="action" value="accueil" class ="btn-nav">Catalogue</button>
                        </form>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <input type="hidden" name="type" value="Adherent">
                            <button type="submit" id="nouvelAdherent" name="action" value="addAdherent">Nouvel adhérent</button>
                        </form>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <input type="hidden" name="type" value="Adherent">
                            <button type="submit" id="gestionAdherent" name="action" value="searchAdherent">Gestion adhérents</button>
                        </form>
                    </div>
                    <?php } else if ($role == 4) { ?>
                    <div id="main-menu">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <input type="hidden" name="type" value="Accueil">
                            <button type="submit" id="fond" name="action" value="accueil" class ="btn-nav">Catalogue</button>
                        </form>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <input type="hidden" name="type" value="BD">
                            <button type="submit" id="nav-gestionnaire" name="action" value="searchBD">Gestion du fond</button>
                        </form>
                    </div>
                    <?php } else if ($role == 5) { ?>
                    <div id="main-menu">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <input type="hidden" name="type" value="Accueil">
                            <button type="submit" id="fond" name="action" value="accueil" class ="btn-nav">Catalogue</button>
                        </form>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <input type="hidden" name="type" value="Adherent">
                            <button type="submit" id="nav-adherent" name="action" value="displayAdherent">Ma fiche adhérent</button>
                        </form>
                    </div>
                    <?php } ?>
                <div id="compte">
                    <p id="identification"></p>  
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                        <p id="identifiant">Bonjour <?php echo $prenom." ".$nom?> !</p>
                        <input type="hidden" name="type" value="Accueil">
                        <button type="submit" id="deconnexion" name="action" value="deconnexion">Se déconnecter</button>
                    </form>
                </div>
                <?php 
                } else { ?>
                <div id="compte">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <input type="hidden" name="type" value="Accueil">
                    <button type="submit" id="connexion" name="action" value="connexion">Se connecter</button>
                </form>
                <?php } ?>
            </div>
        </header>
        