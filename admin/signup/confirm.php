<?php
	foreach($_POST as $val){
		if($val==""){
			header("Location: ./signup.php?err=1");
			die('');
		}
	}
	if($_POST['validation']==-1) {
		header("Location: ./signup.php?err=2");
		die('');
	}
?>
<meta http-equiv="Expires" content="0">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Pragma" content="no-cache">
<?php 
	include('../../library/layout/header.php');
	include('../../library/include/MyDBClass_mysql.php');

	$partName = array('その他','フルート','オーボエ','クラリネット','サックス','ホルン','トランペット','トロンボーン','バス','パーカッション');
	
	
/* --------------- Email Sender -------------- */
	$name_kanji = $_POST['last_kanji']. ' '. $_POST['first_kanji'];
	$name_kana = $_POST['last_kana']. ' '. $_POST['first_kana'];
	$name_kana = mb_convert_kana($name_kana, 'C');
	$name_kana = mb_convert_kana($name_kana, 'k');
	$part = $_POST['part'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$temp_rand = sprintf("%010d", mt_rand(0,9999999999));
	$temp_rand .= sprintf("%010d", mt_rand(0,9999999999));
	
	require("../../library/PHPMailer/class.phpmailer.php");
	mb_language("japanese");
	mb_internal_encoding("UTF-8");
	$to = $email;
	$subject = "新規登録受付";
	$body="
楽団リヒト ユーザー仮登録を受け付けました。

姓名：{$name_kanji}
読み：{$name_kana}
パート：{$partName[$part]}
メールアドレス：{$email}
ユーザID：{$username}
パスワード【注意!!再発行できません】：{$password}



↓↓まだアカウントは使える状態になっていません！ここから本登録を完了してください。↓↓
http://lichtportal.biz/sp/admin/submit.php?q={$temp_rand}
";
	$from = "admin@lichtportal.biz"; 
	$mail = new PHPMailer();
	$mail->CharSet = "iso-2022-jp";
	$mail->Encoding = "7bit";
	$mail->AddAddress($to);
	$mail->From = $from;
	$mail->FromName = mb_encode_mimeheader(mb_convert_encoding($fromname,"JIS","UTF-8"));
	$mail->Subject = mb_encode_mimeheader(mb_convert_encoding($subject,"JIS","UTF-8"));
	$mail->Body  = mb_convert_encoding($body,"JIS","UTF-8");
	$mail->Send();
/* ------------------------------------------- */
	
	
	$db = new MyDBClass_mysql();
	$sql = "insert into `temp_users` values('','{$part}','{$name_kanji}','{$name_kana}','{$email}','{$username}','". md5($password). "','". $temp_rand. "');";
	$db->executeQuery($sql);
 
  ?>
<div id="main">
<p>ユーザー登録</p>
<br>
<p style="color:#f00; font-weight:bold;">まだ本登録は完了していません！メールが送られてきますので、そこから本登録を進めてください。</p>
<br>
<p>以上の内容で送信しました：</p>
<p>姓名：<?php echo $name_kanji; ?></p>
<p>読み：<?php echo $name_kana; ?></p>
<p>パート：<?php echo $partName[$part]; ?></p>
<p>メールアドレス：<?php echo $email; ?></p>
<p>ユーザID：<?php echo $username; ?></p>
<p>パスワード：<?php echo $password; ?>（送信先で暗号化されます）</p>
<br>
<a href="#" onclick="top.open('','_self',''); top.close();">ここ</a>から必ず画面を閉じてください。<br>
※ブラウザの「戻る」ボタンは押さないで下さい・・・・・・・<br>
</div>
</body>
</html>
