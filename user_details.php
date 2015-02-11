<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
	if(isset($_GET['username'])){
	  	$username = $_GET['username'];
	  	
	  	$sql = mysql_query("SELECT * FROM mailbox WHERE username = '$username'");

	  	$row = mysql_fetch_array($sql);
	  	$username = $row['username'];
      $active = $row['active'];
      $isadmin = $row['isadmin'];
      $isglobaladmin = $row['isglobaladmin'];
      $active = $row['active'];
      $created = $row['created'];
      $modified = $row['modified'];
      $password_last_change = $row['passwordlastchange'];
      $last_login_date = $row['lastlogindate'];
      $last_login_ip = $row['lastloginipv4'];
      $maildir = $row['maildir'];
      $quota = $row['quota'];
  }

?>
	    
<ol class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li><a href="users.php">Users</a></li>
	<li class="active">User Details</li>
</ol>
    
<div class="form-group col-sm-12">
    <label class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <p class="form-control-static"><?php echo "$username"; ?></p>
    </div>
</div>
<div class="form-group col-sm-12">
    <label class="col-sm-2 control-label">Active</label>
    <div class="col-sm-10">
      <p class="form-control-static"><?php echo "$active"; ?></p>
    </div>
</div>
<div class="form-group col-sm-12">
    <label class="col-sm-2 control-label">Created</label>
    <div class="col-sm-10">
      <p class="form-control-static"><?php echo "$created"; ?></p>
    </div>
</div>
<div class="form-group col-sm-12">
    <label class="col-sm-2 control-label">Modified</label>
    <div class="col-sm-10">
      <p class="form-control-static"><?php echo "$modified"; ?></p>
    </div>
</div>
<div class="form-group col-sm-12">
    <label class="col-sm-2 control-label">Last Password Change</label>
    <div class="col-sm-10">
      <p class="form-control-static"><?php echo "$password_last_change"; ?></p>
    </div>
</div>
<div class="form-group col-sm-12">
    <label class="col-sm-2 control-label">Quota</label>
    <div class="col-sm-10">
      <p class="form-control-static"><?php echo "$quota"; ?>MB</p>
    </div>
</div>
<div class="form-group col-sm-12">
    <a class="btn btn btn-default" href="index.php">Back</a>
</div>

<?php include "includes/footer.php"; ?>