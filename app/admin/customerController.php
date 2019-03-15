<?php include '../../config/config.php' ?>
<?php include('../../library/lib_customers.php'); ?>
<?php 
	$customers = new lib_customers();
	switch ($_REQUEST['controller']) {
		case 'delete':
			echo $customers->deleteCustomer($_REQUEST['customerId']);
			break;
		case 'updateInsert':
			echo $customers->insertUpdateCustomer($_REQUEST);
			break;
		case 'getRow':
			echo $customers->getCustomerRow($_REQUEST["customerId"]);
			break;
		default:break;
	}

 ?>