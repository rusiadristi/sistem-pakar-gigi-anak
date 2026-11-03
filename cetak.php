<?php
error_reporting(0);
require_once "koneksi.php";

$id_hasil = isset($_GET['id']) ? intval($_GET['id']) : 0;
$id_u = isset($_GET['id_u']) ? mysqli_real_escape_string($koneksi, $_GET['id_u']) : '';
$gjl = isset($_GET['gjl']) ? mysqli_real_escape_string($koneksi, $_GET['gjl']) : '';

$h = mysqli_query($koneksi, "SELECT * FROM tbhasil_konsultasi WHERE id_hasil='$id_hasil'");
$hasil = mysqli_fetch_array($h);

$quser = mysqli_query($koneksi, "SELECT * FROM tbuser WHERE id_user='$id_u'");
$user = mysqli_fetch_array($quser);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Cetak Hasil Diagnosa - Drg. Rusi Adristi</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 13px;
      color: #000;
      background: #fff;
      padding: 20px;
    }
    .print-container {
      max-width: 800px;
      margin: 0 auto;
    }
    .kop-surat {
      text-align: center;
      border-bottom: 3px double #000;
      padding-bottom: 12px;
      margin-bottom: 24px;
    }
    .kop-surat h2 {
      margin: 0;
      font-size: 20px;
      font-weight: bold;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    .kop-surat h3 {
      margin: 4px 0;
      font-size: 16px;
      font-weight: bold;
      color: #0284c7;
    }
    .kop-surat p {
      margin: 2px 0 0;
      font-size: 12px;
    }
    .table-bordered th, .table-bordered td {
      border: 1px solid #444 !important;
      padding: 6px 10px !important;
      font-size: 12px;
    }
    .table-bordered th {
      background-color: #f2f2f2 !important;
    }
    .section-title {
      font-size: 14px;
      font-weight: bold;
      margin-top: 18px;
      margin-bottom: 8px;
      border-bottom: 1px solid #ccc;
      padding-bottom: 4px;
    }
    .signature-area {
      margin-top: 40px;
      float: right;
      width: 250px;
      text-align: center;
    }
    @media print {
      body { padding: 0; }
      .no-print { display: none; }
    }
  </style>
</head>
<body onload="window.print()">
  <div class="print-container">
    <!-- Kop Surat -->
    <div class="kop-surat">
      <h2>Sistem Pakar Diagnosa Penyakit Gigi Pada Anak</h2>
      <h3>Praktek Mandiri Drg. Rusi Adristi</h3>
      <p>Padang, Sumatera Barat, Indonesia &bull; Layanan Konsultasi &amp; Kesehatan Gigi Anak</p>
    </div>

    <div style="text-align:center; margin-bottom:20px;">
      <h4 style="margin:0; font-weight:bold; text-transform:uppercase; text-decoration:underline;">SURAT HASIL KONSULTASI DIAGNOSA</h4>
      <div style="font-size:12px; color:#555;">No. Rekam: <?php echo htmlspecialchars($user['id_user']); ?>/<?php echo date('Ymd'); ?></div>
    </div>

    <!-- Data Pasien -->
    <div class="section-title">I. DATA PASIEN</div>
    <table class="table table-bordered table-condensed">
      <tr>
        <th width="30%">ID Pasien</th>
        <td><?php echo htmlspecialchars($user['id_user']); ?></td>
      </tr>
      <tr>
        <th>Nama Pasien / Orang Tua</th>
        <td><strong><?php echo htmlspecialchars($user['nm_pengguna']); ?></strong></td>
      </tr>
      <tr>
        <th>Tanggal / Waktu Konsultasi</th>
        <td><?php echo date('d-m-Y H:i'); ?> WIB</td>
      </tr>
      <tr>
        <th>Nomor Telepon / HP</th>
        <td><?php echo htmlspecialchars($user['nohp']); ?></td>
      </tr>
      <tr>
        <th>Email</th>
        <td><?php echo htmlspecialchars($user['email']); ?></td>
      </tr>
    </table>

    <!-- Gejala yang Dipilih -->
    <div class="section-title">II. GEJALA KLINIS YANG DIALAMI</div>
    <table class="table table-bordered table-condensed">
      <thead>
        <tr>
          <th width="15%" class="text-center">Kode</th>
          <th>Nama Gejala Klinis</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $pecahgp = array_filter(explode(",", $gjl));
        if(!empty($pecahgp)){
          foreach($pecahgp as $val){
            $cleanV = mysqli_real_escape_string($koneksi, $val);
            $qb = mysqli_query($koneksi, "SELECT * FROM tbgejala WHERE id_gejala='$cleanV'");
            $b = mysqli_fetch_array($qb);
            echo "<tr>";
            echo "<td align='center'><strong>{$cleanV}</strong></td>";
            echo "<td>" . htmlspecialchars($b['nm_gejala']) . "</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='2' align='center'>Tidak ada gejala yang dipilih</td></tr>";
        }
        ?>
      </tbody>
    </table>

    <!-- Hasil Diagnosa -->
    <div class="section-title">III. KESIMPULAN DIAGNOSA PAKAR</div>
    <?php
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
        }
      }
    }

    if($terdeteksi == "ya"){
      foreach($diagnosa_penyakit as $dp){
        echo "<div style='border:1px solid #444; padding:12px; background:#f9f9f9; margin-bottom:10px;'>";
        echo "<div style='font-size:14px; font-weight:bold; color:#0284c7; margin-bottom:6px;'>Terdiagnosa: {$dp['nm_penyakit']}</div>";
        echo "<div><strong>Solusi &amp; Penanganan Medis:</strong><br/>" . $dp['keterangan'] . "</div>";
        echo "</div>";
      }
    } else {
      echo "<div style='border:1px solid #444; padding:12px; background:#f9f9f9;'>";
      echo "<strong>Hasil:</strong> Tidak terdeteksi penyakit spesifik dari aturan inferensi yang tersedia. Disarankan konsultasi langsung untuk pemeriksaan klinis.";
      echo "</div>";
    }
    ?>

    <!-- Tanda Tangan -->
    <div style="clear:both;"></div>
    <div class="signature-area">
      <div>Padang, <?php echo date('d F Y'); ?></div>
      <div style="margin-top:4px;">Dokter Gigi Pemeriksa,</div>
      <div style="height:70px;"></div>
      <div style="font-weight:bold; text-decoration:underline;">Drg. Rusi Adristi</div>
      <div style="font-size:11px;">SIP: Praktek Dokter Mandiri</div>
    </div>

    <div style="clear:both;"></div>
    <div class="no-print" style="margin-top:40px; text-align:center;">
      <button onclick="window.print()" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span> Cetak Ulang Dokumen</button>
      <button onclick="window.close()" class="btn btn-default">Tutup Jendela</button>
    </div>
  </div>
</body>
</html>
