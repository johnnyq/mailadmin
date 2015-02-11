<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
	if(isset($_GET['session_username'])){
	  	$username = $_GET['session_username'];
	}

?>
	    
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Update Password</h3>
	</div>
	<div class="panel-body">
	    
	    <div id="response"></div>

	    <form id="ajaxEditForm" class="form col-md-4" autocomplete="off">
	      <input type="hidden" name="update_password">
	      <div class="form-group">
	        <label>New Password</label>
	        <input type="password" class="form-control" name="password" required>
	        <br>
	        <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Submit</button>
	      </div>
	    </form>
	</div>
</div>

<?php include "includes/footer.php"; ?>