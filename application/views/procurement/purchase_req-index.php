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
	
	.navButtonAdd('#pager',{
		   caption:"Input", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm("<?=site_url($module_url)?>" + '/add/?width='+900+'&height='+400);
		   }, 
		   position:"last"
		})
	.navButtonAdd('#pager',{
		   caption:"Edit", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>"  + '/view/' + id + '/?width='+900+'&height='+400);	
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})
		<? if($level == 3 or $level == 10 or $level == 5 or $level == 1){?>
	.navButtonAdd('#pager',{
		   caption:"Approval PR ", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			   var id = getSelectedID();
			if(id){
				 popupForm("<?=site_url($module_url)?>" + '/app/' + id + '/?width='+750+'&height='+400);
			 }else{
				 alert('Pilih baris yang ingin di approve');
			 }
		   }, 
		   position:"last"
		})
		<?php } ?>
	.navButtonAdd('#pager',{
		   caption:"Print", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			    var id = getSelectedID();
			 if(id){
				window.open("<?=site_url($module_url)?>" + '/printpr/' + id + '/?width='+900+'&height='+500);
		    }else{
				 alert('Pilih baris yang ingin print');
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
	if(element.status_pr == 0)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+cellVal+'</span>';
		else if(element.status_pr == 1)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';		
		else if(element.status_pr == 2)
		var newVal = '<span class="customBg" style="background-color:#C0C0C0">'+cellVal+'</span>';
		else if(element.status_pr == 3)
		var newVal = '<span class="customBg" style="background-color:#C0C0C0">'+cellVal+'</span>';	
		else if(element.status_pr == 4)
		var newVal = '<span class="customBg" style="background-color:#C0C0C0">'+cellVal+'</span>';	
		else if(element.status_pr == 5)
		var newVal = '<span class="customBg" style="background-color:#C0C0C0">'+cellVal+'</span>';	
		else if(element.status_pr == 6)
		var newVal = '<span class="customBg" style="background-color:#C0C0C0">'+cellVal+'</span>';						
		else if(element.status_pr == 9)
		var newVal = '<span class="customBg" style="background-color:#C0C0C0">'+cellVal+'</span>';
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
<br>
<br>
<table >
		<tr>
			<td style="background-color:#FF80FF;width:130px;height:25px;" align="center">REQUEST</td>
			<td style="background-color:#00FF00;;width:130px;height:25px" align="center">APPROVED</td>
			<td style="background-color:#C0C0C0;;width:130px;height:25px" align="center">PURCHASING</td>
<!--
			<td style="background-color:#FFFF66;;width:130px;height:25px" align="center">VERIFICATION</td>
			<td style="background-color:#FF1273;;width:130px;height:25px" align="center">PROSES APP FAM</td>
			<td style="background-color:#FF1122;;width:130px;height:25px" align="center">PROSES APP FC</td>
			<td style="background-color:#FFCC33;;width:130px;height:25px" align="center">POSTING PO</td>
			<td style="background-color:#808080;;width:130px;height:25px" align="center">DECLINED</td>
-->
			
		
			
		</tr>
</table>


