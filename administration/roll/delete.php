<?php
	require("../../library/layout/header.php");
	require("../../library/include/MyDBClass_mysql.php");
	require("../../library/include/utils.php");

if( $_SESSION['supervisor'] == 0 ){

?>
	
<div id="main">
	<div id="pagetitle">練習日設定</div>
		以下の日付を削除しました：<br><br>
		<?php
		$db = new MyDBClass_mysql();
		foreach( $_POST['date'] as $dateStr ){
			$db->executeQuery("DELETE FROM roll_date WHERE date='{$dateStr}';");
			
			$dateStrDisp  = dateStrToJapaneseFormat( $dateStr );
			echo "{$dateStrDisp}<br>";
		}
		?>
		<br><br>
	<a href="./index.php">練習日設定へ戻る</a><br>
	<a href="../index.php">管理トップへ戻る</a>
</div>
	
<?php 
} ?>
</body>
</html>
