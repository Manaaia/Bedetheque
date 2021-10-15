<?php

if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $role = $user->getIdRole();
}

if ($action != 'connexion' && $action!= 'mdp_oublie') {
    require 'Views/view_header.php';
}
