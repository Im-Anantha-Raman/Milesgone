<?php
require __DIR__.'/vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
$factory = (new Factory)
    ->withServiceAccount('ulakam-53ef0-firebase-adminsdk-twm2w-48b8554bb5.json')
    ->withDatabaseUri('https://ulakam-53ef0-default-rtdb.firebaseio.com/');
$database = $factory->createDatabase();
$auth = $factory->createAuth();
 ?>
