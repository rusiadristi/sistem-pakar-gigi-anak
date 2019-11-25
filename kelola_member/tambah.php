<?php
session_start();
require_once "../koneksi.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = $_POST['Tusername'];
	$password = $_POST['Tpassword'];
	$email = $_POST['Temail'];
	$nohp = $_POST['Tnohp'];
	$nm_pengguna = $_POST['Tnm_pengguna'];
	$kueri = mysqli_query($koneksi, "insert into tbuser (username,password,email,nohp,nm_pengguna) values ('$username',md5('$password'),'$email','$nohp','$nm_pengguna');");
	if($kueri) header('Location:member.php');
}
include "../library.php";
cek_akses();
head('Tambah Member',2);
style(2); ?>
<body>
<?php
menu();
include "../template/kiri.php";
?>
<h1>Tambah Member Baru</h1>
<form method="POST">
<div class='form-group'>
	<label for="Tusername" class="label-control">Username :</label>
	<input id="Tusername" class="form-control" type="text" name="Tusername" maxlength=20 required />
</div>
<div class='form-group'>
	<label for="Tpassword" class="label-control">Password :</label>
	<input id="Tpassword" class="form-control" type="password" name="Tpassword" maxlength=20 required />
</div>
<div class='form-group'>
	<label for="Tnm_pengguna" class="label-control">Nama Pengguna :</label>
	<input id="Tnm_pengguna" class="form-control" type="text" name="Tnm_pengguna" maxlength=100 required />
</div>
<div class='form-group'>
	<label for="Temail" class="label-control">Email :</label>
	<input id="Temail" class="form-control" type="text" name="Temail" maxlength=50 />
</div>
<div class='form-group'>
	<label for="Tnohp" class="label-control">Nomor Handphone :</label>
	<input id="Tnohp" class="form-control" type="text" name="Tnohp" maxlength=14 />
</div>
<button type="submit" name="Bsimpan" class="btn btn-success">Simpan</button>
<button type="reset" class="btn btn-danger">Ulangi</button>
</form>
<?php
include "../template/kanan.php";
include "../template/footer.php";
?>
