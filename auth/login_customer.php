<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Customer</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
  </head>
  <body>
    <div class="container">
      <!-- start-card -->
      <div class="mx-auto col-sm-6 mt-5">
        <p class="text-center" href="#" style="font-size: 250%;">Toko Buku</p>
        <div class="card">
          <div class="card-header bg-success text-light text-center">
            <h4>Login Customer</h4>
          </div>
          <div class="card-body">
            <form action="cek_login_customer.php" method="post">
              Username
              <input type="text" name="username" class="form-control" placeholder="Username" required>
              Password
              <input type="password" name="password" class="form-control" placeholder="Password" required>
              <button type="submit" name="login_customer" class="btn btn-block btn-success mt-3 col-sm-4 mx-auto">Login</button>
            </form>
          </div>
          <div class="card-footer text-center">
            Belum punya akun? <a href="registrasi_customer.php">Registrasi</a>
          </div>

        </div>
      </div>
      <!-- end-card -->
    </div>
  </body>
</html>
