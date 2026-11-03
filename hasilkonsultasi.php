<?php
session_start();
error_reporting(0);
require_once "koneksi.php";
include "library.php";

$id = $_SESSION['id_user'];
cek_akses(3);

head('Hasil Konsultasi', 1);
style(1);
?>
<body>
<?php
menu();
include "template/kiri.php";

$quser = mysqli_query($koneksi, "SELECT * FROM tbuser WHERE id_user='$id'");
$user = mysqli_fetch_array($quser);

$s = isset($_GET['gjl']) ? trim($_GET['gjl']) : "";
$pecahgp = array_filter(explode(",", $s));

// Inference Algorithm
$terdeteksi = "tidak";
$diagnosa_penyakit = array();

$p = mysqli_query($koneksi, "SELECT * FROM penyakit ORDER BY id_penyakit ASC");
$hp = array();

while($rp = mysqli_fetch_array($p)){
  $atas = 0;
  $jb = mysqli_query($koneksi, "SELECT * FROM rule WHERE id_penyakit='{$rp['id_penyakit']}'");
  $bawah = mysqli_num_rows($jb);

  if($bawah > 0){
    foreach($pecahgp as $value){
      $valClean = mysqli_real_escape_string($koneksi, $value);
      $qrule = mysqli_query($koneksi, "SELECT * FROM rule WHERE id_penyakit='{$rp['id_penyakit']}' AND id_gejala='$valClean'");
      if(mysqli_num_rows($qrule) > 0){
        $atas++;
      }
    }
    $idk = $rp['id_penyakit'];
    $hp[$idk] = $atas / $bawah;
  }
}

$max = !empty($hp) ? max($hp) : 0;
if($max == 1){
  $p2 = mysqli_query($koneksi, "SELECT * FROM penyakit ORDER BY id_penyakit ASC");
  while($h2 = mysqli_fetch_array($p2)){
    $idk = $h2['id_penyakit'];
    if($hp[$idk] == 1){
      $terdeteksi = "ya";
      $diagnosa_penyakit[] = $h2;
      // Record to history
      $safeS = mysqli_real_escape_string($koneksi, $s);
      mysqli_query($koneksi, "INSERT INTO tbhasil_konsultasi (id_user, username, id_penyakit, tgl_hasil, gejala_dipilih) VALUES ('{$_SESSION['id_user']}', '{$_SESSION['username']}', '{$h2['id_penyakit']}', NOW(), '$safeS')");
    }
  }
}
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-file" style="color:var(--primary);"></span> Hasil Konsultasi Diagnosa</h3>
    <div class="page-subtitle">Laporan ringkasan diagnosa gigi anak berdasarkan gejala klinis yang dipilih</div>
  </div>
  <div>
    <?php
    $c = mysqli_query($koneksi, "SELECT * FROM tbhasil_konsultasi WHERE username='{$_SESSION['username']}' ORDER BY tgl_hasil DESC LIMIT 1");
    $cetak = mysqli_fetch_array($c);
    $idHasil = $cetak ? $cetak['id_hasil'] : 0;
    ?>
    <a class="btn btn-primary" href="cetak.php?id=<?php echo $idHasil; ?>&id_u=<?php echo urlencode($id); ?>&gjl=<?php echo urlencode($s); ?>" target="_blank">
      <span class="glyphicon glyphicon-print"></span> Cetak Hasil (PDF)
    </a>
    <a class="btn btn-default" href="konsultasi.php?hal=1">
      <span class="glyphicon glyphicon-repeat"></span> Konsultasi Ulang
    </a>
  </div>
</div>

<!-- Side-by-Side 2 Columns (Compact Layout) -->
<div class="row">
  <!-- Left Column: Patient Info & Symptoms Selected -->
  <div class="col-md-5 col-sm-12" style="margin-bottom:16px;">
    <!-- Data Pasien -->
    <div class="article-card" style="margin-bottom:14px;">
      <h4 class="article-card-title">
        <span class="glyphicon glyphicon-user"></span> Data Diri Pasien
      </h4>
      <table class="table table-bordered table-condensed" style="margin-bottom:0;">
        <tbody>
          <tr>
            <th width="40%" style="background-color:var(--slate-100);">Tanggal</th>
            <td><?php echo date('d-m-Y H:i'); ?> WIB</td>
          </tr>
          <tr>
            <th style="background-color:var(--slate-100);">ID Pasien</th>
            <td><span class="badge" style="background:var(--primary);"><?php echo htmlspecialchars($user['id_user']); ?></span></td>
          </tr>
          <tr>
            <th style="background-color:var(--slate-100);">Nama Pasien</th>
            <td><strong><?php echo htmlspecialchars($user['nm_pengguna']); ?></strong></td>
          </tr>
          <tr>
            <th style="background-color:var(--slate-100);">No. HP / WA</th>
            <td><?php echo htmlspecialchars($user['nohp']); ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Gejala yang Dipilih -->
    <div class="article-card" style="margin-bottom:0;">
      <h4 class="article-card-title">
        <span class="glyphicon glyphicon-check"></span> Gejala yang Dialami
      </h4>
      <?php if(empty($pecahgp)): ?>
        <p style="color:var(--slate-600); font-style:italic; font-size:12px; margin:0;">Tidak ada gejala yang dipilih.</p>
      <?php else: ?>
        <div style="max-height:220px; overflow-y:auto; border:1px solid var(--slate-200); border-radius:6px;">
          <table class="table table-hover table-condensed" style="margin-bottom:0;">
            <tbody>
              <?php
              foreach($pecahgp as $value2){
                $valClean = mysqli_real_escape_string($koneksi, $value2);
                $qb = mysqli_query($koneksi, "SELECT * FROM tbgejala WHERE id_gejala='$valClean'");
                $b = mysqli_fetch_array($qb);
                echo "<tr>";
                echo "<td width='20%'><span class='badge' style='background:var(--teal); font-size:11px;'>{$valClean}</span></td>";
                echo "<td style='font-size:12px;'>" . htmlspecialchars($b['nm_gejala']) . "</td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Right Column: Medical Diagnosis & Treatment Advice -->
  <div class="col-md-7 col-sm-12">
    <?php if($terdeteksi == "ya"): ?>
      <?php foreach($diagnosa_penyakit as $itemPenyakit): ?>
        <div class="result-card result-detected" style="margin-bottom:14px;">
          <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
            <span class="glyphicon glyphicon-alert" style="color:var(--danger); font-size:22px;"></span>
            <div>
              <span class="badge" style="background:var(--danger); font-size:10px;">TERDIAGNOSA KLINIS</span>
              <h3 style="margin:2px 0 0; color:#b91c1c; font-weight:800; font-size:18px;">
                <?php echo htmlspecialchars($itemPenyakit['nm_penyakit']); ?>
              </h3>
            </div>
          </div>
          <hr style="margin:10px 0; border-color:#fca5a5;">
          <div style="color:var(--slate-700); line-height:1.6; font-size:12.5px;">
            <strong style="color:var(--slate-900);">Keterangan &amp; Solusi Penanganan Medis:</strong>
            <div style="margin-top:6px;">
              <?php echo $itemPenyakit['keterangan']; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="result-card result-healthy" style="margin-bottom:14px;">
        <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px;">
          <span class="glyphicon glyphicon-ok-sign" style="color:var(--success); font-size:24px;"></span>
          <div>
            <span class="badge" style="background:var(--success); font-size:10px;">TIDAK TERDETEKSI PENYAKIT SPESIFIK</span>
            <h3 style="margin:2px 0 0; color:#15803d; font-weight:800; font-size:17px;">
              Gejala Tidak Menunjukkan Kerusakan Pulpa Akut
            </h3>
          </div>
        </div>
        <hr style="margin:10px 0; border-color:#bbf7d0;">
        <p style="color:var(--slate-700); line-height:1.6; font-size:12.5px; margin:0;">
          Kombinasi gejala yang Anda pilih belum memenuhi aturan klinis penyakit pada sistem pakar. Jika rasa nyeri berlanjut, segera periksa langsung ke <strong>Drg. Rusi Adristi</strong> untuk diagnosa fisik lebih lanjut.
        </p>
      </div>
    <?php endif; ?>

    <!-- Clinical Doctor Recommendation Box -->
    <div style="background:var(--slate-50); border:1px solid var(--slate-200); border-radius:8px; padding:12px 16px; display:flex; align-items:center; gap:12px;">
      <span class="glyphicon glyphicon-user" style="font-size:20px; color:var(--primary);"></span>
      <div style="font-size:12px; color:var(--slate-600); line-height:1.4;">
        Surat hasil diagnosa ini dapat dicetak dan ditunjukkan langsung kepada <strong>Drg. Rusi Adristi</strong> saat kunjungan klinik untuk tindakan kuratif yang tepat.
      </div>
    </div>
  </div>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>
