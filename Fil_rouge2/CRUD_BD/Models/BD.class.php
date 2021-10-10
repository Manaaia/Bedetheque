<?php
class BD {
    //Propriétes
    private $ISBN;
    private $titreAlbum;
    private $numeroAlbum;
    private $prix;
    private $resume;
    private $idImage;
    private $idMiniImage;
    private $idSerie;
    private $idAuteur;

    // Constructeur
    public function __construct ($ISBN,$titreAlbum,$numeroAlbum,$prix,
    $resume,$idImage,$idMiniImage,$idSerie,$idAuteur) {
        $this->setISBN($ISBN);
        $this->setTitreAlbum($titreAlbum);
        $this->setNumeroAlbum($numeroAlbum);
        $this->setPrix($prix);
        $this->setResume($resume);
        $this->setImage($idImage);
        $this->setMiniImage($idMiniImage);
        $this->setSerie($idSerie);
        $this->setAuteur($idAuteur);
    }

    //Accesseurs

    //getters
    /**
     * récupère l'ISBN d'une BD
     * @return int
     */
    public function getISBN() {
        return $this->ISBN;
    }

    /**
     * récupère le titre d'une BD
     * @return string
     */
    public function getTitreAlbum() {
        return $this->titreAlbum;
    }

    /**
     * récupère le numéro d'album d'une BD
     * @return int
     */
    public function getNumeroAlbum() {
        return $this->numeroAlbum;
    }

    /**
     * récupère le prix d'une BD
     * @return float
     */
    public function getPrix() {
        return $this->prix;
    }

    /**
     * récupère le résumé d'une BD
     * @return string
     */
    public function getResume() {
        return $this->resume;
    }

    /**
     * récupère l'image d'une BD
     * @return int
     */
    public function getImage() {
        return $this->idImage;
    }

    /**
     * récupère la mini image d'une BD
     * @return int
     */
    public function getMiniImage() {
        return $this->idMiniImage;
    }

    /**
     * récupère l'id de Série d'une BD
     * @return int 
     */
    public function getSerie() {
        return $this->idSerie;
    }


    /**
     * récupère l'id d'Auteur d'une BD
     * @return int
     */
    public function getAuteur() {
        return $this->idAuteur;
    }


    //setters
    /**
     * initialise l'ISBN d'une BD
     * @param int $ISBN
     * @return void
     */
    private function setISBN($ISBN) {
        if(preg_match("/^[0-9]{13}$/", $ISBN)) {
            $this->ISBN = $ISBN;
        } else {
            throw new BDException("Attention : L'ISBN est un code à 13 chiffres");
        }
    }

    /**
     * initialise le titre d'une BD
     * @param string $tireAlbum
     * @return void
     */
    private function setTitreAlbum($titreAlbum) {
        if(preg_match("/^[\S]{1,}(?:[-\s][\S]{1,})*$/", $titreAlbum)) {
            $this->titreAlbum = $titreAlbum;
        } else {
            throw new BDException("Attention : Le titre est une chaine de caractères");
        }
    }
    
    /**
     * initialise le numéro d'album d'une BD
     * @param int $numeroAlbum
     * @return void
     */
    private function setNumeroAlbum($numeroAlbum) {
        if(preg_match("/^[0-9]{1,3}$/", $numeroAlbum)) {
            $this->numeroAlbum = $numeroAlbum;
        } else {
            throw new BDException("Attention : L'ISBN est un code à 13 chiffres");
        }
    }

    /**
     * initialise le prix d'une BD
     * @param float $prix
     * @return void
     */
    private function setPrix($prix) {
        if(preg_match("/^[0-9]{1,3}(?:,+([0-9]{2}))$/", $prix)) {
            $this->prix = $prix;
        } else {
            throw new BDException("Attention : Le prix est nombre décimal");
        }    
    }

    /**
     * initialise le résumé d'une BD
     * @param string $resume
     * @return void
     */
    private function setResume($resume) {
        if(preg_match("/^[\S]{1,}(?:[-\s][\S]{1,})*$/", $resume)) {
            $this->resume = $resume;
        } else {
            throw new BDException("Attention : Le résumé est une chaîne de caractères");
        }    
    }

    /**
     * initialise l'image d'une BD
     * @param int $idImage
     * @return void
     */
    private function setImage($idImage) {
        if(preg_match("/^[0-9]{1,3}$/", $idImage)) {
            $this->idImage = $idImage;
        } else {
            throw new BDException ("Attention : l'id de l'image doit être un nombre entier");
        }
    }

    /**
     * initialise l'image miniature d'une BD
     * @param int $idMiniImage
     * @return void
     */
    private function setMiniImage($idMiniImage) {
        if(preg_match("/^[0-9]{1,3}$/", $idMiniImage)) {
            $this->idMiniImage = $idMiniImage;
        } else {
            throw new BDException ("Attention : l'id de l'image doit être un nombre entier");
        }
    }

    /**
     * initialise l'id Série d'une BD
     * @param int $idSerie
     * @return void
     */
    private function setSerie($idSerie) {
        if(preg_match("/^[0-9]{1,3}$/", $idImage)) {
           $this->idSerie = $idSerie;
        } else {
            throw new BDException ("Attention : l'id de la série doit être un nombre entier");
        }
        
    }

    /**
     * initialise l'id Auteur d'une BD
     * @param int $idAuteur
     * @return void
     */
    private function setAuteur($idAuteur) {
        if(preg_match("/^[0-9]{1,3}$/", $idImage)) {
            $this->idAuteur = $idAuteur;
        } else {
            throw new BDException ("Attention : l'id de l'auteur doit être un nombre entier");
        }
        
    }

    /**
     * Affiche les informations relative à une BD
     * @return string $message
     */
    public function __toString() {
        $message = "<br/>Infos BD :<br/>ISBN : ".$this->getISBN()."<br/>Titre : ".$this->getTitreAlbum().
        "<br/>numéro : ".$this->getNumeroAlbum()."<br/>Prix : ".$this->getPrix().
        "<br/>Résumé : ".$this->getResume()."<br/>Image : ".$this->getImage().
        "<br/>Image miniature : ".$this->getMiniImage()."<br/>Série : ".$this->getSerie().
        "<br/>Auteur : ".$this->getAuteur();

        return $message;
    }

}
?>