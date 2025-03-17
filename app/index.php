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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf(
    "INSERT INTO landsurvey_tb (landsurvey_id, email_address, status, `date`, areacode, mobile_no, lastname, firstname, middlename, address, municipality, province, purpose) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
    GetSQLValueString($_POST['landsurvey_id'], "int"),
    GetSQLValueString($_POST['email_address'], "text"),
    GetSQLValueString($_POST['status'], "text"),
    GetSQLValueString($_POST['date'], "text"),
    GetSQLValueString($_POST['areacode'], "text"),
    GetSQLValueString($_POST['mobile_no'], "text"),
    GetSQLValueString($_POST['lastname'], "text"),
    GetSQLValueString($_POST['firstname'], "text"),
    GetSQLValueString($_POST['middlename'], "text"),
    GetSQLValueString($_POST['address'], "text"),
    GetSQLValueString($_POST['municipality'], "text"),
    GetSQLValueString($_POST['province'], "text"),
    GetSQLValueString($_POST['purpose'], "text")
  );

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());

  $insertGoTo = "redirect_add_data.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset=" utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="shortcut icon" type="image/jpg" href="../images/logo2.png" />

  <title>DENR | <?php echo $clientalias; ?></title>

  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="permits" name="description">
  <meta content="" name="author">

  <script src="../js/jquery.min.js"></script>

  <!-- View password -->
  <script>
    function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
  <style>
    body {
      margin: 40px 10px;
      padding: 0;
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
    }

    #calendar {
      max-width: 1100px;
      margin: 0 auto;
    }
  </style>
</head>

<body class="page-header-fixed page-sidebar-fixed page-footer-fixed page-sidebar-closed-hide-logo page-content-white page-md">
  <div class="page-wrapper" id="page-wrap">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
      <!-- BEGIN HEADER INNER -->
      <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
          <a href="home.php"><img src="../images/logo.png" alt="logo" class="logo-default" width="130px" height="25px"></a>
          <div class="menu-toggler sidebar-toggler">
            <span></span>
          </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
          <span></span>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
          <ul class="nav navbar-nav pull-right">
            <!-- BEGIN NOTIFICATION DROPDOWN -->
            <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
            <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
              <a name="!" data-hover="dropdown" data-close-others="true">
                <span id="show">
                  <img src="../images/bell-black.png" width="20px" /></a>
              </span>
              </a>
              <ul class="dropdown-menu">
                <li class="external">
                  <h3>Notifications</h3>
                </li>
                <li>
                  <ul class="dropdown-menu-list scroller" style="height: 250px; width:350px; max-width:350px" data-handle-color="#637283" id="notiContent"></ul>
                </li>
              </ul>
            </li>
            <!-- END NOTIFICATION DROPDOWN -->
            <li class="dropdown dropdown-user">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img alt="" src="../images/home.png">
                <span class="username username-hide-on-mobile" id="menuname">Home</span>
                <i><img src="../images/menu.png" /></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-default menuaccess">
                <li><a href="/" target="_blank">Other Systems</a></li>
              </ul>
            </li>

            <!-- BEGIN USER LOGIN DROPDOWN -->
            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
            <li class="dropdown dropdown-user">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" title="<?php echo $row_rsuser['details']; ?>">

                <span class="username username-hide-on-mobile">DENR</span>
                <i><img src="../images/menu.png" width="18px" /></i>
              </a>
              <div class="dropdown-menu dropdown-menu-default hold-on-click" style="width:250px; max-width:250px; padding:15px">
                <div class="col-lg-12">
                  <div class="row">
                    <ul class="nav nav-pills nav-stacked" style="color:dimgray">
                      <li><a href="login.php">Login</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
          </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
      </div>
      <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">

      <!-- BEGIN SIDEBAR -->
      <div class="page-sidebar-wrapper">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar navbar-collapse collapse">
          <!-- BEGIN SIDEBAR MENU -->
          <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 656px;">
            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px; overflow: hidden; width: auto; height: 656px;" data-height="656" data-initialized="1">
              <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
              <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                  <span></span>
                </div>
              </li>
              <!-- END SIDEBAR TOGGLER BUTTON -->

              <li class="active">
                <a href="#" onclick="history.go(-1)" class="nav-link nav-toggle">
                  <i><img src="../images/menu.png" width="18px" /></i>
                  <span class="title">Back</span>
                  <span class='selected'></span>
                </a>
              </li>

            </ul>
            <div class="slimScrollBar" style="background: rgb(187, 187, 187) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 656px;"></div>
            <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div>
          </div>
          <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
      </div>
      <!-- END SIDEBAR -->

      <!-- BEGIN CONTENT -->
      <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content" style="min-height: 656px;">
          <!-- BEGIN PAGE HEADER-->
          <!-- BEGIN PAGE BAR -->
          <div class="page-bar">
            <ul class="page-breadcrumb">
              <li>
                <a href="#">DENR</a>
                >
              </li>
              <li>
                <span><?php echo $clientbranch ?></span>
              </li>
            </ul>
          </div>
          <!-- END PAGE BAR -->
          <!-- BEGIN DASHBOARD STATS 1-->
          <!-- BEGIN PAGE TITLE-->
          <h1 class="page-title">Request for Survey Records</h1>
          <!-- END PAGE TITLE-->

          <div class="row">
            <div class="col-md-12">
              <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-body">
                  <div class="form-body">
                    <form method="post" name="form1" action="<?php echo $editFormAction; ?>" onsubmit="return confirm('Are you sure?')">
                      <div class="form-group">
                        <label>Email Address:</label>
                        <input type="email" name="email_address" value="" class="form-control" required />
                      </div>
                      <div class="form-group">
                        <label>Date:</label>
                        <input type="date" name="date" value="" class="form-control" />
                      </div>
                      <div class="form-group">
                        <label>Mobile No:</label>
                        <input type="number" name="mobile_no" value="" class="form-control" required />
                      </div>
                      <div class="form-group">
                        <label>Lastname:</label>
                        <input type="text" name="lastname" value="" class="form-control" required />
                      </div>
                      <div class="form-group">
                        <label>Firstname:</label>
                        <input type="text" name="firstname" value="" class="form-control" required />
                      </div>
                      <div class="form-group">
                        <label>Middlename:</label>
                        <input type="text" name="middlename" value="" class="form-control" />
                      </div>
                      <div class="form-group">
                        <label>Address:</label>
                        <input type="text" name="address" value="" class="form-control" />
                      </div>
                      <div class="form-group">
                        <label>Municipality:</label>
                        <input type="text" name="municipality" value="" class="form-control" />
                      </div>
                      <div class="form-group">
                        <label>Province:</label>
                        <input type="text" name="province" value="" class="form-control" />
                      </div>
                      <div class="form-group">
                        <label>Purpose:</label>
                        <input type="text" name="purpose" value="" class="form-control" />
                      </div>
                      <div class="form-group">
                        <label></label>
                        <input type="submit" value="Continue">
                      </div>
                      <input type="hidden" name="status" value="" />
                      <input type="hidden" name="areacode" value="" />
                      <input type="hidden" name="MM_insert" value="form1">
                    </form>
                  </div>
                </div>
              </div>
            </div>


          </div>
          <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->


      </div>
      <!-- END CONTAINER -->
      <!-- BEGIN FOOTER -->
      <div class="page-footer">
        <div class="page-footer-inner">
          DENR 2022
        </div>
        <div class="scroll-to-top">
          <i class="icon-arrow-up"></i>
        </div>
      </div>
      <!-- END FOOTER -->
    </div>

    <!-- Basic Styles -->
    <link href="../assets_files/font-awesome.css" rel="stylesheet">
    <link href="../assets_files/simple-line-icons.css" rel="stylesheet">
    <link href="../assets_files/bootstrap.css" rel="stylesheet">
    <link href="../assets_files/bootstrap-switch.css" rel="stylesheet">
    <link href="../assets_files/select2.css" rel="stylesheet">
    <link href="../assets_files/select2-bootstrap.css" rel="stylesheet">
    <link href="../assets_files/bootstrap-wysihtml5.css" rel="stylesheet">
    <link href="../assets_files/bootstrap-markdown.css" rel="stylesheet">
    <link href="../assets_files/sweetalert.css" rel="stylesheet">
    <link href="../assets_files/bootstrap_002.css" rel="stylesheet">
    <link href="../assets_files/toastr.css" rel="stylesheet">
    <link href="../assets_files/todo.css" rel="stylesheet">
    <link href="../assets_files/jquery.css" rel="stylesheet">
    <link href="../assets_files/profile.css" rel="stylesheet">
    <link href="../assets_files/profile-2.css" rel="stylesheet">
    <link href="../assets_files/morris.css" rel="stylesheet">
    <link href="../assets_files/bootstrap-fileinput.css" rel="stylesheet">
    <link href="../assets_files/components-md.css" rel="stylesheet">
    <link href="../assets_files/plugins-md.css" rel="stylesheet">
    <link href="../assets_files/layout.css" rel="stylesheet">
    <link href="../assets_files/darkblue.css" rel="stylesheet">
    <link href="../assets_files/custom.css" rel="stylesheet">

    <!-- END THEME LAYOUT STYLES -->

    <!-- jquery / bootstrap -->
    <script src="../assets_files/bootstrap.js"></script>
    <script src="../assets_files/js.js"></script>
    <script src="../assets_files/app.js"></script>
    <script src="../assets_files/jquery_008.js"></script>

    <!-- plugins -->

    <!-- layout -->
    <script src="../assets_files/layout.js"></script>
    <script src="../assets_files/demo.js"></script>
    <script src="../assets_files/quick-sidebar.js"></script>
    <script src="../assets_files/quick-nav.js"></script>

    <script src="../assets_files/jquery.js"></script>
    <script src="../assets_files/hubs"></script>
    <script src="../assets_files/signalr.js"></script>
    <script src="../assets_files/header.js"></script>
    <script src="../assets_files/user.js"></script>
    <script src="../assets_files/dashboard.js"></script>
</body>

</html>