<?php include 'config/URI.php' ?>
<?php URI::session(); ?>
<?php if(isset($_SESSION['user']['isLoggedIn']) && $_SESSION['user']['isLoggedIn'] == true) URI::redirect("index.php?p=dashboard") ?>
<!DOCTYPE html>
<html >
<head>
	<title>Login</title>
	<?php $styles	= [
				"vendor/materialize.min",
				"main/global",
				"main/login",
			];   ?>
	
	<?php foreach ($styles as $key):?>
		<link rel="stylesheet" type="text/css" href="<?php URI::style($key); ?>"><?php endforeach;?>
	
</head>
<body class="night">
