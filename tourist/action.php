<?php
    include('../php-firebase/db_config.php');
    if(isset($_GET['mode']))
    {
        if($_GET['mode']=="addfriend")
        {
            $id=$_GET['id'];
            $uid=$_GET['uid'];
            $atable="Friends/".$uid."/RequestsSent/".$id."/id";
            $aresult=$database->getReference($atable)->set($id);
            $atable="Friends/".$id."/RequestsReceived/".$uid."/id";
            $aresult=$database->getReference($atable)->set($uid);
            echo 'successfull';
        }
    }
    else
    {
        if(isset($_GET['id']))
        {
            echo 'id found';
        }
    }
?>
