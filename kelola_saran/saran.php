<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();
head('Kelola Saran & Masukan Pasien', 2);
style(2);
?>
<body>
<?php
menu();
include "../template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-comment" style="color:var(--primary);"></span> Kelola Kritik &amp; Saran</h3>
    <div class="page-subtitle">Daftar pesan, masukan, dan saran yang dikirimkan oleh pasien dan pengunjung</div>
  </div>
</div>

<?php
$kueri = mysqli_query($koneksi, "SELECT * FROM tbsaran ORDER BY id_saran DESC;");
$no = 1;
?>

<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead>
      <tr class="info">
        <th width="5%" class="text-center">No</th>
        <th width="22%">Nama Pengirim</th>
        <th>Isi Saran / Kritik</th>
        <th width="15%">Waktu Pengiriman</th>
        <th width="10%" class="text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(mysqli_num_rows($kueri) < 1) {
        echo "<tr><td class='text-center' colspan='5' style='padding:20px;'><strong>Belum ada kritik dan saran yang masuk...</strong></td></tr>";
      } else {
        while ($isi = mysqli_fetch_array($kueri, MYSQLI_BOTH)){
          $tglStr = !empty($isi['tgl_kirim']) ? date('d-m-Y H:i', strtotime($isi['tgl_kirim'])) : '-';
      ?>
        <tr>
          <td class="text-center"><?php echo $no; ?></td>
          <td><strong><?php echo htmlspecialchars($isi['nama']); ?></strong></td>
          <td style="line-height:1.6; color:var(--slate-700);"><?php echo nl2br(htmlspecialchars($isi['saran'])); ?></td>
          <td style="font-size:12px; color:var(--slate-600);"><?php echo $tglStr; ?></td>
          <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#konfirmasi<?php echo $isi['id_saran']; ?>">
              <span class="glyphicon glyphicon-trash"></span> Hapus
            </button>

            <!-- Delete Modal -->
            <div id="konfirmasi<?php echo $isi['id_saran']; ?>" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content text-left">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color:var(--danger);"><span class="glyphicon glyphicon-warning-sign"></span> Konfirmasi Hapus</h4>
                  </div>
                  <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pesan saran dari <strong><?php echo htmlspecialchars($isi['nama']); ?></strong>?</p>
                  </div>
                  <div class="modal-footer">
                    <a href="hapus.php?id_saran=<?php echo urlencode($isi['id_saran']); ?>" class="btn btn-danger">Ya, Hapus</a>
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
