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

mysql_select_db($database_connection, $connection);
$query_rsls = "SELECT * FROM landsurvey_tb WHERE landsurvey_id = '" . $_GET['landsurvey_id'] . "'";
$rsls = mysql_query($query_rsls, $connection) or die(mysql_error());
$row_rsls = mysql_fetch_assoc($rsls);
$totalRows_rsls = mysql_num_rows($rsls);

mysql_select_db($database_connection, $connection);
$query_rsdata = "SELECT * FROM recordsdata_tb WHERE landsurvey_id = '" . $_GET['landsurvey_id'] . "'";
$rsdata = mysql_query($query_rsdata, $connection) or die(mysql_error());
$row_rsdata = mysql_fetch_assoc($rsdata);
$totalRows_rsdata = mysql_num_rows($rsdata);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print</title>
</head>

<body>
  <div style="height: auto;
    width: 800px;
    padding: 10px;">

    <table>
      <tr>
        <td style="width: 425px;">Date: <?php echo $row_rsls['date']; ?></td>
        <td><input type="button" onclick="window.print()" value="PRINT" title="Click to print" /></td>
      </tr>
      <tr>
        <td>Full Name: <?php echo $row_rsls['firstname']; ?> <?php echo $row_rsls['middlename']; ?> <?php echo $row_rsls['lastname']; ?></td>
        <td>Tracking Number: <?php echo $row_rsls['landsurvey_id']; ?></td>
      </tr>
      <tr>
        <td>Address: <?php echo $row_rsls['address']; ?> <?php echo $row_rsls['municipality']; ?> <?php echo $row_rsls['province']; ?></td>
        <td>Unique ID: <?php echo $row_rsls['landsurvey_id']; ?></td>
      </tr>
      <tr>
        <td>Email: <?php echo $row_rsls['email_address']; ?></td>
        <td>Phone Number: <?php echo $row_rsls['mobile_no']; ?></td>
      </tr>
      <tr>
        <td colspan="2">Purpose: <?php echo $row_rsls['purpose']; ?></td>
      </tr>
    </table>

    <table border="1" cellpadding="5" cellspacing="0">
      <thead>
        <tr>
          <td>-</td>
          <td>Survey No.</td>
          <td>Location</td>
          <td>Survey Plan</td>
          <td>Cadastral Map</td>
          <td>Lot Data computation</td>
          <td>Lot Description</td>
        </tr>
      </thead>
      <tbody>
        <?php do { ?>
          <tr align="middle">
            <td><?php echo $row_rsdata['recordsdata_id']; ?></td>
            <td><?php echo $row_rsdata['survey_number']; ?></td>
            <td><?php echo $row_rsdata['location']; ?></td>
            <td><?php
                if ($row_rsdata['survey_plan'] == "Y") {
                  echo "&#10003;";
                } else {
                  echo $row_rsdata['survey_plan'];
                }
                ?>
            </td>
            <td><?php
                if ($row_rsdata['cadastral_map'] == "Y") {
                  echo "&#10003;";
                } else {
                  echo $row_rsdata['cadastral_map'];
                }
                ?>
            </td>
            <td><?php
                if ($row_rsdata['lot_data_computation'] == "Y") {
                  echo "&#10003;";
                } else {
                  echo $row_rsdata['lot_data_computation'];
                }
                ?></td>
            <td><?php
                if ($row_rsdata['lot_description'] == "Y") {
                  echo "&#10003;";
                } else {
                  echo $row_rsdata['lot_description'];
                }
                ?>
            </td>
          </tr>
        <?php } while ($row_rsdata = mysql_fetch_assoc($rsdata)); ?>
      </tbody>
    </table>

    <p>Remarks:</p>
    <br />
    <p>Researched by:</p>
    <br />
    <br />
    <hr>
  </div>
</body>

</html>
<?php
mysql_free_result($rsls);

mysql_free_result($rsdata);
?>