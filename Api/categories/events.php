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

function getCategoryList() {
	global $conn;

	$query = 'SELECT * FROM danhmuc';
	$query_run = mysqli_query($conn, $query);

	if ($query_run) {
		if (mysqli_num_rows($query_run) > 0) {

			$response = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
			$data = [
				"status" => 200,
				"message" => "Category List Fetched Successfully",
				"dataCategories" => $response
			];
			header("HTTP/1.0 200 OK");
			return json_encode($data);
		} else {
			$data = [
				"status" => 404,
				"message" => "No Category Found",
			];
			header("HTTP/1.0 404 No Category Found");
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

function getCategoryDetails($categoryParams) {
	global $conn;

	if ($categoryParams['MaDM'] == null) {
		return error422('Error Not Found "MaDM"');
	}

	$categoryID = mysqli_real_escape_string($conn, $categoryParams['MaDM']);
	$query = "SELECT * FROM danhmuc WHERE MaDM = '$categoryID' LIMIT 1";
	$result = mysqli_query($conn, $query);

	if ($result) {
		if(mysqli_num_rows($result) == 1) {
			$res = mysqli_fetch_assoc($result);
			$data = [
				"status" => 200,
				"message" => "Fetched Category Details Successfully",
				"dataCategory" => $res,
			];
			header("HTTP/1.0 200 OK");
			return json_encode($data);
		} else {
			$data = [
				"status" => 404,
				"message" => "No Category Found",
			];
			header("HTTP/1.0 404 No Category Found");
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