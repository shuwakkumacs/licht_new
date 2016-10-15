<?php
	require('../../library/layout/header.php');
	require('../../library/include/MyDBClass_mysql.php');
	require('../../library/include/utils.php');
	$titleId = $_GET['id'];

	$db = new MyDBClass_mysql();
	$sql = "SELECT name,url FROM music_urls WHERE title_id={$titleId};";
	$musicArray = $db->executeQuery( $sql );
	$sql_title = "SELECT name FROM music_titles WHERE id={$titleId};";
	$title = $db->executeQuery( $sql_title );
	$title = $title[0]['name'];
?>
<style> input[type="checkbox"] { width:20px; } </style>

<div id="main">
	<div id="pagetitle">
		<div class="left"><a href="./title_list.php">&lt;</a></div>
		<div class="center">参考音源編集</div>
		<div class="clear"></div>
	</div>
	<ul class="select_list">
		<li class="category_title"><p><?php echo $title; ?> のリンク一覧</p></li>
		<?php
		foreach( $musicArray as $music ){
			echo '<a href="'. $music['url']. '"><li><p>'. $music['name']. '</p></li>';
		}
		?>
		<a href="music_config.php?id=<?php echo $titleId; ?>"><li><p style="font-weight:bold; color:#f00;">リンクの追加・削除</p></li>
	</ul>
</div>
</body>
</html>
