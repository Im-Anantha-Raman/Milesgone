<?php
session_start();
include('../php-firebase/db_config.php');
$email=$_SESSION['email'];
$user = $auth->getUserByEmail($email);
if(isset($_POST['mode-submit']))
{
    $mode=$_POST['mode'];
    $utable='Users/'.$user->uid .'/isGuide';
    if($mode=="Guide")
    {
        $uresult=$database->getReference($utable)->set(true);
    }
    else
    {
        $uresult=$database->getReference($utable)->set(false);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>|Mode</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous" ></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body>
        <!-- Nav bar -->
        <?php
            include('../includes/header.php')
        ?>
        <!-- Body -->
        <div class="container-fluid mx-auto mt-3" >
            <div class="mt-1 p-1 bg-light text-black text-center">
              <h3>Select a Mode</h3>
            </div>
            <form action="" method="post">
                <div class="row m-2 justify-content-center">
                    <div class="col-md-4 border border-1 btn" id="Guide" onClick="disp(this.id)">
                        <h4>Guide Mode</h4>
                        <img class="img-fluid" src="https://www.orioly.com/wp-content/uploads/2016/12/qualities-of-a-good-tour-guide-cover-illustration.png">
                    </div>
                    <div class="col-md-4 border border-1 btn" id="Tourist" onClick="disp(this.id)">
                        <h4>Tourist Mode</h4>
                        <img class="img-fluid" src="https://media.istockphoto.com/vectors/man-looking-faraway-through-binoculars-vector-id1291580055?k=20&m=1291580055&s=612x612&w=0&h=TYHch2KrX_Dmqs6e7MdNtF0k-XwTW7_cb33fQmr1GYs=">
                    </div>
                    <div class="col-md-8 border border-1">
                        <div class="mt-1 p-1 bg-light text-black text-center" id="demo">
                        </div>
                        <input type="hidden" name="mode" value="" id="mode"/>
                    </div>
                    <div class="col-md-8 border border-1 justify-content-center text-center" id="button" style="display:none;">
                        <button type="submit" name="mode-submit" class="btn bg-dark text-light m-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
        <script type="text/javascript">
            function disp(a)
            {
                document.getElementById('button').style.display='block';
                document.getElementById('demo').innerHTML="<h3>"+a+" Mode</h3>";
                document.getElementById('mode').value=a;
            }
        </script>
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
