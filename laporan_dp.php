<!DOCTYPE html>
<html lang="en">

<?php 
$init='LPR';
$sub_init='DLPR';
include ('header.php'); 
include ('session.php');
$fungsi= new Fungsi();
?>
<style>
.table th {
   text-align: center;  
	vertical-align: middle;  
}
</style>
<SCRIPT language="javascript">
function createWindow(cUrl,cName,cFeatures) {
var xWin = window.open(cUrl,cName,cFeatures)
}
</SCRIPT>
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
                        <h3 class="page-header">Laporan Complaint Toko</h3>
						
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="filter">
								<form method="post" id="sample_form">							
                                    <table>
									<tr>
									<td width="100px"> <label>Start Month</label></td>
									<td width="10px">:</td>
									<td width="250px">
										<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm" data-link-field="dtp_input2" data-link-format="yyyy-mm">
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
									<td>  <label>End Month</label></td>
									<td>:</td>
									<td><div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm" data-link-field="dtp_input2" data-link-format="yyyy-mm">
										<input type="text" class="form-control" required name="enddate" value="<?php echo $_POST['enddate'] ?>">
										<span class="add-on"><i class="icon-th"></i></span>
										</div></form></td>
									<td></td>
									<td width="100px">
<?php 
if($_POST['filter']){ ?>   
									<form action="print_dp.php" method="POST" target="_blank">
									<input type="hidden" name="startdate" value="<?php echo $_POST['startdate']."-01" ?>"/>
									<input type="hidden" name="enddate" value="<?php echo $_POST['enddate']."-31" ?>"/>
									 <input type="submit" class="btn btn-info btn-block" name="pdf" value="Print" />
									</form>
<?php } ?>									
									</td>
									<td></td>
									<td> </td>
									<td></td>
									<td>
									
      
                                    

									</td>
									</tr>
									
									<tr height="40px"></tr>
									</table>
<?php if ($_POST['filter']){ 
	$start_date	= $_POST['startdate']."-01";
	$end_date	= $_POST['enddate']."-31";
	if($start_date>$end_date){
	echo "<script>alert('START Month TIDAK BOLEH LEBIH BESAR DARI END Month'); location.href='laporan_dp.php'</script>";
	}?>
					<table class="table table-striped table-bordered table-hover table-condensed">
								  <thead>
                                        <tr>
											<th rowspan="2"><font size="1">Toko</font></th>
<?php
		$month = strtotime($start_date);
		while($month < strtotime($end_date)) {
?>
                                            <th colspan="3" align="center"><font size="1"><?php echo $fungsi->fm(date('m-Y', $month)); ?></font></th>
<?php $month = strtotime("+1 month", $month); } ?>
                                        </tr>
										<tr>
<?php
		$month = strtotime($start_date);
		while($month < strtotime($end_date)) {
?>
											<th><font size="1">TTL</font></th>
											<th><font size="1">CL/FS</font></th>
											<th><font size="1">SLA</font></th>
<?php $month = strtotime("+1 month", $month); } ?>
										</tr>
                                    </thead>
																		<tbody>
<?php 
	$check=$fungsi->get_lap_dept($start_date,$end_date);

	while($row=mysql_fetch_array($check)){
?>
										<tr>
                                            <td><font size="1"><?php echo $row['nama_dept'] ?></font></td>
<?php
		$month = strtotime($start_date);
		while($month < strtotime($end_date)) {
			$ttl_=base64_encode("ttl|". date('Y-m',$month)."|".$row['id_dept']);
			$cl_=base64_encode("close|". date('Y-m',$month)."|".$row['id_dept']);
			$sla_=base64_encode("sla|". date('Y-m',$month)."|".$row['id_dept']);
?>											<th><font size="1"><a href="javascript:createWindow('laporan_pop.php?id=<?php echo $ttl_;?>','ip','scrollbars=1,location=0,top=50,left=100,width=1000,height=700')" style="text-decoration: none; color:black;" ><?php echo $row['ttl'.date('ym', $month)] ?></a></font></th>
											<th><font size="1"><a href="javascript:createWindow('laporan_pop.php?id=<?php echo $cl_;?>','ip','scrollbars=1,location=0,top=50,left=100,width=1000,height=700')" style="text-decoration: none; color:black;" ><?php echo $row['close'.date('ym', $month)] ?></a></font></th>
											<th><font size="1"><a href="javascript:createWindow('laporan_pop.php?id=<?php echo $sla_;?>','ip','scrollbars=1,location=0,top=50,left=100,width=1000,height=700')" style="text-decoration: none; color:black;" ><?php echo $row['sla'.date('ym', $month)] ?></a></font></th>
<?php $month = strtotime("+1 month", $month); } ?>
                                        </tr>
<?php $index++; } // mysql_fetch_array ?>
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
