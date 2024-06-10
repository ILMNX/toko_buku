<?php
  if (isset($_POST["save_admin"])) {
    // issset digunakan untuk mengecek
    // apakah ketika mengakses file ini, dikirimkan
    // data dengan nama "save_admin" dengan method post

    // tampung data yang dikirimkan
    $action = $_POST["action"];
    $id_admin = $_POST["id_admin"];
    $nama = $_POST["nama"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    $pass = $_POST["password"];

    // load file config.php
    include("config.php");

    // cek aksinya
    if ($action == "insert") {
      // Sintaks untuk Insert
      $sql = "insert into admin values ('$id_admin','$nama','$kontak','$username','$pass')";
      // eksekusi perintah sql-nya
      mysqli_query($connect, $sql);
    } else if ($action == "update") {
      // Sintaks untuk update
      $sql = "update admin set
              nama='$nama',
              kontak='$kontak',
              username='$username',
              password='$pass'
              where id_admin='$id_admin'";
      // eksekusi perintah sql-nya
      mysqli_query($connect, $sql);
    }

    // redirect ke halaman admin.php
    header("location:admin.php");
  }

  if (isset($_GET["hapus"])) {
    $id_admin = $_GET["id_admin"];
    $sql = "delete from admin
            where id_admin='$id_admin'";

    include("config.php");
  mysqli_query($connect, $sql);

  // direct ke halaman admin.php
  header("location:admin.php");
  }
 ?>
