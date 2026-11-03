<?php
session_start();
require_once "koneksi.php";
include "library.php";
head('Informasi Penyakit', 1);
style(1);
?>
<body>
<?php
menu();
include "template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-info-sign" style="color:var(--primary);"></span> Informasi Penyakit Gigi Anak</h3>
    <div class="page-subtitle">Daftar penyakit gigi dan rongga mulut anak yang dapat dideteksi oleh sistem pakar</div>
  </div>
</div>

<div class="row">
<?php
$kueri = mysqli_query($koneksi, "SELECT * FROM penyakit ORDER BY id_penyakit ASC");
if(mysqli_num_rows($kueri) < 1) {
  echo "<div class='col-xs-12'><div class='alert alert-info'>Belum ada data penyakit gigi yang tersimpan.</div></div>";
} else {
  while ($isi = mysqli_fetch_array($kueri, MYSQLI_BOTH)){
?>
  <div class="col-md-6 col-sm-12" style="margin-bottom:16px;">
    <div class="article-card" style="height:100%; display:flex; flex-direction:column; justify-content:space-between; margin-bottom:0;">
      <div>
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px; margin-bottom:10px; border-bottom:1px solid var(--slate-100); padding-bottom:8px;">
          <h4 style="margin:0; font-size:16px; font-weight:700; color:var(--primary); display:flex; align-items:center; gap:6px;">
            <span class="glyphicon glyphicon-heart"></span> <?php echo htmlspecialchars($isi['nm_penyakit']); ?>
          </h4>
          <span class="badge" style="background:var(--teal); font-size:11px; padding:4px 10px;">
            Kode: <?php echo htmlspecialchars($isi['id_penyakit']); ?>
          </span>
        </div>
        <div style="color:var(--slate-700); line-height:1.6; font-size:12.5px;">
          <?php echo $isi['keterangan']; ?>
        </div>
      </div>
      <div style="margin-top:14px; padding-top:10px; border-top:1px solid var(--slate-100); text-align:right;">
        <a href="penyakit.php?id_penyakit=<?php echo urlencode($isi['id_penyakit']); ?>" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-fullscreen"></span> Detail Lengkap
        </a>
      </div>
    </div>
  </div>
<?php
  }
}
?>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>
