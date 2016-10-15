<?php

include('../library/include/session_master.php');
include('../library/include/MyDBClass_mysql.php');
require("../library/PHPMailer/class.phpmailer.php");

/*
 * 0 : 本番モード
 * 1 : テストメール送信トピック投稿あり
 * 2 : メール送信なしトピック投稿あり
 * 3 : デバッグプリントのみ
 */
define('TEST_MODE','0');
define('TEST_MAILTO','ss.shwk@gmail.com');

// 各種情報
$_attach = array();
$_mail   = array();
$_topic  = array();

$date_now = date('Y-m-d H:i:s');
$db = new MyDBClass_mysql();

// リロードによる誤投稿の無効化
if( $_POST['subject']=="" || $_POST['body']=="" ) die('エラーが発生したため送信されませんでした。');

/* ----------------------------------------- */
/*              画像添付処理                 */
/* ----------------------------------------- */
if($_FILES['attach']['error']!=4){  // アップロード画像あるとき
	$pathtmp = pathinfo($_FILES['attach']['name']);
	$_attach['extension'] = $pathtmp['extension'];
	$_attach['size'] = $_FILES['attach']['size'];
	
	switch( $_attach['extension'] ){
		case "gif":
		case "jpg":
		case "jpeg":
		case "bmp":
		case "png":
			if( $_attach['size'] > 10*1024*1024 ) {
				$_attach['error']    = 2;
			} else {
				$_attach['hash']     = md5(mt_rand());
				$_attach['savepath'] = "../upimg/";
				$_attach['filename'] = "{$_attach['hash']}.{$_attach['extension']}";
				$_attach['error']    = move_uploaded_file(
																	$_FILES['attach']['tmp_name'],
																	$_attach['savepath'].$_attach['filename']
																) ? 0 : 3;
			}
			break;

		default:
			$_attach['error'] = 1;
			break;
	}
	echo "添付画像：";
	if( !$_attach['error'] ){  // ファイルアップロード成功の時
		echo "正常に添付されました<br>";
		$_attach['sql_insert'] = "INSERT INTO `upload_imgs` (name,created) VALUES('{$_attach['filename']}','{$date_now}');";
		$_attach['sql_select'] = "SELECT id FROM `upload_imgs` WHERE `name`='{$_attach['filename']}';";
		$db->executeQuery( $_attach['sql_insert'] );
		$id_tmp = $db->executeQuery( $_attach['sql_select'] );
		$_attach['id'] = $id_tmp[0]['id'];
	} else {
		switch( $_attach['error'] ){
			case 1:
				echo "無効な拡張子です:{$_attach['extension']}";
				break;
			case 2:
				echo "ファイルサイズは10MB以下にしてください";
				break;
			default:
				echo "問題が発生したため添付できませんでした";
				break;
		}
		echo "<br>";
		die("ブラウザの戻るボタンを押してやり直して下さい");
	}
} else {
	$_attach['id']    = "NULL";
	$_attach['error'] = 4;
}

/* ----------------------------------------- */
/*            メール配信処理                 */
/* ----------------------------------------- */
// メール配信先テンプレ
$_mail['group_info'] = $db->executeQuery("SELECT * FROM `groups` WHERE `key`='{$_POST['to']}';");
$_mail['group_info'] = $_mail['group_info'][0];

// メール配信先読み込み
$_mail['sql']     = "SELECT name_kanji,email FROM users WHERE {$_mail['group_info']['condition']};";
$_mail['to_data'] = $db->executeQuery($_mail['sql']);

//言語設定、内部エンコーディングを指定する
mb_language("japanese");
$org = mb_internal_encoding();
mb_internal_encoding("JIS");

//日本語添付メールを送る
$_mail['subject'] = TEST_MODE ? "【テスト送信】{$_POST['subject']}" : "【リヒト連絡】{$_POST['subject']}";
$_mail['body']    = "
配信者：{$_POST['sender']}
配信先：{$_mail['group_info']['name']}

{$_POST['body']}

=======================
Sent from Licht Portal
このメールに返信しても届きません。

楽団リヒトポータルサイト
http://lichtportal.biz/sp/
※スマートフォン閲覧推奨
";

$phpmailer = new PHPMailer();
$phpmailer->CharSet = "iso-2022-jp";
$phpmailer->Encoding = "7bit";
if( TEST_MODE==0 ){
	foreach($_mail['to_data'] as $data){
		$phpmailer->AddBCC($data['email']);
	}
}
elseif( TEST_MODE==1 ){
	$phpmailer->AddBCC(TEST_MAILTO);
}
$phpmailer->From = "admin@mail.lichtportal.biz";
$phpmailer->FromName = mb_encode_mimeheader(mb_convert_encoding("楽団リヒト","JIS","UTF-8"));
$phpmailer->Subject = mb_encode_mimeheader(mb_convert_encoding($_mail['subject'],"JIS","UTF-8"));
$phpmailer->Body  = mb_convert_encoding($_mail['body'],"JIS","UTF-8");
if(!$_attach['error']) $phpmailer->AddAttachment($_attach['savepath'].$_attach['filename']);

// メール送信
if( TEST_MODE==0 || TEST_MODE==1 ) $_mail['error'] = $phpmailer->Send()?0:1;
echo "メール：";
switch( TEST_MODE ){
	case 0:
	case 1:
		if(!$_mail['error']) echo "送信されました";
		else echo "送信できませんでした。管理者に問い合わせて下さい。";
		break;
	default:
		echo "テストモード。送信されません<br>";
		echo "配信先：<br>";
		foreach( $_mail['to_data'] as $data ){
			echo $data['name_kanji']."<br>";
		}
		break;
}
echo "<br>";
mb_internal_encoding($org);

/* ----------------------------------------- */
/*            トピック投稿処理               */
/* ----------------------------------------- */
$_topic['sql'] = "INSERT INTO `topic` (name,subject,body,attach_id,group_id,date,useragent) values('{$_POST['sender']}','{$_POST['subject']}','{$_POST['body']}','{$_attach['id']}','{$_mail['group_info']['id']}','{$date_now}','{$_SERVER['HTTP_USER_AGENT']}');";
$_topic['error'] = $db->executeQuery($_topic['sql'])?0:1;
echo "トピック：";
if(TEST_MODE<=2){
	if($_topic['error']==0) echo "投稿されました";
	else echo "投稿できませんでした。管理者に問い合わせてください。";
} else {
	echo "テストモード。投稿されません";
}
echo "<br>";

?>
<br>
<a href="#" onclick="top.open('','_self',''); top.close();">ここ</a>から必ず画面を閉じてください。<br>
※ブラウザの「戻る」ボタンは押さないで下さい・・・・・・・<br>
<html>
<head>
	<meta content="width=320, minimum-scale=0.5, user-scalable=no" name="viewport" />
</head>
