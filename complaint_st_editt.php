<!DOCTYPE html>
<html lang="en">

<?php
$init='KMP';
$sub_init='SKMP';
include ('header.php'); 
include ('session.php');
$fungsi= new Fungsi();
$id=$_POST['id'];
$query=$fungsi->complaint($id);
$qry=mysql_fetch_assoc($query);
$client_dis=""; $spv_dis=""; $stf_dis="";
if($_SESSION['level']=="Client"){
	$client_dis="disabled";
} else if($_SESSION['level']=="SPV"){
	$spv_dis="disabled";
} else if($_SESSION['level']=="Staff"){
	$stf_dis="disabled";
}
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
                        <h3 class="page-header">Complaint >> Edit Complaint</h3>
                    </div>
                    <!-- /.col-lg-12 -->
					 <div class="col-xs-12">
					<div class="panel-body">
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            <fieldset>
								<div class="form-group">
									 <label>NO TICKET</label>
									<input class="form-control" disabled name="dpt" value="<?php echo $fungsi->moon($qry['no_ticket']) ?>">
										<input type="hidden" name="id" value="<?php echo $qry['id_complaint'] ?>">
										<input type="hidden" name="stat_lama" value="<?php echo $qry['status'] ?>"/>
                                </div>
                                <div class="form-group">
									 <label>KATEGORI</label>
									<select class="form-control" name="ktgr" <?php echo $client_dis. $stf_dis; ?>>
<?php
$result=$fungsi->get_ktgr(1);
while($dpt=mysql_fetch_array($result)){
	if($qry['id_category']==$dpt['id_category']){
		$slc_ktgr="selected";
	} else {
		$slc_ktgr="";
	}
?>
                                        <option value="<?php echo $dpt['id_category'] ?>" <?php echo $slc_ktgr ?>><?php echo $dpt['nama_category'] ?></option>
<?php } ?>
                                    </select>
                                </div>
<?php if($_SESSION['level']<>"Client"){ ?>
								<div class="form-group">
									 <label>ASSIGNMENT</label>
									<select class="form-control" name="assign" <?php echo $stf_dis ?>>
<?php
$result=$fungsi->get_staff(1,$_SESSION['level']);
while($dpt=mysql_fetch_array($result)){
	if($dpt['nik']==$qry['assigment']){
		$slc_ktgr="selected";
	} else {
		$slc_ktgr="";
	}
?>							
                                        <option value="<?php echo $dpt['nik'] ?>" <?php echo $slc_ktgr ?>><?php echo $dpt['nama'] ?></option>
<?php } ?>
                                    </select>
                                </div>
<?php } ?>
<?php if($_SESSION['level']<>'SPV' && $_SESSION['Staff']){?>
								<div class="form-group">
									<label>ATTACHMENT</label>
									<input type="file" name="attach"></input><?php echo $qry['attachment'] ?>
								</div>
<?php } ?>
<?php if(($_SESSION['level']<>"Client" or $qry['status']=='Finished') && ($_SESSION['level']<>'SPV' or ($qry['assigment']==$_SESSION['nik']) && in_array($qry['status'],array('Assignment','Working','Pending')))){ ?>
								<div class="form-group">
                                    <label>Status</label>
									<select class="form-control" required name="status">
<?php if ($_SESSION['level']=='Admin') { ?>								
									<option value="Open" <?php echo $slc_st_op ?>>Open</option>
									<option value="Assignment" <?php echo $slc_st_ass ?>>Assignment</option>
									<option value="Working" <?php echo $slc_st_wrk ?>>Working</option>
									<option value="Pending" <?php echo $slc_st_pnd ?>>Pending</option>
									<option value="Finished" <?php echo $slc_st_fns ?>>Finished</option> 
									<option value="Close" <?php echo $slc_st_cls ?>>Close</option>
	<?php } else if($qry['status']=="Open") {
	$slc_st_op="selected";
	$slc_st_ass=""; 
	$slc_st_wrk="";	
	$slc_st_cls="";
	$slc_st_pnd="";
	$slc_st_fns="";
	} else if($qry['status']=="Assignment") { 
	$slc_st_op="";
	$slc_st_ass="selected"; 
	$slc_st_wrk="";	
	$slc_st_cls="";
	$slc_st_pnd="";
	$slc_st_fns=""; 		?>		
									
									<option value="Working" <?php echo $slc_st_wrk ?>>Working</option>
<?php 	
	} else if($qry['status']=="Working") {
	$slc_st_op="";
	$slc_st_ass=""; 
	$slc_st_wrk="selected";	
	$slc_st_cls="";
	$slc_st_pnd="";
	$slc_st_fns=""; 		?>
									
									<option value="Pending" <?php echo $slc_st_pnd ?>>Pending</option>
									<option value="Finished" <?php echo $slc_st_fns ?>>Finished</option> 
<?php
	} else if($qry['status']=="Pending") {
	$slc_st_op="";
	$slc_st_ass=""; 
	$slc_st_wrk="";	
	$slc_st_cls="";
	$slc_st_pnd="selected";
	$slc_st_fns=""; 		?>
									<option value="Working" <?php echo $slc_st_wrk ?>>Working</option>
									
<?php
	} else if($qry['status']=="Finished") {
	$slc_st_op="";
	$slc_st_ass=""; 
	$slc_st_wrk="";	
	$slc_st_cls="";
	$slc_st_pnd="";
	$slc_st_fns="selected"; 	
	$disabled	=" disabled";?>							
									
									<option value="Close" <?php echo $slc_st_cls ?>>Close</option>
	<?php
	} else if($qry['status']=="Close") {
	$slc_st_op="";
	$slc_st_ass=""; 
	$slc_st_wrk="";	
	$slc_st_cls="selected";
	$slc_st_pnd="";
	$slc_st_fns=""; 		
	}  ?>
                                    </select>
                                </div>
<?php } ?>
								<div class="form-group">
                                    <label>RINCIAN MASALAH</label>
                                    <textarea class="form-control" rows="3" name="masalah" required <?php echo $spv_dis. $stf_dis. $client_dis. $disabled ?>><?php echo $qry['rincian_masalah'] ?></textarea>
									<input type="hidden" name="rin_mas" value="<?php echo $qry['rincian_masalah']?>"/>
                                </div>
<?php if($_SESSION['level']<>"Client" && in_array($qry['status'],array('Working')) ){ ?>
								<div class="form-group">
                                    <label>SOLUSI MASALAH</label>
                                    <textarea class="form-control" rows="3" name="solusi_masalah" required ><?php echo $qry['solusi_masalah'] ?></textarea>
                                </div>
<?php } ?>
								<div class="col-md-2">
                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Edit Complaint" />
								</div>
								<div class="col-md-3"></div>
								<div class="col-md-2">
                                <a href="complaint_st.php" class="btn btn-primary btn-block">Back</a>
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
if($_POST['submit']=="Edit Complaint"){
	$attach		=basename($_FILES["attach"]["name"]);
	$rincian	=$_POST['masalah'];
	$nik 		=$_SESSION['nik'];
	$tgl		=date('Y-m-d H:i:s');
	$folder		="attachment/";
	$id			=$_POST['id'];
	$assign		=$_POST['assign'];
	$stat_lama	=$_POST['stat_lama'];
	$status		=$_POST['status'];
	$solusi		=$_POST['solusi_masalah'];
	$ktgr		=$_POST['ktgr'];
	$status_sla	="";
	$rin_mas	=$_POST['rin_mas'];
	
	if(empty($rincian)){
		$rincian = $rin_mas;
	} 
	
	if (file_exists($folder.$attach) && $folder.$attach<>'attachment/') {
	echo "<script>alert('MAAF NAMA FILE SUDAH ADA SEBELUMNYA'); history.back()</script>";
	} else {
		if($status=="Finished"){
			$cek_closed=$fungsi->log_complaint($id);
			$hitung=strtotime($tgl);
			while($cek_cl=mysql_fetch_array($cek_closed)){
				if($cek_cl['status']=='Working'){
					$hitung -= strtotime($cek_cl['tanggal']);
				} else if ($cek_cl['status']=='Pending'){
					$hitung += strtotime($cek_cl['tanggal']);
				}
			}
			$total = floor($hitung/60);
			$selisih_data= $fungsi->get_selisih($id);
			$sla_time=mysql_fetch_array($selisih_data);
			$sla_t=$sla_time['sla'];
			if($sla_t>=$total) {
				$status_sla="YES";
			} else {
				$status_sla="NO";
			}
		}
	$update		=$fungsi->upd_complaint_st($attach, $rincian, $id, $assign, $stat_lama, $status, $solusi, $status_sla, $ktgr);	
	if($update){
		move_uploaded_file($_FILES["attach"]["tmp_name"], $folder.$attach);
	if(!empty($assign) && $stat_lama=='Open'){
		$status_ch="Assginment";
	} else if ($status<>$stat_lama  && !empty($status)){
		$status_ch=$status;
	} else {
		$status_ch="Edited";
	}
	$fungsi->ins_log_complaint($id,$nik,$tgl,$status_ch);
	echo "<script>alert('DATA SUDAH DI MASUKAN KE DALAM DATABASE'); location.href='complaint_st.php'</script>";
	}else{
		echo "<script>alert('TERJADI KESALAHAN DATA'); history.back()</script>";
	}
	}
}

?>