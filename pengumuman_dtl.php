<!DOCTYPE html>
<html lang="en">

<?php 
$init='DSB';
$sub_init='DSB';
include ('header.php'); 
include ('session.php');
$fungsi= new Fungsi();
$id=base64_decode($_GET['id']);
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
                            Pengumuman
                        </div>
                        <!-- /.panel-heading -->
<?php $pgmn=$fungsi->get_pengumuman_dsb($_SESSION['level'],$id);
$r_pgn=mysql_fetch_array($pgmn);
 ?>
                        <div class="panel-body">
							<pre  class="text-primary"><h4><?php echo $r_pgn['judul'] ?></h4></pre>
							 <blockquote>
                                <pre><?php echo $r_pgn['konten'] ?></pre>
                                <small class="text-success">Created By : 
                                    <cite title="Source Title" class="text-success"><?php echo $r_pgn['nama'] ?></cite>
                                </small>
								<?php 
								      $source = $r_pgn['tgl_tampil'];
								      $sourcee = $r_pgn['tgl_tutup'] ;
$date = new DateTime($source); 
$datee = new DateTime($sourcee);?>
								 <small class="text-success">Tampil :
                                    <cite title="Source Title" class="text-success"><?php echo $date->format('d-m-Y');?> S/D <?php echo $datee->format('d-m-Y');?> </cite>
                                </small>
                            </blockquote>
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
