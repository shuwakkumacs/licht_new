<?php
	require('../library/layout/header.php');
	require('../library/include/utils.php');
	
	function checkEmail($data){
		if($data['email']=='') return ' disabled="disabled"';
		else return '';
	}
	
	include('../library/include/MyDBClass_mysql.php');

	$id = $_SESSION['id'];
	
	$db = new MyDBClass_mysql();
	$sql="select part_id,name_kanji from users where id='{$id}';";
	$data = $db->executeQuery($sql);
?>
	<link rel="stylesheet" href="../library/css/send_mail.css">
	<script type="text/javascript" src="../library/js/send_mail.js"></script>
	
	<div id="main">
		<div id="pagetitle">トピック投稿</div>
		<div id="inst">
				このページはメールトピック（＝メーリングリスト）作成ページです。<br>
			<span style="color:red;">
				ここに投稿すると、トピックリストに記事が反映されると同時に、同内容がメールで全団員に送られます。<br>
			</span>
				<u><b>送信後の記事の編集・削除はできません</b></u>ので、使用する際は誤送信の無いよう注意をしてください。<br>
			</span>
		</div>
		
		<form enctype="multipart/form-data" method="post" action="pick_address.php" onsubmit="return false;">
		<div id="member_list">
			<div class="inputs">
				<div>名前</div>
				<div>
					<input type="hidden" name="sender" value="<?php echo $data[0]['name_kanji']; ?>">
					<span style="font-size:1.1em;line-height:2.0;padding:1px;"><?php echo $data[0]['name_kanji']; ?></span>
				</div>
				<div class="clear"></div>
			</div>
			<div class="inputs">
				<div>配信先</div>
				<div>
					<select name="to">
						<option value="0">団員一斉</option>
						<option value="1">乗り番団員</option>
						<option value="2">正団員</option>
						<option value="3">パートリーダー</option>
						<?php
						foreach( $parts_full as $k => $v ){
							echo "<option value='part_0{$k}'>{$v}</option>";
						}
						?>
					</select>
				</div>
				<div class="clear"></div>
			</div>
			<div class="inputs">
				<div>添付</div>
				<div><input type="file" name="attach" /></div>
				<div class="clear"></div>
			</div>
			<div class="inputs">
				<div>題名</div>
				<div><input type="text" name="subject" class="subject" placeholder="入力して下さい"></div>
				<div class="clear"></div>
			</div>
			<div class="inputs">
				<div>本文</div>
				<div><textarea rows="8" name="body" class="body" placeholder="入力して下さい"></textarea></div>
				<div class="clear"></div>
			</div>
		</div>
		<input class="submit" type="button" value="送信" style="margin:0;" onclick="if(confirm_topic()==true) submit();">
		</form>
		
	</div>
	
</body>
</html>
