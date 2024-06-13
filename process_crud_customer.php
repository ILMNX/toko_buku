<?php
  if (isset($_POST["save_customer"])) {
    // issset digunakan untuk mengecek
    // apakah ketika mengakses file ini, dikirimkan
    // data dengan nama "save_customer" dengan method post

    // tampung data yang dikirimkan
    $action = $_POST["action"];
    $id_customer = $_POST["id_customer"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    $pass = $_POST["password"];

    // load file config.php
    include("config.php");

    // cek aksinya
    if ($action == "insert") {
      // Sintaks untuk Insert
      $sql = "insert into customer values ('$id_customer','$nama','$alamat','$kontak','$username','$pass')";
      // eksekusi perintah sql-nya
      mysqli_query($connect, $sql);
    } else if ($action == "update") {
      // Sintaks untuk update
      $sql = "update customer set
              nama='$nama',
              alamat='$alamat',
              kontak='$kontak',
              username='$username',
              password='$pass'
              where id_customer='$id_customer'";
      // eksekusi perintah sql-nya
      mysqli_query($connect, $sql);
    }

    // redirect ke halaman customer.php
    header("location:customer.php");
  }

  if (isset($_GET["hapus"])) {
    $id_customer = $_GET["id_customer"];
    $sql = "delete from customer
            where id_customer='$id_customer'";

    include("config.php");
  mysqli_query($connect, $sql);

  // direct ke halaman customer.php
  header("location:customer.php");
  }
 ?>
