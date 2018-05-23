<?php
        $locations=array(); 
        $uname="root";
        $pass="jesus00**";
        $servername="localhost";
        $dbname="gps";
        $db=new mysqli($servername,$uname,$pass,$dbname);
        $query =  $db->query("SELECT * FROM gps");
        //$number_of_rows = mysql_num_rows($db);  
        //echo $number_of_rows;
        while( $row = $query->fetch_assoc() ){
            $fecha = $row['fecha'];
            $longitude = $row['lon'];
            $latitude = $row['lat'];
            $sp=$row['sp'];
            /* Each row is added as a new array */
            $locations[]=array( 'fecha'=>$fecha, 'lat'=>$latitude, 'lng'=>$longitude, 'sp'=>$sp );
        }
        //echo $locations[0]['name'].": In stock: ".$locations[0]['lat'].", sold: ".$locations[0]['lng'].".<br>";
        //echo $locations[1]['name'].": In stock: ".$locations[1]['lat'].", sold: ".$locations[1]['lng'].".<br>";
    ?>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDBwtTOpYTTy9xMiSVTzpTMpLog24GR3rs"></script> 
    <script type="text/javascript">
    var map;
    var Markers = {};
    var infowindow;
    var locations = [
        <?php for($i=0;$i<sizeof($locations);$i++){ $j=$i+1;?>
        [
	    'd',
            '<p>Fecha: <?php echo $locations[$i][fecha]; ?><br>Velocidad: <?php echo $locations[$i][sp]?> Km/h</p>',
            <?php echo $locations[$i]['lat'];?>,
            <?php echo $locations[$i]['lng'];?>,
            0
        ]<?php if($j!=sizeof($locations))echo ","; }?>
    ];
    var origin = new google.maps.LatLng(locations[0][2], locations[0][3]);
    function initialize() {
      var mapOptions = {
        zoom: 15,
        center: origin
      };
      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        infowindow = new google.maps.InfoWindow();
        for(i=0; i<locations.length; i++) {
            var position = new google.maps.LatLng(locations[i][2], locations[i][3]);
            var marker = new google.maps.Marker({
                position: position,
                map: map,
		icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='+i+'|FE6256|000000'
            });
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][1]);
                    infowindow.setOptions({maxWidth: 200});
                    infowindow.open(map, marker);
                }
            }) (marker, i));
            Markers[locations[i][4]] = marker;
        }
        locate(0);
    }
    function locate(marker_id) {
        var myMarker = Markers[marker_id];
        var markerPosition = myMarker.getPosition();
        map.setCenter(markerPosition);
        google.maps.event.trigger(myMarker, 'click');
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <body id="map-canvas">
