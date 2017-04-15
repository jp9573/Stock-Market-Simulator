<?php
	require "connection.php";
	$Mobile = $_REQUEST['Mob'];
	$Email = $_REQUEST['Email'];
	$UserName = $_REQUEST['UserName'];	
	$Pass = $_REQUEST['Password'];
	$CnfPass = $_REQUEST['CnfPassword'];

	if ($Pass == $CnfPass) {
		$qry = "INSERT INTO TblUser(EmailID, Username, Password,MobileNo,Balance) VALUES('$Email', '$UserName', '$Pass','$Mobile',100000);";
		if ($conn->query($qry) === TRUE) {		    	   	   	        
	        echo '<script type="text/javascript">alert("You are successfully registered");window.location.href = "../index.html";</script>';
		} else {
		    echo '<script type="text/javascript">alert("EmailID or Username not available");window.location.href = "../index.html";</script>';
		}
		$conn->close();	
	} else {				
		echo '<script type="text/javascript">alert("Password not match!");window.location.href = "../index.html";</script>';
	}
	
?>