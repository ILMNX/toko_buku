<?php
  $host = "localhost"; 
  $user = "root";
  $password = "";
  $db = "toko_buku";
  $connect = mysqli_connect($host,$user,$password,$db);

  
  if(mysqli_connect_errno()){
    echo mysqli_connect_errno();
  } else {
  }
 ?>
