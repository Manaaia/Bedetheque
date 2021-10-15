<?php

switch ($action) {
    case 'addAdherent' :
        require 'Views/view_addAdherent.php';
        break;

    case 'searchAdherent' :
        require 'Views/view_searchAdherent.php';
        break;

    case 'displayAdherent' :
        require 'Views/view_displayAdherent.php';
        break;

    case 'modifyAdherent' :
        require 'Views/view_modifyAdherent.php';
        break;

}