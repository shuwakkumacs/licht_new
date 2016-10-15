<?php 
	
	require('./library/layout/header.php');
	require('./library/include/MyDBClass_mysql.php');
	
	$db = new MyDBClass_mysql();
	$sqlDate   = "SELECT * FROM roll_date ORDER BY date ASC;";
	$sqlMyRoll = "SELECT date_id,attendance,comment FROM roll_date LEFT JOIN roll ON roll_date.id=roll.date_id WHERE roll.user_id='{$_SESSION['id']}' ORDER BY date ASC;";
	$dateArray  = $db->executeQuery( $sqlDate );
	$myRollData = $db->executeQuery( $sqlMyRoll );
	
	$myDataHash = array();
	foreach( $myRollData as $val ){
		$myDataHash[ $val['date_id'] ] =
			array(
				'attendance' => $val['attendance'],
				'comment'    => $val['comment']
			);
	}
	$myOld = $myDataHash;
	
	
	$myNew = array();  
	$sqlUpdate = array();
	$sqlInsert = array();
	foreach($dateArray as $val){
		$aIndex = "attendance_{$val['id']}";
		$cIndex = "comment_{$val['id']}";
		$attendance = $_POST[$aIndex];
		$comment    = $_POST[$cIndex];
		
		$myNew[ $val['id'] ] =
			array(
				'attendance' => $attendance,
				'comment'    => $comment
			);
			
		if( isset($myDataHash[ $val['id'] ]) ){
			$sqlUpdate[] = "UPDATE roll SET attendance='{$attendance}', comment='{$comment}' WHERE user_id='{$_SESSION['id']}' AND date_id='{$val['id']}';";
		} else {
			$sqlInsert[] = "INSERT INTO roll VALUES ('','{$_SESSION['id']}','{$val['id']}','{$attendance}','{$comment}');";
		}
	}
	foreach( $sqlUpdate as $sql ){ $db->executeQuery( $sql ); }
	foreach( $sqlInsert as $sql ){ $db->executeQuery( $sql ); }
	
	
	$flgLog = 0;
	$logXML = "<logdata>\n";
	foreach($myOld as $key => $val){
		foreach($val as $key2 => $val2){
			if( $myOld[$key][$key2] != $myNew[$key][$key2] && $key2 != "date_id" && isset($myNew[$key][$key2]) ){
				if( $myOld[$key][$key2]=="" ) $myOld[$key][$key2]="(none)";
				if( $myNew[$key][$key2]=="" ) $myNew[$key][$key2]="(none)";
				
				$logXML .= "\t<modification>\n\t\t<date>{$key}</date>\n\t\t<type>{$key2}</type>\n\t\t<old>{$myOld[$key][$key2]}</old>\n\t\t<new>{$myNew[$key][$key2]}</new>\n\t</modification>\n";
				$flgLog = 1;
			}
		}
	}
	$logXML .= "</logdata>\n";

	if( $flgLog == 1 ){
		$dateTime = date("Y-m-d H:i:s");
		echo $dateTime;
		$sqlLog = "INSERT INTO log_roll_modify VALUES ('','{$_SESSION['id']}','{$logXML}','{$dateTime}');";
		$db->executeQuery( $sqlLog );
	}

?>
	<div id="main">
		<pre>
		</pre>
		登録処理を行いました：<br>
		<a href="./roll_list.php">団員の出欠を見る</a><br>
		<a href="./roll_call.php">出欠登録をする</a>
	</div>
	
</body>
</html>
