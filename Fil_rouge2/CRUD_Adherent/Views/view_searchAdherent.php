
    <div class="container">
        <fieldset class="form"><legend for="form">Rechercher un adhérent</legend>
            <?php if(isset($delMessage)) { ?>
            <p class="success">L'adhérent a bien été supprimé</p>
            <?php } ?>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">    
                <div class="recherche">
                    <div>
                        <h3 class="label">Rechercher par nom et/ou prénom</h3>
                        <p class="identite">
                            <input type="hidden" name="action" value="searchAdherent">
                            <input type="hidden" name="type" value="Adherent">
                            <input type="text" id="nomcherche" name="nomCherche"class="nomadherent"
                             placeholder="Nom/Prénom ou partie du nom/prénom"><br/>
                        </p>
                    </div>
                    <button type="submit" id="rechercher">Rechercher</button>
                </div>
            </form>
            <hr>
            <div id="results">
                <?php if (isset($aNomCherche)) { ?>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
                    <input type="hidden" name="action" value="modifyAdherent">
                    <input type="hidden" name="type" value="Adherent">
                    <ul>
                    <?php for ($i=0;$i<count($aNomCherche);$i++) {?>
                        <li><button type="submit" class="btn-link" name="idAdherent" value="<?php echo $aNomCherche[$i]["id_user"]?>">
                        <?php echo $aNomCherche[$i]["Prenom_user"]." ".$aNomCherche[$i]["Nom_user"]; ?></button></li>
                    <?php } ?>
                    </ul>
                </form>
                <?php } else { ?>
                <p>Aucun résultat</p>
                <?php } ?>
            </div>
        </fieldset>
    </div>