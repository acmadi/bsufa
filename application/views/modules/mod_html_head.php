<? 
	echo link_tag(CSS_PATH.'jquerycssmenu1.css');
	echo link_tag(CSS_PATH.'t10tab.css');
	echo script('jquery.js');
	echo script('jquerycssmenu.js');
	echo script('t10tab.js');
	if($meta){
	  echo meta('description',$meta->desc);
	  echo meta('keywords',$meta->keys);
	}
?>
<script language="javascript">
 var IMAGE_PATH = "<?=base_url().IMAGE_PATH?>";
 var arrowimages = {
		down: ['downarrowclass', ''],
		right: ['rightarrowclass', IMAGE_PATH+'arrow-right.gif']
	}; 
 function searchText(searchText){
	var URL = "<?=site_url()?>?c=search&m=index&search="+searchText;
	document.location = URL;
	return false;
 }
 function openTabNews(elementTab,idTabContent){
	$('.newsTab').attr('class','newsTab');
	$(elementTab).attr('class','newsTab newsSelectedTab');
	$('.newsTabContent').hide();
	$('#'+idTabContent).show();
 }
 function showFullContent(index){
	 if($('#previewContent'+index).css('display')=='none') $('#previewContent'+index).show();
	 else $('#previewContent'+index).hide();
	 if($('#fullContent'+index).css('display')=='none') $('#fullContent'+index).show();
	 else $('#fullContent'+index).hide();
 }
 function AjaxPagging(element,URL){
	 $.get(
		URL,
		function(response){
		   element.html(response);
		   element.find('.divAjaxPagging a').click(
				function(){
					AjaxPagging(element,$(this).attr('href'));
					return false;
				}
		   );
		},'html'
	 )
 } 
 $(document).ready(
	function(){
		if($('#menuTopNav') != undefined){		
		  openContent($('#firstSlide'),'div1');		
		}
		jquerycssmenu.buildmenu("menuHome",arrowimages);
		openContent($('#firstSlide'),'div1');	
		$('#menu a').each(
			function(){
				var doc = document.location;
				if(String(doc).indexOf($(this).attr('href')) > -1 && $(this).text() != 'Home') 
				  $(this).addClass('selectedAnchor');
/*
				if($(this).text() == 'Gallery'){
				  if(String(doc).indexOf('/gallery/') > -1 || String(doc).indexOf('/projects') > -1)
				    $(this).addClass('selectedAnchor');
				}
*/
			}
		);
		
/*
		$('.menuChild').hide();
		$('#menu a').mouseover(
			function(){
				var open = $(this).attr('open');
				var element = $('.menuChild[@parent='+open+']');
				if(element != undefined){
					var offset = $(this).position();
					var posLeft = (offset.left) + 'px';
					//alert(offset.top);
					var posTop  = (offset.top+$(this).height()+5) + 'px'
					element.css({left: posLeft, top: posTop});
					element.fadeIn();
							
					var timed = null;
					element.mouseover(
					   function(){ 
						 if(timed != null) 
						   clearTimeout(timed); 
						   element.show() 
					   }); 
					element.mouseout(
					   function(){ 
						 timed = setTimeout(
						  function(){
							element.fadeOut()
						  },100);
					   }); 			
				}				
			}
		)
		$('#menu a').mouseout(
			function(){
				var open = $(this).attr('open');
				$('.menuChild[@parent='+open+']').hide();
			}
		)
*/
	}
 )
</script>
