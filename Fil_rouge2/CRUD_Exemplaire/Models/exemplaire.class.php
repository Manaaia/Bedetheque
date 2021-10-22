<?php 

require_once('exemplaireException.class.php');

class Exemplaire {

    // Proprieties
    private $idExemplaire;
    private $dateEntree;
    private $commentaire;
    private $idEmplacement;
    private $statut;
    private $idEtat;
    private $ISBN;

    // Constructor
    public function __construct ($idExemplaire, $dateEntree, $commentaire = null, $idEmplacement = null, $statut, $idEtat, $ISBN) {
        $this->setIdExemplaire($idExemplaire);
        $this->setDateEntree($dateEntree);
        $this->setCommentaire($commentaire);
        $this->setIdEmplacement($idEmplacement);
        $this->setStatut($statut);
        $this->setIdEtat($idEtat);
        $this->setISBN($ISBN);
    }

    // Accessors
    /**
     * Control and set up idExemplaire.
     * @param string $idExemplaire
     * @return void
     */
    private function setIdExemplaire($idExemplaire) {
        if (preg_match("/[0-9]{13}_[0-9]{1,3}/",$idExemplaire)) {
            $this->idExemplaire = $idExemplaire;
        } else {
            throw new ExemplaireException ("L'id de l'exemplaire doit être composé de 13 chiffres suivi d'un underscore puis de chiffres.");
        }
    }

    /**
     * Return idExemplaire
     * @param void
     * @return int $idExemplaire
     */
    public function getIdExemplaire() {
        return $this->idExemplaire;
    }

    /**
     * Control and set up dateEntrée
     * @param string $dateEntree
     * @return void
     */
    private function setDateEntree($dateEntree) {
        if (preg_match("/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/",$dateEntree)) {
            $this->dateEntree = $dateEntree;
        } else {
            throw new ExemplaireException ("La date doit êrte au format date 'yyyy-mm-dd'.");
        }
    }

    /**
     * Return dateEntree
     * @param void
     * @return string $dateEntree
     */
    public function getDateEntree() {
        return $this->dateEntree;
    }

    /**
     * Control and set up commentaire
     * @param string $commentaire
     * @return void
     */
    private function setCommentaire($commentaire) {
            $this->commentaire = $commentaire;
    }

    /**
     * Return commentaire
     * @param void
     * @return string $dateEntree
     */
    public function getCommentaire() {
        return $this->commentaire;
    }

    /**
     * Control and set up idEmplacement
     * @param int $idEmplacement
     * @return void
     */
    private function setIdEmplacement($idEmplacement) {
        if($idEmplacement != null) {
            $connexionPDO = connexionBDD::getConnexion();

            $sql = 'SELECT idEmplacement FROM emplacement';

            $result = $connexionPDO->prepare($sql);

            $result->execute();

            $idList = $result->fetchAll();

            $result->closeCursor();
            connexionBDD::disconnect();

            for ($i=0;$i<count($idList);$i++) {
                if (in_array($idEmplacement,$idList[$i])) {
                    $this->idEmplacement = $idEmplacement;
                }
            }

            if (!$this->idEmplacement == $idEmplacement) {
                throw new ExemplaireException ("Cet emplacement n'existe pas.");
            }
        } else {
            $this->idEmplacement = $idEmplacement;
        }
    }

    /**
     * Return idEmplacement
     * @param void
     * @return int $idEmplacement
     */
    public function getIdEmplacement() {
        return $this->idEmplacement;
    }

    /**
     * Control and set up statut
     * @param int $statut
     * @return void
     */
    private function setStatut($statut) {
        if (preg_match("/[0-1]{1}/",$statut)) {
            $this->statut = $statut;
        } else {
            throw new ExemplaireException ("Le statut doit être soit 0 soit 1.");
        }
    }

    /**
     * Return statut
     * @param void
     * @return int $statut
     */
    public function getStatut() {
        return $this->statut;
    }

    /**
     * Control and set up idEtat
     * @param int $idEtat
     * @return void
     */
    private function setIdEtat($idEtat) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT idEtat FROM etat';

        $result = $connexionPDO->prepare($sql);

        $result->execute();

        $idList = $result->fetchAll();

        $result->closeCursor();
        connexionBDD::disconnect();

        for ($i=0;$i<count($idList);$i++) {
            if (in_array($idEtat,$idList[$i])) {
                $this->idEtat = $idEtat;
            }
        }

        if (!$this->idEtat == $idEtat) {
            throw new ExemplaireException ("Cet etat n'existe pas.");
        }
    }

    /**
     * Return idEtat
     * @param void
     * @return int $idEtat
     */
    public function getIdEtat() {
        return $this->idEtat;
    }

    /**
     * Control and set up ISBN
     * @param int $ISBN
     * @return void
     */
    private function setISBN($ISBN) {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT ISBN FROM album';

        $result = $connexionPDO->prepare($sql);

        $result->execute();

        $isbnList = $result->fetchAll();

        $result->closeCursor();
        connexionBDD::disconnect();

        for ($i=0;$i<count($isbnList);$i++) {
            if (in_array($ISBN,$isbnList[$i])) {
                $this->ISBN = $ISBN;
            }
        }

        if (!$this->ISBN == $ISBN) {
            throw new ExemplaireException ("Cet ISBN n'existe pas.");
        }
    }

    /**
     * Return ISBN
     * @param void
     * @return int $ISBN
     */
    public function getISBN() {
        return $this->ISBN;
    }
}