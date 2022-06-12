<?php 
if($_POST['backup']=='Backup Data'){
$filename='sql/db_complaint_'.date('ymd').'.sql';
  
$result=exec('c:/xampp/mysql/bin/mysqldump cmpl -hlocalhost -uroot >'.$filename,$output);

     header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");
	
    readfile($filename);
   // readfile($filename); // ini buat nampilin pop-up download di browser
    exit;
}
?>