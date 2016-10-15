<?php
	include('../library/layout/header.php');
	include('../library/include/MyDBClass_mysql.php');

	$db = new MyDBClass_mysql();
	$sql = "select * from topic where id={$_GET['id']}";
	$data = $db->executeQuery($sql);
	$sql_attach = "SELECT name from `upload_imgs` WHERE id={$data[0]['attach_id']};";
	$data_attach = $db->executeQuery($sql_attach);
	if($data[0]['group_id']===NULL) $data[0]['group_id']=-1;
	$sql_group = "SELECT name from `groups` WHERE id={$data[0]['group_id']};";
	$data_group = $db->executeQuery($sql_group);

?>
<div id="main">
	<div id="pagetitle">
		<div class="left"><a href="./index.php">&lt;</a></div>
		<div class="center">トピック </div>
		<div class="clear"></div>
	</div>
		- <?php echo $data[0]['subject']; ?><br>
		投稿者：<?php echo $data[0]['name']; ?><br>
		配信先：<?php echo $data_group[0]['name']; ?><br>
		投稿日時：<?php echo date('Y/m/d H:i', strtotime($data[0]['date'])); ?><br>
	<hr class="heading">
		<?php echo nl2br($data[0]['body']); ?><br>
		<?php
			if($data[0]['attach_id']!=0) echo "<img src='../upimg/{$data_attach[0]['name']}' style='width:100%;' />";
		?>
	<hr class="heading">
</div>
</body>
</html>
