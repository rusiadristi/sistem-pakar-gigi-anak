<?php
session_start();
require_once "koneksi.php";
include "library.php";

$id = isset($_GET['id_penyakit']) ? mysqli_real_escape_string($koneksi, $_GET['id_penyakit']) : '';
$kueri = mysqli_query($koneksi, "SELECT * FROM penyakit WHERE id_penyakit='$id'");
$isi = mysqli_fetch_array($kueri, MYSQLI_BOTH);

head('Detail Penyakit - ' . ($isi ? $isi['nm_penyakit'] : 'Data'), 1);
style(1);
?>
<body>
<?php
menu();
include "template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-list-alt" style="color:var(--primary);"></span> Detail Penyakit Gigi</h3>
    <div class="page-subtitle">Informasi lengkap dan penanganan medis untuk penyakit ini</div>
  </div>
  <div>
    <a href="informasi_penyakit.php" class="btn btn-default btn-sm">
      <span class="glyphicon glyphicon-arrow-left"></span> Kembali
    </a>
  </div>
</div>

<?php if($isi): ?>
  <div class="article-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; border-bottom:1px solid var(--slate-200); padding-bottom:12px;">
      <h3 style="margin:0; color:var(--primary); font-weight:800; font-size:22px;">
        <?php echo htmlspecialchars($isi['nm_penyakit']); ?>
      </h3>
      <span class="badge" style="background:var(--primary); font-size:13px; padding:6px 14px;">
        ID: <?php echo htmlspecialchars($isi['id_penyakit']); ?>
      </span>
    </div>

    <div style="font-size:14px; color:var(--slate-700); line-height:1.8;">
      <?php echo $isi['keterangan']; ?>
    </div>
  </div>
<?php else: ?>
  <div class="alert alert-warning">
    Data penyakit tidak ditemukan atau telah dihapus.
  </div>
<?php endif; ?>

<?php
include "template/kanan.php";
include "template/footer.php";
?>
