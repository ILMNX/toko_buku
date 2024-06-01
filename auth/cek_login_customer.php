<?php
  session_start();
  // session_start() digunakan sebagai tanda bahwa kita akan menggunakan session pada halaman ini (login_customer.php)
  // session_start() harus diletakkan pada BARIS PERTAMA.

  include("../config.php");

  //tampung data username dan Password
  $username = $_POST["username"];
  $password = $_POST["password"];

  if (isset($_POST["login_customer"])) {
    $sql = "select * from customer
            where username = '$username'
            and password = '$password'";
    // eksekusi query
    $query = mysqli_query($connect, $sql);
    $jumlah = mysqli_num_rows($query);
    // mysqli_num_rows digunakan untuk menghitung jumlah data hasil dari query

    if ($jumlah > 0) {
      // jika jumlahnya lebih dari nol, artinya terdapat data customer yang sesuai
      // dengan username dan password yang diinputkan.

      // kita ubah hasil query ke array
      $customer = mysqli_fetch_array($query);

      // membuat session
      $_SESSION["id_customer"] = $customer["id_customer"];
      $_SESSION["nama"] = $customer["nama"];

      // Tambahan untuk customer (cart)
      $_SESSION["cart"] = array();

      // Redirect jika berhasil login
      header("location:../index.php");
    } else{
      // jika jumlahnya nol, artinya tidak ada data customer yang sesuai dengan
      // username dan password yang diinputkan

      // Redirect jika login gagal
      header("location:login_customer.php");
    }
  }

  if (isset($_GET["logout"])) {
    // proses logout
    session_destroy(); // menghapus session yang telah dibuat.

    header("location:login_customer.php"); // Redirect
  }
 ?>
