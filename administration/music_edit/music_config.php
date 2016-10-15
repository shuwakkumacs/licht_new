<?php
	require("../../library/layout/header.php");
	require("../../library/include/MyDBClass_mysql.php");
	require("../../library/include/utils.php");
	
if( $_SESSION['supervisor'] == 0 ){
	$titleId = $_GET['id'];
?>
<script src="../../library/js/administration/music_edit/music_config.js"></script>
<div id="main">
	
	<div id="pagetitle">
		<div class="left"><a href="./title_list.php">&lt;</a></div>
		<div class="center">参考音源設定</div>
		<div class="clear"></div>
	</div>
	<p class="heading">♪　リンクを追加する</p>
	<hr class="heading">
	
	<form action="music_add.php" method="post" id="add">
	<input type="hidden" name="titleId" value="<?php echo $titleId; ?>"/>
	<input type="text" style="width:100%;" name="name" placeholder="タイトルを入力" id="addname"/>
	<input type="text" style="width:100%;" name="url" placeholder="URLを入力" id="addurl"/>
	<input type="submit" class="submit" value="登録" />
	</form>
	<br>
	
	<p class="heading">♪　リンクを削除する</p>
	<hr class="heading">
	<form action="music_delete.php" method="post">
	<?php
		$db  = new MyDBClass_mysql();
		$sql = "SELECT * FROM music_urls WHERE title_id='{$titleId}';";
		$musicArray = $db->executeQuery( $sql );
		if( empty($musicArray) ){ ?>
			登録されているリンクはありません。
		<?php
		}
		foreach( $musicArray as $music ){
			?>
			<div style="float:left; width:10%;"><input type="checkbox" name="id[]" value="<?php echo $music['id']; ?>" id="<?php echo $music['id']; ?>" /></div>
			<div style="float:left; width:90%;"><label for="<?php echo $music['id']; ?>"><?php echo $music['name']; ?>(<?php echo $music['url']; ?>)</label></div>
			<div style="clear:both;"></div>
		<?php
		}
	?>
	<input type="button" value="削除" class="delete" onclick="if(confirm_delete()==true) submit();">
	</form>
</div>
	
<?php 
} ?>
</body>
</html>
