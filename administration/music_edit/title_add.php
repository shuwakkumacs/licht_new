<?php
	require("../../library/layout/header.php");
	require("../../library/include/MyDBClass_mysql.php");
	require("../../library/include/utils.php");

if( $_SESSION['supervisor'] == 0 ){

$name   = $_POST['name'];
?>
	
<div id="main">
	<div id="pagetitle">参考音源設定</div>
	<?php
		$db  = new MyDBClass_mysql();
		$sql = "INSERT INTO music_titles VALUES ('', '{$name}');";
		$db->executeQuery( $sql );
		?>
		以下の曲を追加しました：<br><br>
		<?php echo $name; ?><br><br>
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
