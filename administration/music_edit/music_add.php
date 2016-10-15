<?php
	require("../../library/layout/header.php");
	require("../../library/include/MyDBClass_mysql.php");
	require("../../library/include/utils.php");

if( $_SESSION['supervisor'] == 0 ){

$titleId = $_POST['titleId'];
$name    = $_POST['name'];
$url     = $_POST['url'];
?>
	
<div id="main">
	<div id="pagetitle">参考音源設定</div>
	<?php
		$db  = new MyDBClass_mysql();
		$sql = "INSERT INTO music_urls VALUES ('', '{$titleId}', '{$name}', '{$url}');";
		$db->executeQuery( $sql );
		?>
		以下のリンクを追加しました：<br><br>
		<?php echo $name; ?>(<?php echo $url; ?>)<br><br>
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
