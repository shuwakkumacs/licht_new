<?php
	$mysqli = new mysqli('localhost', 'root', 'iseebi3014', 'licht') or die('fuck');	
	$sql="select name,ticket_num from ticket_reg03 order by ticket_num desc;";
	$datas = $mysqli->query($sql);
	$total = 0;
	while($data=$datas->fetch_assoc()){
		$member[] = $data['name'];
		$ticketnum[] = $data['ticket_num'];
		$total += $data['ticket_num'];
	}
	
	$rank = 0;
	$buf  = 1;


	function checkBgcolor($i){
		if($i%2==0) return "background:#EFF2FC;";
	}
	function checkRank($rank){
		switch($rank){
			case 1:
				return " color:red; font-size:1.3em;";
			case 2:
				return " color:orange; font-size:1.2em;";
			case 3:
				return " color:#BCC400; font-size:1.1em;";
			default:
				return "";
		}
	}
?>
<html>
<head>
	<meta content="width=320, minimum-scale=0.5, user-scalable=no" name="viewport" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" style="text/css" href="../library/css/base.css">
	<script type="text/javascript" src="../library/js/jquery-1.10.2.min.js"></script>
<style type="text/css">
input, select {
	border:solid 1px #ccc;
	font-size:1.0em;
}
</style>
</head>
<body>
<?php
	include(dirname(__FILE__). './../library/layout/header.php');
?>
<div id="main">
<div id="pagetitle">ランキング</div>
<b>現在 <span style="color:red;"><?php echo $total; ?></span> 枚！！！</b>
<br><br>
<table style="width:100%;" cellspacing=0 cellpadding=0>
<?php
	for($i=0; $i<count($member); $i++){ ?>
		<?php
			if($i!=0 && $ticketnum[$i-1]==$ticketnum[$i]){ $buf++; }
			else { $rank+=$buf; $buf=1; }
		?>
		<tr style="<?php echo checkBgcolor($i); echo checkRank($rank); ?>"><td style="width:30%; text-align:center;"><?php echo $rank; ?>位</td><td style="width:50%; text-align:center; padding:3px;"><?php echo $member[$i]; ?></td><td style="text-align:right; padding-right:10px;"><?php echo $ticketnum[$i]; ?></td></tr>
	<?php
	}
	?>
</table>
<br>
</div>
</body>
</html>

