<?php
	require('../../library/include/MyDBClass_mysql.php');
	require('../../library/include/utils.php');
	$db = new MyDBClass_mysql();

	if($_POST['username']=="") {
		echo "<span style='color:red;'>ユーザー名を入力して下さい</span>";
		die('');
	}
	$sql="SELECT * FROM `users` WHERE `username`='{$_POST['username']}';";
	$res=$db->executeQuery($sql);
	if(empty($res)) echo "";
	else echo "<span style='color:red;'>既に使われているユーザー名です</span>";
