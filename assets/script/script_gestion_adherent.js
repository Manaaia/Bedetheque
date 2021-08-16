// Remplir la map d'emprunt

var emprunt = new Map();

emprunt.set("1", {identifiant: users.get("2").idA, album: albums.get("35")});
emprunt.set("2", {identifiant: users.get("2").idA, album: albums.get("30")});
emprunt.set("3", {identifiant: users.get("2").idA, album: albums.get("163")});


// Afficher les emprunts
var emprunt1 = emprunt.get("1");
var emprunt2 = emprunt.get("2");
var emprunt3 = emprunt.get("3");

console.log(emprunt1.identifiant + " a emprunté " + emprunt1.album.titre + ", " + emprunt2.album.titre + " et " + emprunt3.album.titre);

var nomA = document.getElementById("adherent");
console.log(nomA);
nomA.innerHTML = emprunt1.identifiant;