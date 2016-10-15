<?php
	require('../../library/layout/header.php');
	require('../../library/include/MyDBClass_mysql.php');
	require('../../library/include/utils.php');
	$db = new MyDBClass_mysql();
	$sql = "SELECT * FROM music_titles;";
	$titleArray = $db->executeQuery( $sql );
?>
<style> input[type="checkbox"] { width:20px; } </style>

<div id="main">
	<div id="pagetitle">
		<div class="left"><a href="../index.php">&lt;</a></div>
		<div class="center">参考音源編集</div>
		<div class="clear"></div>
	</div>
	<ul class="select_list">
		<li class="category_title"><p>登録曲一覧</p></li>
		<?php
		foreach( $titleArray as $title ){
			echo '<a href="music_list.php?id='. $title['id']. '"><li><p>'. $title['name']. '</p></li>';
		}
		?>
		<a href="title_config.php"><li><p style="font-weight:bold; color:#f00;">曲の追加・削除</p></li>
	</ul>
</div>
</body>
</html>
