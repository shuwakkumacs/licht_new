$(function(){
	$('.menulink').click(function(){
		$('.menubar').slideToggle('fast');
	});

	$('.menubar li').click(function(){
		if($(this).attr('class')=='slide'){
			$(this).children('ul').slideToggle('fast');
		}
	});
});

function go2link(p,a,n){
	if(n==true) window.open(p+a);
	else location.href=p+a;
	return false;
}
