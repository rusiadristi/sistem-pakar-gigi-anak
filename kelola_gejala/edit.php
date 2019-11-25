<?php
session_start();
require_once "../koneksi.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id_gejala = $_GET['id_gejala'];
	$nm_gejala = $_POST['Tnm_gejala'];
	$kueri = mysqli_query($koneksi, "update tbgejala set nm_gejala='$nm_gejala' where id_gejala='$id_gejala';");
	if($kueri) header('Location:gejala.php');
}
include "../library.php";
cek_akses();
head('Edit Gejala Penyakit',2);
style(2); ?>
<body>
<?php
menu();
include "../template/kiri.php";
?>
<?php
$id = $_GET['id_gejala'];
$kueri = mysqli_query($koneksi,"select * from tbgejala where id_gejala='$id';");
?>
<?php
if(mysqli_num_rows($kueri) < 1) header('Location:gejala.php');
else {
while ($isi=mysqli_fetch_array($kueri,MYSQLI_BOTH)){ ?>
<h1>Edit Gejala Penyakit</h1>
<form method="POST">
<div class='form-group'>
	<label for="Tnm_gejala" class="label-control">Nama Gejala :</label>
	<input id="Tnm_gejala" class="form-control" type="text" value="<?php echo $isi['nm_gejala']; ?>" name="Tnm_gejala" required />
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

