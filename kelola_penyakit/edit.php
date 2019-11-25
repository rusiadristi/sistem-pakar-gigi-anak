<?php
session_start();
require_once "../koneksi.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id_penyakit = $_POST['id_penyakit'];
	$nm_penyakit = $_POST['Tnm_penyakit'];
	$ket = $_POST['Tketerangan'];
	$qu = "update penyakit set nm_penyakit='$nm_penyakit',keterangan='$ket' where id_penyakit='$id_penyakit';";
	$kueri = mysqli_query($koneksi, $qu);
	if($kueri) header('Location:/pakar/kelola_penyakit/penyakit.php');
	else {
		echo $id_penyakit."<br/>";
		echo $nm_penyakit."<br/>";
		echo $ket;
		echo $qu;
	}
}
include "../library.php";
cek_akses();
head('Edit penyakit',2);
style(2); ?>
<body>
<?php
menu();
include "../template/kiri.php";
?>
<h1>Edit penyakit</h1>
<?php
$id = $_GET['id_penyakit'];
$kueri = mysqli_query($koneksi,"select * from penyakit where id_penyakit='$id';");
?>
<?php
if(mysqli_num_rows($kueri) < 1) header('Location:penyakit.php');
else {
while ($isi=mysqli_fetch_array($kueri,MYSQLI_BOTH)){ ?>
<form method="POST">
<input type="hidden" value="<?php echo $isi['id_penyakit']; ?>" name="id_penyakit"/>
<div class='form-group'>
	<label for="Tnm_penyakit" class="label-control">Nama penyakit :</label>
	<input id="Tnm_penyakit" class="form-control" type="text" name="Tnm_penyakit" value="<?php echo $isi['nm_penyakit']; ?>" maxlength=100 minlength=10 required />
</div>
<div class='form-group'>
	<label for="Tketerangan" class="label-control">Keterangan penyakit :</label>
	<textarea id="Tketerangan" class="form-control" type="text" name="Tketerangan" minlength=10 rows=10  required><?php echo $isi['keterangan']; ?></textarea>
</div>
<button type="submit" name="Bsimpan" class="btn btn-success">Simpan</button>
<button type="reset" class="btn btn-danger">Ulangi</button>
</form>
<?php 
	}
}
include "../template/kanan.php";
include "../template/footer.php";
?>
