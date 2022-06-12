<?php
ini_set('memory_limit', '1024M');
ini_set('max_execution_time', 3000000);

if($_POST['pdf']){

require('fpdf/mc_table.php');
include "db.php";
include "function.php";
session_start();
	
	$fungsi= new Fungsi();
	$staff	= $_POST['staff'];
	$start_date	= $_POST['startdate'];
	$end_date	= $_POST['enddate'];
	$check=$fungsi->get_lap_complaint($staff,$start_date,$end_date);


$dir = 'file/';
foreach(glob($dir.'*.*') as $v){
    unlink($v);
	echo $v."<br/>";
}
	
 
$pdf=new PDF_MC_Table();
$pdf->AddPage('L','A4');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(275,5,'LAPORAN COMPLAINT','','','C');
$pdf->Ln();
$pdf->Cell(275,5,'PT ALBANI CORONA LESTARI','','','C');
$pdf->Ln();
$pdf->Cell(275,5,"PERTANGGAL : $start_date s/d $end_date",'','','C');
$pdf->Ln();$pdf->Ln();
$pdf->SetFont('Arial','',8);
$pdf->Cell(25,5,'No Ticket',1,'','C');
$pdf->Cell(8,5,'SLA',1,'','C');
$pdf->Cell(20,5,'Created By',1,'','C');
$pdf->Cell(20,5,'Toko',1,'','C');
$pdf->Cell(30,5,'Created Date',1,'','C');
$pdf->Cell(20,5,'Kategori',1,'','C');
$pdf->Cell(17,5,'Assignment',1,'','C');
$pdf->Cell(15,5,'Status',1,'','C');
$pdf->Cell(60,5,'Rincian Masalah',1,'','C');
$pdf->Cell(60,5,'Solusi Masalah',1,'','C');
$pdf->Ln();

$pdf->SetWidths(array(25,8,20,20,30,20,17,15,60,60));
srand(microtime()*1000000);
$loop=1;
while($row=mysql_fetch_array($check)){
	$pdf->Row(array($fungsi->moon($row['no_ticket']),
					$row['status_sla'],
					$row['nama'],
					$row['nama_dept'],
					$row['created_date'],
					$row['nama_category'],
					$row['nama_assign'],
					$row['status'],
					$row['rincian_masalah'],
					$row['solusi_masalah']));
if(($loop % 10)==0){ // limit baris saat di print
$pdf->Ln();$pdf->Ln(); //tambah dan kurangi disni 
$pdf->Cell(175,5);
$tglan=date('d-m-Y');
$pdf->Cell(100,5,"Tangerang, $tglan ",'','','C');
$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();
$pdf->Cell(175,5);
$pdf->Cell(100,5,'','','','C');
$pdf->Ln();
$pdf->Cell(175,5);
$pdf->Cell(100,5,'MANAGER MAINTENANCE','','','C');
//$pdf->Ln();
$pdf->SetFont('Arial','',7);
$pdf->Cell(0,5,"*Created_By:".$_SESSION['nama']."",'','','R');
$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();// panjang enter data untuk baris baru

$pdf->SetFont('Arial','B',12);
$pdf->Cell(275,5,'LAPORAN COMPLAINT','','','C');
$pdf->Ln();
$pdf->Cell(275,5,'PT ALBANI CORONA LESTARI','','','C');
$pdf->Ln();
$pdf->Cell(275,5,"PERTANGGAL : $start_date s/d $end_date",'','','C');
$pdf->Ln();$pdf->Ln();
$pdf->SetFont('Arial','',8);
$pdf->Cell(25,5,'No Ticket',1,'','C');
$pdf->Cell(8,5,'SLA',1,'','C');
$pdf->Cell(20,5,'Created By',1,'','C');
$pdf->Cell(20,5,'Toko',1,'','C');
$pdf->Cell(30,5,'Created Date',1,'','C');
$pdf->Cell(20,5,'Kategori',1,'','C');
$pdf->Cell(17,5,'Assignment',1,'','C');
$pdf->Cell(15,5,'Status',1,'','C');
$pdf->Cell(60,5,'Rincian Masalah',1,'','C');
$pdf->Cell(60,5,'Solusi Masalah',1,'','C');
$pdf->Ln();

}
$loop++;
}
$pdf->Ln();$pdf->Ln();
$pdf->Cell(175,5);
$tglan=date('d-m-Y');
$pdf->Cell(100,5,"Tangerang, $tglan ",'','','C');
$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();
$pdf->Cell(175,5);
$pdf->Cell(100,5,'','','','C');
$pdf->Ln();
$pdf->Cell(175,5);
$pdf->Cell(100,5,'MANAGER MAINTENANCE','','','C');
//$pdf->Ln();
$pdf->SetFont('Arial','',7);
$pdf->Cell(0,5,"*Created_By:".$_SESSION['nama']."",'','','R');
$content = $pdf->Output($dir.'Laporan_complaint.pdf','I');

}
?>