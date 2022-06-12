<!DOCTYPE html>
<html lang="en">

<?php 
$init='DSB';
$sub_init='DSB';
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
				<br/>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Change Password
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<form method="post" id="sample_form">							
                                    <table>
									<tr>
									<td width="200px"> <label>PASSWORD LAMA</label></td>
									<td width="10px">:</td>
									<td width="250px"> <input class="form-control" required name="pass_lama" type="password"></td>
									<td width="70px"></td>
									<td width="100px"></td>
									<td width="10px"></td>
									<td width="250px"></td>
									<td width="50px"></td>
									<td></td>
									</tr>
									<tr height="50px">
									<td> <label>PASSWORD BARU</label></td>
									<td>:</td>
									<td> <input class="form-control" required minlength="6" name="pass_baru" type="password"></td>
									<td></td>
									<td width="100px"><input type="submit" class="btn btn-primary btn-block" name="change" value="Change" /></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									</tr>
									<tr height="30px">
									<td> <label>RETYPE PASSWORD</label></td>
									<td>:</td>
									<td> <input class="form-control" required minlength="6" name="re_pass" type="password"></td>
									<td></td>
									<td width="100px"></td>
									<td></td>
									<td> </td>
									<td></td>
									<td></td>
									</tr>
									
									<tr height="40px"></tr>
									</table>
							
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
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
if($_POST['change']){
	$pass_lama	= base64_encode($_POST['pass_lama']);
	$pass_baru	= base64_encode($_POST['pass_baru']);
	$re_pass	= base64_encode($_POST['re_pass']);
	
$cek_data=$fungsi->_user($_SESSION['nik']);
$q_data=mysql_fetch_array($cek_data);

if($pass_lama==$q_data['password'] && $pass_baru==$re_pass){
	$fungsi->change_pass($_SESSION['nik'],$pass_baru);
	echo "<script>alert('PASSWORD TELAH BERHASIL DI RUBAH'); location.href='home.php'</script>";
} else {
	echo "<script>alert('PASSWORD NOT MATCH'); history.back()</script>";
}
	
}


?>
