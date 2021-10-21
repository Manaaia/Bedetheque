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
                            $album = BDMgr::searchBDByISBN($ISBN);?>
                        <tr>
                            <td><?php echo $exemplaire->getISBN()?></td>
                            <td><?php echo $album->getTitreAlbum() ?></td>
                            <td><?php echo $exemplaire->getDateEntree() ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>