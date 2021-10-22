<?php

require_once 'Models/model_accueil.inc.php';

switch ($action) {
    case 'accueil' :
        $aReco = randomReco();
        require 'Views/view_accueil.php';
        break;

    case 'connexion' :
        require 'Views/view_connexion.php';
        break;

    case 'mdp_oublie' :
        require 'Views/view_mdp_oublie.php';
        break;

}

?>