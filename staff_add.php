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
                    <div class="col-xs-12">
                        <h3 class="page-header">Staff >> Tambah Staff</h3>
                    </div>
                    <!-- /.col-lg-12 -->
					 <div class="col-xs-12">
					<div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
									 <label>NIK</label>
									<input class="form-control" maxlength="10" required name="nik" autofocus pattern="^[0-9]{10}$">
                                </div>
                                <div class="form-group">
									 <label>NAMA</label>
									<input class="form-control" required name="nama">
                                </div>
								<div class="form-group">
                                    <label>PASSWORD</label>
                                    <input class="form-control" required minlength="6" name="password" type="password">
                                </div>
								<div class="form-group">
                                    <label>DEPARTMENT</label>
									<select class="form-control" required name="department">
<?php
$fungsi= new Fungsi();
$result=$fungsi->get_department(1);
while($dpt=mysql_fetch_array($result)){
?>
                                        <option value="<?php echo $dpt['id_dept'] ?>"><?php echo $dpt['nama_dept'] ?></option>
<?php } ?>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label>LEVEL</label>
									<select class="form-control" required name="level">
									<option value="Client">Toko</option>
									<option value="Staff">Staff</option>
									<option value="SPV">SPV</option>
									<option value="MGR">MGR</option>
									
                                    </select>
                                </div>
								<div class="form-group">
                                    <label>GROUP MENU</label>
									<select class="form-control" required name="group_menu">
<?php
$result=$fungsi->get_group(1);
while($grp=mysql_fetch_array($result)){
?>
                                        <option value="<?php echo $grp['id_group'] ?>"><?php echo $grp['nama_group'] ?></option>
<?php } ?>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label>NO HP</label>
                                    <input class="form-control" maxlength="12" pattern="^[0-9]{12}$" required name="hp">
                                </div>
								<div class="form-group">
                                    <label>EMAIL</label>
                                    <input class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required name="email">
                                </div>
								<div class="col-md-2">
                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Add Staff"/>
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
if($_POST['submit']=="Add Staff"){
	$nik	=$_POST['nik'];
	$nama	=$_POST['nama'];
	$pass	=base64_encode($_POST['password']);
	$dpt	=$_POST['department'];
	$hp		=$_POST['hp'];
	$email	=$_POST['email'];
	$tgl	=date('Y-m-d H:i:s');
	$level	=$_POST['level'];
	$menu	=$_POST['group_menu'];
	$active	=1;
	$check_email=$fungsi->cek_email($email);
	if(mysql_num_rows($check_email)<1){
	$insert	=$fungsi->ins_regis($nik, $nama, $pass, $level, $dpt, $hp, $email, $menu, $tgl, $active);	
		
		if($insert){
		echo "<script>alert('DATA SUDAH DI MASUKAN KE DALAM DATABASE'); location.href='staff.php'</script>";
		}else{
			echo "<script>alert('TERJADI KESALAHAN DATA'); history.back()</script>";
		}
	} else {
		echo "<script>alert('EMAIL SUDAH TERDAFTAR SEBELUMNYA'); history.back()</script>";
	}
}

?>