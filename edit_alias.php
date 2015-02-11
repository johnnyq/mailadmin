<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
	if(isset($_GET['address'])){
	  	$username = $_GET['address'];
	  	
	  	$sql = mysql_query("SELECT * FROM alias WHERE address = '$username'");

	  	$row = mysql_fetch_array($sql);
	  	$goto = $row['goto'];
	}

?>
	    
<ol class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li><a href="aliases.php">Aliases</a></li>
	<li class="active">Edit Alias</li>
</ol>
	    
<div id="response"></div>

<form id="ajaxEditForm" class="form col-md-4" autocomplete="off">
  <input type="hidden" name="edit_alias">
  <div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo "$username"; ?>" autofocus required>
  </div>
  <div class="form-group">
    <label>Forwards To</label>
    <textarea rows="5" class="form-control" name="goto" required><?php echo "$goto"; ?></textarea>
    <br>
    <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Submit</button>
  </div>
</form>

<?php include "includes/footer.php"; ?>