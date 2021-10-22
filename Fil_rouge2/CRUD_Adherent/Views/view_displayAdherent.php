
<div class="container">
    <fieldset class="form"><legend for="form">Fiche adhérent</legend>
        <div id="fiche">
            <div>
                <p class="label">Nom</p>
                <p id="nomadh" class="nomadherent"><?php echo $nom ?></p>
            </div>
            <div>
                <p class="label">Prénom</p>
                <p id="prenomadh" class="prenomadherent"><?php echo $prenom ?></p>
            </div>
            <div>
                <p class="label">Adresse</p>
                <p id="adresseadherent"><?php echo $adresse ?></p>
            </div>
            <div>
                <p class="label">Date de réglement de la cotisation annuelle</p>
                <p id="affdatecot"><?php echo $dateCo ?></p>
                <?php if ($checkDateCo == 1) { ?>
                <p class="alerte">Attention, votre cotisation expire dans <?php echo $interval ?> jours.</p>
                <?php } else if ($checkDateCo == 0) { ?>
                <p class="alerte">Votre cotisation est expirée. Merci de vous rendre en bédéthèque pour
                    la renouveler.</p>
                <?php } ?>
            </div>
            <div>
                <p class="label">Emprunts en cours</p>
                <?php if(!$checkEmprunt) { ?>
                <p>Aucun emprunt en cours</p>
                <?php } else if ($checkEmprunt) { 
                for($i = 0; $i< count($aBD); $i++) {?>
                <p><?php echo $aBD[$i]->getTitreAlbum()?></p><br/>
                <?php }} ?>
            </div>
            <div>
                <p class="label invisible">Amendes</p>
                <p id="amende" class="invisible"></p>
            </div>
        </div>
    </fieldset>

</div>