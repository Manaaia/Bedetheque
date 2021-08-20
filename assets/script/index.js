// Programme principal
// Initialisation des variables
var divcards = document.getElementById("cards");
var btnSearch = document.getElementById("searchBtn");


recoAleatoires();
btnSearch.addEventListener("click", function() {alert("Fonctionnalité en cours de construction, patience...")});



// Fonctions
function recoAleatoires() {
    var compt = 0;
    var affRandom = new Array ();

    for (var [bli, blou] of albums.entries()) {
        compt++
    }

    for (i = 0; i < 5; i++) {
        var flag = true;
        var random;
        do {
            flag = false;
            random = Math.floor(Math.random()*(compt-1)+1);
            flag = verifPresence(random, affRandom, flag);
        } while (flag == true);
           
        affRandom[i] = random;
        createReco(affRandom[i]);
    }
}

function verifPresence(alea, tab, bool) {
    for (let i in tab) {
        if (tab[i] == alea) {
            bool = true;
        }
    }
    return bool;
}

// Créer contenu dynamiquement
function createReco(key) {
    key = key.toString();
    var titre = albums.get(key).titre;
    var numero = albums.get(key).numero;
    var idSerie = albums.get(key).idSerie;
    var serie = series.get(idSerie).nom;
    var img = '"assets/image/albumsMini/' + serie + '-' + numero + '-' + titre + '.jpg"';

        img = img.replace("!", "");
        img = img.replace("\'", "");
        img = img.replace("\'", "");

    var newCard = document.createElement('figure');
    newCard.className = "card";
    newCard.innerHTML += '<img src=' + img + ' alt =""' +
    '<figcaption>' + titre + '</figcaption>' +
    '<button id="lienfiche' + key + '"> + </button>';
    divcards.appendChild(newCard);
    var btncard = document.getElementById("lienfiche" + key);
    btncard.addEventListener("click", function() {redirectFiche(key)});
}

function redirectFiche(cle) {
    window.location = "fiche_BD_accueil.html?var=" + cle;
}