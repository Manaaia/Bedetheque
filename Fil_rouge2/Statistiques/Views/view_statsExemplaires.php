<div class="container">
        <fieldset class="form"><legend for="form">Statistiques</legend>
            <div>
                <table id="tab" class="display">
                    <thead>
                        <tr>
                            <th>ID exemplaire</th>
                            <th>Titre Album</th>
                            <th>Date entrée</th>
                            <th>Code emplacement</th>
                            <th>Bibliothèque</th>
                            <th>Perdu</th>
                            <th>Etat</th>
                            <th>Disponibilité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($aListExemplaires as $exemplaire) { 
                            $ISBN = $exemplaire->getISBN();
                            $code = ExemplaireMgr::getExemplaireCodeEmplacement($exemplaire->getIdExemplaire());
                            $idStatut = $exemplaire->getStatut();
                            if($idStatut == 0) {
                                $statut = "Présent";
                            } else {
                                $statut = "Perdu";
                            }
                            $disponible = checkAvailability($exemplaire);
                            if($disponible) {
                                $disponibilite = "Disponible";
                            } else {
                                $disponibilite = "Emprunté";
                            }
                            $album = BDMgr::searchBDByISBN($ISBN);?>
                        <tr>
                            <td><?php echo $exemplaire->getIdExemplaire()?></td>
                            <td><?php echo $album->getTitreAlbum() ?></td>
                            <td><?php echo $exemplaire->getDateEntree() ?></td>
                            <td><?php echo $code ?></td>
                            <td><?php echo ExemplaireMgr::getExemplaireBibliotheque($exemplaire->getIdExemplaire()) ?></td>
                            <td><?php echo $statut ?></td>
                            <td><?php echo EtatMgr::getLabelEtat($exemplaire->getIdEtat()) ?></td>
                            <td><?php echo $disponibilite ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>