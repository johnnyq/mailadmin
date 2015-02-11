<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
?>
	    
<ol class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li><a href="domains.php">Domains</a></li>
	<li class="active">Add Domain</li>
</ol>
	    
<div id="response"></div>

<form id="ajaxAddForm" class="form col-md-4" autocomplete="off">
  <input type="hidden" name="add_domain">
  <div class="form-group">
    <label>Domain</label>
    <input type="text" class="form-control" name="domain" autofocus required>
    <br>
    <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Submit</button>
  </div>
</form>

<?php include "includes/footer.php"; ?>