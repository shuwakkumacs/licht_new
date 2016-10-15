<?php
	require('../../../library/layout/header.php');
	require('../../../library/include/MyDBClass_mysql.php');
	require('../../../library/include/utils.php');
	$db = new MyDBClass_mysql();
?>
<style> input[type="checkbox"] { width:20px; } </style>

<div id="main">
	<div id="pagetitle">
		<div class="left"><a href="../index.php">&lt;</a></div>
		<div class="center">プロフィール編集</div>
		<div class="clear"></div>
	</div>
	<?php
		$sql = "SELECT id,name_kanji,part_id,concert_attendance FROM users ORDER BY part_id ASC;";
		$userData = $db->executeQuery( $sql );
		?>
		<ul class="select_list">
		<?php
		$prev_part = "";
		foreach( $userData as $user ){
			if( $prev_part != $user['part_id'] ){
				echo '<li class="category_title"><p>'. $parts_full[ $user['part_id'] ]. '</p></li>';
				$prev_part = $user['part_id'];
			}
			?>
				<a href="edit.php?id=<?php echo $user['id']; ?>"><li><p><?php echo "{$user['name_kanji']}"; ?></p></li></a>
			<?php
		}
		?>
		</ul>
</div>
</body>
</html>
