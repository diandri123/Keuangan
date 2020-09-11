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
        	<h3 class="m-0 font-weight-bold text-primary">Riwayat Transaksi</h3>
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              

            </div>
            
           
            <div class="card-body">

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
							<tr>
								<th width="1%">No</th>
								<th>Tanggal</th>
								<th>Tipe</th>
								<th>Kategori</th>
								<th>Detail</th>
								<th>Kredit</th>
								<th>Debit</th>
								<th>Saldo</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>

						<?php
			            	$res=mysqli_query($connect,"SELECT *,MONTH(tanggal) as bulan, YEAR(tanggal) as tahun, (SELECT saldo_awal+SUM(kredit)-SUM(debit) FROM tbl_transaksi b,tbl_saldo_awal WHERE b.id_transaksi <= a.id_transaksi) AS b  FROM tbl_transaksi a,tbl_kategori where a.id_kategori=tbl_kategori.id_kategori ORDER BY id_transaksi ASC") or die(mysqli_error($res));
			                    
			                 $no = 1;
			                 while($d = mysqli_fetch_array($res) ){
			             ?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $d['tanggal']?></td>
						<td><?php echo $d['tipe']?></td>
						<td><?php echo $d['kategori']?></td>
						<td><?php echo $d['detail']?></td>
						<td><?php echo "Rp.".number_format($d['kredit'])?></td>
						<td><?php echo "Rp.".number_format($d['debit'])?></td>
						<td><?php echo "Rp.".number_format($d['b'])?></td>
						<td><?php echo $d['keterangan']?></td>

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

