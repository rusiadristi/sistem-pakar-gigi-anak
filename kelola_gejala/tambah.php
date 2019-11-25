<?php
session_start();
require_once "../koneksi.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id_gejala = $_POST['Tid_gejala'];
	$nm_gejala = $_POST['Tnm_gejala'];
	$kueri = mysqli_query($koneksi, "insert into tbgejala values ('$id_gejala','$nm_gejala');");
	if($kueri) header('Location:gejala.php');
}
include "../library.php";
cek_akses();
head('Input Gejala Penyakit',2);
style(2); ?>
<body>
<?php
menu();
include "../template/kiri.php";
?>
<h1>Input gejala Baru</h1>
<form method="POST">
<div class='form-group'>
	<label for="Tid_gejala" class="label-control">ID gejala :</label>
	<input id="Tid_gejala" class="form-control" type="text" name="Tid_gejala" maxlength=20 />
</div>
<div class='form-group'>
	<label for="Tnm_gejala" class="label-control">Nama gejala :</label>
	<input id="Tnm_gejala" class="form-control" type="text" name="Tnm_gejala" maxlength=100 required />
</div>
<button type="submit" name="Bsimpan" class="btn btn-success">Simpan</button>
<button type="reset" class="btn btn-danger">Ulangi</button>
</form>
<?php
include "../template/kanan.php";
include "../template/footer.php";
?>

