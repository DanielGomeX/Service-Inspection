<?php 
	class lib_cars extends Config {
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
		public function showCars(){
			$data = [];
			$sql = $this->DB->query("SELECT a.carId AS 'carId', a.carModel AS 'carModel', a.plateNumber AS 'plateNumber', a.customerId AS 'customerId', b.fullName AS 'fullName' FROM ".$this->table['cars']." a INNER JOIN ".$this->table['customers']." b ON a.customerId = b.customerId WHERE a.status != '0' AND b.status !='0' ");
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
			return $data;
		}
		public function showCarsByCustomer($customerId){
			$data = [];
			$sql = $this->DB->query("SELECT a.carId AS 'carId', a.carModel AS 'carModel', a.plateNumber AS 'plateNumber', a.customerId AS 'customerId' FROM ".$this->table['cars']." a WHERE a.status != '0' AND a.customerId =".$customerId);
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
			return $data;
		}
		public function deleteCar($carId){
			$sql   = $this->DB->prepare("UPDATE ".$this->table['cars']." SET status  = '0' WHERE carId = :carId ");
			$sql->execute([":carId" => $carId ]);
			return json_encode(["response" => "Success"]);
		}
		public function getCarRow($carId){
			$sql   = $this->DB->prepare("SELECT * FROM ".$this->table['cars']." a INNER JOIN ".$this->table['customers']." b ON a.customerId = b.customerId WHERE carId = :carId AND  a.status != '0' ");
			$sql->execute([":carId" => $carId ]);
			return json_encode($sql->fetch(PDO::FETCH_ASSOC));
		}
		public function insertUpdateCar($data = []){
			$carData = [ 
				":carModel" => $data['carModel'],
				":plateNumber" => $data['plateNumber'],
				":customerId" => $data['customerId']
				 ];
			if(isset($data['carId']) && !empty($data['carId'])) { //Update Process
				$sql   = $this->DB->prepare("UPDATE ".$this->table['cars']."  SET carModel=:carModel,plateNumber = :plateNumber,customerId = :customerId WHERE carId = ".$data['carId']." ");
				$sql->execute($carData);
				$response = ["response" => "Success", "message" => "Car successfully updated!"];
			} else { // Existence Check
				$sql   = $this->DB->prepare("SELECT * FROM ".$this->table['cars']." WHERE plateNumber = :plateNumber AND status != 0");
				$sql->execute([":plateNumber" => $data['plateNumber'] ]);
				if($sql->rowCount() > 0) {
					$response = ['response' => "Failed", "message" => "Plate Number already exists."];
				} else { //Data Insertion
				$sql   = $this->DB->prepare("INSERT INTO ".$this->table['cars']." (carModel,plateNumber,customerId)VALUES(:carModel,:plateNumber,:customerId)");
				$sql->execute($carData);
				$response = ["response" => "Success", "message" => "Car successfully saved!"];
				}
			}	
			return json_encode($response);
		}
	}
?>