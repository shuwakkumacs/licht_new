<?php
	include('../library/layout/header.php');
	include('../library/include/MyDBClass_mysql.php');
	include('../library/include/utils.php');
	$db = new MyDBClass_mysql();
	$sql = "SELECT t.name AS tname, u.url AS url, u.name AS uname FROM music_urls AS u LEFT JOIN music_titles AS t ON t.id=u.title_id ORDER BY t.id ASC;";
	$musicArray = $db->executeQuery( $sql );
?>
<div id="main">
	<div id="pagetitle">参考音源</div>
	<ul class="select_list">
		<?php
		$prevtname='';
		foreach( $musicArray as $music ){
			if( $music['tname'] != $prevtname ) { 
				$prevtname=$music['tname'];
				?>
				<li class="category_title"><p><?php echo $prevtname; ?></p></li>
			<?php }
			echo '<a href="'. $music['url']. '" target="_blank"><li><p>'. $music['uname']. '</p></li></a>';
			}
			?>
	</ul>
</div>
</body>
</html>
