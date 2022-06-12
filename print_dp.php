<?php
ini_set('memory_limit', '1024M');
ini_set('max_execution_time', 3000000);

if($_POST['pdf']){

require('fpdf/mc_table.php');
include "db.php";
include "function.php";
session_start();
	
	$fungsi= new Fungsi();
	$start_date	= $_POST['startdate'];
	$end_date	= $_POST['enddate'];
	$check=$fungsi->get_lap_dept($start_date,$end_date);


$dir = 'file/';
foreach(glob($dir.'*.*') as $v){
    unlink($v);
	echo $v."<br/>";
}
	
 
$pdf=new PDF_MC_Table();
$pdf->AddPage('L','A4');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(275,5,'LAPORAN COMPLAINT TOKO','','','C');
$pdf->Ln();
$pdf->Cell(275,5,'PT ALBANI CORONA LESTARI','','','C');
$pdf->Ln();
$pdf->Cell(275,5,"PERTANGGAL : $start_date s/d $end_date",'','','C');
$pdf->Ln();$pdf->Ln();
$pdf->SetFont('Arial','',8);

$pdf->Cell(55,10,'Toko',1,'','C');
		$month = strtotime($start_date);
		while($month < strtotime($end_date)) {
$pdf->Cell(18,5,$fungsi->fm(date('m-Y', $month)),1,'','C');
		$month = strtotime("+1 month", $month);	}
$pdf->Ln();
$pdf->Cell(55,5);
		$month = strtotime($start_date);
		while($month < strtotime($end_date)) {
$pdf->Cell(6,5,'Ttl',1,'','C');
$pdf->Cell(6,5,'Cl',1,'','C');
$pdf->Cell(6,5,'Sla',1,'','C');
		$month = strtotime("+1 month", $month);	}
$pdf->Ln();
$loop=1;
while($row=mysql_fetch_array($check)){
$pdf->Cell(55,5,$row['nama_dept'],1,'','L');
		$month = strtotime($start_date);
		while($month < strtotime($end_date)) {
$pdf->Cell(6,5,$row['ttl'.date('ym', $month)],1,'','C');
$pdf->Cell(6,5,$row['close'.date('ym', $month)],1,'','C');
$pdf->Cell(6,5,$row['sla'.date('ym', $month)],1,'','C');
		$month = strtotime("+1 month", $month);	}
$pdf->Ln();
if(($loop % 20)==0){
$pdf->Ln();
$pdf->Cell(175,5);
$tglan=date('d-m-Y');
$pdf->Cell(100,5,"Tangerang, $tglan ",'','','C');
$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();
$pdf->Cell(175,5);
$pdf->Cell(100,5,'','','','C');
$pdf->Ln();
$pdf->Cell(175,5);
$pdf->Cell(100,5,'MANAGER MAINTENANCE','','','C');
$pdf->SetFont('Arial','',7);
$pdf->Cell(0,5,"*Created_By:".$_SESSION['nama']."",'','','R');

$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(275,5,'LAPORAN COMPLAINT TOKO','','','C');
$pdf->Ln();
$pdf->Cell(275,5,'PT ALBANI CORONA LESTARI','','','C');
$pdf->Ln();
$pdf->Cell(275,5,"PERTANGGAL : $start_date s/d $end_date",'','','C');
$pdf->Ln();$pdf->Ln();
$pdf->SetFont('Arial','',8);

$pdf->Cell(55,10,'Toko',1,'','C');
		$month = strtotime($start_date);
		while($month < strtotime($end_date)) {
$pdf->Cell(18,5,$fungsi->fm(date('m-Y', $month)),1,'','C');
		$month = strtotime("+1 month", $month);	}
$pdf->Ln();
$pdf->Cell(55,5);
		$month = strtotime($start_date);
		while($month < strtotime($end_date)) {
$pdf->Cell(6,5,'Ttl',1,'','C');
$pdf->Cell(6,5,'Cl',1,'','C');
$pdf->Cell(6,5,'Sla',1,'','C');
		$month = strtotime("+1 month", $month);	}
$pdf->Ln();
}

$loop++;
}
$pdf->Ln();
$pdf->Cell(175,5);
$tglan=date('d-m-Y');
$pdf->Cell(100,5,"Tangerang, $tglan ",'','','C');
$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();
$pdf->Cell(175,5);
$pdf->Cell(100,5,'','','','C');
$pdf->Ln();
$pdf->Cell(175,5);
$pdf->Cell(100,5,'MANAGER MAINTENANCE','','','C');
$pdf->SetFont('Arial','',7);
$pdf->Cell(0,5,"*Created_By:".$_SESSION['nama']."",'','','R');

$content = $pdf->Output($dir.'Laporan_complaint_dp.pdf','I');

}
?>