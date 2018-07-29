$(document).ready(function(){  //Document ready start

	// Fancybox styling
	$(".fancybox").fancybox({
		"autoScale": false,
		"fitToView": false
	});

	// Show Epaper Section
	var imgSrc=$("#id0 img").attr('src');
	$("#targetImg").attr('src',imgSrc);
	$(".fancybox").attr('href',imgSrc);
	$(".epaperr-wrapper ul").on('click','li',function(){
		var imgID=$(this).attr('id');
		imgSrc=$("#"+imgID+" img").attr('src');
		$("#targetImg").attr('src',imgSrc);
		$(".fancybox").attr('href',imgSrc);
	});

	// Picture Gallery
	$('.bxslider').bxSlider({
		"adaptiveHeight":true
	});

});//Document ready end

// When window load
$(window).load(function(){
	// Add Element when page load
	$(".fancybox-wrap").append('<p>Close</p>');
});