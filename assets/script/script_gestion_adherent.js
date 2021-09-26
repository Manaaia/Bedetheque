// Programme principal
// Initialisation des variables
var retour = document.getElementById("contenuretour");
var emprunt = document.getElementById("contenuemprunt");
var divretour = document.getElementById("divretour");
var divemprunt = document.getElementById("divemprunt");
var divtitreretour = document.getElementById("divtitreretour");
var divtitreemprunt = document.getElementById("divtitreemprunt");
var divempruntretour = document.getElementById("gestionEmpruntRetour");
var btnvalide = document.getElementById("submit");
var btnabandon = document.getElementById("abandon");
var cle = window.location.search;
// Récupère la clé valeur url
cle = cle.split("=");
cle = cle[2];
var btnfiche = document.getElementById("fiche");
var datecot = users.get(cle).datecot;
var flag = false;
/* REGEX ISBN */
const REGEXPISBN = /^\d+$/;



afficheNom(cle);
gestionRetourEmprunt();

btnfiche.addEventListener("click", voirFiche);
btnabandon.addEventListener("click", leRetour);
btnvalide.addEventListener("click", verifForm);

flag = checkDatecot(datecot);
if (flag == true) {
    divempruntretour.innerHTML = '<p class="alerte">Alerte : Emprunt impossible !<br/>Ce compte adhérent est bloqué.';
    btnvalide.className = "invisible";
}

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
    var compt2 = 0;

    for (var [identifiant, emprunt] of emprunts.entries()) {
        if (emprunt.identifiant == users.get(cle).idA) {
            compt2++;
            afficheRetour(emprunt.album, compt2);
            compt ++;
        }
    }

    if (compt == 0) {
        afficheEmprunt();
    }
}

// Afficher les emprunts en cours/retours possibles
function afficheRetour(unemprunt, compt) {
    emprunt.innerHTML = "<p>Emprunt impossible tant que l'emprunt précédent n'a pas été rendu</p>";
    divemprunt.setAttribute("style", "background-color : grey");
    divtitreemprunt.setAttribute("style", "background-color : darkgrey");

    retour.innerHTML += '<p id="retour1" class="list">' + unemprunt.titre +
    '</p><br/><select name="etatBD">' +
    '<option value="selectEtat">Modifier état</option>' +
    '<option value="neuf">Neuf</option>' +
    '<option value="abime">Abîmé</option>' +
    '</select><br/>' +
    '<div><input type="radio" id="perdu" name="status' + compt + '"><label for="perdu">Perdu</label></div>' +
    '<div><input type="radio" id="OK" name="status' + compt + '"checked><label for="ok">OK</label></div><br/><br/>';
}

// Afficher la div pour emprunter
function afficheEmprunt() {
    retour.innerHTML = "<p>Pas d'emprunt en cours</p>";
    divretour.setAttribute("style", "background-color : grey");
    divtitreretour.setAttribute("style", "background-color : darkgrey");

    emprunt.innerHTML = 
    '<p id="alertemprunt"></p>' +
    '<label>Code article 1</label><br/><input id="code1" type="text" class="article list"/><br/><button id="btn1" class="btngestion">Valider</button><img id="icon1" class ="invisible icon" src="assets/image/icon_valider.png" alt="icon_valider"><br/><br/>' +
    '<label>Code article 2</label><br/><input id="code2" type="text" class="article list"/><br/><button id="btn2" class="btngestion">Valider</button><img id="icon2" class ="invisible icon" src="assets/image/icon_valider.png" alt="icon_valider"><br/><br/>' +
    '<label>Code article 3</label><br/><input id="code3" type="text" class="article list"/><br/><button id="btn3" class="btngestion">Valider</button><img id="icon3" class ="invisible icon" src="assets/image/icon_valider.png" alt="icon_valider"><br/><br/>'

    var btnCode1 = document.getElementById("btn1");
    var btnCode2 = document.getElementById("btn2");
    var btnCode3 = document.getElementById("btn3");
    var code1 = document.getElementById("code1");
    var code2 = document.getElementById("code2");
    var code3 = document.getElementById("code3");
    var icon1 = document.getElementById("icon1");
    var icon2 = document.getElementById("icon2");
    var icon3 = document.getElementById("icon3");

    btnCode1.addEventListener("click", function () {controleSaisieCode(btnCode1, code1, icon1)});
    btnCode2.addEventListener("click", function () {controleSaisieCode(btnCode2, code2, icon2)});
    btnCode3.addEventListener("click", function () {controleSaisieCode(btnCode3, code3, icon3)});
}

// Contrôle saisie codes articles
function controleSaisieCode(bouton, input, icon) {
    let flag = false;
    let bool = false;
    var valeur = input.value;


    do {
        if (!REGEXPISBN.test(valeur)) {
            alert("Saisie incorrecte : merci de ne saisir que des nombres");
            input.value = "";
            break;
        } else {
            bool = verifISBN(valeur);
            if (bool == true) {
                icon.className = "visible icon";
                bouton.className = "invisible";
            } else {
                alert("Ce code article n'existe pas.");
            }
            flag = true;
        }
    } while (flag == false);
}

// Verif ISBN existe
function verifISBN(val) {
    let flag = false;

    for (var [isbn, album] of albums.entries()){
        var appel = album.isbn;
        if(appel == val){
            flag = true;
        }
    }
    return flag;
}

// Verifier validité champs
function verifForm() {

    if (retour.innerHTML.includes("<p>Pas d'emprunt en cours</p>")) {
        var champs = document.getElementsByClassName("article");
        var compt = 3;
        var check;

        for (let i = 0; i < champs.length; i++) {
            var numicon = "icon" + (i+1);
            var checker = 0;
            check = document.getElementById(numicon);

            if(champs[i].value == "") {
                compt --;
            } else if(check.className == "invisible icon") {
                checker++;
            } else {
                localStorage.setItem(("ISBN"+(i+1)), champs[i].value);
            }
        }

        if (compt == 0) {
            alert("Veuillez renseigner au moins un champ");
        } else if (checker != 0) {
            alert("Veuillez valider les champs saisis pour enregistrer");
        } else {
            alert("Formulaire enregistré, merci.");
            retour.innerHTML = "";
            getEmprunts();
        }
    } else {
        alert("Formulaire enregistré, merci.");

        divemprunt.removeAttribute("style");
        divtitreemprunt.removeAttribute("style");
        afficheEmprunt();
    }
}

// Récupère emprunt renseignés
function getEmprunts() {
    var emp1 = localStorage.getItem("ISBN1");
    var emp2 = localStorage.getItem("ISBN2");
    var emp3 = localStorage.getItem("ISBN3");
    var aEmp = new Array (emp1, emp2, emp3);

    for (let i in aEmp) {
        for (var [ISBN, album] of albums.entries()) {
            if (album.isbn == aEmp[i]) {
                afficheRetour(album);
            }
        }
    }

    divretour.removeAttribute("style");
    divtitreretour.removeAttribute("style");
    emprunt.innerHTML = "<p>Emprunt impossible tant que l'emprunt précédent n'a pas été rendu</p>";
    divemprunt.setAttribute("style", "background-color : grey");
    divtitreemprunt.setAttribute("style", "background-color : darkgrey");
}

// Redirection modifier fiche adhérent
function voirFiche() {
    window.location = "modifier_adherent.html?var=" + cle;
}

// Redirection page recherche
function leRetour() {
    localStorage.removeItem("ISBN1");
    localStorage.removeItem("ISBN2");
    localStorage.removeItem("ISBN3");
    window.location = "recherche_adherent.html";
}