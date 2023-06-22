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

function getProductTypeList() {
	global $conn;

	$query = 'SELECT * FROM loaisanpham';
	$query_run = mysqli_query($conn, $query);

	if ($query_run) {
		if (mysqli_num_rows($query_run) > 0) {

			$response = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
			$data = [
				"status" => 200,
				"message" => "Product Type List Fetched Successfully",
				"data" => $response
			];
			header("HTTP/1.0 200 OK");
			return json_encode($data);
		} else {
			$data = [
				"status" => 404,
				"message" => "No Product Type  Found",
			];
			header("HTTP/1.0 404 No Product Type  Found");
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

function getProductTypeDetails($typeParams) {
	global $conn;

	if ($typeParams['MaLSP'] == null) {
		return error422('Error Not Found "MaLSP"');
	}

	$productTypeID = mysqli_real_escape_string($conn, $typeParams['MaLSP']);
	$query = "SELECT * FROM loaisanpham WHERE MaLSP = '$productTypeID' LIMIT 1";
	$query_run = mysqli_query($conn, $query);

	if ($query_run) {
		if (mysqli_num_rows($query_run) > 0) {

			$response = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
			$data = [
				"status" => 200,
				"message" => "Product Type List Fetched Successfully",
				"data" => $response
			];
			header("HTTP/1.0 200 OK");
			return json_encode($data);
		} else {
			$data = [
				"status" => 404,
				"message" => "No Product Type  Found",
			];
			header("HTTP/1.0 404 No Product Type  Found");
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

function getProductTypeByCategory($typeParams) {
	global $conn;

	if ($typeParams['MaDM'] == null) {
		return error422('Error Not Found "MaDM"');
	}

	$categoryID = mysqli_real_escape_string($conn, $typeParams['MaDM']);
	$query = "SELECT * FROM loaisanpham WHERE MaDM = '$categoryID'";
	$query_run = mysqli_query($conn, $query);

	if ($query_run) {
		if (mysqli_num_rows($query_run) > 0) {

			$response = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
			$data = [
				"status" => 200,
				"message" => "Product Type List Fetched Successfully",
				"data" => $response
			];
			header("HTTP/1.0 200 OK");
			return json_encode($data);
		} else {
			$data = [
				"status" => 404,
				"message" => "No Product Type  Found",
			];
			header("HTTP/1.0 404 No Product Type  Found");
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