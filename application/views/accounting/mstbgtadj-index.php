<?php
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid.navButtonAdd('#pager',{
		   caption:"Adjustment", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm("<?=site_url($module_url)?>" + '/adj/?width='+900+'&height='+800);
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"Reclass", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm("<?=site_url($module_url)?>" + '/reclass/?width='+900+'&height='+500);
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

function numberFormat(cellVal,opts,element){
    var newVal = numToCurr(cellVal);
	return newVal;
}

});
</script>
<div align="center">
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>
