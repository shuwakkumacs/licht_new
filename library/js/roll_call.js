function confirm_name(){
	if($("select.name option:selected").val()=="no_name"){
		alert("名前を選択して下さい");
		return false;
	}
}

$(function(){
	var target = $(".member");
	target.change(function(){
	    if($(".member option:selected").attr("value") != "") {
	        query = $(".member option:selected").attr('value');
			  query = escape(query);
			  location.href="./roll_call.php?name="+query;
	    }
	});
});
