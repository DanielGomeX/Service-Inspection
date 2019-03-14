<?php 	include ('../../config/config.php');
	include('../../library/lib_reports.php');
	require('pdf.php');
	$reports = new lib_reports();
	$pdf = new PDF('L','mm','A4');  ?>
<?php
$title = 'SCOREDUINO';
$sub ='User Summary Report';
$pdf->SetTitle($title);
$pdf->SetAuthor('Jig James Marababol');
$pdf->AddPage();
$pdf->SetFont('Helvetica','',12);
$header = array('','Username','Full Name','E-mail Address','Sex','Role');
$pdf->FancyTable($header,$reports->reportSummary('user'),'user');
$pdf->Output();
?>