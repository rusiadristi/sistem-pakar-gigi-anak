<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();

$id = isset($_GET['id_gejala']) ? mysqli_real_escape_string($koneksi, $_GET['id_gejala']) : '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$nm_gejala = mysqli_real_escape_string($koneksi, trim($_POST['Tnm_gejala']));
	$kueri = mysqli_query($koneksi, "UPDATE tbgejala SET nm_gejala='$nm_gejala' WHERE id_gejala='$id';");
	if($kueri) {
		header('Location: gejala.php');
		exit();
	}
}

$kueri = mysqli_query($koneksi, "SELECT * FROM tbgejala WHERE id_gejala='$id';");
if(mysqli_num_rows($kueri) < 1) {
	header('Location: gejala.php');
	exit();
}
$isi = mysqli_fetch_array($kueri, MYSQLI_BOTH);

head('Edit Gejala Penyakit', 2);
style(2);
?>
<body>
<?php
menu();
include "../template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-edit" style="color:var(--primary);"></span> Edit Gejala Klinis</h3>
    <div class="page-subtitle">Perbarui deskripsi gejala klinis</div>
  </div>
  <div>
    <a href="gejala.php" class="btn btn-default btn-sm">
      <span class="glyphicon glyphicon-arrow-left"></span> Kembali
    </a>
  </div>
</div>

<div class="article-card" style="padding: 24px;">
  <form method="POST">
    <div class="form-group">
      <label><strong>ID Gejala :</strong></label>
      <input class="form-control" type="text" value="<?php echo htmlspecialchars($isi['id_gejala']); ?>" disabled style="max-width:200px; background-color:var(--slate-100); font-weight:bold;" />
    </div>

    <div class="form-group">
      <label for="Tnm_gejala"><strong>Deskripsi Gejala Klinis :</strong></label>
      <input id="Tnm_gejala" class="form-control" type="text" value="<?php echo htmlspecialchars($isi['nm_gejala']); ?>" name="Tnm_gejala" maxlength="255" required />
    </div>

    <div style="display:flex; gap:10px; margin-top:20px;">
      <button type="submit" name="Bsimpan" class="btn btn-success">
        <span class="glyphicon glyphicon-ok"></span> Simpan Perubahan
      </button>
      <a href="gejala.php" class="btn btn-default">Batal</a>
    </div>
  </form>
</div>

<?php
include "../template/kanan.php";
include "../template/footer.php";
?>
