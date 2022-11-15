<?php
session_start();
include('php-firebase/db_config.php');
if(isset($_POST['sign-up']))
{
    $userProperties = [
        'email' => $_POST['email'],
        'emailVerified' => false,
        'password' => $_POST['password'],
        'displayName' => $_POST['name'],
    ];
    $createdUser = $auth->createUser($userProperties);
    if($createdUser)
    {
       $database->getReference('Users/'.$createdUser->uid)->set([
       'email' => $_POST['email'],
       'id' => $createdUser->uid,
       'imgURI' => NULL,
       'isGuide' => NULL,
       'name' =>  $_POST['name']
      ]);
    }
    else
    {
        $_SESSION['msg']="Account Creation Unsuccessfull";
    }
}
if(isset($_POST['sign-in']))
{
    $signInResult = $auth->signInWithEmailAndPassword($_POST['email'], $_POST['password']);
    if($signInResult)
    {
        $_SESSION['email']=$_POST['email'];
        header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/tourist/home.php");
        exit();
    }
    else
    {
        ?>
            <script>
                alert("not successfull");
            </script>
        <?php
    }
}
if(isset($_SESSION['msg']))
{
    echo '<script>
            var a='.json_encode($_SESSION['msg']).'
            alert(a);
        </script>';
    unset($_SESSION['msg']);
}
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Sign in & Sign up Form</title>
  </head>
  <body style="min-width: 350px;">
    <div class="container shadow-lg p-3 mb-5 bg-body rounded">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" method="post"class="sign-in-form">
            <img class="rounded-circle" src="img/Milesgone-logo.svg" height="20%">
            <h2 class="title mb-1 pb-1">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" required/>
            </div>
            <input type="submit" name="sign-in" value="Sign in" class="btn btn-primary btn-outline-light rounded"  style="background-image: linear-gradient(-45deg, #404040 0%, #000100 100%);"/>
          </form>
          <form action="" method="post"class="sign-up-form">
            <img class="rounded-circle" src="img/Milesgone-logo.svg" height="10%">
            <h2 class="title mb-1 pb-1">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="name" placeholder="Name" name="name" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Confirm Password" name="confirm_password" required/>
            </div>
            <input type="submit" class="btn btn-primary btn-outline-light" name="sign-up" value="Sign up" style="background-image: linear-gradient(-45deg, #404040 0%, #000100 100%);"/>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel align-center">
          <div class="content">
            <h3>New here ?</h3>
            <button class="btn transparent text-light" id="sign-up-btn">
              Sign up
            </button>
          </div>
        </div>
        <div class="panel right-panel align-center">
          <div class="content text-center">
            <h3>One of us ?</h3>
            <button class="btn transparent text-light" id="sign-in-btn">
              Sign in
            </button>
        </div>
    </div>
    <script src="app.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
