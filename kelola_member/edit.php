<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();

$id = isset($_GET['id_user']) ? mysqli_real_escape_string($koneksi, $_GET['id_user']) : '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$email = mysqli_real_escape_string($koneksi, trim($_POST['Temail']));
	$nohp = mysqli_real_escape_string($koneksi, trim($_POST['Tnohp']));
	$nm_pengguna = mysqli_real_escape_string($koneksi, trim($_POST['Tnm_pengguna']));
	$password_sql = "";
	if(!empty($_POST['Tpassword'])){
		$password = mysqli_real_escape_string($koneksi, trim($_POST['Tpassword']));
		$password_sql = ", password='$password'";
	}
	$kueri = mysqli_query($koneksi, "UPDATE tbuser SET email='$email', nohp='$nohp', nm_pengguna='$nm_pengguna' $password_sql WHERE id_user='$id';");
	if($kueri) {
		header('Location: member.php');
		exit();
	}
}

$kueri = mysqli_query($koneksi, "SELECT * FROM tbuser WHERE id_user='$id' LIMIT 1;");
if(mysqli_num_rows($kueri) < 1) {
	header('Location: member.php');
	exit();
}
$isi = mysqli_fetch_array($kueri, MYSQLI_BOTH);

head('Edit Informasi Member', 2);
style(2);
?>
<body>
<?php
menu();
include "../template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-edit" style="color:var(--primary);"></span> Edit Informasi Member</h3>
    <div class="page-subtitle">Perbarui profil data pasien atau perbarui kata sandi</div>
  </div>
  <div>
    <a href="member.php" class="btn btn-default btn-sm">
      <span class="glyphicon glyphicon-arrow-left"></span> Kembali
    </a>
  </div>
</div>

<div class="article-card" style="padding: 24px;">
  <form method="POST">
    <div class="form-group">
      <label><strong>ID Pasien :</strong></label>
      <input class="form-control" type="text" value="<?php echo htmlspecialchars($isi['id_user']); ?>" disabled style="max-width:200px; background-color:var(--slate-100); font-weight:bold;" />
    </div>

    <div class="form-group">
      <label for="Tusername"><strong>Username :</strong></label>
      <input id="Tusername" class="form-control" type="text" value="<?php echo htmlspecialchars($isi['username']); ?>" disabled style="background-color:var(--slate-100);" />
    </div>

    <div class="form-group">
      <label for="Tpassword"><strong>Ganti Password (Kosongkan jika tidak diubah) :</strong></label>
      <input id="Tpassword" class="form-control" type="password" name="Tpassword" maxlength="30" placeholder="Masukkan password baru jika ingin mengganti" />
    </div>

    <div class="form-group">
      <label for="Tnm_pengguna"><strong>Nama Lengkap Pasien :</strong></label>
      <input id="Tnm_pengguna" class="form-control" type="text" value="<?php echo htmlspecialchars($isi['nm_pengguna']); ?>" name="Tnm_pengguna" maxlength="100" required />
    </div>

    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label for="Temail"><strong>Email :</strong></label>
          <input id="Temail" class="form-control" type="email" value="<?php echo htmlspecialchars($isi['email']); ?>" name="Temail" maxlength="50" />
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="Tnohp"><strong>Nomor Handphone :</strong></label>
          <input id="Tnohp" class="form-control" type="text" value="<?php echo htmlspecialchars($isi['nohp']); ?>" name="Tnohp" maxlength="15" />
        </div>
      </div>
    </div>

    <div style="display:flex; gap:10px; margin-top:20px;">
      <button type="submit" name="Bsimpan" class="btn btn-success">
        <span class="glyphicon glyphicon-ok"></span> Simpan Perubahan
      </button>
      <a href="member.php" class="btn btn-default">Batal</a>
    </div>
  </form>
</div>

<?php
include "../template/kanan.php";
include "../template/footer.php";
?>
