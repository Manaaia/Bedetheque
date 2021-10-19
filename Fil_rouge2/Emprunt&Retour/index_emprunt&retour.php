<?php

require_once 'Models/model_emprunt&retour.inc.php';

if(isset($_POST["idAdherent"])) {
    $idAdherent = $_POST["idAdherent"];
    $user = UserMgr::getUserById($idAdherent);
    $prenom = $user->getPrenomUser();
    $nom = $user->getNomUser();
}

$aBibli = bibliothequeMgr::getListBibli();

require 'Views/view_emprunt&retour.php';
