<?php
include('php-firebase/php-firestore/Gfirestore.php');
$data1=getData('Users','G5AYVnxNuYhL2GhjahFVSou9slp1');
foreach ($data1 as $user) {
    printf('User: %s' . PHP_EOL, $user->id());
    printf('First: %s' . PHP_EOL, $user['email']);
}

?>
