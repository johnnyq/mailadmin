<?php 
	
  session_start();
	include "config.php";
	include "includes/header.php"; 

?>	

<div class="row">
  <div class="col-md-offet-4 col-md-4 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Login</h3>
      </div>
      <div class="panel-body">
        
        <div id="message"></div>
  
        <form id="ajaxform" class="form-horizontal" autocomplete="off">
          <input type="hidden" name="login">
          <div class="form-group">
            <div class="col-md-12">
              <input type="text" class="form-control" name="username" placeholder="Username" autofocus required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
              <br>
              <button class="btn btn-primary btn-lg btn-block">Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include "includes/footer.php"; ?>

<script>

  //callback handler for form submit
  $("#ajaxform").submit(function(e)
  {
    var postData = $(this).serializeArray();     
      $.ajax(
      {
          url : "post.php",
          type: "POST",
          data : postData,
          success : function(response)
          {
              $("#message").html(response);
          },  
      });
      e.preventDefault(); //STOP default action
      $('#ajaxform').trigger("reset");
  });

</script>