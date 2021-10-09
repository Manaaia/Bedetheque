<?php

class connexionBDD {
	// variables statiques
	private static $connexion;

	// Pas de constructeur explicite

	// fonction de connexion à la BDD
    private static function connect() {
        $file = '../Parameters/parameters.ini';
        if(file_exists($file)) {
            $aParam = parse_ini_file($file, true);
            extract($aParam['connexion bdd']);

            $dsn = "mysql:host=".$host."; port=".$port."; dbname=".$bdd."; charset=utf8";
            $mysqlPDO = new PDO($dsn, $user, $password,
                            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            
            connexionBDD::$connexion = $mysqlPDO;
		
		    return connexionBDD::$connexion;
        } else {
            throw new connexionBDDException("ERR:Fichier de paramètre inconnu");
        }
    }

	// fonction de 'déconnexion' de la BDD
    public static function disconnect(){
        connexionBDD::$connexion = null;
    }

    // Pattern singleton
    public static function getConnexion() {
        if (connexionBDD::$connexion != null) {
            return connexionBDD::$connexion;
        } else {
            return connexionBDD::connect();
        }
    }
}

?>