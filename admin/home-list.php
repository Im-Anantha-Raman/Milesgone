<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous" ></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/main.css" >
    </head>
    <body>
        <!-- Nav bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-project">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Ulakam</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Account Settings</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="row p-2">
                <div class="col-md-10 offset-md-2">
                    <div class="card">
                        <div class="card-header primary">
                            <h2>All Users</h2>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="table-responsive">
                                    <table class="table table-striped table-warning table-bordered">
                                        <thead>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include('../php-firebase/db_config.php');
                                                $table='users';
                                                $result = $database->getReference($table)->getvalue();
                                                if($result>0)
                                                {
                                                    foreach($result as $key=>$row)
                                                    {
                                                        echo '<tr>
                                                                <td>'.$row['username'].'</td>
                                                                <td>'.$row['email'].'</td>
                                                                <td>'.$row['password'].'</td>
                                                            </tr>';
                                                    }
                                                }
                                                else
                                                {
                                                    echo '<tr><td colspan="3">No user record found</td></tr>';
                                                }
                                             ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
