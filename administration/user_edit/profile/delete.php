<?php
	require("../../../library/layout/header.php");
	require("../../../library/include/MyDBClass_mysql.php");
	require("../../../library/include/utils.php");

if( $_SESSION['supervisor'] == 0 ){

?>
	
<div id="main">
	<div id="pagetitle">プロフィール編集</div>
		ユーザーを削除しました<br><br>
		<?php
		$db = new MyDBClass_mysql();
		$data = $db->executeQuery("SELECT * FROM `users` WHERE id='{$_GET['id']}';");
		$db->executeQuery("INSERT INTO `users_out` (part,part_id,name_kanji,name_kana,email,zipcode,address) VALUES('{$data[0]['part']}','{$data[0]['part_id']}','{$data[0]['name_kanji']}','{$data[0]['name_kana']}','{$data[0]['email']}','{$data[0]['zipcode']}','{$data[0]['address']}');");
		$db->executeQuery("DELETE FROM `users` WHERE id='{$_GET['id']}';");
		?>
		<br><br>
	<a href="./index.php">練習日設定へ戻る</a><br>
	<a href="../index.php">管理トップへ戻る</a>
</div>
	
<?php 
} ?>
</body>
</html>
