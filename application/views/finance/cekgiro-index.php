<?php
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
?>
<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	/*grid.navButtonAdd('#pager',{
		   caption:"Create Cek/Giro", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm("<?=site_url($module_url)?>" + '/add/?width='+650+'&height='+400);
		   }, 
		   position:"last"
		})*/
		grid.navButtonAdd('#pager',{
		   caption:"Pay Cek/Giro", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/update/' + id + '/?width='+750+'&height='+400);
			 }else{
				 alert('Pilih baris yang ingin dibuat');
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

function cellColumn(cellVal,opts,element){
	if(element.jenis == "Check")
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';
	else if(element.jenis == "Giro")
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+cellVal+'</span>';
	else var newVal = cellVal;
	return newVal;
}
</script>

<style>
.customBg{
	display:block;
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;
}
.customBg2{
	display:block;
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;
}
</style>
<div align="center">
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>

