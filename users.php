<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

    if (isset($_GET['p'])){
	    $p = intval($_GET['p']);
	    $record_from = (($p)-1)*10;
	    $record_to =  10;
	}else{
		$record_from = 0;
		$record_to = 10;
		$p = 1;
	}

    if (isset($_GET['q'])){
		$q = $_GET['q'];
	}

	if($session_is_global_admin == 1){
		$sql = mysql_query("SELECT SQL_CALC_FOUND_ROWS * FROM mailbox WHERE username LIKE '%$q%' ORDER BY domain DESC LIMIT $record_from, $record_to");
	}else{
		$sql = mysql_query("SELECT SQL_CALC_FOUND_ROWS * FROM mailbox WHERE username LIKE '%$q%' AND domain = '$session_domain' ORDER BY username DESC LIMIT $record_from, $record_to");
	}
	$num = mysql_num_rows($sql);

	$num_rows = mysql_fetch_row(mysql_query("SELECT FOUND_ROWS()"));
	$total_found_rows = $num_rows[0];
    $total_pages = ceil($total_found_rows / 10);

?>

<form class="well well-sm" autocomplete="off">
	<div class="row">
		<div class="col-md-4">
			<div class="input-group">
				<input type="text" class="form-control" name="q" value="<?php if(isset($q)){echo $q;} ?>" placeholder="Search Users" autofocus>
				<span class="input-group-btn">
					<button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
				</span>
			</div>
		</div>
		<div class="col-md-8">
			<a class="btn btn-primary pull-right" href='add_user.php'><span class="glyphicon glyphicon-plus"></span> Add User</a>
		</div>
	</div>
</form> 

<div id="response"></div>

<?php

if($total_found_rows > 0) { 

?>

<table class="table table-bordered table-hover">	
    <thead>	
        <tr>	
            <th>User</th>
			<th>Access</th>
			<th>Created</th>
			<th>Action</th>
		</tr>
	</thead>
    <tbody>
		
        <?php

			while($row = mysql_fetch_array($sql)){
                $username = $row['username'];
                $created = $row['created'];
                $isadmin = $row['isadmin'];
                $isglobaladmin = $row['isglobaladmin'];
                if($isglobaladmin == 1){
                	$access = "Global Admin";
                }elseif($isadmin == 1 AND $isglobaladmin == 0){
                	$access = "Admin";
                }else{
                	$access = "User";
                }
                
                echo "
					<tr>
						<td>$username</td>
						<td>$access</td>
						<td>$created</td>
						<td>
							<div class='btn-group'>
							    <a class='btn btn-default' href='edit_user.php?username=$username'><span class='glyphicon glyphicon-pencil'></span></a>
                                <button id='del_$username' class='btn btn-default'><span class='glyphicon glyphicon-remove'></span></button>
                                <a class='btn btn-default' href='user_details.php?username=$username'><span class='glyphicon glyphicon-eye-open'></span></a>
                            </div>
						</td>
					</tr>
				";
			}
		?>
	
    </tbody>
</table>

<?php include("pagination.php"); ?>

<?php

	}else{
		echo "<div class='alert alert-warning'>No records found.</div>";
	}

include "includes/footer.php";

?>

<script>

	$( '[id^="del_"]' ).click(function() {
		var id = this.id;
 		id = id.split("_");
 		id = id[1];
		
		$.ajax({
		    url: "post.php?delete_user="+id+"",      
		}).success(function(response) {
		    $("#response").html(response);
		    $("form:not(.filter) :input:visible:enabled:first").focus();
		});
	});

</script>