<?php
	session_start();

	session_unset();
	session_destroy();
	 echo '<script type="text/javascript">window.location.href = "../index.html";</script>';
?>