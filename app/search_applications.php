<?php require_once('../Connections/connection.php'); ?>
<?php require_once('access_global.php'); ?>
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

$maxRows_rswec = 10;
$pageNum_rswec = 0;
if (isset($_GET['pageNum_rswec'])) {
  $pageNum_rswec = $_GET['pageNum_rswec'];
}
$startRow_rswec = $pageNum_rswec * $maxRows_rswec;

mysql_select_db($database_connection, $connection);
$query_rswec = "SELECT * FROM wildlife_export_tb WHERE email_address LIKE '%".$_GET[email_address]."%' AND (lastname LIKE '%".$_GET[query]."%' OR firstname LIKE '%".$_GET[query]."%' OR consignee_lastname LIKE '%".$_GET[query]."%' OR consignee_firstname LIKE '%".$_GET[query]."%' OR consignee_province LIKE '%".$_GET[query]."%') ORDER BY status DESC";
$query_limit_rswec = sprintf("%s LIMIT %d, %d", $query_rswec, $startRow_rswec, $maxRows_rswec);
$rswec = mysql_query($query_limit_rswec, $connection) or die(mysql_error());
$row_rswec = mysql_fetch_assoc($rswec);

if (isset($_GET['totalRows_rswec'])) {
  $totalRows_rswec = $_GET['totalRows_rswec'];
} else {
  $all_rswec = mysql_query($query_rswec);
  $totalRows_rswec = mysql_num_rows($all_rswec);
}
$totalPages_rswec = ceil($totalRows_rswec/$maxRows_rswec)-1;

$queryString_rswec = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rswec") == false && 
        stristr($param, "totalRows_rswec") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rswec = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rswec = sprintf("&totalRows_rswec=%d%s", $totalRows_rswec, $queryString_rswec);
?>
<?php require_once('head.php'); ?>

		<!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">Applications [WEC]</h1>
        <!-- END PAGE TITLE-->

		<div class="row">
            <form name="search" action="search_applications.php" method="get" class="form-horizontal" role="form">
                <div class="col-md-2">
<a class="btn green btn-outline" href="apply_wec.php?email_address=<?php echo $_SESSION['MM_Username']; ?>&content=new&directory=uploads">New WEC Application</a>
				</div>
                
                <div class="col-md-10 pull-right">
                    <div class="form-group">
                        <label class="col-md-6 control-label"></label>
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-3"> 
                            <span class="select2 select2-container select2-container--bootstrap" dir="ltr" style="width: 100%;">
                            	<input type="text" name="query" placeholder="Quick Search" value="<?php echo $_GET['query']; ?>" class="select2-selection select2-selection--single" style="width: 100%;" />
                          </span>
                        </div>
                    </div>
                </div>
            <input type="hidden" name="email_address" value="<?php echo $_GET['email_address']; ?>">
            </form>
        </div>
<?php if ($totalRows_rswec == 0) { ?>
	<h3>"<?php echo $_GET['query']; ?></php>" not found!</h3><?php } else { ?>
<div style="overflow-x:auto;">
  <table class="table table-striped table-bordered table-hover table-header-fixed">
  <thead>
    <tr>
      <th>ID</th>
      <th>Status</th>
      <th>Date</th>
      <th>Name</th>
      <th>Consignee Name</th>
      <th>Consignee Address</th>
      <th>Purpose</th>
      <th>Shipment Mode</th>
      <th>Issued</th>
      <th>Expiration</th>
    </tr>
    </thead>
    <tbody>
    <?php do { ?>
      <tr>
        <td>
        <?php if ($row_rswec['status'] == "APPROVED") {?>
        <a href="print_wec.php?wildlife_export_id=<?php echo $row_rswec['wildlife_export_id']; ?>&farm_permit_id=<?php echo $row_rswec['farm_permit_id']; ?>" title="Print Permit">PRINT</a>
        <?php } else { ?>                        
        <a href="view_wec.php?wildlife_export_id=<?php echo $row_rswec['wildlife_export_id']; ?>&farm_permit_id=<?php echo $row_rswec['farm_permit_id']; ?>"><?php echo $clientbranch; ?>-<?php echo date("Y", strtotime($row_rswec['date'])); ?>-<?php echo $row_rswec['wildlife_export_id']; ?></a>
        <?php } ?>
        </td>
        <td><?php echo $row_rswec['status']; ?></td>
        <td><?php echo $row_rswec['date']; ?></td>
        <td><?php echo $row_rswec['lastname']; ?> <?php echo $row_rswec['firstname']; ?> <?php echo $row_rswec['middlename']; ?></td>
        <td><?php echo $row_rswec['consignee_lastname']; ?> <?php echo $row_rswec['consignee_firstname']; ?> <?php echo $row_rswec['consignee_middlename']; ?></td>
        <td><?php echo $row_rswec['consignee_address']; ?> <?php echo $row_rswec['consignee_municipality']; ?> <?php echo $row_rswec['consignee_province']; ?></td>
        <td><?php echo $row_rswec['purpose']; ?></td>
        <td><?php echo $row_rswec['shipment_mode']; ?>
        <td><?php echo $row_rswec['date_issued']; ?></td>
        <td><?php echo $row_rswec['expiration_date']; ?></td>
      </tr>
      <?php } while ($row_rswec = mysql_fetch_assoc($rswec)); ?>
      </td>
  </table>
</div>
    	<ul class="pagination">
        	<li><a href="<?php printf("%s?pageNum_rswec=%d%s", $currentPage, 0, $queryString_rswec); ?>"><<</a></li>
        	<li><a href="<?php printf("%s?pageNum_rswec=%d%s", $currentPage, max(0, $pageNum_rswec - 1), $queryString_rswec); ?>"><</a></li>
        	<li><a href="#">Application(s) <?php echo ($startRow_rswec + 1) ?> to <?php echo min($startRow_rswec + $maxRows_rswec, $totalRows_rswec) ?> of <?php echo $totalRows_rswec ?></a></li>
       		<li><a href="<?php printf("%s?pageNum_rswec=%d%s", $currentPage, min($totalPages_rswec, $pageNum_rswec + 1), $queryString_rswec); ?>">></a></li>
        	<li><a href="<?php printf("%s?pageNum_rswec=%d%s", $currentPage, $totalPages_rswec, $queryString_rswec); ?>">>></a></li>
        </ul>
<?php } ?>
                
<?php require_once('footer.php'); ?>
<?php
mysql_free_result($rswec);
?>