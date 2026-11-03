<?php
session_start();
require_once "../koneksi.php";
include "../library.php";
cek_akses();

// Auto User ID Generator
$getId = mysqli_query($koneksi, "SELECT MAX(id_user) AS code FROM tbuser");
$state = mysqli_fetch_array($getId);
$code = $state['code'];
$number = (int) substr($code, 3, 3);
$number++;
$char = "PSN";
$newCode = $char . sprintf("%03s", $number);

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = mysqli_real_escape_string($koneksi, trim($_POST['Tusername']));
	$password = mysqli_real_escape_string($koneksi, trim($_POST['Tpassword']));
	$email = mysqli_real_escape_string($koneksi, trim($_POST['Temail']));
	$nohp = mysqli_real_escape_string($koneksi, trim($_POST['Tnohp']));
	$nm_pengguna = mysqli_real_escape_string($koneksi, trim($_POST['Tnm_pengguna']));
	
	$kueri = mysqli_query($koneksi, "INSERT INTO tbuser (id_user, username, password, email, nohp, nm_pengguna) VALUES ('$newCode', '$username', '$password', '$email', '$nohp', '$nm_pengguna');");
	if($kueri) {
		header('Location: member.php');
		exit();
	}
}

head('Tambah Member Baru', 2);
style(2);
?>
<body>
<?php
menu();
include "../template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-plus" style="color:var(--primary);"></span> Tambah Member Baru</h3>
    <div class="page-subtitle">Form registrasi data akun member / pasien secara manual oleh admin</div>
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
      <label><strong>ID Pasien (Otomatis) :</strong></label>
      <input class="form-control" type="text" value="<?php echo $newCode; ?>" disabled style="max-width:200px; background-color:var(--slate-100); font-weight:bold; color:var(--primary);" />
    </div>

    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label for="Tusername"><strong>Username :</strong></label>
          <input id="Tusername" class="form-control" type="text" name="Tusername" maxlength="20" required placeholder="Username" />
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="Tpassword"><strong>Password :</strong></label>
          <input id="Tpassword" class="form-control" type="password" name="Tpassword" maxlength="30" required placeholder="Password" />
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="Tnm_pengguna"><strong>Nama Lengkap Pasien / Wali :</strong></label>
      <input id="Tnm_pengguna" class="form-control" type="text" name="Tnm_pengguna" maxlength="100" required placeholder="Nama lengkap" />
    </div>

    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label for="Temail"><strong>Email :</strong></label>
          <input id="Temail" class="form-control" type="email" name="Temail" maxlength="50" placeholder="nama@email.com" />
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="Tnohp"><strong>No. Handphone :</strong></label>
          <input id="Tnohp" class="form-control" type="text" name="Tnohp" maxlength="15" placeholder="08xxxxxxxxxx" />
        </div>
      </div>
    </div>

    <div style="display:flex; gap:10px; margin-top:20px;">
      <button type="submit" name="Bsimpan" class="btn btn-success">
        <span class="glyphicon glyphicon-ok"></span> Simpan Member
      </button>
      <a href="member.php" class="btn btn-default">Batal</a>
    </div>
  </form>
</div>

<?php
include "../template/kanan.php";
include "../template/footer.php";
?>
