<?php
include '../inc/config.php';
$Query = mysqli_query($link,"SELECT * FROM testing ORDER BY id DESC");
$Row = mysqli_fetch_array($Query);
if($Row['status'] == 1){
	echo "Testing status: " . "<button type='button' class='btn btn-success btn-lg'>Testing</button>";
}else{
	echo "Testing status:" . " <button type='button' class='btn btn-warning btn-lg'>Not testing</button>";
}
?>