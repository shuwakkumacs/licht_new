<?php
	require_once('./library/layout/header.php');
	$mysqli = new mysqli('localhost', 'root', 'iseebi3014', 'licht') or die('fuck');	
?>
<div id="main">
	<br>
	<div style="width:100%; text-align:right;">
		<img src="./img/top_logo.png" style="width:60%; max-width:200px;"><br><br>
		<?php echo "{$_SESSION['name']} さん ログイン中<br>"; ?>
	</div>
	<?php
		$ticket = $mysqli->query("SELECT * FROM tickets WHERE user_id=-1");
		while($data=$ticket->fetch_assoc()){
			if($data['num']==1){ ?>
	<div style="cursor:pointer;width:70%;margin:20px auto;text-decoration:underline;border:2px solid #e07000;color:#e07000;text-align:center;line-height:30px;font-weight:bold;" onclick="javascript:window.location.href='./tickets/index.php';">
		＞＞ チケットランキング ＜＜
	</div>
	<?php } } ?>
	<p class="heading">♪演奏会予定</p>
	<hr class="heading">
	<p style="text-align:center;">

	</p>
	<p class="heading">♪新着トピック</p>
	<hr class="heading">
	<?php
		$sql = "select id,name,subject,date from topic where 1=1 order by date desc limit 2;";
		$datas = $mysqli->query($sql);
		
		while($data=$datas->fetch_assoc()){ ?>
			 - <a href="./topic/thread.php?id=<?php echo $data['id']; ?>"><?php echo $data['subject']; ?></a> (<?php echo $data['name']; ?>)
			<div style="text-align:right"><?php echo date('Y/m/d H:i', strtotime($data['date'])); ?></div>
			<br>
	<?php } ?>
	<div style="text-align:right; width:100%;"><a href="./topic/index.php">>>過去の記事を読む</a></div>
</div>
</body>
</html>
