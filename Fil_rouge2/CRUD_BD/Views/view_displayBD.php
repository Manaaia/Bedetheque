<div class="container">
        <fieldset class="form"><legend for="form">Fiche BD</legend>
            <div id="rechercheExemplaire">
                <p class="label">ISNB : <?php echo $isbn; ?></p>
                <p id="isbn"></p>
            </div>
            <hr>
            <div class="visible" id="container-bd" >
                <div id="ajoutBD" class="visible" >
                    <div id="alertesaisie" class="alerte invisible"></div>

                    <div>
                        <p class="label">Titre : <?php echo $titreBD; ?></p>
                        <p id="titreBD">
                    </div>

                    <br/>

                    <div>
                        <p class="label">Numéro d'album : <?php echo $numeroBD; ?></p>
                        <p id="numBD"></p>
                    </div>

                    <br/>

                    <div>
                        <p class="label">Auteur : <?php echo $auteurBD; ?></p>
                        <p id="selectAuteur"></p>
                    </div>

                    <br/>
                                
                    <div>
                        <p class="label">Série : <?php echo $serieBD; ?></p>
                        <p id="selectSerie">
                        </p>
                    </div>

                    <br>
                    <div>
                        <p class="label">Résumé : <?php echo $resumeBD; ?></p>
                        <p id="resumeBD"></p>
                        
                    </div>

                    <br>
                    <div>
                        <p class="label">Prix : <?php echo $prixBD; ?></p>
                        <p id="prixBD"></p>
                    </div>
                    <br>

                    <br>
                </div>
                <div id="th2">
                    <img id="imgBD" src="Contenu/assets/image/albumsMini/<?php echo $couvBD; ?>">
                </div>
            </div>
                
                <div id="btns">
                    <button id="modifierBD">Modifier</button>
                    <button id="supprimerBD">Supprimer</button>
                    <button id="ajouterExemplaire">Ajouter Exemplaire</button>

                </div>
            </div> 
        </fieldset>        
    </div>