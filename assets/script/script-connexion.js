// INITIALISATION DES VARIABLES
var btnConnexion = document.querySelector("#btnConnexion");
var idConnect = document.querySelector("#user-name");
var mdpConnect = document.querySelector("#password");


// EVENTLISTENER
var submit = btnConnexion.addEventListener('click',test);

// FONCTIONS
// function submit () {
    // RECUPERER LA MAP DES USERS
    // VEFIER QUE L'IDENTIFIANT EXIXSTE DANS LA MAP USERS
    // VERIFIER SI LE MDP CORRESPOND A L'ID DANS LA MAP USERS
    // STOCKER LE ROLE DE L'IDENTIFIANT TROUVE AU LOCALSTORAGE POUR LA SUITE
    // localStorage.setItem(role);
// }
// function test2() {
//     var bIdentifiant = true;

//     for (var [key, value] of users.entries()){
//         if (value.idA != idConnect.value){
//             bIdentifiant = false
//         }
//         else {
//             bIdentifiant = true;
//             mdp = user.mdp;
//             bFlag = true;
//             return
//         }
//         console.log(value.idA)
//     }
    
// }
function test () {

    var mdp;
    var id;
    var role;
    var bFlag = false;
    var bIdentifiant = true;

	users.forEach(user => {
        console.log("go")
	    if(user.idA != idConnect.value){
            bIdentifiant = false;
        }
        else{
            bIdentifiant = true;
            id = user.idA;
            mdp = user.mdp;
            role = user.role;
            bFlag = true;
            return
        };
console.log(bIdentifiant);
    })


    if (bFlag == true){
        localStorage.clear();
        if(mdpConnect.value != mdp){
            bIdentifiant = false;
        }
        else{
            bIdentifiant = true;
            return
        }
console.log(bIdentifiant);
    }
console.log(bIdentifiant);
    if(bIdentifiant == false){
        alert("Identifiant ou mot de passe inconnu");
    }
    else{
        localStorage.setItem("role", role);
        localStorage.setItem("id", id);
    }
    console.log(localStorage)
    	
}


