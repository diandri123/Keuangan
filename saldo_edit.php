<?php
	session_start(); // Start session nya

	// Kita cek apakah user sudah login atau belum
	// Cek nya dengan cara cek apakah terdapat session username atau tidak
	if( ! isset($_SESSION['username'])){ // Jika tidak ada session username berarti dia belum login
		header("location: index.php"); // Kita Redirect ke halaman index.php karena belum login
	}
?>
<?php include "config/koneksi.php"; ?>
<?php include "config/ubah_tanggal.php"; ?>

    <!-- Sidebar -->
    <?php include "layout/sidebar.php"?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
       <?php include "layout/header.php" ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
        	<h3 class="m-0 font-weight-bold text-primary">Edit Data Kategori</h3>
         <div class="card shadow mb-4">
            <div class="card-body">
			<a href="saldo.php" class="btn btn-primary btn-sm ">Kembali</a><br><br>
			<?php 
			$id_saldo = $_GET['id_saldo'];
            $query=mysqli_query($connect,"SELECT * FROM tbl_saldo_awal where id_saldo = '$id_saldo'") or die(mysqli_error());
            $p = mysqli_fetch_array($query);
            ?>

				<form action="proses/saldo_edit_aksi.php" method="post">


				<div class="form-group">
					<label>Saldo Awal</label>
					<input type="number" name="saldo_awal" required="required" class="form-control" value="<?php echo $p['saldo_awal']?>">
					<input type="hidden" name="id_saldo" value="<?php echo $p['id_saldo']?>" >
				</div>
				
				<input type="submit" name="submit" value="Simpan" class="btn btn-primary btn-sm">

			</form>
              
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <?php include "layout/footer.php" ?>
      <!-- End of Footer -->
>

