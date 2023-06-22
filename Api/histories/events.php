<?php 

require '../constants/connection.php';

function error422($massage) {
	$data = [
		"status" => 422,
		"message" => $massage,
	];
	header("HTTP/1.0 422 Unprocessable Entity");
	echo json_encode($data);
	exit();
}

function getAllHistoryCart($userParams) {
	global $conn;
	
	if ($userParams['MaND'] == null) {
		return error422('Error Not Found "MaND"');
	}

	$maND = mysqli_real_escape_string($conn, $userParams['MaND']);

	$query = "select hd.* from hoadon as hd, sanpham as sp, chitiethoadon as ct where hd.MaND = '$maND' and hd.MaHD = ct.MaHD and ct.MaSP = sp.MaSP group by hd.MaHD";
	$query_run = mysqli_query($conn, $query);

	if ($query_run) {
		if (mysqli_num_rows($query_run) > 0) {

			$response = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
			$data = [
				"status" => 200,
				"message" => "Histories List Fetched Successfully",
				"data" => $response
			];
			header("HTTP/1.0 200 OK");
			return json_encode($data);
		} else {
			$data = [
				"status" => 404,
				"message" => "Not Found",
			];
			header("HTTP/1.0 404 Not Found");
			return json_encode($data);
		}
		
	} else {

		$data = [
			"status" => 500,
			"message" => "Internal Server Error",
		];
		header("HTTP/1.0 500 Internal Server Error");
		return json_encode($data);
	}
	
}


?>

