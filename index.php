<?php
session_start();
require_once "koneksi.php";
include "library.php";
head('Beranda', 1);
style(1);
?>
<body>
<?php
menu();
include "template/kiri.php";
?>

<!-- 1. Hero Section: Split Horizontal (Text on Left, Cartoon Tooth Image on Right) -->
<div class="hero-split-box">
  <div class="hero-split-row">
    <div class="hero-split-content">
      <span class="hero-badge"><span class="glyphicon glyphicon-star"></span> Sistem Pakar Gigi Anak</span>
      <h2 class="hero-title">Jaga Senyum Sehat Buah Hati Sejak Dini</h2>
      <p class="hero-desc">
        Bantu orang tua mengenali dan mendeteksi gejala awal masalah gigi dan mulut pada anak secara mandiri, cepat, dan akurat berdasarkan data pengetahuan klinis dari dokter spesialis gigi.
      </p>
      <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <?php if(isset($_SESSION['id_tipe']) && $_SESSION['id_tipe'] == 3): ?>
          <a href="konsultasi.php?hal=1" class="btn btn-primary btn-lg">
            <span class="glyphicon glyphicon-stethoscope"></span> Mulai Konsultasi
          </a>
          <a href="laporan/diagnosa.php" class="btn btn-default btn-lg">
            <span class="glyphicon glyphicon-time"></span> Riwayat Diagnosa
          </a>
        <?php elseif(!isset($_SESSION['id_tipe'])): ?>
          <a href="login.php" class="btn btn-primary btn-lg">
            <span class="glyphicon glyphicon-log-in"></span> Masuk untuk Konsultasi
          </a>
          <a href="registrasi.php" class="btn btn-success btn-lg">
            <span class="glyphicon glyphicon-user"></span> Daftar Akun Baru
          </a>
          <a href="informasi_penyakit.php" class="btn btn-default btn-lg">
            <span class="glyphicon glyphicon-info-sign"></span> Informasi Penyakit
          </a>
        <?php else: ?>
          <a href="kelola_penyakit/penyakit.php" class="btn btn-primary btn-lg">
            <span class="glyphicon glyphicon-dashboard"></span> Dashboard Admin
          </a>
        <?php endif; ?>
      </div>
    </div>
    <div class="hero-split-media">
      <img src="gambar/gigi-sakit_169.jpeg" alt="Ilustrasi Kesehatan Gigi Anak" />
    </div>
  </div>
</div>

<!-- 2. Quick Features Row (4 Columns Side-by-Side) -->
<div class="row" style="margin-bottom:20px;">
  <div class="col-md-3 col-sm-6" style="margin-bottom:12px;">
    <div class="feature-box">
      <div class="feature-box-icon">
        <span class="glyphicon glyphicon-list-alt"></span>
      </div>
      <div class="feature-box-title">Alur Konsultasi</div>
      <p class="feature-box-desc">Daftar akun &rarr; Login &rarr; Jawab gejala klinis &rarr; Dapatkan hasil &amp; solusi diagnosa.</p>
    </div>
  </div>

  <div class="col-md-3 col-sm-6" style="margin-bottom:12px;">
    <div class="feature-box">
      <div class="feature-box-icon" style="background:#dcfce7; color:#15803d;">
        <span class="glyphicon glyphicon-apple"></span>
      </div>
      <div class="feature-box-title">Pola Makan Sehat</div>
      <p class="feature-box-desc">Batasi camilan manis, cokelat, dan susu botol menjelang tidur untuk mencegah karies.</p>
    </div>
  </div>

  <div class="col-md-3 col-sm-6" style="margin-bottom:12px;">
    <div class="feature-box">
      <div class="feature-box-icon" style="background:#e0f2fe; color:#0369a1;">
        <span class="glyphicon glyphicon-ok-sign"></span>
      </div>
      <div class="feature-box-title">Sikat Gigi Rutin</div>
      <p class="feature-box-desc">Sikat gigi teratur setelah sarapan dan sebelum tidur menggunakan bulu sikat yang lembut.</p>
    </div>
  </div>

  <div class="col-md-3 col-sm-6" style="margin-bottom:12px;">
    <div class="feature-box">
      <div class="feature-box-icon" style="background:#fef3c7; color:#b45309;">
        <span class="glyphicon glyphicon-calendar"></span>
      </div>
      <div class="feature-box-title">Periksa Tiap 6 Bulan</div>
      <p class="feature-box-desc">Kunjungan berkala ke dokter gigi untuk memantau tumbuh kembang rahang dan gigi anak.</p>
    </div>
  </div>
</div>

<!-- 3. Two Side-by-Side Article Columns (Horizontal Balance) -->
<div class="row" style="margin-bottom:15px;">
  <!-- Left Column -->
  <div class="col-md-6 col-sm-12" style="margin-bottom:14px;">
    <div class="article-card" style="height:100%;">
      <h4 class="article-card-title">
        <span class="glyphicon glyphicon-question-sign"></span> Seberapa Umum Gigi Berlubang Terjadi?
      </h4>
      <p style="color:var(--slate-600); line-height:1.6; margin-bottom:8px;">
        Kondisi karies dan radang pulpa (pulpitis) adalah masalah paling umum pada anak. Penumpukan sisa makanan yang terfermentasi bakteri menghasilkan asam yang mengikis lapisan email gigi.
      </p>
      <p style="color:var(--slate-600); line-height:1.6; margin-bottom:0;">
        Jika tidak ditangani sejak dini, radang dapat menembus rongga pulpa dan menimbulkan rasa nyeri hebat, mengganggu pola tidur anak, hingga menyebabkan komplikasi infeksi lebih lanjut.
      </p>
    </div>
  </div>

  <!-- Right Column -->
  <div class="col-md-6 col-sm-12" style="margin-bottom:14px;">
    <div class="article-card" style="height:100%;">
      <h4 class="article-card-title">
        <span class="glyphicon glyphicon-warning-sign"></span> Faktor Penyebab Gigi Berlubang &amp; Pulpitis
      </h4>
      <ul style="color:var(--slate-600); line-height:1.65; padding-left:18px; margin-bottom:0;">
        <li><strong>Infeksi Bakteri:</strong> Penumpukan plak akibat kurang rutin menggosok gigi secara menyeluruh.</li>
        <li><strong>Konsumsi Makanan Manis:</strong> Gula berlebih yang menempel lama pada permukaan gigi.</li>
        <li><strong>Trauma / Cedera Gigi:</strong> Keretakan atau benturan fisik yang membuka celah ke jaringan pulpa.</li>
        <li><strong>Kebiasaan Bruxism:</strong> Kebiasaan menggesekkan atau menggemeretakkan gigi saat tidur.</li>
      </ul>
    </div>
  </div>
</div>

<!-- 4. Horizontal Doctor Clinical Reference Bar -->
<div style="background: linear-gradient(135deg, #f0fdfa, #f8fafc); border:1px solid #ccfbf1; border-radius:12px; padding:16px 20px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:14px;">
  <div style="display:flex; align-items:center; gap:14px;">
    <div style="width:44px; height:44px; border-radius:50%; background:var(--teal); color:#fff; display:flex; align-items:center; justify-content:center; font-size:20px; flex-shrink:0;">
      <span class="glyphicon glyphicon-certificate"></span>
    </div>
    <div>
      <div style="font-weight:700; color:var(--slate-900); font-size:13.5px;">Basis Data Klinis Terpercaya</div>
      <div style="font-size:12px; color:var(--slate-600); line-height:1.4;">
        Rujukan pengetahuan medis disupervisi langsung oleh <strong>Drg. Rusi Adristi</strong> (Praktek Dokter Gigi, Padang, Sumatera Barat).
      </div>
    </div>
  </div>
  <div>
    <a href="informasi_penyakit.php" class="btn btn-info btn-sm">
      <span class="glyphicon glyphicon-book"></span> Lihat Jenis Penyakit
    </a>
  </div>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>
