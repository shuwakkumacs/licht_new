<?php
	require("../../library/layout/header.php");
	require("../../library/include/MyDBClass_mysql.php");
	require("../../library/include/utils.php");
	
if( $_SESSION['supervisor'] == 0 ){

?>
<script src="../../library/js/administration/music_edit/title_config.js"></script>
<div id="main">
	
	<div id="pagetitle">
		<div class="left"><a href="./title_list.php">&lt;</a></div>
		<div class="center">参考音源設定</div>
		<div class="clear"></div>
	</div>
	<p class="heading">♪　曲を追加する</p>
	<hr class="heading">
	
	<form action="title_add.php" method="post" id="add">
	<input type="text" style="width:100%;" name="name" placeholder="曲名を入力" id="addname"/>
	<input type="submit" class="submit" value="登録" />
	</form>
	<br>
	
	<p class="heading">♪　曲を削除する</p>
	<hr class="heading">
	<form action="title_delete.php" method="post">
	<?php
		$db  = new MyDBClass_mysql();
		$sql = "SELECT * FROM music_titles;";
		$musicArray = $db->executeQuery( $sql );
		if( empty($musicArray) ){ ?>
			登録されている曲はありません。
		<?php
		}
		foreach( $musicArray as $music ){
			$sql_count = "SELECT COUNT(*) as count FROM music_urls WHERE title_id={$music['id']};";
			$count = $db->executeQuery( $sql_count );
			?>
			<div style="float:left; width:10%;"><input type="checkbox" name="id[]" value="<?php echo $music['id']; ?>" id="<?php echo $music['id']; ?>" /></div>
			<div style="float:left; width:90%;"><label for="<?php echo $music['id']; ?>"><?php echo $music['name']; ?>(<?php echo $count[0]['count']; ?>)</label></div>
			<div style="clear:both;"></div>
		<?php
		}
	?>
	<input type="button" value="削除" class="delete" onclick="if(confirm_delete()==true) submit();">
	</form>
	<span style="color:red;">※その曲の情報が全て消えます！！！</span>
	<br>
	※ボタンを押してから時間がかかることがあります<br>
</div>
	
<?php 
} ?>
</body>
</html>
