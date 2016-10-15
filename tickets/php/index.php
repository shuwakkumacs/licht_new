<?php
	$mysqli = new mysqli('localhost', 'root', 'iseebi3014', 'licht') or die('fuck');	
	$sql="SELECT num,name_kanji from tickets AS t LEFT JOIN users AS u ON t.user_id=u.id WHERE t.user_id<>-1 ORDER BY num DESC;";
	$datas = $mysqli->query($sql);
	$total = 0;
	while($data=$datas->fetch_assoc()){
		$member[] = $data['name_kanji'];
		$ticketnum[] = $data['num'];
		$total += $data['num'];
	}
	
	$rank = 0;
	$buf  = 1;


	function checkBgcolor($i){
		if($i%2==0) return "background:#EFF2FC;";
	}
	function checkRank($rank){
		switch($rank){
			case 1:
				return " color:red; font-size:1.3em;";
			case 2:
				return " color:orange; font-size:1.2em;";
			case 3:
				return " color:#BCC400; font-size:1.1em;";
			default:
				return "";
		}
	}
?>
