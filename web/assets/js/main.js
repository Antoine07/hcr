!jQuery(document).ready(function($){
	$(".dropdown-button").dropdown();
	// Fonction click pour faire apparaitre le Form Inscription
	$('#reg_link').click(function() {
		 $( "#connect" ).fadeOut(350, function() {
	  		$('#register').removeClass('dispnone');
	  		$('#subscribe_post').removeClass('dispnone');
			$( "#register" ).fadeIn(350, function() {});
  		});
	});
	// Fonction click pour la confirmation de mot de passe
	$( "#subscribe_post" ).on( "click", function() {
		let element1 = $('#password').val(),
		    element2  = $('#re_password').val();

		    if(element1 == element2){
		    	$('#register').submit();
		    }else{
		    	 Materialize.toast('Les mots de passe de corresponde pas !', 4000);
		    }
	});
	// Fonction click pour faire apparaitre/disparaitre la section pour vendre les objets
	$("#btnsell").on('click',function(){
		$(".shop_left, .shop_right").fadeOut(100, function() {
			$("#content_sell").removeClass('dispnone');
			$("#close_sell").removeClass('dispnone');
			$(".shop_left, .shop_right").addClass('dispnone');
	  		$( "#content_sell" ).fadeIn(350, function() {});
  		});
	});
	$("#close_sell").on('click',function(){
		$("#content_sell").fadeOut(100, function() {
			$(".shop_left, .shop_right").removeClass('dispnone');
			$("#close_sell").addClass('dispnone');
			$("content_sell").addClass('dispnone');
	  		$(".shop_left, .shop_right").fadeIn(350, function() {});
  		});
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
	$( ".shop_element" ).on( "click", function() {
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