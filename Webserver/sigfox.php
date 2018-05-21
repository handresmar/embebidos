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

//Mysql
$result     =   mysqli_query($link,"SELECT * FROM tramas ORDER BY id DESC");
$row        =   mysqli_fetch_array($result);            
$id         =   ($row["id"]+1);
mysqli_query($link,"INSERT INTO tramas(id,tramas,fecha) VALUES('$id','$_data','$_date')");
//Data
if(strpos($_data,"46494e")!==false){
	$QueryData=mysqli_query($link,"SELECT * FROM tramas ORDER BY id DESC LIMIT 3");
	$RowData=mysqli_fetch_array($QueryData);
	foreach($QueryData as $RowData => $field){
		if(strpos($field['tramas'],"494e49")!==false){
                $trama1=str_replace("494e49","",$field['tramas']);
        	}
        	else if(strpos($field['tramas'],"46494e")!==false){
                $trama3=str_replace("46494e","",$field['tramas']);
        	}else{
                $trama2=$field['tramas'];
        	}
}
$mensaje = hex2bin($trama1 . $trama2 . $trama3);
list($lat,$lon,$sp,$mpu) = explode(';', $mensaje);
$result     =   mysqli_query($link,"SELECT * FROM gps ORDER BY id DESC");
$row        =   mysqli_fetch_array($result);
$id         =   ($row["id"]+1);
mysqli_query($link,"INSERT INTO gps(id,fecha,lat,lon,sp,mpu) VALUES ('$id','$_date','$lat','$lon','$sp','$mpu')");
}
