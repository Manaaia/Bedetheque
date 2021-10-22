<!-- FLAVIE -->
<!-- Page de suppression d'une BD -->

<!-- AFFICHAGE CONFIRMATION OU ERREUR SI Suppression VALIDÉE -->
<?php if ($action == "confirmDeleteBD") { ?>
            
            <div class="container">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <fieldset class="form"><legend for="form">Suppression d'une BD</legend>
                    <div id="rechercheExemplaire">
                        <div>
                            <p><?php echo $msg; ?></p>
                        </div>
                    </div>
                    </fieldset>
                </form>
            </div>

       <?php } else {
        ?>
<!-- DEMANDE DE CONFIRMATION AVANT SUPPRESSION -->
<div class="container">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <fieldset class="form"><legend for="form">Suppression d'une BD</legend>
            <div id="rechercheExemplaire">
                <div>
                    <input type="hidden" name="auteur" value="<?php echo $nomAuteur; ?>">
                    <input type="hidden" name="serie" value="<?php echo $nomSerie; ?>">
                    <input type="hidden" name="type" value="BD">
                    <input type="hidden" name="id" value="<?php echo $isbn; ?>">
                    <p>Êtes-vous certain de vouloir supprimer la BD <?php echo " ".$isbn." ?"; ?></p>
                </div>
                <div id="confirmDel">
                <?php if (isset($_SESSION["user"])) {
                        if ($role == 4) { ?>
                            <button type="submit" name="action" id="oui" value="confirmDeleteBD">Oui</button>
                            <button type="submit" name="action" id="non" value="displayBD">Non</button>
                <?php   }
                    } ?>
                    
            </div> 
            </div>
            
        </fieldset>
    </form>        
</div>
<?php } ?>