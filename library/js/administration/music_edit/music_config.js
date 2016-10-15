$(function(){
	$('#add .submit').click(function(){
		console.log('hoge');
		if( $('#addname').val()=='' || $('#addurl').val()=='' ){
			alert('タイトルまたはURLが入力されていません');
			return false;
		}
	});
});

function confirm_delete(){
	if(confirm('本当に削除しますか？')) return true;
	return false;
}
