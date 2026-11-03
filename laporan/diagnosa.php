<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_login();

head('Laporan Hasil Konsultasi Diagnosa', 2);
style(2);
?>
<body>
<?php
menu();
include "../template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-print" style="color:var(--primary);"></span> Laporan Hasil Konsultasi</h3>
    <div class="page-subtitle">Rekapitulasi riwayat diagnosa penyakit gigi pasien</div>
  </div>
  <div>
    <?php
    $filter_tgl = isset($_POST['tanggal']) ? mysqli_real_escape_string($koneksi, trim($_POST['tanggal'])) : '';
    ?>
    <a href="laporan_diagnosa.php<?php echo !empty($filter_tgl) ? '?id='.$filter_tgl : ''; ?>" target="_blank" class="btn btn-success btn-sm">
      <span class="glyphicon glyphicon-print"></span> Cetak Rekap Laporan (PDF)
    </a>
  </div>
</div>

<?php
if(!empty($filter_tgl) && $filter_tgl != '0'){
  if($_SESSION['id_tipe'] == 1) {
    $kueri = mysqli_query($koneksi, "SELECT * FROM tbhasil_konsultasi, penyakit WHERE tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit AND tbhasil_konsultasi.tgl_hasil LIKE '$filter_tgl%' GROUP BY tbhasil_konsultasi.tgl_hasil ORDER BY tbhasil_konsultasi.tgl_hasil DESC;");
  } else {
    $kueri = mysqli_query($koneksi, "SELECT * FROM tbhasil_konsultasi, penyakit WHERE tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit AND tbhasil_konsultasi.username='{$_SESSION['username']}' AND tbhasil_konsultasi.tgl_hasil LIKE '$filter_tgl%' GROUP BY tbhasil_konsultasi.tgl_hasil ORDER BY tbhasil_konsultasi.tgl_hasil DESC;");
  }
} else {
  if($_SESSION['id_tipe'] == 1) {
    $kueri = mysqli_query($koneksi, "SELECT * FROM tbhasil_konsultasi, penyakit WHERE tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit ORDER BY tbhasil_konsultasi.tgl_hasil DESC;");
  } else {
    $kueri = mysqli_query($koneksi, "SELECT * FROM tbhasil_konsultasi, penyakit WHERE tbhasil_konsultasi.id_penyakit=penyakit.id_penyakit AND tbhasil_konsultasi.username='{$_SESSION['username']}' GROUP BY tbhasil_konsultasi.tgl_hasil ORDER BY tbhasil_konsultasi.tgl_hasil DESC;");
  }
}
$no = 1;
?>

<!-- Filter Card (Compact Horizontal) -->
<div class="article-card" style="margin-bottom:14px; padding:10px 16px;">
  <form name="dd" action="diagnosa.php" method="POST" class="form-inline" style="display:flex; align-items:center; flex-wrap:wrap; gap:10px;">
    <div class="form-group" style="margin-bottom:0;">
      <label for="tanggal" style="margin-right:8px; font-size:12.5px;">Filter Tanggal:</label>
      <select name="tanggal" id="tanggal" class="form-control input-sm" style="min-width:220px;">
        <option value="0">-- Semua Riwayat Konsultasi --</option>
        <?php
        $result = mysqli_query($koneksi, "SELECT DATE(tgl_hasil) as tgl_only FROM tbhasil_konsultasi GROUP BY DATE(tgl_hasil) ORDER BY tgl_only DESC");
        while ($row = mysqli_fetch_array($result)) {
          $sel = ($filter_tgl == $row['tgl_only']) ? 'selected' : '';
          echo '<option value="' . $row['tgl_only'] . '" ' . $sel . '>' . date('d F Y', strtotime($row['tgl_only'])) . '</option>';
        }
        ?>
      </select>
    </div>
    <button name="cari" type="submit" class="btn btn-primary btn-sm">
      <span class="glyphicon glyphicon-filter"></span> Tampilkan
    </button>
  </form>
</div>

<!-- Table Data (Full Width) -->
<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead>
      <tr class="info">
        <th width="5%" class="text-center">No</th>
        <?php if($_SESSION['id_tipe'] == 1): ?>
          <th width="18%">Username</th>
          <th width="15%">ID Pasien</th>
        <?php endif; ?>
        <th>Penyakit Terdiagnosa</th>
        <th width="22%">Waktu Konsultasi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(mysqli_num_rows($kueri) < 1) {
        $colspan = ($_SESSION['id_tipe'] == 1) ? 5 : 3;
        echo "<tr><td class='text-center' colspan='{$colspan}' style='padding:20px; color:var(--slate-600);'><strong>Belum ada riwayat hasil konsultasi...</strong></td></tr>";
      } else {
        while ($isi = mysqli_fetch_array($kueri, MYSQLI_BOTH)){
          echo "<tr>";
          echo "<td class='text-center'>{$no}</td>";
          if($_SESSION['id_tipe'] == 1) {
            echo "<td><span class='glyphicon glyphicon-user'></span> {$isi['username']}</td>";
            echo "<td><span class='badge' style='background:var(--primary);'>{$isi['id_user']}</span></td>";
          }
          echo "<td><strong style='color:#0369a1;'>{$isi['nm_penyakit']}</strong></td>";
          echo "<td>" . date('d-m-Y H:i', strtotime($isi['tgl_hasil'])) . " WIB</td>";
          echo "</tr>";
          $no++;
        }
      }
      ?>
    </tbody>
  </table>
</div>

<?php
include "../template/kanan.php";
include "../template/footer.php";
?>
