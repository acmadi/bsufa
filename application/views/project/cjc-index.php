<?php
$session_id = $this->UserLogin->isLogin();
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
$level = $session_id['level_id']; 
?>
<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid
	<? if($level == 5  or $level == 10){?>
	.navButtonAdd('#pager',{
		   caption:"Approval", 
		   buttonicon:"", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/approved/'  + id + '/?width='+600+'&height='+300);
			 }else{
				 alert('Pilih baris yang ingin di create');
			 }
		   }, 
		   position:"last"
		})	
	<? } ?>	
		.navButtonAdd('#pager',{
		   caption:"Print", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 window.open("<?=site_url($module_url)?>" + '/printcjc/' + id + '/?width='+750+'&height='+400);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})				

		/*.navButtonAdd('#pager',{
		   caption:"View", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/update/' + id + '/?width='+750+'&height='+400);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})*/				
					


    .navButtonAdd('#pager',{
		   caption:"Search", 
		   buttonicon:"ui-icon-search", 
		   onClickButton: function(){ 
			 grid.jqGrid('searchGrid');
		   }, 
		   position:"last"
		})
		
function cellColumn(cellVal,opts,element){
	if(element.flag_id == 0)
		var newVal = '<span class="customBg" style="background-color:#FFFFFF">'+cellVal+'</span>';
		else if(element.flag_id == 1)
		var newVal = '<span class="customBg" style="background-color:#FF80FF">'+cellVal+'</span>';		
		else if(element.flag_id == 2)
		var newVal = '<span class="customBg" style="background-color:#FFFF00">'+cellVal+'</span>';
		else if(element.flag_id == 3)
		var newVal = '<span class="customBg" style="background-color:#00FF00">'+cellVal+'</span>';	
		
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

<div style="left">
<table >
		<tr>
			<td style="background-color:white;width:130px;height:25px" align="center">NOT APPROVED</td>
			<td style="background-color:#FF80FF;width:130px;height:25px" >ACCOUNTING</td>
			<td style="background-color:#FFFF00;;width:130px;height:25px">FINANCE</td>
			<td style="background-color:#00FF00;;width:130px;height:25px">PAID</td>
		
			
		</tr>
</table>




</div>


