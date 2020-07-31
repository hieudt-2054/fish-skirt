

$(document).ready(function() {
	setTimeout(function(){
		$('body').addClass('loaded');
		$('h1').css('color','#222222');
	}, 1000);
	setInterval(function(){ $(".custom-social-proof").stop().slideToggle('slow'); }, 8000);
	$(".custom-close").click(function() {
	  $(".custom-social-proof").stop().slideToggle('slow');
	});
});
$('#clock').countdown('2020/10/10', function(event) {
	$(this).html(event.strftime('%D NGÀY %H GIỜ %M PHÚT %S GIÂY'));
  });

var btn = $('#button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});

