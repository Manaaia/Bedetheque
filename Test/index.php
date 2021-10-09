<?php

spl_autoload_register(function($classe) {
    include "Models/" . $classe . ".class.php";
});

const RC = "<br/>\n";

try {

    // $list = UserMgr::getListUsers();
    // var_dump($list);

    echo "Création d'un utilisateur : <br/>";
    $rajesh = new User (1234567899,"Koothrapali","Rajesh","?Es5erty","42 rue de l'amour", null,14000,"Caen","2021-09-23",5);
    echo $rajesh."<br/><br/>";

    echo $rajesh->getIdUser()."<br/>";
    echo $rajesh->getNomUser()."<br/>";
    echo $rajesh->getPrenomUser()."<br/>";
    echo $rajesh->getMdp()."<br/>";
    echo $rajesh->getAdresse1()."<br/>";
    echo $rajesh->getAdresse2()."<br/>";
    echo $rajesh->getCpUser()."<br/>";
    echo $rajesh->getVilleUser()."<br/>";
    echo $rajesh->getDateCot()."<br/>";
    echo $rajesh->getIdRole()."<br/>";

} catch (UserException $e) {
    echo "ERREUR : ".$e->getMessage();
}



?>

