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
        	<h3 class="m-0 font-weight-bold text-primary">Edit Data Pemasukan</h3>
         <div class="card shadow mb-4">
            <div class="card-body">
			<a href="pinjaman.php" class="btn btn-primary btn-sm ">Kembali</a><br><br>
			<?php 
			$id_peminjaman = $_GET['id_peminjaman'];
            $query=mysqli_query($connect,"SELECT * FROM tbl_peminjaman where id_peminjaman = '$id_peminjaman'") or die(mysqli_error());
            $p = mysqli_fetch_array($query);
            ?>

				<form action="proses/pinjaman_edit_aksi.php" method="post">
				<div class="form-group">
					<label>Nama Karyawan</label>
					<select name="NIK" class="form-control">
						<option >---Pilih Karyawan---</option>
						<?php
			            	$res=mysqli_query($connect,"SELECT * FROM tbl_marketing ") or die(mysqli_error());
			                    
			                while($d = mysqli_fetch_array($res) ){
			            ?>
						<option <?php if($p['NIK']==$d['NIK']){echo "selected='selected'";}?> value="<?php echo $d['NIK']; ?>"><?php echo $d['nama_karyawan']; ?></option>
						<?php
						}
						?>
					</select>
					<input type="hidden" name="id_peminjaman" value="<?php echo $p['id_peminjaman']?>" >
				</div>
				<div class="form-group">
					<label>Tanggal Pinjaman</label>
					<input type="date" name="tgl_pinjam" required="required" class="form-control" value="<?php echo $p['tgl_pinjam']?>">
				</div>
				<div class="form-group">
					<label>Jumlah Pinjaman</label>
					<input type="number" name="nominal" required="required" class="form-control" value="<?php echo $p['nominal']?>">
				</div>
				<div class="form-group">
					<label>Cicilan</label>
					<input type="number" name="cicilan" required="required" class="form-control" value="<?php echo $p['cicilan']?>">
				</div>	
				<div class="form-group">
					<label>Keterangan</label>
					<input type="text" name="keterangan" required="required" class="form-control" value="<?php echo $p['ket']?>">
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

