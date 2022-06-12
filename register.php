<!DOCTYPE html>
<html lang="en">
<?php include ('header.php'); ?>
<body>

    <div class="container">
        <div class="row">
			<div class="col-md-3">
			</div>
            <div class="col-md-6">
			<br/><br/>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Register</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
									<label>NIK</label>
                                    <input class="form-control" maxlength="10" required name="nik" pattern="^[0-9]{10}$">
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
                                    <label>TOKO</label>
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
                                    <label>NO HP</label>
                                    <input class="form-control" maxlength="12" pattern="^[0-9]{12}$" required name="hp">
                                </div>
								<div class="form-group">
                                    <label>EMAIL</label>
                                    <input class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required name="email">
                                </div>
								<div class="col-md-3">
                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Register" />
								</div>
								<div class="col-md-3"></div>
								<div class="col-md-3"></div>
								<div class="col-md-3">
                                <a href="index.php" class="btn btn-primary btn-block">Back</a>
								</div>
                            </fieldset>
                        </form>
                    </div>  <!-- panel body -->
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php
if($_POST['submit']=="Register"){
	$nik	=$_POST['nik'];
	$nama	=$_POST['nama'];
	$pass	=base64_encode($_POST['password']);
	$dpt	=$_POST['department'];
	$hp		=$_POST['hp'];
	$email	=$_POST['email'];
	$tgl	=date('Y-m-d H:i:s');
	$level	='Client';
	$menu	='11';
	$active	=0;
	$check_email=$fungsi->cek_email($email);
	if(mysql_num_rows($check_email)<1){
	$insert	=$fungsi->ins_regis($nik, $nama, $pass, $level, $dpt, $hp, $email, $menu, $tgl, $active);	
		
		if($insert){
		echo "<script>alert('Pendaftaran Berhasil, Untuk Login Silahkan Tunggu Aprove Dari Admin'); location.href='index.php'</script>";
		}else{
			echo "<script>alert('TERJADI KESALAHAN DATA'); history.back()</script>";
		}
	} else {
		echo "<script>alert('EMAIL SUDAH TERDAFTAR SEBELUMNYA'); history.back()</script>";
	}
	
}
?>
