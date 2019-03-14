<?php include '../../config/config.php' ?>
<?php include('../../library/lib_cars.php'); ?>
<?php 
	$cars = new lib_cars();
	switch ($_REQUEST['controller']) {
		case 'delete':
			echo $cars->deleteCar($_REQUEST['carId']);
			break;
		case 'updateInsert':
			echo $cars->insertUpdateCar($_REQUEST);
			break;
		case 'getRow':
			echo $cars->getCarRow($_REQUEST["carId"]);
			break;
		default:break;
	}

 ?>