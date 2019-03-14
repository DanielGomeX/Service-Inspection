<?php 	include ('../../config/config.php');
	include('../../library/lib_reports.php');
	require('pdf.php');
	$reports = new lib_reports();
	$pdf = new PDF('L','mm','A4');  ?>
<?php

// Instanciation of inherited class

$title = 'SCOREDUINO';
$sub ='Match Summary Report';
$pdf->SetTitle($title);
$pdf->SetAuthor('Jig James Marababol');
$pdf->AddPage();
$pdf->SetFont('Helvetica','',12);
$header = array('','Team Match','Sport Division','League','Date and Time','Standing');
$pdf->FancyTable($header,$reports->reportSummary('matches'),'matches');
$pdf->Output();
?>