    
        <container id="main">
            <div id="searchDiv">
                <h1>Bienvenue au Centre Culturel des Marmusots</h1>
                <div>
                    <input type="search" name="search" id="search">
                </div>

                <button id="searchBtn">Rechercher</button>
            </div>
            <div id="newItems">
                <h2 id="discover">Découvrir</h2>
                <div id="cards" style="background-color:white;">
                    <?php

try {
echo "Création d'un utilisateur : ";
$jean = new User (1234567899,"Koothrapali","Rajesh","?Es5erty","42 rue de l'amour", "test",14000,"Caen","2021/09/23",5);
// echo $jean;
} catch (UserException $e) {
echo "ERREUR : ".$e->getMessage();
}
?>
                </div>
            </div>
        </container>