<?php
//Variables GET desde back-end
include 'inc/config.php';
$_id                    = $_GET["id"];
$_time                  = $_GET["time"];
$_snr                   = $_GET["snr"];
$_station               = $_GET["station"];
$_lat                   = $_GET["lat"];
$_lng                   = $_GET["lng"];
$_rssi                  = $_GET["rssi"];
$_data                  = $_GET["data1"];
$_seqNumber             = $_GET["seqNumber"];
$_date                  = date('Y-m-d H:i:s');
$_ack                   = $_GET["ack"];

if ( $_ack == "true" ) {
                header('Content-type:application/json;charset=utf-8');
                $message = "1100000000000000";
                $payload = array($_id=>array('downlinkData'=>$message));
                echo json_encode($payload);
   } 

//Mysql
$result     =   mysqli_query($link,"SELECT * FROM gps ORDER BY id DESC");
$row        =   mysqli_fetch_array($result);            
$id         =   ($row["id"]+1);
mysqli_query($link,"INSERT INTO tramas(id,trama,fecha) VALUES('$id','$_data','$_date')");

//Registrar cambios en un archivo
if ( $fl = fopen('/var/www/html/sigfox/Data.txt','a')) {
        fwrite($fl,"\"data\": { \"id\" : \"". $_id . "\", "
                             ."\"data\" :\"" . $_data . "\", "
                             ."\"from\" :\"" . $_station . "\", "
                             ."\"lat\" :\"" . $_lat . "\", "
                             ."\"lng\" :\"" . $_lng . "\" },"
                                                         ."\"time\" :\"" . $_time . "\" }\n");
       fclose($fl);
     }
  ?>


