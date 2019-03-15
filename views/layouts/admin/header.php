<?php global $data; ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo (isset($data['title']) ? $data['title'] : "") ?></title>
	<?php if(isset($data['styles'])) : ?>
	<?php foreach ($data['styles'] as $key) : ?>
		<link rel="stylesheet" type="text/css" href="<?php URI::style($key); ?>">
	<?php endforeach ?>
	<?php endif ?>
</head>
<body class="grey lighten-3">
	<nav>
	<div class="nav-wrapper blue darken-2">
		<a href="#!" class="brand-logo"><img src="<?php URI::image('logos/white.png');?>" height="64"></a>
		<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		<ul class="right hide-on-med-and-down">
			<li><a href="?p=dashboard"><i class="material-icons left">home</i>Home</a></li>
			<li><a href="?p=customers"><i class="material-icons left">sentiment_very_satisfied</i>Customers</a></li>
			<li><a href="?p=cars"><i class="material-icons left">directions_car</i>Cars</a></li>
			<li><a href="?p=reports"><i class="material-icons left">insert_chart</i>Inspections</a></li>
			<li><a href="?p=logout"><i class="material-icons left">power_settings_new</i>Logout</a></li>
		</ul>
	</div>
</nav>

<ul class="sidenav" id="mobile-demo">
	  <li >
	      <div class="user-view black-text">
	        <div class="background">
	          <img src="<?php URI::image('others/background.jpg');?>">
	        </div>
	        <a href="javascript:void(0);"><img class="circle" src="<?php URI::image('svg/user.svg');?>"></a>
	        <span class="name titlecase">Hello, <b><?=$_SESSION['user']['username'];?></b>!</span>
	        <span class="email titlecase">It's good to have you here.</span>
	      </div>
	    </li>
		<li><a href="?p=dashboard"><i class="material-icons left">home</i>Home</a></li>
		<li><a href="?p=customers"><i class="material-icons left">sentiment_very_satisfied</i>Customers</a></li>
		<li><a href="?p=cars"><i class="material-icons left">directions_car</i>Cars</a></li>
		<li><a href="?p=reports"><i class="material-icons left">insert_chart</i>Inspections</a></li>
		<li><a href="?p=logout"><i class="material-icons left">power_settings_new</i>Logout</a></li>
</ul>