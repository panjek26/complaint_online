<!DOCTYPE html>
<html lang="en">

<?php 
$init='LPR';
$sub_init='CLPR';
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
                        <h3 class="page-header">Laporan Complaint</h3>
						
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="filter">
								<form method="post" id="sample_form">							
                                    <table>
									<tr>
									<td width="100px"> <label>START DATE</label></td>
									<td width="10px">:</td>
									<td width="250px">
										<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
										<input type="text" class="form-control" required name="startdate" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" value="<?php echo $_POST['startdate'] ?>">
										<span class="add-on"><i class="icon-th"></i></span>
										</div>
									</td>
									<td width="70px"></td>
									<td width="100px"> <label>END DATE</label></td>
									<td width="10px">:</td>
									<td width="250px">
										<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
										<input type="text" class="form-control" required name="enddate" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" value="<?php echo $_POST['enddate'] ?>">
										<span class="add-on"><i class="icon-th"></i></span>
										</div>
									</td>
									<td width="50px"></td>
									<td></td>
									</tr>
									<tr height="50px">
									<td>  <label>STAFF</label></td>
									<td>:</td>
									<td><select class="form-control" name="staff" <?php echo $stf_dis ?>>
									<option value="All">ALL</option>
<?php
$result=$fungsi->get_staff(1,'SPV');
while($dpt=mysql_fetch_array($result)){
	if($dpt['nik']==$_POST['staff']){
		$slc_ktgr="selected";
	} else {
		$slc_ktgr="";
	}
?>										
                                        <option value="<?php echo $dpt['nik'] ?>" <?php echo $slc_ktgr ?>><?php echo $dpt['nama'] ?></option>
<?php } ?>
                                    </select></td>
									<td></td>
									<td></td>
									<td></td>
									<td><input type="submit" class="btn btn-primary btn-block" name="filter" value="Filter" /> </form></td>
									<td></td>
									<td>
									
<?php 
if($_POST['filter']){ ?>         
                                    <form action="print.php" method="POST" target="_blank">
									<input type="hidden" name="startdate" value="<?php echo $_POST['startdate'] ?>"/>
									<input type="hidden" name="enddate" value="<?php echo $_POST['enddate'] ?>"/>
									<input type="hidden" name="staff" value="<?php echo $_POST['staff'] ?>"/>
									<input type="submit" class="btn btn-primary btn-info" name="pdf" value="Print" />
									</form>
<?php } ?>
									</td>
									</tr>
									
									<tr height="40px"></tr>
									</table>
<?php if ($_POST['filter']){ ?>
					<table class="table table-striped table-bordered table-hover">
								  <thead>
                                        <tr>
											<th width="70px">Ticket</th>
                                            <th width="150px">Created Date</th>
                                            <th width="40px">Category</th>
                                            <th width="400px">Assigment</th>
                                            <th width="30px">Status</th>
                                            <th width="30px">SLA</th>
                                        </tr>
                                    </thead>
																		<tbody>
<?php 
	$staff	= $_POST['staff'];
	$start_date	= $_POST['startdate'];
	$end_date	= $_POST['enddate'];
	if($start_date>$end_date){
	echo "<script>alert('START DATE TIDAK BOLEH LEBIH BESAR DARI END DATE'); location.href='laporan_cp.php'</script>";
	}
	$check=$fungsi->get_lap_complaint($staff,$start_date,$end_date);
	if(mysql_num_rows($check)==0){
?>
										<tr>
										<td colspan="9">Data No Match In Database</td>
										</tr>
<?php } else {  $index=1;
	while($row=mysql_fetch_array($check)){
?>
										<tr>
                                            <td><a href="complaint_st_dtl.php?id=<?php echo base64_encode ($row['id_complaint']); ?>" target="_blank"><?php echo $fungsi->moon($row['no_ticket']) ?></a></td>
											<td><?php echo $row['created_date'] ?></td>
                                            <td><?php echo $row['nama_category'] ?></td>
                                            <td><?php echo $row['nama_assign'] ?></td>
                                            <td><?php echo $row['status'] ?></td>
                                            <td><?php if ($row['status_sla']=='YES') { ?> <button type="button" class="btn btn-success disabled btn-xs">YES</button>											
											<?php } else { ?>
											<?php if ($row['status_sla']=='NO') { ?> <button type="button" class="btn btn-danger disabled btn-xs">NO</button>											
											<?php } else { ?>
                                <button type="button" class="btn btn-default disabled btn-xs">NONE</button>
											<?php } ?> 
											<?php } ?> </td>
                                        </tr>
<?php $index++; } // mysql_fetch_array

 } //if ?>
									</tbody>
<?php } ?>
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
