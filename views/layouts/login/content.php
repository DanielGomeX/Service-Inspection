<?php 
	global $content;
	view::make('layouts/login/header');
	view::make($content);
	view::make("layouts/login/footer");
 ?>