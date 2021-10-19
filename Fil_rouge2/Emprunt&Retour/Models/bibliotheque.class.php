<?php 

require_once('bibliothequeException.class.php');

class Bibliotheque {

    // Proprieties
    private $idBibli;
    private $nom_bibli;

    // Constructor
    public function __construct ($idBibli = null,$nom_bibli) {
        $this->setIdBibli($idBibli);
        $this->setNomBibli($nom_bibli);
    }

    // Accessors
    /**
     * Control and set up Id_Bibli.
     * @param int $idBibli
     * @return void
     */
    private function setIdBibli($idBibli) {
        if (preg_match("/[0-9]{1,2}/",$idBibli) || $idBibli == null) {
            $this->idBibli = $idBibli;
        } else {
            throw new BibliothequeException ("L'id de bibliotheque ne doit être composé que d'un ou deux chiffres.");
        }
    }

    /**
     * Return idBibli
     * @param void
     * @return int $idBibli
     */
    public function getIdBibli() {
        return $this->idBibli;
    }

    /**
     * Control and set up Nom_Bibli.
     * @param string $nom_bibli
     * @return void
     */
    private function setNomBibli($nom_bibli) {
        if (preg_match("/[a-zA-Z]/",$nom_bibli)) {
            $this->nom_bibli = $nom_bibli;
        } else {
            throw new UserException ("Le nom de bibliotheque doit n'être composé que de lettres.");
        }
    }

    /**
     * Return Nom_bibli
     * @param void
     * @return string $nom_bibli
     */
    public function getNomBibli() {
        return $this->nom_bibli;
    }

}