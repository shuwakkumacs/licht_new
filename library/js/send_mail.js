function confirm_topic(){
	if($('select[name="sender"]').val()=="no_name"){
		alert("名前を選択して下さい");
		return false;
	}
	if($('.subject').val()=='' || $('.body').val()==''){
		alert("未入力箇所があります");
		return false;
	}
	if(confirm('本当に送信しますか？\n（後からの編集・削除はできません）')) return true;
}

$(function(){
	$('#checkall').click(function(){
		if($('.checkbox').prop('checked')==false) $('.checkbox').prop('checked', true);
		else $('.checkbox').prop('checked', false);
	});
});
