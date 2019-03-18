<?php include '../../config/config.php' ?>
<?php include('../../library/lib_inspections.php'); ?>
<?php 
	$inspections = new lib_inspections();
	switch ($_REQUEST['controller']) {
		case 'delete':
			echo $inspections->deleteInspection($_REQUEST['inspectionId']);
			break;
		case 'updateInsert':
			echo $inspections->insertUpdateInspection($_REQUEST);
			break;
		case 'getRow':
			echo $inspections->getInspectionRow($_REQUEST["inspectionId"]);
			break;
		default:break;
	}

 ?>