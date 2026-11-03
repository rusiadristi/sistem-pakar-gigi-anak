<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();
head('Kelola Data Penyakit Gigi', 2);
style(2);
?>
<body>
<?php
menu();
include "../template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-list-alt" style="color:var(--primary);"></span> Kelola Data Penyakit</h3>
    <div class="page-subtitle">Manajemen daftar diagnosa penyakit gigi pada sistem pakar</div>
  </div>
  <div>
    <a href="tambah.php" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span> Tambah Penyakit Baru
    </a>
  </div>
</div>

<?php
$kueri = mysqli_query($koneksi, "SELECT * FROM penyakit ORDER BY id_penyakit ASC");
$no = 1;
?>

<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead>
      <tr class="info">
        <th width="5%" class="text-center">No</th>
        <th width="12%">ID Penyakit</th>
        <th width="25%">Nama Penyakit</th>
        <th>Keterangan / Solusi Penanganan</th>
        <th width="18%" class="text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(mysqli_num_rows($kueri) < 1) {
        echo "<tr><td class='text-center' colspan='5' style='padding:20px;'><strong>Data penyakit kosong...</strong></td></tr>";
      } else {
        while ($isi = mysqli_fetch_array($kueri, MYSQLI_BOTH)){
      ?>
        <tr>
          <td class="text-center"><?php echo $no; ?></td>
          <td><span class="badge" style="background:var(--primary);"><?php echo htmlspecialchars($isi['id_penyakit']); ?></span></td>
          <td><strong style="color:var(--slate-900);"><?php echo htmlspecialchars($isi['nm_penyakit']); ?></strong></td>
          <td style="font-size:12px; color:var(--slate-600); line-height:1.5;">
            <?php echo $isi['keterangan']; ?>
          </td>
          <td class="text-center">
            <a href="edit.php?id_penyakit=<?php echo urlencode($isi['id_penyakit']); ?>" class="btn btn-primary btn-sm">
              <span class="glyphicon glyphicon-edit"></span> Edit
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#konfirmasi<?php echo $isi['id_penyakit']; ?>">
              <span class="glyphicon glyphicon-trash"></span> Hapus
            </button>

            <!-- Delete Confirmation Modal -->
            <div id="konfirmasi<?php echo $isi['id_penyakit']; ?>" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content text-left">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color:var(--danger);"><span class="glyphicon glyphicon-warning-sign"></span> Konfirmasi Hapus</h4>
                  </div>
                  <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data penyakit <strong><?php echo htmlspecialchars($isi['nm_penyakit']); ?></strong> (<?php echo $isi['id_penyakit']; ?>)?</p>
                  </div>
                  <div class="modal-footer">
                    <a href="hapus.php?id_penyakit=<?php echo urlencode($isi['id_penyakit']); ?>" class="btn btn-danger">Ya, Hapus</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  </div>
                </div>
              </div>
            </div>
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
