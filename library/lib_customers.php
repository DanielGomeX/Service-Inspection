<?php 
	class lib_customers extends Config {
		private $DB;
		private $table =	[
				"cars" => "cars",
				"customers" => "customers",
				"inspections" => "inspections",
				"fields" => "inspection_fields",
				"users" => "users",
				];
		function __construct(){
			$this->DB = $this->DB_CONNECT();
		}
		public function showCustomers(){
			$data = [];
			$sql = $this->DB->query("SELECT a.customerId AS 'customerId', a.fullname AS 'fullname', a.contactNumber AS 'contactNumber', a.address AS 'address' FROM ".$this->table['customers']." a INNER JOIN ".$this->table['customers']." b ON a.customerId = b.customerId WHERE a.status != '0'");
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
			return $data;
		}
		public function deleteCustomer($customerId){
			$sql   = $this->DB->prepare("UPDATE ".$this->table['customers']." SET status  = '0' WHERE customerId = :customerId");
			$sql->execute([":customerId" => $customerId ]);
			return json_encode(["response" => "Success"]);
		}
		public function getCustomerRow($customerId){
			$sql   = $this->DB->prepare("SELECT * FROM ".$this->table['customers']." WHERE customerId = :customerId AND status != 0");
			$sql->execute([":customerId" => $customerId ]);
			return json_encode($sql->fetch(PDO::FETCH_ASSOC));
		}
		public function insertUpdateCustomer($data = []){
			$customerData = [ 
				":fullname" => $data['fullname'],
				":contactNumber" => $data['contactNumber'],
				":address" => $data['address']
				 ];
			if(isset($data['customerId']) && !empty($data['customerId'])) { //Update Process
				$sql   = $this->DB->prepare("UPDATE ".$this->table['customers']."  SET fullname=:fullname,contactNumber = :contactNumber, address=:address WHERE customerId = ".$data['customerId']." ");
				$sql->execute($customerData);
				$response = ["response" => "Success", "message" => "Customer successfully updated!"];
			} else { // Existence Check
				$sql   = $this->DB->prepare("SELECT * FROM ".$this->table['customers']." WHERE fullname = :fullname AND status != 0");
				$sql->execute([":fullname" => $data['fullname'] ]);
				if($sql->rowCount() > 0) {
					$response = ['response' => "Failed", "message" => "Customer already exists."];
				} else { //Data Insertion
				$sql   = $this->DB->prepare("INSERT INTO ".$this->table['customers']." (fullname,address,contactNumber)VALUES(:fullname,:address,:contactNumber)");
				$sql->execute($customerData);
				$response = ["response" => "Success", "message" => "Customer successfully saved!"];
				}
			}	
			return json_encode($response);
		}
	}
?>