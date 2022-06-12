<!DOCTYPE html>
<html lang="en">

<?php
$init='KMP';
$sub_init='SKMP';
include ('header.php'); 
include ('session.php');
$fungsi= new Fungsi();
$id=base64_decode($_GET['id']);
$query=$fungsi->complaint($id); // ini fungsi complaint class diagram beda field
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
				<br/>
					<div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="glyphicon glyphicon-phone-alt"></i> Detail Complaint
                        </div>
                        <!-- /.panel-heading -->
						<div class="panel-body">
                        <table>
							<tr>
							<td nowrap><label>No Ticket</label></td>
							<td width="30px"></td>
							<td width="600px"><input class="form-control" disabled value="<?php echo $fungsi->moon($qry['no_ticket']) ?>"></td>
							</tr>
							<tr height="50px">
							<td nowrap><label>SLA</label></td>
							<td></td>
							<td><input class="form-control" disabled value="<?php echo $qry['status_sla'] ?>"></td>
							</tr>
							<tr height="30px">
							<td nowrap><label>Created By</label></td>
							<td></td>
							<td><input class="form-control" disabled value="<?php echo $qry['nama'] ?>"></td>
							</tr>
							<tr height="50px">
							<td nowrap><label>Department</label></td>
							<td></td>
							<td><input class="form-control" disabled value="<?php echo $qry['nama_dept'] ?>"></td>
							</tr>
							<tr height="30px">
							<td nowrap><label>Created Date</label></td>
							<td></td>
							<td><input class="form-control" disabled value="<?php echo $qry['created_date'] ?>"></td>
							</tr>
							<tr height="50px">
							<td nowrap><label>Kategori</label></td>
							<td></td>
							<td><input class="form-control" disabled value="<?php echo $qry['nama_category'] ?>"></td>
							</tr>
							<tr height="50px">
							<td nowrap><label>Time Of SLA</label></td>
							<td></td>
							<td><input class="form-control" disabled value="<?php echo $qry['sla'] ?> Menit"></td>
							</tr>
							<tr height="30px">
							<td nowrap><label>Assignment To</label></td>
							<td></td>
							<td><input class="form-control" disabled value="<?php echo $qry['nama_assigment'] ?>"></td>
							</tr>
							<tr height="50px">
							<td nowrap><label>Attachment</label></td>
							<td></td>
							<td><input class="form-control" disabled value="<?php echo $qry['attachment'] ?>"></td>
							</tr>
							<tr height="30px">
							<td nowrap><label>Status</label></td>
							<td></td>
							<td><input class="form-control" disabled value="<?php echo $qry['status'] ?>"></td>
							</tr>
							<tr height="130px">
							<td nowrap><label>Rincian Masalah</label></td>
							<td></td>
							<td><textarea disabled class="form-control" rows="4" name="masalah" required ><?php echo $qry['rincian_masalah'] ?></textarea></td>
							</tr>
							<tr height="30px">
							<td nowrap><label>Solusi Masalah</label></td>
							<td></td>
							<td><textarea disabled class="form-control" rows="4" name="masalah" required ><?php echo $qry['solusi_masalah'] ?></textarea></td>
							</tr>
                        </table>   
                        </div>
                        <!-- /.panel-body -->
						
					</div>
<?php if(!empty($qry['attachment'])){ 
$totime=strtotime($qry['created_date']);
?>					
					<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-photo fa-fw"></i> Attachment
                        </div>
					
					<div class="panel-body">
					<img src="attachment/<?php echo date('YmdHis', $totime).$qry['attachment'] ?>" width="620" height="620" />
					</div>
					</div>
<?php } ?>					

					</div>
					<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="glyphicon glyphicon-pushpin"></i>   Tracking Complaint
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
<?php
	$log_cmpl	= $fungsi->log_complaint($id); // ini fungsi log complaint class diagram beda field
	while($row=mysql_fetch_array($log_cmpl)){ ?>
								<span class="list-group-item">
									<table>
										<tr>
											<td colspan="2" align="center" width="500px"><?php echo $row['tanggal'] ?></td>
										</tr>
										<tr>
										<td align="left"><i><?php echo $row['nama'] ?> - <?php echo $row['level'] ?></i></td><td align="right"><i><?php echo $row['status'] ?></i></td>
										</tr>
									</table>
                                </span>
<?php } ?>
                            </div>
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
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
	
	if (file_exists($folder.$attach) && $folder.$attach<>'attachment/') {
	echo "<script>alert('MAAF NAMA FILE SUDAH ADA SEBELUMNYA'); history.back()</script>";
	} else {
	$update		=$fungsi->upd_complaint_st($attach, $rincian, $id);	
	if($update){
		move_uploaded_file($_FILES["attach"]["tmp_name"], $folder.$attach);
	$fungsi->ins_log_complaint($id,$nik,$tgl,'Edited');
	echo "<script>alert('DATA SUDAH DI MASUKAN KE DALAM DATABASE'); location.href='complaint_st.php'</script>";
	}else{
		echo "<script>alert('TERJADI KESALAHAN DATA'); history.back()</script>";
	}
	}
}

?>