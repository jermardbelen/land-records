<?php require_once('../Connections/connection.php'); ?>
<?php require_once('access_global.php'); ?>
<?php require_once('head.php'); ?>
	<!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Reports</h1>
    <!-- END PAGE TITLE-->
<form action="#" method="get" class="form-horizontal">  
<div class="form-group row">
                <div class="col-lg-4 form-input-group" id="ReportTypeFieldDiv">
                    <label class="control-label">
                        Date: <span class="required"> <i>Format: YYYY-MM-DD</i> </span>
                    </label>
                     <div>
                         <input type="text" name="date" value="<?php echo date("Y"); ?>" required class="form-control form-control-inline integerOnly inputdata" style="background-color:white" width="100%" />
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 form-input-group" id="OfficeFieldDiv">
                    <label class="control-label">
                        Status <span class="required"> <i></i> </span>
                    </label>
                    <div>
                        <select name="status" class="form-control" class="form-control form-control-inline integerOnly inputdata" style="background-color:white" width="100%" >
                                    	<option value="">ALL</option>
                         </select>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 form-input-group">
                    <input type="submit" value="GENERATE REPORT" class="btn green btn-outline" />
                </div>
            </div>
            <input type="hidden" name="tb1_colunm1" value="<?php echo $_GET['tb1_colunm1'];?>" />
            </form>            
<?php require_once('footer.php'); ?>