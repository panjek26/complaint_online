<!DOCTYPE html>
<html lang="en">

<?php 
$init='KMP';
$sub_init='SKMP';
include ('header.php'); 
include ('session.php');
$fungsi= new Fungsi();
if ($_SESSION['level']=='MGR') {
$mgr_dis="disabled";
}else{
$mgr_dis="";
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
                    <div class="panel panel-default">
                        <h3 class="page-header">Data Complaint</h3>
						
                        <div class="panel-body">
                                  <table class="table table-striped table-bordered table-hover">
								  <thead>
                                        <tr>
											<th width="70px">No Ticket</th>
                                            <th width="150px">Created Date</th>
                                            <th width="40px">Category</th>
                                            <th width="400px">Konten</th>
                                            <th width="30px">Status</th>
											<th width="50px">Aksi</th>
                                        </tr>
                                    </thead>
																		<tbody>
<?php 
	$check=$fungsi->st_complaint($_SESSION['nik'],$_SESSION['level']);
	if(mysql_num_rows($check)==0){
?>
										<tr>
										<td colspan="7">Data No Match In Database</td>
										</tr>
<?php } else {  $index=1;
	while($row=mysql_fetch_array($check)){
?>
										<tr>
                                            <td><a href="complaint_st_dtl.php?id=<?php echo base64_encode($row['id_complaint']); ?>" target="_blank"><?php echo $fungsi->moon($row['no_ticket']) ?></a></td>
											<td><?php echo $row['created_date'] ?></td>
                                            <td><?php echo $row['nama_category'] ?></td>
                                            <td><?php echo $row['rincian_masalah'] ?></td>
                                            <td><?php echo $row['status'] ?></td><td>
<?php if($row['status']=='Finished' && in_array($_SESSION['level'],array('Staff','SPV'))) {
}else{?>
											<form action="complaint_st_edit.php" method="POST"><input type="hidden" name="id" value="<?php echo $row['id_complaint'] ?>"/>
											<input type="submit" class="btn btn-outline btn-success btn-xs" <?php echo $mgr_dis ?> name="submit" value="Pilih" /></form>
<?php } ?>
											</td>
                                        </tr>
<?php $index++; } // mysql_fetch_array

 } //if ?>
									</tbody>

								  </table>               
                               
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
				
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
