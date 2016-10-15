<style type="text/css">
input, select {
	border:solid 1px #ccc;
	font-size:1.0em;
}
</style>
<?php
	require('./library/layout/header.php');
	require('./library/include/MyDBClass_mysql.php');
	require('./library/include/utils.php');
	$db = new MyDBClass_mysql();
	$sqlDate = "SELECT * FROM roll_date ORDER BY date ASC;";
	$dateArray = $db->executeQuery( $sqlDate );
	
	/* --------- Functions --------- */
	function getNearestDateId( $dateArray ){
		$nearestDateId = '';
		foreach( $dateArray as $val ){
			if( strtotime( $val['date'] . "+1 day" ) > strtotime( "now" ) ){
				$nearestDateId = $val['id'];
				break;
			}
		}
		return $nearestDateId;
	}
	
	function checkBgcolor($i){
		if($i%2==0) return "background:#EFF2FC;";
	}
	/* ----------------------------- */
	
	/* 人数累計の初期化 */
	$totalNum = 0;
	$partNum = array();
	$parts = array('Cond.', 'Fl.', 'Ob.', 'Cl.', 'Sax.', 'Trp.', 'Hrn.', 'Trb.', 'Bass.', 'Perc.' );
	for( $i=0; $i<10; $i++ ){ $partNum[$i] = 0; }
	
	/* 日にち指定がなければ次回練習日を表示 */
	if(!isset($_GET['date'])){
		$nearestDateId = getNearestDateId( $dateArray );
		
		$_GET['date'] = $nearestDateId;
	}
	$sqlRoll = "
		SELECT R.id,part_id,name_kanji,attendance,comment FROM users as U
		LEFT JOIN ( SELECT * FROM roll WHERE date_id='{$_GET['date']}' ) as R ON R.user_id=U.id
		WHERE U.concert_attendance=1
		ORDER BY U.part_id ASC;
		";

	$rollData = $db->executeQuery( $sqlRoll );

	$roll[0]='<span style="color:blue;">×</span>';
	$roll[1]='<span style="color:red;">◯</span>';
	$roll[2]='-';
?>

<div id="main">
	<div id="pagetitle">出欠状況</div>
	<div class="pagerbar">
		<div class="navlink" style="float:right">
			<a href="roll_call.php">出欠登録をする</a>
		</div>
		<div class="clear"></div>
	</div>
	<form method="get" action="./roll_list.php">
	<select name="date" style="width:100%;">
	<?php
	foreach($dateArray as $val){ ?>
		<option value="<?php echo $val['id']; ?>" <?php if($val['id']==$_GET['date']) echo 'selected'; ?>>
			<?php echo dateStrToJapaneseFormat( $val['date'] )." ".substr($val['time_start'],0,-3)."〜".substr($val['time_end'],0,-3); ?>
		</option>
		<?php
	} ?>
	</select>
	<input type="submit" value="出席状況確認" class="submit">
	<br><br>
	<span style="color:red;">
	<?php
		//$coach=$datas->fetch_assoc();
		//if($coach[$_GET['date']]==1) echo "コーチ合奏日";
	?>
	</span>
	<br><br>
	
	<table style="width:100%;" cellspacing=0 cellpadding=0>
	<?php
		$i=0;
		foreach( $rollData as $val ){
			?>
			<tr style="<?php echo checkBgcolor($i); ?>">
				<td style="width:40%; text-align:right; padding:3px;">
					<?php echo "{$val['name_kanji']}({$parts[ $val['part_id'] ]})"; ?>:
				</td>
				<td>
					<?php echo $roll[ ( $val['attendance'] !=NULL ? $val['attendance'] : 2 ) ]; ?>　<?php echo $val['comment']; ?>
				</td>
			</tr>
			<?php if( $val['attendance']==1 && $val['part_id']!=0 ){ $partNum[ $val['part_id'] ]++; $totalNum++;} ?>
		<?php
		$i++;
		} ?>
	</table>
	<br>
	<div style="text-align:center; width:100%;">
		パート累計<br>
		<?php for( $i=1; $i<10; $i++){
				echo "{$parts[$i]} {$partNum[$i]}人<br>";
			}
			echo "合計 {$totalNum}人"; 
		?>
	</div>
</div>
</body>
</html>

