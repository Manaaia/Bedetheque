// Gestion retour
// Remplir la map d'emprunt
var emprunts = new Map();

emprunts.set("1", {identifiant: users.get("2").idA, album: albums.get("35")});
emprunts.set("2", {identifiant: users.get("2").idA, album: albums.get("30")});
emprunts.set("3", {identifiant: users.get("2").idA, album: albums.get("163")});
emprunts.set("4", {identifiant: users.get("6").idA, album: albums.get("102")});
emprunts.set("5", {identifiant: users.get("7").idA, album: albums.get("98")});
emprunts.set("6", {identifiant: users.get("7").idA, album: albums.get("2")});
emprunts.set("7", {identifiant: users.get("20").idA, album: albums.get("58")});


// Programme principal
// Initialisation des variables
var retour = document.getElementById("contenuretour");
var emprunt = document.getElementById("contenuemprunt");
var divretour = document.getElementById("divretour");
var divemprunt = document.getElementById("divemprunt");
var divtitreretour = document.getElementById("divtitreretour");
var divtitreemprunt = document.getElementById("divtitreemprunt");
var cle = window.location.search;
var btnfiche = document.getElementById("fiche");

// Récupère la clé valeur url
cle = cle.split("=");
cle = cle[1];

afficheNom(cle);
gestionRetourEmprunt();

btnfiche.addEventListener("click", voirFiche);

// Fonctions
// Afficher le nom de l'adhérent
function afficheNom(key) {
    var nomA = document.getElementById("adherent");
    var nomInt = users.get(key).idA.split(".");
    nomInt[0] = nomInt[0][0].toUpperCase()+nomInt[0].slice(1);
    nomInt[1] = nomInt[1][0].toUpperCase()+nomInt[1].slice(1);
    var newNom = nomInt.join(' ');

    nomA.innerHTML = newNom;
}

// Récupérer et afficher les maps d'emprunt
function gestionRetourEmprunt() {
    var compt = 0;
    for (var [identifiant, emprunt] of emprunts.entries()) {
        if (emprunt.identifiant == users.get(cle).idA) {
            afficheRetour(emprunt);
            compt ++;
        }
    }

    if (compt == 0) {
        afficheEmprunt();
    }
}

// Afficher les emprunts en cours/retours possibles
function afficheRetour(unemprunt) {
    emprunt.innerHTML = "<p>Emprunt impossible tant que l'emprunt précédent n'a pas été rendu</p>";
    divemprunt.setAttribute("style", "background-color : grey");
    divtitreemprunt.setAttribute("style", "background-color : darkgrey");

    retour.innerHTML += '<p id="retour1" class="list">' + unemprunt.album.titre +
    '</p><br/><button id="etat" class="btngestion">Modifier état</button><button id="perdu" class="btngestion">Perdu</button><button id="OK" class="btngestion">OK</button><br/><br/>';
}

// Afficher la div pour emprunter
function afficheEmprunt() {
    retour.innerHTML = "<p>Pas d'emprunt en cours</p>";
    divretour.setAttribute("style", "background-color : grey");
    divtitreretour.setAttribute("style", "background-color : darkgrey");

    emprunt.innerHTML = 
    '<p id="alertemprunt"></p>' +
    '<label>Code article 1</label><br/><input type="text" class="list" /><br/><button class="btngestion">Valider</button><br/><br/>' +
    '<label>Code article 2</label><br/><input type="text" class="list"/><br/><button class="btngestion">Valider</button><br/><br/>' +
    '<label>Code article 3</label><br/><input type="text" class="list"/><br/><button class="btngestion">Valider</button><br/><br/>'
}

// Redirection modifier fiche adhérent
function voirFiche () {
    window.location = "modifier_adherent.html?var=" + cle;
}