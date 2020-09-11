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
        	<h3 class="m-0 font-weight-bold text-primary">Tambah Data Pengeluaran</h3>
         <div class="card shadow mb-4">
            <div class="card-body">
			<a href="pengeluaran.php" class="btn btn-primary btn-sm ">Kembali</a><br><br>

				<form action="proses/pengeluaran_tambah_aksi.php" method="post">

				<div class="form-group">
					<label>Tanggal</label>
					<input type="date" name="tanggal" required="required" class="form-control" >
				</div>
				
				<div class="form-group">
					<label>Kategori</label>
					<select name="id_kategori" class="form-control">
						<option>----Pilih----</option>
						<?php
			            	$res=mysqli_query($connect,"SELECT * FROM tbl_kategori where kat_trans = 'Pengeluaran' ORDER BY id_kategori ASC") or die(mysqli_error());
			                    
			                while($d = mysqli_fetch_array($res) ){
			            ?>
						<option value="<?php echo $d['id_kategori']; ?>"><?php echo $d['kategori']; ?></option>
						<?php
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Detail</label>
					<input type="text" name="detail" required="required" class="form-control" >
				</div>
				<div class="form-group">
					<label>Debit</label>
					<input type="number" name="debit" required="required" class="form-control" >
				</div>

				<div class="form-group">
					<label>Keterangan</label>
					<input type="text" name="keterangan" required="required" class="form-control">
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

