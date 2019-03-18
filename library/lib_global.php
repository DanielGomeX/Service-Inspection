<?php 
	class lib_global extends Config {
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
	// Information Array Getter
	public function showAll($tableName){
			$data = [];
			$sql = $this->DB->query("SELECT * FROM ".$this->table[$tableName]);
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
			return $data;
		}
	
	public function showAllActive($tableName){
			$data = [];
			$sql = $this->DB->query("SELECT * FROM ".$this->table[$tableName]." WHERE status = '1' ");
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
			return $data;
		}
	// Counter
	public function countAllActive($tableName){
			$sql = $this->DB->query("SELECT COUNT(*)  AS 'count' FROM ".$this->table[$tableName]." WHERE status != '0' ");
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) return $row['count']; 
		}

	public function inspectionBoard(){
		$data = [];
			$sql = $this->DB->query("SELECT a.inspectionId,a.dateCreated, b.carId, b.plateNumber, c.customerId,c.fullname FROM ".$this->table['inspections']." a   INNER JOIN ".$this->table['cars']." b ON a.carId = b.carId INNER JOIN ".$this->table['customers']." c ON b.customerId = c.customerId WHERE a.status !='0' AND b.status !='0' AND c.status !='0' ORDER BY a.dateCreated DESC");
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
			return $data;
	}
}
?>