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
* Retourne le rôle de l'employé donnée en paramètre
* @param object
* @return string
*/
function afficheRole($person) {
    $idRole = $person->getIdRole();
    $role = RoleMgr::getLabelRole($idRole);
    
    return $role;
}

/**
* Retourne la liste des employés recherchés
* @param string
* @return array of objects
*/
function getListEmployes($nom) {
    try {
        $aUsers = UserMgr::getEmployesByName($nom);
        return $aUsers;
    } catch (UserMgrException $e) {
        "Erreur :".$e->getMessage();
    }
}

/**
* Met à jour un employé en récupérant les données en $_POST et retourne une confirmation
* @param void
* @return string 
*/
function updateEmploye() {
    $flag = true;
    try {
        $idEmploye = $_POST["idEmploye"];
        $user = UserMgr::getUserById($idEmploye);
        $user->setNomUser($_POST["newNom"]);
        $user->setPrenomUser($_POST["newPrenom"]);
        $user->setAdresse1($_POST["newAdresse1"]);
        if (isset($_POST["newAdresse2"])) {
            $user->setAdresse2($_POST["newAdresse2"]);
        }
        $user->setCpUser($_POST["newCp"]);
        $user->setVilleUser($_POST["newVille"]);
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
* Supprime un employé et retourne une confirmation
* @param int
* @return string 
*/
function deleteEmploye($id) {
    try {
        $check = UserMgr::delUser($id);
        return $check;
    } catch (UserMgrException $e) {
        echo "Erreur :".$e->getMessage();
    }
}

/**
* Ajoute un employé via données en $_POST et retourne une confirmation
* @param int
* @return string 
*/
function addEmploye() {
    try {
        if(isset($_POST["adresse2"])) {
            $adresse2 = $_POST["adresse2"];
        } else {
            $adresse2 = null;
        }
        $user = new User (null, $_POST["nom"], $_POST["prenom"], $_POST["mdp"],
        $_POST["adresse1"], $adresse2, $_POST["cp"], $_POST["ville"], 
        null,$_POST["role"]);
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