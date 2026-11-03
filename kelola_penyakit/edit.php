<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id_penyakit = mysqli_real_escape_string($koneksi, trim($_POST['id_penyakit']));
	$nm_penyakit = mysqli_real_escape_string($koneksi, trim($_POST['Tnm_penyakit']));
	$ket = mysqli_real_escape_string($koneksi, trim($_POST['Tketerangan']));
	$qu = "UPDATE penyakit SET nm_penyakit='$nm_penyakit', keterangan='$ket' WHERE id_penyakit='$id_penyakit';";
	$kueri = mysqli_query($koneksi, $qu);
	if($kueri) {
		header('Location: penyakit.php');
		exit();
	}
}

$id = isset($_GET['id_penyakit']) ? mysqli_real_escape_string($koneksi, $_GET['id_penyakit']) : '';
$kueri = mysqli_query($koneksi, "SELECT * FROM penyakit WHERE id_penyakit='$id';");
if(mysqli_num_rows($kueri) < 1) {
	header('Location: penyakit.php');
	exit();
}
$isi = mysqli_fetch_array($kueri, MYSQLI_BOTH);

head('Edit Data Penyakit', 2);
style(2);
?>
<body>
<?php
menu();
include "../template/kiri.php";
?>
<script src="../ckeditor/ckeditor.js"></script>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-edit" style="color:var(--primary);"></span> Edit Data Penyakit</h3>
    <div class="page-subtitle">Perbarui data penyakit dan solusi perawatan gigi</div>
  </div>
  <div>
    <a href="penyakit.php" class="btn btn-default btn-sm">
      <span class="glyphicon glyphicon-arrow-left"></span> Kembali
    </a>
  </div>
</div>

<div class="article-card" style="padding: 24px;">
  <form method="POST">
    <input type="hidden" value="<?php echo htmlspecialchars($isi['id_penyakit']); ?>" name="id_penyakit"/>
    
    <div class="form-group">
      <label><strong>ID Penyakit :</strong></label>
      <input class="form-control" type="text" value="<?php echo htmlspecialchars($isi['id_penyakit']); ?>" disabled style="max-width:200px; background-color:var(--slate-100); font-weight:bold;" />
    </div>

    <div class="form-group">
      <label for="Tnm_penyakit"><strong>Nama Penyakit :</strong></label>
      <input id="Tnm_penyakit" class="form-control" type="text" name="Tnm_penyakit" value="<?php echo htmlspecialchars($isi['nm_penyakit']); ?>" maxlength="100" minlength="3" required />
    </div>

    <div class="form-group">
      <label for="Tketerangan"><strong>Keterangan &amp; Solusi Penanganan :</strong></label>
      <textarea id="Tketerangan" class="form-control" name="Tketerangan" rows="8"><?php echo $isi['keterangan']; ?></textarea>
    </div>

    <div style="display:flex; gap:10px; margin-top:20px;">
      <button type="submit" name="Bsimpan" class="btn btn-success">
        <span class="glyphicon glyphicon-ok"></span> Simpan Perubahan
      </button>
      <a href="penyakit.php" class="btn btn-default">
        Batal
      </a>
    </div>
  </form>
</div>

<script>
  if(typeof CKEDITOR !== 'undefined' && document.getElementById('Tketerangan')){
    CKEDITOR.replace("Tketerangan");
  }
</script>

<?php
include "../template/kanan.php";
include "../template/footer.php";
?>
