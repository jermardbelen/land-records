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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername = $_POST['username'];
  $password = $_POST['password'];
  $MM_fldUserAuthorization = "group_id";
  $MM_redirectLoginSuccess = "home.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_connection, $connection);

  $LoginRS__query = sprintf(
    "SELECT email_address, password, group_id FROM client_tb WHERE email_address=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"),
    GetSQLValueString($password, "text")
  );

  $LoginRS = mysql_query($LoginRS__query, $connection) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {

    $loginStrGroup  = mysql_result($LoginRS, 0, 'group_id');

    if (PHP_VERSION >= 5.1) {
      session_regenerate_id(true);
    } else {
      session_regenerate_id();
    }
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
    }
    header("Location: " . $MM_redirectLoginSuccess);
  } else {
    header("Location: " . $MM_redirectLoginFailed);
  }
}
?>
<?php require_once('config.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset=" utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo $clientalias; ?></title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="DATS" name="description">
  <meta content="" name="author">
  <style>
    .cke {
      visibility: hidden;
    }
  </style>
</head>

<body class="login">
  <!-- BEGIN : LOGIN PAGE 5-1 -->
  <div class="user-login-5">
    <div class="row bs-reset">
      <div class="col-md-6 bs-reset mt-login-5-bsfix">
        <div class="login-bg" style="background-image:url() )">
          <img class="login-logo" src="../images/logo.png">
        </div>
      </div>
      <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
        <div class="login-content">
          <h1><?php echo $clientalias; ?> Login</h1>
          <p> <b><?php echo $clientfullname; ?> (<?php echo $clientalias; ?>)</b>
            <?php echo $clientdescription; ?>
          </p>
          <form ACTION="<?php echo $loginFormAction; ?>" enctype="multipart/form-data" id="loginForm" method="POST" novalidate name="login">
            <div class="form-body">
              <div class="form-body">
                <div class="col-lg-6" style="padding-left:unset; padding-right:10px;">
                  <div class="form-group form-md-line-input form-md-floating-label" id="UserNamediv">
                    <input autocomplete="off" class="form-control inputdata" id="UserName" name="username" type="text">
                    <label for="UserName">Email Address</label>
                  </div>
                </div>
                <div class="col-lg-6" style="padding-left:10px; padding-right:unset;">
                  <div class="form-group form-md-line-input form-md-floating-label" id="PasswordDiv">
                    <input autocomplete="off" class="form-control inputdata" id="Password" name="password" type="password" value="">
                    <label for="Password">Password</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 text-right">
                  <input type="submit" value="Login" title="Use email address to login" class="btn green" />
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="login-footer">
          <div class="row bs-reset">
            <div class="col-xs-12 bs-reset">
              <div class="login-copyright text-right">
                <p>DENR 2022</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END : LOGIN PAGE 5-1 -->
  <link href="../assets_files/simple-line-icons.css" rel="stylesheet">
  <link href="../assets_files/bootstrap.css" rel="stylesheet">
  <link href="../assets_files/components.css" rel="stylesheet">
  <link href="../assets_files/plugins-md.css" rel="stylesheet">
  <link href="../assets_files/login-5.css" rel="stylesheet">
  <script src="../assets_files/user-login.js"></script>
</body>

</html>