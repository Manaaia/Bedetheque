<?php

    require_once('Models/connexionBDD.class.php');
    // require_once('Models/user.class.php');

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

        $records = $result->fetch(PDO::FETCH_OBJ);
        $result->closeCursor();
        connexionBDD::disconnect();

        if($records) {
            return $records;
        } else {
            throw new UserMgrException("aucun utilisateur correspondant".RC);
        }
        
    }

    /**
     * Get user(s) by name from table user in database bdtk
     * @param string $name
     * @return object or
     * @return array of objects
     */
    public static function getUsersByName($name) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT * FROM user WHERE Nom_user = :nomVoulu';

        $result = $connexionPDO->prepare($sql);

        $result->execute(array(':nomVoulu'=>$name));

        $records = $result->fetch(PDO::FETCH_OBJ);

        $result->closeCursor();
        connexionBDD::disconnect();

        if($records) {
            return $records;
        } else {
            throw new UserMgrException("aucun utilisateur correspondant".RC);
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
                $message = "Confirmation : l'utilisateur a bien été ajouté à la BDD.".RC;
            }
        } catch(PDOException $e) {
            throw new UserMgrException("Cet identifiant est déjà dans la BDD.".RC);
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
                $message = "Lignes affectées : ".$count.RC;
            } else {
                $message = "Confirmation : l'utilisateur a bien été supprimé de la BDD.".RC;
            }
        } catch(PDOException $e) {
            throw new UserMgrException("Cet utilisateur n'existe pas dans la BDD.".RC);
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
                $message = "Confirmation : l'utilisateur a bien été modifié.".RC;
            }
        } catch(PDOException $e) {
            throw new UserMgrException("Cet utilisateur n'existe pas dans la BDD.".RC);
        } finally {
            $result->closeCursor();
            connexionBDD::disconnect();
        }

        return $message;
    }
}