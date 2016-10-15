<script src="./library/js/administration/user_edit/profile/edit.js"></script>
<?php
	require('./library/layout/header.php');
	require('./library/include/MyDBClass_mysql.php');
	require('./library/include/utils.php');
	$db = new MyDBClass_mysql();
?>
<div id="main">
	<div id="pagetitle">
		ユーザー情報編集
	</div>
	<?php
		if( !empty($_POST) ){
			$sqlUpdate = "UPDATE users SET 
			part='{$parts_short[ $_REQUEST['part_id'] ]}',
			part_id='{$_REQUEST['part_id']}',
			name_kanji='{$_REQUEST['name_kanji']}',
			name_kana='{$_REQUEST['name_kana']}',
			email='{$_REQUEST['email']}',
			zipcode='{$_REQUEST['zipcode']}',
			address='{$_REQUEST['address']}'
			WHERE id='{$_SESSION['id']}';";
			$db->executeQuery( $sqlUpdate );
			?>
			<div style="width:80%; background:#f1f1b7; text-align:center; padding:5px; margin:0px auto 10px auto;">
				変更を保存しました
			</div>
			<?php
		}
		$sql = "SELECT * FROM users WHERE id={$_SESSION['id']};";
		$data = $db->executeQuery( $sql );
	?>
	<form method="post" action="edit_profile.php">
	<table style="width:100%; line-height:2.0; font-size:1.1em;">
		<tr>
			<td>パート</td>
			<td>
				<select name="part_id">
				<?php
				for( $i=0; $i<count($parts_full); $i++ ){
					$tag = "<option value='{$i}'";
					if( $i==$data[0]['part_id'] ) $tag .= " selected";
					$tag .= ">{$parts_full[$i]}</option>";
					echo $tag;
				}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>名前</td>
			<td><input type="text" value="<?php echo $data[0]['name_kanji']; ?>" name="name_kanji" /></td>
		</tr>
		<tr>
			<td>名前ｶﾅ</td>
			<td><input type="text" value="<?php echo $data[0]['name_kana']; ?>" name="name_kana" /></td>
		</tr>
		<tr>
			<td>username</td>
			<td><?php echo $data[0]['username']; ?></td>
		</tr>
		<tr>
			<td>password</td>
			<td>****（閲覧できません）</td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="text" value="<?php echo $data[0]['email']; ?>" name="email" /></td>
		</tr>
		<tr>
			<td>郵便番号</td>
			<td><input type="text" value="<?php echo $data[0]['zipcode']; ?>" name="zipcode" /></td>
		</tr>
		<tr>
			<td>住所</td>
			<td><textarea name="address" style="width:100%; font-size:1.1em;" rows="3"><?php echo $data[0]['address']; ?></textarea></td>
		</tr>
	</table>
	<input type="submit" value="送信" class="submit" />
	</form>
</div>
</body>
</html>
