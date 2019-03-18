<?php 
	class lib_inspections extends Config {
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
		public function showInspections(){
			$data = [];
			$sql = $this->DB->query("SELECT a.inspectionId AS 'inspectionId', a.lubrication AS 'lubrication', a.underhood AS 'underhood', a.road AS 'road', a.carId AS 'carId', a.dateCreated AS 'dateCreated',b.plateNumber FROM ".$this->table['inspections']." a INNER JOIN ".$this->table['cars']." b ON a.carId = b.carId WHERE a.status != '0' AND b.status !='0' ");
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
			return $data;
		}
		public function showFields($category){
			$data = [];
			$sql = $this->DB->query("SELECT fieldId, fieldtxt FROM ".$this->table['fields']." WHERE category = '".$category."' AND status !='0' ");
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
			return $data;
		}
		public function showInspectionsByCar($carId){
			$data = [];
			$sql = $this->DB->query("SELECT a.inspectionId AS 'inspectionId', a.dateCreated AS 'dateCreated' FROM ".$this->table['inspections']." a WHERE a.status != '0' AND a.carId =".$carId);
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
			return $data;
		}
		public function deleteInspection($inspectionId){
			$sql   = $this->DB->prepare("UPDATE ".$this->table['inspections']." SET status  = '0' WHERE inspectionId = :inspectionId ");
			$sql->execute([":inspectionId" => $inspectionId ]);
			return json_encode(["response" => "Success"]);
		}
		public function getInspectionRow($inspectionId){
			$sql   = $this->DB->prepare("SELECT a.inspectionId, a.carId, a.lubrication, a.underhood, a.road, a.dateCreated, b.plateNumber, b.carModel FROM ".$this->table['inspections']." a INNER JOIN ".$this->table['cars']." b ON a.carId = b.carId WHERE inspectionId = :inspectionId AND a.status != '0' AND b.status != '0' ");
			$sql->execute([":inspectionId" => $inspectionId ]);
			return json_encode($sql->fetch(PDO::FETCH_ASSOC));
		}

		public function insertUpdateInspection($data = []){
			$inspectionData = [ 
				":lubrication" => $data['lubrication'],
				":underhood" => $data['underhood'],
				":road" => $data['road'],
				":carId" => $data['carId']
				 ];
			if(isset($data['inspectionId']) && !empty($data['inspectionId'])) { //Update Process
				$sql   = $this->DB->prepare("UPDATE ".$this->table['inspections']."  SET lubrication=:lubrication, underhood=:underhood, road=:road WHERE inspectionId = ".$data['inspectionId']." ");
				$sql->execute($inspectionData);
				$response = ["response" => "Success", "message" => "Inspection successfully updated!"];
			} else { // Existence Check
				$sql   = $this->DB->prepare("SELECT * FROM ".$this->table['inspections']." WHERE inspectionId = :inspectionId AND status != 0");
				$sql->execute([":inspectionId" => $data['inspectionId'] ]);
				if($sql->rowCount() > 0) {
					$response = ['response' => "Failed", "message" => "Inspection already exists."];
				} else { //Data Insertion
				$sql   = $this->DB->prepare("INSERT INTO ".$this->table['inspections']." (lubrication, underhood, road, carId)VALUES(:lubrication, :underhood, :road, :carId)");
				$sql->execute($inspectionData);
				$response = ["response" => "Success", "message" => "Inspection successfully saved!"];
				}
			}	
			return json_encode($response);
		}
	}
?>