<?php require_once('../Connections/calendarcon.php'); ?>
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
$query_rssched = "SELECT * FROM sched_tb WHERE approved = 'APPROVED'";
$rssched = mysql_query($query_rssched, $connection) or die(mysql_error());
$row_rssched = mysql_fetch_assoc($rssched);
$totalRows_rssched = mysql_num_rows($rssched);
?>
<?php require_once('head.php'); ?>
<!-- BEGIN DASHBOARD STATS 1-->
        <div class="clearfix">&nbsp;</div>
        <!-- END DASHBOARD STATS 1-->
        
        <div class="row">
            <div class="col-lg-8 col-xs-12 col-sm-12">
                <!-- BEGIN PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
            <div class="col-lg-4 col-xs-12 col-sm-12">
                <!-- BEGIN PORTLET-->
                <div id="dataTable_wrapper" class="dataTables_wrapper no-footer">
                	<div class="top">
                        	<b>Announcements/Change-logs</b>
                     </div>
                     <div id="dataTable_processing" class="dataTables_processing" style="display: none;"></div>
                    <table class="table table-striped table-bordered table-hover table-header-fixed dataTable no-footer dtr-inline" style="margin-top: unset; width: 100%;" id="dataTable" aria-describedby="dataTable_info" role="grid" width="100%">
                    	<tr>
                        	<td>
                                      
                               <div style="height: 700px; overflow-y: scroll;">
                               <?php echo nl2br( file_get_contents('../README.md') );?>
                               </div>
                               
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- END PORTLET-->
            </div>
<?php require_once('footer.php'); ?>
