<?php @ob_start(); include('config/view.php'); include('config/URI.php'); if (session_status() == PHP_SESSION_NONE) URI::session();
	if(!isset($_SESSION['user']['isLoggedIn']) && $_SESSION['user']['isLoggedIn'] != true){
			URI::redirect("login.php"); 
			return false;
		}
		$page = (isset($_REQUEST['p']) && !empty($_REQUEST['p']) ? $_REQUEST['p'] : 'dashboard');
		$styles	= [
				"vendor/materialize.min",
				"vendor/dataTables.material.min",
				"vendor/sweetalert2.min",
				"main/global",
		];  
		$scripts = [	
				"vendor/jquery.min",
				"vendor/jquery.timeago",
				"vendor/materialize.min",
				"vendor/sweetalert2.all.min",
				"vendor/dataTables.material.min",
				"main/global",
		];
		switch ($page) {
			case 'dashboard':
				$data    = [
						'title' => "4M Mechanical PTY LTD | Home", 
						"active" => "dashboard",
						'scripts'=>$scripts,
						'styles'=>$styles
					     ];
				$content = "admin/page-dashboard";
			break;
			case 'cars':
				array_push($scripts,"main/cars");
				$data    = [
						'title' =>  "4M Mechanical PTY LTD | Cars", 
						"active" => "cars",
						'scripts'=>$scripts,
						'styles'=>$styles,
					     ];
				$content = "admin/page-cars";
			break;
			case 'car':
				array_push($scripts,"main/cars");
				array_push($scripts,"main/inspections");
				$data    = [
						'title' =>  "4M Mechanical PTY LTD | Car Details", 
						"active" => "cars",
						'scripts'=>$scripts,
						'styles'=>$styles,
					     ];
				$content = "admin/page-car";
			break;
			case 'customers':
				array_push($scripts,"main/customers");
				$data    = [
						'title' =>  "4M Mechanical PTY LTD | Customers", 
						"active" => "customers",
						'scripts'=>$scripts,
						'styles'=>$styles,
					     ];
				$content = "admin/page-customers";
			break;
			case 'inspection':
				array_push($scripts,"main/inspections");
				$data    = [
						'title' =>  "4M Mechanical PTY LTD | Service Inspection Details", 
						"active" => "inspections",
						'scripts'=>$scripts,
						'styles'=>$styles,
					     ];
				$content = "admin/page-inspection";
			break;
			case 'form-car':
				array_push($scripts,"main/cars");
				$data    = [
						'title' =>  "4M Mechanical PTY LTD | Car Form", 
						"active" => "form-car",
						'scripts'=>$scripts,
						'styles'=>$styles,
					     ];
				$content = "admin/form-cars";
			break;
			case 'form-customer':
				array_push($scripts,"main/customers");
				$data    = [
						'title' =>  "4M Mechanical PTY LTD | Customer Form", 
						"active" => "form-customer",
						'scripts'=>$scripts,
						'styles'=>$styles,
					     ];
				$content = "admin/form-customers";
			break;
			case 'form-inspection':
				array_push($scripts,"main/inspections");
				$data    = [
						'title' =>  "4M Mechanical PTY LTD | Service Inspection Form", 
						"active" => "form-inspection",
						'scripts'=>$scripts,
						'styles'=>$styles,
					     ];
				$content = "admin/form-inspections";
			break;
			case 'logout':
				URI::session();
				URI::destroy();
				URI::redirect('login.php');
			break;
			
			default:
				$data    = [
						'title' => "Error 404", 
						"active" => "Oopsie",
						'scripts'=>$scripts,
						'styles'=>$styles
					     ];
				$content = "modules/error";
			break;
		}
	view::make("layouts/".strtolower($_SESSION['user']['role'])."/content");
?>