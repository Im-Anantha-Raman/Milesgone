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
        <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
        <style>
            html,
            body {
                position: relative;
                height: 100%;
              }

            body {
                background: #eee;
                font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
                font-size: 14px;
                color: #121;
                margin: 0;
                padding: 0;
              }

            .swiper {
                width: 100%;
                height: 50vh;
              }

              .swiper-slide {
                text-align: center;
                font-size: 1.2vw;
                background: #fff;

                /* Center slide text vertically */
                display: -webkit-box;
                display: -ms-flexbox;
                display: -webkit-flex;
                display: flex;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                -webkit-justify-content: center;
                justify-content: center;
                -webkit-box-align: center;
                -ms-flex-align: center;
                -webkit-align-items: center;
                align-items: center;
              }
            .thumbnail img
            {
                position : relative;
                height:25vh;
                width:95%;
                border-radius:5%;
            }
            .thumbnail div
            {
                border: 1px solid black;
            }
            h4
            {
                font-size: 1.2vw;
                font-weight: bolder;
            }
        </style>
    </head>
    <body>
        <!-- Nav bar -->
        <?php
                include '../includes/header.php';
        ?>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
            <!-- Slides -->
            <?php
                include('../php-firebase/db_config.php');
                $table='location';
                $result = $database->getReference($table)->getvalue();
                if($result>0)
                {
                    foreach($result as $key=>$row)
                    {
                        ?>
                        <div class="swiper-slide m-1 p-1 card bg-warning">
                            <div class="thumbnail pt-1 text-center">
                                <img src="<?php echo $row['imgUri']?>" class="thumbnail img-responsive" alt="<?php echo $row['name']; ?>">
                                    <caption>
                                        <h4><?php echo $row['name']; ?></h4>
                                        <br>
                                        <p><?php echo $row['location']; ?></p>
                                    </caption>
                            </div>
                        </div>
                        <?php
                        }
                    }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 5,
        spaceBetween: 30,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
    </script>
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
