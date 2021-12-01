<?php

require_once('BDException.class.php');

class BD {
    //Propriétes (FLAVIE)
    private $ISBN;
    private $titreAlbum;
    private $numeroAlbum;
    private $prix;
    private $resume;
    private $idImage;
    private $idMiniImage;
    private $idSerie;
    private $idAuteur;

    // Constructeur (FLAVIE)
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
    /** FLAVIE
     * récupère l'ISBN d'une BD
     * @return int
     */
    public function getISBN() {
        return $this->ISBN;
    }

    /** FLAVIE
     * récupère le titre d'une BD
     * @return string
     */
    public function getTitreAlbum() {
        return $this->titreAlbum;
    }

    /** FLAVIE
     * récupère le numéro d'album d'une BD
     * @return string
     */
    public function getNumeroAlbum() {
        return $this->numeroAlbum;
    }

    /** FLAVIE
     * récupère le prix d'une BD
     * @return float
     */
    public function getPrix() {
        return $this->prix;
    }

    /** FLAVIE
     * récupère le résumé d'une BD
     * @return string
     */
    public function getResume() {
        return $this->resume;
    }

    /** FLAVIE
     * récupère l'image d'une BD
     * @return string
     */
    public function getImage() {
        return $this->idImage;
    }

    /** FLAVIE
     * récupère la mini image d'une BD
     * @return string
     */
    public function getMiniImage() {
        return $this->idMiniImage;
    }

    /** FLAVIE
     * récupère l'id de Série d'une BD
     * @return int 
     */
    public function getSerie() {
        return $this->idSerie;
    }


    /** FLAVIE
     * récupère l'id d'Auteur d'une BD
     * @return int
     */
    public function getAuteur() {
        return $this->idAuteur;
    }


    //setters
    /** FLAVIE
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

    /** FLAVIE
     * initialise le titre d'une BD
     * @param string $tireAlbum
     * @return void
     */
    private function setTitreAlbum($titreAlbum) {
        if(preg_match("/^[\S]{1,}(?:[-\s][\S]{1,})*$/u", $titreAlbum)) {
            $this->titreAlbum = $titreAlbum;
        } else {
            throw new BDException("Attention : Le titre est une chaine de caractères");
        }
    }
    
    /** FLAVIE
     * initialise le numéro d'album d'une BD
     * @param string $numeroAlbum
     * @return void
     */
    private function setNumeroAlbum($numeroAlbum) {
        if(preg_match("/^[0-9A-Z]{1,3}$/", $numeroAlbum)) {
            $this->numeroAlbum = $numeroAlbum;
        } else {
            throw new BDException("Attention : Le numéro d'album ne peut contenir que des chiffres ou des lettres");
        }
    }

    /** FLAVIE
     * initialise le prix d'une BD
     * @param float $prix
     * @return void
     */
    private function setPrix($prix) {
        if(preg_match("/^\d+(?:[.]\d{2}|$)$/", $prix)) {
            $this->prix = $prix;
        } else {
            throw new BDException("Attention : Le prix est nombre décimal inférieur à 1000");
        }    
    }

    /** FLAVIE
     * initialise le résumé d'une BD
     * @param string $resume
     * @return void
     */
    private function setResume($resume) {
        if(preg_match("/^[\S]{1,}(?:[-\s][\S]{1,})*$/u", $resume) || $resume === null) {
            $this->resume = $resume;
        } else {
            throw new BDException("Attention : Le résumé est une chaîne de caractères");
        }    
    }

    /** FLAVIE
     * initialise l'image d'une BD
     * @param string $idImage
     * @return void
     */
    private function setImage($idImage) {
        if(preg_match("/^\S+(?:\s*\S)*(?:\s)*\.jpg$/", $idImage)) {
            $this->idImage = $idImage;
        } else {
            throw new BDException ("Attention : l'id de l'image doit être un nom de fichier .jpg");
        }
    }

    /** FLAVIE
     * initialise l'image miniature d'une BD
     * @param string $idMiniImage
     * @return void
     */
    private function setMiniImage($idMiniImage) {
        if(preg_match("/^\S+(?:\s*\S)*(?:\s)*\.jpg$/u", $idMiniImage)) {
            $this->idMiniImage = $idMiniImage;
        } else {
            throw new BDException ("Attention : l'id de l'image doit être un nom de fichier .jpg");
        }
    }

    /** FLAVIE
     * initialise l'id Série d'une BD
     * @param int $idSerie
     * @return void
     */
    private function setSerie($idSerie) {
        if(preg_match("/^[0-9]{1,3}$/", $idSerie)) {
           $this->idSerie = $idSerie;
        } else {
            throw new BDException ("Attention : l'id de la série doit être un nombre entier inférieur à 1000");
        }
        
    }

    /** FLAVIE
     * initialise l'id Auteur d'une BD
     * @param int $idAuteur
     * @return void
     */
    private function setAuteur($idAuteur) {
        if(preg_match("/^[0-9]{1,3}$/", $idAuteur)) {
            $this->idAuteur = $idAuteur;
        } else {
            throw new BDException ("Attention : l'id de l'auteur doit être un nombre entier inférieur à 1000");
        }
        
    }

    /** FLAVIE
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