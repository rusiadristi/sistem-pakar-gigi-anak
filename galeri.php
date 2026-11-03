<?php
session_start();
require_once "koneksi.php";
include "library.php";
head('Galeri Edukasi', 1);
style(1);
?>
<body>
<?php
menu();
include "template/kiri.php";
?>

<div class="page-header-custom">
  <div>
    <h3 class="page-title"><span class="glyphicon glyphicon-picture" style="color:var(--primary);"></span> Galeri &amp; Edukasi Visual</h3>
    <div class="page-subtitle">Dokumentasi klinis, kesehatan gigi anak, dan prosedur perawatan gigi</div>
  </div>
</div>

<!-- 4 Columns Horizontal Gallery Grid -->
<div class="gallery-grid">
  <!-- Card 1 -->
  <div class="gallery-card">
    <div class="gallery-img-wrap">
      <img src="gambar/gigii.jpg" alt="Pemeriksaan Gigi Rutin" />
    </div>
    <div class="gallery-caption">
      <h5>Pemeriksaan Gigi Anak</h5>
      <p>Pemeriksaan rutin memantau tumbuh kembang gigi anak.</p>
    </div>
  </div>

  <!-- Card 2 -->
  <div class="gallery-card">
    <div class="gallery-img-wrap">
      <img src="gambar/gigi33.jpg" alt="Karies & Gigi Berlubang" />
    </div>
    <div class="gallery-caption">
      <h5>Kondisi Karies &amp; Lubang</h5>
      <p>Deteksi dini lubang mencegah kerusakan menjalar ke pulpa.</p>
    </div>
  </div>

  <!-- Card 3 -->
  <div class="gallery-card">
    <div class="gallery-img-wrap">
      <img src="gambar/bersihh.jpg" alt="Perawatan Gigi Bersih" />
    </div>
    <div class="gallery-caption">
      <h5>Pembersihan &amp; Rawat Pulpa</h5>
      <p>Perawatan medis membuat gigi anak kembali sehat dan nyaman.</p>
    </div>
  </div>

  <!-- Card 4 -->
  <div class="gallery-card">
    <div class="gallery-img-wrap">
      <img src="gambar/gigi4.jpg" alt="Edukasi Sikat Gigi" />
    </div>
    <div class="gallery-caption">
      <h5>Edukasi Menyikat Gigi</h5>
      <p>Mengajarkan teknik sikat gigi lembut minimal 2 menit.</p>
    </div>
  </div>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>
