<?php 

function afficheNom($person) {
    $nom = $person->getNomUser();
    return $nom;
}

function affichePrenom($person) {
    $prenom = $person->getPrenomUser();
    return $prenom;
}

function afficheAdresse($person) {
    $adresse1 = $person->getAdresse1();
    $adresse2 = $person->getAdresse2();
    $cp = $person->getCpUser();
    $ville = $person->getVilleUser();
    if ($adresse2) {
        $strAdresse = $adresse1."<br/>".$adresse2."<br/>".$cp."<br/>".$ville;
    } else {
        $strAdresse = $adresse1."<br/>".$cp."<br/>".$ville;
    }
    return $strAdresse;
}

function afficheDateCo($person) {
    $dateCo = $person->getDateCot();
    $dateCo = date("Y-m-d", strtotime($dateCo));
    return $dateCo;
}

function afficheDateEndCo($dateStartCo) {
    $dateEndCo = date('Y-m-d', strtotime('+365 days', strtotime($dateStartCo)));
    return $dateEndCo;
}

function getInterval($dateEndCo) {
    $dateEndCo = new DateTime($dateEndCo);
    $today = new DateTime(date('Y-m-d'));

    $interval = $dateEndCo->diff($today)->days;
    return $interval;
}

function checkDateCo($dateStartCo) {
    $dateEndCo = afficheDateEndCo($dateStartCo);
    $interval = getInterval($dateEndCo);
    $dateEndCo = new DateTime($dateEndCo);
    $dateStartCo = new DateTime($dateStartCo);
    $today = new DateTime(date('Y-m-d'));
    if ($dateEndCo < $today) {
        $validity = 0;
    } else if ($interval < 14) {
        $validity = 1;
    } else {
        $validity = 2;
    }
    return $validity;
}

function afficheEmprunts($person) {
    
}

function afficheAmendes($person) {
    
}

function getListAdherent($nom) {
    try {
        $aUsers = UserMgr::getAdherentByName($nom);
        return $aUsers;
    } catch (UserMgrException $e) {
        "Erreur :".$e->getMessage();
    }
}