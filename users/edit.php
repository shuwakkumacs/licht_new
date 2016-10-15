<?php
	require('../library/layout/header.php');
	require('../library/include/MyDBClass_mysql.php');
	require('../library/include/utils.php');
	$db = new MyDBClass_mysql();
?>
<div id="main">
	<div id="pagetitle">
		<div class="left"><a href="./index.php">&lt;</a></div>
		<div class="center">団員プロフィール</div>
		<div class="clear"></div>
	</div>
	<?php
		$sql = "SELECT * FROM users WHERE id={$_GET['id']};";
		$data = $db->executeQuery( $sql );
	?>
	<table style="width:100%; line-height:2.0; font-size:1.1em;">
		<tr>
			<td style="width:30%;">ID</td>
			<td style="width:70%;"><?php echo $data[0]['id']; ?></td>
		</tr>
		<tr>
			<td>パート</td>
			<td><?php echo $parts_full[$data[0]['part_id']]; ?></td>
		</tr>
		<tr>
			<td>名前</td>
			<td><?php echo $data[0]['name_kanji']; ?></td>
		</tr>
		<tr>
			<td>名前ｶﾅ</td>
			<td><?php echo $data[0]['name_kana']; ?></td>
		</tr>
		<tr>
			<td>username</td>
			<td><?php echo $data[0]['username']; ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><?php echo $data[0]['email']; ?></td>
		</tr>
		<tr>
			<td>郵便番号</td>
			<td><?php echo $data[0]['zipcode']; ?></td>
		</tr>
		<tr>
			<td>住所</td>
			<td><?php echo $data[0]['address']; ?></td>
		</tr>
		<tr>
			<td>正団員</td>
			<td><?php echo $data[0]['regular']?"○":"×"; ?></td>
		</tr>
		<tr>
			<td>乗り番</td>
			<td><?php echo $data[0]['concert_attendance']?"○":"×"; ?></td>
		</tr>
	</table>
</div>
</body>
</html>
