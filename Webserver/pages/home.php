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
        zoom: 17,
        center: origin
      };
      map = new google.maps.Map(document.getElementById('map'), mapOptions);
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
    google.maps.event.addDomListener(window, "resize", function() {
 var center = map.getCenter();
 google.maps.event.trigger(map, "resize");
 map.setCenter(center); 
});
    </script>



<script src="backend/js/jquery.min.js" type="text/javascript"></script>
     <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
               <div id="status"></div>
            </header>
            <section class="panel">
                        <div class="panel-body"> 
                            <head>
	                    	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		                      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.js"></script>
		                      <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		                      <script type="text/javascript" language="javascript" src="js/dataTables.scroller.js"></script>
			    <script type="text/javascript" language="javascript" >
                            $(document).ready(function() {
                                var dataTable = $('#employee-grid').DataTable( {
                                    "processing": true,
                                    "serverSide": true,
                                    "searching": false,
                                    "columnDefs": [
                                    { className: "dt-body-center", "targets": [ 0 ] }
                                    ],
                                    "ajax":{
                                    url :"data.php", // json datasource
                                    type: "post",  // method  , by default get
                                    error: function(){  // error handling
                                        $(".employee-grid-error").html("");
                                        $("#employee-grid_processing").css("display","none");
                                    }
                                }
                            } );
                                setInterval( function () {
                                    dataTable.ajax.reload();
                                }, 10000 );
                            } );
                        </script>
                        <style>
                        div.container {
                            margin: 0 auto;
                            max-width:980px;
                        }
                        div.header {
                            margin: 100px auto;
                            line-height:30px;
                            max-width:980px;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="table-responsive"> 
                            <table id="employee-grid" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Latitud</th>
                                <th>Longitud</th>
                                <th>Velocidad (Km/h)</th>

                            </tr>
                        </thead>
                        </div>
                    </table>
                </div>

            </div>
        </div>
    </section>
</div>

<div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
               Mapa
            </header>
            <div class="panel-body">
		<div id="map" style="height: 400px;"></div>
            </div>
        </section>
</div>

    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
               Velocidad del vehiculo
            </header>
            <div class="panel-body"> 
                <div class="table-responsive">
                    <table class="display table table-bordered table-striped">
                    <!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
                var dataLength = 0;
                var data = [];
                var updateInterval = 500;
                updateChart();
                function updateChart() {
                    $.getJSON("pages/jsonchar.php", function (result) {
                        if (dataLength !== result.length) {
                            for (var i = dataLength; i < result.length; i++) {
                                data.push({
                                    label: (result[i].valorx),
                                    y: parseFloat(result[i].valory)
                                });
                            }
                            dataLength = result.length;
                            chart.render();

                        }
                    });
                }
                var chart = new CanvasJS.Chart("chart", {
                    zoomEnabled: true,
                    title: {
                        text: "Velocidad Km/h"
                    },
                    axisX: {
                        title: "chart updates every " + 60 + " secs"
                    },
                    axisY: {
                        title: "Velocidad",

                        suffix: "Km/h",

                    },
                    data: [{type: "line",
                            toolTipContent: "{label} : {y} Km/h",
                             lineColor: "red", 
                            dataPoints: data}],
                });
                setInterval(function () {
                    updateChart()
                }, updateInterval);

                //Chart 2

                var dataLength2 = 0;
                var data2 = [];
                var updateInterval2 = 500;
                updateChart2();
                function updateChart2() {
                    $.getJSON("pages/jsoncharoil.php", function (result2) {
                        if (dataLength2 !== result2.length) {
                            for (var i = dataLength2; i < result2.length; i++) {
                                data2.push({
                                    label: (result2[i].valorx),
                                    y: parseFloat(result2[i].valory)
                                });
                            }
                            dataLength2 = result2.length;
                            chart2.render();
                        }
                    });
                }
                var chart2 = new CanvasJS.Chart("chart2", {
                    zoomEnabled: true,
                    title: {
                        text: "Liquid Flow Rate"
                    },
                    axisX: {
                        title: "chart updates every " + 60 + " secs"
                    },
                    axisY: {
                        title: "Sm3/d",

                        suffix: " Sm3/d",

                    },
                    data: [{type: "line",
                             toolTipContent: "{label} : {y} Sm3/d",
                             lineColor: "red", 

                            dataPoints: data2}],
                });
                setInterval(function () {
                    updateChart2()
                }, updateInterval);

                //Chart 3

                var dataLength3 = 0;
                var data3 = [];
                var updateInterval3 = 500;
                updateChart3();
                function updateChart3() {
                    $.getJSON("pages/jsonchargvf.php", function (result3) {
                        if (dataLength3 !== result3.length) {
                            for (var i = dataLength3; i < result3.length; i++) {
                                data3.push({
                                    label: (result3[i].valorx),
                                    y: parseFloat(result3[i].valory)
                                });
                            }
                            dataLength3 = result3.length;
                            chart3.render();
                        }
                    });
                }
                var chart3 = new CanvasJS.Chart("chart3", {
                    zoomEnabled: true,
                    title: {
                        text: "GVF"
                    },
                    axisX: {
                        title: "chart updates every " + 60 + " secs"
                    },
                    axisY: {
                        title: "%",

                        suffix: " %",

                    },
                    data: [{type: "line",
                             toolTipContent: "{label} : {y} %",
                             lineColor: "red", 

                            dataPoints: data3}],
                });
                setInterval(function () {
                    updateChart3()
                }, updateInterval);

                //Chart 4

                var dataLength4 = 0;
                var data4 = [];
                var updateInterval4 = 500;
                updateChart4();
                function updateChart4() {
                    $.getJSON("pages/jsoncharpress.php", function (result4) {
                        if (dataLength4 !== result4.length) {
                            for (var i = dataLength4; i < result4.length; i++) {
                                data4.push({
                                    label: (result4[i].valorx),
                                    y: parseFloat(result4[i].valory)
                                });
                            }
                            dataLength4 = result4.length;
                            chart4.render();
                        }
                    });
                }
                var chart4 = new CanvasJS.Chart("chart4", {
                    zoomEnabled: true,
                    title: {
                        text: "Pressure"
                    },
                    axisX: {
                        title: "chart updates every " + 60 + " secs"
                    },
                    axisY: {
                        title: "kPa",

                        suffix: " kPa",

                    },
                    data: [{type: "line",
                             toolTipContent: "{label} : {y} kPa",
                             lineColor: "red", 

                            dataPoints: data4}],
                });
                setInterval(function () {
                    updateChart4()
                }, updateInterval);


}
</script>
</head>
<body>
<div id="chart" style="height: 350px; max-width: 920px; margin: 0px auto;""></div>
<script src="backend/js/canvasjs.min.js"></script>
</body>
</html>  



