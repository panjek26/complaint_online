<!DOCTYPE html>
<html lang="en">

<?php
$init='MSD';
$sub_init='DMSD';
include ('header.php'); 
include ('session.php');
$fungsi= new Fungsi();
$id=$_POST['id'];
$query=$fungsi->dept($id);
$qry=mysql_fetch_assoc($query);
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
                        <h3 class="page-header">Department >> Edit department</h3>
                    </div>
                    <!-- /.col-lg-12 -->
					 <div class="col-xs-12">
					<div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
									 <label>DEPARTMENT</label>
									<input class="form-control" required name="dpt" value="<?php echo $qry['nama_dept'] ?>">
										<input type="hidden" name="id" value="<?php echo $qry['id_dept'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
									<select class="form-control" required name="status">
<?php if($qry['status_dept']=="1") {
	$slc_st_af="selected";
	$slc_st_bl=""; 		
	} else if($qry['status_dept']=="0") {
	$slc_st_af="";
	$slc_st_bl="selected"; 		
	} ?>
									<option value="1" <?php echo $slc_st_af ?>>Aktif</option>
									<option value="0" <?php echo $slc_st_bl ?>>Block</option>
                                    </select>
                                </div>
								
								<div class="col-md-2">
                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Edit Department" />
								</div>
								<div class="col-md-3"></div>
								<div class="col-md-2">
                                <a href="department.php" class="btn btn-primary btn-block">Back</a>
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
</body>

</html> 
<?php
if($_POST['submit']=="Edit Department"){
	$nama	=$_POST['dpt'];
	$active	=$_POST['status'];
	$id		=$_POST['id'];
	$update	=$fungsi->upd_dept($id, $nama, $active);	
		
	if($update){
	echo "<script>alert('DATA SUDAH DI MASUKAN KE DALAM DATABASE'); location.href='department.php'</script>";
	}else{
		echo "<script>alert('TERJADI KESALAHAN DATA'); history.back()</script>";
	}
	
}

?>