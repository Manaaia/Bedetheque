<?php

require_once('connexionBDDException.class.php');

class connexionBDD
{
    // Static variable
    private static $connexion;

    // No explicit constructor

    /**
     * Connection to BDD
     * @param void
     * @return object
     */
    private static function connect()
    {
        $file = 'Contenu/Parameters/parameters.ini';

        if (file_exists($file)) {
            $aParam = parse_ini_file($file, true);
            extract($aParam['connexion bdd']);

            $dsn = "mysql:host=" . $host . "; port=" . $port . "; dbname=" . $bdd . "; charset=utf8";

            $mysqlPDO = new PDO(
                $dsn,
                $user,
                $password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );

            connexionBDD::$connexion = $mysqlPDO;


            return connexionBDD::$connexion;
        } else {
            echo "ERR:Fichier de paramètre inconnu<br/>\n";
            throw new connexionBDDException("ERR:Fichier de paramètre inconnu");
        }
    }

    /**
     * Deconnection from BDD
     * @param void
     * @return void
     */
    public static function disconnect()
    {
        connexionBDD::$connexion = null;
    }

    /**
     * Singleton Pattern : get connection and connect
     * @param void
     * @return object
     */
    // Pattern singleton
    public static function getConnexion()
    {
        if (connexionBDD::$connexion != null) {
            return connexionBDD::$connexion;
        } else {
            return connexionBDD::connect();
        }
    }
}
