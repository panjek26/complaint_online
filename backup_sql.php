<!DOCTYPE html>
<html lang="en">

<?php 
$init='ULT';
$sub_init='BULT';
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
                        <h3 class="page-header">Backup Data Sql</h3>
						
                        <div class="panel-body">
                            <!-- Nav tabs -->
						<div class="col-xs-2">
						<form action="sql.php" method="POST">
                            <input type="submit" name="backup" class="btn btn-primary btn-block" value="Backup Data" />
						</form>
						</div>
						</div>
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


