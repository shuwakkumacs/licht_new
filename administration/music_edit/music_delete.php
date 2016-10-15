<?php
	require("../../library/layout/header.php");
	require("../../library/include/MyDBClass_mysql.php");
	require("../../library/include/utils.php");

if( $_SESSION['supervisor'] == 0 ){

?>
	
<div id="main">
	<div id="pagetitle">練習日設定</div>
		以下の曲を削除しました：<br><br>
		<?php
		$db = new MyDBClass_mysql();
		foreach( $_POST['id'] as $id ){
			$musicName = $db->executeQuery("SELECT name,url FROM music_urls WHERE id='{$id}'");
			$db->executeQuery("DELETE FROM music_urls WHERE id='{$id}';");
			
			echo "{$musicName[0]['name']}<br>";
		}
		?>
		<br><br>
	<div class="pagerbar">
		<div class="navlink"><a href="./title_list.php"><< 参考音源設定</a></div>
	</div>
	<div class="pagerbar">
		<div class="navlink"><a href="../index.php"><< 管理トップ</a></div>
	</div>
</div>
	
<?php 
} ?>
</body>
</html>
