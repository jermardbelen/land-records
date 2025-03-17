<?php require_once('../Connections/connection.php'); ?>
<?php require_once('access_global.php'); ?>
<?php require_once('config.php'); ?>
<?php date_default_timezone_set('Asia/Manila'); ?>

<?php if ($totalRows_rswecpending != "0") { ?>
  <a href="#" title="View notofications!">
    <img src="../images/bell.png" width="20px" />
    <span class="badge">0</span></a>
<?php } else { ?>
  <a href="#">
    <img src="../images/bell-black.png" width="20px" /></a>
<?php } ?>