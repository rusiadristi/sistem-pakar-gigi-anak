<?php
session_start();
include "../library.php";
cek_akses();
require_once "../koneksi.php";
$kueri = mysqli_query($koneksi, "select * from tbgejala where id_gejala='".$_GET['id_gejala']."';");
if(mysqli_num_rows($kueri) < 1) header('Location:gejala.php');
else {
	$kueri = mysqli_query($koneksi, "delete from tbgejala where id_gejala='".$_GET['id_gejala']."';");
	if($kueri) header('Location:gejala.php');
	}
?>
