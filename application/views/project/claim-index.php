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
	<? #if($level == 1 or $level == 10 ){?>
	.navButtonAdd('#pager',{
		   caption:"History Claim", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				  window.open("<?=site_url($module_url)?>" + '/printclaim/' + id + '/?width='+750+'&height='+400);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})	
<? #} ?>
	
    .navButtonAdd('#pager',{
		   caption:"Search", 
		   buttonicon:"ui-icon-search", 
		   onClickButton: function(){ 
			 grid.jqGrid('searchGrid');
		   }, 
		   position:"last"
		})
		
function cellColumn(cellVal,opts,element){
	if(element.lunas == 1)
		//var newVal = '<span class="customBg" style="background-color:#FFFF80">'+cellVal+'</span>';
		//else if(element.id_flag == 3)
		var newVal = '<span class="customBg" style="background-color:#80FF80">'+cellVal+'</span>';	
		else if(element.id_flag == 2)
		var newVal = '<span class="customBg" style="background-color:#FFFF80">'+cellVal+'</span>';
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
<div style="left">
<table >
		<tr>
			<td style="background-color:#80FF80;width:130px;height:25px" align="center">FULL CLAIM</td>
			<td style="background-color:#FFFF80;width:130px;height:25px" align="center">PROGRESS CLAIM</td>
			<td style="background-color:white;width:130px;height:25px" align="center">NOT CLAIM</td>
		
			
		</tr>
</table>

</div>






