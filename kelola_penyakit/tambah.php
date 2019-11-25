<?php
session_start();
require_once "../koneksi.php";
if(isset($_POST['Bsimpan'])){
	$id_penyakit = $_POST['Tid_penyakit'];
	$nm_penyakit = $_POST['Tnm_penyakit'];
	$ket = $_POST['Tketerangan'];
	$kueri = mysqli_query($koneksi, "insert into penyakit values ('$id_penyakit','$nm_penyakit','$ket');");
	if($kueri) header('Location:penyakit.php');
}
include "../library.php";
cek_akses();
head('Tambah penyakit',2);
style(2); ?>
<body>
<?php
menu();
include "../template/kiri.php";
?>
<h1>Tambah penyakit Baru</h1>
<form method="POST">
<div class='form-group'>
	<label for="Tid_penyakit" class="label-control">ID penyakit :</label>
	<input id="Tid_penyakit" class="form-control" type="text" name="Tid_penyakit" maxlength=20 />
</div>
<div class='form-group'>
	<label for="Tnm_penyakit" class="label-control">Nama penyakit :</label>
	<input id="Tnm_penyakit" class="form-control" type="text" name="Tnm_penyakit" maxlength=100 required />
</div>
<div class='form-group'>
	<label for="Tketerangan" class="label-control">Keterangan penyakit :</label>
	<textarea id="Tketerangan" class="form-control" type="text" name="Tketerangan" minlength=10 rows=10  ></textarea>
</div>
<button type="submit" name="Bsimpan" class="btn btn-success">Simpan</button>
<button type="reset" class="btn btn-danger">Ulangi</button>
</form>
<?php
include "../template/kanan.php";
include "../template/footer.php";
?>
