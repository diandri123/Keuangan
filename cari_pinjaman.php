<?php
	include 'config/koneksi.php';
 
	echo "<option value=''>Pilih Provinsi</option>";
 
	$query = "SELECT * FROM tbl_marketing ORDER BY nama_marketing ASC";
	$dewan1 = $connect->prepare($query);
	$dewan1->execute();
	$res1 = $dewan1->get_result();
	while ($row = $res1->fetch_assoc()) {
		echo "<option value='" . $row['NIK'] . "'>" . $row['nama_karyawan'] . "</option>";
	}
?>