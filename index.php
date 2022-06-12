<!DOCTYPE html>
<html lang="en">

<?php include ('header.php'); ?>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="autentifikasi.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" required placeholder="NIK" name="nik" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required placeholder="Password" name="password" minlength="6" type="password" value="">
                                </div>
								 <div class="checkbox">
                                 <label>  <a href="fg_pass.php">Forgot Password</a></label>
                                </div>
								<div class="col-md-6">
                                <input type="submit" class="btn btn-primary btn-block" name="login" value="Login">
								</div>
								<div class="col-md-6">
                                <a href="register.php" class="btn btn-primary btn-block">Register</a>
								</div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
