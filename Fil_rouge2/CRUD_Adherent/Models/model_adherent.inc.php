<?php 

/**
* Retourne le nom de l'utilisateur donnée en paramètre
* @param object
* @return string
*/
function afficheNom($person) {
    $nom = $person->getNomUser();
    return $nom;
}

/**
* Retourne le prénom de l'utilisateur donnée en paramètre
* @param object
* @return string
*/
function affichePrenom($person) {
    $prenom = $person->getPrenomUser();
    return $prenom;
}

/**
* Retourne l'adresse complète de l'utilisateur donnée en paramètre
* @param object
* @return string
*/
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

/**
* Retourne la date de cotisation de l'utilisateur donnée en paramètre
* @param object
* @return date
*/
function afficheDateCo($person) {
    $dateCo = $person->getDateCot();
    $dateCo = date("Y-m-d", strtotime($dateCo));
    return $dateCo;
}

/**
* Calcule et retourne la date d'expiration de la cotisation de l'utilisateur donnée en paramètre
* @param date
* @return date
*/
function afficheDateEndCo($dateStartCo) {
    $dateEndCo = date('Y-m-d', strtotime('+365 days', strtotime($dateStartCo)));
    return $dateEndCo;
}

/**
* Retourne l'interval en jours entre aujourd'hui et la date d'expiration de la cotisation de l'utilisateur donnée en paramètre
* @param date
* @return int
*/
function getInterval($dateEndCo) {
    $dateEndCo = new DateTime($dateEndCo);
    $today = new DateTime(date('Y-m-d'));

    $interval = $dateEndCo->diff($today)->days;
    return $interval;
}

/**
* Vérifie le statut de la cotisation de l'utilisateur donnée en paramètre
* @param date
* @return int
*/
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

/**
* Retourne la liste des adhérents recherchés
* @param string
* @return array of objects
*/
function getListAdherent($nom) {
    try {
        $aUsers = UserMgr::getAdherentsByName($nom);
        return $aUsers;
    } catch (UserMgrException $e) {
        "Erreur :".$e->getMessage();
    }
}

/**
* Met à jour un adhérent en récupérant les données en $_POST et retourne une confirmation
* @param void
* @return string 
*/
function updateAdherent() {
    $flag = true;
    try {
        $idAdherent = $_POST["idAdherent"];
        $user = UserMgr::getUserById($idAdherent);
        $user->setNomUser($_POST["newNom"]);
        $user->setPrenomUser($_POST["newPrenom"]);
        $user->setAdresse1($_POST["newAdresse1"]);
        if (isset($_POST["newAdresse2"])) {
            $user->setAdresse2($_POST["newAdresse2"]);
        }
        $user->setCpUser($_POST["newCp"]);
        $user->setVilleUser($_POST["newVille"]);
        $user->setDateCot($_POST["newDateCot"]);
    } catch (UserException $e) {
        echo "Erreur : ".$e->getMessage();
        return $flag = false;
    }

    if($flag) {
        try {
            $check = UserMgr::modUser($user);
            if(isset($check)) {
                return $flag = true;
            }
        } catch (UserMgrException $e) {
            echo "Erreur :".$e->getMessage();
        }
    }
}

/**
* Supprime un adhérent et retourne une confirmation
* @param int
* @return string 
*/
function deleteAdherent($id) {
    try {
        $check = UserMgr::delUser($id);
        return $check;
    } catch (UserMgrException $e) {
        echo "Erreur :".$e->getMessage();
    }
}

/**
* Ajoute un adhérent via données en $_POST et retourne une confirmation
* @param int
* @return string 
*/
function addAdherent() {
    try {
        if(isset($_POST["adresse2"])) {
            $adresse2 = $_POST["adresse2"];
        } else {
            $adresse2 = null;
        }
        $user = new User (null, $_POST["nom"], $_POST["prenom"], $_POST["mdp"],
        $_POST["adresse1"], $adresse2, $_POST["cp"], $_POST["ville"], 
        $_POST["dateCo"],5);
    } catch (UserException $e) {
        echo "Erreur : ".$e->getMessage();
    }

    if(isset($user)) {
        try {
            $check = UserMgr::addUser($user);
            if(isset($check)) {
                return $flag = true;
            }
        } catch (UserMgrException $eMgr) {
            echo "Erreur : ".$eMgr->getMessage();
        }
    } else {
        return $flag = false;
    }
}

// function afficheEmprunts($person) {
    
// }

// function afficheAmendes($person) {
    
// }