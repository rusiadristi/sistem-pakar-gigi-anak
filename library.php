<?php
function kode($tb,$fb,$kd){
	include "koneksi.php";
	$perintah="select $fb as 'kode' from {$tb} order by kode asc;";
	$run=mysqli_query($koneksi, $perintah);
	$hasil="";
	if(mysqli_num_rows($run) < 1) $hasil=$kd."01";
	else{
		while($isi=mysqli_fetch_array($run,MYSQLI_BOTH)){
			$kode=intval(substr($isi['kode'],-3));
			$kode++;
			if($kode<=9) $hasil="{$kd}0{$kode}";
			else if($kode<=99 && $kode>=10) $hasil="{$kd}0{$kode}";
			else if($kode<=999 && $kode>100) $hasil="{$kd}{$kode}";
			else $hasil="{$kd}{$kode}";
		}
	}
	mysqli_free_result($run);
	return $hasil;
}

function style($posisi=1){
	switch($posisi){
		case 1 : {
			include "template/style.php";
			break;
		}
		case 2 : {
			include "../template/style.php";
			break;
		}
		default : {
		}
	}
}

function head($judul="Halaman",$posisi=1){
	$prefix = ($posisi == 2) ? '../' : './';
	echo "
	<!DOCTYPE html>
	<html lang='id'>
	<head>
	<title>$judul - Sistem Pakar Gigi Anak</title>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel='preconnect' href='https://fonts.googleapis.com'>
	<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
	<link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap'>
	<link rel='stylesheet' href='{$prefix}bootstrap/css/bootstrap.min.css'>
	<link rel='stylesheet' href='{$prefix}bootstrap/css/style.css'>
	<script src='{$prefix}bootstrap/js/jquery-3.1.1.js'></script>
	<script src='{$prefix}bootstrap/js/bootstrap.min.js'></script>
	";
}

function menu(){
	$prefix = file_exists('library.php') ? './' : '../';
	?>
	<!-- Top Clinic Branding Header -->
	<header class="clinic-header">
		<div class="clinic-header-inner container-fluid">
			<div class="clinic-brand">
				<div class="clinic-logo-icon">
					<span class="glyphicon glyphicon-heart"></span>
				</div>
				<div class="clinic-title-box">
					<h1>SISTEM PAKAR KESEHATAN GIGI ANAK</h1>
					<p>Praktek Mandiri Drg. Rusi Adristi &bull; Padang, Sumatera Barat</p>
				</div>
			</div>
			<div class="clinic-header-badge hidden-xs">
				<span class="glyphicon glyphicon-ok-circle"></span> Metode Forward Chaining &bull; Rujukan Medis
			</div>
		</div>
	</header>

	<!-- Main Modern Navigation Bar -->
	<nav class="navbar navbar-default navbar-custom">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand visible-xs" href="<?php echo $prefix; ?>index.php">Pakar Gigi Anak</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo $prefix; ?>index.php"><span class="glyphicon glyphicon-home"></span> BERANDA</a></li>
					<?php
					if(isset($_SESSION['id_tipe'])){
						switch($_SESSION['id_tipe']){
							case 1 : { // Admin
								echo "
								<li class='dropdown'>
									<a class='dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>
										<span class='glyphicon glyphicon-folder-open'></span> Data Master <span class='caret'></span>
									</a>
									<ul class='dropdown-menu'>
										<li><a href='{$prefix}kelola_penyakit/penyakit.php'><span class='glyphicon glyphicon-list-alt'></span> Kelola Penyakit</a></li>
										<li><a href='{$prefix}kelola_gejala/gejala.php'><span class='glyphicon glyphicon-check'></span> Kelola Gejala</a></li>
										<li><a href='{$prefix}kelola_rule/rule.php'><span class='glyphicon glyphicon-random'></span> Kelola Rule</a></li>
									</ul>
								</li>
								<li class='dropdown'>
									<a class='dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>
										<span class='glyphicon glyphicon-user'></span> Data Member <span class='caret'></span>
									</a>
									<ul class='dropdown-menu'>
										<li><a href='{$prefix}kelola_member/member.php'><span class='glyphicon glyphicon-user'></span> Kelola Member</a></li>
									</ul>
								</li>
								<li><a href='{$prefix}kelola_saran/saran.php'><span class='glyphicon glyphicon-comment'></span> Kelola Saran</a></li>
								<li><a href='{$prefix}laporan/diagnosa.php'><span class='glyphicon glyphicon-print'></span> Laporan Konsultasi</a></li>
								";
								break;
							}
							case 3 : { // Member
								echo "<li><a href='{$prefix}konsultasi.php?hal=1'><span class='glyphicon glyphicon-stethoscope'></span> KONSULTASI</a></li>";
								echo "<li><a href='{$prefix}informasi_penyakit.php'><span class='glyphicon glyphicon-info-sign'></span> INFORMASI PENYAKIT</a></li>";
								echo "<li><a href='{$prefix}galeri.php'><span class='glyphicon glyphicon-picture'></span> GALERI</a></li>";
								echo "<li><a href='{$prefix}laporan/diagnosa.php'><span class='glyphicon glyphicon-time'></span> RIWAYAT KONSULTASI</a></li>";
								echo "<li><a href='{$prefix}saran.php'><span class='glyphicon glyphicon-pencil'></span> KRITIK &amp; SARAN</a></li>";
								break;
							}
						}		
					} else { // Guest
						echo "<li><a href='{$prefix}informasi_penyakit.php'><span class='glyphicon glyphicon-info-sign'></span> INFORMASI PENYAKIT</a></li>";
						echo "<li><a href='{$prefix}galeri.php'><span class='glyphicon glyphicon-picture'></span> GALERI</a></li>";
						echo "<li><a href='{$prefix}saran.php'><span class='glyphicon glyphicon-pencil'></span> KRITIK &amp; SARAN</a></li>";
					}
					?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php
					if(!isset($_SESSION['username'])){
						echo "
						<li><a href='{$prefix}login.php'><span class='glyphicon glyphicon-log-in'></span> MASUK</a></li>
						<li><a href='{$prefix}registrasi.php'><span class='glyphicon glyphicon-plus'></span> REGISTRASI</a></li>
						";
					} else {
						$roleName = ($_SESSION['id_tipe'] == 1) ? 'Admin' : 'Pasien';
						echo "
						<li><a href='{$prefix}index.php'><span class='glyphicon glyphicon-user'></span> {$_SESSION['username']} <span class='badge' style='background:#0284c7; font-size:11px; margin-left:4px;'>{$roleName}</span></a></li>
						<li><a href='{$prefix}logout.php'><span class='glyphicon glyphicon-log-out'></span> KELUAR</a></li>
						";
					}
					?>
				</ul>
			</div>
		</div>
	</nav>
	<?php
}

function cek_akses($akses=1){
	$prefix = file_exists('library.php') ? './' : '../';
	if(empty($_SESSION['id_tipe'])) {
		header("Location: {$prefix}login.php");
		exit();
	}
	if($_SESSION['id_tipe'] != $akses) {
		header("Location: {$prefix}index.php");
		exit();
	}
}

function cek_login(){
	$prefix = file_exists('library.php') ? './' : '../';
	if(!isset($_SESSION['id_tipe'])) {
		header("Location: {$prefix}login.php");
		exit();
	}
}

function pesan($jenis = 'success',$pesan='',$pilihan=0){
	switch($pilihan){
		case 0 : {
			$_SESSION['pesan']="
			<div class='alert alert-{$jenis} alert-dismissable' style='margin: 15px 0;'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<strong>Pemberitahuan:</strong><br/>$pesan
			</div>";
			$pesan = $_SESSION['pesan'];
			break;
		}
		case 1 : {
			if (!isset($_SESSION['pesan'])) return null;
			$pesan = $_SESSION['pesan'];
			unset($_SESSION['pesan']);
		}
	}
	return $pesan;
}

function tanggal_indo($hari,$bulan,$tahun){
	$hari_tmp = date("l", mktime(0, 0, 0, $bulan, $hari, $tahun));
	$bulan_tmp = date("F", mktime(0, 0, 0, $bulan, $hari, $tahun));
	$tahun_tmp = date("Y", mktime(0, 0, 0, $bulan, $hari, $tahun));
	switch($hari_tmp){
		case "Monday" : $ket_hari = "Senin"; break;
		case "Sunday" : $ket_hari = "Minggu"; break;
		case "Tuesday" : $ket_hari = "Selasa"; break;
		case "Wednesday" : $ket_hari = "Rabu"; break;
		case "Thursday" : $ket_hari = "Kamis"; break;
		case "Friday" : $ket_hari = "Jumat"; break;
		case "Saturday" : $ket_hari = "Sabtu"; break;
		default: $ket_hari = ""; break;
	}
	switch($bulan_tmp){
		case "January" : $ket_bln = "Januari"; break;
		case "February" : $ket_bln = "Februari"; break;
		case "March" : $ket_bln = "Maret"; break;
		case "April" : $ket_bln = "April"; break;
		case "May" : $ket_bln = "Mei"; break;
		case "June" :
		case "Juny" : $ket_bln = "Juni"; break;
		case "July" : $ket_bln = "Juli"; break;
		case "August" : $ket_bln = "Agustus"; break;
		case "September" : $ket_bln = "September"; break;
		case "October" : $ket_bln = "Oktober"; break;
		case "November" : $ket_bln = "November"; break;
		case "December" : $ket_bln = "Desember"; break;
		default: $ket_bln = ""; break;
	}
	return $ket_hari.", ".date('d')." ".$ket_bln." ".$tahun_tmp;
}
?>