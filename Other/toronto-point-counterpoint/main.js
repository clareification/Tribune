var showPoint = false;
var showCounterPoint = false;
$(".point-content").hide();
$(".counter-point-content").hide();

$('.point').click(function(){
	$(".point-content").show();
});

$('.point-content').click(function(){
	$(".point-content").hide();
});

$('.counter-point').click(function(){
	$(".counter-point-content").show();
});

$('.counter-point-content').click(function(){
	$(".counter-point-content").hide();
});