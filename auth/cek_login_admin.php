<?php
session_start(); // Mulai sesi

include("../config.php");

// Cek apakah form login telah disubmit
if (isset($_POST["login_admin"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Buat query untuk mengecek apakah username dan password sesuai
  $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
  $result = mysqli_query($connect, $sql);

  if (mysqli_num_rows($result) > 0) {
    // Login berhasil
    $row = mysqli_fetch_assoc($result);
    $_SESSION['id_admin'] = $row['id_admin'];
    $_SESSION['username'] = $row['username'];
    
    header("location:../admin.php"); // Redirect ke halaman admin
  } else {
    // Login gagal
    echo "<script>alert('Username atau password salah'); window.location.href='login.php';</script>";
  }
}

// Cek apakah form untuk menyimpan admin telah disubmit
if (isset($_POST["save_admin"])) {
  $action = $_POST["action"];
  $id_admin = $_POST["id_admin"];
  $nama = $_POST["nama"];
  $kontak = $_POST["kontak"];
  $username = $_POST["username"];
  $pass = $_POST["password"];

  // Jika action adalah insert
  if ($action == "insert") {
    $sql = "INSERT INTO admin VALUES ('$id_admin', '$nama', '$kontak', '$username', '$pass')";
    mysqli_query($connect, $sql);
  } 
  // Jika action adalah update
  else if ($action == "update") {
    $sql = "UPDATE admin SET
            nama='$nama',
            kontak='$kontak',
            username='$username',
            password='$pass'
            WHERE id_admin='$id_admin'";
    mysqli_query($connect, $sql);
  }

  // Redirect ke halaman admin setelah menyimpan
  header("location:../admin.php");
}

// Cek apakah ada permintaan untuk menghapus admin
if (isset($_GET["hapus"])) {
  $id_admin = $_GET["id_admin"];
  $sql = "DELETE FROM admin WHERE id_admin='$id_admin'";
  mysqli_query($connect, $sql);

  // Redirect ke halaman admin setelah menghapus
  header("location:../admin.php");
}
?>
