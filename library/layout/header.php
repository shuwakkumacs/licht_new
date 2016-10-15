<?php
	$home = "http://lichtportal.biz/sp/";
	$dirName = explode("/var/www/html/licht/", dirname(__FILE__));
	$absPath = "http://lichtportal.biz/". $dirName[1]. "/";
	
	
	/* ログインなしでも入れるページの判別 */
	function pageCheck(){
		$currentPage = explode("lichtportal.biz/sp/", $_SERVER['SCRIPT_NAME']);
		$invalidPages = array(
			'/sp/admin/login.php',
			'/sp/admin/signup/signup.php',
			'/sp/admin/signup/confirm.php',
			'/sp/admin/submit.php'
		);
		$isValid = true;
		foreach($invalidPages as $page){
			if( $page == $currentPage[0] ) {
				$isValid = false;
				break;
			}
		}
		return $isValid;
	}
	if( pageCheck() ){
		require_once(dirname(__FILE__). '/../include/session_master.php');
	}
	
?>
<html>

<head>
	<title>LichtPortal</title>
	<meta content="width=320, minimum-scale=0.5, user-scalable=no" name="viewport" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" style="text/css" href="<?php echo $home; ?>/library/css/base.css">
	<script type="text/javascript" src="<?php echo $home; ?>/library/js/jquery-1.10.2.min.js"></script>
	<link rel="shortcut icon" href="./img/icon1.png">
	<link rel="apple-touch-icon-precomposed" href="./img/icon1.png">
</head>
<body>

<link rel="stylesheet" type="text/css" href="<?php echo $home; ?>/library/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo $home; ?>/library/css/header.css">
<script src="<?php echo $home; ?>/library/js/menu.js" language="javascript"></script>
<div id="header">
<div class="title" style="float:left"><p><a href="<?php echo $home; ?>" style="color:#fff; text-decoration:none">楽団リヒトポータルサイト</a></p></div>
<?php if(isset($_SESSION['id'])){ ?>
<div class="menulink" style="float:right"><p>MENU</p></div>
<?php } ?>
<div style="clear:both;"></div>
</div>
<ul class="menubar">
	<li onclick="javascript:go2link('<?php echo $home; ?>','index.php');"><p>トップページ</p></li>
	<?php
	if( $_SESSION['supervisor'] == 0 ){ ?>
		<li onclick="javascript:go2link('<?php echo $home; ?>','administration/index.php');" style="background:#f66;"><p>管理者モード</p></li>
	<?php
	} ?>
	<li onclick="javascript:go2link('<?php echo $home; ?>','ref/musics.php');"><p>音源視聴</p></li>
	<li class="slide"> <p>練習情報</p>
		<ul>
			<li onclick="javascript:go2link('<?php echo $home; ?>','users/index.php');"><p>団員情報</p></li>
			<li onclick="javascript:go2link('<?php echo $home; ?>','roll_call.php');"><p>出欠登録</p></li>
			<li onclick="javascript:go2link('<?php echo $home; ?>','roll_list.php');"><p>出欠状況</p></li>
		</ul>
	</li>
	<li class="slide"> <p>トピック</p>
		<ul>
			<li onclick="javascript:go2link('<?php echo $home; ?>','topic/send_mail.php');"><p>トピック投稿</p></li>
			<li onclick="javascript:go2link('<?php echo $home; ?>','topic/index.php');"><p>トピック一覧</p></li>
		</ul>
	</li>
	<li onclick="javascript:go2link('<?php echo $home; ?>','edit_profile.php');"><p>ユーザー情報</p></li>
	<li onclick="javascript:go2link('<?php echo $home; ?>','admin/logout.php');"><p>ログアウト</p></li>
	<?php /*
	<li><p>aiueo</p></li>
	<li><p>aiueo</p></li>
	*/ ?>
</ul>
</div>

