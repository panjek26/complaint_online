<!DOCTYPE html>
<html lang="en">

<?php 
$init='PGM';
$sub_init='PGM';
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
                        <h3 class="page-header">Data Pengumuman</h3>
						
                        <div class="panel-body">
                            <!-- Nav tabs -->
						<div class="col-xs-2">
                            <a href="pengumuman_add.php" class="btn btn-primary btn-block">Add Pengumuman</a>
						</div>
						<div class="col-xs-7"></div>
					
						<div class="col-xs-3">
                            <ul class="nav nav-pills">
                                <li><a href="#active" data-toggle="tab">Aktif</a>
                                </li>
                                <li><a href="#block" data-toggle="tab">Non Aktif</a>
                                </li>
                                <li class="active"><a href="#filter" data-toggle="tab"> <span class="fa fa-search"> Filter </span></a>
                                </li>
                            </ul>
						</div>
						<br/>
						<br/>
						<br/>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade" id="active">
                                  <table class="table table-striped table-bordered table-hover table-condensed">
								  <thead>
                                        <tr>
                                            <th width="1px">No</th>
                                            <th width="50px">Title</th>
                                            <th width="100px">Konten</th>
                                            <th width="30px">Staff</th>
                                            <th width="30px">Client</th>
                                            <th width="30px">Created BY</th>
                                            <th width="100px">Start Date</th>
                                            <th width="100px">End Date</th>
											<th width="50px">Edit</th>
                                        </tr>
                                    </thead>
																		<tbody>
<?php 
	$check=$fungsi->get_pengumuman(1);
	if(mysql_num_rows($check)==0){
?>
										<tr>
										<td colspan="9">Data No Match In Database</td>
										</tr>
<?php } else {  $index=1;
	while($row=mysql_fetch_array($check)){
?>
										<tr>
                                            <td><?php echo $index ?></td>
											<td><?php echo $row['judul'] ?></td>
                                            <td><?php echo $row['konten'] ?></td>
                                            <th align="center"><?php if($row['tampil_staff']==1){  ?>
											<span class="glyphicon glyphicon-ok"></span>
											<?php 
											}else{
											if($row['tampil_staff']==0){  ?>
											<span class="glyphicon glyphicon-remove"></span>								
											<?php } ?>
											<?php } ?></th>
                                            <th align="center"><?php if($row['tampil_client']==1){ ?>
											<span class="glyphicon glyphicon-ok"></span>
											<?php 
											}else{
											if($row['tampil_client']==0){ ?>
											<span class="glyphicon glyphicon-remove"></span>
											<?php }?>
											<?php } ?></th>
                                            <td><?php echo $row['nama'] ?></td>
                                            <td><?php echo $row['tgl_tampil'] ?></td>
                                            <td><?php echo $row['tgl_tutup'] ?></td>
											<form action="pengumuman_edit.php" method="POST"><input type="hidden" name="id" value="<?php echo $row['id_pengumuman'] ?>"/>
											<td><input type="submit" class="btn btn-outline btn-success btn-xs" name="submit" value="Edit" /></td></form>
                                        </tr>
<?php $index++; } // mysql_fetch_array

 } //if ?>
									</tbody>

								  </table>               
                                </div>

                                <div class="tab-pane fade" id="block">
                                    <table class="table table-striped table-bordered table-hover">
								  <thead>
                                        <tr>
                                            <th width="1px">No</th>
                                            <th width="50px">Title</th>
                                            <th width="100px">Konten</th>
                                            <th width="30px">Staff</th>
                                            <th width="30px">Client</th>
                                            <th width="30px">Created BY</th>
                                            <th width="100px">Start Date</th>
                                            <th width="100px">End Date</th>
											<th width="50px">Edit</th>
                                        </tr>
                                    </thead>
																		<tbody>
<?php 
	$check=$fungsi->get_pengumuman(0); // fungsi class diagram beda nama field
	if(mysql_num_rows($check)==0){
?>
										<tr>
										<td colspan="9">Data No Match In Database</td>
										</tr>
<?php } else {  $index=1;
	while($row=mysql_fetch_array($check)){
?>
										<tr>
                                            <td><?php echo $index ?></td>
											<td><?php echo $row['judul'] ?></td>
                                            <td><?php echo $row['konten'] ?></td>
                                            <th align="center"><?php if($row['tampil_staff']==1){  ?>
											<span class="glyphicon glyphicon-ok"></span>
											<?php 
											}else{
											if($row['tampil_staff']==0){  ?>
											<span class="glyphicon glyphicon-remove"></span>								
											<?php } ?>
											<?php } ?></th>
                                            <th align="center"><?php if($row['tampil_client']==1){ ?>
											<span class="glyphicon glyphicon-ok"></span>
											<?php 
											}else{
											if($row['tampil_client']==0){ ?>
											<span class="glyphicon glyphicon-remove"></span>
											<?php }?>
											<?php } ?></th>
                                            <td><?php echo $row['nama'] ?></td>
                                            <td><?php echo $row['tgl_tampil'] ?></td>
                                            <td><?php echo $row['tgl_tutup'] ?></td>
											<form action="pengumuman_edit.php" method="POST"><input type="hidden" name="id" value="<?php echo $row['id_pengumuman'] ?>"/>
											<td><input type="submit" class="btn btn-outline btn-success btn-xs" name="submit" value="Edit" /></td></form>
                                        </tr>
<?php $index++; } // mysql_fetch_array

 } //if ?>
									</tbody>

								  </table>               
                                </div>
                                <div class="tab-pane fade in active" id="filter">
								<form method="post" id="sample_form">							
                                    <table>
									<tr>
									<td width="100px"> <label>START DATE</label></td>
									<td width="10px">:</td>
									<td width="250px">
										<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
										<input type="text" class="form-control" name="startdate" value="<?php echo $_POST['startdate'] ?>">
										<span class="add-on"><i class="icon-th"></i></span>
										</div>
									</td>
									<td width="70px"></td>
									<td width="100px"> <label>END DATE</label></td>
									<td width="10px">:</td>
									<td width="250px">
										<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
										<input type="text" class="form-control" name="endate" value="<?php echo $_POST['enddate'] ?>">
										<span class="add-on"><i class="icon-th"></i></span>
										</div>
									</td>
									<td width="50px"></td>
									<td></td>
									</tr>
									<tr height="50px">
									<td> <label>TITLE</label></td>
									<td>:</td>
									<td><input class="form-control" name="title" autofocus value="<?php echo $_POST['title'] ?>"></td>
									<td></td>
									<td> <label>KONTEN</label></td>
									<td>:</td>
									<td><input class="form-control" name="konten" autofocus value="<?php echo $_POST['konten'] ?>"></td>
									<td></td>
									<td>
									<input type="submit" class="btn btn-primary btn-block" name="filter" value="Filter" /> 
									</td>
									</tr>
									<tr height="30px">
									<td> <label>STATUS</label></td>
									<td>:</td>
									<td>
									<select class="form-control" name="status">									
<?php  if($_POST['status']=="1") {
	$slc_st_af="";
	$slc_st_al="selected";
	$slc_st_bl=""; 		
	} else if($_POST['status']=="2") {
	$slc_st_af="selected";
	$slc_st_bl="";
	$slc_st_al="";
	} else if($_POST['status']=="3") {
	$slc_st_af="";
	$slc_st_bl="selected"; 	
	$slc_st_al="";
	} ?>
									<option value="1" <?php echo $slc_st_al ?>>All</option>
									<option value="2" <?php echo $slc_st_af ?>>Aktif</option>
									<option value="3" <?php echo $slc_st_bl ?>>Non Aktif</option>
                                    </select></td>
									<td></td>
									<td><label>TAMPIL PADA</label></td>
									<td>:</td>
									<td><select class="form-control" name="tampil">
<?php  if($_POST['tampil']=="1") {
	$slc_st_af="";
	$slc_st_al="selected";
	$slc_st_bl=""; 		
	$slc_st_na=""; 		
	} else if($_POST['tampil']=="2") {
	$slc_st_af="selected";
	$slc_st_bl="";
	$slc_st_al="";
	$slc_st_na=""; 		
	} else if($_POST['tampil']=="3") {
	$slc_st_af="";
	$slc_st_bl="selected"; 	
	$slc_st_al="";
	$slc_st_na=""; 		
	} else if($_POST['tampil']=="4") {
	$slc_st_af="";
	$slc_st_bl=""; 	
	$slc_st_al="";
	$slc_st_na="selected"; 		
	}?>
									<option value="4" <?php echo $slc_st_na ?>>None</option>
									<option value="1" <?php echo $slc_st_al ?>>All</option>
									<option value="2" <?php echo $slc_st_af ?>>Client</option>
									<option value="3" <?php echo $slc_st_bl ?>>Staff</option>
                                    </select></td>
									</tr>
									<tr height="40px"></tr>
									</table>
								</form>
<?php if ($_POST['filter']){ ?>
					<table class="table table-striped table-bordered table-hover">
								  <thead>
                                        <tr>
                                            <th width="1px">No</th>
                                            <th width="50px">Title</th>
                                            <th width="100px">Konten</th>
                                            <th width="30px">Staff</th>
                                            <th width="30px">Client</th>
                                            <th width="30px">Created BY</th>
                                            <th width="100px">Start Date</th>
                                            <th width="100px">End Date</th>
											<th width="50px">Edit</th>
                                        </tr>
                                    </thead>
																		<tbody>
<?php 
	$title	= $_POST['title'];
	$konten	= $_POST['konten'];
	$status	= $_POST['status'];
	$tampil	= $_POST['tampil'];
	$start_date	= $_POST['startdate'];
	$end_date	= $_POST['enddate'];
	$check=$fungsi->get_pengumuman_filter($title,$konten,$status,$tampil,$start_date,$end_date);
	if(mysql_num_rows($check)==0){
?>
										<tr>
										<td colspan="9">Data No Match In Database</td>
										</tr>
<?php } else {  $index=1;
	while($row=mysql_fetch_array($check)){
?>
										<tr>
                                            <td><?php echo $index ?></td>
											<td><?php echo $row['judul'] ?></td>
                                            <td><?php echo $row['konten'] ?></td>
                                            <td><?php echo $row['tampil_staff'] ?></td>
                                            <td><?php echo $row['tampil_client'] ?></td>
                                            <td><?php echo $row['nama'] ?></td>
                                            <td><?php echo $row['tgl_tampil'] ?></td>
                                            <td><?php echo $row['tgl_tutup'] ?></td>
											<form action="pengumuman_edit.php" method="POST"><input type="hidden" name="id" value="<?php echo $row['id_pengumuman'] ?>"/>
											<td><input type="submit" class="btn btn-outline btn-success btn-xs" name="submit" value="Edit" /></td></form>
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
