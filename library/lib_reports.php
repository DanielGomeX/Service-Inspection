<?php 
	class lib_reports extends Config {
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
	public function reportDropdown($reportType, $id1 = "", $id2 = ""){
		$data = [];		
		switch ($reportType) {
			case 'match':
				$matchData = [ ":leagueId" => $id1,":sportId"=> $id2];
				$sql= $this->DB->prepare("SELECT * FROM ".$this->table['match']." WHERE leagueId = :leagueId AND sportId = :sportId ");
				$sql->execute($matchData);
			break;
			case 'sport':
				if($id2 == ""){
					$sportData = [ ":leagueId" => $id1];
					$sql= $this->DB->prepare("SELECT DISTINCT a.sportId, a.sportName,c.leagueName FROM tbl_sports a INNER JOIN tbl_match b ON a.sportId = b.sportId INNER JOIN tbl_league c ON b.leagueId = c.leagueId WHERE b.leagueId = :leagueId AND b.status != '0' ");
				}else{
				$sportData = [ 	":leagueId" => $id1,
						":sportId" => $id2
					];
				$sql= $this->DB->prepare("SELECT DISTINCT a.sportId, a.sportName,c.leagueName FROM tbl_sports a INNER JOIN tbl_match b ON a.sportId = b.sportId INNER JOIN tbl_league c ON b.leagueId = c.leagueId WHERE b.leagueId = :leagueId AND a.sportId = :sportId AND b.status != '0' ");
				}
				$sql->execute($sportData);
			break;
			default:break;
		}
		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
		$data[] = $row; }
		return $data;
	}
	public function reportMain($type,$attr,$id1,$id2=""){
		$data = [];
		switch ($type) {
			case 'match':
				foreach($this->DB->query('SELECT a.numSet FROM tbl_match a WHERE a.matchId ='.$id1) as $row)
				$numSet = $row['numSet'];
				$set =[""];
 				$set1Ctr = 2;
				for ($j=1; $j <= $numSet; $j++,$set1Ctr++) { 
					switch ($attr) {
						case 'elaborate':
						$set[0] .= ",(SELECT SUM(c.teamScore) FROM tbl_matchlog c WHERE c.teamName = a.teamName AND  c.matchId = ".$id1." AND c.setNo = ".$j.") AS '".$set1Ctr."' ";
						break;
						case 'simple':
						default:
						$set[0] .= ",(CASE
		 				WHEN (SELECT SUM(c.teamScore) FROM tbl_matchlog c WHERE c.teamName = a.teamName AND  c.matchId = ".$id1." AND c.setNo = ".$j.") > ALL(SELECT SUM(c.teamScore) FROM tbl_matchlog c WHERE c.teamName != a.teamName AND  c.matchId = ".$id1." AND c.setNo = ".$j.") THEN 'WIN' 
		 				WHEN (SELECT SUM(c.teamScore) FROM tbl_matchlog c WHERE c.teamName = a.teamName AND  c.matchId = ".$id1." AND c.setNo = ".$j.") < ALL(SELECT SUM(c.teamScore) FROM tbl_matchlog c WHERE c.teamName != a.teamName AND  c.matchId = ".$id1." AND c.setNo = ".$j.") THEN 'LOSE' ELSE 'WIN' END) AS '".$set1Ctr."' ";
							break;
					}
				}
				$query = "SELECT DISTINCT a.teamName AS '0', (SELECT SUM(c.teamScore) FROM tbl_matchlog c WHERE c.teamName = a.teamName AND  c.matchId = ".$id1."), (CASE WHEN a.teamName = b.teamOne THEN b.scoreOne ELSE b.scoreTwo END ) AS '1' ".$set[0]." FROM tbl_team a RIGHT JOIN tbl_match b ON a.teamName = b.teamOne OR a.teamName = b.teamTwo INNER JOIN tbl_matchlog c ON b.matchId = c.matchId WHERE  a.status != '0' AND b.matchId =".$id1;
				$sql = $this->DB->query($query);
			break;
			case 'league':
 				$set0Ctr = 3; $set1Ctr = 4;
				$set =["",""];
				$sum =["",""];
 				for ($j=1; $j <= $id2; $j++,$set0Ctr+=2,$set1Ctr+=2) { 
					$set[0] .= ",SUM(CASE WHEN a.teamOne = b.teamName AND a.roundType = 'Championship' AND e.sportId = ".$j." THEN CASE WHEN a.scoreOne > a.scoreTwo THEN 1 ELSE 0 END WHEN a.teamTwo = b.teamName AND a.roundType = 'Championship' AND e.sportId = ".$j." THEN CASE WHEN a.scoreOne < a.scoreTwo THEN 1 ELSE 0 END ELSE 0 END) AS '".$set0Ctr."' ";
					$set[1] .= ",SUM(CASE WHEN a.teamOne = b.teamName AND a.roundType = 'Elimination' AND e.sportId = ".$j." THEN CASE WHEN a.scoreOne > a.scoreTwo THEN 1 ELSE 0 END WHEN a.teamTwo = b.teamName AND a.roundType = 'Elimination' AND e.sportId = ".$j." THEN CASE WHEN a.scoreOne < a.scoreTwo THEN 1 ELSE 0 END ELSE 0 END) AS '".$set1Ctr."' ";
					$sum[0] .= "SUM(CASE WHEN a.teamOne = b.teamName AND a.roundType = 'Championship' AND e.sportId = ".$j." THEN CASE WHEN a.scoreOne > a.scoreTwo THEN 1 ELSE 0 END WHEN a.teamTwo = b.teamName AND a.roundType = 'Championship' AND e.sportId = ".$j." THEN CASE WHEN a.scoreOne < a.scoreTwo THEN 1 ELSE 0 END ELSE 0 END)";
					$sum[1] .= "SUM(CASE WHEN a.teamOne = b.teamName AND a.roundType = 'Elimination' AND e.sportId = ".$j." THEN CASE WHEN a.scoreOne > a.scoreTwo THEN 1 ELSE 0 END WHEN a.teamTwo = b.teamName AND a.roundType = 'Elimination' AND e.sportId = ".$j." THEN CASE WHEN a.scoreOne < a.scoreTwo THEN 1 ELSE 0 END ELSE 0 END)";
					$sum[0].=($j != $id2)? "+":"";
					$sum[1].=($j != $id2)? "+":"";

					
				}
				$sql = $this->DB->query('SELECT * FROM (
					         SELECT b.teamName AS "0",
					          ('.$sum[0].') AS "1",('.$sum[1].') AS "2"
					          '.$set[0].$set[1].' FROM tbl_match a 
						    INNER JOIN tbl_team b ON a.teamOne = b.teamName OR a.teamTwo = b.teamName 
						    INNER JOIN tbl_league d ON a.leagueId = d.leagueId 
						    INNER JOIN tbl_sports e ON a.sportId = e.sportId
						    WHERE a.status != "0"
						    GROUP BY b.teamName
						) AS t1 ORDER BY 1 DESC, 2 DESC
					');
			break;
			case 'sport':
				$sql = $this->DB->query("SELECT a.teamName '0',
						SUM(CASE 
						    WHEN b.teamOne = a.teamName AND b.roundType = 'Championship' AND d.sportId = $id1 THEN CASE WHEN b.scoreOne > b.scoreTwo THEN 1 ELSE 0 END 
						    WHEN b.teamTwo = a.teamName AND b.roundType = 'Championship' AND d.sportId = $id1 THEN CASE WHEN b.scoreOne < b.scoreTwo THEN 1 ELSE 0 END
						   ELSE 0 END) AS '1',
						SUM(CASE 
						    WHEN b.teamOne = a.teamName AND b.roundType = 'Championship' AND d.sportId = $id1 THEN CASE WHEN b.scoreOne < b.scoreTwo THEN 1 ELSE 0 END 
						    WHEN b.teamTwo = a.teamName AND b.roundType = 'Championship' AND d.sportId = $id1 THEN CASE WHEN b.scoreOne > b.scoreTwo THEN 1 ELSE 0 END
						   ELSE 0 END) AS '2',
						SUM(CASE 
						    WHEN b.teamOne = a.teamName AND b.roundType = 'Elimination' AND d.sportId = $id1 THEN CASE WHEN b.scoreOne > b.scoreTwo THEN 1 ELSE 0 END 
						    WHEN b.teamTwo = a.teamName AND b.roundType = 'Elimination' AND d.sportId = $id1 THEN CASE WHEN b.scoreOne < b.scoreTwo THEN 1 ELSE 0 END
						   ELSE 0 END) AS '3',
						SUM(CASE 
						    WHEN b.teamOne = a.teamName AND b.roundType = 'Elimination' AND d.sportId = $id1 THEN CASE WHEN b.scoreOne < b.scoreTwo THEN 1 ELSE 0 END 
						    WHEN b.teamTwo = a.teamName AND b.roundType = 'Elimination' AND d.sportId = $id1 THEN CASE WHEN b.scoreOne > b.scoreTwo THEN 1 ELSE 0 END
						   ELSE 0 END) AS '4'
						FROM tbl_team a INNER JOIN tbl_match b ON a.teamName = b.teamOne OR  a.teamName = b.teamTwo INNER JOIN tbl_league c ON b.leagueId = c.leagueId INNER JOIN tbl_sports d ON b.sportId = d.sportId WHERE c.leagueId = ".$id2." AND b.status != '0' GROUP BY a.teamName 
						ORDER BY SUM(CASE 
						    WHEN b.teamOne = a.teamName AND b.roundType = 'Championship' THEN CASE WHEN b.scoreOne > b.scoreTwo THEN 1 ELSE 0 END 
						    WHEN b.teamTwo = a.teamName AND b.roundType = 'Championship' THEN CASE WHEN b.scoreOne < b.scoreTwo THEN 1 ELSE 0 END
						   ELSE 0 END) DESC,
						   SUM(CASE 
						    WHEN b.teamOne = a.teamName AND b.roundType = 'Elimination' THEN CASE WHEN b.scoreOne < b.scoreTwo THEN 1 ELSE 0 END 
						    WHEN b.teamTwo = a.teamName AND b.roundType = 'Elimination' THEN CASE WHEN b.scoreOne > b.scoreTwo THEN 1 ELSE 0 END
						   ELSE 0 END) DESC");
						break;
						default:break;
						}
						while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
						return $data;
					}
					public function reportSummary($type){
						$data = [];
							switch ($type) {
								case 'user':
									$sql = $this->DB->query("SELECT username AS '0', CONCAT(lastName,', ',firstName) AS '1',middleName AS '2',email AS '3',gender AS '4', role AS '5' FROM ".$this->table['user']." WHERE status = '1' ");
									break;
								case 'sports':
									$sql = $this->DB->query("SELECT sportName AS '0', scorePerSet AS '1',numSet AS '2',description AS '3' FROM ".$this->table['sport']." WHERE status = '1' ");
									break;
								case 'teams':
									$sql = $this->DB->query("SELECT teamName AS '0', shortCode AS '1',description AS '2' FROM ".$this->table['team']." WHERE status = '1' ");
									break;
								case 'leagues':
									$sql = $this->DB->query("SELECT leagueName AS '0', venue AS '1',description AS '2' FROM ".$this->table['league']." WHERE status = '1' ");
									break;
								case 'matches':
									$sql = $this->DB->query("SELECT a.category AS '8', a.matchId, b.leagueName AS '5', c.sportName AS '2',a.teamOne AS '0',(SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamOne AND matchId = a.matchId AND status = '1' ) AS '6', a.teamTwo  AS '1',(SELECT SUM(teamScore) FROM tbl_matchlog WHERE teamName = a.teamTwo AND matchId = a.matchId AND status = '1' ) AS '7',a.scorePerSet,a.numSet, a.datetimeStart AS '4',a.division AS '3' FROM tbl_match a INNER JOIN tbl_league b ON a.leagueId = b.leagueId INNER JOIN tbl_sports c ON a.sportId = c.sportId WHERE a.status != '0'");

									break;
								default:break;
							}
							while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $data[] = $row; 
							return $data;
							}
					}
?>