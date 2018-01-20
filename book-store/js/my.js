
$(document).ready(function(){

		$("#b").ready(function(){
    $("html, body").delay(1000).animate({
        scrollTop: $('#b').offset().top 
    }, 1000);
});
		
});