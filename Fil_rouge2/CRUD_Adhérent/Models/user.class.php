<?php 

require_once('Models/connexionBDD.class.php');

class User {

    // Proprieties
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

    // Constructor
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

    // Accessors
    /**
     * Control and set up Id_user. Private function because propriety must not be modified
     * @param int $id_user
     * @return void
     */
    private function setIdUser($id_user) {
        if (preg_match("/[0-9]{10}/",$id_user)) {
            $this->id_user = $id_user;
        } else {
            throw new UserException ("L'id utilisateur doit contenir 10 chiffres.");
        }
    }

    /**
     * Return Id_user
     * @param void
     * @return int $id_user
     */
    public function getIdUser() {
        return $this->id_user;
    }

    /**
     * Control and set up $nom_user
     * @param string $nom_user
     * @return void
     */
    private function setNomUser($nom_user) {
        if (preg_match("/^[a-zA-Z-'ëäïéàçêâûôîèù ]+$/",$nom_user)) {
            $this->nom_user = $nom_user;
        } else {
            throw new UserException ("Le nom utilisateur ne doit contenir que des lettres ou des tirets.");
        }
    }

    /**
     * Return $nom_user
     * @param void
     * @return string $nom_user
     */
    public function getNomUser() {
        return $this->nom_user;
    }

    /**
     * Control and set up $prenom_user
     * @param string $prenom_user
     * @return void
     */
    private function setPrenomUser($prenom_user) {
        if (preg_match("/^[a-zA-Z-'ëäïéàçêâûôîèù ]+$/",$prenom_user)) {
            $this->prenom_user = $prenom_user;
        } else {
            throw new UserException ("Le prénom utilisateur ne doit contenir que des lettres ou des tirets.");
        }
    }

    /**
     * Return $prenom_user
     * @param void
     * @return string $prenom_user
     */
    public function getPrenomUser() {
        return $this->prenom_user;
    }

    /**
     * Control and set up mdp
     * @param string $mdp
     * @return void
     */
    public function setMdp($mdp) {
        if (preg_match("/^(?=\P{Ll}*\p{Ll})(?=\P{Lu}*\p{Lu})(?=\P{N}*\p{N})(?=[\p{L}\p{N}]*[^\p{L}\p{N}])[\s\S]{8,}$/",$mdp)) {
            $this->mdp = $mdp;
        } else {
            throw new UserException ("Le mot de passe utilisateur doit contenir au moins une miniscule, une majuscule, un chiffre, un symbole et avoir au minimum 8 caractères.");
        }
    }

    /**
     * Return mdp
     * @param void
     * @return string $mdp
     */
    public function getMdp() {
        return $this->mdp;
    }

    /**
     * Control and set up adress1
     * @param string $adresse_1_user
     * @return void
     */
    public function setAdresse1($adresse_1_user) {
        if (preg_match("/^[0-9a-zA-Z-,'ëäïéàçêâûôîèù ]+$/",$adresse_1_user)) {
            $this->adresse_1_user = $adresse_1_user;
        } else {
            throw new UserException ("L'adresse utilisateur ne doit contenir que des lettres des chiffres ou des tirets.");
        }
    }

    /**
     * Return adress1
     * @param void
     * @return string $adresse_1_user
     */
    public function getAdresse1() {
        return $this->adresse_1_user;
    }

    /**
     * Control and set up adress2
     * @param string $adresse_2_user
     * @return void
     */
    public function setAdresse2($adresse_2_user) {
        if (preg_match("/^[0-9a-zA-Z-,'ëäïéàçêâûôîèù ]+$/",$adresse_2_user || $adresse_2_user == null)) {
            $this->adresse_2_user = $adresse_2_user;
        } else {
            throw new UserException ("L'adresse utilisateur ne doit contenir que des lettres des chiffres ou des tirets.");
        }
    }

    /**
     * Return adress2
     * @param void
     * @return string $adresse_2_user
     */
    public function getAdresse2() {
        return $this->adresse_2_user;
    }

    /**
     * Control and set up cp
     * @param int $cp_user
     * @return void
     */
    public function setCpUser($cp_user) {
        if (preg_match("/^[0-9]{5}+$/",$cp_user)) {
            $this->cp_user = $cp_user;
        } else {
            throw new UserException ("Le code postal ne doit contenir que 5 chiffres.");
        }
    }

    /**
     * Return cp
     * @param void
     * @return int $cp_user
     */
    public function getCpUser() {
        return $this->cp_user;
    }

    /**
     * Control and set up ville
     * @param string $ville_user
     * @return void
     */
    public function setVilleUser($ville_user) {
        if (preg_match("/^[a-zA-Z-'ëäïéàçêâûôîèù ]+$/",$ville_user)) {
            $this->ville_user = $ville_user;
        } else {
            throw new UserException ("La ville ne doit contenir que des lettres.");
        }
    }

    /**
     * Return ville
     * @param void
     * @return string $ville_user
     */
    public function getVilleUser() {
        return $this->ville_user;
    }

    /**
     * Control and set up cotisation date
     * @param string $date_cotisation
     * @return void
     */
    public function setDateCot($date_cotisation) {
        if (preg_match("/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/",$date_cotisation) || $date_cotisation == null) {
            $this->date_cotisation = $date_cotisation;
        } else {
            throw new UserException ("La date de cotisation doit être renseignée au format 'aaaa-mm-dd'.");
        }
    }

    /**
     * Return cotisation date
     * @param void
     * @return string $date_cotisation
     */
    public function getDateCot() {
        return $this->date_cotisation;
    }

    /**
     * Control and set up id_role
     * @param int $id_role
     * @return void
     */
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

    /**
     * Return id_role
     * @param void
     * @return int $id_role
     */
    public function getIdRole() {
        return $this->id_role;
    }

    // Other functions
     /**
    * Display parameters
    *
    * @param void
    * @return string $id_user,$nom_user,$prenom_user,$adresse_1_user,$adresse_2_user,$cp_user,$ville_user,$date_cotisation,$id_role
    */
    public function __toString() {
        $message = "<br/>Infos utilisateur :<br/>Id utilisateur : ".$this->id_user."<br/>Nom : ".$this->nom_user."<br/>Prénom : ".$this->prenom_user
        ."<br/>Adresse : ".$this->adresse_1_user.", ".$this->adresse_2_user.", ".$this->cp_user.", ".$this->ville_user."<br/>Date de cotisation : ".$this->date_cotisation
        ."<br/>Rôle : ".$this->id_role;

        return $message;
    }
}

?>