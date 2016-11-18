!jQuery(document).ready(function($){
	// fonction click pour faire apparaitre le Form Inscription
	$('#reg_link').click(function() {
		 $( "#connect" ).fadeOut(350, function() {
			$( "#register" ).fadeIn(350, function() {
	  		
	  		});
  		});
	});
	$(document).ready(function() {
		let open = false;
   		$('select').material_select();
   		$( ".bar_element" ).on( "click", function() {
   			if(open == false){
		  		$(this).find('.more').slideDown();
		  		$(this).find('.drop').text('arrow_drop_up');
		  		open = true;
   			}else{
   				$(this).find('.drop').text('arrow_drop_down');
   				$(this).find('.more').slideUp();
   				open = false;
   			}
		});
  	});
            
});