<?php
$prefix = file_exists('library.php') ? './' : '../';
?>
<!-- Responsive & Modern Layout Helper Styles -->
<link rel="stylesheet" href="<?php echo $prefix; ?>bootstrap/css/style.css">
<style>
/* Clean layout overrides */
.navbar {
  margin-bottom: 0;
  border-radius: 0;
}
.row.content {
  height: auto !important;
  min-height: 550px;
}
.sidenav, .sidenava {
  height: auto !important;
  background-color: transparent !important;
  padding: 0 !important;
}
</style>
