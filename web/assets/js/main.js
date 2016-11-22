!jQuery(document).ready(function($){
	$(".dropdown-button").dropdown();
	// fonction click pour faire apparaitre le Form Inscription
	$('#reg_link').click(function() {
		 $( "#connect" ).fadeOut(350, function() {
	  		$('#register').removeClass('dispnone');
	  		$('#subscribe_post').removeClass('dispnone');
			$( "#register" ).fadeIn(350, function() {});
  		});
	});

	$( "#subscribe_post" ).on( "click", function() {
		let element1 = $('#password').val(),
		    element2  = $('#re_password').val();

		    if(element1 == element2){
		    	$('#register').submit();
		    }else{
		    	 Materialize.toast('Les mots de passe de corresponde pas !', 4000);
		    }

	});


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
	$
            
});