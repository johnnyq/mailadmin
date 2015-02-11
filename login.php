<?php 
	session_start();
	include "config.php";
	include "includes/header.php"; 
    
  if(isset($_POST['login'])){

      $usr = mysql_real_escape_string($_POST['username']);
      $pas = mysql_real_escape_string($_POST['password']);

      $sql = mysql_query("SELECT * FROM mailbox WHERE username='$usr' LIMIT 1");
      
      if(mysql_num_rows($sql) == 1){
          $row = mysql_fetch_array($sql);
          $password = $row['password'];
          $output = shell_exec("doveadm pw -t '$password' -p '$pas'");
          if($output <> ''){
            session_start();
            $_SESSION['logged'] = TRUE;
            $_SESSION['username'] = $row['username'];
            header("Location: index.php");
          }
           $response = "<div class='alert alert-warning'><strong>Correct Username Wrong Password</strong><button class='close' data-dismiss='alert'>&times;</button></div>";
          //exit;
      }else{
          $response = "<div class='alert alert-warning'><strong>Invalid password.</strong><button class='close' data-dismiss='alert'>&times;</button></div>";
      }
  }

?>	

<div class="row">
  <div class="col-md-offet-3 col-md-6 col-md-offset-3">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2><i class="glyphicon glyphicon-envelope"></i> MailAdmin</h2>
      </div>
      <div class="panel-body">
        <?php 
        
          if(isset($response)){
            echo "$response";
          }
        
        ?>
        <form class="form-horizontal" autocomplete="off" method="post">
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon input-lg"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control input-lg" name="username" placeholder="Email" required autofocus>                                        
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon input-lg"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" class="form-control input-lg" name="password" placeholder="Password">
              </div>
              <br>
              <button type="submit" name="login" class="btn btn-primary btn-lg btn-block"><i class="glyphicon glyphicon-log-in"></i> Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include "includes/footer.php"; ?>