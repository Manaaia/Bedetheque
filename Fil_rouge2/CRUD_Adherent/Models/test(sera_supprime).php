<?php

spl_autoload_register(function($classe) {
    include "Models/" . $classe . ".class.php";
});

const RC = "<br/>\n";

try {

    

    // echo "Création d'un utilisateur : <br/>";
    // $rajesh = new User (1234567899,"Koothrapali","Rajesh","?Es5erty","42 rue de l'amour", null,14000,"Caen","2021-09-23",5);
    // echo $rajesh."<br/><br/>";

    // echo $rajesh->getIdUser()."<br/>";
    // echo $rajesh->getNomUser()."<br/>";
    // echo $rajesh->getPrenomUser()."<br/>";
    // echo $rajesh->getMdp()."<br/>";
    // echo $rajesh->getAdresse1()."<br/>";
    // echo $rajesh->getAdresse2()."<br/>";
    // echo $rajesh->getCpUser()."<br/>";
    // echo $rajesh->getVilleUser()."<br/>";
    // echo $rajesh->getDateCot()."<br/>";
    // echo $rajesh->getIdRole()."<br/>";

    
    // echo "Création d'un utilisateur à erreur : <br/>";
    // $penny = new User (1234585263,"Soft-Kitty","Penny","??Es5erty","42 rue de l'amour", null,14000,"Caen","2021-09-23",4);
    // echo $penny."<br/><br/>";

    // echo "Affiche la liste des utilisateurs : <br/>";
    // $list = UserMgr::getListUsers();
    // var_dump($list);

    // echo "Récupère un utilisateur par Id : <br/>";
    // $rUser = UserMgr::getUserById(9583161311);
    // var_dump($rUser);

    // echo "Récupère un utilisateur par nom : <br/>";
    // $nUser = UserMgr::getUsersByName('Yvetot');
    // var_dump($nUser);

    // echo "Ajoute un utilisateur : <br/>";
    // $check=UserMgr::addUser($rajesh);
    // echo $check;

    // echo "Modifie un nom d'utilisateur : <br/>";
    // $checkmod = UserMgr::modNomUser($rajesh,"Cutie");
    // echo $checkmod;

    // echo "Supprime un utilisateur : <br/>";
    // $checkdel = UserMgr::delUser(1234567899);
    // echo $checkdel;

} catch (UserException $e) {
    echo "ERREUR : ".$e->getMessage();
} catch (UserMgrException $e) {
    echo "ERREUR : ".$e->getMessage();
}



?>

