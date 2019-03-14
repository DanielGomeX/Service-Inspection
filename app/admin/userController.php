<?php include '../../config/config.php' ?>
<?php include('../../library/lib_users.php'); ?>
<?php include('../../library/lib_authentication.php'); ?>
<?php 
	$users = new lib_users();
	$auth = new lib_authentication();
	switch ($_REQUEST['controller']) {
		case 'delete':
			echo $users->deleteUser($_REQUEST['uid']);
			break;
		case 'status':
			echo $users->userStatus($_REQUEST);
			break;
		case 'updateInsert':
			echo $users->insertUpdateUser($_REQUEST);
			break;
		case 'getRow':
			echo $users->getUserRow($_REQUEST["uid"]);
			break;
		case 'checkauth':
			echo $auth->checkAuth($_REQUEST);
			break;
		case 'logout':
			echo $auth->logout();
			break;
		default:break;
	}

 ?>