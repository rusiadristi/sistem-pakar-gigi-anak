<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();
$kueri = mysqli_query($koneksi, "select * from penyakit where id_penyakit='".$_GET['id_penyakit']."';");
if(mysqli_num_rows($kueri) < 1) header('Location:penyakit.php');
else {
	$kueri = mysqli_query($koneksi, "delete from penyakit where id_penyakit='".$_GET['id_penyakit']."';");
	if($kueri) header('Location:penyakit.php');
	}
?>
