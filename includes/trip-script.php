<style>
            #myMap
            {
                height:400px;
            }
        </style>
        <script>
            var userid ='<?php echo $user->uid; ?>';
            var userlat='<?php echo $lat; ?>';
            var userlng='<?php echo $lng; ?>';
            var length=1;
            var sloc=55;
            var dummy=90;
            var marker,map,mid,smarker;
            var markers=[];
            var order=[];
            var lname=[];
            lname[0]="Starting Location";
            function getDistanceBetweenPoints(lat1, lng1, lat2, lng2){
                // The radius of the planet earth in meters
                let R = 6378.137;
                let dLat = degreesToRadians(lat2 - lat1);
                let dLong = degreesToRadians(lng2 - lng1);
                let a = Math.sin(dLat / 2)
                        *
                        Math.sin(dLat / 2)
                        +
                        Math.cos(degreesToRadians(lat1))
                        *
                        Math.cos(degreesToRadians(lat1))
                        *
                        Math.sin(dLong / 2)
                        *
                        Math.sin(dLong / 2);

                let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                let distance = R * c;

                return distance;
            }
            function mapCurrent()
            {
                var mapProp= {
                  center:new google.maps.LatLng(<?php if(isset($lat)){echo $lat.','.$lng;} ?>),
                  zoom:8,
                };
                map = new google.maps.Map(document.getElementById("myMap"),mapProp);
                marker = new google.maps.Marker({id:userid , position: new google.maps.LatLng(<?php if(isset($lat)){echo $lat.','.$lng;} ?>)});
                smarker = marker;
                markers[userid]=marker;
                marker.setMap(map);
                var t= document.getElementById("start");
                t.classList.add("d-none");

                //sloc =[ <?php if(isset($lat)){echo $lat;} ?>,<?php if(isset($lat)){echo $lng;} ?>];
            }
            function displayStart()
            {
               // document.getElementById('')
            }
            function displayNext()
            {
              var x = document.getElementById('part1');
              x.classList.add('d-none');
              document.getElementById('part2').classList.remove('d-none');
            }
            function addLoc(a)
            {
                var id=a.replace("add-btn-","");
                var rid="remove-btn-"+id;
                document.getElementById(rid).classList.remove('d-none');
                document.getElementById(a).classList.add('d-none');
                var lat= document.getElementById("lat-"+id).value;
                var lng= document.getElementById("lng-"+id).value;
                var position = new google.maps.LatLng(lat,lng);
                marker = new google.maps.Marker({
                id: id,
                position: position,
                map: map
                });
                mid = marker.id;
                markers[mid]=marker;
                let txt="";
                length+=1;
                for(let x in markers)
                {
                    txt+="<br>"+typeof x;
                    for(let y in x)
                    {
                        txt+=x[y]+" ";
                    }
                }
                //document.getElementById('demo').innerHTML=txt;
            }
            function removeLoc(a)
            {
                var id=a.replace("remove-btn-","");
                var aid="add-btn-"+id;
                document.getElementById(aid).classList.remove('d-none');
                document.getElementById(a).classList.add('d-none');
                marker=markers[id];
                marker.setMap(null);
                delete markers[id];
                let txt="";
                for(let x in markers)
                {
                    txt+="<br>";
                    for(let y in x)
                    {
                        txt+=x[y];
                    }
                }
                length-=1;
                //document.getElementById('demo').innerHTML=length;
            }
            function mapSearch()
            {
                var address=document.getElementById('sloc').value;
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == 'OK') {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();
                    alert("hello");
                    }
                else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
                var mapProp= {
                  center:new google.maps.LatLng(0,0),
                  zoom:8,
                };
                map = new google.maps.Map(document.getElementById("myMap"),mapProp);
                marker = new google.maps.Marker({position: new google.maps.LatLng(0,0)});
                marker.setMap(map);
                });
            }
            function degreesToRadians(degrees){
                return degrees * Math.PI / 180;
            }
            function calcRoute()
            {
                order[0]=userid;
                var tmarkers=markers;
                delete tmarkers[userid];
                for(let i=1; i<length; i++)
                {
                    var temp=order[i-1],tv;
                    var sd=15000.99,lat1,lat2,lng1,lng2;
                    if(i==1)
                    {
                        lat1=userlat;
                        lng1=userlng;
                        //document.getElementById('demo').innerHTML+="lat: "+lat1+"lng: "+lng1;
                    }
                    else
                    {
                        lat1=document.getElementById('lat-'+order[i-1]).value;
                        lng1=document.getElementById('lng-'+order[i-1]).value;
                        //document.getElementById('demo').innerHTML+="lat: "+lat1+"lng: "+lng1;
                    }
                    if(i!=length-1)
                    {
                        for(x in tmarkers)
                        {
                            lat2=document.getElementById('lat-'+x).value;
                            lng2=document.getElementById('lng-'+x).value;
                           // document.getElementById('demo').innerHTML+="lat: "+lat2+"lng: "+lng2;
                            let tsd = getDistanceBetweenPoints(lat1, lng1, lat2, lng2);
                          //  document.getElementById('demo').innerHTML+=tsd+"<br>";
                            if(tsd<sd)
                            {
                                sd=tsd;
                                tv=x;
                            }
                        }

                    }
                    else
                    {
                        for(x in tmarkers)
                        {
                            tv=x;
                        }
                    }
                    order[i]=tv;
                    delete tmarkers[tv];
                }
                storeName();
            }
            function storeName()
            {
                for(let i=1; i<length; i++)
                {
                    lname[i]=document.getElementById("name-"+order[i]).value;
                }
                updateMap()
            }
            function updateMap()
            {
                var mapProp= {
                  center:new google.maps.LatLng(<?php if(isset($lat)){echo $lat.','.$lng;} ?>),
                  zoom:8,
                };
                map = new google.maps.Map(document.getElementById("myMap"),mapProp);
                marker = new google.maps.Marker({ label: ""+0, position: new google.maps.LatLng(<?php if(isset($lat)){echo $lat.','.$lng;} ?>)});
                marker.setMap(map);
                for(let i=1; i<length; i++)
                {
                    let lat = document.getElementById('lat-'+order[i]).value;
                    let lng = document.getElementById('lng-'+order[i]).value;
                    marker = new google.maps.Marker({ label: ""+i, map:map, position: new google.maps.LatLng(lat,lng)});
                }
                drawLine();
            }
            function drawLine()
            {
                var flightPlanCoordinates = [
                    { lat: Number(userlat), lng: Number(userlng) },
                  ];
                for(let i=1;i<length;i++)
                {
                    var a={};
                    a.lat = Number(document.getElementById('lat-'+order[i]).value);
                    a.lng = Number(document.getElementById('lng-'+order[i]).value);
                    flightPlanCoordinates.push(a);
                }
                const flightPath = new google.maps.Polyline({
                    path: flightPlanCoordinates,
                    geodesic: true,
                    strokeColor: "#ff0000",
                    strokeOpacity: 1.0,
                    strokeWeight: 2,
                  });
                flightPath.setMap(map);
                var x = document.getElementById('part2');
                x.classList.add('d-none');
                document.getElementById('part3').classList.remove('d-none');
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBumB-iWd2_IPyIcSlsmOSO6j0-O6wnHbQ&callback=myMap"></script>
