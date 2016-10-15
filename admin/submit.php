<?php
	
	$partName = array(
		'Cond.',
		'Fl.',
		'Ob.',
		'Cl.',
		'Sax.',
		'Trp.',
		'Hrn.',
		'Trb.',
		'Bass.',
		'Perc.'
	);

	require("../library/include/MyDBClass_mysql.php");
	require("../library/include/utils.php");
	$db = new MyDBClass_mysql();
	$sql = "SELECT * FROM temp_users WHERE `temp_rand`='{$_GET['q']}';";
	$result = $db->executeQuery($sql);
	
	require("../library/layout/header.php");
?>
<div id="main">
<?php
	if( empty($result) ){ ?>
		不正なパラメータのため本登録に失敗しました。管理者に問い合わせてください。
<?php } else {
		$sqlSelect = "SELECT * FROM users WHERE `name_kanji`='{$result[0]['name_kanji']}';";
		$existentUserData = $db->executeQuery($sqlSelect);
		
		if( !empty( $existentUserData ) ){
			$sqlUpdate = "UPDATE users SET `username`='{$result[0]['username']}', `password`='{$result[0]['password']}' WHERE `name_kanji`='{$result[0]['name_kanji']}';";
		}
		else {
			$sqlUpdate = "INSERT INTO users (`part`, `part_id`, `name_kanji`, `name_kana`, `email`, `username`, `password`) VALUES ('{$partName[$result[0]['part_id']]}','{$result[0]['part_id']}', '{$result[0]['name_kanji']}', '{$result[0]['name_kana']}', '{$result[0]['email']}', '{$result[0]['username']}', '{$result[0]['password']}');";
		}
		
		$sqlDelete = "DELETE FROM temp_users WHERE `temp_rand`='{$_GET['q']}';";
		$db->executeQuery($sqlUpdate);
		$db->executeQuery($sqlDelete); ?>
		本登録が完了しました。
<?php } ?>
		<br><br>
		<a href="login.php">ログインする</a>
</div>
</body>
</html>
