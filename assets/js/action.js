
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
    scrollLeft: "+=700px"
  }, "slow");
});

 $('#pnAdvancerLeft').click(function() {
  event.preventDefault();
  $('#eoTable').animate({
    scrollLeft: "-=700px"
  }, "slow");
});

$("#receFileUpload").change(function(){
  fileName = $(this)[0].files[0].name;
   $('.filename_zone').html(fileName);
	console.log("fileName" + fileName);
  });


// 公布欄 table row expand
	$(function() {
    $("#billboardTable td[colspan=4]").find("p").hide();



    $("#billboardTable").click(function(event) {
        event.stopPropagation();
        var $target = $(event.target);
        if ( $target.closest("td").attr("colspan") > 1 ) {
            $target.slideUp();
        } else {
            $target.closest("tr").next().find("p").slideToggle();
        }
    });
});



});


