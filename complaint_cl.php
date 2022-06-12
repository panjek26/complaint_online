<!DOCTYPE html>
<html lang="en">

<?php 
$init='KMP';
$sub_init='TKMP';
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
                    <div class="panel panel-default">
                        <h3 class="page-header">Data Complaint</h3>
						
                        <div class="panel-body">
                                  <form method="post" id="sample_form">							
                                    <table>
									<tr>
									<td width="100px"> <label>START DATE</label></td>
									<td width="10px">:</td>
									<td width="250px">
										<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
										<input type="text" class="form-control" required name="startdate" value="<?php echo $_POST['startdate'] ?>">
										<span class="add-on"><i class="icon-th"></i></span>
										</div>
									</td>
									<td width="70px"></td>
									<td width="100px"> <input type="submit" class="btn btn-primary btn-block" name="filter" value="Filter" /></td>
									<td width="10px"></td>
									<td width="250px">
									</td>
									<td width="50px"></td>
									<td></td>
									</tr>
									<tr height="50px">
									<td>  <label>END DATE</label></td>
									<td>:</td>
									<td><div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
										<input type="text" class="form-control" required name="enddate" value="<?php echo $_POST['enddate'] ?>">
										<span class="add-on"><i class="icon-th"></i></span>
										</div></form></td>
									<td></td>
									<td width="100px">								
									</td>
									<td></td>
									<td> </td>
									<td></td>
									<td>
									
      
                                    

									</td>
									</tr>
									
									<tr height="40px"></tr>
									</table>
								  
								  
								  
								  <table class="table table-striped table-bordered table-hover">
								  <thead>
                                        <tr>
											<th width="70px">No Ticket</th>
                                            <th width="150px">Created Date</th>
                                            <th width="40px">Category</th>
                                            <th width="400px">Konten</th>
                                            <th width="30px">Assignment</th>
                                            <th width="30px">SLA</th>
                                        </tr>
                                    </thead>
																		<tbody>
<?php 
$start_date	= $_POST['startdate'];
	$end_date	= $_POST['enddate'];
	if($start_date>$end_date){
	echo "<script>alert('START DATE TIDAK BOLEH LEBIH BESAR DARI END DATE'); location.href='complaint_cl.php'</script>";
	}
	$check=$fungsi->cl_complaint($_SESSION['nik'],$_SESSION['level'],$_POST['startdate'],$_POST['enddate']);
	if(mysql_num_rows($check)==0){
?>
										<tr>
										<td colspan="7">Data No Match In Database</td>
										</tr>
<?php } else {  $index=1;
	while($row=mysql_fetch_array($check)){
?>
										<tr>
                                            <td><a href="complaint_st_dtl.php?id=<?php echo base64_encode($row['id_complaint']); ?>"><?php echo $fungsi->moon($row['no_ticket']) ?></a></td>
											<td><?php echo $row['created_date'] ?></td>
                                            <td><?php echo $row['nama_category'] ?></td>
                                            <td><?php echo $row['rincian_masalah'] ?></td>
                                            <td><?php echo $row['nama'] ?></td>
											<td><?php if($row['status_sla']=='YES'){ ?>
                                <button type="button" class="btn btn-success disabled btn-xs">YES</button>											
											<?php } else { ?>
											<?php if($row['status_sla']=='NO'){ ?>
                                <button type="button" class="btn btn-danger disabled btn-xs">NO</button>
								<?php } else { ?>
								 <button type="button" class="btn btn-Default disabled btn-xs">NONE</button>
								    <?php } ?>
											<?php } ?> </td>
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
