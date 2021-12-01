<?php

require_once 'CRUD_Adherent/Models/model_adherent.inc.php';
require_once 'EmpruntRetour/Models/model_empruntRetour.inc.php';


switch ($action) {
    case 'statsAdherents':
        $aListAdherents = UserMgr::getListAdherent();
        require 'Views/view_statsAdherents.php';
        break;

    case 'statsExemplaires':
        $aListExemplaires = ExemplaireMgr::getListExemplaires();

        require 'Views/view_statsExemplaires.php';
        break;
}
