<?php
  session_start();
  if (!isset($_SESSION["id_customer"])) {
    header("location:auth/login_customer.php");
  }

  // mengambil file config.php
  // agar tidak perlu membuat koneksi baru
  include("config.php");
  // include("counter/counter.php");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Toko Buku</title>
    <!-- css-bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- js-bootstrap -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <!-- navbar -->
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/dc8a681ba8.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
      Detail = (item) =>{
        document.getElementById("kode_buku").value = item.kode_buku;
        document.getElementById("judul").innerHTML = item.judul;
        document.getElementById("penulis").innerHTML = item.penulis;
        document.getElementById("harga").innerHTML = item.harga;
        document.getElementById("stok").innerHTML = item.stok;
        document.getElementById("jumlah_beli").value = "1";

        document.getElementById("image").src = "image/" + item.image;
      }
    </script>
  </head>
  <style media="screen">
  /* vertical-center */
  .vertical-center {
    min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
    min-height: 100vh; /* These two lines are counted as one :-)       */

    display: flex;
    align-items: center;
  }
  </style>
  <body>
    <!-- Card -->
    <?php
      // Perintah SQL untuk Menampilkan Data buku
      if (isset($_GET["find"])) {
        // Query jika Melakukan Pencarian
        $find = $_GET["find"];
        $sql = "select * from buku
                where kode_buku like '%$find%'
                or judul like '%$find%'
                or penulis like '%$find%'
                or tahun like '%$find%'
                or harga like '%$find%'
                or stok like '%$find%'";
      } else {
        // Query Jika tidak mencari
        $sql = "select * from buku";
      }
      // eksekusi perintah sql
      // $connect -> mengambil dari config.php
      $query = mysqli_query($connect, $sql);
     ?>

    <!-- header-menu -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color:rgb(255,255,255);box-shadow: 0 4px 6px -1px rgba(0,0,0,0.07);">
      <div class="container">
        <a class="navbar-brand" href="index.php" style="font-size: 170%;">Toko Buku</a>
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
              <form action="index.php" class="form-control border-0" style="background-color: transparent !important;margin-bottom:13px;" method="get">
                <div class="input-group-append">
                  <input name="find" style="border-radius:13px 0 0 13px;" class="form-control" type="search" placeholder="Cari Buku Favoritmu" aria-label="Search">
                  <button style="border-radius:0 13px 13px 0; background-color:rgb(229,231,233);" class="btn" type="submit">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </form>
            </div>
          <!-- end-search -->

          <ul class="navbar-nav text-light">
            <li class="nav-item dropdown active">
              <span class="badge badge-pill" style="float:right;margin-bottom:-12px;margin-left:15px;background-color:rgb(255, 63, 63);"><?php echo count($_SESSION["cart"]); ?></span>
              <a class="nav-link fa fa-shopping-cart" href="#" id="navbarDropdown" data-toggle="dropdown"></a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <div class="container">
                  <div class="card">
                    <div class="card-body">
                      <table class="table text-center">
                        <thead>
                          <tr>
                            <th>Judul</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 0; ?>
                          <?php foreach ($_SESSION["cart"] as $cart): ?>
                            <tr>
                              <td><?php echo (str_word_count($cart["judul"]) > 2 ? substr($cart["judul"],0,15)."..." : $cart["judul"])  ?></td>
                              <td class="text-danger"><b><?php echo number_format($cart["harga"],0,',','.') ?></b></td>
                              <td><?php echo $cart["jumlah_beli"] ?></td>
                            </tr>
                            <!-- Max 3 data yang di print -->
                          <?php if (++$i == 3) {
                            break;
                          } ?>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                      <div class="text-center">
                        <a href="cart.php">Load More <?php echo count($_SESSION["cart"]) - 3; ?></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item active mr-sm-2 ml-sm-2">
              <span class="badge badge-pill" style="float:right;margin-bottom:-12px;margin-left:15px;background-color:rgb(255, 63, 63);">0</span> <!-- your badge -->
              <a class="nav-link fas fa-history" href="transaksi.php"><span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active mr-sm-2 ml-sm-2">
              <span class="badge badge-pill" style="float:right;margin-bottom:-12px;margin-left:15px;background-color:rgb(255, 63, 63);">0</span> <!-- your badge -->
              <a class="nav-link fa fa-envelope" href="messages"><span class="sr-only">(current)</span></a>
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
                <a class="dropdown-item bg-dark text-light" href="process_login_customer.php?logout=true">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end header-menu -->

    <div class="container">
      <div class="card mt-3 mb-3">
        <div class="card-header">
          <h4 class="text-center">Riwayat Transaksi</h4>
        </div>
        <div class="card-body">
          <?php
          $sql = "select * from transaksi t
                  inner join customer c
                  on t.id_customer = c.id_customer
                  where t.id_customer = '".$_SESSION["id_customer"]."' order by t.tgl desc";
          $query = mysqli_query($connect, $sql);
           ?>

           <ul class="list-group">
             <?php foreach ($query as $transaksi): ?>
               <li class="list-group-item mb-4">
               <h6>ID Transaksi: <?php echo $transaksi["id_transaksi"]; ?></h6>
               <h6>Nama Pembeli: <?php echo $transaksi["nama"]; ?></h6>
               <h6>Tgl. Transaksi: <?php echo $transaksi["tgl"]; ?></h6>
               <h6>List Barang:</h6>
               

               <?php
                $sql2 = "select * from detail_transaksi d
                          inner join buku b
                          on d.kode_buku = b.kode_buku
                          where d.id_transaksi = '".$transaksi["id_transaksi"]."'";
                $query2 = mysqli_query($connect, $sql2);
                ?>

                <table class="table table-borderless">
                  <thead>
                    <th>Judul</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                  </thead>
                  <tbody>
                    <?php $total = 0; foreach ($query2 as $detail): ?>
                      <tr>
                        <td><?php echo $detail["judul"]; ?></td>
                        <td><?php echo $detail["jumlah"]; ?></td>
                        <td>Rp. <?php echo number_format($detail["harga_beli"]); ?></td>
                        <td>Rp. <?php echo number_format($detail["harga_beli"] * $detail["jumlah"]); ?></td>
                      </tr>
                      
                    <?php
                    $total += $detail["harga_beli"] * $detail["jumlah"];
                    endforeach; ?>
                  </tbody>
                </table>
                <h2><span class="badge badge-primary" style="float:right;">Rp. <?php echo number_format($total); ?></h6>
                <?php endforeach; ?></span></h2>
           </ul>
           </li>

        </div>
      </div>
    </div>

  </body>
</html>
