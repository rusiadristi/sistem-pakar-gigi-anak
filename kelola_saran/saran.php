<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();
head('Daftar saran',2);
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
<h1 class="style1">Daftar Saran</h1>
<?php
$kueri = mysqli_query($koneksi,"select * from tbsaran where id_saran<>'P0007';");
$no=1;
?>
<table class="table table-condensed table-bordered">
<tr class="info">
	<td>No</td>
	<td>Nama Pengirim</td>
	<td>saran</td>
	<td>Aksi</td>
</tr>
<?php
if(mysqli_num_rows($kueri) < 1) echo "<tr><td class='text-center' colspan=5><strong>Data saran Kosong...</strong></td></tr>";
		else {
			while ($isi=mysqli_fetch_array($kueri,MYSQLI_BOTH)){
				echo "
				<tr>
				<td>$no</td>
				<td>{$isi['nama']}</td>
				<td>{$isi['saran']}</td>
				<td>
				<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#konfirmasi{$isi['id_saran']}'>
				<span class='glyphicon glyphicon-remove'></span> Hapus
				</button>
				<div id='konfirmasi{$isi['id_saran']}' class='modal fade' role='dialog'><div class='modal-dialog'><div class='modal-content'>
				<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
				<h4 class='modal-title'>Peringatan!</h4>
				</div>
				<div class='modal-body'>
				<p>Apakah Anda yakin ingin menghapus saran ini?</b>?</p>
				</div>
				<div class='modal-footer float-right'>
				<a href='hapus.php?id_saran={$isi['id_saran']}' class='btn btn-danger'>    Ya    </a>
				<button type='button' class='btn btn-default' data-dismiss='modal'>Tidak</button>
				</div></div></div></div>
				</td>
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
