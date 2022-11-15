<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            function showHint(a) {
                var b="rq"+a;
                var c="add"+a;
                document.getElementById(b).classList.remove("d-none");
                document.getElementById(c).classList.add("d-none");
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("text-hint").innerHTML = this.responseText;
                  }
                };
                xmlhttp.open("GET", "action.php?id="+a+"&uid=<?php echo $user->uid; ?>&mode=addfriend", true);
                xmlhttp.send();
              }
        </script>
        <script type="text/javascript">
            $('.owl-carousel').owlCarousel({
                loop:false,
                margin:10,
                nav:false,
                indicator:false,
                responsive:{
                    0:{
                        items:1
                    },
                    550:{
                        items:2
                    },
                    800:{
                        items:3
                    },
                    1000:{
                        items:4
                    },
                    1500:{
                        items:5
                    }
                }
            })
        </script>
        <script src="../js/bootstrap.min.js"></script>
