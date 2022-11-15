<?php
session_start();
include('../php-firebase/db_config.php');
include('functions.php');
//Session and user
$bread="Trip";
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
            <div class="row m-2 justify-content-center">
                <div class="col-md-10 m-2 text-center border border-3">
                    <div class="mt-1 p-1 bg-light text-dark rounded text-center" >
                      <h2 id="start">Select Starting Location<span id="demo"></span></h2>
                    </div>
                </div>
                <div class="col-md-10 m-2 text-center border border-3" id="myMap">
                </div>
                <div class="col-md-4 m-2 text-center border border-3 d-flex part-1 d-none">
                    <div class="input-group m-1 d-flex">
                        <input type="text" class="form-control" placeholder="" aria-label="Search" aria-describedby="basic-addon1" id="sloc">
                        <br>
                        <button class="btn bg-dark text-light" onclick="mapSearch()">Search</button>
                    </div>
                </div>
                <div class="col-md-1 m-1 text-center border border-3 text-center d-none">
                    <div class="mt-1 p-1 bg-white text-dark rounded text-center">
                      <h4>OR</h4>
                    </div>
                </div>
                <div id='part1' class="row justify-content-center text-center align-center">
                <div class="col-md-6 m-2 text-center border border-3 justify-content-center d-flex part-1">
                    <button class="btn btn-transparent" onclick="mapCurrent()"><img src="../img/currentlocation.png" height="20px" class="d-inline"><h6 class="d-inline">  Set Current Location as Starting Location</h6></button>
                </div>
                <div class="col-md-8 m-2 text-center border border-3 part-1">
                    <button class="btn bg-dark text-light" onclick="displayNext()">Next</button>
                </div>
                </div>
                <div id='part2' class="row justify-content-center text-center align-center d-none">
                    <div class="mt-1 p-1 bg-light text-black text-center">
                          <h3>Add Destinations</h3>
                    </div>
                    <div class="col-md-12 mb-1 text-center border border-3 justify-content-center d-flex part-1">
                        <div class="owl-carousel">
                        <?php
                            if($result>0)
                            {
                                foreach($result as $key=>$row)
                                {
                                    $id=$key;
                                    ?>
                                        <div class="item border border-1 border-secondary p-1">
                                            <button type="button" class="btn btn-transparent" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $id; ?>">
                                                <img class="rounded" src="<?php echo $row['imgUri']; ?>" height="250px">
                                            </button>
                                            <div class="details">
                                                <h5 class="text-center fw-bolder "><?php echo $row['name'];?></h5><br>
                                            </div>
                                            <div class="action">
                                                <input type="hidden" id="name<?php echo $id; ?>" value="<?php echo $row['name']; ?>">
                                                <input type="hidden" id="lat<?php echo $id; ?>" value="<?php echo $row['latitude']; ?>">
                                                <input type="hidden" id="lng<?php echo $id; ?>" value="<?php echo $row['longitude']; ?>">
                                                <Button class="btn btn-success" id="add-btn<?php echo $id; ?>"  onclick="addLoc(this.id)"><i class="bi bi-plus-circle"></i> ADD</Button>
                                                <Button class="btn btn-danger d-none" id="remove-btn<?php echo $id; ?>" onclick="removeLoc(this.id)"><i class="bi bi-x-circle"></i> REMOVE</Button>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-8 m-2 text-center border border-3 part-1">
                        <button class="btn bg-dark text-light" onclick="calcRoute()">Find Best Route</button>
                    </div>
                </div>
                <div id='part3' class="row justify-content-center text-center align-center d-none">
                    <div class="mt-1 p-1 bg-light text-black text-center">
                          <h3>Add Details</h3>
                    </div>
                    <div class="row m-1 text-center border border-3 justify-content-center align-center">
                        <form class=" col-md-6 text-center border border-3 justify-content-center align-center">
                            <div class="form-group m-1 p-1">
                                <h5><label for="t-name" class="form-label">Trip Name</label></h5>
                                <input type="text" class="form-control text-center" placeholder="Enter Trip Name" id="t-name" required>
                            </div>
                            <div class="form-group m-1 p-1">
                                <h5><label for="t-date" class="form-label">Starting Date</label></h5>
                                <input type="date" class="form-control text-center" placeholder="Enter Trip Name" id="t-date" required>
                            </div>
                            <div class="form-group m-1 p-1">
                                <h5>Trip Type</h5><hr>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="public">
                                  <h6><label class="form-check-label" for="inlineRadio1">Public Trip</label></h6>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="private">
                                  <h6><label class="form-check-label" for="inlineRadio2">Private Trip</label></h6>
                                </div>
                            </div>
                            <div class="form-group m-1 p-1">
                                <button class="btn bg-dark text-light" onclick="submit()">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include('../jsdesc.php');
            include('../includes/scripts.php');
            include('../includes/trip-script.php');
            include('../includes/footer.php');
        ?>

    </body>
</html>
