<?php 

    $severname ="localhost"; 
    $username ="id20756285_root";
    $password ="HVLoan@25072001"; 
    $db_name ="id20756285_shopphone";
 
	$conn = mysqli_connect($severname,$username,$password,$db_name);

    if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

?>