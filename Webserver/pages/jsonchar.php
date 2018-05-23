<?php
include '../inc/config.php';
header('Content-Type: application/json');

$con = $link;

// Check connection
if (mysqli_connect_errno($con))
{
    echo "Failed to connect to DataBase: " . mysqli_connect_error();
}else
{
    $data_points = array();
    
    $QueryTesting       =       mysqli_query($con,"SELECT * FROM gps ORDER BY id DESC");
    $RowTesting         =       mysqli_fetch_array($QueryTesting);
    if($RowTesting['status'] == '0'){
        $id_e = 10000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000;
    }
    else if($RowTesting['status'] == '1'){
        $id_e = $RowTesting['start_id'];
    }

    $result = mysqli_query($con, "SELECT * FROM gps ORDER BY id ASC");

    
    while($row = mysqli_fetch_array($result))
    {        
        $point = array("valorx" => $row['fecha'] , "valory" => $row['sp']);
        
        array_push($data_points, $point);        
    }
    
    echo json_encode($data_points, JSON_NUMERIC_CHECK);
}
mysqli_close($con);

?>
