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
        	<h3 class="m-0 font-weight-bold text-primary">Master Data Pelunasan</h3>
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              
               <a href="pelunasan_tambah.php" class="btn btn-primary "><i class="fa fa-plus"></i> Pelunasan</a>
            </div>
            
           
            <div class="card-body">

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
							<tr>
								<th width="1%">No</th>
								<th>Karyawan</th>
								<th>Tanggal Pinjaman</th>
								<th>Tanggal Bayar</th>
								<th>Nominal</th>
								<th>Cicilan</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>

						<?php
			            	$res=mysqli_query($connect,"SELECT *, tbl_pelunasan.nominal as jml_bayar, tbl_pelunasan.cicilan as jml_cicil  FROM tbl_pelunasan,tbl_peminjaman,tbl_marketing where tbl_pelunasan.NIK=tbl_marketing.NIK and tbl_peminjaman.id_peminjaman=tbl_pelunasan.id_peminjaman") or die(mysqli_error());
			                    
			                 $no = 1;
			                 while($d = mysqli_fetch_array($res) ){
			             ?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $d['nama_karyawan']?></td>
						<td><?php echo $d['tgl_pinjam']?></td>
						<td><?php echo $d['tgl_bayar']?></td>
						<td><?php echo "Rp.".number_format($d['jml_bayar'])?></td>
						<td><?php echo number_format($d['jml_cicil'])?></td>
						<td>
							<a href=pelunasan_edit.php?id_pelunasan=<?php echo $d['id_pelunasan']; ?>" class="btn btn-sm btn-warning "><i class="fa fa-wrench"></i></a>
							<a href="proses/pelunasan_hapus.php?id_pelunasan=<?php echo $d['id_pelunasan']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

