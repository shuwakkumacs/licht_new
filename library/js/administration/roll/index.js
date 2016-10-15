function confirm_delete(){
	if(confirm('本当に削除しますか？\n（この日付分の出欠データ全てが削除されます）')) return true;
	return false;
}
