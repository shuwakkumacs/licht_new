<meta http-equiv="Expires" content="1">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Pragma" content="no-cache">
<?php
	include('../../library/layout/header.php');
?>
<div id="main">
<p>ユーザー登録</p>
<br>
<span style="color:red;">注意：</span>本登録のため、入力したメールアドレスに確認メールが届きます。迷惑メール対策などをしている場合は、事前にadmin@lichtportal.bizを受信できるようにしておいてください。
<br><br>
	<form method="post" action="confirm.php">
	<?php
		if($_GET['err']=="1") { ?>
			<span style="color:red;">未入力の項目があります</span>
		<?php
		} else if($_GET['err']=="2") { ?>
			<span style="color:red;">ユーザー名が既に使われています</span>
		<?php
		}
	?>
	<p>姓名（漢字）</p>
	<div class="input_area">
		<div style="float:left; line-height:2;">姓</div>
		<div style="float:left;"><input name="last_kanji" type="text" size="8" style="margin-right:5px;"></div>
		<div style="float:left; line-height:2;">名</div>
		<div style="float:left;"><input name="first_kanji" type="text" size="8"></div>
		<div style="clear:both"></div>
	</div>
	<p>姓名（カナ）</p>
	<div class="input_area">
		<div style="float:left; line-height:2;">セイ</div>
		<div style="float:left;"><input name="last_kana" type="text" size="8" style="margin-right:5px;"></div>
		<div style="float:left; line-height:2;">メイ</div>
		<div style="float:left;"><input name="first_kana" type="text" size="8"></div>
		<div style="clear:both"></div>
	</div>
   <p>パート</p>
        <div class="input_area">
                <select name="part">
	                <option value="1">Fl.</option>
	                <option value="2">Ob.</option>
	                <option value="3">Cl.</option>
	                <option value="4">Sax.</option>
	                <option value="5">Hr.</option>
	                <option value="6">Trp.</option>
						 <option value="7">Trb.</option>
	                <option value="8">Bass.</option>
						 <option value="9">Perc.</option>
						 <option value="0">その他</option>
                </select>
        </div> 
	<p>メールアドレス</p>
        <div class="input_area">
                <input name="email" type="text" size="40">
        </div>
<?php //   <p>卒業年数</p>
//        <div class="input_area">
//                <select name="grade">
//	                <option value="1">1</option>
//	                <option value="2">2</option>
//	                <option value="3">3</option>
//	                <option value="4">4</option>
//                </select>
//        </div> ?>
	<p>ユーザーID</p>
        <div class="input_area">
                <input name="username" type="text" size="20" id="input_username" autocomplete="off">
								<input name="validation" type="hidden" id="input_validation" value="-1">
								<br>
								<div id="disp_error"></div>
        </div>
	<p>パスワード</p>
        <div class="input_area">
                <input name="password" type="password" size="20" autocomplete="off">
        </div>
        <div class="input_area">
        <input name="submit" type="submit" id="submit" value="送信">
	  		</div> 

        </form>
</div>
<script src="../../library/js/admin/signup/signup.js"></script>
</body>
</html>
