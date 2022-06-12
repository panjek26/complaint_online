<!DOCTYPE html>
<html lang="en">

<?php 
$init='LPR';
$sub_init='CLPR';
include ('header.php'); 
include ('session.php');
$fungsi= new Fungsi();
$id=base64_decode($_GET['id']);
$pch=explode("|",$id);
?>
<body>

    <div id="wrapper">

        <!-- Page Content -->
            <div class="container-fluid">
                <div class="row">				
                    <div class="panel panel-default">
                        <h3 class="page-header">Laporan Complaint</h3>
						
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="filter">						

					<table class="table table-striped table-bordered table-hover">
								  <thead>	
                                        <tr>
											<th width="70px">No Ticket</th>
                                            <th width="30px">SLA</th>
                                            <th width="50px">Created By</th>
                                            <th width="40px">Department</th>
                                            <th width="70px">Created Date</th>
                                            <th width="50px">Kategori</th>
                                            <th width="50px">Assignment</th>
                                            <th width="60px">Status</th>
                                            <th width="200px">Rincian Masalah</th>
                                            <th width="200px">Solusi Masalah</th>
                                        </tr>
                                    </thead>
																		<tbody>
<?php 

	$check=$fungsi->get_lap_pop($pch[0],$pch[1],$pch[2]);
	if(mysql_num_rows($check)==0){
?>
										<tr>
										<td colspan="10">Data No Match In Database</td>
										</tr>
<?php } else {  $index=1;
	while($row=mysql_fetch_array($check)){
?>
										<tr>
                                          <td><a href="complaint_st_dtl.php?id=<?php echo base64_encode ($row['id_complaint']); ?>" target="_blank"><?php echo $fungsi->moon($row['no_ticket']) ?></a></td>
											<td><?php if ($row['status_sla']=='YES') { ?> <button type="button" class="btn btn-success disabled btn-xs">YES</button>											
											<?php } else { ?>
											<?php if ($row['status_sla']=='NO') { ?> <button type="button" class="btn btn-danger disabled btn-xs">NO</button>											
											<?php } ?>
											<?php } ?>											
											</td>
                                            <td><?php echo $row['nama'] ?></td>
                                            <td><?php echo $row['nama_dept'] ?></td>
                                            <td><?php echo $row['created_date'] ?></td>
                                            <td><?php echo $row['nama_category'] ?></td>
                                            <td><?php echo $row['nama_assign'] ?></td>
                                            <td><?php echo $row['status'] ?></td>
                                            <td><?php echo $row['rincian_masalah'] ?></td>
                                            <td><?php echo $row['solusi_masalah'] ?></td>
                                        </tr>
<?php $index++; } // mysql_fetch_array

 } //if ?>
									</tbody>
<?php  ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
				
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

    </div>
    <!-- /#wrapper -->

<?php include ('jquery.php'); ?>

</body>

</html>
