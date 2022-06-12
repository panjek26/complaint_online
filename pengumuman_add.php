<!DOCTYPE html>
<html lang="en">

<?php
$init='PGM';
$sub_init='PGM';
include ('header.php'); 
include ('session.php');
$fungsi= new Fungsi();
?>
<body>

    <div id="wrapper">

        <!-- Side Menu -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

<?php include ('nav_header.php'); // sub header?> 

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
<?php include ('side_menu.php') // menu?>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h3 class="page-header">Pengumuman >> Tambah Pengumuman</h3>
                    </div>
                    <!-- /.col-lg-12 -->
					 <div class="col-xs-12">
					<div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
									 <label>TITLE</label>
									<input class="form-control" required name="title" autofocus>
                                </div>
								<div class="form-group">
									<label>START DATE</label>
									<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
										<input type="text" class="form-control" required name="startdate" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
										<span class="add-on"><i class="icon-th"></i></span>
									</div>
								</div>
								<div class="form-group">
									<label>END DATE</label>
									<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
										<input type="text" class="form-control" required name="enddate" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
										<span class="add-on"><i class="icon-th"></i></span>
									</div>
								</div>
								<div class="form-group">
                                    <label>TAMPIL PADA &nbsp;&nbsp;&nbsp;&nbsp;</label>
										<label class="checkbox-inline"><input type="checkbox" name="client" value="1">Client</label>
                                        <label class="checkbox-inline"><input type="checkbox" name="staff" value="1">Staff</label>   
                                </div>
								<div class="form-group">
                                    <label>KONTEN</label>
                                    <textarea class="form-control" required rows="3" name="konten" ></textarea>
                                </div>
								<div class="col-md-2">
                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Add Pengumuman" />
								</div>
								<div class="col-md-3"></div>
								<div class="col-md-2">
                                <a href="pengumuman.php" class="btn btn-primary btn-block">Back</a>
								</div>
                            </fieldset>
                        </form>
                    </div>  <!-- panel body -->
					 </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include ('jquery.php'); ?>	
<script type="text/javascript">
	$('.form_date').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
</script>
</body>

</html> 
<?php
if($_POST['submit']=="Add Pengumuman"){
	$title		=$_POST['title'];
	$start_date	=$_POST['startdate'];
	$end_date	=$_POST['enddate'];
	$client		=$_POST['client'];
	$staff		=$_POST['staff'];
	$konten		=$_POST['konten'];
	$nik 		=$_SESSION['nik'];;
	$insert		=$fungsi->ins_pengumuman($title, $start_date, $end_date, $client, $staff, $konten, $nik);	
	
	if($start_date>$end_date){
		echo "<script>alert('START DATE TIDAK BOLEH MELEBIHI END DATE '); history.back()</script>";
	}else {
	if($insert){
	echo "<script>alert('DATA SUDAH DI MASUKAN KE DALAM DATABASE'); location.href='pengumuman.php'</script>";
	}else{
		echo "<script>alert('TERJADI KESALAHAN DATA'); history.back()</script>";
	}
	}
	
}

?>