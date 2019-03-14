<?php include '../../config/config.php' ?>
<?php include('../../library/lib_matchlogs.php'); ?>
<?php 
	$matchlogs = new lib_matchlogs();
	switch ($_REQUEST['controller']) {
		case 'delete':
			echo $matchlogs->deleteScore($_REQUEST['uid']);
			break;
		case 'updateInsert':
			echo $matchlogs->insertUpdateScore($_REQUEST);
			break;
		case 'getRow':
			echo $matchlogs->getMatchlogRow($_REQUEST["uid"]);
			break;
		default:break;
	}
 ?>