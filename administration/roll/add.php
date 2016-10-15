<?php
	require("../../library/layout/header.php");
	require("../../library/include/MyDBClass_mysql.php");
	require("../../library/include/utils.php");

if( $_SESSION['supervisor'] == 0 ){

$year  = $_POST['year'];
$month = $_POST['month'];
$day   = $_POST['day'];
$time_start_hour = $_POST['time_start_hour'];
$time_start_min  = $_POST['time_start_min'];
$time_end_hour   = $_POST['time_end_hour'];
$time_end_min    = $_POST['time_end_min'];
$place = $_POST['place'];

$dateStr = "{$year}-{$month}-{$day}";
$dateStrReg  = date( 'Y-m-d', strtotime( $dateStr ));

$timeStartStr = "{$time_start_hour}:{$time_start_min}:00";
$timeEndStr   = "{$time_end_hour}:{$time_end_min}:00";
?>
	
<div id="main">
	<div id="pagetitle">練習日設定</div>
	<?php
	if( checkdate( $month, $day, $year ) ){
		$db  = new MyDBClass_mysql();
		$sql = "INSERT INTO roll_date VALUES ('', '{$dateStrReg}', '{$timeStartStr}', '{$timeEndStr}', '{$place}');";
		$db->executeQuery( $sql );
		?>
		以下の日付を追加しました：<br><br>
		<?php echo dateStrToJapaneseFormat( $dateStrReg ); ?><br>
		<?php echo "{$time_start_hour}:{$time_start_min}〜{$time_end_hour}:{$time_end_min}"; ?><br>
		<?php echo "＠ {$place}"; ?>
		<br><br>
	<?php
	} else {
	?>
		<span style="color:red;">存在しない無効な日付です</span><br><br>
	<?php
	}
	?>
	<a href="./index.php">練習日設定へ戻る</a><br>
	<a href="../index.php">管理トップへ戻る</a>
</div>
	
<?php 
} ?>
</body>
</html>
