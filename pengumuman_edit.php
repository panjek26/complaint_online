<!DOCTYPE html>
<html lang="en">

<?php
$init='PGM';
$sub_init='PGM';
include ('header.php'); 
include ('session.php');
$fungsi= new Fungsi();
$id=$_POST['id'];
$query=$fungsi->pengumuman($id);
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
                        <h3 class="page-header">Pengumuman >> Tambah Pengumuman</h3>
                    </div>
                    <!-- /.col-lg-12 -->
					 <div class="col-xs-12">
					<div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
									 <label>TITLE</label>
									<input class="form-control" required name="title" autofocus value="<?php echo $qry['judul'] ?>">
									<input type="hidden" name="id" value="<?php echo $qry['id_pengumuman'] ?>" />
                                </div>
								<div class="form-group">
									<label>START DATE</label>
									<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
										<input type="text" class="form-control" name="startdate" value="<?php echo $qry['tgl_tampil'] ?>">
										<span class="add-on"><i class="icon-th"></i></span>
									</div>
								</div>
								<div class="form-group">
									<label>END DATE</label>
									<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
										<input type="text" class="form-control" name="enddate"  value="<?php echo $qry['tgl_tutup'] ?>">
										<span class="add-on"><i class="icon-th"></i></span>
									</div>
								</div>
								<div class="form-group">
                                    <label>TAMPIL PADA &nbsp;&nbsp;&nbsp;&nbsp;</label>
<?php 	if($qry['tampil_client']==1){ $check_client="checked"; } else { $check_client=""; } 
		if($qry['tampil_staff']==1){ $check_staff="checked"; } else { $check_staff="";} 
?>
										<label class="checkbox-inline"><input type="checkbox" name="client" value="1" <?php echo $check_client ?>>Client Only</label>
                                        <label class="checkbox-inline"><input type="checkbox" name="staff" value="1" <?php echo $check_staff ?>>Staff Only</label>   
                                </div>
								<div class="form-group">
                                    <label>KONTEN</label>
                                    <textarea class="form-control" rows="3" name="konten" ><?php echo $qry['konten'] ?></textarea>
                                </div>
								<div class="col-md-2">
                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Edit Pengumuman" />
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
if($_POST['submit']=="Edit Pengumuman"){
	$title		=$_POST['title'];
	$start_date	=$_POST['startdate'];
	$end_date	=$_POST['enddate'];
	$client		=$_POST['client'];
	$staff		=$_POST['staff'];
	$konten		=$_POST['konten'];
	$nik 		=$_SESSION['nik'];
	$id			=$_POST['id'];
	$update		=$fungsi->upd_pengumuman($title, $start_date, $end_date, $client, $staff, $konten, $nik, $id);	
		
	if($update){
	echo "<script>alert('DATA SUDAH DI MASUKAN KE DALAM DATABASE'); location.href='pengumuman.php'</script>";
	}else{
		echo "<script>alert('TERJADI KESALAHAN DATA'); history.back()</script>";
	}
	
}

?>