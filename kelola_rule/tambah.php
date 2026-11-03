<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();

if(isset($_POST['Bsimpan'])){
	$penyakit = mysqli_real_escape_string($koneksi, trim($_POST['penyakit']));
	$gejala = mysqli_real_escape_string($koneksi, trim($_POST['gejala']));
	
	if(!empty($penyakit) && !empty($gejala)){
		// Check duplicate
		$cek = mysqli_query($koneksi, "SELECT * FROM rule WHERE id_penyakit='$penyakit' AND id_gejala='$gejala'");
		if(mysqli_num_rows($cek) < 1){
			$kueri = mysqli_query($koneksi, "INSERT INTO rule (id_penyakit, id_gejala) VALUES ('$penyakit', '$gejala');");
		}
		header('Location: rule.php');
		exit();
	}
}

head('Tambah Aturan Rule', 2);
style(2);
?>
<body>
<?php
menu();
include "../template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-plus" style="color:var(--primary);"></span> Tambah Aturan (Rule)</h3>
    <div class="page-subtitle">Hubungkan gejala klinis dengan diagnosa penyakit</div>
  </div>
  <div>
    <a href="rule.php" class="btn btn-default btn-sm">
      <span class="glyphicon glyphicon-arrow-left"></span> Kembali
    </a>
  </div>
</div>

<div class="article-card" style="padding: 24px;">
  <form method="POST">
    <div class="form-group">
      <label for="penyakit"><strong>Pilih Penyakit :</strong></label>
      <select name="penyakit" id="penyakit" class="form-control" required>
        <option value="">-- Pilih Penyakit Gigi --</option>
        <?php
        $k = mysqli_query($koneksi, "SELECT * FROM penyakit ORDER BY id_penyakit ASC");
        while($rk = mysqli_fetch_array($k, MYSQLI_BOTH)){
          echo "<option value='{$rk['id_penyakit']}'>{$rk['id_penyakit']} - {$rk['nm_penyakit']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-group">
      <label for="gejala"><strong>Pilih Gejala Klinis :</strong></label>
      <select name="gejala" id="gejala" class="form-control" required>
        <option value="">-- Pilih Gejala --</option>
        <?php
        $k = mysqli_query($koneksi, "SELECT * FROM tbgejala ORDER BY id_gejala ASC");
        while($rk = mysqli_fetch_array($k, MYSQLI_BOTH)){
          echo "<option value='{$rk['id_gejala']}'>{$rk['id_gejala']} - {$rk['nm_gejala']}</option>";
        }
        ?>
      </select>
    </div>

    <div style="display:flex; gap:10px; margin-top:20px;">
      <button type="submit" name="Bsimpan" class="btn btn-success">
        <span class="glyphicon glyphicon-ok"></span> Simpan Relasi Rule
      </button>
      <a href="rule.php" class="btn btn-default">Batal</a>
    </div>
  </form>
</div>

<?php
include "../template/kanan.php";
include "../template/footer.php";
?>
