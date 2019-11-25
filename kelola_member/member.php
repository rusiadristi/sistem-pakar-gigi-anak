<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();
head('Daftar Member',2);
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
<h1 class="style1">Daftar Member</h1>
<?php
$kueri = mysqli_query($koneksi,"select * from tbuser;");
?>
<a href="tambah.php" class="btn btn-success">Tambah Daftar Member</a>
<table class="table table-condensed table-bordered">
<tr class="info">
	<td>No</td>
	<td>Nama Pengguna</td>
	<td>Username</td>
	<td>Email</td>
	<td>NOHP</td>
	<td>Aksi</td>
</tr>
<?php
if(mysqli_num_rows($kueri) < 1) echo "<tr><td class='text-center' colspan=5><strong>Data Member Kosong...</strong></td></tr>";
		else {
			$no=1;
			while ($isi=mysqli_fetch_array($kueri,MYSQLI_BOTH)){
				echo "
				<tr>
				<td>$no</td>
				<td>{$isi['username']}</td>
				<td>{$isi['nm_pengguna']}</td>
				<td>{$isi['email']}</td>
				<td>{$isi['nohp']}</td>
				<td>
				<a href='edit.php?id_user={$isi['id_user']}' class='btn btn-primary'>Edit</a>
				<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#konfirmasi{$isi['id_user']}'>
				<span class='glyphicon glyphicon-remove'></span> Hapus
				</button>
				<div id='konfirmasi{$isi['id_user']}' class='modal fade' role='dialog'><div class='modal-dialog'><div class='modal-content'>
				<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
				<h4 class='modal-title'>Peringatan!</h4>
				</div>
				<div class='modal-body'>
				<p>Apakah Anda yakin ingin menghapus user <b>{$isi['nm_pengguna']}</b>?</p>
				</div>
				<div class='modal-footer float-right'>
				<a href='hapus.php?id_user={$isi['id_user']}' class='btn btn-danger'>    Ya    </a>
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
