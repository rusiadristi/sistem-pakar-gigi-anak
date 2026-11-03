<?php
@session_start();
require_once "../koneksi.php";

$id = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

if(empty($id)){
  if($_SESSION['id_tipe'] == 1) {
    $kueri = mysqli_query($koneksi, "SELECT * FROM tbhasil_konsultasi, penyakit WHERE tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit ORDER BY tbhasil_konsultasi.tgl_hasil DESC;");
  } else {
    $kueri = mysqli_query($koneksi, "SELECT * FROM tbhasil_konsultasi, penyakit WHERE tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit AND tbhasil_konsultasi.username='{$_SESSION['username']}' GROUP BY tbhasil_konsultasi.tgl_hasil ORDER BY tbhasil_konsultasi.tgl_hasil DESC;");
  }
} else {
  if($_SESSION['id_tipe'] == 1) {
    $kueri = mysqli_query($koneksi, "SELECT * FROM tbhasil_konsultasi, penyakit WHERE tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit AND tbhasil_konsultasi.tgl_hasil LIKE '$id%' GROUP BY tbhasil_konsultasi.tgl_hasil ORDER BY tbhasil_konsultasi.tgl_hasil DESC;");
  } else {
    $kueri = mysqli_query($koneksi, "SELECT * FROM tbhasil_konsultasi, penyakit WHERE tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit AND tbhasil_konsultasi.username='{$_SESSION['username']}' AND tbhasil_konsultasi.tgl_hasil LIKE '$id%' GROUP BY tbhasil_konsultasi.tgl_hasil ORDER BY tbhasil_konsultasi.tgl_hasil DESC;");
  }
}
$no = 1;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Laporan Rekapitulasi Diagnosa - Drg. Rusi Adristi</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 13px;
      color: #000;
      background: #fff;
      padding: 20px;
    }
    .print-container {
      max-width: 900px;
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
    <div class="kop-surat">
      <h2>Sistem Pakar Diagnosa Penyakit Gigi Pada Anak</h2>
      <h3>Praktek Mandiri Drg. Rusi Adristi</h3>
      <p>Padang, Sumatera Barat, Indonesia &bull; Layanan Konsultasi &amp; Kesehatan Gigi Anak</p>
    </div>

    <div style="text-align:center; margin-bottom:20px;">
      <h4 style="margin:0; font-weight:bold; text-transform:uppercase;">REKAPITULASI HASIL KONSULTASI DIAGNOSA</h4>
      <?php if(!empty($id)): ?>
        <div style="font-size:12px; color:#555; margin-top:4px;">Filter Tanggal: <?php echo date('d F Y', strtotime($id)); ?></div>
      <?php endif; ?>
    </div>

    <table class="table table-bordered table-condensed">
      <thead>
        <tr>
          <th width="5%" class="text-center">No</th>
          <?php if($_SESSION['id_tipe'] == 1): ?>
            <th>Username</th>
            <th>ID Pasien</th>
          <?php endif; ?>
          <th>Nama Penyakit</th>
          <th>Waktu Diagnosa</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if(mysqli_num_rows($kueri) < 1) {
          $colspan = ($_SESSION['id_tipe'] == 1) ? 5 : 3;
          echo "<tr><td colspan='{$colspan}' class='text-center'>Data hasil konsultasi kosong...</td></tr>";
        } else {
          while ($isi = mysqli_fetch_array($kueri, MYSQLI_BOTH)){
            echo "<tr>";
            echo "<td align='center'>{$no}</td>";
            if($_SESSION['id_tipe'] == 1) {
              echo "<td>{$isi['username']}</td>";
              echo "<td>{$isi['id_user']}</td>";
            }
            echo "<td><strong>{$isi['nm_penyakit']}</strong></td>";
            echo "<td>" . date('d-m-Y H:i', strtotime($isi['tgl_hasil'])) . " WIB</td>";
            echo "</tr>";
            $no++;
          }
        }
        ?>
      </tbody>
    </table>

    <div class="signature-area">
      <div>Padang, <?php echo date('d F Y'); ?></div>
      <div style="margin-top:4px;">
        <?php echo ($_SESSION['id_tipe'] == 1) ? 'Dokter Gigi Spesialis,' : 'Pasien / Member,'; ?>
      </div>
      <div style="height:70px;"></div>
      <div style="font-weight:bold; text-decoration:underline;">
        <?php echo ($_SESSION['id_tipe'] == 1) ? 'Drg. Rusi Adristi' : htmlspecialchars($_SESSION['username']); ?>
      </div>
      <div style="font-size:11px;">
        <?php echo ($_SESSION['id_tipe'] == 1) ? 'SIP: Praktek Dokter Mandiri' : 'Terdaftar di Sistem'; ?>
      </div>
    </div>

    <div style="clear:both;"></div>
    <div class="no-print" style="margin-top:40px; text-align:center;">
      <button onclick="window.print()" class="btn btn-primary">Cetak Dokumen</button>
      <button onclick="window.close()" class="btn btn-default">Tutup Jendela</button>
    </div>
  </div>
</body>
</html>
