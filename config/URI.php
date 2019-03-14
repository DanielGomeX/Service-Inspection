<?php 	
	Class URI {
		//Root Function 
		public static function phpUrlPath() {
		    return $_SERVER['REQUEST_SCHEME'].'://' . $_SERVER['HTTP_HOST'] . '/' . explode('/', $_SERVER['REQUEST_URI'])[1];
		}
		public static function baseUrl(){
			echo self::phpUrlPath();
		}
		// Query Sanitation
		public static function sanitize($str){
		  $str = trim($str);
		  if (get_magic_quotes_gpc())
		    $str = stripslashes($str);

		  return htmlentities($str);
		}
		// Password Encryption
		public static function encrypt($password){
			if(!empty($password)){
				return md5($password);
			}
		}
		// Session Manipulation
		public static function session(){
			return session_start();	
		}
		public static function destroy(){
			return session_destroy();	
		}
		public static function redirect($page){
			
			return header("location:".$page);	
		}
		// Directories
		public static function style($fileName) {
			if(!empty($fileName)) {
				echo self::phpUrlPath() . '/public/assets/stylesheets/'.$fileName.'.css'; 
			}
		}
		public static function script($fileName) {
			if(!empty($fileName)) {
				echo self::phpUrlPath() . '/public/assets/scripts/'.$fileName.'.js'; 
			}
		}
		public static function image($FILES_NAME) {
			if(!empty($FILES_NAME)) {
				echo self::phpUrlPath() . "/public/assets/images/".$FILES_NAME; 
			}
		}
	}
 ?>		
