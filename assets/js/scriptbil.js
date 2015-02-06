    $(function(){
	  $('.calculate').bind('keyup keypress',function(){
			$(this).val( numToCurr( $(this).val() ) );
		  }).numeric();
	  
    });
