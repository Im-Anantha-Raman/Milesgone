<?php
    include('php-firebase/db_config.php');
    $table='UserLocation';
    $result1 = $database->getReference($table)->getvalue();
    $result2 = $database->getReference($table)->getvalue();
    $apikey="AIzaSyBumB-iWd2_IPyIcSlsmOSO6j0-O6wnHbQ";
?>
 <!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Map</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        #mapCanvas
        {
            width:100%;
            height:650px;
        }
    </style>
    <script>
    function initMap()
    {
        var map;
        var bounds= new google.maps.LatLngBounds();
        var mapOptions ={
            mapTypeId: 'roadmap'
        };
        map = new google.maps.Map(document.getElementById("mapCanvas"),mapOptions);
        map.setTilt(100);
        var markers = [
            <?php
                if($result1 > 0)
                {
                    foreach($result1 as $key=>$row)
                    {
                        echo '['.$row['latitude'].', '.$row['longitude'].'],';
                    }
            }
        ?>
        ];
        // Info window content
            var infoWindowContent = [
                <?php if($result2 > 0){
                    foreach($result1 as $key=>$row){ ?>
                        ['<div class="info_content">' +
                        '<h3><?php echo $row['id']; ?></h3>' +'</div>'],
                <?php }
                }
                ?>
            ];
        // Add multiple markers to map
        var infoWindow = new google.maps.InfoWindow(), marker, i;
        // Place each marker on the map
        for( i = 0; i < markers.length; i++ ) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
            });

            // Add info window to marker
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infoWindow.setContent(infoWindowContent[i][0]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));

            // Center the map to fit all markers on the screen
            map.fitBounds(bounds);
        }

        // Set zoom level
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(14);
            google.maps.event.removeListener(boundsListener);
        });
    }
    google.maps.event.addDomListener(window,'load',initMap);
    </script>
</head>
<body>
    <div id="mapContainer">
        <div id="mapCanvas">

        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $apikey; ?>&callback=initMap"></script>
</body>
</html>
