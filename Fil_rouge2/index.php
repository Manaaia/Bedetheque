<?php

// spl_autoload_register(function($classe) {
//     include "../Models/" . $classe . ".class.php";
// });

require_once 'Header&Footer/Models/connexionBDD.class.php';
require_once 'CRUD_Adherent/Models/user.class.php';
require_once 'CRUD_Adherent/Models/userMgr.class.php';
require_once 'CRUD_Employe/Models/roleMgr.class.php';
require_once 'CRUD_BD/Models/BD.class.php';
require_once 'CRUD_BD/Models/BDMgr.class.php';
require_once 'CRUD_Exemplaire/Models/exemplaire.class.php';
require_once 'CRUD_Exemplaire/Models/exemplaireMgr.class.php';
require_once 'CRUD_Exemplaire/Models/etatMgr.class.php';
require_once 'Emprunt&Retour/Models/bibliotheque.class.php';
require_once 'Emprunt&Retour/Models/bibliothequeMgr.class.php';
require_once 'Emprunt&Retour/Models/emprunt.class.php';
require_once 'Emprunt&Retour/Models/empruntMgr.class.php';
require_once 'Accueil&Connexion/Models/model_connexion.inc.php';

session_start();

$type = 'Accueil';
$action = 'accueil';

// if (isset($_SESSION["user"])) {             // A commenter pour le déployement
//     print_r($_SESSION["user"]);
// }

if(isset($_POST["type"])) {
    $type = $_POST["type"];
}


if(isset($_POST["action"])) {
    $action = $_POST["action"];
}

if(isset($_POST["user_name"])) {
    $login = $_POST["user_name"];
    $mdp = $_POST["password"];
    $checkConnexion = toLogIn($login, $mdp);
    if ($checkConnexion) {
        $user = UserMgr::getUserById($login);
        $_SESSION["user"] = $user;
        $action = 'accueil';
    } else {
        $action = 'connexion';
    }
}

if ($action == "deconnexion") {
    unset($_SESSION["user"]);
    $action = 'accueil';
    $type = 'Accueil';
}

switch ($type) {
    case 'Accueil' :
        require 'Header&Footer/Views/view_head.php';
        require 'Header&Footer/index_header.php';
        require 'Accueil&Connexion/index_accueil.php';
        require 'Header&Footer/Views/view_footer.php';

        break;

    case 'Adherent' :
        require 'Header&Footer/Views/view_head.php';
        require 'Header&Footer/index_header.php';
        require 'CRUD_Adherent/index_adherent.php';
        require 'Header&Footer/Views/view_footer.php';

        break;

    case 'Employe' :
        require 'Header&Footer/Views/view_head.php';
        require 'Header&Footer/index_header.php';
        require 'CRUD_Employe/index_employe.php';
        require 'Header&Footer/Views/view_footer.php';

        break;

    case 'Emprunt' :
        require 'Header&Footer/Views/view_head.php';
        require 'Header&Footer/index_header.php';
        require 'Emprunt&Retour/index_emprunt&retour.php';
        require 'Header&Footer/Views/view_footer.php';

        break;

    case 'BD' :
        require 'Header&Footer/Views/view_head.php';
        require 'Header&Footer/index_header.php';
        require 'CRUD_BD/index_BD.php';
        require 'Header&Footer/Views/view_footer.php';

        break;

    case 'Statistiques' :
        require 'Header&Footer/Views/view_head.php';
        require 'Header&Footer/index_header.php';
        require 'Statistiques/index_statistiques.php';
        require 'Header&Footer/Views/view_footer.php';

        break;

}
    