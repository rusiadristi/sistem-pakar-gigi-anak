<?php
session_start();
require_once "../koneksi.php";
if(isset($_POST['Bsimpan'])){
	$kueri = mysqli_query($koneksi, "insert into rule values ('','$_POST[penyakit]','$_POST[gejala]');");
	if($kueri) header('Location:rule.php');
}
include "../library.php";
cek_akses();
head('Tambah rule',2);
style(2); ?>
<body>
<?php
menu();
include "../template/kiri.php";
?>
<h1>Input Rule Baru</h1>
<form method="POST">
<div class='form-group'>
	<label for="Tnm_penyakit" class="label-control">Nama Penyakit :</label>
	<select name='penyakit' class='form-control'>
	<option value=''>Pilih Penyakit</option>
	<?php
	$k=mysqli_query($koneksi,"select * from penyakit");
	while($rk=mysqli_fetch_array($k,MYSQLI_BOTH)){
	echo"<option value='$rk[id_penyakit]'>$rk[nm_penyakit]</option>";
	}
	?>
	</select>
</div>
<div class='form-group'>
	<label for="Tketerangan" class="label-control">Nama Gejala :</label>
	<select name='gejala' class='form-control'>
	<option value=''>Pilih Gejala</option>
	<?php
	$k=mysqli_query($koneksi,"select * from tbgejala");
	while($rk=mysqli_fetch_array($k,MYSQLI_BOTH)){
	echo"<option value='$rk[id_gejala]'>$rk[nm_gejala]</option>";
	}
	?>
	</select>
</div>
<button type="submit" name="Bsimpan" class="btn btn-success">Simpan</button>
<button type="reset" class="btn btn-danger">Ulangi</button>
</form>
<?php
include "../template/kanan.php";
include "../template/footer.php";
?>
