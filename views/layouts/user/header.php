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
<body>
<!-- <div class="miniload"></div> -->
<div class="wrapper">
	<div class="sidebar" data-active-color="red" data-background-color="white" >
		<div class="logo">
			<a href="?p=dashboard" class="simple-text text wide">
				SCOREDUINO
			</a>
		</div>
	    	<div class="sidebar-wrapper" >
	    		<div class="user" >
			   <div class="photo">
			       <img src="public/upload/profile/1.png" />
			    </div>
			    <div class="info">
			        <a data-toggle="collapse" href="#userCollapse" class="collapsed">
			           <?=$_SESSION['user']['fullName']?>
			            <b class="caret"></b>
			        </a>
			        <div class="collapse" id="userCollapse">
			           <ul class="nav">
				<?php
					$navbar =[
							["profile","My Profile"],
							["notifications","Notifications"],
							["logout","Log Out"]
						];
					foreach ($navbar as $arr) :?>
					<li>
						<a href="?p=<?=$arr[0];?>" id="<?=$arr[0];?>">
						<?=$arr[1];?>
						</a>
					</li>
					<?php endforeach;?>
					
				</ul>
			        </div>
			    </div>
			</div>
			<ul class="nav">
				<?php
				$nav = [
						["Home","compass","home"],
						["Sports","dribbble","sports"],
						["Teams","group","teams"],
						["Leagues","briefcase","leagues"]
						
					];
				foreach($nav as $arr):?>
				<li <?= ($data['active'] == $arr[2]) ? 'class="active"':'';?>>
					<a href="?p=<?=$arr[2];?>" >
					<i class="el el-<?=$arr[1];?>"></i><p><?=$arr[0];?></p>
					</a>
				</li>
				<?php endforeach;?>
			</ul>
	    	</div>
	</div>
	<div class="main-panel">
	<nav class="navbar navbar-transparent navbar-absolute">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand  text wide" href="#"><?=$data['active'];?></a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
				<?php
					$navbar =[
						["profile","user","My Profile"],
						["notifications","comment","Notifications"],
						["logout","off","Log Out"]
						];
					foreach ($navbar as $arr) :?>
					<li>
						<a href="?p=<?=$arr[0];?>" id="<?=$arr[0];?>">
						<i class="el el-<?=$arr[1];?> el-2x"></i>
						<p class="hidden-lg hidden-md">
						<?=$arr[2];?></p>
						</a>
					</li>
					<?php endforeach;?>
					
				</ul>
				<form class="navbar-form navbar-right" role="search">
					<div class="form-group  is-empty">
						<input type="text" class="form-control" placeholder="Search">
						<span class="material-input"></span>
					</div>
					<button type="submit" class="btn btn-white btn-round btn-just-icon">
						<i class="el el-search"></i>
						<div class="ripple-container"></div>
					</button>
				</form>
			</div>
		</div>
	</nav>
	<div class="content">
		<div class="container-fluid">