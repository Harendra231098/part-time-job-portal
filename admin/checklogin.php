<?php

session_start();


require_once("../db.php");

//If user Actually clicked login button 
if(isset($_POST)) {

	//Escape Special Characters in String
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
	$result = $conn->query($sql);

	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			
		
			$_SESSION['id_admin'] = $row['id_admin'];
			header("Location: dashboard.php");
			exit();
		}
 	} else {
 		$_SESSION['loginError'] = true;
 		header("Location: index.php");
		exit();
 	}

 	$conn->close();

} else {
	header("Location: index.php");
	exit();
}