<?php

switch ($action) {
    case 'addEmploye' :
        require 'Views/view_addEmploye.php';
        break;

    case 'searchEmploye' :
        require 'Views/view_searchEmploye.php';
        break;

    case 'displayEmploye' :
        require 'Views/view_displayEmploye.php';
        break;

    case 'modifyEmploye' :
        require 'Views/view_modifyEmploye.php';
        break;
}