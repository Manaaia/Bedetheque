//Fonctions
// Contrôle validité datecot
function checkDatecot(date) {
    var flag = false;
    var checkcot = date.split("-");
    var cotdd = checkcot[2];
    var cotmm = parseInt(checkcot[1])-1;
    var cotyyyy = checkcot[0];
    var cot = new Date(cotyyyy, cotmm, cotdd);

    var today = new Date();


    var difftemps = today.getTime() - cot.getTime();
    var diffjours = difftemps / (1000 * 3600 * 24);

    if (diffjours > 365) {
        flag = true;
    }
    return flag;
}