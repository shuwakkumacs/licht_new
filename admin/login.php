<?php
	require("../library/layout/header.php");
?>
<div id="main">
	ログインしてください<br><br>
	<form method="post" action="login_bridge.php">
		ユーザー名
		<input type="text" name="username">
		パスワード
		<input type="password" name="password">
		<?php if($_GET['err']==1){ ?>
		<span style="color:#f00;">ログイン情報が正しくありません</span>
		<?php } ?>
		<?php if($_GET['err']==2){ ?>
		<span style="color:#f00;">不正な入力です</span>
		<?php } ?>
		<input type="submit" class="submit" value="ログイン">
</div>
</body>
</html>
