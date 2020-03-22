<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">Flower Store</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
      </li>
      
      
    </ul>
    
  </div>
  <div class="d-flex justify-content-end">
  <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php 
            if(isset($_SESSION["username"]))
            {
                echo "<i class='fas fa-user'> ".$_SESSION["username"]." </i>";
            }
        ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="logout.php">logout</a>
          <a class="dropdown-item" href="resetPassword.php">reset password</a>
        </div>
      </div>
        
      </div>
</nav>