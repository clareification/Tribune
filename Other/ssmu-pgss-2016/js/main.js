$(document).ready(function(){
	var dropdown = function(target){
		$(target).toggleClass('inactive active');
		$('.candidates .details').not(target).removeClass('active').addClass('inactive');
	}
	$('.candidates .candidate-header').click(function(e){
		var id = $(e.target).parents('.candidate-header');
		id.children('h3').toggleClass('hl');
		$('.candidate-header').not(id).children("h3").addClass('unhighlight').removeClass('hl');
		id = id.attr('id');
		console.log(id);
		id = "." + id;
		dropdown(id);
	});
});