<?php include '../../config/config.php' ?>
<?php include('../../library/lib_matches.php'); ?>
<?php 
	$matches = new lib_matches();
	switch ($_REQUEST['controller']) {
		case 'delete':
			echo $matches->deleteMatch($_REQUEST['uid']);
			break;
		case 'end':
			echo $matches->endMatch($_REQUEST['uid']);
			break;
		case 'start':
			echo $matches->startMatch($_REQUEST['uid']);
			break;
		case 'updateInsert':
			echo $matches->insertUpdateMatch($_REQUEST);
			break;
		case 'getRow':
			echo $matches->getMatchRow($_REQUEST["uid"]);
			break;
		case 'getDateTime':
			echo $matches->getDateTime($_REQUEST["uid"]);
			break;
		default:break;
	}

 ?>