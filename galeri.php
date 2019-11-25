<?php
session_start();
require_once "koneksi.php";
include "library.php";
head('Konsultasi',1);
style(1); ?>
<style type="text/css">
<!--
.style1 {font-family: Georgia, "Times New Roman", Times, serif}
-->
</style>
<body>
<?php
menu();
include "template/kiri.php";
?>
<h1 class="style1">Galeri</h1>
<img src="gambar/mata6.jpg" class="img img-thumbnai1 img-responsive" />
<img src="gambar/mata3.jpg" class="img img-thumbnail img-responsive" />
<img src="gambar/mata4.png" class="img img-thumbnail img-responsive" />

<?
include "template/kanan.php";
include "template/footer.php";
?>
