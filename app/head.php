<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset=" utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="shortcut icon" type="image/jpg" href="../images/logo2.png" />

  <title><?php echo $title; ?> | <?php echo $clientalias; ?></title>

  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="<?php echo $title; ?>" name="description">
  <meta content="" name="author">
  <link href="../plugins/facebox/src/facebox.css" rel="stylesheet" />
  <link href="../plugins/datatables/css/demo_table_jui.css" rel="stylesheet" />
  <link href="../plugins/datatables/themes/ui-lightness/jquery-ui-1.8.4.custom.css" rel="stylesheet" />
  <link href='../plugins/fullcalendar/lib/main.css' rel='stylesheet' />
  <script src='../plugins/fullcalendar/lib/main.js'></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../plugins/datatables/js/jquery.dataTables.js" type="text/javascript"></script>
  <script src="../plugins/facebox/src/facebox.js" type="text/javascript"></script>
  <script>
    <!--
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage: '../plugins/facebox/src/loading.gif',
        closeImage: '../plugins/facebox/src/closelabel.png'
      })
    })
    //
    -->
  </script>

  <script>
    $(document).ready(function() {
      $('#datatables').dataTable({
        "sPaginationType": "full_numbers",
        "aaSorting": [
          [1, "asc"]
        ],
        "bJQueryUI": true
      });
      $("#datatables_filter input").focus();
    })
  </script>
  <script>
    function doRefresh() {
      $("#show").load("notification.php");
      setTimeout(function() {
        doRefresh();
      }, <?php echo rand(300000, 305000); ?>);
    }

    $(document).ready(function() {
      doRefresh();
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        initialDate: '<?php echo date("Y-m-d"); ?>',
        navLinks: true, // can click day/week names to navigate views
        nowIndicator: true,

        weekNumbers: true,
        weekNumberCalculation: 'ISO',

        editable: true,
        selectable: true,
        dayMaxEvents: true, // allow "more" link when too many events
        events: [
          <?php do { ?> {
              title: '<?php echo $row_rssched['title']; ?>',
              url: '../cal/view.php?sched_id=<?php echo $row_rssched['sched_id']; ?>',
              start: '<?php echo $row_rssched['start_date']; ?>T<?php echo $row_rssched['start_time']; ?>',
              end: '<?php echo $row_rssched['end_date']; ?>T<?php echo $row_rssched['end_time']; ?>'
            },
          <?php } while ($row_rssched = mysql_fetch_assoc($rssched)); ?> {
            groupId: 999,
            title: 'Happy Birthday Maam Liza',
            url: '#Happy Birthday Maam Liza',
            start: '2022-08-13T08:00:00',
            end: '2022-08-13T17:00:00'
          }
        ]
      });

      calendar.render();
    });
  </script>
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
                <span class="username username-hide-on-mobile" id="menuname">RECORDS</span>
                <i><img src="../images/menu.png" /></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-default menuaccess">
                <li><a href="https://docs.google.com/document/d/1HkdA1JhgVz3Pc1FG7bmph_BWtZ-V6LlSuoA21CAABd0/edit?usp=sharing" target="_blank">Manual</a></li>
                <li><a href="/" target="_blank">Other Systems</a></li>

              </ul>
            </li>

            <!-- BEGIN USER LOGIN DROPDOWN -->
            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
            <li class="dropdown dropdown-user">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" title="<?php echo $row_rsuser['details']; ?>">

                <span class="username username-hide-on-mobile"> Hi <?php echo $_SESSION['MM_Username']; ?></span>
                <i><img src="../images/menu.png" width="18px" /></i>
              </a>
              <div class="dropdown-menu dropdown-menu-default hold-on-click" style="width:250px; max-width:250px; padding:15px">
                <div class="col-lg-12">
                  <div class="row">
                    <ul class="nav nav-pills nav-stacked" style="color:dimgray">
                      <li><a href="logout.php">
                          <?php if ($_SESSION['MM_Username'] == NULL) {
                            echo "Login";
                          } else {
                            echo "Logout";
                          } ?>
                        </a></li>
                      <li></li>
                      <li><a href="https://docs.google.com/document/d/1HkdA1JhgVz3Pc1FG7bmph_BWtZ-V6LlSuoA21CAABd0/edit?usp=sharing" target="_blank">User Manual</a></li>
                      <li><a href="/" target="_blank">Systems Directory</a></li>
                      <li><a href="../../phpmyadmin/sql.php?db=database&table=users_tb" target="_blank">User Accounts</a></li>
                      <li><a href="../../phpmyadmin/server_import.php" target="_blank">Restore Data</a></li>
                      <li><a href="../database/backupdb.php">Backup Data</a></li>
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

              <?php require_once('menu.php'); ?>

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
                <a href="home.php">DENR</a>
                >
              </li>
              <li>
                <span><?php echo $clientbranch ?></span>
              </li>
            </ul>
          </div>
          <!-- END PAGE BAR -->
          <!-- BEGIN DASHBOARD STATS 1-->