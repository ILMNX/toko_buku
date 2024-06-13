<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi Customer</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <script src="../assets/js/jquery.js"></script>
  <script src="../assets/js/popper.js"></script>
  <script src="../assets/js/bootstrap.js"></script>
</head>
<body>
  <div class="container">
    <!-- start-card -->
    <div class="mx-auto col-sm-6 mt-5">
      <p class="text-center" style="font-size: 250%;">Toko Buku</p>
      <div class="card">
        <div class="card-header bg-info text-light text-center">
          <h4>Registrasi Customer</h4>
        </div>
        <div class="card-body">
          <form action="proses_reg.php" method="post">
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required>
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" name="registrasi_customer" class="btn btn-block btn-info mt-3">Registrasi</button>
          </form>
        </div>
        <div class="card-footer text-center">
          Sudah punya akun? <a href="login_customer.php">Login</a>
        </div>
      </div>
    </div>
    <!-- end-card -->
  </div>
</body>
</html>
