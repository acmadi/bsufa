 var timer = null; 
 function openContent(trigger,divID){ 
	/*$('#divTriggerTab a').each( 
		function(){
			$(this).css({'border':'2px solid #CCC'});			 	
		}
	);*/
	var currentNumber = String(divID).replace('div','');
	//alert(currentNumber);
	var slideCount = Object($('#divProfileDesc div')).length;
	//alert(slideCount);
	$('#divContentTab div').hide();
	$('#divProfileDesc div').hide();
 
	$('#'+divID).fadeIn('slow');
	$('#profileContent_'+divID).fadeIn('slow');
 	
	/*if(timer != null) clearTimeout(timer);
	timer = setTimeout( 
	  function(){					  
		//var nextAnchor = ($(trigger).next('a').text() == '') ? $('#divTriggerTab a:first') : $(trigger).next('a');
		var nextAnchor = (currentNumber == slideCount) ? $('#divTriggerTab a:first') : $(trigger).next('a');
		nextAnchor.click();
	  }, 5000 
	);*/
 }	
 
