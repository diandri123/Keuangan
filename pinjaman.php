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
        	<h3 class="m-0 font-weight-bold text-primary">Master Data Peminjaman</h3>
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              
               <a href="pinjaman_tambah.php" class="btn btn-primary "><i class="fa fa-plus"></i> Peminjaman</a>
            </div>
            
           
            <div class="card-body">

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
							<tr>
								<th width="1%">No</th>
								<th>Karyawan</th>
								<th>Tanggal Pinjaman</th>
								<th>Nominal</th>
								<th>Cicilan</th>
								<th>Keterangan</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>

						<?php
			            	$res=mysqli_query($connect,"SELECT * FROM tbl_peminjaman,tbl_marketing where tbl_peminjaman.NIK=tbl_marketing.NIK") or die(mysqli_error());
			                    
			                 $no = 1;
			                 while($d = mysqli_fetch_array($res) ){
			             ?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $d['nama_karyawan']?></td>
						<td><?php echo $d['tgl_pinjam']?></td>
						<td><?php echo "Rp.".number_format($d['nominal'])?></td>
						<td><?php echo number_format($d['cicilan'])?></td>
						<td><?php echo $d['ket']?></td>
						<td>
							<a href=pinjaman_edit.php?id_peminjaman=<?php echo $d['id_peminjaman']; ?>" class="btn btn-sm btn-warning "><i class="fa fa-wrench"></i></a>
							<a href="proses/pinjaman_hapus.php?id_peminjaman=<?php echo $d['id_peminjaman']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
						</td> 
					</tr>
					<?php
						}
					?>
					</tbody>
                </table>
              </div>
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

