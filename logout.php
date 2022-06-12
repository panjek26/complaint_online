<?php
session_start();

include ('db.php');
include ('function.php');

$fungsi= new Fungsi();

$tgl=date('Y-m-d H:i:s');
$data=$fungsi->get_last_login($_SESSION['nik']);
$qry=mysql_fetch_array($data);

$fungsi->upd_logout($qry['nik'],$qry['tgl_masuk'],$tgl);

session_destroy();
 
header("Location:index.php");
?>