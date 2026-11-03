<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();
head('Kelola Basis Aturan (Rule)', 2);
style(2);
?>
<body>
<?php
menu();
include "../template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-random" style="color:var(--primary);"></span> Kelola Basis Aturan (Rule)</h3>
    <div class="page-subtitle">Relasi antara penyakit dan gejala klinis untuk metode inferensi</div>
  </div>
  <div>
    <a href="tambah.php" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span> Tambah Aturan Baru
    </a>
  </div>
</div>

<?php
$kueri = mysqli_query($koneksi, "SELECT * FROM penyakit ORDER BY id_penyakit ASC;");
$no = 1;
?>

<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead>
      <tr class="info">
        <th width="5%" class="text-center">No</th>
        <th width="28%">Nama Penyakit</th>
        <th>Daftar Gejala Terkait</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(mysqli_num_rows($kueri) < 1) {
        echo "<tr><td class='text-center' colspan='3' style='padding:20px;'><strong>Data rule kosong...</strong></td></tr>";
      } else {
        while ($isi = mysqli_fetch_array($kueri, MYSQLI_BOTH)){
      ?>
        <tr>
          <td class="text-center"><?php echo $no; ?></td>
          <td>
            <span class="badge" style="background:var(--primary);"><?php echo htmlspecialchars($isi['id_penyakit']); ?></span>
            <strong style="margin-left:6px; color:var(--slate-900);"><?php echo htmlspecialchars($isi['nm_penyakit']); ?></strong>
          </td>
          <td>
            <?php
            $qr = mysqli_query($koneksi, "SELECT * FROM rule r, tbgejala g WHERE g.id_gejala=r.id_gejala AND r.id_penyakit='{$isi['id_penyakit']}'");
            if(mysqli_num_rows($qr) < 1){
              echo "<span style='color:var(--slate-600); font-style:italic; font-size:12px;'>Belum ada gejala yang dihubungkan ke penyakit ini.</span>";
            } else {
              while($r = mysqli_fetch_array($qr, MYSQLI_BOTH)){
            ?>
              <div style="display:flex; align-items:center; justify-content:space-between; background:var(--slate-50); border:1px solid var(--slate-200); border-radius:6px; padding:6px 10px; margin-bottom:6px;">
                <span style="font-size:12px; color:var(--slate-700);">
                  <strong style="color:var(--teal);"><?php echo htmlspecialchars($r['id_gejala']); ?></strong> &ndash; <?php echo htmlspecialchars($r['nm_gejala']); ?>
                </span>
                <a href="hapus.php?id_rule=<?php echo urlencode($r['id_rule']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus gejala ini dari rule?')" class="btn btn-danger btn-xs" title="Hapus Relasi">
                  <span class="glyphicon glyphicon-trash"></span>
                </a>
              </div>
            <?php
              }
            }
            ?>
          </td>
        </tr>
      <?php
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
