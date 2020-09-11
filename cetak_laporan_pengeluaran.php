<?php
include 'config/koneksi.php';
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
if(isset($_POST['cetak'])){
    $bulan = $_POST['bln'];
 $tahun = $_POST['thn'];
 $id_kategori = $_POST['id_kategori'];
$dompdf = new Dompdf();
$query = mysqli_query($connect,"select *, debit-saldo as saldo_akhir from tbl_pengeluaran,tbl_kategori where tbl_pengeluaran.id_kategori=tbl_kategori.id_kategori and date_format(tanggal,'%M')= '$bulan' and YEAR(tanggal)= '$tahun' and tbl_pengeluaran.id_kategori='$id_kategori'");
$html = "<center><h3>Laporan Pemasukan Bulan".$bulan." ".$tahun."</h3></center><hr/><br/>";
$html .= '<table border="0" width="100%">
        <tr align="center">
            <th>No</th>
            <th>Tanggal</th>
            <th>Kategori</th>
            <th>Detail</th>
            <th>Debit</th>
            <th>Saldo Awal</th>
            <th>Saldo Akhir</th>
            <th>Keterangan</th>
        </tr>';
$no = 1;
while($row = mysqli_fetch_array($query))
{
    $html .= "<tr align='center'>
        <td>".$no."</td>
        <td>".$row['tanggal']."</td>
        <td>".$row['kategori']."</td>
        <td>".$row['detail']."</td>
        <td>Rp. ".number_format($row['Debit'])."</td>
        <td>Rp.".number_format($row['saldo'])."</td>
        <td>Rp. ".number_format($row['saldo_akhir'])."</td>
        <td>".$row['keterangan']."</td>
    </tr>";
    $no++;
}
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A5', 'landscape');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('Laporan Pengeluaran.pdf');
}
?>