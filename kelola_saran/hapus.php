<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();
$kueri = mysqli_query($koneksi, "select * from tbsaran where id_saran='".$_GET['id_saran']."';");
if(mysqli_num_rows($kueri) < 1) header('Location:saran.php');
else {
	$kueri = mysqli_query($koneksi, "delete from tbsaran where id_saran='".$_GET['id_saran']."';");
	if($kueri) header('Location:saran.php');
	}
?>
