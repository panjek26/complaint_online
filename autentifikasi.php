<?php
include ('db.php');
include ('function.php');

$fungsi= new Fungsi();

session_start();

if($_POST['login']){
	$nik	=$_POST['nik'];
	$pass	=base64_encode($_POST['password']);

	$data=$fungsi->cek_user($nik,$pass);
	$check=mysql_num_rows($data);
	
	if($check==1){
		$r_user=mysql_fetch_array($data);
		$_SESSION['nik']=$r_user['nik'];
		$_SESSION['nama']=$r_user['nama'];
		$_SESSION['level']=$r_user['level'];
		$_SESSION['department']=$r_user['department'];
		$_SESSION['group']=$r_user['id_group'];
		$tgl=date('Y-m-d H:i:s');
		$fungsi->ins_log_login($r_user['nik'],$tgl);
		$data_menus=$fungsi->_menu($r_user['id_group']);
		$ar_menu=array();
		while($q_menus=mysql_fetch_array($data_menus)){
			$ar_menu[]=$q_menus['sub_init'];
		}
		$_SESSION['menu']=$ar_menu;
		
		echo "<script>location.href='home.php'</script>";
		
	} else {
		echo "<script>alert('User tidak ada atau belum di Approve oleh ADMIN'); history.back()</script>";
	}
}


?>