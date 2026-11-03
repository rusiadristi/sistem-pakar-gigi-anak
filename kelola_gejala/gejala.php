<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();
head('Kelola Gejala Penyakit Gigi', 2);
style(2);
?>
<body>
<?php
menu();
include "../template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-check" style="color:var(--primary);"></span> Kelola Gejala Klinis</h3>
    <div class="page-subtitle">Manajemen daftar gejala klinis untuk kuesioner diagnosa anak</div>
  </div>
  <div>
    <a href="tambah.php" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span> Tambah Gejala Baru
    </a>
  </div>
</div>

<?php
$kueri = mysqli_query($koneksi, "SELECT * FROM tbgejala ORDER BY id_gejala ASC;");
$no = 1;
?>

<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead>
      <tr class="info">
        <th width="5%" class="text-center">No</th>
        <th width="15%">ID Gejala</th>
        <th>Deskripsi Gejala Klinis</th>
        <th width="20%" class="text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(mysqli_num_rows($kueri) < 1) {
        echo "<tr><td class='text-center' colspan='4' style='padding:20px;'><strong>Data gejala kosong...</strong></td></tr>";
      } else {
        while ($isi = mysqli_fetch_array($kueri, MYSQLI_BOTH)){
      ?>
        <tr>
          <td class="text-center"><?php echo $no; ?></td>
          <td><span class="badge" style="background:var(--teal);"><?php echo htmlspecialchars($isi['id_gejala']); ?></span></td>
          <td><strong><?php echo htmlspecialchars($isi['nm_gejala']); ?></strong></td>
          <td class="text-center">
            <a href="edit.php?id_gejala=<?php echo urlencode($isi['id_gejala']); ?>" class="btn btn-primary btn-sm">
              <span class="glyphicon glyphicon-edit"></span> Edit
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#konfirmasi<?php echo $isi['id_gejala']; ?>">
              <span class="glyphicon glyphicon-trash"></span> Hapus
            </button>

            <!-- Modal Delete -->
            <div id="konfirmasi<?php echo $isi['id_gejala']; ?>" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content text-left">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color:var(--danger);"><span class="glyphicon glyphicon-warning-sign"></span> Konfirmasi Hapus</h4>
                  </div>
                  <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus gejala <strong><?php echo htmlspecialchars($isi['nm_gejala']); ?></strong> (<?php echo $isi['id_gejala']; ?>)?</p>
                  </div>
                  <div class="modal-footer">
                    <a href="hapus.php?id_gejala=<?php echo urlencode($isi['id_gejala']); ?>" class="btn btn-danger">Ya, Hapus</a>
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
