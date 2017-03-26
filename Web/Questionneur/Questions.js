$(document).ready(function(){
	console.log("doc chargé");
	$('.button').click(function(e){
		$(this).parent().append($('<input type="hidden" name="desc" value="'+$('#desc').text()+'"/>'));
		
		
		
	});
	
});