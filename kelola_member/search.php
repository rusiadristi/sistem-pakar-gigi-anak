<?php
if (isset($_POST['search'])) {
  require_once "../koneksi.php";
  $no = 1;
  $search = mysqli_real_escape_string($koneksi, trim($_POST['search']));
  $query = mysqli_query($koneksi, "SELECT * FROM tbuser WHERE nm_pengguna LIKE '%".$search."%' OR id_user LIKE '%".$search."%' OR username LIKE '%".$search."%' ORDER BY id_user ASC");
  if(mysqli_num_rows($query) < 1){
    echo "<tr><td colspan='7' class='text-center' style='padding:15px; color:var(--slate-600);'>Tidak ada data member yang cocok dengan pencarian.</td></tr>";
  } else {
    while ($row = mysqli_fetch_object($query)) {
?>
<tr>
  <td class="text-center"><?= $no++; ?></td>
  <td><span class="badge" style="background:var(--primary);"><?= htmlspecialchars($row->id_user); ?></span></td>
  <td><strong><?= htmlspecialchars($row->nm_pengguna); ?></strong></td>
  <td><?= htmlspecialchars($row->username); ?></td>
  <td><?= htmlspecialchars($row->email); ?></td>
  <td><?= htmlspecialchars($row->nohp); ?></td>
  <td class="text-center">
    <a href="edit.php?id_user=<?= urlencode($row->id_user); ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a>
    <a href="hapus.php?id_user=<?= urlencode($row->id_user); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
  </td>
</tr>
<?php
    }
  }
}
?>
