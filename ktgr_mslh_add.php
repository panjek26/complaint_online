<!DOCTYPE html>
<html lang="en">

<?php
$init='MSD';
$sub_init='KMSD';
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
                        <h3 class="page-header">Kategori Masalah >> Tambah Kategori Masalah</h3>
                    </div>
                    <!-- /.col-lg-12 -->
					 <div class="col-xs-12">
					<div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
									 <label>Kategori</label>
									<input class="form-control" required name="ktgr" autofocus>
                                </div>
								<div class="form-group">
									 <label>SLA</label>
									<input class="form-control" required name="sla" pattern="^[0-9]{0,15}$" placeholder="in minute">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
									<select class="form-control" required name="status">
									<option value="1">Aktif</option>
									<option value="0">Block</option>
                                    </select>
                                </div>
								
								<div class="col-md-2">
                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Add Kategori" />
								</div>
								<div class="col-md-3"></div>
								<div class="col-md-2">
                                <a href="ktgr_mslh.php" class="btn btn-primary btn-block">Back</a>
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
if($_POST['submit']=="Add Kategori"){
	$ktgr	=$_POST['ktgr'];
	$sla	=$_POST['sla'];
	$active	=$_POST['status'];
	$insert	=$fungsi->ins_ktgr($ktgr, $sla, $active);	
		
	if($insert){
	echo "<script>alert('DATA SUDAH DI MASUKAN KE DALAM DATABASE'); location.href='ktgr_mslh.php'</script>";
	}else{
		echo "<script>alert('TERJADI KESALAHAN DATA'); history.back()</script>";
	}
	
}

?>