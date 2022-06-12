<ul class="nav" id="side-menu">
<?php 
$id_group=$_SESSION['group'];
$menu=$fungsi->get_menu1($id_group);
while($row=mysql_fetch_array($menu)){ 
if($init==$row['initial']){
 $active=" class='active' ";
} else {
 $active="";
}
if($row['tipe']=='H'){
	$arrow=" <span class='fa arrow'></span>";
	$nav_second="<ul class='nav nav-second-level'>";
	$menu2=$fungsi->get_menu2($row['initial'],$id_group);
	while($row_nd=mysql_fetch_array($menu2)){
		if($sub_init==$row_nd['sub_init']){
		 $active2=" class='active' ";
	} else {
		 $active2="";
	}
		$nav_second.="<li><a href='".$row_nd['link']."' ".$active2.">".$row_nd['title']."</a></li>";
	}            
    $nav_second.="</ul>";
} else {
	$arrow="";
	$nav_second="";
}

?>
	<li <?php echo $active ?>>
		<a href="<?php echo $row['link'] ?>" <?php echo $active ?>><i class="<?php echo $row['class'] ?>"></i> <?php echo $row['title'].$arrow ?></a><?php echo $nav_second ?>
	</li>
<?php } ?>
</ul>