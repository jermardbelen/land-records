<?php require_once('../Connections/connection.php'); ?>
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

mysql_select_db($database_connection, $connection);
$query_rsls = "SELECT * FROM landsurvey_tb ORDER BY landsurvey_id DESC";
$rsls = mysql_query($query_rsls, $connection) or die(mysql_error());
$row_rsls = mysql_fetch_assoc($rsls);
$totalRows_rsls = mysql_num_rows($rsls);
?>
<meta http-equiv="refresh" content="0;URL='add_data.php?landsurvey_id=<?php echo $row_rsls['landsurvey_id']; ?>'" />
<meta name="viewport" content="width=device-width, initial-scale=1">
redirecting..
<?php
mysql_free_result($rsls);
?>
