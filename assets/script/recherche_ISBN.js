// INITIALISATION DES VARIABLES
var rechercherBtn = document.querySelector("#rechercher");
var divResult = document.querySelector("#results");
var rechercheEx = document.querySelector("#isbnCherche")
/* REGEX ISBN */
const REGEXPISBN = /^\d+$/;

rechercherBtn.addEventListener("click", clickRecherche);
// rechercheEx.addEventListener("keyup", keyRecherche);

// function keyRecherche(){
//     var inputValue = rechercheEx.value;
//     console.log(inputValue);

//     if(inputValue == ""){
//         divResult.innerHTML = "Aucun résultat"
//     }
//     else {
//         albums.forEach(album => {
//             if(album.isbn.includes(inputValue)){
//                 divResult.innerHTML +="<li>"+ album.titre+"</li>";
//             }
//         })
//     }

//     // for(var [ISBN, album] of albums.entries()){
//     //     var appel = album.isbn;
//     //     console.log(appel);
//     //     console.log(appel.includes(inputValue.toString()));
//     //      if(appel.includes(inputValue)){
//     //          console.log(album.titre);
//     //      }
//     // }

// }
function clickRecherche() {
    var inputValue = parseInt(rechercheEx.value);
    var bFlag = false;

    bFlag = controleSaisie(bFlag, inputValue);

    if(bFlag == true){
        divResult.innerHTML = "";
        rechercheMapAlbums(inputValue)
    }
}

function controleSaisie(bool, nbr){
    do {
        if (nbr == ""){
            alert("Veuillez remplir le champ recherche");
            break;
        }
        else if(!REGEXPISBN.test(nbr)){
            alert("Saisie incorrecte : merci de ne saisir que des nombres");
            document.querySelector('#isbnCherche').value = "";
            break;
        }
        else {
            bool = true;
        }
    }
    while(bool==false);
    return bool;
}

function rechercheMapAlbums(nbr){
    var compt = 0;

    for (var [isbn, album] of albums.entries()){
        var appel = album.isbn;
        // console.log(appel);
        if(appel.includes(nbr)){
            console.log("ok");
            var titre = album.titre; 
            afficheResult(titre);
            compt++;
        }
    }
    if(compt == 0){
        divResult.innerHTML = 'Aucun résultat';
    }
}
function afficheResult(str){
    var newElement = document.createElement('ul');
    newElement.innerHTML = 
    "<li>" + str + "</li>";
    divResult.appendChild(newElement);
}
function testss () {
    // var saisie = 0000000000000;
    // var newSaisie = saisie.match(/\d{3}{1}{4}{4}{1}/g).join('-');
    // console.log(newSaisie);
}





// ISBN : XXX - X - XXXX - XXXX - X