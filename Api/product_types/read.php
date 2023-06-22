<?php 

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('events.php');

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == 'GET') {
	if (isset($_GET['MaDM'])) {
		$productTypeByproduct = getProductTypeByCategory($_GET);
		echo $productTypeByproduct;
	} elseif (isset($_GET['MaLSP'])) {
		$productTypeDetails = getProductTypeDetails($_GET);
		echo $productTypeDetails;
	} else {
		$productTypeList = getProductTypeList();
		echo $productTypeList;
	}
} else {
	$data = [
		"status" => 405,
		"message" => $requestMethod. " Method Not Allowed",
	];
	header("HTTP/1.0 405 Method Not Allowed");
	echo json_encode($data);
}


?>