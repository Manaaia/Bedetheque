// Recherche adhérent
// Initialisation des variables
var rechercherBtn = document.getElementById("rechercher");
var divResult = document.getElementById("results");
const REGEXPA = /^[a-zA-ZÀ-ÿ-]*$/;

rechercherBtn.addEventListener("click", clickRecherche);


// Fonctions
// Contrôle de saisie
function controleSaisie(bool, unnom) {
    
    do {
        if (unnom == "") {
            alert("Veuillez remplir le champ de recherche");
            break;
        } else if (!REGEXPA.test(unnom)) {
            alert("Saisie incorrecte : merci de ne saisir que des lettres ou des tirets.");
            document.getElementById("nomcherche").value = "";
            break;
        } else {
            bool = true;
        }
    } while (bool == false);
    return bool;
}

// Clique sur bouton recherche lance la contrôle de saisie et la recherche dans map users
function clickRecherche() {
    var nom = document.getElementById("nomcherche").value;
    var flag = false;

    nom = nom.toLowerCase();

    flag = controleSaisie(flag, nom);

    if (flag == true) {
        divResult.innerHTML = "";
        rechercheMapUsers(nom)
    }
}

// Recherche dans map users de la saisie
function rechercheMapUsers(lenom) {
var compt = 0;

    for (var [role, user] of users.entries()) {
        if (user.role == 3) {
            var appel = user.idA.replace("."," ");
            if(appel.includes(lenom)) {
                afficheResult(appel, role);
                compt ++;
            }
        }
    }
    if (compt == 0) {
        divResult.innerHTML = "Aucun résultat";
    }
}

// Affiche les résultat de la recherche
function afficheResult(nomutilisateur, key) {
    var newElement = document.createElement("ul");
    newElement.innerHTML =
    "<a href='index1.php?action=gestAdh&var="+key+"'<li>" + nomutilisateur + "</li></a>";
    // newElement.addEventListener("click", function() {clickResult(key)});
    divResult.appendChild(newElement);
}

// Clique résultat pour redirection avec clé valeur dans url
function clickResult(cle) {
    window.location = "index1.php?action=gestionAdh&var="+cle;
}