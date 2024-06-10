<?php
  session_start();

  include("../config.php");

  $username = $_POST["username"];
  $password = $_POST["password"];

  if (isset($_POST["login_customer"])) {
    $sql = "select * from customer
            where username = '$username'
            and password = '$password'";
    $query = mysqli_query($connect, $sql);
    $jumlah = mysqli_num_rows($query);

    if ($jumlah > 0) {

      $customer = mysqli_fetch_array($query);

      $_SESSION["id_customer"] = $customer["id_customer"];
      $_SESSION["nama"] = $customer["nama"];

      $_SESSION["cart"] = array();

      header("location:../index.php");
    } else{

      header("location:login_customer.php");
    }
  }

  if (isset($_GET["logout"])) {
    session_destroy(); 

    header("location:login_customer.php"); // Redirect
  }
 ?>
