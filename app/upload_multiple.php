<?php require_once('../Connections/connection.php'); ?>
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
$query_rswildlife = "SELECT * FROM wildlife_export_tb WHERE wildlife_export_id = '%" . $_GET['wildlife_export_id'] . "%'";
$rswildlife = mysql_query($query_rswildlife, $connection) or die(mysql_error());
$row_rswildlife = mysql_fetch_assoc($rswildlife);
$totalRows_rswildlife = mysql_num_rows($rswildlife);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>DENR</title>
</head>

<body>
  <div id="header">
    <h1>Please upload the following:</h1>
  </div>
  <div id="content">
    <div class="content-container">
      <fieldset>
        
      <?php
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
  if (isset($_POST['username']) && isset($_FILES['file']['name'])) {
    # Username
    $username = $_POST['username'];

    # Get file name
    $filename = $_FILES['file']['name'];

    # Get File size
    $filesize = $_FILES['file']['size'];

    # Location
    $location = $_GET['directory'];

    # create directory if not exists in upload/ directory
    if (!is_dir($location)) {
      mkdir($location, 0755);
    }

    $location .= "/" . $filename;

    # Upload file
    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
      echo "<h2>File upload successful</h2>";
    }
  }
}
?>

        <?php
        $content = $_GET['content'];
        if ($content == "new") {
          echo $upload_wec;
        } elseif ($content == "or") {
          echo $upload_or;
        } elseif ($content == "orderofpayment") {
          echo $upload_orderofpayment;
        } else {
          echo "<h3>* Scanned PDF file(s)</h3>";
        }
        ?>
        <br />

        <form method='post' action='' enctype='multipart/form-data'>
          <input type='hidden' value='<?= $username ?>' name='username'>
          <p>Upload steps</p>
          <ol>
            <li><input type="file" name="file" id="file" required></li><br>
            <li><input type='submit' name='submit' value='Upload'> &nbsp; | &nbsp; <a href="uploads/wec<?php echo $_GET['wildlife_export_id']; ?>">View Uploaded Files</a></li><br>
            <?php if ($_GET['content'] == 'new') { ?>
              <li><a href="add_species.php?wildlife_export_id=<?php echo $_GET['wildlife_export_id']; ?>"><input type="button" value="Continue to add wildlife page" /></a></li><br>
            <?php } elseif ($_GET['content'] == 'comply') { ?>
              <li><a href="edit_wec.php?wildlife_export_id=<?php echo $_GET['wildlife_export_id']; ?>&content=<?php echo $_GET['content'] ?>"><input type="button" value="Continue" /></a></li><br>
            <?php } elseif ($_GET['content'] == 'or') { ?>
              <li><a href="edit_wec.php?wildlife_export_id=<?php echo $_GET['wildlife_export_id']; ?>&content=<?php echo $_GET['content'] ?>"><input type="button" value="Continue" /></a></li><br>
            <?php } else { ?>
            <?php } ?>
            <li><a href="#" onclick="history.go(-1)"><input type="button" value="Back" /></a></li>
          </ol>
        </form>
      </fieldset>
    </div>
  </div>
  <style type="text/css">
    <!--
    body {
      margin: 0;
      font-size: .7em;
      font-family: Verdana, Arial, Helvetica, sans-serif;
      background: #EEEEEE;
    }

    fieldset {
      padding: 0 15px 10px 15px;
    }

    h1 {
      font-size: 2.4em;
      margin: 0;
      color: #FFF;
    }

    h2 {
      font-size: 1.7em;
      margin: 0;
      color: #CC0000;
    }

    h3 {
      font-size: 1.2em;
      margin: 10px 0 0 0;
      color: #000000;
    }

    #header {
      width: 96%;
      margin: 0 0 0 0;
      padding: 6px 2% 6px 2%;
      font-family: "trebuchet MS", Verdana, sans-serif;
      color: #FFF;
      background-color: #555555;
    }

    #content {
      margin: 0 0 0 2%;
      position: relative;
    }

    .content-container {
      background: #FFF;
      width: 96%;
      margin-top: 8px;
      padding: 10px;
      position: relative;
    }
    -->
  </style>
</body>

</html>