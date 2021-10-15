<?php

/**
* Vérifie la validité du login
* @param int $login
* @param string $mdp
* @return bool
*/
function toLogIn($login,$mdp) : bool {
    $flag = false;
    try {
        $user = UserMgr::getUserById($login);

        if ($user) {
            if ($user->getMdp() == $mdp) {
                $flag = true;
            }
        }
    } catch (UserMgrException $e) {
        $flag = false;
    } finally {
        return $flag;
    }
}