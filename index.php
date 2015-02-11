<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

?>
	<div class="jumbotron">
	  <h1>Hello <?php echo "$session_name"; ?>, welcome</h1>
	  <ul>
	  	<li><p>Global Admins Have complete control over all domains and users.</p></li>
	  	<li><p>Admins have access to all users within thier domain.</p></li>
	  	<li><p>Users only have access to update their password.</p></li>
	  </ul>
	  <p>Delete Functionality currently does not work, im working on that...</p>
	  <p><a href="update_password.php" class="btn btn-primary btn-lg">Change Password</a> <a href="/mail" class="btn btn-danger btn-lg">Check your Email</a></p>
	</div>

<?php include "includes/footer.php"; ?>