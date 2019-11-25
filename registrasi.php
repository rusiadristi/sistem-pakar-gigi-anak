<?php
session_start();
require_once "koneksi.php";
include "library.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = $_POST['Tusername'];
	$password = $_POST['Tpassword'];
	$email = $_POST['Temail'];
	$nohp = $_POST['Tnohp'];
	$nm_pengguna = $_POST['Tnm_pengguna'];
	$kueri = mysqli_query($koneksi, "insert into tbuser (username,password,email,nohp,nm_pengguna) values ('$username','$password','$email','$nohp','$nm_pengguna');");
	if($kueri) {
		$pesan = pesan('success',"Registrasi berhasil. Silahkan login.",1);
		header('Location:/pakar/login.php');
	}
	else $pesan = pesan('danger',"Registrasi gagal. Silahkan registrasi ulang.",1);
}
head('Registrasi',1);
style(1); ?>
<body>
<?php
menu();
include "template/kiri.php";
?>
<h1>Registrasi</h1>
<?php $pesan; ?>
<form method="POST">
<div class='form-group'>
	<label for="Tusername" class="label-control">Username :</label>
	<input id="Tusername" class="form-control" type="text" name="Tusername" maxlength=20 required placeholder="Username"/>
</div>
<div class='form-group'>
	<label for="Tpassword" class="label-control">Masukan Password :</label>
	<input id="Tpassword" class="form-control" type="password" name="Tpassword" maxlength=20 required placeholder="Masukan Password"/>
</div>
<div class='form-group'>
	<label for="Tnm_pengguna" class="label-control">Nama Lengkap :</label>
	<input id="Tnm_pengguna" class="form-control" type="text" name="Tnm_pengguna" maxlength=100 required placeholder="Nama Lengkap"/>
</div>
<div class='form-group'>
	<label for="Temail" class="label-control">Masukan Email : </label>
	<input id="Temail" class="form-control" type="text" name="Temail" maxlength=50 placeholder="Masukan Email"/>
</div>
<div class='form-group'>
	<label for="Tnohp" class="label-control">Nomor Handphone :</label>
	<input id="Tnohp" class="form-control" type="text" name="Tnohp" maxlength=14 placeholder="Nomor Telepon"/>
</div>
<button type="submit" name="Bsimpan" class="btn btn-success">Register</button>
<button type="reset" class="btn btn-danger">Ulangi</button>
</form>
<?php
include "template/kanan.php";
include "template/footer.php";
?>

