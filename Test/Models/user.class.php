<?php 

require_once('Models/connexionBDD.class.php');

class User {

    // Propriétés
    private $id_user;
    private $nom_user;
    private $prenom_user;
    private $mdp;
    private $adresse_1_user;
    private $adresse_2_user;
    private $cp_user;
    private $ville_user;
    private $date_cotisation;
    private $id_role;

    // Constructeur
    public function __construct ($id_user,$nom_user,$prenom_user,$mdp,
    $adresse_1_user,$adresse_2_user = null,$cp_user,$ville_user,$date_cotisation = "0000/00/00",$id_role) {
        $this->setIdUser($id_user);
        $this->setNomUser($nom_user);
        $this->setPrenomUser($prenom_user);
        $this->setMdp($mdp);
        $this->setAdresse1($adresse_1_user);
        $this->setAdresse2($adresse_2_user);
        $this->setCpUser($cp_user);
        $this->setVilleUser($ville_user);
        $this->setDateCot($date_cotisation);
        $this->setIdRole($id_role);
    }

    // Accesseurs
    private function setIdUser($id_user) {
        if (preg_match("/[0-9]{10}/",$id_user)) {
            $this->id_user = $id_user;
        } else {
            throw new UserException ("L'id utilisateur ne doit contenir que 10 chiffres.");
        }
    }

    public function getIdUser() {
        return $this->id_user;
    }

    private function setNomUser($nom_user) {
        if (preg_match("/[a-zA-Z-]/",$nom_user)) {
            $this->nom_user = $nom_user;
        } else {
            throw new UserException ("Le nom utilisateur ne doit contenir que des lettres ou des tirets.");
        }
    }

    public function getNomUser() {
        return $this->nom_user;
    }

    private function setPrenomUser($prenom_user) {
        if (preg_match("/[a-zA-Z-]/",$prenom_user)) {
            $this->prenom_user = $prenom_user;
        } else {
            throw new UserException ("Le prénom utilisateur ne doit contenir que des lettres ou des tirets.");
        }
    }

    public function getPrenomUser() {
        return $this->prenom_user;
    }

    private function setMdp($mdp) {
        if (preg_match("/^(?=\P{Ll}*\p{Ll})(?=\P{Lu}*\p{Lu})(?=\P{N}*\p{N})(?=[\p{L}\p{N}]*[^\p{L}\p{N}])[\s\S]{8,}$/",$mdp)) {
            $this->mdp = $mdp;
        } else {
            throw new UserException ("Le mot de passe utilisateur doit contenir au moins une miniscule, une majuscule, un chiffre, un symbole et avoir au minimum 8 caractères.");
        }
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function setAdresse1($adresse_1_user) {
        if (preg_match("/[0-9a-zA-Z-,]/",$adresse_1_user)) {
            $this->adresse_1_user = $adresse_1_user;
        } else {
            throw new UserException ("L'adresse utilisateur ne doit contenir que des lettres des chiffres ou des tirets.");
        }
    }

    public function getAdresse1() {
        return $this->adresse_1_user;
    }

    public function setAdresse2($adresse_2_user) {
        if (preg_match("/[0-9a-zA-Z-,]/",$adresse_2_user || $adresse_2_user == null)) {
            $this->adresse_2_user = $adresse_2_user;
        } else {
            throw new UserException ("L'adresse utilisateur ne doit contenir que des lettres des chiffres ou des tirets.");
        }
    }

    public function getAdresse2() {
        return $this->adresse_2_user;
    }

    public function setCpUser($cp_user) {
        if (preg_match("/[0-9]{5}/",$cp_user)) {
            $this->cp_user = $cp_user;
        } else {
            throw new UserException ("Le code postal ne doit contenir que 5 chiffres.");
        }
    }

    public function getCpUser() {
        return $this->cp_user;
    }

    public function setVilleUser($ville_user) {
        if (preg_match("/[a-zA-Z-]/",$ville_user)) {
            $this->ville_user = $ville_user;
        } else {
            throw new UserException ("La ville ne doit contenir que des lettres.");
        }
    }

    public function getVilleUser() {
        return $this->ville_user;
    }

    public function setDateCot($date_cotisation) {
        if (preg_match("/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/",$date_cotisation) || $date_cotisation == null) {
            $this->date_cotisation = $date_cotisation;
        } else {
            throw new UserException ("La date de cotisation doit être renseignée au format 'aaaa-mm-dd'.");
        }
    }

    public function getDateCot() {
        return $this->date_cotisation;
    }

    public function setIdRole($id_role) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT id_role FROM role';

        $result = $connexionPDO->prepare($sql);

        $result->execute();

        $rolelist = $result->fetchAll();

        $result->closeCursor();
        connexionBDD::disconnect();

        for ($i=0;$i<count($rolelist);$i++) {
            if (in_array($id_role,$rolelist[$i])) {
                $this->id_role = $id_role;
            }
        }

        if (!$this->id_role == $id_role) {
            throw new UserException ("Ce rôle utilisateur n'existe pas.");
        }
    }

    public function getIdRole() {
        return $this->id_role;
    }

    public function __toString() {
        $message = "<br/>Infos utilisateur :<br/>Id utilisateur : ".$this->id_user."<br/>Nom : ".$this->nom_user."<br/>Prénom : ".$this->prenom_user
        ."<br/>Adresse : ".$this->adresse_1_user.", ".$this->adresse_2_user.", ".$this->cp_user.", ".$this->ville_user."<br/>Date de cotisation : ".$this->date_cotisation
        ."<br/>Rôle : ".$this->id_role;

        return $message;
    }
}

?>