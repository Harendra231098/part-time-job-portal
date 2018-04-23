<?php


session_start();

require_once("db.php");

//If user Actually clicked login button 
if(isset($_POST)) {

	//Escape Special Characters in String
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	//Encrypt Password
	$password = base64_encode(strrev(md5($password)));

	$sql = "SELECT id_company, companyname, email, active FROM company WHERE email='$email' AND password='$password'";
	$result = $conn->query($sql);


	if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {

			if($row['active'] == '2') {
				$_SESSION['companyLoginError'] = "Your Account Is Still Pending Approval.";
				header("Location: login-company.php");
				exit();
			} else if($row['active'] == '0') {
				$_SESSION['companyLoginError'] = "Your Account Is Rejected. Please Contact For More Info.";
				header("Location: login-company.php");
				exit();
			} else if($row['active'] == '1') {
				// active 1 means admin has approved account.
				
				$_SESSION['name'] = $row['companyname'];
				$_SESSION['id_company'] = $row['id_company'];

				
				header("Location: company/index.php");
				exit();
			} else if($row['active'] == '3') {
				$_SESSION['companyLoginError'] = "Your Account Is Deactivated. Contact Admin For Reactivation.";
				header("Location: login-company.php");
				exit();
			}
		}
 	} else {
 		//if no matching record found 
 		$_SESSION['loginError'] = $conn->error;
 		header("Location: login-company.php");
		exit();
 	}

 	
 	$conn->close();

} else {
	//redirect them back to login page if they didn't click login button
	header("Location: login-company.php");
	exit();
}