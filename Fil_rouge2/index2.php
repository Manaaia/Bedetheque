<?php

// spl_autoload_register(function($classe) {
//     include "../Models/" . $classe . ".class.php";
// });

require_once 'HeaderFooter/Models/connexionBDD.class.php';
require_once 'CRUD_Adherent/Models/user.class.php';
require_once 'CRUD_Adherent/Models/userMgr.class.php';
require_once 'CRUD_Employe/Models/roleMgr.class.php';
// Commentaire FLAVIE supprimé
require_once 'CRUD_BD/Models/BD.class.php';
// Commentaire FLAVIE supprimé
require_once 'CRUD_BD/Models/BDMgr.class.php';
require_once 'CRUD_Exemplaire/Models/exemplaire.class.php';
require_once 'CRUD_Exemplaire/Models/exemplaireMgr.class.php';
// PB ICI
//require_once 'CRUD_Exemplaire/Models/etatMgr.class.php';
require_once 'EmpruntRetour/Models/bibliotheque.class.php';
require_once 'EmpruntRetour/Models/bibliothequeMgr.class.php';
// PB ICI
//require_once 'Emprunt&Retour/Models/emprunt.class.php';
require_once 'EmpruntRetour/Models/empruntMgr.class.php';
require_once 'AccueilConnexion/Models/model_connexion.inc.php';


session_start();

$type = 'Accueil';
$action = 'accueil';

// if (isset($_SESSION["user"])) {             // A commenter pour le déployement
//     print_r($_SESSION["user"]);
// }

if (isset($_POST["type"])) {
    $type = $_POST["type"];
}


if (isset($_POST["action"])) {
    $action = $_POST["action"];
}

if (isset($_POST["user_name"])) {
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
    case 'Accueil':
        require 'HeaderFooter/Views/view_head.php';
        require 'HeaderFooter/index_header.php';
        require 'AccueilConnexion/index_accueil.php';
        require 'HeaderFooter/Views/view_footer.php';

        break;

    case 'Adherent':
        require 'HeaderFooter/Views/view_head.php';
        require 'HeaderFooter/index_header.php';
        require 'CRUD_Adherent/index_adherent.php';
        require 'HeaderFooter/Views/view_footer.php';

        break;

    case 'Employe':
        require 'HeaderFooter/Views/view_head.php';
        require 'HeaderFooter/index_header.php';
        require 'CRUD_Employe/index_employe.php';
        require 'HeaderFooter/Views/view_footer.php';

        break;

    case 'Emprunt':
        require 'HeaderFooter/Views/view_head.php';
        require 'HeaderFooter/index_header.php';
        require 'EmpruntRetour/index_empruntretour.php';
        require 'HeaderFooter/Views/view_footer.php';

        break;

    case 'BD':
        require 'HeaderFooter/Views/view_head.php';
        require 'HeaderFooter/index_header.php';
        require 'CRUD_BD/index_BD.php';
        require 'HeaderFooter/Views/view_footer.php';

        break;

    case 'Statistiques':
        require 'HeaderFooter/Views/view_head.php';
        require 'HeaderFooter/index_header.php';
        require 'Statistiques/index_statistiques.php';
        require 'HeaderFooter/Views/view_footer.php';

        break;
}
