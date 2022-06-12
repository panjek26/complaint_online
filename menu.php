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
                    <div class="panel panel-default">
                        <h3 class="page-header">Data Group Menu</h3>
						
                        <div class="panel-body">
                            <!-- Nav tabs -->
						<div class="col-xs-2">
                            <a href="menu_add.php" class="btn btn-primary btn-block">Add Group</a>
						</div>
						<div class="col-xs-8"></div>
					
						<div class="col-xs-2">
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#active" data-toggle="tab">Active</a>
                                </li>
                                <li><a href="#block" data-toggle="tab">Block</a>
                                </li>
                            </ul>
						</div>
						<br/>
						<br/>
						<br/>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="active">
                                  <table class="table table-striped table-bordered table-hover">
								  <thead>
                                        <tr>
                                            <th width="10px">No</th>
                                            <th width="100px">Nama Group</th>
                                            <th width="700px">Daftar Menu</th>
											<th width="30px">Edit</th>
                                        </tr>
                                    </thead>
									<tbody>
<?php 
	$check=$fungsi->get_group(1);
	if(mysql_num_rows($check)==0){
?>
										<tr>
										<td colspan="4">Data No Match In Database</td>
										</tr>
<?php } else {  $index=1;
	while($row=mysql_fetch_array($check)){
?>
										<tr>
                                            <td><?php echo $index ?></td>
											<td><?php echo $row['nama_group'] ?></td>
											<td>
<?php $data_menu=$fungsi->get_group_menu($row['id_group']);
	$tampung="";
	while ($qry_menu=mysql_fetch_array($data_menu)){ 						
	$tampung .= $qry_menu['title'].", ";
 } echo substr($tampung,0,-2); ?>					
											</td>
											<form action="menu_edit.php" method="POST"><input type="hidden" name="id" value="<?php echo $row['id_group'] ?>"/>
											<td><input type="submit" class="btn btn-outline btn-success btn-xs" name="submit" value="Edit" /></td></form>
                                        </tr>
<?php $index++; } // mysql_fetch_array 
 } //if ?>
									</tbody>

								  </table>  
                                </div>
                                <div class="tab-pane fade" id="block">
                                  <table class="table table-striped table-bordered table-hover">
								  <thead>
                                        <tr>
                                            <th width="10px">No</th>
                                            <th width="100px">Nama Group</th>
                                            <th width="700px">Daftar Menu</th>
											<th width="30px">Edit</th>
                                        </tr>
                                    </thead>
									<tbody>
<?php 
	$check=$fungsi->get_group(0);
	if(mysql_num_rows($check)==0){
?>
										<tr>
										<td colspan="4">Data No Match In Database</td>
										</tr>
<?php } else {  $index=1;
	while($row=mysql_fetch_array($check)){
?>
										<tr>
                                            <td><?php echo $index ?></td>
											<td><?php echo $row['nama_group'] ?></td>
											<td>
<?php $data_menu=$fungsi->get_group_menu($row['id_group']); // fungsi class diagram beda nama field
	$tampung="";
	while ($qry_menu=mysql_fetch_array($data_menu)){ 						
	$tampung .= $qry_menu['title'].", ";
 } echo substr($tampung,0,-2); ?>					
											</td>
											<form action="menu_edit.php" method="POST"><input type="hidden" name="id" value="<?php echo $row['id_group'] ?>"/>
											<td><input type="submit" class="btn btn-outline btn-success btn-xs" name="submit" value="Edit" /></td></form>
                                        </tr>
<?php $index++; } // mysql_fetch_array 
 } //if ?>
									</tbody>

								  </table>          
                                </div>
                                
                            </div>
                        </div>
                        <!-- /.panel-body -->
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
