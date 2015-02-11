<?php
	
	session_start();
	
	if(!$_SESSION['logged']){
	    header("Location: login.php");
	    die;
	}

	$session_username = $_SESSION['username'];

	$sql = mysql_query("SELECT * FROM mailbox WHERE username = '$session_username'");
	$row = mysql_fetch_array($sql);
	$session_name = ucwords($row['name']);
	$session_domain = $row['domain'];
	$session_is_admin = $row['isadmin'];
	$session_is_global_admin = $row['isglobaladmin'];
?>