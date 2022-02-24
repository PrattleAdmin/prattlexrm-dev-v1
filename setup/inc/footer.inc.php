
            <div class="clear"></div>
        </div> <!-- content -->
    </div> <!-- wizard -->

    <div id="footer"><!--osta-->
		<?php include ROOT_DIR . 'osta/inc/setup-foot.html'; ?>
    </div>
	
    <script type="text/javascript" src="../js/jquery-3.5.1.min.js?b42ddc7"></script>
    <script type="text/javascript" src="../js/jstz.min.js?b42ddc7"></script>
    <script type="text/javascript" src="js/setup.js?b42ddc7"></script>
    <script type="text/javascript" src="js/tips.js?b42ddc7"></script>
	<script>
        //osta
	// >5 language packs, let's do stuff
	$('.flag:nth-child(5)').closest('div#lang-wrapper').addClass("chevron"); 
	var intTotalWidth = 0;
	$(".button-text-container .flag").each(function(index, value) {
		intTotalWidth = intTotalWidth + parseInt($(this).innerWidth())+5;
		$(".button-text-container").css("width", intTotalWidth);	
	});
	$(document).ready(function() {
	  $("select:not(#timezone-dropdown)").select2({
			minimumResultsForSearch: Infinity
		});
	});	
	$(document).ready(function(){
	  $("#myButton").click(function(){
		$('ul#nav').toggleClass("hide-nav");	  
		$(".button-text-container").toggleClass("grow");
		$(".button-text-container").toggleClass("shrink");
	  });
	});
	</script>
</body>
</html>
