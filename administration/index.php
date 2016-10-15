<?php
	require("../library/layout/header.php");

if( $_SESSION['supervisor'] == 0 ){ ?>
	
<div id="main">
	<div id="pagetitle">管理者ページ</div>
	<ul class="select_list">
		<a href="./roll/index.php"><li><p>練習日設定</li></p></a>
		<a href="./user_edit/index.php"><li><p>ユーザー編集</li></p></a>
		<a href="./music_edit/title_list.php"><li><p>参考音源編集</li></p></a>
		<a href="./ticket"><li><p>チケット枚数編集</li></p></a>
	</ul>
</div>
<?php
} ?>
</body>
</html>
