<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid.navButtonAdd('#pager',{
		   caption:"Input", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm("<?=site_url($module_url)?>" + '/add/?width='+370+'&height='+250);
		   }, 
		   position:"last"
		})
		
		.navButtonAdd('#pager',{
		   caption:"Delete", 
		   buttonicon:"ui-icon-trash", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/del/' + id + '/?width='+0+'&height='+0);
			 }else{
				 alert('Pilih baris yang ingin delete');
			 }
		   }, 
		   position:"last"
		})	
		
		.navButtonAdd('#pager',{
		   caption:"Update", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/ubah/' + id + '/?width='+370+'&height='+200);
			 }else{
				 alert('Pilih baris yang ingin delete');
			 }
		   }, 
		   position:"last"
		})	
    .navButtonAdd('#pager',{
		   caption:"Search", 
		   buttonicon:"ui-icon-search", 
		   onClickButton: function(){ 
			 grid.jqGrid('searchGrid');
		   }, 
		   position:"last"
		})

});
</script>
<div align="center">
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>



