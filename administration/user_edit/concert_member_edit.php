<?php
	require('../../library/layout/header.php');
	require('../../library/include/MyDBClass_mysql.php');
	require('../../library/include/utils.php');
	$db = new MyDBClass_mysql();
?>
<style> input[type="checkbox"] { width:20px; } </style>

<div id="main">
	<div id="pagetitle">
		<div class="left"><a href="./index.php">&lt;</a></div>
		<div class="center">乗り番編集</div>
		<div class="clear"></div>
	</div>
	<?php
		if( !empty($_POST) ){
			foreach( $_POST as $id => $val ){
				$sqlUpdate = "UPDATE users SET concert_attendance={$val} WHERE id={$id};";
				$db->executeQuery( $sqlUpdate );
			}
			?>
			<div style="width:80%; background:#f1f1b7; text-align:center; padding:5px; margin:0px auto 10px auto;">
				変更を保存しました
			</div>
			<?php
		}
	?>
	<?php
		$sql = "SELECT id,name_kanji,part_id,concert_attendance FROM users WHERE part_id>=1 ORDER BY part_id ASC;";
		$userData = $db->executeQuery( $sql );
		?>
		<form method="post" action="./concert_member_edit.php">
		<table class="stripe-blue">
		<?php
		foreach( $userData as $user ){
			?>
			<tr><td>
				<input type="hidden" name="<?php echo $user['id']; ?>" value="0">
				<input type="checkbox" name="<?php echo $user['id']; ?>" value="1" id="a_<?php echo $user['id']; ?>" <?php if( $user['concert_attendance'] ) echo "checked"; ?>>
				<?php echo "<label for='a_{$user['id']}'>({$parts_short[ $user['part_id'] ]}){$user['name_kanji']}</label>"; ?>
			</td></tr>
			<?php
		}
		?>
		</table>
		<input type="submit" value="送信" class="submit" />
		</form>
</div>
</body>
</html>
