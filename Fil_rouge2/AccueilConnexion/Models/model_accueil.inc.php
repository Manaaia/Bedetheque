<?php 

/**
* Create an array of random album object of length 5
* @param void
* @return array of objects
*/
function randomReco() {
    $aList= BDMgr::getListISBN();
    $aRandom = array();
    $checkRandom = array();

    for ($i = 0; $i < 5; $i++) {
        $flag = true;
        do {
            $flag = false;
            $random = rand(0, count($aList)-1);
            $flag = verifPresence($random, $checkRandom, $flag);
        } while ($flag == true);

        $checkRandom[] = $random;
        $aRandom[] = $aList[$random];
    }
    return $aRandom;
}

/**
* Verify that there is not duplicate in array
* @param int $random
* @param array $checkRandom
* @param bool $flag
* @return bool $flag
*/
function verifPresence($random, $checkRandom,$flag) {
    for ($i=0; $i < count($checkRandom); $i++) {
        if($checkRandom[$i] == $random) {
            $flag = true;
        }
    }
    return $flag;
}
