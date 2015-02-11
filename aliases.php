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
		$sql = mysql_query("SELECT SQL_CALC_FOUND_ROWS * FROM alias WHERE address LIKE '%$q%' OR goto LIKE '%$q%' ORDER BY domain DESC LIMIT $record_from, $record_to");
	}else{
		$sql = mysql_query("SELECT SQL_CALC_FOUND_ROWS * FROM alias WHERE (address LIKE '%$q%' OR goto LIKE '%$q%') AND domain = '$session_domain' ORDER BY address DESC LIMIT $record_from, $record_to");
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
				<input type="text" class="form-control" name="q" value="<?php if(isset($q)){echo $q;} ?>" placeholder="Search aliases" autofocus>
				<span class="input-group-btn">
					<button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
				</span>
			</div>
		</div>
		<div class="col-md-8">
			<a class="btn btn-primary pull-right" href='add_alias.php'><span class="glyphicon glyphicon-plus"></span> Add Alias</a>
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
            <th>Alias</th>
			<th>Forwards To</th>
			<th>Created</th>
			<th>Action</th>
		</tr>
	</thead>
    <tbody>
		
        <?php

			while($row = mysql_fetch_array($sql)){
                $address = $row['address'];
                $goto = $row['goto'];
                $created = $row['created'];
                
                echo "
					<tr>
						<td>$address</td>
						<td><small>$goto</small></td>
						<td>$created</td>
						<td>
							<div class='btn-group'>
							    <a class='btn btn-default' href='edit_alias.php?address=$address'><span class='glyphicon glyphicon-pencil'></span></a>
                                <a onclick=deleteAlias('$address') href='#' class='btn btn-default'><span class='glyphicon glyphicon-remove'></span></a>
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

function deleteAlias(id){
    $.ajax({
           type: "POST",
           url: "post.php",
           data: "delete_alias="+id,
           success: function(msg){
             alert( "Row has been updated: " + msg );
           }
    });
}

</script>