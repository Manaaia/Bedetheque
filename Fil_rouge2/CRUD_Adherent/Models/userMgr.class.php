<?php

    require_once('userMgrException.class.php');

class UserMgr {
    /**
     * Get full list of users from table users in database bdtk
     * @param void
     * @return array of objects
     */
    public static function getListUsers() : array {
        $connexionPDO = connexionBDD::getConnexion();

        echo "Connexion réussie".RC;

        $sql = 'SELECT * FROM user';
        
        $resPDOstt = $connexionPDO->query($sql);

        $records = $resPDOstt->fetchAll(PDO::FETCH_ASSOC);

        $users = array ();
        foreach($records as $record) {
            $user = new User (...(array_values($record)));
            $users[] = $user;
        }        

        $resPDOstt->closeCursor();
        connexionBDD::disconnect();

        return $users;
    }

    /**
     * Get one user by ID from table user in database bdtk
     * @param int $id
     * @return object
     */
    public static function getUserById($id) {
   
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM user WHERE id_user = ?';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array($id));

        $record = $result->fetch(PDO::FETCH_ASSOC);

        $result->closeCursor();
        connexionBDD::disconnect();

        if($record) {
            $user = new User (...(array_values($record)));
            return $user;
        } else {
            throw new UserMgrException("aucun utilisateur correspondant");
        }
    }

    /**
     * Get user(s) by name from table user in database bdtk
     * @param string $name
     * @return object or
     * @return array of objects
     */
    public static function getAdherentByName($name) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM user WHERE Nom_user LIKE :nomVoulu AND id_role = 5 OR
         Prenom_user LIKE :nomVoulu AND id_role = 5';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':nomVoulu'=>"%".$name."%"));

        $records = $result->fetchAll(PDO::FETCH_ASSOC);

        $result->closeCursor();
        connexionBDD::disconnect();

        if($records) {
            return $records;
        } else {
            throw new UserMgrException("Aucun adhérent correspondant");
        }
    }

    /**
     * Get user(s) by name from table user in database bdtk
     * @param string $name
     * @return object or
     * @return array of objects
     */
    public static function getEmployeByName($name) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM user WHERE Nom_user LIKE :nomVoulu OR Prenom_user LIKE :nomVoulu AND
         id_role <> 5';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':nomVoulu'=>"%".$name."%"));

        $records = $result->fetchAll();

        $result->closeCursor();
        connexionBDD::disconnect();

        if($records) {
            return $records;
        } else {
            throw new UserMgrException("Aucun adhérent correspondant");
        }
    }

    /**
     * Add user to table user in database bdtk and return confirmation message
     * @param object $user
     * @return string
     */
    public static function addUser($user) {
        $connexionPDO = connexionBDD::getConnexion();
        
        $id_user = $user->getIdUser();
        $nom_user = $user->getNomUser();
        $prenom_user = $user->getPrenomUser();
        $mdp = $user->getMdp();
        $adresse1 = $user->getAdresse1();
        $adresse2 = $user->getAdresse2();
        $cp_user = $user->getCpUser();
        $ville_user = $user->getVilleUser();
        $dateCot = $user->getDateCot();
        $id_role = $user->getIdRole();
        
        $sql = 'INSERT INTO user VALUES(:idVoulu,:nomVoulu,:prenomVoulu,:mdpVoulu,:adr1Voulu,:adr2Voulu,:cpVoulu,:villeVoulu,:dateCotVoulu,:idRoleVoulu)';
        $result = $connexionPDO->prepare($sql);
        
        try {
            $result->execute(array(':idVoulu'=>$id_user,':nomVoulu'=>$nom_user,':prenomVoulu'=>$prenom_user,':mdpVoulu'=>$mdp,':adr1Voulu'=>$adresse1,
            ':adr2Voulu'=>$adresse2,':cpVoulu'=>$cp_user,':villeVoulu'=>$ville_user,':dateCotVoulu'=>$dateCot,':idRoleVoulu'=>$id_role));
            $count = $result->rowCount();
            if ($count == 0) {
                $message = "Lignes affectées : ".$count.RC;
            } else {
                $message = "Confirmation : l'utilisateur a bien été ajouté à la BDD.";
            }
        } catch(PDOException $e) {
            throw new UserMgrException("Cet identifiant est déjà dans la BDD.");
        } finally {
            $result->closeCursor();
            connexionBDD::disconnect();
        }

        return $message;
    }

    /**
     * Delete user from table user in database bdtk and return confirmation message
     * @param int $id
     * @return string
     */
    public static function delUser($id) {
        $connexionPDO = connexionBDD::getConnexion();
        $sql = 'DELETE FROM user WHERE id_user =:idVoulu';
        $result = $connexionPDO->prepare($sql);

        try {
            $result->execute(array(':idVoulu'=>$id));
            $count = $result->rowCount();
            if ($count == 0) {
                $message = "Lignes affectées : ".$count;
            } else {
                $message = "Confirmation : l'utilisateur a bien été supprimé de la BDD.";
            }
        } catch(PDOException $e) {
            throw new UserMgrException("Cet utilisateur n'existe pas dans la BDD.");
        } finally {
            $result->closeCursor();
            connexionBDD::disconnect();
        }

        return $message;
    }

    /**
     * Modify name of user from table user in database bdtk and return confirmation message
     * @param object $user
     * @param string $newNom
     * @return string
     */
    public static function modNomUser($user, $newNom) {
        $connexionPDO = connexionBDD::getConnexion();
        $id_user = $user->getIdUser();
        $nom_user = $user->getNomUser();
        $sql = 'UPDATE user SET Nom_user = :nomVoulu WHERE id_user = :idVoulu';
        $result = $connexionPDO->prepare($sql);

        try {
            $result->execute(array(':idVoulu'=>$id_user,':nomVoulu'=>$newNom));
            $count = $result->rowCount();
            if ($count == 0) {
                $message = "Lignes affectées : ".$count.RC;
            } else {
                $message = "Confirmation : l'utilisateur a bien été modifié.";
            }
        } catch(PDOException $e) {
            throw new UserMgrException("Cet utilisateur n'existe pas dans la BDD.");
        } finally {
            $result->closeCursor();
            connexionBDD::disconnect();
        }

        return $message;
    }
}