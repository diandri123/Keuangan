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
        	<h3 class="m-0 font-weight-bold text-primary">Tambah Data Peminjaman</h3>
         <div class="card shadow mb-4">
            <div class="card-body">
			<a href="pinjaman.php" class="btn btn-primary btn-sm ">Kembali</a><br><br>

				<form action="proses/pelunasan_tambah_aksi.php" method="post">
				<div class="form-group">
					<label>Pilih Karyawan</label>
					<select name="NIK" id="karyawan" class="form-control">
						<option>---Pilih Karyawan---</option>
						<?php
			            	$res=mysqli_query($connect,"SELECT * FROM tbl_marketing") or die(mysqli_error());
			                    
			                while($d = mysqli_fetch_array($res) ){
			            ?>
						<option value="<?php echo $d['NIK']; ?>"><?php echo $d['nama_karyawan']; ?></option>
						<?php
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Pilih Pinjaman</label>
					<select name="id_peminjaman" id="pinjaman" class="form-control">
						<option>---Pilih Pinjaman---</option>
						<?php
			            	$res=mysqli_query($connect,"SELECT * FROM tbl_peminjaman INNER JOIN tbl_marketing ON tbl_marketing.NIK = tbl_peminjaman.NIK ") or die(mysqli_error());
			                    
			                while($d = mysqli_fetch_array($res) ){
			            ?>
						 <option id="pinjaman" class="<?php echo $d['NIK']; ?>" value="<?php echo $d['id_peminjaman']; ?>">
                          <?php echo $d['tgl_pinjam']; ?> | <?php echo $d['nominal']; ?> | <?php echo $d['cicilan']; ?>
                      </option>
						<?php
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Tanggal Bayar</label>
					<input type="date" name="tgl_bayar" required="required" class="form-control" >
				</div>
				<div class="form-group">
					<label>Jumlah Bayar</label>
					<input type="number" name="nominal" required="required" class="form-control" >
				</div>
				<div class="form-group">
					<label>Cicilan</label>
					<input type="number" name="cicilan" required="required" class="form-control" >
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
<script src="assets/js/jquery-chained.min.js"></script>
 <script>
  $(document).ready(function() {
   $("#pinjaman").chained("#karyawan");
  });
 </script>

