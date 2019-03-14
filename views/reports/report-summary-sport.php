<?php 	include ('../../config/config.php');
	include('../../library/lib_reports.php');
	require('pdf.php');
	$reports = new lib_reports();
	$pdf = new PDF('L','mm','A4');  ?>
<?php

// Instanciation of inherited class

$title = 'SCOREDUINO';
$sub ='Sport Summary Report';
$pdf->SetTitle($title);
$pdf->SetAuthor('Jig James Marababol');
$pdf->AddPage();
$pdf->SetFont('Helvetica','',12);
$header = array('','Sport Name','Def Min per Session','Def Num of Sessions');
$pdf->FancyTable($header,$reports->reportSummary('sports'),'sports');
$pdf->Output();
?>