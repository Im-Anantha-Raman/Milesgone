<div class="navigation">
                <ul>
                    <li class="list <?php if($bread=="Home"){echo "active";} ?>">
                        <a href="../tourist/home.php">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="text">Home</span>
                        </a>
                    </li>
                    <li class="list <?php if($bread=="Trip"){echo "active";} ?>">
                        <a href="../tourist/trip.php">
                            <span class="icon">
                                <ion-icon name="person-outline"></ion-icon>
                            </span>
                            <span class="text">Profile</span>
                        </a>
                    </li>
                    <li class="list <?php if($bread=="Chat"){echo "active";} ?>">
                        <a href="../tourist/chat.php">
                            <span class="icon">
                                <ion-icon name="chatbox-outline"></ion-icon>
                            </span>
                            <span class="text">Message</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="#">
                            <span class="icon">
                                <ion-icon name="camera-outline"></ion-icon>
                            </span>
                            <span class="text">Photos</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="#">
                            <span class="icon">
                                <ion-icon name="settings-outline"></ion-icon>
                            </span>
                            <span class="text">Settings</span>
                        </a>
                    </li>
                    <div class="indicator">

                    </div>
                </ul>
            </div>
        <script>
            const list=document.querySelectorAll('.list');
            function activeLink()
            {
                list.forEach((item)=>
                item.classList.remove('active'));
                this.classList.add('active');
            }
            list.forEach((item)=>
            item.addEventListener('click',activeLink));
        </script>
