<?php include '../../config/config.php' ?>
<?php include('../../library/lib_teams.php'); ?>
<?php 
	$teams = new lib_teams();
	switch ($_REQUEST['controller']) {
		case 'delete':
			echo $teams->deleteTeam($_REQUEST['uid']);
			break;
		case 'updateInsert':
			echo $teams->insertUpdateTeam($_REQUEST);
			break;
		case 'getRow':
			echo $teams->getTeamRow($_REQUEST["uid"]);
			break;
		default:break;
	}

 ?>