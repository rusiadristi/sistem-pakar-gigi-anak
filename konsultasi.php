<?php
session_start();
error_reporting(0);
require_once "koneksi.php";
include "library.php";
cek_akses(3);

$hal = isset($_GET['hal']) ? intval($_GET['hal']) : 1;
if($hal < 1) $hal = 1;

$gejala = mysqli_query($koneksi, "SELECT * FROM tbgejala ORDER BY id_gejala ASC");
$jml = mysqli_num_rows($gejala);

if($hal > $jml && $jml > 0) {
	$hal = $jml;
}

$percent = ($jml > 0) ? round(($hal / $jml) * 100) : 0;
$posisi = $hal - 1;
$g = mysqli_query($koneksi, "SELECT * FROM tbgejala ORDER BY id_gejala ASC LIMIT $posisi, 1");
$r = mysqli_fetch_array($g);

head('Konsultasi Diagnosa Gigi Anak', 1);
style(1);
?>
<body>
<?php
menu();
include "template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-stethoscope" style="color:var(--primary);"></span> Konsultasi Diagnosa Mandiri</h3>
    <div class="page-subtitle">Jawab pertanyaan gejala berikut sesuai kondisi kesehatan gigi anak Anda saat ini</div>
  </div>
  <div>
    <span class="badge" style="background:var(--primary); font-size:13px; padding:6px 14px;">
      Pertanyaan <?php echo $hal; ?> dari <?php echo $jml; ?>
    </span>
  </div>
</div>

<!-- Diagnostic Question Card (Full Width Fluid Workspace) -->
<div class="consultation-wizard">
  <!-- Full-Width Progress Bar -->
  <div style="margin-bottom: 22px;">
    <div style="display:flex; justify-content:space-between; font-size:12px; color:var(--slate-600); margin-bottom:6px;">
      <span>Tahap Pemeriksaan Gejala Klinis</span>
      <strong><?php echo $percent; ?>% Selesai</strong>
    </div>
    <div class="consultation-progress">
      <div class="consultation-progress-bar" style="width: <?php echo $percent; ?>%;"></div>
    </div>
  </div>

  <div class="question-icon-badge">
    <span class="glyphicon glyphicon-question-sign"></span>
  </div>
  <div style="font-size:12px; text-transform:uppercase; letter-spacing:0.06em; color:var(--primary); font-weight:700; margin-bottom:8px;">
    Kode Gejala: <?php echo htmlspecialchars($r['id_gejala']); ?>
  </div>
  <h2 class="question-title">
    Apakah anak Anda mengalami <br>
    <span style="color:var(--primary); font-weight:800; font-size:24px;">"<?php echo htmlspecialchars($r['nm_gejala']); ?>"</span> ?
  </h2>

  <div style="margin-top: 28px;">
    <?php
    $current_gjl = isset($_GET['gjl']) ? trim($_GET['gjl']) : "";
    if($current_gjl != ""){
      $gjl_yes = $current_gjl . "," . $r['id_gejala'];
    } else {
      $gjl_yes = $r['id_gejala'];
    }
    $gjl_no = $current_gjl;

    if($hal >= $jml){
      $link_yes = "hasilkonsultasi.php?gjl=" . urlencode($gjl_yes);
      $link_no  = "hasilkonsultasi.php?gjl=" . urlencode($gjl_no);
    } else {
      $next_hal = $hal + 1;
      $link_yes = "konsultasi.php?hal=" . $next_hal . "&gjl=" . urlencode($gjl_yes);
      $link_no  = "konsultasi.php?hal=" . $next_hal . "&gjl=" . urlencode($gjl_no);
    }
    ?>
    <div class="consultation-actions">
      <a href="<?php echo $link_yes; ?>" class="btn btn-success btn-lg" style="min-width:200px; padding:12px 28px; font-size:15px;">
        <span class="glyphicon glyphicon-ok"></span> <strong>Ya, Mengalami</strong>
      </a>
      <a href="<?php echo $link_no; ?>" class="btn btn-danger btn-lg" style="min-width:200px; padding:12px 28px; font-size:15px;">
        <span class="glyphicon glyphicon-remove"></span> <strong>Tidak</strong>
      </a>
    </div>
  </div>

  <div style="margin-top: 28px; font-size:12.5px; color:var(--slate-600); border-top:1px solid var(--slate-200); padding-top:16px;">
    <span class="glyphicon glyphicon-info-sign" style="color:var(--primary);"></span> Jawab pertanyaan dengan cermat untuk memastikan akurasi diagnosa kesimpulan sistem pakar.
  </div>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>
