<?php
  // Koneksi ke database
  $host = "localhost"; // Server Local
  $user = "root";
  $password = "";
  $db = "toko_buku";
  // isi nama host, username mysql, password mysql, dan nama Database mysql
  $connect = mysqli_connect($host,$user,$password,$db);

  // cek koneksi Database
  // if(mysqli_connect_errno()){
  //   // Menampilkan pesan error ketika koneksi gagal
  //   echo mysqli_connect_errno();
  // } else {
  // }
 ?>
