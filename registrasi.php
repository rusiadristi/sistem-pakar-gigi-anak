<?php
session_start();
require_once "koneksi.php";
include "library.php";

// Auto User ID Generator
$getId = mysqli_query($koneksi, "SELECT MAX(id_user) AS code FROM tbuser");
$state = mysqli_fetch_array($getId);
$code = $state['code'];
$number = (int) substr($code, 3, 3);
$number++;
$char = "PSN";
$code = $char . sprintf("%03s", $number);

$pesan = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = mysqli_real_escape_string($koneksi, trim($_POST['Tusername']));
	$password = mysqli_real_escape_string($koneksi, trim($_POST['Tpassword']));
	$email = mysqli_real_escape_string($koneksi, trim($_POST['Temail']));
	$nohp = mysqli_real_escape_string($koneksi, trim($_POST['Tnohp']));
	$nm_pengguna = mysqli_real_escape_string($koneksi, trim($_POST['Tnm_pengguna']));
	
	$check = mysqli_query($koneksi, "SELECT * FROM tbuser WHERE username='$username'");
	if(mysqli_num_rows($check) > 0){
		$pesan = pesan('danger', "Username sudah digunakan. Silakan gunakan username lain.", 0);
	} else {
		$kueri = mysqli_query($koneksi, "INSERT INTO tbuser (id_user, username, password, email, nohp, nm_pengguna) VALUES ('$code', '$username', '$password', '$email', '$nohp', '$nm_pengguna');");
		if($kueri) {
			header('Location: login.php');
			exit();
		} else {
			$pesan = pesan('danger', "Registrasi gagal disimpan ke sistem. Silakan ulangi.", 0);
		}
	}
}

head('Registrasi Pasien', 1);
style(1);
?>
<body>
<?php
menu();
include "template/kiri.php";
?>

<div class="row" style="margin-top:10px;">
  <!-- Left Column: Patient Benefits & Instructions (Full-Width Split) -->
  <div class="col-md-5 col-sm-12" style="margin-bottom:20px;">
    <div style="background: linear-gradient(135deg, #f0fdfa, #e0f2fe); border:1px solid #bae6fd; border-radius:12px; padding:32px 28px; height:100%; display:flex; flex-direction:column; justify-content:center;">
      <span class="hero-badge" style="align-self:flex-start; margin-bottom:12px;">
        <span class="glyphicon glyphicon-user"></span> Pendaftaran Pasien
      </span>
      <h2 style="font-size:22px; font-weight:800; color:var(--slate-900); margin-bottom:12px;">
        Buat Akun Pasien Anda
      </h2>
      <p style="font-size:13px; color:var(--slate-600); line-height:1.6; margin-bottom:20px;">
        Daftarkan akun untuk mulai melakukan konsultasi dan pemantauan kesehatan gigi buah hati Anda dengan metode sistem pakar.
      </p>

      <div style="background:#ffffff; border-radius:10px; padding:16px; border:1px solid #bae6fd; box-shadow:var(--shadow-sm); margin-bottom:14px;">
        <div style="font-weight:700; color:var(--primary); margin-bottom:8px; font-size:13px;">
          <span class="glyphicon glyphicon-ok-sign"></span> Manfaat Akun Pasien:
        </div>
        <ul style="padding-left:18px; margin:0; font-size:12.5px; color:var(--slate-600); line-height:1.6;">
          <li>Melakukan diagnosa mandiri kapan saja</li>
          <li>Mendapatkan saran klinis dokter spesialis gigi</li>
          <li>Menyimpan dan mencetak riwayat konsultasi</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Right Column: Registration Form -->
  <div class="col-md-7 col-sm-12" style="margin-bottom:20px;">
    <div class="article-card" style="padding:28px 30px; margin-bottom:0;">
      <div style="display:flex; align-items:center; gap:12px; margin-bottom:18px;">
        <div style="width:42px; height:42px; border-radius:10px; background:var(--teal-light); color:var(--teal); display:flex; align-items:center; justify-content:center; font-size:20px;">
          <span class="glyphicon glyphicon-pencil"></span>
        </div>
        <div>
          <h3 style="margin:0; font-size:18px; font-weight:800; color:var(--slate-900);">Formulir Pendaftaran</h3>
          <div style="font-size:12px; color:var(--slate-600);">Lengkapi data diri Anda di bawah ini</div>
        </div>
      </div>

      <?php if(!empty($pesan)) echo $pesan; ?>

      <form method="POST">
        <div class="form-group">
          <label for="id_user"><strong>ID Pasien (Otomatis) :</strong></label>
          <input id="id_user" class="form-control" type="text" name="id_user" value="<?php echo $code; ?>" readonly style="background-color:var(--slate-100); font-weight:700; color:var(--primary);" />
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="Tusername"><strong>Username :</strong></label>
              <input id="Tusername" class="form-control" type="text" name="Tusername" maxlength="20" minlength="3" required placeholder="Username Anda" />
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="Tpassword"><strong>Password :</strong></label>
              <input id="Tpassword" class="form-control" type="password" name="Tpassword" maxlength="30" required placeholder="Kata sandi akun" />
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="Tnm_pengguna"><strong>Nama Lengkap Pasien / Orang Tua :</strong></label>
          <input id="Tnm_pengguna" class="form-control" type="text" name="Tnm_pengguna" maxlength="100" required placeholder="Contoh: Bunda Siti Aminah" />
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
              <label for="Tnohp"><strong>No. Handphone / WhatsApp :</strong></label>
              <input id="Tnohp" class="form-control" type="tel" name="Tnohp" maxlength="15" placeholder="08xxxxxxxxxx" />
            </div>
          </div>
        </div>

        <div style="margin-top:18px;">
          <button type="submit" name="Bsimpan" class="btn btn-success btn-block" style="padding:10px 0; font-size:14px;">
            <span class="glyphicon glyphicon-check"></span> Selesaikan Pendaftaran Pasien
          </button>
        </div>
      </form>

      <hr style="margin:16px 0; border-color:var(--slate-200);">

      <div style="text-align:center; font-size:12.5px; color:var(--slate-600);">
        Sudah memiliki akun? <a href="login.php" style="font-weight:700; color:var(--primary);">Masuk ke Akun Anda</a>
      </div>
    </div>
  </div>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>
