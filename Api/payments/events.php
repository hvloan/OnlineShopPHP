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

function createBill($billInput) {
	global $conn;

	$MaND = mysqli_real_escape_string($conn, $billInput['MaND']);
	$NguoiNhan = mysqli_real_escape_string($conn, $billInput['NguoiNhan']);
	$SDT = mysqli_real_escape_string($conn, $billInput['SDT']);
	$DiaChi = mysqli_real_escape_string($conn, $billInput['DiaChi']);
	$PhuongThucTT = "";
	$TongTien = mysqli_real_escape_string($conn, $billInput['TongTien']); 
	$TrangThai = '0';

	$SanPham = $billInput['SanPham']; 

	if (empty(trim($MaND))) {
		return error422('Error Not Found "MaND"');
	} elseif (empty(trim($NguoiNhan))) {
		return error422('Error Not Found "NguoiNhan"');
	} elseif (empty(trim($DiaChi))) {
		return error422('Error Not Found "DiaChi"');
	} elseif (empty(trim($TongTien))) {
		return error422('Error Not Found "TongTien"');
	} else {

		$query = "INSERT INTO hoadon(MaND, NguoiNhan, SDT, DiaChi, PhuongThucTT, TongTien, TrangThai) 
		VALUES ('$MaND', '$NguoiNhan', '$SDT', '$DiaChi', '$PhuongThucTT', '$TongTien', '$TrangThai')";
    
	    $status = mysqli_query($conn, $query);

	    $query_mahd = "select MaHD from hoadon ORDER BY NgayLap DESC LIMIT 1";
		$result_mahd = mysqli_query($conn, $query_mahd);
		$data_mahd = mysqli_fetch_assoc($result_mahd);

		if (is_object($SanPham)) {
		    foreach ($SanPham as $property => $value) {
		        $MaSP =$value['MaSP'];
		        $SoLuong = $value['SoLuong'];
		        $DonGia = $value['DonGia'];
		        $MaHD = $data_mahd['MaHD'];
		        $query_ct = "INSERT INTO chitiethoadon(MaHD,MaSP,SoLuong,DonGia) VALUES ($MaHD,$MaSP,$SoLuong,$DonGia)";

		        $status_ct = mysqli_query($conn, $query_ct);
		    }
		    if ($status == true and $status_ct == true) {
			    $data = [
					"status" => 201,
					"message" => "Create Bill Successfully",
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
		} elseif (is_array($SanPham)) {
		    foreach ($SanPham as $property => $value) {
		        $MaSP =$value['MaSP'];
		        $SoLuong = $value['SoLuong'];
		        $DonGia = $value['DonGia'];
		        $MaHD = $data_mahd['MaHD'];
		        $query_ct = "INSERT INTO chitiethoadon(MaHD,MaSP,SoLuong,DonGia) VALUES ($MaHD,$MaSP,$SoLuong,$DonGia)";

		        $status_ct = mysqli_query($conn, $query_ct);
		    }
		    if ($status == true and $status_ct == true) {
			    $data = [
					"status" => 201,
					"message" => "Create Bill Successfully",
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



?>