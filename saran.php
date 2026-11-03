<?php
session_start();
require_once "koneksi.php";
include "library.php";

$pesan = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$nm = mysqli_real_escape_string($koneksi, trim($_POST['Tnm_pengguna']));
	$saran = mysqli_real_escape_string($koneksi, trim($_POST['Tsaran']));
	if(!empty($nm) && !empty($saran)){
		$kueri = mysqli_query($koneksi, "INSERT INTO tbsaran (nama, saran, tgl_kirim) VALUES ('$nm', '$saran', NOW());");
		if($kueri){
			$pesan = pesan('success', "Terima kasih! Kritik dan saran Anda telah berhasil dikirim.", 0);
		} else {
			$pesan = pesan('danger', "Gagal mengirim pesan. Silakan coba lagi.", 0);
		}
	}
}

head('Kritik & Saran', 1);
style(1);
?>
<body>
<?php
menu();
include "template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-comment" style="color:var(--primary);"></span> Kritik &amp; Saran</h3>
    <div class="page-subtitle">Bantu kami meningkatkan kualitas layanan sistem pakar kesehatan gigi anak</div>
  </div>
</div>

<?php if(!empty($pesan)) echo $pesan; ?>

<!-- 2-Column Side-by-Side Layout (Form on Left, Feedback List on Right) -->
<div class="row">
  <!-- Left Column: Form Submission -->
  <div class="col-md-5 col-sm-12" style="margin-bottom:16px;">
    <div class="article-card">
      <h4 class="article-card-title">
        <span class="glyphicon glyphicon-pencil"></span> Tulis Masukan Anda
      </h4>
      <form method="POST">
        <div class="form-group">
          <label for="Tnm_pengguna"><strong>Nama Lengkap Anda :</strong></label>
          <input id="Tnm_pengguna" class="form-control" type="text" name="Tnm_pengguna" maxlength="50" required placeholder="Contoh: Bunda Siti" value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>" />
        </div>

        <div class="form-group">
          <label for="Tsaran"><strong>Kritik, Saran, atau Pertanyaan :</strong></label>
          <textarea id="Tsaran" class="form-control" name="Tsaran" minlength="5" rows="4" required placeholder="Tuliskan pengalaman atau masukan Anda mengenai sistem pakar ini..."></textarea>
        </div>

        <div style="display:flex; gap:8px;">
          <button type="submit" name="Bsimpan" class="btn btn-primary btn-block">
            <span class="glyphicon glyphicon-send"></span> Kirim Masukan
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Right Column: User Feedback Stream (Scrollable to prevent vertical stretch) -->
  <div class="col-md-7 col-sm-12">
    <div class="article-card" style="padding:16px;">
      <h4 class="article-card-title" style="margin-bottom:12px;">
        <span class="glyphicon glyphicon-list"></span> Masukan dari Pengguna Lain
      </h4>
      <div style="max-height: 420px; overflow-y: auto; padding-right: 4px;">
        <?php
        $kueri = mysqli_query($koneksi, "SELECT * FROM tbsaran ORDER BY id_saran DESC");
        if(mysqli_num_rows($kueri) < 1) {
          echo "<div class='alert alert-info' style='margin:0;'>Belum ada kritik dan saran yang masuk. Jadilah yang pertama memberikan masukan!</div>";
        } else {
          while ($isi = mysqli_fetch_array($kueri, MYSQLI_BOTH)){
            $tglStr = !empty($isi['tgl_kirim']) ? $isi['tgl_kirim'] : date('Y-m-d');
            $hari = substr($tglStr, 8, 2);
            $bulan = substr($tglStr, 5, 2);
            $tahun = substr($tglStr, 0, 4);
            $tglFormat = tanggal_indo($hari, $bulan, $tahun);
        ?>
          <div class="feedback-card">
            <div class="feedback-header">
              <div style="display:flex; align-items:center; gap:6px;">
                <span class="glyphicon glyphicon-user" style="color:var(--primary); font-size:11px;"></span>
                <span class="feedback-user"><?php echo htmlspecialchars($isi['nama']); ?></span>
              </div>
              <span class="feedback-date"><?php echo $tglFormat; ?></span>
            </div>
            <p class="feedback-text">
              &ldquo;<?php echo nl2br(htmlspecialchars($isi['saran'])); ?>&rdquo;
            </p>
          </div>
        <?php
          }
        }
        ?>
      </div>
    </div>
  </div>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>
