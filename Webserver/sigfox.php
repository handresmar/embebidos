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


