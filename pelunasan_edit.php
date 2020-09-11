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
        	<h3 class="m-0 font-weight-bold text-primary">Edit Data Pelunasan</h3>
         <div class="card shadow mb-4">
            <div class="card-body">
			<a href="pelunasan.php" class="btn btn-primary btn-sm ">Kembali</a><br><br>
			<?php 
			$id_pelunasan = $_GET['id_pelunasan'];
            $query=mysqli_query($connect,"SELECT * FROM tbl_pelunasan where id_pelunasan = '$id_pelunasan'") or die(mysqli_error());
            $p = mysqli_fetch_array($query);
            ?>

				<form action="proses/pelunasan_edit_aksi.php" method="post">
				<div class="form-group">
					<label>Pilih Karyawan</label>
					<select name="NIK" class="form-control" id="karyawan" >
						<option >---Pilih Karyawan---</option>
						<?php
			            	$res=mysqli_query($connect,"SELECT * FROM tbl_marketing") or die(mysqli_error());
			                    
			                while($d = mysqli_fetch_array($res) ){
			            ?>
						<option <?php if($p['NIK']==$d['NIK']){echo "selected='selected'";}?> value="<?php echo $d['NIK']; ?>"><?php echo $d['nama_karyawan']; ?></option>
						<?php
						}
						?>
					</select>
					<input type="hidden" name="id_pelunasan" value="<?php echo $p['id_pelunasan']?>" >
				</div>
				<div class="form-group">
					<label>Pilih Pinjaman</label>
					<select name="id_peminjaman" class="form-control" id="pinjaman" >
						<option >---Pilih Karyawan---</option>
						<?php
			            	$res=mysqli_query($connect,"SELECT * FROM tbl_peminjaman INNER JOIN tbl_marketing ON tbl_marketing.NIK = tbl_peminjaman.NIK ") or die(mysqli_error());
			                    
			                while($d = mysqli_fetch_array($res) ){
			            ?>
						<option id="pinjaman" class="<?php echo $d['NIK']; ?>"  <?php if($p['id_peminjaman']==$d['id_peminjaman']){echo "selected='selected'";}?> value="<?php echo $d['NIK']; ?>"><?php echo $d['tgl_pinjam']; ?> | <?php echo $d['nominal']; ?> | <?php echo $d['cicilan']; ?></option>
						<?php
						}
						?>
					</select>
					<input type="hidden" name="id_peminjaman" value="<?php echo $p['id_peminjaman']?>" >
				</div>
				<div class="form-group">
					<label>Tanggal Bayar</label>
					<input type="date" name="tgl_bayar" required="required" class="form-control" value="<?php echo $p['tgl_bayar']?>">
				</div>
				<div class="form-group">
					<label>Jumlah Bayar</label>
					<input type="number" name="nominal" required="required" class="form-control" value="<?php echo $p['nominal']?>">
				</div>
				<div class="form-group">
					<label>Cicilan</label>
					<input type="number" name="cicilan" required="required" class="form-control" value="<?php echo $p['cicilan']?>">
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

