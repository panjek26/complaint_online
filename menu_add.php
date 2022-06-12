<!DOCTYPE html>
<html lang="en">

<?php
$init='MSD';
$sub_init='MMSD';
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
                        <h3 class="page-header">Group Menu >> Tambah Group Menu</h3>
                    </div>
                    <!-- /.col-lg-12 -->
					 <div class="col-xs-12">
					<div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
									 <label>Nama Group Menu</label>
									<input class="form-control" required name="gr_menu" autofocus>
                                </div>
								<div class="form-group">
                                <h3>Daftar Menu</h3>
<?php
$dft=$fungsi->get_dft_menu();
while($row=mysql_fetch_array($dft)){ 
if($row['tipe']=='H'){ ?>
									<h4><?php echo $row['title'] ?></h4>
<?php } else if($row['tipe']=='A') { ?>
									<div class="checkbox">
                                        <h4><?php echo $row['title'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="menu[]" value="<?php echo $row['id'] ?>"></h4>
                                    </div>
<?php } else { ?>
									<div class="checkbox">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="checkbox" name="menu[]" value="<?php echo $row['id'] ?>"><?php echo $row['title'] ?></label>
                                    </div>

<?php } } ?>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
									<select class="form-control" required name="status">
									<option value="1">Aktif</option>
									<option value="0">Block</option>
                                    </select>
                                </div>
								
								<div class="col-md-2">
                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Add Group Menu" />
								</div>
								<div class="col-md-3"></div>
								<div class="col-md-2">
                                <a href="department.php" class="btn btn-primary btn-block">Back</a>
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
if($_POST['submit']=="Add Group Menu"){
	$gr_menu	= $_POST['gr_menu'];
	$menu		= $_POST['menu'];
	$status 	= $_POST['status'];
	$ttl_menu	= count($menu);
	$check		= $fungsi->check_group($gr_menu);

	if (mysql_num_rows($check)==0){
	$insert	=$fungsi->ins_group($gr_menu, $status);	
	if($insert){
	$check		= $fungsi->check_group($gr_menu);
	$gid		= mysql_fetch_array($check);
	$tampung	= "";
		
	for($mn=0;$mn<$ttl_menu;$mn++){
		$fungsi->ins_group_menu($gid['id_group'],$menu[$mn]);
		$tampung	.= $menu[$mn].",";
	} 
		$hsl	= $tampung.'1';
		$header	= $fungsi->get_header_menu($hsl);
		while ($qry=mysql_fetch_array($header)){
		$fungsi->ins_group_menu($gid['id_group'],$qry['id']);
		}
	echo "<script>alert('DATA SUDAH DI MASUKAN KE DALAM DATABASE'); location.href='menu.php'</script>";

	}else{
		echo "<script>alert('TERJADI KESALAHAN DATA'); history.back()</script>";
	}
	} else {
		echo "<script>alert('NAMA GROUP SUDAH ADA'); history.back()</script>";
	}
	
	
}

?>