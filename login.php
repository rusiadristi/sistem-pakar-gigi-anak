<?php
session_start();
require_once "koneksi.php";
if(isset($_SESSION['username'])) header('Location:index.php');
include "library.php";

$pesan = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = mysqli_real_escape_string($koneksi, trim($_POST['Tusername']));
	$password = mysqli_real_escape_string($koneksi, trim($_POST['Tpassword']));
	$level = intval($_POST['level']);

	if($level == 1){
		$kueri = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password';");
	} else {
		$kueri = mysqli_query($koneksi, "SELECT * FROM tbuser WHERE username='$username' AND password='$password';");
	}

	if($kueri && mysqli_num_rows($kueri) > 0) {
		$isi = mysqli_fetch_array($kueri, MYSQLI_BOTH);
		$_SESSION['username'] = $isi['username'];
		if($level == 1){
			$_SESSION['id_tipe'] = 1;
			$_SESSION['id_user'] = 'ADM';
		} else {
			$_SESSION['id_tipe'] = 3;
			$_SESSION['id_user'] = $isi['id_user'];
		}
		header('Location:index.php');
		exit();
	} else {
		$pesan = pesan('danger', "Username, Password, atau Level yang dipilih tidak cocok. Silakan coba lagi.", 0);
	}
}

head('Masuk / Login', 1);
style(1);
?>
<body>
<?php
menu();
include "template/kiri.php";
?>

<div class="row" style="margin-top:10px;">
  <!-- Left Column: Clinic Welcome & Information (Full-Width Split) -->
  <div class="col-md-6 col-sm-12" style="margin-bottom:20px;">
    <div style="background: linear-gradient(135deg, #f0fdfa, #e0f2fe); border:1px solid #bae6fd; border-radius:12px; padding:32px 28px; height:100%; display:flex; flex-direction:column; justify-content:center;">
      <span class="hero-badge" style="align-self:flex-start; margin-bottom:12px;">
        <span class="glyphicon glyphicon-heart"></span> Portal Pasien &amp; Admin
      </span>
      <h2 style="font-size:24px; font-weight:800; color:var(--slate-900); margin-bottom:10px;">
        Selamat Datang di Sistem Pakar Gigi Anak
      </h2>
      <p style="font-size:13.5px; color:var(--slate-600); line-height:1.6; margin-bottom:20px;">
        Layanan konsultasi mandiri berbasis komputer untuk membantu mendeteksi kondisi karies dan pulpitis pada gigi buah hati Anda dengan data rujukan klinis terpercaya.
      </p>
      
      <div style="background:#ffffff; border-radius:10px; padding:16px; border:1px solid #bae6fd; box-shadow:var(--shadow-sm);">
        <div style="font-weight:700; color:var(--primary); margin-bottom:8px; font-size:13px;">
          <span class="glyphicon glyphicon-certificate"></span> Rujukan Medis:
        </div>
        <div style="font-size:12.5px; color:var(--slate-700); line-height:1.5;">
          <strong>Praktek Mandiri Drg. Rusi Adristi</strong><br>
          Padang, Sumatera Barat, Indonesia &bull; Dokter Spesialis Gigi Anak
        </div>
      </div>
    </div>
  </div>

  <!-- Right Column: Login Form -->
  <div class="col-md-6 col-sm-12" style="margin-bottom:20px;">
    <div class="article-card" style="padding:28px 30px; margin-bottom:0;">
      <div style="display:flex; align-items:center; gap:12px; margin-bottom:20px;">
        <div style="width:42px; height:42px; border-radius:10px; background:var(--primary-light); color:var(--primary); display:flex; align-items:center; justify-content:center; font-size:20px;">
          <span class="glyphicon glyphicon-lock"></span>
        </div>
        <div>
          <h3 style="margin:0; font-size:18px; font-weight:800; color:var(--slate-900);">Masuk ke Akun Anda</h3>
          <div style="font-size:12px; color:var(--slate-600);">Pilih level pengguna dan masukkan kredensial Anda</div>
        </div>
      </div>

      <?php if(!empty($pesan)) echo $pesan; ?>

      <form method="POST">
        <div class="form-group">
          <label for="level"><strong>Tipe Pengguna (Level) :</strong></label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
            <select name="level" id="level" class="form-control" required>
              <option value="3" selected>Pasien / Member Terdaftar</option>
              <option value="1">Administrator Sistem</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="Tusername"><strong>Username :</strong></label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="Tusername" class="form-control" type="text" name="Tusername" maxlength="20" minlength="3" required placeholder="Masukkan username Anda" autocomplete="username" />
          </div>
        </div>

        <div class="form-group">
          <label for="Tpassword"><strong>Password :</strong></label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
            <input id="Tpassword" class="form-control" type="password" name="Tpassword" maxlength="30" required placeholder="Masukkan kata sandi Anda" autocomplete="current-password" />
          </div>
        </div>

        <div style="margin-top:22px;">
          <button type="submit" name="Bsimpan" class="btn btn-primary btn-block" style="padding:10px 0; font-size:14px;">
            <span class="glyphicon glyphicon-log-in"></span> Masuk Sekarang
          </button>
        </div>
      </form>

      <hr style="margin:18px 0; border-color:var(--slate-200);">

      <div style="text-align:center; font-size:12.5px; color:var(--slate-600);">
        Belum memiliki akun pasien? <a href="registrasi.php" style="font-weight:700; color:var(--primary);">Daftar Akun Baru Disini</a>
      </div>
    </div>
  </div>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>
