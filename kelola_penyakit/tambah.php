<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();

if(isset($_POST['Bsimpan'])){
	$id_penyakit = mysqli_real_escape_string($koneksi, trim($_POST['Tid_penyakit']));
	$nm_penyakit = mysqli_real_escape_string($koneksi, trim($_POST['Tnm_penyakit']));
	$ket = mysqli_real_escape_string($koneksi, trim($_POST['Tketerangan']));
	$kueri = mysqli_query($koneksi, "INSERT INTO penyakit (id_penyakit, nm_penyakit, keterangan) VALUES ('$id_penyakit', '$nm_penyakit', '$ket');");
	if($kueri) {
		header('Location: penyakit.php');
		exit();
	}
}

head('Tambah Data Penyakit', 2);
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
    <h3 class="page-title"><span class="glyphicon glyphicon-plus" style="color:var(--primary);"></span> Tambah Data Penyakit</h3>
    <div class="page-subtitle">Form penambahan master data penyakit gigi baru</div>
  </div>
  <div>
    <a href="penyakit.php" class="btn btn-default btn-sm">
      <span class="glyphicon glyphicon-arrow-left"></span> Kembali
    </a>
  </div>
</div>

<div class="article-card" style="padding: 24px;">
  <form method="POST">
    <div class="form-group">
      <label for="Tid_penyakit"><strong>ID Penyakit (Contoh: P03) :</strong></label>
      <input id="Tid_penyakit" class="form-control" type="text" name="Tid_penyakit" maxlength="10" required placeholder="P03" style="max-width:200px;" />
    </div>

    <div class="form-group">
      <label for="Tnm_penyakit"><strong>Nama Penyakit Gigi :</strong></label>
      <input id="Tnm_penyakit" class="form-control" type="text" name="Tnm_penyakit" maxlength="100" required placeholder="Contoh: Pulpitis Reversibel" />
    </div>

    <div class="form-group">
      <label for="Tketerangan"><strong>Keterangan &amp; Solusi Penanganan :</strong></label>
      <textarea id="Tketerangan" class="form-control" name="Tketerangan" rows="8" placeholder="Keterangan klinis dan langkah medis perawatan..."></textarea>
    </div>

    <div style="display:flex; gap:10px; margin-top:20px;">
      <button type="submit" name="Bsimpan" class="btn btn-success">
        <span class="glyphicon glyphicon-ok"></span> Simpan Data
      </button>
      <button type="reset" class="btn btn-default">
        Reset
      </button>
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
