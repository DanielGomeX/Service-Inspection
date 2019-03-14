<?php 	include ('../../config/config.php');
	include('../../library/lib_reports.php');
	include('../../library/lib_global.php');
	require('pdf.php');
	$reports = new lib_reports();
	$global = new lib_global();
	$pdf = new PDF('L','mm','A4'); 
	$leagueId = $_GET['i'];?>
<?php
global $sub, $x;
$x = 0; $title = 'SCOREDUINO';
foreach ($global->showLeague($leagueId) as $key => $row) $sub =  $row['leagueName'];
$pdf->SetTitle($title);
$pdf->SetAuthor('Jig James Marababol');
$pdf->AddPage();
$pdf->SetFont('Helvetica','',12);
$header = array('','Team Name','Champ Points','Prelim Points');
foreach ($reports->reportDropdown('sport', $leagueId) as $row){
	$x++;
	array_push($header,substr($row['sportName'], 0,6)." Champ");
	array_push($header,substr($row['sportName'], 0,6)." Prelim");
} 
$x = ($x*2); $col = $x+3;
$pdf->FancyTable($header,$reports->reportMain('league','simple',$leagueId,$x),'matchmain',$col);
$pdf->Ln(10);
$pdf->Output();
?>