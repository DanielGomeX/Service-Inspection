<?php 
	class lib_global extends Config {
	private $DB;
	private $table =	[
				"user" => "tbl_user",
				"team"=> "tbl_team",
				"match"=> "tbl_match",
				"matchlog"=> "tbl_matchlog",
				"sport"=> "tbl_sports",
				"league"=> "tbl_league",
				"announcement"=> "tbl_announcement"
				];
	function __construct(){
			$this->DB = $this->DB_CONNECT();
		}
	public function numberQty($num){
		return ($num == 1)? "":"s";
	}
	public function rankNumber($num){
		switch ($num) {
			case 1:return $num."st";break;
			case 2:return $num."nd";break;
			case 3:return $num."rd";break;
			default:return $num."th";break;
		}
	}
	public function updateCategory(){
		$sql1   = $this->DB->query("UPDATE ".$this->table['match']." SET category  = 'Ongoing' WHERE category = 'Upcoming' AND dateTimeStart < NOW(); ");
	}
	public function updateScores($matchId,$scoreOne,$scoreTwo){
		$sql   = $this->DB->prepare("UPDATE ".$this->table['match']." SET scoreOne  = :s1, scoreTwo  = :s2  WHERE matchId = :id ");
			$sql->execute([":id" => $matchId,":s1" => $scoreOne,":s2" => $scoreTwo ]);

	}
	public function showScores($numSet,$matchId){
		$data = [];
		$set =["","","",""];
		$set[2] = "(CASE WHEN (SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamOne AND matchId = a.matchId AND setNo = 1 AND status = '1' ) > (SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamTwo AND setNo = 1 AND matchId = a.matchId AND status = '1' ) THEN 1 ELSE 0 END)";
		$set[3] = "(CASE WHEN (SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamOne AND matchId = a.matchId AND setNo = 1 AND status = '1' ) < (SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamTwo AND setNo = 1 AND matchId = a.matchId AND status = '1' ) THEN 1 ELSE 0 END)";
		for ($j=2; $j <= $numSet ; $j++) { 
			$set[2].= "+(CASE WHEN (SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamOne AND matchId = a.matchId AND setNo = ".$j." AND status = '1' ) > (SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamTwo AND setNo = ".$j." AND matchId = a.matchId AND status = '1' ) THEN 1 ELSE 0 END)";
			$set[3].= "+(CASE WHEN (SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamOne AND matchId = a.matchId AND setNo = ".$j." AND status = '1' ) < (SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamTwo AND setNo = ".$j." AND matchId = a.matchId AND status = '1' ) THEN 1 ELSE 0 END)";
		}
		for ($i=1; $i <= $numSet ; $i++) { 
			$set[0].= ",(SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamOne AND matchId = a.matchId AND setNo = ".$i." AND status = '1' ) AS 'Score1".$i."',(CASE WHEN 
				(SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamOne AND matchId = a.matchId AND setNo = ".$i." AND status = '1' ) > (SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamTwo AND setNo = ".$i." AND matchId = a.matchId AND status = '1' ) THEN 'WIN' WHEN 
				(SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamOne AND setNo = ".$i." AND matchId = a.matchId AND status = '1' ) < (SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamTwo AND setNo = ".$i." AND matchId = a.matchId AND status = '1' ) THEN 'LOSE' ELSE 'TIE'  END )AS 'Status1".$i."' ";
			$set[1].=",(SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamTwo AND matchId = a.matchId AND setNo = ".$i." AND status = '1' ) AS 'Score2".$i."',(CASE WHEN 
				(SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamOne AND matchId = a.matchId AND setNo = ".$i." AND status = '1' ) < (SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamTwo AND setNo = ".$i." AND matchId = a.matchId AND status = '1' ) THEN 'WIN' WHEN 
				(SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamOne AND setNo = ".$i." AND matchId = a.matchId AND status = '1' ) > (SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamTwo AND setNo = ".$i." AND matchId = a.matchId AND status = '1' ) THEN 'LOSE' ELSE 'TIE'  END )AS 'Status2".$i."' ";
		}
		$query = "SELECT a.category,a.forfeit,b.leagueName,c.sportName,a.division,a.scoreOne,a.scoreTwo,SUM(".$set[2].") AS 'Total1',SUM(".$set[3].") AS 'Total2',a.matchId, a.teamOne,c.scoreType, a.teamTwo, (SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamOne AND matchId = a.matchId AND status = '1' ) AS 'TeamOneScore' ".$set[0].",(SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamTwo AND matchId = a.matchId AND status = '1' ) AS 'TeamTwoScore'".$set[1]." FROM tbl_match a INNER JOIN tbl_league b ON a.leagueId = b.leagueId INNER JOIN tbl_sports c ON a.sportId = c.sportId WHERE a.status != '0' AND matchId =".$matchId;
		$sql = $this->DB->query($query);
		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row;
		return $data;
	}
	 
	public function showMatches(){
		$data = [];
		$sql = $this->DB->query("SELECT a.category,a.forfeit,a.scoreOne,a.scoreTwo, a.matchId, b.leagueName, c.sportName,a.teamOne,a.teamTwo,a.scorePerSet,a.numSet, a.datetimeStart FROM tbl_match a INNER JOIN tbl_league b ON a.leagueId = b.leagueId INNER JOIN tbl_sports c ON a.sportId = c.sportId WHERE a.status != '0'");
		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row;
		return $data;
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
	public function showAllPic($tableName,$picColumn){
			$data = [];
			$sql = $this->DB->query("SELECT * FROM ".$this->table[$tableName]." WHERE status = '1'  ORDER BY ".$picColumn." ASC");
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
			return $data;
		}
	// Counter
	public function countAllActive($tableName){
			$sql = $this->DB->query("SELECT COUNT(*)  AS 'count' FROM ".$this->table[$tableName]." WHERE status != '0' ");
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) return $row['count']; 
		}

	public function totalScore($teamName,$matchId){
		$sql = $this->DB->query("SELECT SUM(teamScore) AS 'count' FROM ".$this->table['matchlog']."  WHERE teamName='".$teamName."' AND status != '0' AND matchId =".$matchId);
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) return $row['count']; 
	}
	public function showMatch($matchId){
			$data = [];
			$sql = $this->DB->query("SELECT a.category,c.scoreType,a.division,a.matchType, a.matchId, b.leagueName, c.sportName,a.teamOne,a.teamTwo,a.scorePerSet,a.numSet, a.datetimeStart FROM tbl_match a INNER JOIN tbl_league b ON a.leagueId = b.leagueId INNER JOIN tbl_sports c ON a.sportId = c.sportId WHERE a.status != '0' AND matchId =".$matchId);
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
			return $data;
		}
	public function showLog($teamName,$matchId){
			$data = [];
			$sql = $this->DB->query("SELECT * FROM ".$this->table['matchlog']." WHERE  teamName = '".$teamName."' AND status != '0' AND matchId =".$matchId);
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
			return $data;
	}
	public function showTeams($matchId){
			$data = [];
			$sql = $this->DB->query("SELECT a.teamName FROM tbl_team a LEFT JOIN tbl_match b ON a.teamName = b.teamOne OR a.teamName = b.teamTwo WHERE b.matchId = ".$matchId." GROUP BY a.teamName");
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
			return $data;
	}
	public function showLeague($leagueId){
			$data = [];
			$sql = $this->DB->query("SELECT * FROM tbl_league a WHERE a.leagueId = ".$leagueId);
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
			return $data;
	}
}
?>