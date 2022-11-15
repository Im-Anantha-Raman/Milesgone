<?php
include('php-firebase/db_config.php');
if(isset($_POST['sign-up']))
{
    $uname=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $phone=$_POST['phone'];
    $cpassword=$_POST['confirm_password'];

    $postData=
    [
        'username'=>$uname,
        'email'=>$email,
        'password'=>$password,
        'phone'=>$phone,
    ];
    $ref_table="users";
    $postRef = $database->getReference($ref_table)->push($postData);
    $postKey = $postRef->getKey();
}
?>
