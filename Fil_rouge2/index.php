<?php

print_r($_POST);

$action = 'accueil';

if(isset($_POST["action"])) {
    $action = $_POST["action"];
}

switch ($action) {
    case 'accueil' :
        require 'Views/view_head.php';
        require 'Header/index_header.php';
        require 'Accueil/index_accueil.php';
        require 'Views/view_footer.php';

        break;

    case 'connexion' :
        require 'Views/view_head.php';
        require 'Accueil/index_accueil.php';
        require 'Views/view_footer.php';
}