<?php 
session_start();// mengecek ada tidaknya session untuk username
if ($_SESSION['nik']){
	if(in_array($sub_init,$_SESSION['menu'])){
		
	} else {
		//session_destroy();	
		echo "<script>history.back()</script>";	
		exit;
	}
	
}else {
	session_destroy();	
		echo "<script>location.href='index.php'</script>";	
		exit;}
?>