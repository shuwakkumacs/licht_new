<?php 
	require('./library/layout/header.php');
	require('./library/include/MyDBClass_mysql.php');
	require('./library/include/utils.php');

	
	// For GET value convertion
	include('./library/include/unescape.php');
	
	/* -------- Functions -------- */
	function checkRadio($dateId, $roll){
		global $myDataHash;
		if( $myDataHash[$dateId]['attendance']==$roll || (!isset($myDataHash[$dateId]['attendance']) && $roll==1) ) return ' checked="checked"';
		else return '';
	}
	
	function checkComment($dateId){
		global $myDataHash;
		if($myDataHash[$dateId]['comment']!==null) return $myDataHash[$dateId]['comment'];
		else return '';
	}
	
	function checkDisability($date){
		$dateStamp = strtotime($date);
		if($dateStamp <= strtotime('-1 day')) return ' disabled="disabled"';
		else return '';
	}
	
	function checkBgcolor($i){
		if($i%2==0) return "background:#EFF2FC;";
	}
	
	function checkCoach($dateId){
		global $coachDataHash;
		if($coachDataHash[$dateId]==1) return 'コーチ合奏';
		else return '';
	}
	
	/* ------- MySQL --------- */
	$db = new MyDBClass_mysql();
	
	$sqlDate   = "SELECT * FROM roll_date ORDER BY date ASC;";
	$sqlMyRoll = "SELECT date_id,date,attendance,comment FROM roll_date LEFT JOIN roll ON roll_date.id=roll.date_id WHERE roll.user_id='{$_SESSION['id']}' ORDER BY date ASC;";
	$sqlCoach  = "SELECT date_id,attendance FROM roll WHERE user_id='49';";
	$sqlAttend = "SELECT concert_attendance FROM users WHERE id='{$_SESSION['id']}';";
	$dateArray      = $db->executeQuery( $sqlDate );
	$myRollData     = $db->executeQuery( $sqlMyRoll );
	$coachRollData  = $db->executeQuery( $sqlCoach );
	$attendanceData = $db->executeQuery( $sqlAttend );
	
	$coachDataHash = array();
	$myDataHash = array();
	foreach( $coachRollData as $val ){
		$coachDataHash[ $val['date_id'] ] = $val['attendance'];
	}
	foreach( $myRollData as $val ){
		$myDataHash[ $val['date_id'] ] =
			array(
				'attendance' => $val['attendance'],
				'comment'    => $val['comment']
			);
	}
	
?>
<link rel="stylesheet" style="text/css" href="./library/css/roll_call.css">
<script type="text/javascript" src="./library/js/roll_call.js"></script>

<div id="main">
	<div id="pagetitle">出欠登録</div>
	<div class="pagerbar">
		<div class="navlink" style="float:right; width:50%;">
			<a href="roll_list.php">団員の出欠を見る</a>
		</div>
		<div class="clear"></div>
	</div>
	<div id="inst">
		<span style="color:red;">
			<center>!!!!!徹底をお願いします!!!!!</center><br>
			出席->◯（備考記入不要）<br>
			遅刻->◯（備考に来る時間）<br>
			欠席->×（備考に欠席理由）<br>
			<br>
			<u>練習日直前の変更は<br>
			パートリーダーに伝えること！</u><br>
			<br>
			コーチ合奏予定は変更されることがあります<br>
		</span>
	</div>
	<br><br>
	<?php
	if( $attendanceData[0]['concert_attendance'] ){ ?>
	<form method="post" action="./add.php">
	<table id="daterows" cellspacing=0 cellpadding=0>
		<tr><td style="width:30%; text-align:right"></td><td style="width:70%">
		<?php echo $_SESSION['name']; ?> さんの出欠
		</td></tr>
		<tr><td style="height:30px;"></td><td></td></tr>
		<?php 
		$i=0;
		foreach($dateArray as $val){
			$timeStamp   = strtotime( $val['date'] );
			$day2 = date( 'w', $timeStamp );
			$dateStrDisp = date( "m/d（{$days[$day2]}）", $timeStamp );
			?>
			<tr style="<?php echo checkBgcolor($i); ?>">
				<td style="width:35%; text-align:right; font-size:0.8em;">
					<?php echo $dateStrDisp; ?>
					<br>
					<?php echo substr($val['time_start'],0,-3)."〜".substr($val['time_end'],0,-3); ?>
					<br>
					<?php echo "＠ {$val['place']}"; ?>
				</td>
				<td style="width:65%">
					<div style="width:100%;"></div>
					<div style="float:left; width:30px;"><input type="radio" value="1" name="<?php echo "attendance_{$val['id']}"; ?>"<?php echo checkRadio($val['id'],"1"); echo checkDisability($val['date']); ?>></div>
					<div style="float:left; width:50px;">○</div>
					<div style="float:left; width:30px;"><input type="radio" value="0" name="<?php echo "attendance_{$val['id']}"; ?>"<?php echo checkRadio($val['id'],"0"); echo checkDisability($val['date']); ?>></div>
					<div style="float:left; width:50px;">×</div>
					<div style="clear:both">
				</td>
			</tr>
			<tr style="<?php echo checkBgcolor($i); ?>">
				<td style="text-align:right">備考</td>
				<td><input type="text" name="<?php echo "comment_{$val['id']}"; ?>" value="<?php echo checkComment( $val['id'] ); ?>"<?php echo checkDisability( $val['date'] ); ?>></td>
			</tr>
			<?php $i++;
		}
		?>
	</table>
	<input type="submit" class="submit" value="登録" style="margin-top:30px;" onclick="return confirm_name();">
	</form>
	<br>
	<?php
	} else {
	echo $attendanceData['concert_attendance'];
	?>
	乗り番の設定がされていないため、登録できません。幹部にお問い合わせ下さい。
	<?php
	}
	?>
</div>
</body>
</html>
