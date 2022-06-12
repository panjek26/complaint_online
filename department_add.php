<!DOCTYPE html>
<html lang="en">

<?php
$init='MSD';
$sub_init='DMSD';
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
                        <h3 class="page-header">Toko >> Tambah Toko</h3>
                    </div>
                    <!-- /.col-lg-12 -->
					 <div class="col-xs-12">
					<div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
									 <label>TOKO</label>
									<input class="form-control" required name="dpt" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
									<select class="form-control" required name="status">
									<option value="1">Aktif</option>
									<option value="0">Block</option>
                                    </select>
                                </div>
								
								<div class="col-md-2">
                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Add Toko" />
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
if($_POST['submit']=="Add Toko"){
	$department	=$_POST['dpt'];
	$active	=$_POST['status'];
	$check		= $fungsi->check_deptn($department);
	if (mysql_num_rows($check)>0){
	echo "<script>alert('NAMA TOKO SUDAH ADA DI DATABASE'); history.back()</script>";
	}else{
	$insert	=$fungsi->ins_dpt($department, $active);	
	echo "<script>alert('DATA SUDAH DI MASUKAN KE DALAM DATABASE'); location.href='department.php'</script>";
	
}
}
?>