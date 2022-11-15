    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php"><img class="rounded-circle" src="../img/Milesgone-logo.svg" height="70px">MilesGone</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <img class="rounded-circle" width="70px" height="70px"src="<?php if(isset($uresult['imgURI'])){ echo $uresult['imgURI']; }else{ echo "https://firebasestorage.googleapis.com/v0/b/ulakam-53ef0.appspot.com/o/user_images%2Fprofile.jpg?alt=media&token=01ea55fa-0b30-49fc-97d2-8e4673b86ef9"; }?>">
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php"><?php echo $bread; ?>  </a>
                        </li>

                    </ul>
                    <div class="d-flex">
                        <h3 class="me-2 text-dark"><?php echo $uresult['name']; ?></h3>
                    </div>
                </div>
            </div>
        </nav>
    </div>
