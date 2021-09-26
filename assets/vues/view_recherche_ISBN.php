<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style-mobile.css" />
    <link rel="stylesheet" href="assets/css/style-desktop.css">
    <title>BDthèque des Marmusots par les plus stylées de toute la promo</title>
</head>
<body>
    <!-- Placeholder header -->
     
    <div class="container">
        <fieldset class="form"><legend for="form"><?php echo $titreForm?></legend>
            <div class="recherche">
                <div id="choixAjout" class="invisible">
                    <p>ISBN non trouvé, voulez-vous ajouter une BD ?</p><br>
                    <button id="AjoutBdOk">Ajouter une BD</button>
                </div>
                <div>
                    <h3 class="label">Rechercher par titre</h3>
                    <p class="identite">
                        <input type="text" id="titreCherche" placeholder="Tintin au Tibet"><br/>
                    <h3 class="label">Rechercher par auteur</h3>
                    <p class="identite">
                        <input type="text" id="autCherche" placeholder="Tom Jarny"><br/>
                    <h3 class="label">Rechercher par série</h3>
                    <p class="identite">
                        <input type="text" id="serCherche" placeholder="Les Aventures de Tintin"><br/>
                    </p>
                </div>
                <button id="rechercher">Rechercher</button>
            </div>
            <hr>
            <div id="results">
                <p>Aucun résultat</p>
            </div>
            <div id="btns">
                <button id="abandon">Abandonner</button>
                <button id="submit" class="invisible">Valider</button>
            </div>
        </fieldset>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/script/script-header.js"></script>
    <script src="assets/script\maps\albums.js"></script>
    <script src="assets/script\maps\users.js"></script>
    <script src="assets/script\recherche_ISBN.js"></script>
</body>
</html>