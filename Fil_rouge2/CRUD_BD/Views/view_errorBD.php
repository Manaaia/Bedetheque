<!-- AFFICHAGE ERREUR CONCERNANT BD, indépendante des actions CRUD -->
<div class="container">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <fieldset class="form"><legend for="form">Erreur BD</legend>
        <div id="rechercheExemplaire">
            <div>
                <p><?php echo $msg; ?></p>
            </div>
        </div>
        </fieldset>
    </form>
</div>