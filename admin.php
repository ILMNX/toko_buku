<?php
  session_start();
  if (!isset($_SESSION["id_admin"])) {
    header("location:auth/login_admin.php");
  }

  include("config.php");
  include("counter/counter.php");

  $jumlah_admin = mysqli_query($connect, "SELECT * FROM admin");
  $jumlah_customer = mysqli_query($connect, "SELECT * FROM customer");
  $jumlah_buku = mysqli_query($connect, "SELECT * FROM buku");

  // Hitung jumlah data
  $total_admin = mysqli_num_rows($jumlah_admin);
  $total_customer = mysqli_num_rows($jumlah_customer);
  $total_buku = mysqli_num_rows($jumlah_buku);

  // Query untuk hari ini
  $query_hari_ini = mysqli_query($connect, "SELECT COUNT(*) as hari_ini FROM counterdb WHERE DATE(tanggal) = CURDATE()");
  $hari_ini = mysqli_fetch_assoc($query_hari_ini);

  // Query untuk kemarin
  $query_kemarin = mysqli_query($connect, "SELECT COUNT(*) as kemarin FROM counterdb WHERE DATE(tanggal) = CURDATE() - INTERVAL 1 DAY");
  $kemarin = mysqli_fetch_assoc($query_kemarin);

  // Query untuk total pengunjung
  $jumlah_totalpengunjung = mysqli_query($connect, "SELECT * FROM counterdb");
  $total_pengunjung = mysqli_num_rows($jumlah_totalpengunjung);
  ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Toko Buku</title>
    <!-- css-bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- js-bootstrap -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script type="text/javascript">
      Add = () =>{
        document.getElementById('action').value = "insert";
        document.getElementById('id_admin').value = "";
        document.getElementById('nama').value = "";
        document.getElementById('kontak').value = "";
        document.getElementById('username').value = "";
        document.getElementById('password').value = "";
      }
      Edit = (item) =>{
        document.getElementById('action').value = "update";
        document.getElementById('id_admin').value = item.id_admin;
        document.getElementById('nama').value = item.nama;
        document.getElementById('kontak').value = item.kontak;
        document.getElementById('username').value = item.username;
        document.getElementById('password').value = item.password;
      }
    </script>
    <!-- js-chart -->
    <script type="text/javascript" src="chartjs/Chart.js"></script>

    <script>
      $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
      });
    </script>
  </head>
  <body>
    <!-- Start-Navbar -->
    <?php
      include("navbar_admin.php");
    ?>
    <!-- End-Navbar -->

    <?php
      
      if (isset($_POST["find"])) {
        
        $find = $_POST["find"];
        $sql = "select * from admin
                where id_admin like '%$find%'
                or kontak like '%$find%'
                or nama like '%$find%'
                or username like '%$find%'
                or password like '%$find%'";
      } else {
        
        $sql = "select * from admin";
      }
      
      
      $query = mysqli_query($connect, $sql);
     ?>

    <div class="container">
      <!-- Start-chart -->
      <div class="mb-2 row">
        <div class="col-sm-6" style="position: relative; width:35vw">
          <canvas id="user"></canvas>
          <div class="row d-flex justify-content-center">
              <p class="mr-3">Admin: <?php echo $total_admin; ?> </p>
              <p class="mr-3">Customer: <?php echo $total_customer; ?></p>
              <p>Buku: <?php echo $total_buku; ?></p>
          </div>
              
        </div>
        <div class="col-sm-6" style="position: relative; width:35vw">
          <canvas id="visitor"></canvas>
          <div class="row d-flex justify-content-center">
            <p class="mr-3">Hari Ini: <?php echo $hari_ini['hari_ini'] ?? 0; ?></p>
            <p class="mr-3">Kemarin: <?php echo $kemarin['kemarin'] ?? 0; ?></p>
            <p>Total Pengunjung: <?php echo $total_pengunjung; ?></p>
        </div>
        </div>
      </div>

      <!-- js-user -->
    	<script>
    		var ctx = document.getElementById("user").getContext('2d');
    		var myChart = new Chart(ctx, {
    			type: 'doughnut',
    			data: {
    				labels: ["Admin","Customer","Buku"],
    				datasets: [{
    					label: 'Chart jumlah user',
    					data: [
                <?php
					       $jumlah_admin = mysqli_query($connect,"select * from admin");
					       echo mysqli_num_rows($jumlah_admin);
					     ?>,
                <?php
					       $jumlah_customer = mysqli_query($connect,"select * from customer");
					       echo mysqli_num_rows($jumlah_customer);
					     ?>,
               <?php
                $jumlah_buku = mysqli_query($connect,"select * from buku");
                echo mysqli_num_rows($jumlah_buku);
              ?>
              ],
    					backgroundColor: [
    					'rgba(255, 99, 132, 0.2)',
    					'rgba(54, 162, 235, 0.2)',
    					'rgba(255, 206, 86, 0.2)',
    					'rgba(75, 192, 192, 0.2)',
    					'rgba(153, 102, 255, 0.2)',
    					'rgba(255, 159, 64, 0.2)'
    					],
    					borderColor: [
    					'rgba(255,99,132,1)',
    					'rgba(54, 162, 235, 1)',
    					'rgba(255, 206, 86, 1)',
    					'rgba(75, 192, 192, 1)',
    					'rgba(153, 102, 255, 1)',
    					'rgba(255, 159, 64, 1)'
    					],
    					borderWidth: 1
    				}]
    			},
    			options: {
    				scales: {
    					yAxes: [{
    						ticks: {
    							beginAtZero:true
    						}
    					}]
    				}
    			}
    		});
    	</script>

      <!-- js-visitor -->
      <script>
    		var ctx = document.getElementById("visitor").getContext('2d');
    		var myChart = new Chart(ctx, {
    			type: 'pie',
    			data: {
    				labels: ["Total Pengunjung","Kemarin","Hari Ini"],
    				datasets: [{
    					label: 'Jumlah Visitor',
    					data: [
                <?php
					       $jumlah_totalpengunjung = mysqli_query($connect,"select * from counterdb");
					       echo mysqli_num_rows($jumlah_totalpengunjung);
					      ?>,
                <?php
                 echo $kemarin['kemarin'];
                ?>,
                <?php
                  echo $hari_ini['hari_ini'];
                ?>
              ],
    					backgroundColor: [
    					'rgba(255, 99, 132, 0.2)',
    					'rgba(54, 162, 235, 0.2)',
    					'rgba(255, 206, 86, 0.2)',
    					'rgba(75, 192, 192, 0.2)',
    					'rgba(153, 102, 255, 0.2)',
    					'rgba(255, 159, 64, 0.2)'
    					],
    					borderColor: [
    					'rgba(255,99,132,1)',
    					'rgba(54, 162, 235, 1)',
    					'rgba(255, 206, 86, 1)',
    					'rgba(75, 192, 192, 1)',
    					'rgba(153, 102, 255, 1)',
    					'rgba(255, 159, 64, 1)'
    					],
    					borderWidth: 1
    				}]
    			},
    			options: {
    				scales: {
    					yAxes: [{
    						ticks: {
    							beginAtZero:true
    						}
    					}]
    				}
    			}
    		});
    	</script>
      <!-- End-chart -->

      <!-- card -->
      <div class="card">
        <div class="card-header bg-success text-light text-center">
          <h4>User Admin</h4>
        </div>
        <!-- start-body -->
        <div class="card-body">
          <div class="overflow-auto">
            <!-- start-search -->
            <form action="admin.php" method="post">
              <input type="text" name="find" class="form-control mb-2 col-sm-3 float-right" placeholder="Pencarian...">
            </form>
            <!-- end-search -->
            <table class="table border text-center">
              <thead>
                <th>No.</th>
                <th>ID Admin</th>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Username</th>
                <th>Password</th>
                <th>Option</th>
              </thead>
              <tbody>
                <?php
                  $number = 1;
                  foreach ($query as $admin): ?>
                  <tr>
                    <td>
                      <?php echo $number ?>
                    </td>
                    <td><?php echo $admin["id_admin"] ?></td>
                    <td><?php echo $admin["nama"] ?></td>
                    <td><?php echo $admin["kontak"] ?></td>
                    <td><?php echo $admin["username"] ?></td>
                    <td><?php echo $admin["password"] ?></td>
                    <td>
                      <button type="button" name="Edit" class="btn btn-sm btn-info"
                              data-toggle="modal" data-target="#modal_admin"
                              onclick='Edit(<?php echo json_encode($admin);?>)'>Edit</button>

                      <a href="process_crud_admin.php?hapus=true&id_admin=<?php echo $admin["id_admin"];?>"
                          onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')">
                          <button type="button" name="Hapus" class="btn btn-sm btn-danger"
                                  data-toggle="modal" data-target="#modal_admin"
                                  onclick="Hapus(<?php ?>);">
                            Hapus
                          </button>
                      </a>
                    </td>
                  </tr>
                <?php $number++; endforeach; ?>
              </tbody>
            </table>
            </div>
          <button type="button" name="btnTambah" class="btn btn-sm btn-success float-right"
                  data-toggle="modal" data-target="#modal_admin" onclick="Add();">Tambah Data</button>
        </div>
        <!-- end-body -->

        <!-- start-footer -->
        <div class="card-footer text-center">
          
        </div>
        <!-- end-footer -->
      </div>
      <!-- end card -->
      <!-- Start Modal -->
      <div class="modal fade" id="modal_admin">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <form action="process_crud_admin.php" method="post">
                <div class="modal-header bg-danger text-light">
                  <h4 class="modal-title">Form Admin</h4>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="action" id="action">
                  id_admin
                  <input type="number" name="id_admin" id="id_admin" class="form-control" required />
                  Nama
                  <input type="text" name="nama" id="nama" class="form-control" required />
                  Kontak
                  <input type="text" name="kontak" id="kontak" class="form-control" required />
                  Username
                  <input type="text" name="username" id="username" class="form-control" required />
                  Password
                  <input type="text" name="password" id="password" class="form-control" required />
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" name="save_admin" class="btn btn-success">Simpan</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      <!-- End Modal -->
    </div>
  </body>
</html>
