<?php

session_start();


require_once("db.php");

//If user clicked register button
if(isset($_POST)) {

	//Escape Special Characters In String First
	$companyname = mysqli_real_escape_string($conn, $_POST['companyname']);
	$contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
	$website = mysqli_real_escape_string($conn, $_POST['website']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$country = mysqli_real_escape_string($conn, $_POST['country']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$city = mysqli_real_escape_string($conn, $_POST['city']);

	$aboutme = mysqli_real_escape_string($conn, $_POST['aboutme']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);

	//Encrypt Password
	$password = base64_encode(strrev(md5($password)));

	
	$sql = "SELECT email FROM company WHERE email='$email'";
	$result = $conn->query($sql);

	//if email not found then we can insert new data
	if($result->num_rows == 0) {
		$uploadOk = true;

		//Folder where you want to save your image. 
		$folder_dir = "uploads/logo/";

		//Getting Basename of file. 
		$base = basename($_FILES['image']['name']); 

		//This will get us extension of your file. .
		$imageFileType = pathinfo($base, PATHINFO_EXTENSION); 

		//. . We are using this because no two files can be of same name as it will overwrite.
		$file = uniqid() . "." . $imageFileType; 
	  
		//This is where your files will be saved 
		$filename = $folder_dir .$file;  

		//We check if file is saved to our temp location or not.
		if(file_exists($_FILES['image']['tmp_name'])) { 

			if($imageFileType == "jpg" || $imageFileType == "png")  {

				//Next we need to check file size with our limit size.
				if($_FILES['image']['size'] < 500000) { 
					move_uploaded_file($_FILES["image"]["tmp_name"], $filename);

				} else {
					//Size Error
					$_SESSION['uploadError'] = "Wrong Size. Max Size Allowed : 5MB";
					$uploadOk = false;
				}
			} else {
				//Format Error
				$_SESSION['uploadError'] = "Wrong Format. Only jpg & png Allowed";
				$uploadOk = false;
			}
		} else {
				//File not copied to temp location error.
				$_SESSION['uploadError'] = "Something Went Wrong. File Not Uploaded. Try Again.";
				$uploadOk = false;
			}

		//If there is any error then redirect back.
		if($uploadOk == false) {
			header("Location: register-company.php");
			exit();
		}

	
		$sql = "INSERT INTO company(name, companyname, country, state, city, contactno, website, email, password, aboutme, logo) VALUES ('$name', '$companyname', '$country', '$state', '$city', '$contactno', '$website', '$email', '$password', '$aboutme', '$file')";

		if($conn->query($sql)===TRUE) {

			
			$_SESSION['registerCompleted'] = true;
			header("Location: login-company.php");
			exit();

		} else {
			
			echo "Error " . $sql . "<br>" . $conn->error;
		}
	} else {
		//if email found in database then show email already exists error.
		$_SESSION['registerError'] = true;
		header("Location: register-company.php");
		exit();
	}

	
	$conn->close();

} else {
	
	header("Location: register-company.php");
	exit();
}