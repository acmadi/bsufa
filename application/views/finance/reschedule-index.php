
	
		
<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid.navButtonAdd('#pager',{
		   caption:"Reschedule", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
		   var id = getSelectedID();
			 if(id){
			 popupForm("<?=site_url()?>" + 'finance/reschedule/reschedules/' + id + '/?width='+1100+'&height='+600);
			  }else{
				  alert('Pilih baris yang ingin di reschedule');
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

