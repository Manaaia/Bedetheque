<?php

require_once('empruntException.class.php');

class Emprunt
{

    // Proprieties
    private $idEmprunt;
    private $dateEmprunt;
    private $dateRetour;
    private $idUser;
    private $idExemplaire;

    // Constructor
    public function __construct($idEmprunt = null, $dateEmprunt, $dateRetour = null, $idUser, $idExemplaire)
    {
        $this->setIdEmprunt($idEmprunt);
        $this->setDateEmprunt($dateEmprunt);
        $this->setDateRetour($dateRetour);
        $this->setIdUser($idUser);
        $this->setIdExemplaire($idExemplaire);
    }

    // Accessors
    /**
     * Control and set up Id_emprunt.
     * @param int $idEmprunt
     * @return void
     */
    private function setIdEmprunt($idEmprunt)
    {
        if (preg_match("/[0-9]/", $idEmprunt) || $idEmprunt == null) {
            $this->idEmprunt = $idEmprunt;
        } else {
            throw new EmpruntException("L'id emprunt ne doit être composé que de chiffres.");
        }
    }

    /**
     * Return idEmprunt
     * @param void
     * @return int $idEmprunt
     */
    public function getIdEmprunt()
    {
        return $this->idEmprunt;
    }

    /**
     * Control and set up Date_emprunt.
     * @param string $dateEmprunt
     * @return void
     */
    private function setDateEmprunt($dateEmprunt)
    {
        if (preg_match("/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/", $dateEmprunt)) {
            $this->dateEmprunt = $dateEmprunt;
        } else {
            throw new EmpruntException("La date doit être au format date 'yyyy-mm-dd'.");
        }
    }

    /**
     * Return Date_emprunt
     * @param void
     * @return string $dateEmprunt
     */
    public function getDateEmprunt()
    {
        return $this->dateEmprunt;
    }

    /**
     * Control and set up Date_retour.
     * @param string $dateRetour
     * @return void
     */
    private function setDateRetour($dateRetour)
    {
        if (preg_match("/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/", $dateRetour) || $dateRetour == null) {
            $this->dateRetour = $dateRetour;
        } else {
            throw new EmpruntException("La date doit être au format date 'yyyy-mm-dd'.");
        }
    }

    /**
     * Return Date_retour
     * @param void
     * @return string $dateRetour
     */
    public function getDateRetour()
    {
        return $this->dateRetour;
    }

    /**
     * Control and set up Id_User.
     * @param int $idUser
     * @return void
     */
    private function setIdUser($idUser)
    {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT id_user FROM user WHERE id_role = 5';

        $result = $connexionPDO->prepare($sql);

        $result->execute();

        $idList = $result->fetchAll();

        $result->closeCursor();
        connexionBDD::disconnect();

        for ($i = 0; $i < count($idList); $i++) {
            if (in_array($idUser, $idList[$i])) {
                $this->idUser = $idUser;
            }
        }

        if (!$this->idUser == $idUser) {
            throw new ExemplaireException("Cet adhérent n'existe pas.");
        }
    }

    /**
     * Return Id_user
     * @param void
     * @return int $idUser
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Control and set up Id_exemplaire.
     * @param string $idExemplaire
     * @return void
     */
    private function setIdExemplaire($idExemplaire)
    {
        $connexionPDO = connexionBDD::getConnexion();

        $sql = 'SELECT ID_exemplaire FROM exemplaire';

        $result = $connexionPDO->prepare($sql);

        $result->execute();

        $idList = $result->fetchAll();

        $result->closeCursor();
        connexionBDD::disconnect();

        for ($i = 0; $i < count($idList); $i++) {
            if (in_array($idExemplaire, $idList[$i])) {
                $this->idExemplaire = $idExemplaire;
            }
        }

        if (!$this->idExemplaire == $idExemplaire) {
            throw new ExemplaireException("Cet exemplaire n'existe pas.");
        }
    }

    /**
     * Return Id_exemplaire
     * @param void
     * @return int $idExemplaire
     */
    public function getIdExemplaire()
    {
        return $this->idExemplaire;
    }
}
