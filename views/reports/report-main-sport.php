<?php 	include ('../../config/config.php');
	include('../../library/lib_reports.php');
	include('../../library/lib_global.php');
	require('pdf.php');
	$reports = new lib_reports();
	$global = new lib_global();
	$pdf = new PDF('L','mm','A4'); 
	$sportId = $_GET['i'];
	$leagueId = $_GET['l'];?>
<?php
global $sub;
$title = 'SCOREDUINO';
foreach ($reports->reportDropdown('sport',$leagueId,$sportId) as $key => $row)
$sub =  $row['leagueName']." - ".$row['sportName'];
$pdf->SetTitle($title);
$pdf->SetAuthor('Jig James Marababol');
$pdf->AddPage();
$pdf->SetFont('Helvetica','',12);
$header = array('','Team Name','Championship Wins','Championship Loses','Preliminary Wins','Preliminary Loses');
$col = 5;
$pdf->FancyTable($header,$reports->reportMain('sport','simple',$sportId,$leagueId),'matchmain',$col);
$pdf->Ln(10);
$pdf->Output();
?>