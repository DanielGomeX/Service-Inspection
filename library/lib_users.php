<?php include '../../config/URI.php' ?>
<?php 
	class lib_users extends Config {
		private $DB;
		private $table =	[
				"user" => "tbl_user",
				"team"=> "tbl_team",
				"match"=> "tbl_match",
				"matchlog"=> "tbl_matchlog",
				"sports"=> "tbl_sports",
				"league"=> "tbl_league",
				"announcement"=> "tbl_announcement"
				];
		function __construct(){
			$this->DB = $this->DB_CONNECT();
		}
		public function showUsers(){
			$data = [];
			$sql = $this->DB->query("SELECT * FROM ".$this->table['user']." ORDER BY CASE WHEN role = 'Admin' THEN 0 ELSE 1 END  ");
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
			return $data;
		}
		public function deleteUser($uid){
			$sql   = $this->DB->prepare("DELETE FROM ".$this->table['user']." WHERE userId = :uid ");
			$sql->execute([":uid" => $uid ]);
			return json_encode(["response" => "Success"]);
		}

		public function getUserRow($uid){
			$sql   = $this->DB->prepare("SELECT * FROM ".$this->table['user']." WHERE userId = :uid ");
			$sql->execute([":uid" => $uid ]);
			return json_encode($sql->fetch(PDO::FETCH_ASSOC));
		}

		public function userStatus($data = []){
			$status = ($data['status'] == 0 ? 1 : 0 );
			$sql   = $this->DB->prepare("UPDATE ".$this->table['user']." SET status = :status WHERE userId = :uid ");
			$sql->execute([":status" => $status, ":uid" => $data['uid'] ]);
			return json_encode(["response" => "Success"]);
		}
		public function insertUpdateUser($data = []){
			$userData = [ 
				":username" => $data['addUsername'],
				":password" => URI::encrypt($data['addPassword']),
				":firstName" => $data['addFirstName'],
				":middleName" => $data['addMiddleName'],
				":lastName" => $data['addLastName'],
				":role" => $data['addRole'],
				":email" => $data['addEmailAdd'],
				":address" => $data['addHomeAdd'],
				":gender" => $data['addGender']
				 ];
			if(isset($data['id']) && !empty($data['id'])) { //Update Process
				$sql   = $this->DB->prepare("UPDATE ".$this->table['user']."  SET username=:username,firstName = :firstName,middleName = :middleName, lastName = :lastName, address = :address, role = :role, gender = :gender, email = :email, password=:password WHERE userId = ".$data['id']." ");
				$sql->execute($userData);
				$response = ["response" => "Success", "message" => "User successfully updated!"];
			} else { // Existence Check
				$sql   = $this->DB->prepare("SELECT * FROM ".$this->table['user']." WHERE username = :username ");
				$sql->execute([":username" => $data['addUsername'] ]);
				if($sql->rowCount() > 0) {
					$response = ['response' => "Failed", "message" => "User already exists."];
				} else { //Data Insertion
				$sql   = $this->DB->prepare("INSERT INTO ".$this->table['user']." (username,password,firstName,middleName,lastName,email,address,gender,role)VALUES(:username,:password,:firstName,:middleName,:lastName,:email,:address,:gender,:role)");
				$sql->execute($userData);
				$response = ["response" => "Success", "message" => "User successfully saved!"];
				}
			}	
			return json_encode($response);
		}
	}