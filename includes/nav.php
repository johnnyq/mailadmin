<nav class="navbar navbar-default">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-envelope"></i> Mail Admin</a>
  </div>
  <div class="collapse navbar-collapse" id="navbar-collapse">
    <?php if($session_is_admin == 1){ ?>
    <ul class="nav navbar-nav">
      <li <?php if($_SERVER["REQUEST_URI"] == "/admin/users.php") { echo 'class="active"';} ?>><a href="users.php">Users</a></li>
      <li <?php if($_SERVER["REQUEST_URI"] == "/admin/aliases.php") { echo 'class="active"';} ?>><a href="aliases.php">Aliases</a></li>
      <?php if($session_is_global_admin == 1){ ?>
      <li <?php if($_SERVER["REQUEST_URI"] == "/admin/domains.php") { echo 'class="active"';} ?>><a href="domains.php">Domains</a></li>
      <?php } ?>
    </ul>
    <?php } ?>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?php echo "$session_username"; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="/mail"><i class="glyphicon glyphicon-envelope"></i> Webmail</a></li>
          <li><a href="update_password.php"><i class="glyphicon glyphicon-lock"></i> Change Password</a></li>
          <li class="divider"></li>
          <li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>