
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
    $("#billboardTable .billtd").find("p").hide();

    $("#billboardTable .bb-btn span").click(function(event) {
			$(this).toggleClass('btn-mi');
        event.stopPropagation();
        var $target = $(event.target);
        if ( $target.closest("td").attr("colspan") > 1 ) {
            $target.slideUp();
        } else {
            $target.closest("tr").next().find("p").slideToggle();
        }
        console.log(this);
    });
});

    var tableFixed = $(".table-fixed");
    var sticky = tableFixed.offsetTop;

    tableFixed.scroll(function(){
     if (window.pageYOffset > sticky) {
        tableFixed.classList.add("sticky-header");
      } else {
        tableFixed.classList.remove("sticky-header");
      }
    });

});


