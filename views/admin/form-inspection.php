<?php
	include ('config/config.php');
	include('library/lib_inspections.php');
	$inspections = new lib_inspections(); 
	$inspectionId = (isset($_REQUEST['id']) && !empty($_REQUEST['id']) ? $_REQUEST['id'] : null);
	$inspectionDetails= (array) json_decode($inspections->getInspectionRow($inspectionId));
?>
