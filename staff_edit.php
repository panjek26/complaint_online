<!DOCTYPE html>
<html lang="en">

<?php 
$init='MSD';
$sub_init='SMSD';
include ('header.php'); 
include ('session.php');
$fungsi= new Fungsi();
$id=$_POST['id'];
$query=$fungsi->staff($id);
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
                    <div class="col-xs-12">
                        <h3 class="page-header">Staff >> Edit Staff</h3>
                    </div>
                    <!-- /.col-lg-12 -->
					 <div class="col-xs-12">
					<div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
									 <label>NAMA</label>
									<input class="form-control" required name="nama" autofocus value="<?php echo $qry['nama'] ?>">
									<input type="hidden" name="nik" value="<?php echo $qry['nik'] ?>">
                                </div>
								<div class="form-group">
                                    <label>PASSWORD</label>
                                    <input class="form-control" required name="password" type="password" value="<?php echo base64_decode($qry['password']) ?>">
                                </div>
								<div class="form-group">
                                    <label>DEPARTMENT</label>
									<select class="form-control" required name="department">
<?php
$fungsi= new Fungsi();
$result=$fungsi->get_department(1);
while($dpt=mysql_fetch_array($result)){
	if($qry['id_dept']==$dpt['id_dept']){
		$slc_dept="selected";
	} else {
		$slc_dept="";
	}
?>
                                        <option value="<?php echo $dpt['id_dept'] ?>" <?php echo $slc_dept ?>><?php echo $dpt['nama_dept'] ?></option>
<?php } ?>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label>LEVEL</label>
									<select class="form-control" required name="level">
<?php	$slc_lvl_clnt=""; $slc_lvl_stf=""; $slc_lvl_spv=""; $slc_lvl_mgr=""; $slc_lvl_adm="";
		
 if($qry['level']=="Client") { 
	$slc_lvl_clnt="selected";
	} else if($qry['level']=="Staff") {
	$slc_lvl_stf="selected"; 		
	} else if($qry['level']=="SPV") {
	$slc_lvl_spv="selected"; 		
	} else if($qry['level']=="MGR") {
	$slc_lvl_mgr="selected"; 		
	} else if($qry['level']=="Admin") {
	$slc_lvl_adm="selected"; 		?>
									<option value="Admin" <?php echo $slc_lvl_adm ?>>Admin</option>
<?php	}?>
									<option value="Client" <?php echo $slc_lvl_clnt ?>>Toko</option>
									<option value="Staff" <?php echo $slc_lvl_stf ?>>Staff</option>
									<option value="SPV" <?php echo $slc_lvl_spv ?>>SPV</option>
									<option value="MGR" <?php echo $slc_lvl_mgr ?>>MGR</option>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label>GROUP MENU</label>
									<select class="form-control" required name="group_menu">
<?php
$result=$fungsi->get_group(1);
while($grp=mysql_fetch_array($result)){
	if($qry['id_group']==$grp['id_group']){
		$slc_gm="selected";
	} else {
		$slc_gm="";
	}
?>
                                        <option value="<?php echo $grp['id_group'] ?>" <?php echo $slc_gm ?>><?php echo $grp['nama_group'] ?></option>
<?php } ?>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label>NO HP</label>
                                    <input class="form-control" maxlength="12" pattern="^[0-9]{7,12}$" required name="hp" value="<?php echo $qry['no_telp'] ?>">
                                </div>
								<div class="form-group">
                                    <label>EMAIL</label>
                                    <input class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required name="email" value="<?php echo $qry['email'] ?>">
                                </div>
								<div class="form-group">
                                    <label>Status</label>
									<select class="form-control" required name="status">
<?php if($qry['status']=="0") { ?>
									<option value="0" selected>Pending</option>
<?php } else if($qry['status']=="1") {
	$slc_st_af="selected";
	$slc_st_bl=""; 		
	} else if($qry['status']=="2") {
	$slc_st_af="";
	$slc_st_bl="selected"; 		
	} ?>
									<option value="1" <?php echo $slc_st_af ?>>Aktif</option>
									<option value="2" <?php echo $slc_st_bl ?>>Block</option>
                                    </select>
                                </div>
								<div class="col-md-2">
                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Edit Staff" />
								</div>
								<div class="col-md-3"></div>
								<div class="col-md-2">
                                <a href="staff.php" class="btn btn-primary btn-block">Back</a>
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
if($_POST['submit']=="Edit Staff"){
	$nik	=$_POST['nik'];
	$nama	=$_POST['nama'];
	$pass	=base64_encode($_POST['password']);
	$dpt	=$_POST['department'];
	$hp		=$_POST['hp'];
	$email	=$_POST['email'];
	$level	=$_POST['level'];
	$menu	=$_POST['group_menu'];
	$active	=$_POST['status'];
	$update	=$fungsi->upd_staff($nik, $nama, $pass, $level, $dpt, $hp, $email, $menu, $active);	
		
	if($update){
	echo "<script>alert('DATA SUDAH DI UBAH DI DALAM DATABASE'); location.href='staff.php'</script>";
	}else{
		//echo $fungsi->upd_staff1($nik, $nama, $pass, $level, $dpt, $hp, $email, $menu, $active);	
		echo "<script>alert('TERJADI KESALAHAN DATA'); location.href='staff.php'</script>";
	}
	
}

?>