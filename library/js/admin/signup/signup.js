$('#input_username').keyup(function(){
	$.post("check_username.php",
		{ username: $('#input_username').val() },
		function(data){
			$('#disp_error').html(data);
			if(data!=""){ $('#input_validation').val('-1'); }
			else $('#input_validation').val('1');
		});
});
