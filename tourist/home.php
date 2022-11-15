<?php
session_start();
include('../php-firebase/db_config.php');
include('functions.php');
//Session and user
$bread="Home";
$email=$_SESSION['email'];
$user = $auth->getUserByEmail($email);
if(!$user->emailVerified)
{
    $auth->sendEmailVerificationLink($email);
    header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/verify.php");
    exit();
}
$utable='Users/'.$user->uid;
$uresult=$database->getReference($utable)->getvalue();
if(!isset($uresult['isGuide']))
{
    $_SESSION['email']=$email;
    header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/mode.php");
    exit();
}
$ultable='UserLocation/'.$user->uid;
$ulresult=$database->getReference($ultable)->getvalue();
if(isset($ulresult['latitude']))
{
    $lat=$ulresult['latitude'];
    $lng=$ulresult['longitude'];
}
// Location
$table='location';
$result = $database->getReference($table)->getvalue();
$ulqtable='UserLocation/';
$ulqresult=$database->getReference($ulqtable)->getvalue();
//

//Calc Distance;
 ?>
<!DOCTYPE html>
<html>
    <?php
        include('../includes/links.php');
    ?>
    <body>
        <!-- Nav bar -->
        <?php
                include '../includes/header.php';
        ?>
        <!-- Body -->
        <div class="container-fluid mx-auto mt-3" >
        <!----- Nearby Locations ------------------------------>
            <div class="mt-1 p-1 bg-light text-black text-center">
              <h3>Nearby Locations<span id='demo'></h3>
            </div>
            <div class="owl-carousel">
            <?php
                if($result>0)
                {
                    foreach($result as $key=>$row)
                    {
                        $id=$key;
                        ?>
                            <div class="item border border-1 border-secondary p-1 text-center">
                                <button type="button" class="btn btn-transparent" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $id; ?>">
                                    <img class="rounded" src="<?php echo $row['imgUri']; ?>" height="250px">
                                </button>
                                <div class="details">
                                    <h5 class="text-center fw-bolder "><?php echo $row['name'];?></h5><br>
                                    <h6 class="text-center fw-bold">
                                        <i class="bi bi-geo-alt-fill"> </i>
                                        <?php
                                            if(isset($lat)&isset($row['latitude']))
                                            {
                                                $dis= distance($lat,$lng,$row['latitude'],$row['longitude']);
                                                echo $dis;
                                            }
                                            else
                                            {
                                                echo 'NA';
                                            }
                                        ?>
                                    </h6>
                                </div>
                            </div>
                        <?php
                        }
                    }
                ?>
            </div>
            <!------------------Nearby People------------------------->
            <div class="mt-1 p-1 bg-light text-black text-center">
                <h3>Nearby Peoples</h3>
                <div id="text-hint"> </div>
            </div>
            <div class="owl-carousel">
            <?php
                if($ulqresult>0)
                {
                    foreach($ulqresult as $key=>$row)
                    {
                        $id=$row['id'];
                        $ttable='Users/'.$id;
                        $tresult=$database->getReference($ttable)->getvalue();
                        if($id!=$user->uid)
                        {
                        ?>
                            <div class="item border border-1 border-secondary p-1">
                                <div class="ccard">
                                    <div class="imgbx">
                                        <img src="<?php if(isset($tresult['imgURI'])){ echo $tresult['imgURI']; }else{ echo "https://firebasestorage.googleapis.com/v0/b/ulakam-53ef0.appspot.com/o/user_images%2Fprofile.jpg?alt=media&token=01ea55fa-0b30-49fc-97d2-8e4673b86ef9"; }?>">
                                    </div>
                                    <div class="content">
                                        <div class="details">
                                            <h2 class="text-uppercase"><?php if(isset($tresult['name'])){ echo $tresult['name']; }else{ echo 'NA'; }?></h2>
                                            <h5 class="text-center fw-bold">
                                                <i class="bi bi-geo-alt-fill"> </i>
                                                <?php
                                                    if(isset($lat)&isset($row['latitude']))
                                                    {
                                                        $dis= distance($lat,$lng,$row['latitude'],$row['longitude']);
                                                        echo $dis;
                                                    }
                                                    else
                                                    {
                                                        echo 'NA';
                                                    }
                                                ?>
                                            </h5>
                                            <div class="data">
                                                <?php
                                                    if(isset($tresult['isGuide']))
                                                    {
                                                        if($tresult['isGuide']==true)
                                                        {
                                                            ?>
                                                                <h3 id="g-icon"><i class="bi bi-shield-fill-check"> </i> Guide</h3>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                                <h3><br></h3>
                                                            <?php
                                                        }
                                                    }
                                                    $temp=$database->getReference('Friends/'.$user->uid .'/Lists/'.$id)->getSnapshot()->exists();
                                                    if($temp)
                                                    {
                                                            ?>
                                                                <h3 id="f-icon"><i class="bi bi-patch-check-fill"> </i> Friend</h3>
                                                            <?php
                                                    }
                                                 ?>
                                            </div>
                                            <?php
                                                $chk=$database->getReference('Friends/'.$user->uid .'/RequestsSent/'.$id)->getSnapshot()->exists();
                                                if(!$temp && !$chk)
                                                {
                                                    ?>
                                                        <div class="actionBtn text-center" id="add<?php echo $id; ?>">
                                                            <button onclick="showHint(this.id)" id="<?php echo $id; ?>"><i class="bi bi-person-plus-fill"> </i> Add Friend</button>
                                                        </div>
                                                        <br>
                                                        <div class="actionBtn text-center d-none" id="rq<?php echo $id?>">
                                                            <span class="text-light"><i class="bi bi-person-check-fill"> </i> Request Sent</span>
                                                        </div>
                                                    <?php
                                                }
                                                else
                                                {
                                                    if($chk)
                                                    {
                                                        ?>
                                                            <div class="actionBtn text-center">
                                                                <span class="text-light"><i class="bi bi-person-check-fill"> </i> Request Sent</span>
                                                            </div>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    }
                }
                ?>
            </div>

        </div>
        <?php
            include('../jsdesc.php');
            include('../includes/scripts.php');
        ?>

        <div class="mt-1 p-1 bg-light text-black text-center">
                <h3><hr></hr></h3>
        </div>
        <?php
            if($result>0)
            {
                    foreach($result as $key=>$row)
                    {
                        $id=$key;
                        ?>
                            <div class="modal" id="myModal<?php echo $id; ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">

                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h3 class="modal-title text-center"><?php echo $row['name']; ?></h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>

                                  <!-- Modal body -->
                                  <div class="modal-body text-center">
                                    <img class="rounded" src="<?php echo $row['imgUri']; ?>" height="250px"><br>
                                    <?php echo "Location: ".$row['location'].", ".$row['state'].", ".$row['country']; ?><br>
                                    <h3><?php echo "About";?><br></h3>
                                    <p>
                                        <?php echo $row['about']; ?>
                                    </p>
                                  </div>

                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                  </div>

                                </div>
                              </div>
                            </div>
                        <?php
                    }
            }
            include('../includes/footer.php');
        ?>

    </body>
</html>
