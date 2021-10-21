<div class="container">
        <fieldset class="form"><legend for="form">Statistiques</legend>
            <div>
                <table id="tab" class="display">
                    <thead>
                        <tr>
                            <th>Adhérents</th>
                            <th>Cotisations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($aListAdherents as $adherent) { 
                            $dateco = afficheDateCo($adherent);
                            $checkDateCo = checkDateCo($dateco);
                            if($checkDateCo == 0) {
                                $cotExpiree = "Expirée";
                            } else {
                                $cotExpiree = "A jour";
                            } ?>
                        <tr>
                            <td><?php echo $adherent->getPrenomUser()." ".$adherent->getNomUser()?></td>
                            <td><?php echo $cotExpiree ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <button id="lettre">Générer les lettres de rappel</button>
            </div>
        </fieldset>
    </div>