<?php 
	class lib_authentication extends Config {
		private $DB;
		private $table = ["users" => "users"];
		function __construct(){
			$this->DB = $this->DB_CONNECT();
		}

		public function checkAuth($data = array(), $status = 1) {
			try {
					$sql   = $this->DB->prepare("SELECT * FROM ".$this->table['users']." WHERE username=:username AND password=:password AND status='1' LIMIT 1");
							 $sql->execute(array(":username" => URI::sanitize($data['username']), ":password" => URI::encrypt($data['password']) ));
					$getRow = $sql->fetch(PDO::FETCH_ASSOC);
					if($sql->rowCount() > 0) {
						
						$session = [
									"id"   	 		=> $getRow['uid'],
									'username' 		=> $getRow['username'],
									'role' 			=> $getRow['role'],
									"isLoggedIn" 	=> true
									];

						self::sessionSet($session);
						$response = ["response" => "success", "message" => "Logged In Successfully", 'role' => $_SESSION['user']['role'] ];
					
					} else {
						$response = ["response" => "failed", "message" => "Invalid username or password!"];
					}

					return json_encode($response);	
	
			} catch (PDOException $e) {
				throw new Exception($e->getMessage());
			}
		}

		public function sessionSet($data = []){
			URI::session();
			$_SESSION['user'] = $data;
			return $_SESSION['user'];
		}

		public static function logout(){
			URI::session();
			URI::destroy();
			URI::redirect('../../login.php');
		}

		
	}
	
 ?>