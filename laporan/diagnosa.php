<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_login();
head('Laporan Hasil Konsultasi',2);
style(2); ?>
<style type="text/css">
<!--
.style1 {font-family: Georgia, "Times New Roman", Times, serif}
-->
</style>
<body>
<?php

#menu 2
function menu2(){
	?>
	
	<div class=' text-center'>
	<img src='/pakar/gambar/logo1.jpeg' alt='pakar' class='img img-responsive'>
	<nav class='navbar navbar-default' style=' 
	background-color:white;
	font-family:serif;
	'>
	
	<div class='navbar-header'>
	<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
	<span class='icon-bar'></span>
	<span class='icon-bar'></span>
	<span class='icon-bar'></span>                        
	</button>
	</div>
    <div class='collapse navbar-collapse' id='myNavbar'>
    <ul class='nav navbar-nav'>
    <li class=''><a href='../../pakar'>BERANDA</a></li>
    </ul>
    <ul class='nav navbar-nav'>
	
  <?php
    if(isset($_SESSION['id_tipe'])){
    switch($_SESSION['id_tipe']){
		case 1 : {
			echo "
			<li class='dropdown'>
			<a class='dropdown-toggle' data-toggle='dropdown' href='/pakar/kelola_member/member.php'>Data Konsultasi
			<span class='caret'></span></a>
			<ul class='dropdown-menu'>
			<li><a href='/pakar/kelola_penyakit/penyakit.php'>Kelola penyakit</a></li>
			<li><a href='/pakar/kelola_gejala/gejala.php'>Kelola gejala</a></li>
			<li><a href='/pakar/kelola_rule/rule.php'>Kelola rule</a></li>
			</ul>
			</li>
			<li class='dropdown'>
			<a class='dropdown-toggle' data-toggle='dropdown' href=#'>Data Member
			<span class='caret'></span></a>
			<ul class='dropdown-menu'>
			<li><a href='/pakar/kelola_member/member.php'>Kelola Member</a></li>

			</ul>
			</li>
			<li><a href='/pakar/kelola_saran/saran.php'>Kelola Saran</a></li>
			<li><a href='diagnosa.php'>Laporan Konsultasi</a></li>
			";
			break;}
		case 3 : {
			echo "<li><a href='konsultasi.php?hal=1'>Konsultasi</a></li>";
			echo "<li><a href='galeri.php'>Galeri</a></li>";
			echo "<li><a href='../informasi_penyakit.php'>Informasi Penyakit</a></li>";
			echo "<li><a href='diagnosa.php'>Laporan Konsultasi</a></li>";
			echo "<li><a href='saran.php'>Kritik &amp; Saran</a></li>";
			break;}
		}		
	} else {
		echo "<li><a href='galeri.php'>GALERI</a></li>";
		echo "<li><a href='informasi_penyakit.php'>INFORMASI PENYAKIT</a></li>";
		echo "<li><a href='saran.php'>KRITIK &amp; SARAN</a></li>";
	}
	echo "</ul><ul class='nav navbar-nav navbar-right'>";
	if(!isset($_SESSION['username'])){
	echo "
	<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
	<li><a href='registrasi.php'><span class='glyphicon glyphicon-log-in'></span> Registrasi</a></li>
	";
	}
	else {
	echo "
	<li><a href='/pakar'><span class='glyphicon glyphicon-user'></span> Hai, {$_SESSION['username']}</a></li>
	<li><a href='/pakar/logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>
	";
	}
	echo "</ul></div></div></nav>";
}

#menu 2






menu2();
include "../template/kiri.php";
?>
<h1 class="style1">Daftar Hasil Konsultasi</h1>
<?php
if(@$_POST['cari']){
if($_SESSION['id_tipe'] == 1) {
	$kueri = mysqli_query($koneksi,"select * from tbhasil_konsultasi,penyakit where tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit and tbhasil_konsultasi.tgl_hasil like '$_POST[tanggal]%' group by tbhasil_konsultasi.tgl_hasil;");
	}
	else{
	$kueri = mysqli_query($koneksi,"select * from tbhasil_konsultasi,penyakit where tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit and tbhasil_konsultasi.username='{$_SESSION['username']}' and tbhasil_konsultasi.tgl_hasil like '$_POST[tanggal]%' group by tbhasil_konsultasi.tgl_hasil;");
	}
	}else{
	if($_SESSION['id_tipe'] == 1) {
	$kueri = mysqli_query($koneksi,"select * from tbhasil_konsultasi,penyakit where tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit;");
	}
	else{
	$kueri = mysqli_query($koneksi,"select * from tbhasil_konsultasi,penyakit where tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit and tbhasil_konsultasi.username='{$_SESSION['username']}' group by tbhasil_konsultasi.tgl_hasil;");
	}
	
	}
$no=1;
?>
<form name="dd" action="diagnosa.php" method="POST"/>
<table><tr>
<td>
<select name="tanggal" id="tanggal" onChange="changeValue(this.value)"class="form-control">
<option value=0>-Pilih Tanggal Konsultasi-</option>
<?php
$result =  mysqli_query($koneksi,"select * from tbhasil_konsultasi group by tgl_hasil");

while ($row = mysqli_fetch_array($result)) {
echo '<option value="' . $row['tgl_hasil'] . '">' . $row['tgl_hasil'] . '</option>';
}
?>
</select> </td> <td> &nbsp;&nbsp;&nbsp;<input name="cari" type="submit" value="cari" class='btn btn-info' /> </td>
</tr>
</table>
<br>
<table class="table table-condensed table-bordered">
<tr class="info">
	<td>No</td>
<?php
if($_SESSION['id_tipe'] == 1) echo "<td>Username</td>";
?>
	<td>Nama Penyakit</td>
	<td>Waktu</td>
</tr>
<?php
if(mysqli_num_rows($kueri) < 1) echo "<tr><td class='text-center' colspan=3><strong>Data Hasil Konsultasi Kosong...</strong></td></tr>";
		else {
			while ($isi=mysqli_fetch_array($kueri,MYSQLI_BOTH)){
				echo "
				<tr>
				<td>$no</td>";
				if($_SESSION['id_tipe'] == 1) echo "<td>{$isi['username']}</td>";
				echo "
				<td>{$isi['nm_penyakit']}</td>
				<td>{$isi['tgl_hasil']}</td>
				</tr>
				";
				$no++;
				}
			}
?>
</table>
<a href="laporan_diagnosa.php?id=<?php echo $_POST['tanggal'];?>" target="_blank"> Cetak Hasil</a>
<?php
echo "<table align='right'>";
$tgl = date('d M Y');
echo "<tr><td>Dharmasraya, $tgl</tr></td>";

if($_SESSION['id_tipe'] == 1) {
echo "<tr><td>Dokter Gigi,</tr></td>";
echo "<tr><td><em>&nbsp;</em></tr></td>";
echo "<tr><td><em>&nbsp;</em></tr></td>";
	echo "<tr><td>Drg.Fahreni</tr></td>";
	}
	else{
	echo "<tr><td>Member,</tr></td>";
echo "<tr><td><em>&nbsp;</em></tr></td>";
echo "<tr><td><em>&nbsp;</em></tr></td>";
echo "<tr><td>$_SESSION[username]</tr></td>";	
	}

echo "</table>";
?>
<?php
include "../template/kanan.php";
include "../template/footer.php";
?>
