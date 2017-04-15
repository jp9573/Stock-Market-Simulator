<?php
	require "connection.php";
	$Email = $_REQUEST['Email'];
	$Pass = $_REQUEST['Pass'];

	$sql = "SELECT EmailID, Password, Username, MobileNo, Balance FROM TblUser WHERE EmailID = '$Email' AND Password = '$Pass'";
	$result = $conn->query($sql);

	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		$Username = $row['Username'];
		$Mob = $row['MobileNo'];
		$Bal = $row['Balance'];
		session_start();
		$_SESSION["EmailID"] = "$Email";
	    $_SESSION["Username"] = "$Username";
	    $_SESSION["MobileNo"] = "$Mob";
	    $_SESSION["Balance"] = "$Bal";
	    echo '<script type="text/javascript">window.location.href = "home.php";</script>';	    
	} else {	    
	    echo '<script type="text/javascript">alert("Please enter correct creditential");window.location.href = "../html/login.html";</script>';
	}
	$conn->close();
?>