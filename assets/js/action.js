
$(document).ready(function() {
		$(function() {
		//----- OPEN
		$('[data-popup-open]').on('click', function(e)  {
		var targeted_popup_class = jQuery(this).attr('data-popup-open');
		$('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
		e.preventDefault();
		});
		//----- CLOSE
		$('[data-popup-close]').on('click', function(e)  {
		var targeted_popup_class = jQuery(this).attr('data-popup-close');
		$('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
		e.preventDefault();
		});
		});


$('#pnAdvancerRight').click(function() {
  event.preventDefault();
  $('#eoTable').animate({
    scrollLeft: "+=300px"
  }, "slow");
});

 $('#pnAdvancerLeft').click(function() {
  event.preventDefault();
  $('#eoTable').animate({
    scrollLeft: "-=300px"
  }, "slow");
});

});


