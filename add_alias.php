<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
?>
	    
<ol class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li><a href="aliases.php">Aliases</a></li>
	<li class="active">Add Alias</li>
</ol>
	    
<div id="response"></div>

<form id="ajaxAddForm" class="form col-md-4" autocomplete="off">
  <input type="hidden" name="add_alias">
  <div class="form-group">
    <label>Alias</label>
    <input type="text" class="form-control" name="username" autofocus required>
  </div>
  <?php if($session_is_global_admin == 1){ ?>
  <div class="form-group">
    <label>Domain</label>
    <select class="form-control" name="domain" required>
   		<option value=''>Select a Domain</option>
   		
   		<?php
   			
   			$sql = mysql_query("SELECT * FROM domain ORDER BY domain ASC");
			while($row = mysql_fetch_array($sql)){
                $domain = $row['domain'];

            	echo "<option>$domain</option>";
            }

        ?>
    
    </select>
  </div>
  <?php }else{ 
  	echo "<input type='hidden' name='domain' value='$session_domain'>"; }
  ?>
  <div class="form-group">
    <label>Forwards To</label>
    <textarea rows="5" class="form-control" name="goto" required></textarea>
  	<br>
    <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Submit</button>
  </div>
</form>

<?php include "includes/footer.php"; ?>