var cle = window.location.search;
cle = cle.split("=");
cle = cle[1];
var id = users.get(cle).idA.split(".");
var prenom = id[0][0].toUpperCase()+id[0].slice(1);
var nom = id[1][0].toUpperCase()+id[1].slice(1);
var caseprenom = document.getElementById("prenomadherent");
var casenom = document.getElementById("nomadherent");

console.log(nom);
console.log(prenom);

caseprenom.value = prenom;
casenom.value = nom;