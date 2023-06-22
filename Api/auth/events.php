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

function createUser($userInput) {
	global $conn;

	$Ho = mysqli_real_escape_string($conn, $userInput['Ho']);
	$Ten = mysqli_real_escape_string($conn, $userInput['Ten']);
	$GioiTinh = "";
	$Email = mysqli_real_escape_string($conn, $userInput['Email']);
	$SDT = mysqli_real_escape_string($conn, $userInput['SDT']);
	$DiaChi = "";
	$TaiKhoan = mysqli_real_escape_string($conn, $userInput['TaiKhoan']);
	$MatKhau = mysqli_real_escape_string($conn, md5($userInput['MatKhau']));
	$MaQuyen = '1';
	$TrangThai = '1';

	if (empty(trim($Ho))) {
		return error422('Error Not Found "Ho"');
	} elseif (empty(trim($Ten))) {
		return error422('Error Not Found "Ten"');
	} elseif (empty(trim($Email))) {
		return error422('Error Not Found "Email"');
	} elseif (empty(trim($TaiKhoan))) {
		return error422('Error Not Found "TaiKhoan"');
	} elseif (empty(trim($MatKhau))) {
		return error422('Error Not Found "MatKhau"');
	} else {
		$query = "INSERT INTO nguoidung(Ho, Ten, GioiTinh, SDT, Email, DiaChi, TaiKhoan,MatKhau, MaQuyen, TrangThai) 
		VALUES ('$Ho', '$Ten', '$GioiTinh', '$SDT', '$Email', '$DiaChi', '$TaiKhoan', '$MatKhau', '$MaQuyen', '$TrangThai')";
		$result = mysqli_query($conn, $query);
		if ($result) {
			$data = [
				"status" => 201,
				"message" => "Create User Successfully",
			];
			header("HTTP/1.0 201 Created");
			return json_encode($data);
		} else {
			$data = [
				"status" => 500,
				"message" => "Internal Server Error",
			];
			header("HTTP/1.0 500 Internal Server Error");
			return json_encode($data);
		}
		
	}

}

function getUserList() {
	global $conn;

	$query = 'SELECT * FROM nguoidung';
	$query_run = mysqli_query($conn, $query);

	if ($query_run) {
		if (mysqli_num_rows($query_run) > 0) {

			$response = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
			$data = [
				"status" => 200,
				"message" => "User List Fetched Successfully",
				"data" => $response
			];
			header("HTTP/1.0 200 OK");
			return json_encode($data);
		} else {
			$data = [
				"status" => 404,
				"message" => "No User Found",
			];
			header("HTTP/1.0 404 No User Found");
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

function getUserDetails($userParams) {
	global $conn;

	if ($userParams['MaND'] == null) {
		return error422('Error Not Found "MaND"');
	}

	$userID = mysqli_real_escape_string($conn, $userParams['MaND']);
	$query = "SELECT * FROM nguoidung WHERE MaND = '$userID' LIMIT 1";
	$result = mysqli_query($conn, $query);

	if ($result) {
		if(mysqli_num_rows($result) == 1) {
			$res = mysqli_fetch_assoc($result);
			$data = [
				"status" => 200,
				"message" => "Fetched User Details Successfully",
				"data" => $res,
			];
			header("HTTP/1.0 200 OK");
			return json_encode($data);
		} else {
			$data = [
				"status" => 404,
				"message" => "No User Found",
			];
			header("HTTP/1.0 404 No User Found");
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

function updateUser($userInput, $userParams) {
	global $conn;

	if (!isset($userParams['MaND'])) {
		return error422("Error Not Found 'MaND' in URL");
	} elseif ($userParams['MaND'] == null ) {
		return error422("Error Not Found 'MaND' in URL");
	}

	$MaND = mysqli_real_escape_string($conn, $userParams['MaND']);

	$Ho = mysqli_real_escape_string($conn, $userInput['Ho']);
	$Ten = mysqli_real_escape_string($conn, $userInput['Ten']);
	$GioiTinh = mysqli_real_escape_string($conn, $userInput['GioiTinh']);
	$Email = mysqli_real_escape_string($conn, $userInput['Email']);
	$SDT = mysqli_real_escape_string($conn, $userInput['SDT']);
	$DiaChi = mysqli_real_escape_string($conn, $userInput['DiaChi']);

	if (empty(trim($Ho))) {
		return error422('Error Not Found "Ho"');
	} elseif (empty(trim($Ten))) {
		return error422('Error Not Found "Ten"');
	} elseif (empty(trim($Email))) {
		return error422('Error Not Found "Email"');
	} elseif (empty(trim($DiaChi))) {
		return error422('Error Not Found "DiaChi"');
	} else {
		$query = "UPDATE nguoidung SET Ho='$Ho', Ten='$Ten', GioiTinh='$GioiTinh', SDT='$SDT', Email='$Email', DiaChi='$DiaChi' WHERE MaND='$MaND' LIMIT 1";
		$result = mysqli_query($conn, $query);
		if ($result) {
			$data = [
				"status" => 200,
				"message" => "Update Successfully",
			];
			header("HTTP/1.0 200 Updated");
			return json_encode($data);
		} else {
			$data = [
				"status" => 500,
				"message" => "Internal Server Error",
			];
			header("HTTP/1.0 500 Internal Server Error");
			return json_encode($data);
		}
		
	}

}

function deleteUser($userParams) {
		global $conn;

	if (!isset($userParams['MaND'])) {
		return error422("Error Not Found 'MaND' in URL");
	} elseif ($userParams['MaND'] == null ) {
		return error422("Error Not Found 'MaND' in URL");
	}

	$MaND = mysqli_real_escape_string($conn, $userParams['MaND']);

	$query = "DELETE FROM nguoidung WHERE MaND = '$MaND' LIMIT 1";
	$result = mysqli_query($conn, $query);

	if ($result) {
		$data = [
			"status" => 200,
			"message" => "Delete User Successfully",
		];
		header("HTTP/1.0 200 User Deleted");
		return json_encode($data);
	} else {
		$data = [
			"status" => 404,
			"message" => "Error User Not Found",
		];
		header("HTTP/1.0 404 User Not Found");
		return json_encode($data);
	}
	
}

function loginAuth($userInput) {
	global $conn;

	$TaiKhoan = mysqli_real_escape_string($conn, $userInput['TaiKhoan']);
	$MatKhau = mysqli_real_escape_string($conn, md5($userInput['MatKhau']));

	if (empty(trim($TaiKhoan))) {
		return error422('Error Not Found "TaiKhoan"');
	} elseif (empty(trim($MatKhau))) {
		return error422('Error Not Found "MatKhau"');
	} else {
		$query = "SELECT * FROM nguoidung WHERE TaiKhoan = '$TaiKhoan' AND MatKhau = '$MatKhau' LIMIT 1";
		$result = mysqli_query($conn, $query);
		if ($result) {
			if(mysqli_num_rows($result) == 1) {
				$res = mysqli_fetch_assoc($result);
				$data = [
					"status" => 200,
					"message" => "Login Successfully",
					"dataUser" => $res,
				];
				header("HTTP/1.0 200 OK");
				return json_encode($data);
			} else {
				$data = [
					"status" => 404,
					"message" => "No User Found",
				];
				header("HTTP/1.0 404 No User Found");
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
}

?>