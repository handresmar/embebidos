<?php
include 'inc/config.php';

$result = mysqli_query($link,"SELECT * FROM tramas ORDER BY id DESC LIMIT 3");
$row 	= mysqli_fetch_array($result);
foreach($result as $row => $field){
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
echo "$lat y $lon y $sp y $mpu";
?>
