<?php require_once('../Connections/connection.php'); ?>
<?php require_once('access_admin.php'); ?>
<?php require_once('config.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
  {
    if (PHP_VERSION < 6) {
      $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

    switch ($theType) {
      case "text":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;
      case "long":
      case "int":
        $theValue = ($theValue != "") ? intval($theValue) : "NULL";
        break;
      case "double":
        $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
        break;
      case "date":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;
      case "defined":
        $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
        break;
    }
    return $theValue;
  }
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsls = 10;
$pageNum_rsls = 0;
if (isset($_GET['pageNum_rsls'])) {
  $pageNum_rsls = $_GET['pageNum_rsls'];
}
$startRow_rsls = $pageNum_rsls * $maxRows_rsls;

mysql_select_db($database_connection, $connection);
$query_rsls = "SELECT * FROM landsurvey_tb";
$query_limit_rsls = sprintf("%s LIMIT %d, %d", $query_rsls, $startRow_rsls, $maxRows_rsls);
$rsls = mysql_query($query_limit_rsls, $connection) or die(mysql_error());
$row_rsls = mysql_fetch_assoc($rsls);

if (isset($_GET['totalRows_rsls'])) {
  $totalRows_rsls = $_GET['totalRows_rsls'];
} else {
  $all_rsls = mysql_query($query_rsls);
  $totalRows_rsls = mysql_num_rows($all_rsls);
}
$totalPages_rsls = ceil($totalRows_rsls / $maxRows_rsls) - 1;

$queryString_rsls = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (
      stristr($param, "pageNum_rsls") == false &&
      stristr($param, "totalRows_rsls") == false
    ) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsls = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsls = sprintf("&totalRows_rsls=%d%s", $totalRows_rsls, $queryString_rsls);
?>
<?php require_once('head.php'); ?>

<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Applications</h1>
<!-- END PAGE TITLE-->

<div class="row">
  <form name="search" action="search_applications.php" method="get" class="form-horizontal" role="form">
    <div class="col-md-2">
      <a class="btn green btn-outline" href="index.php">New Application</a>
    </div>

    <div class="col-md-10 pull-right">
      <div class="form-group">
        <label class="col-md-6 control-label"></label>
        <label class="col-md-3 control-label">Search</label>
        <div class="col-md-3">
          <span class="select2 select2-container select2-container--bootstrap" dir="ltr" style="width: 100%;">
            <input type="text" name="query" placeholder="Quick Search" value="<?php echo $_GET['query']; ?>" class="select2-selection select2-selection--single" style="width: 100%;" />
          </span>
        </div>
      </div>
    </div>
    <input type="hidden" name="email_address" value="">
  </form>
</div>
<div style="overflow-x:auto;">
  <table class="table table-striped table-bordered table-hover table-header-fixed">
    <tr>
      <thead>
        <th>#</th>
        <th>Email Address</th>
        <th>Status</th>
        <th>Date</th>
        <th>Areacode</th>
        <th>Mobile No.</th>
        <th>Lastname</th>
        <th>Firstname</th>
        <th>Middlename</th>
        <th>Address</th>
        <th>Municipality</th>
        <th>Province</th>
        <th>Purpose</th>
    </tr>
    </thead>
    <tbody>
      <?php do { ?>
        <tr>
          <td><a href="printls.php?landsurvey_id=<?php echo $row_rsls['landsurvey_id']; ?>"><?php echo $row_rsls['landsurvey_id']; ?></a></td>
          <td><a href="mailto:<?php echo $row_rsls['email_address']; ?>"><?php echo $row_rsls['email_address']; ?></a></td>
          <td><?php echo $row_rsls['status']; ?></td>
          <td><?php echo $row_rsls['date']; ?></td>
          <td><?php echo $row_rsls['areacode']; ?></td>
          <td><?php echo $row_rsls['mobile_no']; ?></td>
          <td><?php echo $row_rsls['lastname']; ?></td>
          <td><?php echo $row_rsls['firstname']; ?></td>
          <td><?php echo $row_rsls['middlename']; ?></td>
          <td><?php echo $row_rsls['address']; ?></td>
          <td><?php echo $row_rsls['municipality']; ?></td>
          <td><?php echo $row_rsls['province']; ?></td>
          <td><?php echo $row_rsls['purpose']; ?></td>
        </tr>
      <?php } while ($row_rsls = mysql_fetch_assoc($rsls)); ?>
    </tbody>
  </table>
</div>
<table border="0">
  <tr>
    <td><?php if ($pageNum_rsls > 0) { // Show if not first page 
        ?>
        <a href="<?php printf("%s?pageNum_rsls=%d%s", $currentPage, 0, $queryString_rsls); ?>">First</a>
      <?php } // Show if not first page 
      ?>
    </td>
    <td><?php if ($pageNum_rsls > 0) { // Show if not first page 
        ?>
        <a href="<?php printf("%s?pageNum_rsls=%d%s", $currentPage, max(0, $pageNum_rsls - 1), $queryString_rsls); ?>">Previous</a>
      <?php } // Show if not first page 
      ?>
    </td>
    <td><?php if ($pageNum_rsls < $totalPages_rsls) { // Show if not last page 
        ?>
        <a href="<?php printf("%s?pageNum_rsls=%d%s", $currentPage, min($totalPages_rsls, $pageNum_rsls + 1), $queryString_rsls); ?>">Next</a>
      <?php } // Show if not last page 
      ?>
    </td>
    <td><?php if ($pageNum_rsls < $totalPages_rsls) { // Show if not last page 
        ?>
        <a href="<?php printf("%s?pageNum_rsls=%d%s", $currentPage, $totalPages_rsls, $queryString_rsls); ?>">Last</a>
      <?php } // Show if not last page 
      ?>
    </td>
  </tr>
</table>
<?php require_once('footer.php'); ?>
<?php
mysql_free_result($rsls);

mysql_free_result($rswec);
?>