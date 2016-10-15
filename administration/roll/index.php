<script src="../../library/js/administration/roll/index.js"></script>
<?php
	require("../../library/layout/header.php");
	require("../../library/include/MyDBClass_mysql.php");
	require("../../library/include/utils.php");
	
if( $_SESSION['supervisor'] == 0 ){

$yearNow  = date('Y');
$monthNow = date('m');
$dayNow   = date('d');

?>
<div id="main">
	
	<div id="pagetitle">
		<div class="left"><a href="../index.php">&lt;</a></div>
		<div class="center">練習日設定</div>
		<div class="clear"></div>
	</div>
	<p class="heading">♪　練習日を追加する</p>
	<hr class="heading">
	
	<form action="add.php" method="post">
	<div style="float:left;">
		<select name="year">
			<?php
			for( $year=$yearNow ; $year<=$yearNow+1 ; $year++){
				if( $year==$yearNow ) {
					echo '<option value="' . $year . '" selected>' . $year . '</option>';
				} else {
					echo '<option value="' . $year . '">' . $year . '</option>';
				}
			}
			?>
		</select>
	</div>
	<div style="float:left;">年　</div>
	<div style="float:left;">
		<select name="month">
			<?php
			for( $month=1 ; $month<=12 ; $month++){
				if( $month==$monthNow ) {
					echo '<option value="' . $month . '" selected>' . $month . '</option>';
				} else {
					echo '<option value="' . $month . '">' . $month . '</option>';
				}
			}
			?>
		</select>
	</div>
	<div style="float:left;">月　</div>
	<div style="float:left;">
		<select name="day">
			<?php
			for( $day=1 ; $day<=31 ; $day++){
				if( $day==$dayNow ) {
					echo '<option value="' . $day . '" selected>' . $day . '</option>';
				} else {
					echo '<option value="' . $day . '">' . $day . '</option>';
				}
			}
			?>
		</select>
	</div>
	<div style="float:left;">日　</div>
	<div class="clear"></div>
	開始時間
	<select name="time_start_hour">
		<?php  for( $hour=0; $hour<24; $hour++ ) printf('<option value="%02d">%02d</option>', $hour, $hour); ?>
	</select>
	:
	<select name="time_start_min">
		<?php  for( $min=0; $min<60; $min+=5 ) printf('<option value="%02d">%02d</option>', $min, $min); ?>
	</select>
	<br>
	終了時間
	<select name="time_end_hour">
		<?php  for( $hour=0; $hour<24; $hour++ ) printf('<option value="%02d">%02d</option>', $hour, $hour); ?>
	</select>
	:
	<select name="time_end_min">
		<?php  for( $min=0; $min<60; $min+=5 ) printf('<option value="%02d">%02d</option>', $min, $min); ?>
	</select>
	<br>
	練習場所<input type="text" name="place" />

	<input type="submit" value="追加" class="submit">
	</form>
	※曜日は自動的に設定されます<br>
	<br>
	
	<p class="heading">♪　練習日を削除する</p>
	<hr class="heading">
	<form action="delete.php" method="post">
	<?php
		$db  = new MyDBClass_mysql();
		$sql = "SELECT * FROM roll_date ORDER BY date ASC;";
		$rollDate = $db->executeQuery( $sql );
		if( empty($rollDate) ){ ?>
			登録されている練習日はありません。
		<?php
		}
		foreach( $rollDate as $val ){
			$dateStrDisp = dateStrToJapaneseFormat( $val['date'] );
			?>
			<div style="float:left; width:40px;"><input type="checkbox" name="date[]" value="<?php echo $val['date']; ?>" id="<?php echo $val['date']; ?>" /></div>
			<div style="float:left;">
				<label for="<?php echo $val['date']; ?>">
					<?php echo $dateStrDisp; ?><br>
					<?php echo substr($val['time_start'],0,-3)."〜".substr($val['time_end'],0,-3); ?><br>
					<?php echo "＠ {$val['place']}"; ?>
				</label>
			</div>
			<div style="clear:both;"></div>
		<?php
		}
	?>
	<input type="button" value="削除" class="delete" onclick="if(confirm_delete()==true) submit();">
	</form>
	<span style="color:red;">※その日付の全団員の出欠データも消えます！！！</span>
	<br>
	※ボタンを押してから時間がかかることがあります<br>
</div>
	
<?php 
} ?>
</body>
</html>
