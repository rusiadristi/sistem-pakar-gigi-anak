<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();

/*
$kueri = mysqli_query($koneksi, "select * from rule where id_rule='".$_GET['id_rule']."';");
if(mysqli_num_rows($kueri) < 1) header('Location:rule.php');
else {
	$kueri = mysqli_query($koneksi, "delete from rule where id_rule='".$_GET['id_rule']."';");
	if($kueri) header('Location:rule.php');
	}
	*/
	
	
	

	$q=mysqli_query($koneksi,"delete from rule where id_rule='".$_GET['id_rule']."';");
	
	if($q){
	  header('Location:rule.php');
	}else{
	echo "delete from rule where id_rule='".$_GET['id_rule']."';";
	}
	
	
	
	
?>
