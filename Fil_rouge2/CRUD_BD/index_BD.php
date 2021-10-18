<?php 
try {
    spl_autoload_register(function($classe) {
        include "Models/".$classe.".class.php";
    });
} catch (Exception $e) {
    echo $e->getMessage();
}

const OBJET = PDO::FETCH_OBJ;
const ASSOC = PDO::FETCH_ASSOC;

try {
    $bd1 = new BD (9780269887516, "Le club des cinq : à Venise !", 16, "8.50", 
    "Blablabla, ils trouvent toujours la solution parce que c'est les zéros.", 1, 1, 3, 11);
    echo $bd1;
    echo "<br />";
    echo BDMgr::addNewBD($bd1);
    echo "<br />";   
} catch (BDException $e) {
    echo $e->getMessage();
} catch (BDMgrException $e) {
    echo $e->getMessage();
}

var_dump(BDMgr::searchBDByTitle("Venise", OBJET)?BDMgr::searchBDByTitle("Venise", OBJET):
    "Il n'y a aucune BD correspondante");
echo "<br />";
var_dump(BDMgr::searchBDByTitle("Vunise", OBJET)?BDMgr::searchBDByTitle("Vunise", OBJET):
    "Il n'y a aucune BD correspondante");
echo "<br />";
var_dump(BDMgr::searchBDByTitle("V", OBJET)?BDMgr::searchBDByTitle("V", OBJET):
    "Il n'y a aucune BD correspondante");


var_dump(BDMgr::searchBDBySerie("Spirou", OBJET)?BDMgr::searchBDBySerie("Spirou", OBJET):
    "Il n'y a aucune BD correspondante");
echo "<br />";
var_dump(BDMgr::searchBDBySerie("Spurou", OBJET)?BDMgr::searchBDBySerie("Spurou", OBJET):
    "Il n'y a aucune BD correspondante");
echo "<br />";
var_dump(BDMgr::searchBDBySerie("S", OBJET)?BDMgr::searchBDBySerie("S", OBJET):
    "Il n'y a aucune BD correspondante");

?>
