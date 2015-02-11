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
	}

?>
	    
<ol class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li><a href="users.php">Users</a></li>
	<li class="active">Edit User</li>
</ol>
	    
<div id="response"></div>

<form id="ajaxEditForm" class="form col-md-4" autocomplete="off">
  <input type="hidden" name="edit_user">
  <input type="hidden" name="username" value="<?php echo "$username"; ?>">	     
  <div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control" disabled name="username" value="<?php echo "$username"; ?>" required>
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <div class="form-group">
    <label>Active</label>
    <select class="form-control" name="active" required>
   		<option value='0'>No</option>
   		<option <?php if($active == 1){ echo "selected"; } ?> value='1'>Yes</option>
    </select>
  </div>
  <?php if($session_is_global_admin == 1){ ?>
  <div class="form-group">
    <label>Global Admin</label>
    <select class="form-control" name="global_admin" required>
   		<option value='0'>No</option>
   		<option <?php if($isglobaladmin == 1){ echo "selected"; } ?> value='1'>Yes</option>
    </select>
  </div>
   <?php } ?>
  <div class="form-group">
    <label>Admin</label>
    <select class="form-control" name="admin" required>
   		<option value='0'>No</option>
   		<option <?php if($isadmin == 1){ echo "selected"; } ?> value='1'>Yes</option>
    </select> 
    <br>
    <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Submit</button>
  </div>
</form>

<?php include "includes/footer.php"; ?>