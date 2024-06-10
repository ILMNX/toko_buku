<?php
  session_start();
  if (!isset($_SESSION["id_admin"])) {
    header("location:../login_admin.php");
  }

   include("counter.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>visitor Counter | Toko buku</title>
	<style type="text/css">
		.container{margin: auto; width: 550px;}
		h3{text-align: center}
		td{text-align: center;}
		p{font-weight: bold; color: red}
		.table1{margin-bottom: 10px;}
	</style>
  <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
  <!-- css-bootstrap -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <!-- js-bootstrap -->
  <script src="../assets/js/jquery.js"></script>
  <script src="../assets/js/popper.js"></script>
  <script src="../assets/js/bootstrap.js"></script>
</head>
<body>
  <!-- Start-Navbar -->
  <!-- start header-menu -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light position-sticky fixed-top mb-2">
     <div class="container">
         <a class="navbar-brand" href="#" style="font-family: 'Shadows Into Light', cursive; font-size: 170%;">Toko Buku</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNavDropdown">
           <div class="navbar-nav">
             <a class="nav-item nav-link" href="../admin.php">Admin</a>
             <a class="nav-item nav-link" href="../customer.php">Customer</a>
             <a class="nav-item nav-link" href="../buku.php">Buku</a>
           </div>
             <ul class="navbar-nav ml-auto">
               <li class="nav-item dropdown">
                 <a class="nav-link active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <?php echo $_SESSION["nama"]; ?>
                 </a>
                 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <a class="dropdown-item" href="#">Profile</a>
                   <a class="dropdown-item" href="#">Setting</a>
                   <a class="dropdown-item bg-dark text-light" href="../admin/process_login_admin.php?logout=true">Logout</a>
                 </div>
               </li>
             </ul>
         </div>
     </div>
   </nav>
  <!-- end header-menu -->

  <!-- End-Navbar -->
<div class="container">
	<header>
		<h3>Jumlah Pengunjung Toko Buku</h3>
	</header>
	<article>
    <h5 class="text-center">// Data Pengunjung Hari Ini</h5>
    <table border="1" cellspacing="0" class="table1 text-center mx-auto">
    	<tr>
    		<th>Browser</th>
    		<th>Ip<br>Address</th>
    		<th>Hari ini</th>
    		<th>Kemarin</th>
    		<th>Total<br>Mengunjungi</th>
    	</tr>

    	<tr>
    		<td>
    			<?php
    			 switch($browser){
    			 case "Firefox" : echo "".$browser."";
    			 	break;
    			 case "Chrome/Opera" : echo "".$browser."";
    			 	break;
    			 case "IE" : echo "".$browser."";
    			 	break;
    			 } ?>
    		</td>
    		<td>
    			<?php echo "".$_SERVER['REMOTE_ADDR']."";?>
    		</td>
    		<td>
    			 <p><?php echo "".$hari_ini['hari_ini'].""; ?></p>
    		</td>
    		<td>
    			<p><?php echo "".$kemarin['kemarin'].""; ?></p>
    		</td>
    		<td>
    			<p><?php echo "".$sql['total']."";?></p>
    		</td>
    	</tr>
    </table>

    <h5 class="text-center">//Database Pengunjung</h5>
    <table border ="1" class="table2 text-center mx-auto" cellspacing="0">
    	<tr>
    		<th>No</th>
    		<th>id</th>
    		<th>tanggal</th>
    		<th>Browser</th>
    		<th>Jumlah<br>Pegunjung</th>

    	</tr>

    	<?php $no=0; ?>
    	<?php $sql="SELECT * FROM counterdb";
    		  $sqli=mysqli_query($connect,$sql);

    		  $total = mysqli_fetch_array(mysqli_query($connect,'SELECT sum(counter) as jumlah FROM counterdb'));
    	 ?>
    	 <?php while ($tampil=mysqli_fetch_array($sqli)) {  ?>
    	 <?php $no++;?>
    	<tr>
    		<td>
    			<?php echo "$no"; ?>
    		</td>
    		<td>
    			<?php echo "$tampil[id]";?>
    		</td>
    		<td>
    			<?php echo "$tampil[tanggal]";?>
    		</td>
    		<td>
    			<?php echo "$tampil[browser]";?>
    		</td>
    		<td>
    			<?php echo "$tampil[counter]";?>
    		</td>
    		<?php }?>
    	</tr>
    	<td colspan="4"> Total</td>
    	<td>
    			<p><?php echo "".$total['jumlah']."";?></p>
    		</td>
    </table>
	</article>
  <a href="counter.php" class="text-center col-sm-4">Test Visitor</a>
</div>
</body>
</html>
