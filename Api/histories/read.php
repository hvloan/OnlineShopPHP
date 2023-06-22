<?php 

ob_start();

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('events.php');

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == 'GET') {
	if (isset($_GET['MaND'])) {
		$allHistoryCart = getAllHistoryCart($_GET);
		echo $allHistoryCart;
	} else {
	}
} else {
	$data = [
		"status" => 405,
		"message" => $requestMethod. " Method Not Allowed",
	];
	header("HTTP/1.0 405 Method Not Allowed");
	echo json_encode($data);
}

ob_end_flush();


?>