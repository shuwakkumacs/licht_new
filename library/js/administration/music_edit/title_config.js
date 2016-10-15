$(function(){
	$('#add .submit').click(function(){
		console.log('hoge');
		if( $('#addname').val()=='' ){
			alert('曲名が入力されていません');
			return false;
		}
	});
});

function confirm_delete(){
	if(confirm('本当に削除しますか？\n（この曲のリンク情報全てが削除されます）')) return true;
	return false;
}
