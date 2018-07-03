
 <span id="goTop">gotop</span>

<script type="text/javascript">
	$(function(){
    var $gotop = $('#goTop') , goSpeed = 800 ;

    $gotop.click(function(e) {
        $('html , body').animate({scrollTop:0} , goSpeed);
    });
});

</script>
 </body>
</html>
