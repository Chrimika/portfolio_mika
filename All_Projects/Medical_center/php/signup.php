<?php
	if(isset($_POST['fname']) && 
		isset($_POST['uname']) && 
		isset($_POST['pass'])){
		include '../db_conn.php';
		$fname = $_POST['fname'];
		$uname = $_POST['uname'];
		$pass = $_POST['pass'];

		$data = "&fname=".$fname."&uname=".$uname;

		if (empty($fname)) {
			$em = "Full name is required";
			header("Location: https://localhost/Medical_center_PHP/index.php?error=$em&$data");
			exit;
		}elseif (empty($uname)) {
			$em = "User name is required";
			header("Location: https://localhost/Medical_center_PHP/index.php?error=$em&$data");
			exit;
		}elseif (empty($pass)) {
			$em = "Passward is required";
			header("Location: https://localhost/Medical_center_PHP/index.php?error=$em&$data");
			exit;
		}else {

			//Pasward coding

			$pass = password_hash($pass, PASSWORD_BCRYPT);

			$sql = "INSERT INTO users(fname, username, passward)
					VALUES(?,?,?)";
			$stmt = $conn->prepare($sql);
			$stmt->execute([$fname, $uname, $pass]);

			header("Location: https://localhost/Medical_center_PHP/index.php?success=Your account has been created successfully");
			exit;
		}
	}
	else {
		header("Location: https://localhost/Medical_center_PHP/index.php?error=error");
		exit;
	}
?>