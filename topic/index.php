<?php
	include('../library/include/session_master.php');
	include('../library/include/MyDBClass_mysql.php');

	if( !isset($_GET['page']) ) $page = 0;
	else $page = $_GET['page']*10;
	
	$db = new MyDBClass_mysql();
	$sql = "SELECT id,name,subject,date FROM topic WHERE 1=1 ORDER BY date DESC LIMIT {$page},10;";
	$data = $db->executeQuery($sql);
?>
<html>
<head>
	<title>Topics</title>
	<meta content="width=320, minimum-scale=0.5, user-scalable=no" name="viewport" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" style="text/css" href="../library/css/base.css">
	<script type="text/javascript" src="../library/js/jquery-1.10.2.min.js"></script>
</head>
<body>
	
	<?php include('../library/layout/header.php'); ?>
	
	<div id="main">
		<div id="pagetitle">トピック</div>
		<div class="pagerbar">
			<?php
				if( $page!=0 ) { ?>
				<?php
					echo '<div class="navlink" style="float:left;">';
					echo '<a href="./index.php?page='.($_GET['page']-1).'"><< 新しい10件</a>&nbsp;&nbsp;';
					echo '</div>';
				} ?>
			<?php
				if( count($data)==10 ){
					echo '<div class="navlink" style="float:right;">';
					echo '<a href="./index.php?page='.($_GET['page']+1).'">古い10件 >></a>';
					echo '</div>';
				} ?>
			<div class="clear"></div>
		</div>
		<?php
			foreach($data as $datum){ ?>
				 - <a href="./thread.php?id=<?php echo $datum['id']; ?>"><?php echo $datum['subject']; ?></a> (<?php echo $datum['name']; ?>)
				<div style="text-align:right"><?php echo date('Y/m/d H:i', strtotime($datum['date'])); ?></div>
				<br>
		<?php } ?>
		<div class="pagerbar">
			<?php
				if( $page!=0 ) { ?>
				<?php
					echo '<div class="navlink" style="float:left;">';
					echo '<a href="./index.php?page='.($_GET['page']-1).'"><< 新しい10件</a>&nbsp;&nbsp;';
					echo '</div>';
				} ?>
			<?php
				if( count($data)==10 ){
					echo '<div class="navlink" style="float:right;">';
					echo '<a href="./index.php?page='.($_GET['page']+1).'">古い10件 >></a>';
					echo '</div>';
				} ?>
			<div class="clear"></div>
		</div>
	</div>
</body>
</html>
