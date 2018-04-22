<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand text-uppercase" href="dashboard.php"><?php echo $me['name']; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item home">
        <a class="nav-link" href="dashboard.php">HOME</a>
      </li>
      <li class="nav-item newpost">
        <a class="nav-link" href="new.php">NEW POST</a>
      </li>
      <li class="nav-item account">
        <a class="nav-link" href="account.php">ACCOUNT</a>
      </li>
      <li class="nav-item addadmin">
        <a class="nav-link" href="add.php">ADD ADMIN</a>
      </li>
    </ul>
    <div class="nav-item">
        <a href="logout.php" class="nav-link text-light">LOGOUT</a>
    </div>
  </div>
</nav>