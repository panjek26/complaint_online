<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_STRICT));
date_default_timezone_set('Asia/Jakarta');
@mysql_connect("localhost","root","");
mysql_select_db("cmpl");$ip=$_SERVER['REMOTE_ADDR'];
?>