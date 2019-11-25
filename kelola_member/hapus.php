<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();
$kueri = mysqli_query($koneksi, "select * from tbuser where id_user='".$_GET['id_user']."';");
if(mysqli_num_rows($kueri) < 1) header('Location:member.php');
else {
	$kueri = mysqli_query($koneksi, "delete from tbuser where id_user='".$_GET['id_user']."';");
	if($kueri) header('Location:member.php');
	}
?>
