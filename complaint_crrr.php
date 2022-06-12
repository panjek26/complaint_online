<!DOCTYPE html>
<html lang="en">

<?php
$init='KMP';
$sub_init='CKMP';
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
                        <h3 class="page-header">Complaint >> Create Complaint</h3>
                    </div>
                    <!-- /.col-lg-12 -->
					 <div class="col-xs-12">
					<div class="panel-body">
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
									 <label>KATEGORI</label>
									<select class="form-control" required name="ktgr">
<?php
$fungsi= new Fungsi();
$result=$fungsi->get_ktgr(1);
while($dpt=mysql_fetch_array($result)){ ?>
                                        <option value="<?php echo $dpt['id_category'] ?>" ><?php echo $dpt['nama_category'] ?></option>
<?php } ?>
                                    </select>
                                </div>
								<div class="form-group">
									<label>ATTACHMENT</label>
									<input type="file" name="attach" ></input>
								</div>
								<div class="form-group">
                                    <label>RINCIAN MASALAH</label>
                                    <textarea class="form-control" rows="3" name="masalah" required ></textarea>
                                </div>
								<div class="col-md-2">
                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Create Complaint" />
								</div>
								<div class="col-md-3"></div>
								<div class="col-md-2">
                                <a href="complaint_cr.php" class="btn btn-primary btn-block">Reset</a>
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
if($_POST['submit']=="Create Complaint"){
	$ktgr		=$_POST['ktgr'];
	$rincian	=$_POST['masalah'];
	$nik 		=$_SESSION['nik'];
	$status		="Open";
	$tgl		=date('Y-m-d H:i:s');
	$folder		="attachment/";
	$tick		="/IDM/".date('m/Y');
	$totime		=strtotime($tgl);
	$wkt		=date('YmdHis', $totime); 
	$attach		=basename($_FILES["attach"]["name"]);
	
	$allowedExts 	= array("jpeg","jpg","png");
    $extension 		= end(explode(".", $_FILES["attach"]["name"]));
if (in_array($extension, $allowedExts)) {
	
	$nt=$fungsi->get_no_ticket($tick);
	$fetch		= mysql_fetch_array($nt);
	$pecah		= explode('/',$fetch['no_ticket']);
	$notic		= $pecah[0]+1 .$tick;
	
	$cek=$fungsi->check_complaint("stat",$nik);
	if(mysql_num_rows($cek)>=1){
		echo "<script>alert('Ada complaint yang belum di tutup, mohon tutup complaint dahulu'); location.href='complaint_st.php'</script>";
	} else {
	$insert		=$fungsi->cr_complaint($ktgr, $attach, $rincian, $nik, $status, $tgl, $notic);	
	if($insert){
		if(!empty($attach)){
		move_uploaded_file($_FILES["attach"]["tmp_name"], $folder.$wkt.$attach);
		}
	$check=$fungsi->check_complaint("tgl",$tgl);
	$row=mysql_fetch_array($check);
	$fungsi->ins_log_complaint($row['id_complaint'],$nik,$tgl,$status);
	echo "<script>alert('DATA SUDAH DI MASUKAN KE DALAM DATABASE'); location.href='complaint_st.php'</script>";
	}else{
		echo "<script>alert('TERJADI KESALAHAN DATA'); history.back()</script>";
	}
	}
	} else {
		echo "<script>alert('FILE HARUS FORMAT JPEG,JPG,PNG'); history.back()</script>";
	}
}

?>