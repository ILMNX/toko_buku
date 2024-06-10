<link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/dc8a681ba8.js" crossorigin="anonymous"></script>
<!-- start header-menu -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color:rgb(255,255,255);box-shadow: 0 4px 6px -1px rgba(0,0,0,0.07);">
  <div class="container">
    <a class="navbar-brand" href="#" style="font-family: 'Shadows Into Light', cursive; font-size: 170%;">Toko Buku</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Kategori
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
      </ul>

      <!-- start-search -->
        <div class="input-group">
          <input name="find" style="border-radius:13px 0 0 13px;" class="form-control" type="search" placeholder="Cari Buku Favoritmu" aria-label="Search">
          <div class="input-group-append">
            <button style="border-radius:0 13px 13px 0; background-color:rgb(229,231,233);" class="btn" type="button"><i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      <!-- end-search -->

      <ul class="navbar-nav">
        <li class="nav-item active mr-sm-2 ml-sm-2">
          <a class="nav-link" href="#">
            <i class="fa fa-shopping-cart"></i>
          </a>
        </li>
        <li class="nav-item active mr-sm-2 ml-sm-2">
          <a class="nav-link" href="#"><i class="fa fa-bell"></i></a>
        </li>
        <li class="nav-item active mr-sm-2 ml-sm-2">
          <a class="nav-link" href="#"><i class="fa fa-envelope"></i></a>
        </li>
        <li class="nav-item d-none d-lg-block disabled">
          <span class="nav-link disabled">⋮</span>
        </li>
        <li class="nav-item active">
          <div class="dropdown-divider"></div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION["nama"]; ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">Setting</a>
            <a class="dropdown-item bg-dark text-light" href="process_login_admin.php?logout=true">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- end header-menu -->
