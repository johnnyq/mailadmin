<?php
	
	$dbhost = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$database = "vmail";

	mysql_connect($dbhost,$dbusername,$dbpassword);
	mysql_select_db($database) or die ( "Unable to select database");

?>