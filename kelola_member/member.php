<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();
head('Kelola Data Pasien & Member', 2);
style(2);
?>
<body>
<?php
menu();
include "../template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-user" style="color:var(--primary);"></span> Kelola Data Member / Pasien</h3>
    <div class="page-subtitle">Daftar seluruh pasien terdaftar yang dapat melakukan konsultasi</div>
  </div>
  <div>
    <a href="tambah.php" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span> Tambah Pasien Baru
    </a>
  </div>
</div>

<!-- Search Input -->
<div class="article-card" style="margin-bottom:20px; padding:15px 20px;">
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
    <input type="text" id="search" class="form-control" placeholder="Cari berdasarkan nama pasien, ID user, atau username...">
  </div>
</div>

<?php
$kueri = mysqli_query($koneksi, "SELECT * FROM tbuser ORDER BY id_user ASC;");
?>

<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead>
      <tr class="info">
        <th width="5%" class="text-center">No</th>
        <th>ID Pasien</th>
        <th>Nama Lengkap</th>
        <th>Username</th>
        <th>Email</th>
        <th>No. HP</th>
        <th width="18%" class="text-center">Aksi</th>
      </tr>
    </thead>
    <tbody id="show">
      <?php
      if(mysqli_num_rows($kueri) < 1) {
        echo "<tr><td class='text-center' colspan='7' style='padding:20px;'><strong>Data member kosong...</strong></td></tr>";
      } else {
        $no = 1;
        while ($isi = mysqli_fetch_array($kueri, MYSQLI_BOTH)){
      ?>
        <tr>
          <td class="text-center"><?php echo $no; ?></td>
          <td><span class="badge" style="background:var(--primary);"><?php echo htmlspecialchars($isi['id_user']); ?></span></td>
          <td><strong><?php echo htmlspecialchars($isi['nm_pengguna']); ?></strong></td>
          <td><?php echo htmlspecialchars($isi['username']); ?></td>
          <td><?php echo htmlspecialchars($isi['email']); ?></td>
          <td><?php echo htmlspecialchars($isi['nohp']); ?></td>
          <td class="text-center">
            <a href="edit.php?id_user=<?php echo urlencode($isi['id_user']); ?>" class="btn btn-primary btn-sm">
              <span class="glyphicon glyphicon-edit"></span> Edit
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#konfirmasi<?php echo $isi['id_user']; ?>">
              <span class="glyphicon glyphicon-trash"></span> Hapus
            </button>

            <!-- Delete Modal -->
            <div id="konfirmasi<?php echo $isi['id_user']; ?>" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content text-left">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color:var(--danger);"><span class="glyphicon glyphicon-warning-sign"></span> Konfirmasi Hapus</h4>
                  </div>
                  <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pasien <strong><?php echo htmlspecialchars($isi['nm_pengguna']); ?></strong> (<?php echo $isi['id_user']; ?>)?</p>
                  </div>
                  <div class="modal-footer">
                    <a href="hapus.php?id_user=<?php echo urlencode($isi['id_user']); ?>" class="btn btn-danger">Ya, Hapus</a>
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

<script type="text/javascript">
$(document).ready(function() {
  $('#search').on('keyup', function() {
    $.ajax({
      type: 'POST',
      url: 'search.php',
      data: { search: $(this).val() },
      cache: false,
      success: function(data) {
        $('#show').html(data);
      }
    });
  });
});
</script>

<?php
include "../template/kanan.php";
include "../template/footer.php";
?>
