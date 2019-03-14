<?php @ob_start(); include('config/view.php'); include('config/URI.php');  if (session_status() == PHP_SESSION_NONE) URI::session();
	if(!isset($_SESSION['user']['isLoggedIn']) && $_SESSION['user']['isLoggedIn'] != true){
			URI::redirect("login.php"); 
			return false;
		}
		$page = (isset($_REQUEST['p']) && !empty($_REQUEST['p']) ? $_REQUEST['p'] : 'dashboard');
		$styles	= [
				"vendor/materialize.min",
				"vendor/dataTables.material.min",
				"main/global",
		];  
		$scripts = [	
				"vendor/jquery.min",
				"vendor/materialize.min",
				"vendor/dataTables.material.min",
				"main/global",
		];
	// if($_SESSION['user']['role'] == "Admin" ){
		switch ($page) {
			case 'dashboard':
				// array_push($scripts,"modules/admin/demo");
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
						// 'list'=>"Sports.getSportList('/views/admin/list-sports.php')"
					     ];
				$content = "admin/page-cars";
			break;
			case 'form-car':
				array_push($scripts,"main/cars");
				$data    = [
						'title' =>  "4M Mechanical PTY LTD | Car Form", 
						"active" => "form-car",
						'scripts'=>$scripts,
						'styles'=>$styles,
						// 'list'=>"Sports.getSportList('/views/admin/list-sports.php')"
					     ];
				$content = "admin/form-cars";
			break;
			
				$data    = [
						'title' =>  "4M Mechanical PTY LTD | Cars", 
						"active" => "cars",
						'scripts'=>$scripts,
						'styles'=>$styles,
						// 'list'=>"Sports.getSportList('/views/admin/list-sports.php')"
					     ];
				$content = "admin/page-cars";
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
	// }
	view::make("layouts/".strtolower($_SESSION['user']['role'])."/content");
?>