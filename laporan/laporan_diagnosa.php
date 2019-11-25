<style type="text/css">
<!--
.style1 {font-family: Georgia, "Times New Roman", Times, serif}
-->
</style>
<body onLoad="print()">
<?php
session_start();
require_once "../koneksi.php";

?>
<h1 align="center" class="style1">Daftar Hasil Konsultasi</h1>
<?php
$id=@$_GET[id];
if($id==''){


	if($_SESSION['id_tipe'] == 1) {
	$kueri = mysqli_query($koneksi,"select * from tbhasil_konsultasi,penyakit where tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit;");
	}
	else{
	$kueri = mysqli_query($koneksi,"select * from tbhasil_konsultasi,penyakit where tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit and tbhasil_konsultasi.username='{$_SESSION['username']}' group by tbhasil_konsultasi.tgl_hasil;");
	}
	
	
	}else{
	if($_SESSION['id_tipe'] == 1) {
	$kueri = mysqli_query($koneksi,"select * from tbhasil_konsultasi,penyakit where tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit and tbhasil_konsultasi.tgl_hasil like '$id%' group by tbhasil_konsultasi.tgl_hasil;");
	}
	else{
	$kueri = mysqli_query($koneksi,"select * from tbhasil_konsultasi,penyakit where tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit and tbhasil_konsultasi.username='{$_SESSION['username']}' and tbhasil_konsultasi.tgl_hasil like '$id%' group by tbhasil_konsultasi.tgl_hasil;");
	}
	}
$no=1;
?>

<br>
<table class="table table-condensed table-bordered" width="100%" border="1">
<tr class="info">
	<td>No</td>
<?php
if($_SESSION['id_tipe'] == 1) echo "<td>Username</td>";
?>
	<td>Nama penyakit</td>
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

<?php
echo "<table align='right'>";
$tgl = date('d M Y');
echo "<tr><td>Padang, $tgl</tr></td>";

if($_SESSION['id_tipe'] == 1) {
echo "<tr><td>Dokter Hewan,</tr></td>";
echo "<tr><td><em>&nbsp;</em></tr></td>";
echo "<tr><td><em>&nbsp;</em></tr></td>";
	echo "<tr><td>drh. Farid Azhar</tr></td>";
	}
	else{
	echo "<tr><td>Member,</tr></td>";
echo "<tr><td><em>&nbsp;</em></tr></td>";
echo "<tr><td><em>&nbsp;</em></tr></td>";
echo "<tr><td>$_SESSION[username]</tr></td>";	
	}

echo "</table>";
?>

