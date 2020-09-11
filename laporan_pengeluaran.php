<?php
session_start(); // Start session nya

// Kita cek apakah user sudah login atau belum
// Cek nya dengan cara cek apakah terdapat session username atau tidak
if( ! isset($_SESSION['username'])){ // Jika tidak ada session username berarti dia belum login
  header("location: index.php"); // Kita Redirect ke halaman index.php karena belum login
}
?>
<script type="text/javascript" src="assets/js/Chart.js"></script>
<?php include "layout/sidebar.php" ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
       <?php include "layout/header.php" ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <h3 class="m-0 font-weight-bold text-primary">Laporan Pengeluaran</h3>
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <form method="post" action="cetak_laporan_pengeluaran.php">
              <?php 
                include 'config/koneksi.php';
                include 'config/ubah_tanggal.php';
               ?>
              <label>Bulan : 
              <select name="bln" class="form-group" required="required">
               <option>---Pilih Bulan---</option>
                <?php
                    $res=mysqli_query($connect,"SELECT date_format(tanggal,'%M') as bulan FROM tbl_transaksi GROUP BY MONTH(tanggal)") or die(mysqli_error());      
                      while($d = mysqli_fetch_array($res) ){
                  ?>
                <option value="<?php echo $d['bulan']; ?>"><?php echo $d['bulan']; ?></option>
                <?php
               }
                ?>
               </select></label>
               <label>Tahun : 
              <select name="thn" required="required">
               <option>---Pilih Tahun---</option>
                <?php
                    $res=mysqli_query($connect,"SELECT date_format(tanggal,'%Y') as tahun FROM tbl_transaksi GROUP BY YEAR(tanggal)") or die(mysqli_error());      
                      while($d = mysqli_fetch_array($res) ){
                  ?>
                <option value="<?php echo $d['tahun']; ?>"><?php echo $d['tahun']; ?></option>
                <?php
               }
                ?>
               </select></label>
              <label>Kategori
          <select name="id_kategori" >
            <option>---Pilih Kategori---</option>
            <?php
                    $res=mysqli_query($connect,"SELECT * FROM tbl_kategori where kat_trans = 'Pengeluaran' ORDER BY id_kategori ASC") or die(mysqli_error());
                          
                      while($d = mysqli_fetch_array($res) ){
                  ?>
            <option value="<?php echo $d['id_kategori']; ?>"><?php echo $d['kategori']; ?></option>
            <?php
            }
            ?>
          </select></label>
               <button type="submit" value="Lihat" name="cetak" class="btn btn-primary " >Cetak</button></form>
            </div>

          
            <!-- Content Column -->
           
          </div>
    </div>
  </div>

      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include "layout/footer.php" ?>

      <!-- End of Footer -->

