var nav = 1;
$(".cover").click(function() {
    if(nav % 2 === 0) {
        $(".line").removeClass('animate');
        $(".line").toggleClass('reverse');
    } else {
        $(".line").removeClass('reverse');
        $('.line').toggleClass('animate');
    }
    nav = nav + 1;
});


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
	}else {
		$('#middleColumn').removeClass('closed');
	}
});

// Advanced Search
$('#openAdvancedSearch').click(function(){
	$('#advancedSearch').slideToggle();
	$(this).toggleClass('active');
	if ($('.advanced').hasClass('fa-chevron-circle-down')) {
		$('.advanced').removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-up');
	}else {
		$('.advanced').removeClass('fa-chevron-circle-up').addClass('fa-chevron-circle-down');
	}
});






