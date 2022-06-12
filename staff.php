<!DOCTYPE html>
<html lang="en">

<?php 
$init='MSD';
$sub_init='SMSD';
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
                        <h3 class="page-header">Data Staff</h3>
						
                        <div class="panel-body">
                            <!-- Nav tabs -->
						<div class="col-xs-2">
                            <a href="staff_add.php" class="btn btn-primary btn-block">Tambah Staff</a>
						</div>
						<div class="col-xs-6"></div>
					
						<div class="col-xs-4">
                            <ul class="nav nav-pills">
                                <li><a href="#active" data-toggle="tab">Active</a>
                                </li>
                                <li><a href="#pending" data-toggle="tab">Pending</a>
                                </li>
                                <li><a href="#block" data-toggle="tab">Block</a>
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
                                  <table class="table table-striped table-bordered table-hover">
								  <thead>
                                        <tr>
                                            <th width="1px">No</th>
                                            <th width="50px">Nik</th>
                                            <th width="100px">Nama</th>
                                            <th width="30px">Department</th>
											<th width="30px">NO HP</th>
                                            <th width="30px">Level</th>
                                            <th width="30px">Group</th>
                                            <th width="100px">Tgl_create</th>
                                            <th width="100px">Last_login</th>
											<th width="30px">Edit</th>
                                        </tr>
                                    </thead>
									<tbody>
<?php 
	$check=$fungsi->get_staff(1);
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
											<td><?php echo $row['nik'] ?></td>
                                            <td><?php echo $row['nama'] ?></td>
                                            <td><?php echo $row['nama_dept'] ?></td>
											<td><?php echo $row['no_telp'] ?></td>
                                            <td><?php echo $row['level_ganti'] ?></td>
                                            <td><?php echo $row['nama_group'] ?></td>
                                            <td><?php echo $row['tgl_buat'] ?></td>
                                            <td><?php echo $row['last'] ?></td>
											<form action="staff_edit.php" method="POST"><input type="hidden" name="id" value="<?php echo $row['nik'] ?>"/>
											<td><input type="submit" class="btn btn-outline btn-success btn-xs" name="submit" value="Edit" /></td></form>
                                        </tr>
<?php $index++; } // mysql_fetch_array 
 } //if ?>
									</tbody>

								  </table>               
                                </div>
                                <div class="tab-pane fade" id="pending">
                                    <table class="table table-striped table-bordered table-hover">
								  <thead>
                                        <tr>
                                            <th width="1px">No</th>
                                            <th width="50px">Nik</th>
                                            <th width="100px">Nama</th>
                                            <th width="30px">Department</th>
                                            <th width="30px">Level</th>
                                            <th width="30px">Group</th>
                                            <th width="100px">Tgl_create</th>
                                            <th width="100px">Last_login</th>
											<th width="50px">Edit</th>
                                        </tr>
                                    </thead>
									<tbody>
<?php 
	$check=$fungsi->get_staff(0);
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
											<td><?php echo $row['nik'] ?></td>
                                            <td><?php echo $row['nama'] ?></td>
                                            <td><?php echo $row['nama_dept'] ?></td>
                                            <td><?php echo $row['level_ganti'] ?></td>
                                            <td><?php echo $row['nama_group'] ?></td>
                                            <td><?php echo $row['tgl_buat'] ?></td>
                                            <td><?php echo $row['last'] ?></td>
											<form action="staff_edit.php" method="POST"><input type="hidden" name="id" value="<?php echo $row['nik'] ?>"/>
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
                                            <th width="50px">Nik</th>
                                            <th width="100px">Nama</th>
                                            <th width="30px">Department</th>
                                            <th width="30px">Level</th>
                                            <th width="30px">Group</th>
                                            <th width="100px">Tgl_create</th>
                                            <th width="100px">Last_login</th>
											<th width="50px">Edit</th>
                                        </tr>
                                    </thead>
									<tbody>
<?php 
	$check=$fungsi->get_staff(2);
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
											<td><?php echo $row['nik'] ?></td>
                                            <td><?php echo $row['nama'] ?></td>
                                            <td><?php echo $row['nama_dept'] ?></td>
                                            <td><?php echo $row['level_ganti'] ?></td>
                                            <td><?php echo $row['nama_group'] ?></td>
                                            <td><?php echo $row['tgl_buat'] ?></td>
                                            <td><?php echo $row['last'] ?></td>
											<form action="staff_edit.php" method="POST"><input type="hidden" name="id" value="<?php echo $row['nik'] ?>"/>
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
									<td width="100px"> <label>NIK</label></td>
									<td width="10px">:</td>
									<td width="250px"><input class="form-control" name="nik" value="<?php echo $_POST['nik'] ?>"></td>
									<td width="70px"></td>
									<td width="100px"> <label>NAMA</label></td>
									<td width="10px">:</td>
									<td width="250px"><input class="form-control" name="nama" value="<?php echo $_POST['nama'] ?>"></td>
									<td width="50px"></td>
									<td></td>
									</tr>
									<tr height="50px">
									<td> <label>LEVEL</label></td>
									<td>:</td>
									<td>
									<select class="form-control" name="level">
									<option value=""></option>
<?php if($_POST['level']=="Client") { 
	$slc_lvl_clnt="selected";
	$slc_lvl_stf=""; 
	} else if($_POST['level']=="Staff") {
	$slc_lvl_clnt="";
	$slc_lvl_stf="selected"; 		
	} ?>
									<option value="Client" <?php echo $slc_lvl_clnt ?>>Client</option>
									<option value="Staff" <?php echo $slc_lvl_stf ?>>Staff</option>
                                    </select></td>
									<td></td>
									<td> <label>STATUS</label></td>
									<td>:</td>
									<td>
									<select class="form-control" name="status">
									<option value=""></option>
<?php if($_POST['status']=="0") { ?>
									<option value="0" selected>Pending</option>
<?php } else if($_POST['status']=="1") {
	$slc_st_af="selected";
	$slc_st_bl=""; 		
	} else if($_POST['status']=="2") {
	$slc_st_af="";
	$slc_st_bl="selected"; 		
	} ?>
									<option value="1" <?php echo $slc_st_af ?>>Aktif</option>
									<option value="2" <?php echo $slc_st_bl ?>>Block</option>
                                    </select></td>
									<td></td>
									<td>
									<input type="submit" class="btn btn-primary btn-block" name="filter" value="Filter" /> 
									</td>
									</tr>
									<tr height="30px">
									<td> <label>DEPARTMENT</label></td>
									<td>:</td>
									<td>
									<select class="form-control" name="department">
									<option value=""></option>
<?php
$fungsi= new Fungsi();
$result=$fungsi->get_department(1);
while($dpt=mysql_fetch_array($result)){
	if($_POST['id_dept']==$dpt['id_dept']){
		$slc_dept="selected";
	} else {
		$slc_dept="";
	}
?>
                                        <option value="<?php echo $dpt['id_dept'] ?>" <?php echo $slc_dept ?>><?php echo $dpt['nama_dept'] ?></option>
<?php } ?>
                                    </select></td>
									<td></td>
									<td> <label>GROUP MENU</label></td>
									<td>:</td>
									<td>
									<select class="form-control" name="group_menu">
									<option value=""></option>
<?php
$result=$fungsi->get_group(1);
while($grp=mysql_fetch_array($result)){
	if($_POST['id_group']==$grp['id_group']){
		$slc_gm="selected";
	} else {
		$slc_gm="";
	}
?>
                                        <option value="<?php echo $grp['id_group'] ?>" <?php echo $slc_gm ?>><?php echo $grp['nama_group'] ?></option>
<?php } ?>
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
                                            <th width="50px">Nik</th>
                                            <th width="100px">Nama</th>
                                            <th width="30px">Department</th>
											<th width="30px">No HP</th>
                                            <th width="30px">Level</th>
                                            <th width="30px">Group</th>
                                            <th width="100px">Tgl_create</th>
                                            <th width="100px">Last_login</th>
											<th width="50px">Edit</th>
                                        </tr>
                                    </thead>
																		<tbody>
<?php 
	$nik	= $_POST['nik'];
	$nama	= $_POST['nama'];
	$status	= $_POST['status'];
	$level	= $_POST['level'];
	$dpt	= $_POST['department'];
	$menu	= $_POST['group_menu'];
	$check=$fungsi->get_staff_filter($nik,$nama,$status,$level,$dpt,$menu);
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
											<td><?php echo $row['nik'] ?></td>
                                            <td><?php echo $row['nama'] ?></td>
                                            <td><?php echo $row['nama_dept'] ?></td>
											  <td><?php echo $row['no_telp'] ?></td>
                                            <td><?php echo $row['level'] ?></td>
                                            <td><?php echo $row['nama_group'] ?></td>
                                            <td><?php echo $row['tgl_buat'] ?></td>
                                            <td><?php echo $row['last'] ?></td>
											<form action="staff_edit.php" method="POST"><input type="hidden" name="id" value="<?php echo $row['nik'] ?>"/>
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

</body>

</html>
