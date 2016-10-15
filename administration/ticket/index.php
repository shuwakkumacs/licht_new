<?php
	require("../../library/layout/header.php");
	require('../../library/include/MyDBClass_mysql.php');
	$db = new MyDBClass_mysql();

if( $_SESSION['supervisor'] == 0 ){ ?>

<style>
.name {
	float: left;
	width: 80%;
	height: 40px;
}
.num {
	float: left;
	width: 20%;
	height: 40px;
}
.num input {
	width: 100%;
	height: 100%;
	font-size: 1.5em;
	text-align: center;
}
li {
	list-style: none;
}
</style>
	
<div id="main">
	<div id="pagetitle">
		<div class="left"><a href="../index.php">&lt;</a></div>
		<div class="center">チケット枚数編集</div>
		<div class="clear"></div>
	</div>
	<?php
		if( !empty($_POST) ){
			foreach( $_POST as $id => $val ){
				$user_ticket = $db->executeQuery("SELECT * FROM tickets WHERE user_id={$id};");
				$user = $db->executeQuery("SELECT concert_attendance FROM users WHERE id={$id};");
				if($val!=NULL) {
					$sql = "";
					if(!empty($user_ticket)){
						$sql = "UPDATE tickets SET num={$val} WHERE user_id={$id};";
					} else {
						$sql = "INSERT INTO tickets (user_id,num) VALUES({$id},{$val});";
					}
					$db->executeQuery( $sql );
				} else {
					if($user[0]['concert_attendance']==1) {
						if(empty($user_ticket))
							$sql = "INSERT INTO tickets (user_id,num) VALUES ({$id},0);";
						else
							$sql = "UPDATE tickets SET num=0 WHERE user_id={$id};";
					} else {
						$sql = "DELETE FROM tickets WHERE user_id={$id};";
					}
					$db->executeQuery( $sql );
				}
			}
			?>
			<div style="width:80%; background:#f1f1b7; text-align:center; padding:5px; margin:0px auto 10px auto;">
				変更を保存しました
			</div>
			<?php
		}
	?>
	<form method="post" action="./index.php">
		<?php
			$disp = $db->executeQuery("SELECT num FROM tickets WHERE user_id=-1;");
			$disp = $disp[0]['num'];
		?>
		<div style="width:60%;margin:30px auto 0px auto;">
			<div style="float:left">
				<input type="radio" id="yes" name="-1" value="1" <?php echo $disp?'checked':''; ?>/><label for="yes">表示</label>　
			</div>
			<div style="float:right">
				<input type="radio" id="no" name="-1" value="0" <?php echo $disp?'':'checked'; ?>/><label for ="no">非表示</label>
			</div>
			<div class="clear"></div>
		</div>
		<ul class="select_list">
			<?php
			$sql = "SELECT name_kanji,num,part,u.id FROM users AS u LEFT JOIN tickets AS t ON u.id=t.user_id WHERE concert_attendance=1 ORDER BY part_id ASC;";
			$user_ticketnum = $db->executeQuery($sql);
			for($i=0; $i<count($user_ticketnum); $i++){
				$num = $user_ticketnum[$i]['num']==NULL? '' : $user_ticketnum[$i]['num'];
				echo "<li><div class=\"name\">".
					"({$user_ticketnum[$i]['part']}) {$user_ticketnum[$i]['name_kanji']}</div>".
					"<div class=\"num\"><input name=\"".$user_ticketnum[$i]['id']."\" value=\"{$num}\" /></div>".
					"<div class=\"clear\"></div>";
				echo "</p></li>";
			}
			?>
		</ul>
		<input type="submit" value="送信" class="submit" />
	</form>
</div>
<?php 
} ?>
</body>
</html>
