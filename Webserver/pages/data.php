<?php
/* Database connection start */
require('../inc/config.php');

$conn = $link;

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'Date',
	1 => 'Hour',
	1 =>'LiquidFlow', 
	2 => 'OilFlow',
	3 => 'GasFlow',
	4 => 'WC',
	5 => 'GVF',
	6 => 'TMP',
	7 => 'Pressure'

);

// getting total number records without any search
$sql = "SELECT OFR as LiquidFlow, OFR as OilFlow, GFR as GasFlow, WCUT as WC, GVF, TMP, PRE as Pressure ";
$sql.=" FROM minutedata";
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT Datex, hour, OFR as LiquidFlow, OFR as OilFlow, GFR as GasFlow, WCUT as WC, GVF, TMP, PRE as Pressure ";
	$sql.=" FROM minutedata";
	$sql.=" WHERE LiquidFlow LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR OilFlow LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR GasFlow LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR WC LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR GVF LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR TMP LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR Pressure LIKE '".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees"); // again run query with limit
	
} else {	

	$sql = "SELECT Datex, hour, OFR as LiquidFlow, OFR as OilFlow, GFR as GasFlow, WCUT as WC, GVF, TMP, PRE as Pressure  ";
	$sql.=" FROM minutedata";
	$sql.=" ORDER BY id DESC LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["Datex"];
	$nestedData[] = $row["hour"];
	$nestedData[] = $row["LiquidFlow"];
	$nestedData[] = $row["OilFlow"];
	$nestedData[] = $row["GasFlow"];
	$nestedData[] = $row["WC"];
	$nestedData[] = $row["GVF"];
	$nestedData[] = $row["TMP"];
	$nestedData[] = $row["Pressure"];
	
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
