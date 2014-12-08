<div id="logo">Disaster</div>

<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <ul class="nav nav-pills">
      <li role="presentation" ><a href="index.php">Home</a></li>
      <li role="presentation"><a href="search.php">Search</a></li>
      <li role="presentation"><a href="register.php">Add a Victim</a></li>
      <li role="presentation"><a href="about.php">About</a></li>
      <?php if(loggedin()){ ?>
      <li role="presentation"><a href="logout.php">Logout</a></li>
      <?php } else { ?>       
      <li role="presentation"><a href="login.php">Login</a></li>
      <li role="presentation"><a href="contributor.php">Register</a></li>
      <?php } ?>
    </ul>
  </div>
</nav>