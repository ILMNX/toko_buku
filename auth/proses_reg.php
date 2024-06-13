<?php
session_start();
include("../config.php");

if (isset($_POST["registrasi_customer"])) {
  $nama = $_POST["nama"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Lakukan validasi atau sanitasi data jika diperlukan

  // Cek apakah username sudah digunakan
  $sql_check_username = "SELECT * FROM customer WHERE username = '$username'";
  $query_check_username = mysqli_query($connect, $sql_check_username);
  if (mysqli_num_rows($query_check_username) > 0) {
    // Username sudah terdaftar, beri pesan error atau arahkan kembali ke halaman registrasi
    $_SESSION["error"] = "Username sudah digunakan, silakan gunakan username lain.";
    header("location:registrasi_customer.php");
    exit();
  }

  // Query untuk menyimpan data customer baru
  $sql_registrasi = "INSERT INTO customer (nama, username, password) VALUES ('$nama', '$username', '$password')";
  if (mysqli_query($connect, $sql_registrasi)) {
    // Registrasi berhasil, arahkan ke halaman login
    $_SESSION["success"] = "Registrasi berhasil, silakan login.";
    header("location:login_customer.php");
    exit();
  } else {
    // Gagal menyimpan data, beri pesan error atau arahkan kembali ke halaman registrasi
    $_SESSION["error"] = "Registrasi gagal, silakan coba lagi.";
    header("location:registrasi_customer.php");
    exit();
  }
} else {
  // Jika tidak ada data POST, arahkan kembali ke halaman registrasi
  header("location:registrasi_customer.php");
  exit();
}
?>
