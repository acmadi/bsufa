<?php
$session_id = $this->UserLogin->isLogin();
$level = $session_id['level_id'];
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	<?php if($level != 1 ){ ?>
	grid.navButtonAdd('#pager',{
		   caption:"input", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm("<?=site_url($module_url)?>" + '/add/?width='+900+'&height='+500);
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"View", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/view/' + id + '/?width='+900+'&height='+500);
			 }else{
				 alert('Pilih baris yang ingin diview');
			 }
		   }, 
		   position:"last"
		})
	<?php }else{ ?>
	grid.navButtonAdd('#pager',{
		   caption:"Approve", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/view/' + id + '/?width='+900+'&height='+500);
			 }else{
				 alert('Pilih baris yang ingin di Approve');
			 }
		   }, 
		   position:"last"
		})
	<?php }?>
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
	if(element.flag_id == 1)
		var newVal = '<span class="customBg" style="background-color:#cc9900">'+cellVal+'</span>';
	else if(element.flag_id == 2)
		var newVal = '<span class="customBg" style="background-color:#006633">'+cellVal+'</span>';
	else var newVal = cellVal;
	return newVal;
}

function numberFormat(cellVal,opts,element){
	if(element.flag_id == 1)
		var newVal = '<span class="customBg" style="background-color:#cc9900">'+numToCurr(element.amount)+'</span>';
	else if(element.flag_id == 2)
		var newVal = '<span class="customBg" style="background-color:#006633">'+numToCurr(element.amount)+'</span>';
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

