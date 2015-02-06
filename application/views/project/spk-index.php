<?php
$session_id = $this->UserLogin->isLogin();
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
$level = $session_id['level_id']; 
?>

<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid.navButtonAdd('#pager',{
		   caption:"Create SPK", 
		   buttonicon:"", 
		   onClickButton: function(){ 
			 popupForm("<?=site_url($module_url)?>" + '/add/?width='+800+'&height='+400);
		   }, 
		   position:"last"
		})
		
		<? if($level == 10){?>
		.navButtonAdd('#pager',{
		   caption:"Approval", 
		   buttonicon:"", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/approve/' + id + '/?width='+650+'&height='+400);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})	
		<?}?>
		
		.navButtonAdd('#pager',{
		   caption:"View", 
		   buttonicon:"", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/view/' + id + '/?width='+750+'&height='+450);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})				

		.navButtonAdd('#pager',{
		   caption:"Print SPK", 
		   buttonicon:"ui-icon-print", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				window.open("<?=site_url($module_url)?>" + '/print_spk/' + id + '/?width='+750+'&height='+450);
			 }else{
				 alert('Pilih baris yang ingin diedit');
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

function cellColumn(cellVal,opts,element){
	if(element.id_flag == 1)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';
		else if(element.id_flag == 2)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';
		else if(element.id_flag == 3)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+cellVal+'</span>';		
	else var newVal = cellVal;
	return newVal;
}
			

});
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



