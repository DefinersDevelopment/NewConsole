// Open SubNavigation
function openSubNavigation() {
	$('#mainNav span.toggleNav').click(function(){
		$('#mainNav li ul').slideUp();
		if ($(this).parent().find('ul').is(':hidden') == true) {
			$(this).parent().find('ul').slideDown();
		}
	});
	$('#mainNav li ul li').click(function(){
		$(this).parent().css('display', 'block');
	});
}
openSubNavigation();


// Close/Open Middle Column
function closeOpenMiddleColumn() {
	$('#toggleMiddle').click(function(){
		$('#middleColumn').toggleClass('closed');
	});
	if ($(window).width() < 1170) {
		$('#middleColumn').addClass('closed');
	}
	$(window).resize(function(){
		console.log($(window).width());
		if ($(window).width() < 1170) {
			$('#middleColumn').addClass('closed');
		}else {
			$('#middleColumn').removeClass('closed');
		}
	});
}
closeOpenMiddleColumn();


// Advanced Search
function advancedSearch() {
	$('#openAdvancedSearch').click(function(){
		$('#advancedSearch').slideToggle();
		$(this).toggleClass('active');
		if ($('.advanced').hasClass('fa-chevron-circle-down')) {
			$('.advanced').removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-up');
		}else {
			$('.advanced').removeClass('fa-chevron-circle-up').addClass('fa-chevron-circle-down');
		}
	});
}
advancedSearch();


//Scroll To Top

$('#content').scroll(function(){
	var scroll = $(this).scrollTop();
	if (scroll < 500) {
		$('#rightColumn .circle').css({'opacity':'.5'});
	}
	else {
		$('#rightColumn .circle').css({'opacity':'1'});
	}
});
$('#rightColumn .circle').click(function() {
	$('#content').animate({
	    scrollTop: $( $.attr(this, 'top') ).offset().top
	}, '500');
});



// Scroll Bar
function scrollBar() {
	$('#color').show().css('width', 0);
	var d = $('#content').prop('scrollHeight');
	$('#content').on('scroll', function(){
		var h = $(window).innerHeight() - 75;
		var scroll = $(this).scrollTop();
		var output = (scroll / (d - h)) * 100;
		$('#color').css({'width':output +'%'});
	});
}
scrollBar();





