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

function getProductList() {
	global $conn;

	$query = 'SELECT * FROM sanpham';
	$query_run = mysqli_query($conn, $query);

	if ($query_run) {
		if (mysqli_num_rows($query_run) > 0) {

			$response = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
			$data = [
				"status" => 200,
				"message" => "Product List Fetched Successfully",
				"dataProducts" => $response
			];
			header("HTTP/1.0 200 OK");
			return json_encode($data, JSON_UNESCAPED_UNICODE );
		} else {
			$data = [
				"status" => 404,
				"message" => "No Product Found",
			];
			header("HTTP/1.0 404 No Product Found");
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

function getProductDetails($productParams) {
	global $conn;

	if ($productParams['MaSP'] == null) {
		return error422('Error Not Found "MaSP"');
	}

	$productID = mysqli_real_escape_string($conn, $productParams['MaSP']);
	$query = "SELECT * FROM sanpham WHERE MaSP = '$productID' LIMIT 1";
	$result = mysqli_query($conn, $query);

	if ($result) {
		if(mysqli_num_rows($result) == 1) {
			$res = mysqli_fetch_assoc($result);
			$data = [
				"status" => 200,
				"message" => "Fetched Product Details Successfully",
				"dataProducts" => $res,
			];
			header("HTTP/1.0 200 OK");
			return json_encode($data, JSON_UNESCAPED_UNICODE );
		} else {
			$data = [
				"status" => 404,
				"message" => "No Product Found",
			];
			header("HTTP/1.0 404 No Product Found");
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

function getProductByCategory($productParams) {
	global $conn;

	if ($productParams['MaDM'] == null) {
		return error422('Error Not Found "MaDM"');
	}

	$categoryID = mysqli_real_escape_string($conn, $productParams['MaDM']);
	$query = "SELECT * FROM sanpham WHERE MaDM = '$categoryID' ";
	$query_run = mysqli_query($conn, $query);

	if ($query_run) {
		if (mysqli_num_rows($query_run) > 0) {

			$response = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
			$data = [
				"status" => 200,
				"message" => "Product List Fetched Successfully",
				"dataProducts" => $response
			];
			header("HTTP/1.0 200 OK");
			return json_encode($data, JSON_UNESCAPED_UNICODE );
		} else {
			$data = [
				"status" => 404,
				"message" => "No Product Found",
			];
			header("HTTP/1.0 404 No Product Found");
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

function getProductByProductType($productParams) {
	global $conn;

	if ($productParams['MaLSP'] == null) {
		return error422('Error Not Found "MaLSP"'); 
	}

	if ($productParams['MaLSP'] == null) {
		return error422('Error Not Found "MaLSP"');
	}  

	$productTypeID = mysqli_real_escape_string($conn, $productParams['MaLSP']);
	$categoryID = mysqli_real_escape_string($conn, $productParams['MaDM']);
	$query = "SELECT * FROM sanpham WHERE MaDM = '$categoryID' AND MaLSP = '$productTypeID'";
	$query_run = mysqli_query($conn, $query);

	if ($query_run) {
		if (mysqli_num_rows($query_run) > 0) {

			$response = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
			$data = [
				"status" => 200,
				"message" => "Product List Fetched Successfully",
				"dataProducts" => $response
			];
			header("HTTP/1.0 200 OK");
			return json_encode($data, JSON_UNESCAPED_UNICODE );
		} else {
			$data = [
				"status" => 404,
				"message" => "No Product Found",
			];
			header("HTTP/1.0 404 No Product Found");
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