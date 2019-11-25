<?php
session_start();
require_once "../koneksi.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id_user = $_GET['id_user'];
	$username = $_POST['Tusername'];
	$password = $_POST['Tpassword'];
	$email = $_POST['Temail'];
	$nohp = $_POST['Tnohp'];
	$nm_pengguna = $_POST['Tnm_pengguna'];
	$kueri = mysqli_query($koneksi, "update tbuser set username='$username',email='$email',nohp='$nohp',nm_pengguna='$nm_pengguna' where id_user='$id_user';");
	if($kueri) header('Location:member.php');
}
include "../library.php";
cek_akses();
head('Edit Informasi Member',2);
style(2); ?>
<body>
<?php
menu();
include "../template/kiri.php";
$id = $_GET['id_user'];
$kueri = mysqli_query($koneksi,"select * from tbuser where id_user='$id' limit 1;");
if(mysqli_num_rows($kueri) < 1) header('Location:member.php');
else {
while ($isi=mysqli_fetch_array($kueri,MYSQLI_BOTH)){
$username=$isi['username'];
$email=$isi['email'];
$nohp=$isi['nohp'];
$nm=$isi['nm_pengguna'];
}
}
?>
<h1>Edit Informasi Member</h1>
<form method="POST">
<div class='form-group'>
	<label for="Tusername" class="label-control">Username :</label>
	<input id="Tusername" class="form-control" type="text" value="<?php echo $username; ?>" name="Tusername" maxlength=20 required readonly />
</div>
<div class='form-group'>
	<label for="Tnm_pengguna" class="label-control">Nama Pengguna :</label>
	<input id="Tnm_pengguna" class="form-control" type="text" value="<?php echo $nm; ?>" name="Tnm_pengguna" maxlength=100 required />
</div>

<div class='form-group'>
	<label for="Temail" class="label-control">Email :</label>
	<input id="Temail" class="form-control" type="text" value="<?php echo $email; ?>" name="Temail" maxlength=50 />
</div>
<div class='form-group'>
	<label for="Tnohp" class="label-control">Nomor Handphone :</label>
	<input id="Tnohp" class="form-control" type="text" value="<?php echo $nohp; ?>" name="Tnohp" maxlength=14 />
</div>
<button type="submit" name="Bsimpan" class="btn btn-success">Simpan</button>
<button type="reset" class="btn btn-danger">Ulangi</button>
</form>
<?php
include "../template/kanan.php";
include "../template/footer.php";
?>
