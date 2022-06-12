<!DOCTYPE html>
<html lang="en">
<?php include ('header.php'); 
$fungsi = new Fungsi();
?>
<body>

    <div class="container">
        <div class="row">
			<div class="col-md-3">
			</div>
            <div class="col-md-6">
			<br/><br/>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Forgot Password</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
									<label>NIK</label>
                                    <input class="form-control" required name="nik">
                                </div>
								<div class="form-group">
                                    <label>EMAIL</label>
                                    <input class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required name="email">
                                </div>
								<div class="col-md-3">
                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Check" />
								</div>
								<div class="col-md-3"></div>
								<div class="col-md-3"></div>
								<div class="col-md-3">
                                <a href="index.php" class="btn btn-primary btn-block">Back</a>
								</div>
                            </fieldset>
                        </form>
                    </div>
<?php
if($_POST['submit']=="Check"){
	$nik	=$_POST['nik'];
	$email	=$_POST['email'];
	$data	=$fungsi->fg_pass($nik, $email);	
	$check	=mysql_num_rows($data);	
	if($check==1){
		$qry=mysql_fetch_array($data);
		$valid="Your Password : ". base64_decode($qry['password']);
	}else{
		$valid="No Found Your NIK or Email in Database";
	}
?>
					<div class="panel-body">
						<div class="col-md-12">
                            <fieldset>
                             <center><h4><?php echo $valid ?></h4></center>
                            </fieldset>
						</div>
                    </div>
<?php 	} ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

