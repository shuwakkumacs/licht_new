<?php
	require('../library/layout/header.php');
	require('../library/include/MyDBClass_mysql.php');
	require('../library/include/utils.php');
	$db = new MyDBClass_mysql();

	/*
	 * $_GET['p'] ... $s_part   ... パート番号、-1:指定なし
	 * $_GET['a'] ... $s_attend ... 乗り番、-1:指定なし 0:非乗り番 1:乗り番
	 */
	if( !isset($_GET['p']) ) $c_part = -1;
	else $c_part = $_GET['p'];
	if( !isset($_GET['a']) ) $c_attend = -1;
	else $c_attend = $_GET['a'];

	if( $c_part==-1 ) $s_part = "1=1"; 
	else $s_part = "`part_id`='{$c_part}'";
	if( $c_attend==-1 ) $s_attend = "1=1"; 
	else $s_attend = "`concert_attendance`='{$c_attend}'";
	$sql = "SELECT id,name_kanji FROM users WHERE {$s_part} AND {$s_attend} ORDER BY `part_id` ASC;";
	$userData = $db->executeQuery( $sql );

?>
<style> input[type="checkbox"] { width:20px; } </style>
<link rel="stylesheet" href="../library/css/users/index.css" />

<div id="main">
	<div id="pagetitle">
		<div class="left"><a href="../index.php">&lt;</a></div>
		<div class="center">団員情報</div>
		<div class="clear"></div>
	</div>
	<form method="get" id="search_condition" action="">
		<div class="select-each">
			<div style="float:left;width:20%;line-height:35px;">パート</div>
			<div style="float:left;width:80%;line-height:35px;">
				<select name="p" style="width:100%;height:35px;">
					<option value="-1">指定しない</option>
					<?php
					foreach( $parts_full as $k => $v ) {
						if( $c_part==$k )
							echo "<option value='{$k}' selected>{$v}</option>";
						else
							echo "<option value='{$k}'>{$v}</option>";
					}
					?>
				</select>
			</div>
			<div class="clear"></div>
		</div>
		<div class="select-each">
			<div style="float:left;width:20%;line-height:35px;">乗り番</div>
			<div style="float:left;width:80%;line-height:35px;">
				<select name="a" style="width:100%;height:35px;">
					<option value="-1" <?php echo $c_attend==-1?"selected":""; ?>>指定しない</option>
					<option value="1" <?php echo $c_attend==1?"selected":""; ?>>はい</option>
					<option value="0" <?php echo $c_attend==0?"selected":""; ?>>いいえ</option>
				</select>
			</div>
			<div class="clear"></div>
		</div>
	</form>
	<br>
	該当件数：<?php echo count($userData); ?>件
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
<script src="../library/js/users/index.js"></script>
</body>
</html>
