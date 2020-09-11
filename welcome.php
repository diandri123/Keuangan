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

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            
          </div>

          <?php 
          include 'config/koneksi.php';
          include 'config/ubah_tanggal.php';
          ?>

           

          <!-- Content Row -->
          <div class="container-fluid">

            <!-- Content Column -->
            <div class="card-body">

            <!-- Bar Chart -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Pemasukan & Pengeluaran</h6>  
                </div>
                <div class="card-body">
                    <canvas id="myBarChart"></canvas>                    
                </div>
              </div>

            <!-- <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Saldo</h6>  
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>                    
                </div>
              </div>-->
            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include "layout/footer.php" ?>
    <script>
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [ <?php 
        $tahun = date('Y');
        $query_bulan = mysqli_query($connect,"SELECT date_format(tanggal,'%M') as bulan FROM tbl_transaksi WHERE YEAR(tanggal)='$tahun' GROUP BY MONTH(tanggal) ");
          while ($p = mysqli_fetch_array($query_bulan)) { echo '"' . $p['bulan'] . '",';}
          ?>],
    datasets: [{
      label: "Grafik Pemasukan",
      backgroundColor: "#4e73df",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: [ <?php 
          $tahun = date('Y');
          $query_tahun = mysqli_query($connect,"SELECT SUM(kredit) total FROM tbl_transaksi WHERE YEAR(tanggal) between '$tahun' and '$tahun' GROUP BY MONTH(tanggal)");
          while ($p = mysqli_fetch_array($query_tahun)) { echo '"' . $p['total'] . '",';}
          ?>],
    },{

      label: "Grafik Pengeluaran",
      backgroundColor: "red",
      hoverBackgroundColor: "red",
      borderColor: "red",
      data: [ <?php 
          $tahun = date('Y');
          $query_tahun = mysqli_query($connect,"SELECT SUM(debit) total FROM tbl_transaksi WHERE YEAR(tanggal) between '$tahun' and '$tahun' GROUP BY MONTH(tanggal)");
          while ($p = mysqli_fetch_array($query_tahun)) { echo '"' . $p['total'] . '",';}
          ?>],
    }],
  },

  options: {
    maintainAspectRatio: true,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: true,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 12
        },
        maxBarThickness: 30,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          maxTicksLimit: 6,
          padding: 10,
          // Include a Rp sign in the ticks
          callback: function(value, index, values) {
            return 'Rp' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: true
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': Rp' + number_format(tooltipItem.yLabel);
        }
      }
    },
  }
});
  </script>
    
