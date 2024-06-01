<?php
  session_start();
  if (!isset($_SESSION["id_customer"])) {
    header("location:auth/login_customer.php");
  }
  include("config.php");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Toko Buku</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.js"></script>
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
        document.getElementById("jumlah_beli").max = item.stok;

        document.getElementById("image").src = "image/" + item.image;
      }
    </script>
  </head>
  <style media="screen">

  .vertical-center {
    min-height: 100%;  
    min-height: 100vh; 

    display: flex;
    align-items: center;
  }

  #wrapThumbnail {
      height: 250px;
      overflow: hidden;
      position: relative;
  }
  #thumbnailCard {
      background-color: rgba(0, 0, 0, 0.7);
      position: absolute;
      top: 0px;
      height: 100%;
      width: 100%;
      text-align: center;
      padding-top: 30%;
      color: white;
      font-size: 20px;
  }

  #thumbnailCard span {
      display: block;
  }

  #thumbnailCard a {
      text-decoration: none;
      color: white;
      display: block;
      width: 100px;
      margin: 0 auto;
      border: 1px solid white;
      padding: 5px;
  }

  #thumbnailCard a:hover {
      background-color: white;
      color: black;
  }

  #wrapThumbnail #thumbnailCard {
      display: none;
  }

  #wrapThumbnail img {
      width: 100%;
      height: auto;
  }

  #wrapThumbnail:hover #thumbnailCard {
      display: block;
  }
  </style>
  <body>
    <?php
      if (isset($_GET["find"])) {
        $find = $_GET["find"];
        $sql = "select * from buku
                where kode_buku like '%$find%'
                or judul like '%$find%'
                or penulis like '%$find%'
                or tahun like '%$find%'
                or harga like '%$find%'
                or stok like '%$find%'";
      } else {
        $sql = "select * from buku";
      }
      $query = mysqli_query($connect, $sql);
     ?>

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
                          <?php if (++$i == 3) {
                            break;
                          } ?>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                      <div class="text-center">
                        <a href="cart.php">Load More</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item active mr-sm-2 ml-sm-2">
              <span class="badge badge-pill" style="float:right;margin-bottom:-12px;margin-left:15px;background-color:rgb(255, 63, 63);">0</span> <!-- your badge -->
              <a class="nav-link fa fa-history" href="transaksi.php"><span class="sr-only">(current)</span></a>
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

    <?php
      $result = mysqli_query($connect, $sql);;
      if(mysqli_num_rows($result) > 0){
    ?>

    <div class="container">
      <figcaption class="figcaption rounded mt-4 p-1 col-12 col-md-12 col-lg-3 text-center" style="box-shadow: 0px 0px 11px 3px rgba(0,0,0,0.07);">Total Produk <span class="text-danger"><?php echo mysqli_num_rows($result) ?></span> Buku</figcaption>
      <!-- Card -->
      <div class="row py-4">
      <?php foreach ($query as $cardBuku): ?>
        <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-3">
            <div class="card border-0 mb-4" style="background-color:rgb(255,255,255);box-shadow: 0px 0px 11px 3px rgba(0,0,0,0.07);overflow:hidden;">

              <div id="wrapThumbnail">
                <img src="<?php echo 'image/'.$cardBuku['image']; ?>" class="mx-auto" alt="Gambar">
                <div id="thumbnailCard">
                    <p>Rp. <?php echo number_format($cardBuku["harga"],0,',','.') ?> <span>Tersedia : <?php echo $cardBuku["stok"] ?></span> </p>
                    <button type="button" name="detail" class="btn btn-light" onclick='Detail(<?php echo json_encode($cardBuku); ?>)' data-toggle="modal" data-target="#modal_detail">Cek Buku</button>
                </div>
              </div>

                <div class="card-body">
                  <h5 class="card-text style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;""><?php echo (str_word_count($cardBuku["judul"]) > 3 ? substr($cardBuku["judul"],0,25)."..." : $cardBuku["judul"])  ?></h5>

                  <p class="card-text">Penulis : <?php echo (str_word_count($cardBuku["penulis"]) > 2 ? substr($cardBuku["penulis"],0,13)."..." : $cardBuku["penulis"]) ?></p>
                  <p class="card-text text-danger"><b>Rp. <?php echo number_format($cardBuku["harga"],0,',','.') ?></b></p>
                </div>
            </div>
        </div>
      <?php endforeach; ?>
      </div>

      <!-- modal-product -->
      <div id="modal_detail" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-body">
              <div class="row">
                <div class="col-5">
                  <!-- gambar -->
                  <img id="image" alt="test" style="width:100%; height:auto;">
                </div>
                <div class="col-7 pl-3">
                  <!-- deskripsi -->
                  <h4 id="judul"></h4>
                  <div class="dropdown-divider"></div>
                  <h4 class="pt-1 pb-1">Penulis : <span id="penulis"></span></h4>
                  <div class="dropdown-divider"></div>
                  <h4 class="pt-1 pb-1">Harga : <span class="text-danger">Rp. <span id="harga"></span></span></h4>
                  <div class="dropdown-divider"></div>

                  <form action="process_cart.php" method="post">
                    <div class="row">
                      <div class="col-2">
                        <h4 class="pt-1 pb-1">Jumlah</h4>
                      </div>
                      <div class="col-4">
                        <input type="hidden" name="kode_buku" id="kode_buku">
                        <div class="mt-2">
                          Stock Tersedia : <span id="stok" class="text-success"></span>
                        </div>
                        <input type="number" name="jumlah_beli" id="jumlah_beli"
                        class="form-control mt-1" placeholder="Jumlah Beli" min="1" >
                        <button type="submit" name="add_to_cart" class="btn btn-dark text-light btn-sm btn-block mt-1">
                          Tambahkan ke Keranjang
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } else {?>
      <div class="col-11 col-sm-10 col-md-9 col-lg-7 col-xl-4 mx-auto vertical-center">
        <div class="jumbotron" style="background:transparent !important;">
          <img src="assets/img/notFound.png" width="100%" alt="...">
            <h5 class="text-center">Data tidak ditemukan!</h5>
            <a href="#" class="nav-link text-center" onclick="history.back()">Kembali ?</a>
        </div>
      </div>
    <?php } ?>
  </body>
</html>
