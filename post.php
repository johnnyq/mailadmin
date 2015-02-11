<?php

	include "config.php";
	include "includes/check_login.php";

	$time_now = date("Y-m-d H:i:s");

	if(isset($_POST['add_domain'])){
    	$domain = mysql_real_escape_string($_POST['domain']);
      	$sql = mysql_query("INSERT INTO domain SET domain = '$domain', created = '$time_now'");

      	echo "<div class='alert alert-warning'>Domain successfully added.<button class='close' data-dismiss='alert'>&times;</button></div>";
    }

	if(isset($_GET['delete_domain'])){
        $domain = $_GET['delete_domain'];
        $sql = "DELETE FROM domain WHERE domain = '$domain'";
        mysql_query($sql);
    }

	if(isset($_POST['add_user'])){
    	$username = mysql_real_escape_string($_POST['username']);
    	$domain = mysql_real_escape_string($_POST['domain']);
      $global_admin = $_POST['global_admin'];
      $admin = $_POST['admin'];
      $password = $_POST['password'];
      	$hash = shell_exec("doveadm pw -s 'ssha512' -p '$password'");
      	$sql = mysql_query("INSERT INTO mailbox SET username = '$username@$domain', password = '$hash', name = '$username', domain = '$domain', isadmin = $admin, isglobaladmin = $global_admin, maildir = '$domain/$username', created = '$time_now', local_part = '$username'");

      	echo "<div class='alert alert-warning'>User successfully added.<button class='close' data-dismiss='alert'>&times;</button></div>";
    }

	if(isset($_POST['edit_user'])){
    	$username = mysql_real_escape_string($_POST['username']);
      $password = mysql_real_escape_string($_POST['password']);
      $global_admin = $_POST['global_admin'];
      $admin = $_POST['admin'];
      $active = $_POST['active'];
      if(!empty($password)){
        $hash = shell_exec("doveadm pw -s 'ssha512' -p '$password'");
        $sql = mysql_query("UPDATE mailbox SET password = '$hash', passwordlastchange = '$time_now' WHERE username = '$username'");  
      }
      $sql = mysql_query("UPDATE mailbox SET isadmin = $admin, isglobaladmin = $global_admin, modified = '$time_now', active = $active WHERE username = '$username'");

      echo "<div class='alert alert-warning'>User successfully updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
    }

	if(isset($_GET['delete_user'])){
        $username = $_GET['delete_user'];
        $sql = "DELETE FROM mailbox WHERE username = '$username'";
        mysql_query($sql);
    }

    if(isset($_POST['update_password'])){
    	$password = mysql_real_escape_string($_POST['password']);
      	$hash = shell_exec("doveadm pw -s 'ssha512' -p '$password'");
      	$sql = mysql_query("UPDATE mailbox SET password = '$hash', passwordlastchange = '$time_now' WHERE username = '$session_username'");

      	echo "<div class='alert alert-warning'>Password successfully updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
    }

	if(isset($_POST['add_alias'])){
    	$username = mysql_real_escape_string($_POST['username']);
    	$domain = mysql_real_escape_string($_POST['domain']);
    	$goto = mysql_real_escape_string($_POST['goto']);
      	$sql = mysql_query("INSERT INTO alias SET address = '$username@$domain', goto = '$goto', domain = '$domain', created = '$time_now'");

      	echo "<div class='alert alert-warning'>Alias successfully added.<button class='close' data-dismiss='alert'>&times;</button></div>";
    }
    
    if(isset($_POST['edit_alias'])){
    	$username = mysql_real_escape_string($_POST['username']);
    	$goto = mysql_real_escape_string($_POST['goto']);
      	$sql = mysql_query("UPDATE alias SET address = '$username', goto = '$goto', modified = '$time_now' WHERE address = '$username'");

      	echo "<div class='alert alert-warning'>Alias successfully updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
    }

    if(isset($_POST['delete_alias'])){
        $address = $_POST['delete_alias'];
        $sql = "DELETE FROM alias WHERE address = '$address'";
        mysql_query($sql);
        echo $address;
    }

?>	