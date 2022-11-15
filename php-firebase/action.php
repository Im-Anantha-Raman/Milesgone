<?php
include('db_config.php');
$database = $factory->createDatabase();
if(isset($_POST['sign-up']))
{
    $uname=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    //$phone=$_POST['phone'];
    $cpassword=$_POST['confirm_password'];

    $postData=
    [
        'username'=>$uname,
        'email'=>$email,
        'password'=>$password,

    ];
    $ref_table="users";
    $postRef = $database->getReference($ref_table)->push($postData);
    $postKey = $postRef->getKey();
}
if(isset($_POST['add-loc']))
{
    echo'hello singapore';
    $name=$_POST['name'];
    $loc=$_POST['location'];
    $state=$_POST['state'];
    $country=$_POST['country'];
   // $fileName = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $postData=
    [
        'name'=>$name,
        'location'=>$loc,
        'state'=>$state,
        'country'=>$country,
       // 'image'=>$fileName,

    ];

    $ref_table="location";
    $postRef = $database->getReference($ref_table)->push($postData);
    $postKey = $postRef->getKey();
}
?>
