<?php
include 'config/koneksi.php';
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
if(isset($_POST['cetak'])){
    $bulan = $_POST['bln'];
 $tahun = $_POST['thn'];
 $id_kategori = $_POST['id_kategori'];
$dompdf = new Dompdf();
$html = "<center><h3>Laporan Riwayat Transaksi Bulan ".$bulan."  ".$tahun."</h3></center><hr/><br/>";
$html .= '<table border="0" width="100%">
        <tr align="center">
            <th>No</th>
            <th>Tipe</th>
            <th>Tanggal</th>
            <th>Kategori</th>
            <th>Detail</th>
            <th>Kredit</th>
            <th>Debit</th>
            <th>Saldo</th>
            <th>Keterangan</th>
        </tr>';
$query = mysqli_query($connect,"select *, (SELECT saldo_awal+SUM(kredit)-SUM(debit) FROM tbl_transaksi b,tbl_saldo_awal WHERE b.id_transaksi <= a.id_transaksi) AS b from tbl_transaksi a,tbl_kategori where a.id_kategori=tbl_kategori.id_kategori and date_format(tanggal,'%M')= '$bulan' and YEAR(tanggal)= '$tahun' and a.id_kategori='$id_kategori'");
$no = 1;
while($row = mysqli_fetch_array($query))
{
    if ($row['tipe'] == 'Pengeluaran') {
       $html .= "<tr align='center' style='color:red';>
        <td>".$no."</td>
        <td>".$row['tipe']."</td>
        <td>".$row['tanggal']."</td>
        <td>".$row['kategori']."</td>
        <td>".$row['detail']."</td>
        <td>Rp. ".number_format($row['kredit'])."</td>
        <td>Rp. ".number_format($row['debit'])."</td>
        <td>Rp. ".number_format($row['b'])."</td>
        <td>".$row['keterangan']."</td>
    </tr>";
    $no++;
    }
    else {
        $html .= "<tr align='center'>
        <td>".$no."</td>
        <td>".$row['tipe']."</td>
        <td>".$row['tanggal']."</td>
        <td>".$row['kategori']."</td>
        <td>".$row['detail']."</td>
        <td>Rp. ".number_format($row['kredit'])."</td>
        <td>Rp. ".number_format($row['debit'])."</td>
        <td>Rp. ".number_format($row['b'])."</td>
        <td>".$row['keterangan']."</td>
    </tr>";
    $no++;
    }
}
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A5', 'landscape');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan Riwayat Transaksi.pdf');
}
?>