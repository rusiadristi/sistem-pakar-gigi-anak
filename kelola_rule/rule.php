<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();
head('Daftar rule',2);
style(2); ?>
<style type="text/css">
<!--
.style1 {font-family: Georgia, "Times New Roman", Times, serif}
-->
</style>
<body>
<?php
menu();
include "../template/kiri.php";
?>
<h1 class="style1">Daftar Rule</h1>
<?php
$kueri = mysqli_query($koneksi,"select * from penyakit");
$no=1;
?>
<a href="tambah.php" class="btn btn-success">Tambah Daftar Rule</a>
<table class="table table-condensed table-bordered">
<tr class="info">
	<td>No</td>
	<td>Nama Penyakit</td>
	<td>Gejala</td>
</tr>
<?php
if(mysqli_num_rows($kueri) < 1) echo "<tr><td class='text-center' colspan=5><strong>Data rule Kosong...</strong></td></tr>";
		else {
			while ($isi=mysqli_fetch_array($kueri,MYSQLI_BOTH)){
				echo "
				<tr>
				<td>$no</td>
				<td>{$isi['nm_penyakit']}</td>
				<td>";
				$qr=mysqli_query($koneksi,"select * from rule r,tbgejala g where g.id_gejala=r.id_gejala and r.id_penyakit='$isi[id_penyakit]'");
				while($r=mysqli_fetch_array($qr,MYSQLI_BOTH)){
				echo "
				
				
				<a href='hapus.php?id_rule={$r['id_rule']}' onclick='return confirm(\"Apakah Data Yakin Akan Dihapus..?\")'class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span></a>
				
				
				$r[id_gejala] -  $r[nm_gejala]<br/>";
				}
				echo"</td>
				
				</tr>
				";
				$no++;
				}
			}
?>
</table>
<?php
include "../template/kanan.php";
include "../template/footer.php";
?>
