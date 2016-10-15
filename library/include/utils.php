<?php
	$days = array('日', '月', '火', '水', '木', '金', '土');

	$parts_short = array('Cond.', 'Fl.', 'Ob.', 'Cl.', 'Sax.', 'Trp.', 'Hrn.', 'Trb.', 'Bass.', 'Perc.');
	$parts_full  = array('Conductor', 'Flute', 'Oboe', 'Clarinet', 'Saxophone', 'Trumpet', 'Horn', 'Trombone', 'Bass', 'Percussion');
	$parts_jap   = array('指揮者', 'フルート', 'オーボエ', 'クラリネット', 'サキソフォン', 'トランペット', 'ホルン', 'トロンボーン', '低音', '打楽器');
	
	class MailTo {
		var $id;
		var $name;
		var $cond;
		function MailTo($id,$name,$cond){
			$this->id   = $id;
			$this->name = $name;
			$this->cond = $cond;
		}
	}

	function dateStrToJapaneseFormat( $dateStr ){
		global $days;
		$day  = date( "w", strtotime( $dateStr ) );
		$newDateStr = date( "Y年m月d日（{$days[$day]}）", strtotime( $dateStr ));
		return $newDateStr;
	}
