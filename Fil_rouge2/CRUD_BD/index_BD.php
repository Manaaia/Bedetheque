<?php 
try {
    spl_autoload_register(function($classe) {
        include "Models/" . $classe . ".class.php";
    });
} catch (Exception $e) {
    echo $e->getMessage();
}

try {
$bd1 = new BD (9780269887516, "Le club des cinq : à Venise !", 16, "8.50", "Blablabla, ils trouvent toujours la solution parce que c'est les zéros.", 1, 1, 3, 11);
echo $bd1;
} catch (BDException $e) {
    echo $e->getMessage();
}
?>
