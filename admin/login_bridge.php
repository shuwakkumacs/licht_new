<?php
	require("../library/include/MyDBClass_mysql.php");
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$db = new MyDBClass_mysql();
	$sql = "SELECT * FROM users WHERE `username`='{$username}' AND `password`='{$password}';";
	$result = $db->executeQuery($sql);

	if( empty($result) ){
		header("Location: ./login.php?err=1");
	}
	if( strpos($username, '(') !== false || strpos($username, ' ') !== false ){
		header("Location: ./login.php?err=2");
	}
	
	session_start();
	$_SESSION['id'] = $result[0]['id'];
	$_SESSION['name'] = $result[0]['name_kanji'];
	$_SESSION['supervisor'] = $result[0]['supervisor'];
	header("Location: ../index.php");
