<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();

if(isset($_POST['Bsimpan'])){
	$id_gejala = mysqli_real_escape_string($koneksi, trim($_POST['Tid_gejala']));
	$nm_gejala = mysqli_real_escape_string($koneksi, trim($_POST['Tnm_gejala']));
	$kueri = mysqli_query($koneksi, "INSERT INTO tbgejala (id_gejala, nm_gejala) VALUES ('$id_gejala', '$nm_gejala');");
	if($kueri) {
		header('Location: gejala.php');
		exit();
	}
}

head('Tambah Gejala Baru', 2);
style(2);
?>
<body>
<?php
menu();
include "../template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-plus" style="color:var(--primary);"></span> Tambah Gejala Baru</h3>
    <div class="page-subtitle">Form input data gejala klinis baru</div>
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
      <label for="Tid_gejala"><strong>ID Gejala (Contoh: G14) :</strong></label>
      <input id="Tid_gejala" class="form-control" type="text" name="Tid_gejala" maxlength="10" required placeholder="G14" style="max-width:200px;" />
    </div>

    <div class="form-group">
      <label for="Tnm_gejala"><strong>Deskripsi Gejala Klinis :</strong></label>
      <input id="Tnm_gejala" class="form-control" type="text" name="Tnm_gejala" maxlength="255" required placeholder="Contoh: Gusi bengkak dan berwarna kemerahan" />
    </div>

    <div style="display:flex; gap:10px; margin-top:20px;">
      <button type="submit" name="Bsimpan" class="btn btn-success">
        <span class="glyphicon glyphicon-ok"></span> Simpan Gejala
      </button>
      <a href="gejala.php" class="btn btn-default">Batal</a>
    </div>
  </form>
</div>

<?php
include "../template/kanan.php";
include "../template/footer.php";
?>
