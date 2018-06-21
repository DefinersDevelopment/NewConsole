/*
  _    _                 _____       _             __               
 | |  | |               |_   _|     | |           / _|              
 | |  | |___  ___ _ __    | |  _ __ | |_ ___ _ __| |_ __ _  ___ ___ 
 | |  | / __|/ _ \ '__|   | | | '_ \| __/ _ \ '__|  _/ _` |/ __/ _ \
 | |__| \__ \  __/ |     _| |_| | | | ||  __/ |  | || (_| | (_|  __/
  \____/|___/\___|_|    |_____|_| |_|\__\___|_|  |_| \__,_|\___\___|

*/

// Open SubNavigation
$('#mainNav span.toggleNav').click(function(){
	$('#mainNav li ul').slideUp();
	if ($(this).parent().find('ul').is(':hidden') == true) {
		$(this).parent().find('ul').slideDown();
	}
});
$('#mainNav li ul li').click(function(){
	$(this).parent().css('display', 'block');
});

// testing this shit

// Close/Open Middle Column
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
	} else {
		$('#middleColumn').removeClass('closed');
	}
});



// Scroll Bar for Right Column
$('#content').scroll(function(){
	var scrollPercent = $(this).scrollTop() / ( $('#contentWrapper').height() - $(this).height() ) * 100;
	$('#color').css('width', scrollPercent + '%'  );

	if ($(this).scrollTop() < 500) {
		$('#rightColumn .circle').css({'opacity':'.5'});
	} else {
		$('#rightColumn .circle').css({'opacity':'1'});
	}
});
$('#rightColumn .circle').click(function() {
	scrollToTop('#topBar');
}); 



// Advanced Search
$('#openAdvancedSearch').click(function(){
	$('#advancedSearch').slideToggle();
	$(this).toggleClass('active');
	if ($('.advanced').hasClass('fa-chevron-circle-down')) {
		$('.advanced').removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-up');
	} else {
		$('.advanced').removeClass('fa-chevron-circle-up').addClass('fa-chevron-circle-down');
	}
});





