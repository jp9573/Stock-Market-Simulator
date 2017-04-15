<?php
	require "connection.php";
	$Email = "";
	$html= "<h2></h2>";
	if (isset($_REQUEST['Email']) && isset($_REQUEST['Mob']) && (strlen($_REQUEST['Password']) == 0) ){
		$Email = $_REQUEST['Email'];
		$Mob = $_REQUEST['Mob'];
		$qry = "select EmailID,MobileNo from TblUser where EmailID='$Email' and MobileNo = '$Mob'";
		$result = $conn->query($qry);
		if($result->num_rows === 1) {	
			echo '<style type="text/css">#pass{
				visibility: visible;
			}</style>';
			$html = "<h2>$Email</h2>";			 
		}else{
			echo "<script type='text/javascript'>alert('Please Enter correct EmailId and Mobile no');</script>";
		}
	}elseif (isset($_REQUEST['Password']) && isset($_REQUEST['CnfPassword']) && (strlen($_REQUEST['Password']) > 0)) {		
		$dom = new domDocument('1.0', 'utf-8'); 
		$dom->loadHTML($html); 
		$dom->preserveWhiteSpace = false; 
		$hTwo= $dom->getElementsByTagName('h2');
		echo $hTwo->item(0)->nodeValue;
		$Password = $_REQUEST['Password'];
		$CnfPassword = $_REQUEST['CnfPassword'];
		if($Password == $CnfPassword) {
			$qry = "Update TblUser SET `Password` = '$Password' where EmailID = '$Email'";		
			if($conn->query($qry) === TRUE){
				echo "<script type='text/javascript'>alert('Password has been successfully changed!');</script>";	
				//echo '<script type="text/javascript">window.location.href = "../html/login.html";</script>';
			}else{
				echo "<script type='text/javascript'>alert('Please try again');</script>";
			}
		}else {
			echo "<script type='text/javascript'>alert('Passwords does not match');</script>";
		}		
	}else{
		echo '<style type="text/css">#pass{visibility: hidden;}</style>';
	}
?>

<html>
<head>
	<title>Forgot Password</title>
	<link rel="stylesheet" type="text/css" href="../css/forgotpassword_stylesheet.css">
</head>
<body>
	<div class="header">
		<img class="logo" src="../img/logo.jpg">		
		<a class="login" href="../index.html">Register</a>
		<a class="login" href="../html/login.html">Login  /</a>/
	</div>	
	<div class="login_form">
		<form action="">
			<h1>Enter your Registered Email id and phone number to change password</h1>
			<p>Email Address</p>
			<h2 id="hid"></h2>
			<input type="text" name="Email"><br>
			<p>Registered Mobile Number</p>
			<input type="number" name="Mob"><br>
			<input type="submit" value="Change Password"><br>

			<input type="password" id="pass" name="Password" placeholder="New Password"><br>
			<input type="password" id="pass" name="CnfPassword" placeholder="Confirm New Password"><br>
			<input type="submit" value="Save" id="pass">
			<p>
		</form>
	</div>			
</body>
</html>
