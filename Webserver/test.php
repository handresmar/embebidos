<?php
include 'inc/config.php';

$result = mysqli_query($link,"SELECT * FROM tramas ORDER BY id DESC LIMIT 3");
$row 	= mysqli_fetch_array($result);
foreach($result as $row => $field){
	echo $field['tramas'];
	echo "<br>";
}
?>
