<!DOCTYPE html>
<html lang="en">
<?php 
$init='DSB';
$sub_init='DSB';
include ('header.php'); 
include ('session.php');
include('db.php');
$fungsi= new Fungsi();
$stat=$fungsi->status_complaint($_SESSION['level'],$_SESSION['nik']);
$ttl_cmpl=mysql_fetch_array($stat);
if ($ttl_cmpl['opened']==0) {
$link_op="";
}else {
$link_op="complaint_st.php";
}

if ($ttl_cmpl['ass']==0) {
$link_ass="";
}else {
$link_ass="complaint_st.php";
}

if ($ttl_cmpl['wk']==0) {
$link_wk="";
}else {
$link_wk="complaint_st.php";
}

if ($ttl_cmpl['pdn']==0) {
$link_pdn="";
}else {
$link_pdn="complaint_st.php";
}

if ($ttl_cmpl['fs']==0) {
$link_fs="";
}else {
$link_fs="complaint_st.php";
}

?>
<?php
$url=$_SERVER['http://localhost/complaint/home.php'];
header("Refresh: 55; URL=$url"); 
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
<?php $pgmn=$fungsi->get_pengumuman_dsb($_SESSION['level']) ?>
                        <div class="panel-body">
<?php while ($pgn=mysql_fetch_array($pgmn)){ ?>
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <a href="pengumuman_dtl.php?id=<?php echo base64_encode($pgn['id_pengumuman']) ?>" class="alert-link"><?php echo $pgn['judul'] ?></a>.
                            </div>
<?php } ?>
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>				
<br/>				
<?php if($_SESSION['level']=='Admin' or $_SESSION['level']=='SPV' or $_SESSION['level']=='MGR'){ ?>
				  <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo number_format($ttl_cmpl['opened']) ?></div>
                                    <div>New Complaint</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo $link_op ?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
<?php } ?>
<?php if($_SESSION['level']=='Admin' or $_SESSION['level']=='SPV' or $_SESSION['level']=='MGR' or $_SESSION['level']=='Staff' or $_SESSION['level']=='Client'){ ?>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo number_format($ttl_cmpl['ass']) ?></div>
                                    <div>Assignment</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo $link_ass ?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-clock-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo number_format($ttl_cmpl['wk']) ?></div>
                                    <div>Working</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo $link_wk ?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-pause fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo number_format($ttl_cmpl['pdn']) ?></div>
                                    <div>Pending</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo $link_pdn ?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
<?php } ?>
<?php if($_SESSION['level']=='Admin' or $_SESSION['level']=='SPV' or $_SESSION['level']=='MGR' or $_SESSION['level']=='Client' or $_SESSION['level']=='Staff'){ ?>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo number_format($ttl_cmpl['fs']) ?></div>
                                    <div>Finished</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo $link_fs ?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
<?php } ?>				
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
