<?php 	include ('../../config/config.php');
	include('../../library/lib_reports.php');
	include('../../library/lib_global.php');
	require('pdf.php');
	$reports = new lib_reports();
	$global = new lib_global();
	$pdf = new PDF('L','mm','A4'); 
	$matchId = $_GET['i'];?>
<?php
$title = 'SCOREDUINO';
foreach ($global->showMatch($matchId) as $key => $row) {
$sub =  $row['teamOne']." VS ".$row['teamTwo'];
$sub .=' '.($row['division'] != 'All')?" - ".$row['division']."'s Division":' ';
$sub .=' '.($row['matchType'] != "Teams")?' - '.$row['matchType']:" ";
$sub2 =  $row['sportName']." - ".$row['leagueName'];
$col = $row['numSet'];
	if($row['scoreType'] == "Rally") {
		$header = array('','Team Name','Final Score');
		for ($x=1; $x <= $col ; $x++) 
	            	array_push($header,$global->rankNumber($x).' Set');
	}else{ 
		$header = array('','Team Name','Final Score');
		for ($x=1; $x <= $col ; $x++) 
	            	array_push($header,$global->rankNumber($x).' Quarter');
	}
}
$pdf->SetTitle($title);
$pdf->SetAuthor('Jig James Marababol');
$pdf->AddPage();
$pdf->SetFont('Helvetica','',12);
$col+=2;
$pdf->FancyTable($header,$reports->reportMain('match','simple',$matchId),'matchmain',$col);
$pdf->Ln(10);
$pdf->FancyTable($header,$reports->reportMain('match','elaborate',$matchId),'matchmain',$col);
$pdf->Output();
?>