<?php
	$dirName = explode("/var/www/html/licht/", dirname(__FILE__));
	$absPath = "http://lichtportal.biz/". $dirName[1]. "/";
	
	session_start();
	if(!isset($_SESSION['id'])) {
		session_destroy();
		header('Location: '. $absPath. '../../admin/login.php');
	}
	?>
