<?php include '../../config/config.php' ?>
<?php include('../../library/lib_leagues.php'); ?>
<?php 
	$leagues = new lib_leagues();
	switch ($_REQUEST['controller']) {
		case 'delete':
			echo $leagues->deleteLeague($_REQUEST['uid']);
			break;
		case 'updateInsert':
			echo $leagues->insertUpdateLeague($_REQUEST);
			break;
		case 'getRow':
			echo $leagues->getLeagueRow($_REQUEST["uid"]);
			break;
		default:break;
	}

 ?>